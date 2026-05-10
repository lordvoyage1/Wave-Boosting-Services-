<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pesapal {
    private $consumer_key;
    private $consumer_secret;
    private $api_url;
    private $payment;

    public function __construct($payment) {
        $this->payment = $payment;
        $params = is_string($payment->params) ? json_decode($payment->params, true) : (array)$payment->params;
        $this->consumer_key    = !empty($params['consumer_key'])    ? $params['consumer_key']    : (getenv('PESAPAL_CONSUMER_KEY')    ?: '');
        $this->consumer_secret = !empty($params['consumer_secret']) ? $params['consumer_secret'] : (getenv('PESAPAL_CONSUMER_SECRET') ?: '');
        $sandbox = !empty($params['sandbox']) ? (int)$params['sandbox'] : 0;
        $this->api_url = $sandbox ? 'https://cybqa.pesapal.com/pesapalv3' : 'https://pay.pesapal.com/v3';
    }

    private function http_post($url, $data, $token = null) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $headers = ['Content-Type: application/json', 'Accept: application/json'];
        if ($token) $headers[] = 'Authorization: Bearer ' . $token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result ? json_decode($result, true) : false;
    }

    private function http_get($url, $token) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token, 'Accept: application/json']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result ? json_decode($result, true) : false;
    }

    public function get_access_token() {
        $response = $this->http_post($this->api_url . '/api/Auth/RequestToken', [
            'consumer_key'    => $this->consumer_key,
            'consumer_secret' => $this->consumer_secret,
        ]);
        return ($response && isset($response['token'])) ? $response['token'] : false;
    }

    private function get_or_register_ipn($token, $ipn_url) {
        $result = $this->http_get($this->api_url . '/api/URLSetup/GetIpnList', $token);
        if ($result && is_array($result)) {
            foreach ($result as $ipn) {
                if (isset($ipn['url']) && rtrim($ipn['url'], '/') === rtrim($ipn_url, '/')) {
                    return $ipn['ipn_id'];
                }
            }
        }
        $reg = $this->http_post($this->api_url . '/api/URLSetup/RegisterIPN', [
            'url' => $ipn_url, 'ipn_notification_type' => 'GET',
        ], $token);
        return isset($reg['ipn_id']) ? $reg['ipn_id'] : '';
    }

    public function verify_payment($order_tracking_id) {
        $token = $this->get_access_token();
        if (!$token) return false;
        return $this->http_get(
            $this->api_url . '/api/Transactions/GetTransactionStatus?orderTrackingId=' . urlencode($order_tracking_id),
            $token
        );
    }

    public function create_payment($data_payment) {
        if (empty($this->consumer_secret)) {
            ms(['status' => 'error', 'message' => 'PesaPal is not fully configured. Please contact the administrator to set the Consumer Secret.']);
        }

        $token = $this->get_access_token();
        if (!$token) {
            ms(['status' => 'error', 'message' => 'PesaPal authentication failed. Please verify API credentials.']);
        }

        $CI = &get_instance();
        $amount   = (float)$data_payment['amount'];
        $uid      = session('uid');
        $ref      = 'LV-' . $uid . '-' . time();
        $base_url = rtrim(base_url(), '/');
        $user_info = session('user_current_info');
        $user_email = is_array($user_info) ? ($user_info['email'] ?? '') : '';
        $user_first = is_array($user_info) ? ($user_info['first_name'] ?? '') : '';
        $user_last  = is_array($user_info) ? ($user_info['last_name'] ?? '') : '';

        $ipn_url = $base_url . '/' . ltrim(cn('add_funds/pesapal_ipn'), '/');
        $ipn_id  = $this->get_or_register_ipn($token, $ipn_url);

        $order_data = [
            'id'              => $ref,
            'currency'        => 'UGX',
            'amount'          => $amount,
            'description'     => 'Add Funds - Loishvizo Boosting Solutions',
            'callback_url'    => $base_url . '/' . ltrim(cn('add_funds/pesapal_callback'), '/'),
            'notification_id' => $ipn_id,
            'billing_address' => [
                'email_address' => $user_email,
                'first_name'    => $user_first,
                'last_name'     => $user_last,
            ],
        ];

        $response = $this->http_post($this->api_url . '/api/Transactions/SubmitOrderRequest', $order_data, $token);

        if ($response && isset($response['redirect_url'])) {
            $tracking_id = isset($response['order_tracking_id']) ? $response['order_tracking_id'] : '';
            $CI->db->insert(TRANSACTION_LOGS, [
                'ids'            => ids(),
                'uid'            => $uid,
                'payer_email'    => $user_email,
                'type'           => 'pesapal',
                'transaction_id' => $tracking_id,
                'data'           => json_encode(['merchant_ref' => $ref, 'payment_id' => $this->payment->id]),
                'amount'         => $amount,
                'status'         => 0,
                'created'        => NOW,
            ]);
            $log_id = $CI->db->insert_id();
            set_session('pesapal_log_id', $log_id);
            set_session('pesapal_ref', $ref);
            ms(['status' => 'success', 'message' => 'Redirecting to PesaPal secure checkout...', 'redirect_url' => $response['redirect_url']]);
        } else {
            $err = isset($response['error']['message']) ? $response['error']['message'] : 'Failed to create PesaPal payment. Please try again.';
            ms(['status' => 'error', 'message' => $err]);
        }
    }
}
