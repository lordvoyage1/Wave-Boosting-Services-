<?php
$payment_method_modes = [
    'payment_link'  => 'Payment Link (Global - Cards, MoMo, Bank Transfer)',
    'direct_charge' => 'Direct Charge (Uganda Only - MTN/Airtel MoMo)',
];
$form_env = [
    'live'    => 'Live (Production)',
    'sandbox' => 'Sandbox (Test)',
];
$payment_elements = [
    [
        'label'      => form_label('Payment Method Mode'),
        'element'    => form_dropdown('payment_params[option][payment_method_mode]', $payment_method_modes, @$payment_option->payment_method_mode, ['class' => $class_element]),
        'class_main' => 'col-md-12 col-sm-12 col-xs-12',
    ],
    [
        'label'      => form_label('Environment'),
        'element'    => form_dropdown('payment_params[option][environment]', $form_env, @$payment_option->environment, ['class' => $class_element]),
        'class_main' => 'col-md-12 col-sm-12 col-xs-12',
    ],
    [
        'label'      => form_label('Merchant ID'),
        'element'    => form_input(['name' => 'payment_params[option][merchant_id]', 'value' => @$payment_option->merchant_id, 'type' => 'text', 'class' => $class_element, 'placeholder' => '9HM1KDrXogew']),
        'class_main' => 'col-md-12 col-sm-12 col-xs-12',
    ],
    [
        'label'      => form_label('API Key'),
        'element'    => form_input(['name' => 'payment_params[option][api_key]', 'value' => @$payment_option->api_key, 'type' => 'text', 'class' => $class_element, 'placeholder' => 'qIdFYKwJ3wZL8wyHpbipfxIC2xiv']),
        'class_main' => 'col-md-12 col-sm-12 col-xs-12',
    ],
    [
        'label'      => form_label('API Secret Key (Webhook Signing)'),
        'element'    => form_input(['name' => 'payment_params[option][api_secret]', 'value' => @$payment_option->api_secret, 'type' => 'text', 'class' => $class_element, 'placeholder' => 'PgNB7OyyB2YXwKuacEVtE18kIF3...']),
        'class_main' => 'col-md-12 col-sm-12 col-xs-12',
    ],
];
echo render_elements_form($payment_elements);
?>
<div class="col-md-12">
    <div class="alert alert-info">
        <strong>Webhook / IPN URL:</strong>
        <code><?= cn('lworx_ipn') ?></code><br>
        <small>Set this URL in your LworxPay merchant dashboard to receive payment status notifications.</small><br><br>
        <strong>Payment Link</strong> — works globally via Flutterwave (cards, mobile money, bank transfers).<br>
        <strong>Direct Charge</strong> — Uganda only, sends a push prompt to MTN or Airtel Uganda numbers.
    </div>
</div>
