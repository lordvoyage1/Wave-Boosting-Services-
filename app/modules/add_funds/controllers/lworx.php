<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lworx extends MX_Controller
{
    public $tb_users;
    public $tb_transaction_logs;
    public $tb_payments;
    public $tb_payments_bonuses;
    public $payment_type;
    public $payment_id;
    public $currency_code;
    public $mode;
    public $merchant_id;
    public $api_key;
    public $api_secret;
    public $payment_method_mode;
    public $payment_fee;
    public $api_base = 'https://lworx.ug-web.com/api/v1';

    public function __construct($payment = "")
    {
        parent::__construct();
        $this->load->model('add_funds_model', 'model');

        $this->tb_users            = USERS;
        $this->tb_transaction_logs = TRANSACTION_LOGS;
        $this->tb_payments         = PAYMENTS_METHOD;
        $this->tb_payments_bonuses = PAYMENTS_BONUSES;
        $this->payment_type        = 'lworx';
        $this->currency_code       = get_option("currency_code", "USD");
        if ($this->currency_code == "") {
            $this->currency_code = 'USD';
        }

        if (!$payment) {
            $payment = $this->model->get('id, type, name, params', $this->tb_payments, ['type' => $this->payment_type]);
        }

        if (!$payment) {
            return;
        }

        $this->payment_id         = $payment->id;
        $params                   = $payment->params;
        $option                   = get_value($params, 'option');
        $this->mode               = get_value($option, 'environment');
        $this->payment_fee        = get_value($option, 'tnx_fee');
        $this->merchant_id        = get_value($option, 'merchant_id');
        $this->api_key            = get_value($option, 'api_key');
        $this->api_secret         = get_value($option, 'api_secret');
        $this->payment_method_mode = get_value($option, 'payment_method_mode');
        if (!$this->payment_method_mode) {
            $this->payment_method_mode = 'payment_link';
        }
    }

    public function index()
    {
        redirect(cn("add_funds"));
    }

    /**
     * Create payment - handles both Payment Link and Direct Charge modes
     */
    public function create_payment($data_payment = "")
    {
        _is_ajax($data_payment['module']);

        $amount = $data_payment['amount'];
        if (!$amount) {
            _validation('error', lang('There_was_an_error_processing_your_request_Please_try_again_later'));
        }

        if (!$this->merchant_id || !$this->api_key) {
            _validation('error', lang('this_payment_is_not_active_please_choose_another_payment_or_contact_us_for_more_detail'));
        }

        $users = session('user_current_info');
        $uid   = session('uid');
        $user  = $this->model->get('id, first_name, last_name, email', $this->tb_users, ['id' => $uid]);

        $ref_trx = 'WBS-' . $uid . '-' . time();

        if ($this->payment_method_mode == 'direct_charge') {
            $this->_create_direct_charge($amount, $ref_trx, $user, $data_payment);
        } else {
            $this->_create_payment_link($amount, $ref_trx, $user, $data_payment);
        }
    }

    /**
     * Payment Link mode - redirect to lworx checkout
     */
    private function _create_payment_link($amount, $ref_trx, $user, $data_payment)
    {
        $environment = ($this->mode == 'live') ? 'production' : 'sandbox';

        $post_data = json_encode([
            'payment_amount'   => (float) $amount,
            'currency_code'    => $this->currency_code,
            'ref_trx'          => $ref_trx,
            'description'      => lang('Deposit_to_') . get_option('website_name', 'Wave Boosting Services') . ' - (' . $user->email . ')',
            'customer_name'    => $user->first_name . ' ' . $user->last_name,
            'customer_email'   => $user->email,
            'ipn_url'          => cn('lworx_ipn'),
            'success_redirect' => cn('add_funds/lworx/complete/' . $ref_trx),
            'cancel_redirect'  => cn('add_funds/unsuccess'),
        ]);

        $headers = [
            'Content-Type: application/json',
            'X-Merchant-Key: ' . $this->merchant_id,
            'X-API-Key: ' . $this->api_key,
            'X-Environment: ' . $environment,
        ];

        $result = $this->_curl_request($this->api_base . '/initiate-payment', $post_data, $headers, 'POST');

        if ($result && isset($result['payment_url'])) {
            set_session('lworx_ref_trx', $ref_trx);
            set_session('lworx_amount', $amount);
            set_session('lworx_uid', session('uid'));

            ms([
                "status"   => "success",
                "redirect" => $result['payment_url'],
            ]);
        } else {
            $error_msg = isset($result['message']) ? $result['message'] : lang('There_was_an_error_processing_your_request_Please_try_again_later');
            _validation('error', $error_msg);
        }
    }

    /**
     * Direct Charge mode - Uganda mobile money
     */
    private function _create_direct_charge($amount, $ref_trx, $user, $data_payment)
    {
        $phone = post('lworx_phone');
        if (!$phone) {
            _validation('error', 'Phone number is required for mobile money payment.');
        }

        $post_data = json_encode([
            'phone'       => $phone,
            'amount'      => (float) $amount,
            'currency'    => $this->currency_code,
            'description' => lang('Deposit_to_') . get_option('website_name', 'Wave Boosting Services') . ' - (' . $user->email . ')',
            'reference'   => $ref_trx,
            'ipn_url'     => cn('lworx_ipn'),
        ]);

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->api_key,
        ];

        $result = $this->_curl_request($this->api_base . '/direct-charge', $post_data, $headers, 'POST');

        if ($result && isset($result['trx_id'])) {
            set_session('lworx_trx_id', $result['trx_id']);
            set_session('lworx_ref_trx', $ref_trx);
            set_session('lworx_amount', $amount);
            set_session('lworx_uid', session('uid'));

            ms([
                "status"   => "success",
                "redirect" => cn('add_funds/lworx/check_status/' . $result['trx_id']),
            ]);
        } else {
            $error_msg = isset($result['message']) ? $result['message'] : lang('There_was_an_error_processing_your_request_Please_try_again_later');
            _validation('error', $error_msg);
        }
    }

    /**
     * Check status of direct charge payment
     */
    public function check_status($trx_id = "")
    {
        if (!$trx_id) {
            redirect(cn('add_funds'));
        }

        $headers = [
            'Authorization: Bearer ' . $this->api_key,
        ];

        $result = $this->_curl_request($this->api_base . '/charge-status/' . $trx_id, null, $headers, 'GET');

        if ($result && isset($result['status'])) {
            if ($result['status'] == 'completed' || $result['status'] == 'success') {
                $this->_process_successful_payment(
                    $result['reference'] ?? session('lworx_ref_trx'),
                    $result['amount'] ?? session('lworx_amount'),
                    $trx_id,
                    session('lworx_uid')
                );
                redirect(cn('add_funds/success'));
                return;
            }
        }

        $data = [
            "module"  => 'add_funds',
            "trx_id"  => $trx_id,
            "status"  => isset($result['status']) ? $result['status'] : 'pending',
        ];

        $this->template->set_layout('user');
        $this->template->build('lworx/check_status', $data);
    }

    /**
     * Complete - handles redirect from lworx after payment link
     */
    public function complete($ref_trx = "")
    {
        if (!$ref_trx) {
            $ref_trx = session('lworx_ref_trx');
        }

        if (!$ref_trx) {
            redirect(cn('add_funds/unsuccess'));
            return;
        }

        $uid    = session('lworx_uid') ?: session('uid');
        $amount = session('lworx_amount');

        $exists = $this->model->get('id', $this->tb_transaction_logs, ['transaction_id' => $ref_trx, 'uid' => $uid]);
        if ($exists) {
            redirect(cn('add_funds/success'));
            return;
        }

        $result = $this->_process_successful_payment($ref_trx, $amount, $ref_trx, $uid);
        if ($result) {
            redirect(cn('add_funds/success'));
        } else {
            redirect(cn('add_funds/unsuccess'));
        }
    }

    /**
     * IPN/Webhook handler - called by LworxPay server
     */
    public function ipn()
    {
        $raw_body  = file_get_contents('php://input');
        $signature = isset($_SERVER['HTTP_X_SIGNATURE']) ? $_SERVER['HTTP_X_SIGNATURE'] : '';

        if (!$this->_verify_webhook_signature($raw_body, $signature)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid signature']);
            return;
        }

        $data = json_decode($raw_body, true);
        if (!$data) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
            return;
        }

        $status  = isset($data['status']) ? $data['status'] : '';
        $ref_trx = isset($data['ref_trx']) ? $data['ref_trx'] : (isset($data['reference']) ? $data['reference'] : '');
        $amount  = isset($data['amount']) ? $data['amount'] : 0;
        $trx_id  = isset($data['trx_id']) ? $data['trx_id'] : $ref_trx;

        if (($status == 'completed' || $status == 'success') && $ref_trx) {
            $uid_parts = explode('-', $ref_trx);
            $uid = isset($uid_parts[1]) ? (int)$uid_parts[1] : 0;

            $exists = $this->model->get('id', $this->tb_transaction_logs, ['transaction_id' => $ref_trx]);
            if ($exists) {
                http_response_code(200);
                echo json_encode(['status' => 'ok', 'message' => 'Already processed']);
                return;
            }

            if ($uid > 0) {
                $this->_process_successful_payment($ref_trx, $amount, $trx_id, $uid);
            }
        }

        http_response_code(200);
        echo json_encode(['status' => 'ok']);
    }

    /**
     * Process a successful payment - insert transaction and update balance
     */
    private function _process_successful_payment($ref_trx, $amount, $transaction_id, $uid)
    {
        if (!$uid || !$amount) {
            return false;
        }

        $exists = $this->model->get('id', $this->tb_transaction_logs, ['transaction_id' => $transaction_id]);
        if ($exists) {
            return true;
        }

        $txn_fee = $amount * (((float)$this->payment_fee) / 100);

        $data_tnx = [
            "ids"            => ids(),
            "uid"            => $uid,
            "type"           => $this->payment_type,
            "transaction_id" => $transaction_id,
            "amount"         => (float)$amount,
            "txn_fee"        => $txn_fee,
            "status"         => 1,
            "created"        => NOW,
        ];

        $this->db->insert($this->tb_transaction_logs, $data_tnx);
        $insert_id = $this->db->insert_id();

        if (!$insert_id) {
            return false;
        }

        $data_tnx['id'] = $insert_id;
        $this->model->add_funds_bonus_email((object)$data_tnx, $this->payment_id);
        set_session("transaction_id", $insert_id);

        return true;
    }

    /**
     * Verify webhook signature
     */
    private function _verify_webhook_signature($payload, $signature)
    {
        if (empty($this->api_secret)) {
            return true;
        }
        if (empty($signature)) {
            return false;
        }
        $expected = hash_hmac('sha256', $payload, $this->api_secret);
        return hash_equals($expected, $signature);
    }

    /**
     * Make cURL request to lworx API
     */
    private function _curl_request($url, $data = null, $headers = [], $method = 'POST')
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data !== null) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        } elseif ($method === 'GET') {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false) {
            return null;
        }

        return json_decode($response, true);
    }
}
