<div class="d-page-header">
  <h1><i class="fe fe-check-circle" style="color:#27ae60"></i> Payment Successful</h1>
</div>

<div style="max-width:560px;margin:0 auto">
  <div class="d-card">
    <div class="d-card-body" style="text-align:center;padding:40px 30px">
      <div style="width:72px;height:72px;border-radius:50%;background:#f0fdf4;border:2px solid #bbf7d0;display:flex;align-items:center;justify-content:center;margin:0 auto 18px">
        <i class="fe fe-check-circle" style="font-size:36px;color:#27ae60"></i>
      </div>
      <h2 style="color:var(--d-navy);font-size:22px;font-weight:800;margin-bottom:8px">Payment Received!</h2>
      <p style="color:var(--d-muted);font-size:14px;margin-bottom:24px">
        Your payment has been processed and your account balance has been updated.
      </p>

      <?php if (!empty($transaction)): ?>
      <div style="background:var(--d-bg);border:1px solid var(--d-border);border-radius:12px;padding:20px;text-align:left;margin-bottom:24px">
        <div style="font-size:11px;font-weight:800;color:var(--d-muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:14px">Transaction Details</div>
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--d-border)">
          <span style="color:var(--d-muted);font-size:13px">Transaction ID</span>
          <strong style="color:var(--d-navy);font-size:13px">
            <?=(!empty($transaction->transaction_id) && $transaction->transaction_id == 'empty')
              ? lang('transaction_id_was_sent_to_your_email')
              : esc($transaction->transaction_id)?>
          </strong>
        </div>
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--d-border)">
          <span style="color:var(--d-muted);font-size:13px">Amount Paid</span>
          <strong style="color:#27ae60;font-size:14px"><?=get_option('currency_symbol','$')?><?=!empty($transaction->amount)?number_format((float)$transaction->amount,2):''?> <?=get_option('currency_code','USD')?></strong>
        </div>
        <div style="display:flex;justify-content:space-between;padding:8px 0">
          <span style="color:var(--d-muted);font-size:13px">Payment Method</span>
          <strong style="color:var(--d-navy);font-size:13px;text-transform:capitalize"><?=!empty($transaction->type)?str_replace('_',' ',$transaction->type):''?></strong>
        </div>
      </div>
      <?php endif; ?>

      <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
        <a href="<?=cn('statistics')?>" class="d-btn d-btn-outline">
          <i class="fe fe-home"></i> Dashboard
        </a>
        <a href="<?=cn('order/new_order')?>" class="d-btn d-btn-primary">
          <i class="fe fe-plus"></i> Place New Order
        </a>
      </div>
    </div>
  </div>
</div>
