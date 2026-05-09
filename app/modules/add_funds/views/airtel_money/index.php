<?php
$option       = get_value($payment_params, 'option');
$min_amount   = get_value($payment_params, 'min') ?: 5000;
$max_amount   = get_value($payment_params, 'max') ?: 5000000;
$tnx_fee      = get_value($option, 'tnx_fee') ?: 0;
$currency_sym = 'UGX ';
$currency_code = 'UGX';
?>
<div class="d-alert d-alert-info d-mb-16">
  <i class="fe fe-info"></i>
  <div>Pay using <strong>Airtel Money Uganda</strong>. Dial <strong>*185*9#</strong> or use the Airtel Money app to send payment, then enter your transaction ID below for confirmation.</div>
</div>

<div style="background:var(--d-bg);border:1px solid var(--d-border);border-radius:12px;padding:18px;margin-bottom:18px">
  <div style="font-size:12px;font-weight:700;color:var(--d-muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:12px">Payment Instructions</div>
  <div style="display:flex;flex-direction:column;gap:10px">
    <div style="display:flex;gap:12px;align-items:flex-start">
      <div style="width:26px;height:26px;border-radius:50%;background:var(--d-orange);color:#fff;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0">1</div>
      <div style="font-size:13px;color:var(--d-text)">On your Airtel phone, dial <strong>*185*9#</strong> and select "Send Money"</div>
    </div>
    <div style="display:flex;gap:12px;align-items:flex-start">
      <div style="width:26px;height:26px;border-radius:50%;background:var(--d-orange);color:#fff;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0">2</div>
      <div style="font-size:13px;color:var(--d-text)">Send your payment amount (in UGX) to: <strong style="color:var(--d-navy)"><?=get_option('airtel_money_number', '+256 700 000 000')?></strong></div>
    </div>
    <div style="display:flex;gap:12px;align-items:flex-start">
      <div style="width:26px;height:26px;border-radius:50%;background:var(--d-orange);color:#fff;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0">3</div>
      <div style="font-size:13px;color:var(--d-text)">Enter the amount and your Transaction ID in the form below and submit.</div>
    </div>
  </div>
</div>

<form class="form actionAddFundsForm" action="#" method="POST">
  <input type="hidden" name="payment_id" value="<?=$payment_id?>">
  <input type="hidden" name="currency" value="UGX">

  <div class="d-form-group">
    <label class="d-label">Amount (UGX)</label>
    <div class="d-input-icon">
      <i class="fe fe-dollar-sign"></i>
      <input type="number" class="d-input" name="amount" placeholder="<?=$min_amount?>" min="<?=$min_amount?>" max="<?=$max_amount?>" step="100" required>
    </div>
    <div class="d-form-hint">
      Min: <strong>UGX <?=number_format($min_amount)?></strong>
      <?php if($max_amount > 0): ?> &mdash; Max: <strong>UGX <?=number_format($max_amount)?></strong><?php endif; ?>
      <?php if($tnx_fee > 0): ?> &mdash; Fee: <strong><?=$tnx_fee?>%</strong><?php endif; ?>
    </div>
  </div>

  <div class="d-form-group">
    <label class="d-label">Your Phone Number</label>
    <div class="d-input-icon">
      <i class="fe fe-phone"></i>
      <input type="tel" class="d-input" name="phone_number" placeholder="+256 7XX XXX XXX" required>
    </div>
  </div>

  <div class="d-form-group">
    <label class="d-label">Transaction ID</label>
    <div class="d-input-icon">
      <i class="fe fe-hash"></i>
      <input type="text" class="d-input" name="transaction_id" placeholder="e.g. CI250508XXXXXX" required>
    </div>
    <div class="d-form-hint">Enter the Transaction ID from your Airtel Money confirmation SMS.</div>
  </div>

  <button type="submit" class="d-btn d-btn-primary" style="width:100%;justify-content:center;padding:12px">
    <i class="fe fe-check-circle"></i> Submit Payment
  </button>
</form>
