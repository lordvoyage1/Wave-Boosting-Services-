<?php
$payment_method_modes = [
    'payment_link'   => 'Payment Link (All Countries - Flutterwave)',
    'direct_charge'  => 'Direct Charge (Uganda - MTN/Airtel MoMo)',
];
$form_environment = [
    'live'    => 'Live (Production)',
    'sandbox' => 'Sandbox (Test)',
];
?>
<div class="row justify-content-md-center">
    <?php echo render_elements_form($general_elements); ?>
</div>
<fieldset class="form-fieldset row">
    <legend>LworxPay Configuration</legend>
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Payment Method Mode</label>
            <?php echo form_dropdown('payment_params[option][payment_method_mode]', $payment_method_modes, @$payment_option->payment_method_mode, ['class' => 'form-control select2']); ?>
            <small class="text-muted">Payment Link works globally. Direct Charge is Uganda only (MTN &amp; Airtel).</small>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Environment</label>
            <?php echo form_dropdown('payment_params[option][environment]', $form_environment, @$payment_option->environment, ['class' => 'form-control select2']); ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Merchant ID (X-Merchant-Key)</label>
            <?php echo form_input(['name' => 'payment_params[option][merchant_id]', 'value' => @$payment_option->merchant_id, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'e.g. 9HM1KDrXogew']); ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">API Key</label>
            <?php echo form_input(['name' => 'payment_params[option][api_key]', 'value' => @$payment_option->api_key, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'e.g. qIdFYKwJ3wZL8wyHpbipfxIC2xiv']); ?>
            <small class="text-muted">Used as Bearer token for Direct Charge. Also sent as X-API-Key for Payment Link.</small>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">API Secret Key</label>
            <?php echo form_input(['name' => 'payment_params[option][api_secret]', 'value' => @$payment_option->api_secret, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'e.g. PgNB7OyyB2YXwKuacEVtE18kIF3...']); ?>
            <small class="text-muted">Used to verify webhook (IPN) signatures from LworxPay. Required for secure webhooks.</small>
        </div>
    </div>
    <div class="col-md-12">
        <div class="alert alert-info mt-2">
            <strong>Webhook / IPN URL:</strong> <code><?= cn('lworx_ipn') ?></code><br>
            <strong>Success Redirect:</strong> Auto-generated per transaction<br>
            <small>Set this webhook URL in your LworxPay merchant dashboard to receive payment notifications.</small>
        </div>
    </div>
</fieldset>
