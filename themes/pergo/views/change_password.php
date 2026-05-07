<?php include_once 'blocks/head.blade.php'; ?>

<div class="lv-auth-page">
  <div class="lv-auth-box">
    <div class="lv-auth-logo">
      <img src="<?=BASE?>assets/images/logo.png" alt="Loishvizo" class="lv-auth-logo-img">
      <span class="lv-auth-logo-name">Loishvizo</span>
      <span class="lv-auth-logo-sub">Boosting Solutions</span>
    </div>
    <div class="lv-auth-head">
      <div class="lv-auth-title">Set New Password 🔒</div>
      <div class="lv-auth-sub">Choose a strong password for your account</div>
    </div>
    <form class="actionForm" action="<?=cn('auth/ajax_reset_password/'.$reset_key)?>" data-redirect="<?=cn('auth/login')?>" method="POST">
      <div class="lv-field">
        <label><?=lang('new_password')?></label>
        <div class="lv-field-icon">
          <i class="fa fa-lock"></i>
          <input type="password" class="lv-input" name="password" placeholder="<?=lang('new_password')?>" required>
        </div>
      </div>
      <div class="lv-field">
        <label><?=lang('Confirm_password')?></label>
        <div class="lv-field-icon">
          <i class="fa fa-lock"></i>
          <input type="password" class="lv-input" name="re_password" placeholder="<?=lang('Confirm_password')?>" required>
        </div>
      </div>
      <button type="submit" class="lv-btn-auth btn-submit"><?=lang('Submit')?></button>
    </form>
    <div class="lv-auth-bottom">
      <a href="<?=cn('auth/login')?>">← Back to Login</a>
    </div>
  </div>
</div>

<script src="<?=BASE?>assets/js/vendors/bootstrap.bundle.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-toast/js/jquery.toast.js"></script>
<script src="<?=BASE?>assets/js/process.js"></script>
<script src="<?=BASE?>assets/js/general.js"></script>
</body></html>
