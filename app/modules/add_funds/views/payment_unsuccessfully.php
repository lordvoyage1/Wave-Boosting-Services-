<div class="d-page-header">
  <h1><i class="fe fe-alert-triangle" style="color:#ef4444"></i> Payment Failed</h1>
</div>

<div style="max-width:520px;margin:0 auto">
  <div class="d-card">
    <div class="d-card-body" style="text-align:center;padding:40px 30px">
      <div style="width:72px;height:72px;border-radius:50%;background:#fef2f2;border:2px solid #fecaca;display:flex;align-items:center;justify-content:center;margin:0 auto 18px">
        <i class="fe fe-alert-triangle" style="font-size:36px;color:#ef4444"></i>
      </div>
      <h2 style="color:var(--d-navy);font-size:22px;font-weight:800;margin-bottom:8px">Payment Unsuccessful</h2>
      <p style="color:var(--d-muted);font-size:14px;margin-bottom:24px">
        Sorry, your payment could not be processed. No charges were made to your account.
        Please try again or contact support if the issue persists.
      </p>
      <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
        <a href="<?=cn('add_funds')?>" class="d-btn d-btn-primary">
          <i class="fe fe-refresh-cw"></i> Try Again
        </a>
        <a href="<?=cn('tickets')?>" class="d-btn d-btn-outline">
          <i class="fe fe-message-circle"></i> Contact Support
        </a>
      </div>
    </div>
  </div>
</div>
