<?php include_once 'blocks/head.blade.php'; ?>

<div class="lv-auth-page">
  <div class="lv-auth-box" style="text-align:center;max-width:500px">
    <div class="lv-auth-logo">
      <img src="<?=BASE?>assets/images/logo.png" alt="Loishvizo" class="lv-auth-logo-img">
      <span class="lv-auth-logo-name">Loishvizo</span>
      <span class="lv-auth-logo-sub">Boosting Solutions</span>
    </div>
    <div style="font-size:56px;margin:20px 0">🎉</div>
    <h2 style="font-size:22px;font-weight:900;color:#fff;margin-bottom:10px"><?=lang('congratulations_your_registration_is_now_complete')?></h2>
    <p style="font-size:14px;color:rgba(255,255,255,.5);line-height:1.7;margin-bottom:28px"><?=lang('congratulations_desc')?></p>
    <a href="<?=cn('auth/login')?>" class="lv-btn-auth" style="display:block">🚀 <?=lang('get_start_now')?></a>
    <div class="lv-auth-bottom" style="margin-top:16px">
      <a href="<?=cn()?>">← Back to Home</a>
    </div>
  </div>
</div>

<script src="<?=BASE?>assets/js/vendors/bootstrap.bundle.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-toast/js/jquery.toast.js"></script>
<script src="<?=BASE?>assets/js/process.js"></script>
<script src="<?=BASE?>assets/js/general.js"></script>
</body></html>
