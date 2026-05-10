<?php include_once 'blocks/head.blade.php'; ?>

<div class="lv-auth-page">
  <div class="lv-auth-page-inner">
    <div class="lv-auth-box">
      <div class="lv-auth-logo">
        <img src="<?=get_option('website_logo', BASE.'assets/images/logo.png')?>" alt="Loishvizo" class="lv-auth-logo-img">
        <span class="lv-auth-logo-name">Loishvizo</span>
        <span class="lv-auth-logo-sub">Boosting Solutions</span>
      </div>
      <div class="lv-auth-head">
        <div class="lv-auth-title">Reset Password 🔑</div>
        <div class="lv-auth-sub">Enter your email and we'll send you a reset link</div>
      </div>
      <form class="actionForm" action="<?=cn('auth/ajax_forgot_password')?>" method="POST">
        <div class="lv-field">
          <label>Email Address</label>
          <div class="lv-field-icon">
            <i class="fa fa-envelope"></i>
            <input type="email" class="lv-input" name="email" placeholder="your@email.com" required autofocus>
          </div>
        </div>
        <?php if(get_option('enable_goolge_recapcha') && get_option('google_capcha_site_key')):?>
        <div class="g-recaptcha" data-sitekey="<?=get_option('google_capcha_site_key')?>" style="margin-bottom:14px"></div>
        <?php endif;?>
        <button type="submit" class="lv-btn-auth btn-submit">Send Reset Link</button>
      </form>
      <div class="lv-auth-or">or</div>
      <div class="lv-auth-bottom">
        <a href="<?=cn('auth/login')?>" class="lv-auth-back"><i class="fa fa-arrow-left"></i> Back to Login</a>
        &nbsp;·&nbsp;
        <a href="<?=cn()?>">Home</a>
      </div>
    </div>
  </div>
</div>

<script src="<?=BASE?>assets/js/vendors/bootstrap.bundle.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-toast/js/jquery.toast.js"></script>
<script src="<?=BASE?>assets/js/process.js"></script>
<script src="<?=BASE?>assets/js/general.js"></script>
<?php if(get_option('enable_goolge_recapcha') && get_option('google_capcha_site_key')):?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif;?>
</body></html>
