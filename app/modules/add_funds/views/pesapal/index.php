<?php
$params     = is_string($payment_params) ? json_decode($payment_params, true) : (array)$payment_params;
$min_amount = isset($params['min']) ? (int)$params['min'] : 5000;
$max_amount = isset($params['max']) ? (int)$params['max'] : 10000000;
?>
<div class="d-alert d-alert-info d-mb-16" style="display:flex;gap:10px;align-items:flex-start;padding:14px;background:rgba(59,130,246,.08);border:1px solid rgba(59,130,246,.2);border-radius:10px">
  <i class="fe fe-credit-card" style="color:#3b82f6;margin-top:2px;flex-shrink:0"></i>
  <div style="font-size:13px;color:var(--d-text);line-height:1.6">
    Pay securely with <strong>PesaPal</strong> — supports <strong>MTN Mobile Money</strong>, <strong>Airtel Money</strong>, <strong>Mastercard</strong> and <strong>Visa</strong>. You will be redirected to PesaPal's secure checkout to complete payment.
  </div>
</div>

<div style="background:var(--d-bg);border:1px solid var(--d-border);border-radius:12px;padding:16px;margin-bottom:18px">
  <div style="font-size:11px;font-weight:700;color:var(--d-muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:12px">Accepted Payment Methods</div>
  <div style="display:flex;gap:8px;flex-wrap:wrap">
    <span style="background:#FFCC00;color:#000;font-size:11px;font-weight:700;padding:5px 12px;border-radius:20px">MTN Mobile Money</span>
    <span style="background:#EE1E25;color:#fff;font-size:11px;font-weight:700;padding:5px 12px;border-radius:20px">Airtel Money</span>
    <span style="background:#1A1F71;color:#fff;font-size:11px;font-weight:700;padding:5px 12px;border-radius:20px">Mastercard</span>
    <span style="background:#1434CB;color:#fff;font-size:11px;font-weight:700;padding:5px 12px;border-radius:20px">Visa</span>
  </div>
</div>

<form class="form actionAddFundsForm" data-redirect="<?=cn('add_funds')?>">
  <input type="hidden" name="payment_id" value="<?=$payment_id?>">
  <input type="hidden" name="agree" value="1">

  <div class="d-form-group" style="margin-bottom:16px">
    <label class="d-label" style="font-weight:600;margin-bottom:6px;display:block">Amount (UGX)</label>
    <div style="position:relative">
      <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--d-muted);font-weight:700;font-size:13px">UGX</span>
      <input type="number" class="d-input" name="amount" placeholder="Enter amount in UGX"
             min="<?=$min_amount?>" max="<?=$max_amount?>" step="100" required
             style="padding-left:52px">
    </div>
    <div style="font-size:12px;color:var(--d-muted);margin-top:5px">
      Min: <strong>UGX <?=number_format($min_amount)?></strong>
      <?php if($max_amount > 0): ?>&nbsp;&mdash;&nbsp;Max: <strong>UGX <?=number_format($max_amount)?></strong><?php endif; ?>
    </div>
  </div>

  <button type="submit" class="btn-submit d-btn d-btn-primary" style="width:100%;padding:12px;font-size:14px;font-weight:700;display:flex;align-items:center;justify-content:center;gap:8px">
    <i class="fe fe-external-link"></i> Proceed to PesaPal Checkout
  </button>
</form>

<div style="margin-top:14px;display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--d-bg);border-radius:8px;border:1px dashed var(--d-border)">
  <i class="fe fe-lock" style="color:var(--d-muted);flex-shrink:0"></i>
  <span style="font-size:12px;color:var(--d-muted)">Secured by <strong>PesaPal</strong>. Your payment details are encrypted and never stored on our servers.</span>
</div>
