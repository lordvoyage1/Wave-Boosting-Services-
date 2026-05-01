<?php
  $status_labels = [
    'pending'   => ['label' => 'Pending', 'color' => '#f59e0b', 'icon' => 'fa-clock-o'],
    'processing'=> ['label' => 'Processing', 'color' => '#3b82f6', 'icon' => 'fa-spinner fa-spin'],
    'completed' => ['label' => 'Completed', 'color' => '#10b981', 'icon' => 'fa-check-circle'],
    'failed'    => ['label' => 'Failed', 'color' => '#ef4444', 'icon' => 'fa-times-circle'],
  ];
  $current_status = isset($status_labels[$status]) ? $status_labels[$status] : $status_labels['pending'];
?>
<section class="add-funds m-t-30">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card text-center">
          <div class="card-body p-5">
            <div style="font-size:60px;color:<?=$current_status['color']?>;margin-bottom:20px;">
              <i class="fa <?=$current_status['icon']?>"></i>
            </div>
            <h3>Payment <?=$current_status['label']?></h3>
            <p class="text-muted" id="status-message">
              <?php if ($status == 'pending' || $status == 'processing'): ?>
                Your mobile money payment is being processed. Please check your phone and approve the payment prompt from MTN or Airtel.<br>
                <small>This page will refresh automatically...</small>
              <?php elseif ($status == 'completed'): ?>
                Your payment was successful! Your account balance has been updated.
              <?php else: ?>
                Payment could not be processed. Please try again or use a different payment method.
              <?php endif; ?>
            </p>

            <?php if ($status == 'pending' || $status == 'processing'): ?>
            <div class="alert alert-info mt-3">
              <i class="fa fa-mobile mr-2"></i> Check your phone for the mobile money prompt and approve the payment.
            </div>
            <div class="progress mt-3" style="height: 6px;">
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%;background:linear-gradient(90deg,#7c3aed,#06b6d4)"></div>
            </div>
            <script>
              setTimeout(function() {
                window.location.reload();
              }, 5000);
            </script>
            <?php elseif ($status == 'completed'): ?>
            <a href="<?=cn('add_funds/success')?>" class="btn btn-success mt-3 btn-lg">View Receipt</a>
            <?php else: ?>
            <a href="<?=cn('add_funds')?>" class="btn btn-primary mt-3">Try Again</a>
            <?php endif; ?>

            <div class="mt-3">
              <small class="text-muted">Transaction ID: <code><?=$trx_id?></code></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
