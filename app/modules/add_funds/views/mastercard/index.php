<?php
$option       = get_value($payment_params, 'option');
$min_amount   = get_value($payment_params, 'min') ?: 1;
$max_amount   = get_value($payment_params, 'max') ?: 1000;
$tnx_fee      = get_value($option, 'tnx_fee') ?: 0;
$currency_sym = get_option('currency_symbol', '$');
$currency_code = get_option('currency_code', 'USD');
?>
<div class="d-alert d-alert-info d-mb-16">
  <i class="fe fe-credit-card"></i>
  <div>Pay securely with your <strong>Mastercard</strong>. Payments are processed in <strong>USD</strong>.</div>
</div>

<form class="form actionAddFundsForm" action="#" method="POST">
  <input type="hidden" name="payment_id" value="<?=$payment_id?>">
  <input type="hidden" name="currency" value="<?=$currency_code?>">

  <div class="d-form-group">
    <label class="d-label">Amount (<?=$currency_code?>)</label>
    <div class="d-input-icon">
      <i class="fe fe-dollar-sign"></i>
      <input type="number" class="d-input" name="amount" placeholder="<?=$min_amount?>" min="<?=$min_amount?>" max="<?=$max_amount?>" step="0.01" required>
    </div>
    <div class="d-form-hint">
      Min: <strong><?=$currency_sym?><?=$min_amount?></strong>
      <?php if($max_amount > 0): ?> &mdash; Max: <strong><?=$currency_sym?><?=$max_amount?></strong><?php endif; ?>
      <?php if($tnx_fee > 0): ?> &mdash; Fee: <strong><?=$tnx_fee?>%</strong><?php endif; ?>
    </div>
  </div>

  <div class="d-form-group">
    <label class="d-label">Cardholder Name</label>
    <div class="d-input-icon">
      <i class="fe fe-user"></i>
      <input type="text" class="d-input" name="card_name" placeholder="Name as on card" required>
    </div>
  </div>

  <div class="d-form-group">
    <label class="d-label">Card Number</label>
    <div class="d-input-icon">
      <i class="fe fe-credit-card"></i>
      <input type="text" class="d-input" name="card_number" placeholder="5XXX XXXX XXXX XXXX" maxlength="19" required>
    </div>
  </div>

  <div class="d-form-row">
    <div class="d-form-group" style="margin-bottom:0">
      <label class="d-label">Expiry Date</label>
      <input type="text" class="d-input" name="card_expiry" placeholder="MM / YY" maxlength="7" required>
    </div>
    <div class="d-form-group" style="margin-bottom:0">
      <label class="d-label">CVV</label>
      <input type="text" class="d-input" name="card_cvv" placeholder="XXX" maxlength="4" required>
    </div>
  </div>

  <div style="display:flex;align-items:center;gap:8px;margin:16px 0;font-size:11px;color:var(--d-muted)">
    <i class="fe fe-lock" style="font-size:14px;color:#27ae60"></i>
    <span>Your card details are encrypted and processed securely. We do not store card information.</span>
  </div>

  <button type="submit" class="d-btn d-btn-primary" style="width:100%;justify-content:center;padding:12px">
    <i class="fe fe-lock"></i> Pay <?=$currency_sym?><span id="mc-total">0.00</span> <?=$currency_code?>
  </button>
</form>

<script>
$('input[name="amount"]').on('input', function(){
  var v = parseFloat($(this).val()) || 0;
  $('#mc-total').text(v.toFixed(2));
});
</script>
