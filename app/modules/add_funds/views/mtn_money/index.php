<?php
$option       = get_value($payment_params, 'option');
$min_amount   = get_value($payment_params, 'min') ?: 5000;
$max_amount   = get_value($payment_params, 'max') ?: 5000000;
$tnx_fee      = get_value($option, 'tnx_fee') ?: 0;
?>
<div class="d-alert d-alert-warn d-mb-16">
  <i class="fe fe-info"></i>
  <div>Pay using <strong>MTN Mobile Money Uganda</strong>. Dial <strong>*165#</strong> or use the MoMo app to send payment, then enter your Transaction ID below.</div>
</div>

<div style="background:var(--d-bg);border:1px solid var(--d-border);border-radius:12px;padding:18px;margin-bottom:18px">
  <div style="font-size:12px;font-weight:700;color:var(--d-muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:12px">Payment Instructions</div>
  <div style="display:flex;flex-direction:column;gap:10px">
    <div style="display:flex;gap:12px;align-items:flex-start">
      <div style="width:26px;height:26px;border-radius:50%;background:#ffcb00;color:#333;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0">1</div>
      <div style="font-size:13px;color:var(--d-text)">Dial <strong>*165#</strong> on your MTN line or open the MoMo App</div>
    </div>
    <div style="display:flex;gap:12px;align-items:flex-start">
      <div style="width:26px;height:26px;border-radius:50%;background:#ffcb00;color:#333;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0">2</div>
      <div style="font-size:13px;color:var(--d-text)">Select <strong>Send Money</strong> and send to: <strong style="color:var(--d-navy)"><?=get_option('mtn_money_number', '+256 780 000 000')?></strong></div>
    </div>
    <div style="display:flex;gap:12px;align-items:flex-start">
      <div style="width:26px;height:26px;border-radius:50%;background:#ffcb00;color:#333;font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0">3</div>
      <div style="font-size:13px;color:var(--d-text)">Copy the Transaction ID from your confirmation SMS and fill in the form below.</div>
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
    <label class="d-label">Your MTN Number</label>
    <div class="d-input-icon">
      <i class="fe fe-phone"></i>
      <input type="tel" class="d-input" name="phone_number" placeholder="+256 7XX XXX XXX" required>
    </div>
  </div>

  <div class="d-form-group">
    <label class="d-label">Transaction ID</label>
    <div class="d-input-icon">
      <i class="fe fe-hash"></i>
      <input type="text" class="d-input" name="transaction_id" placeholder="e.g. 1760808XXXXXX" required>
    </div>
    <div class="d-form-hint">Enter the Transaction ID from your MTN MoMo confirmation message.</div>
  </div>

  <button type="submit" class="d-btn d-btn-primary" style="width:100%;justify-content:center;padding:12px;background:#ffcb00;color:#333">
    <i class="fe fe-check-circle"></i> Submit Payment
  </button>
</form>
