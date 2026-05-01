<?php
  $option                = get_value($payment_params, 'option');
  $min_amount            = get_value($payment_params, 'min');
  $max_amount            = get_value($payment_params, 'max');
  $type                  = get_value($payment_params, 'type');
  $tnx_fee               = get_value($option, 'tnx_fee');
  $payment_method_mode   = get_value($option, 'payment_method_mode');
  $currency_code         = get_option("currency_code", 'USD');
  $currency_symbol       = get_option("currency_symbol", '$');
  $is_direct_charge      = ($payment_method_mode == 'direct_charge');
?>

<div class="add-funds-form-content">
  <form class="form actionAddFundsForm" action="#" method="POST">
    <div class="row">
      <div class="col-md-12">
        <div class="for-group text-center mb-3">
          <div style="display:inline-flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#7c3aed,#06b6d4);border-radius:12px;padding:12px 24px;">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="#fff" style="margin-right:10px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
            <span style="color:#fff;font-size:18px;font-weight:700;letter-spacing:1px;">LworxPay</span>
          </div>
          <p class="p-t-10"><small>
            <?php if ($is_direct_charge): ?>
              Pay securely with Uganda Mobile Money (MTN & Airtel). You will receive a payment prompt on your phone.
            <?php else: ?>
              Pay securely with Mobile Money, Credit/Debit Cards, or Bank Transfer via LworxPay. You will be redirected to a secure checkout page.
            <?php endif; ?>
          </small></p>
        </div>

        <div class="form-group">
          <label><?=sprintf(lang("amount_usd"), $currency_code)?></label>
          <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text"><?=$currency_symbol?></span></div>
            <input class="form-control square" type="number" name="amount" placeholder="<?=$min_amount?>" min="<?=$min_amount?>" <?=($max_amount > 0)? 'max="'.$max_amount.'"' : ''?> step="0.01">
          </div>
        </div>

        <?php if ($is_direct_charge): ?>
        <div class="form-group">
          <label>Mobile Money Phone Number</label>
          <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
            <input class="form-control" type="tel" name="lworx_phone" placeholder="e.g. 0700123456 (MTN/Airtel Uganda)">
          </div>
          <small class="text-muted">Enter your MTN or Airtel Uganda phone number. You will get a payment prompt.</small>
        </div>
        <?php endif; ?>

        <div class="form-group">
          <label><?=lang("note")?></label>
          <ul>
            <?php if ($tnx_fee > 0): ?>
            <li><?=lang("transaction_fee")?>: <strong><?=$tnx_fee?>%</strong></li>
            <?php endif; ?>
            <li><?=lang("Minimal_payment")?>: <strong><?=$currency_symbol.$min_amount?></strong></li>
            <?php if ($max_amount > 0): ?>
            <li><?=lang("Maximal_payment")?>: <strong><?=$currency_symbol.$max_amount?></strong></li>
            <?php endif; ?>
            <?php if (!$is_direct_charge): ?>
            <li>You will be redirected to LworxPay secure checkout to complete payment.</li>
            <?php else: ?>
            <li>You will receive a payment prompt on your MTN or Airtel phone. Approve it to complete payment.</li>
            <?php endif; ?>
          </ul>
        </div>

        <div class="form-group">
          <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="agree" value="1">
            <span class="custom-control-label text-uppercase"><strong><?=lang("yes_i_understand_after_the_funds_added_i_will_not_ask_fraudulent_dispute_or_chargeback")?></strong></span>
          </label>
        </div>

        <div class="form-actions left">
          <input type="hidden" name="payment_id" value="<?=$payment_id?>">
          <input type="hidden" name="payment_method" value="<?=$type?>">
          <button type="submit" class="btn round btn-primary btn-min-width mr-1 mb-1" style="background:linear-gradient(135deg,#7c3aed,#06b6d4);border:none;">
            <i class="fa fa-lock mr-1"></i> <?=$is_direct_charge ? 'Pay with Mobile Money' : 'Proceed to Checkout'?>
          </button>
        </div>

        <div class="mt-3 text-center">
          <small class="text-muted">
            <i class="fa fa-lock"></i> Secured by LworxPay &nbsp;|&nbsp;
            <?=$is_direct_charge ? 'MTN MoMo &amp; Airtel Money (Uganda)' : 'Cards &bull; Mobile Money &bull; Bank Transfer'?>
          </small>
        </div>
      </div>
    </div>
  </form>
</div>
