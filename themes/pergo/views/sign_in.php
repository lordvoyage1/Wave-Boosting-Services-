<?php include_once 'blocks/head.blade.php'; ?>

<div class="lv-auth-page">
  <div class="lv-auth-box">
    <div class="lv-auth-logo">
      <img src="<?=BASE?>assets/images/logo.png" alt="Loishvizo" class="lv-auth-logo-img">
      <span class="lv-auth-logo-name">Loishvizo</span>
      <span class="lv-auth-logo-sub">Boosting Solutions</span>
    </div>
    <div class="lv-auth-head">
      <div class="lv-auth-title">Welcome Back 👋</div>
      <div class="lv-auth-sub">Login to your dashboard and start boosting</div>
    </div>
    <form class="actionForm" action="<?=cn('auth/ajax_sign_in')?>" data-redirect="<?=cn('statistics')?>" method="POST">
      <?php
        $cookie_email = '';
        $cookie_pass = '';
        if(isset($_COOKIE['cookie_email'])) $cookie_email = encrypt_decode($_COOKIE['cookie_email']);
        if(isset($_COOKIE['cookie_pass'])) $cookie_pass = encrypt_decode($_COOKIE['cookie_pass']);
      ?>
      <div class="lv-field">
        <label>Email Address</label>
        <div class="lv-field-icon">
          <i class="fa fa-envelope"></i>
          <input type="email" class="lv-input" name="email" placeholder="your@email.com" value="<?=htmlspecialchars($cookie_email)?>" required>
        </div>
      </div>
      <div class="lv-field">
        <label>Password</label>
        <div class="lv-field-icon">
          <i class="fa fa-lock"></i>
          <input type="password" class="lv-input" name="password" placeholder="••••••••" value="<?=htmlspecialchars($cookie_pass)?>" required>
        </div>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px">
        <div class="lv-check-row" style="margin-bottom:0">
          <input type="checkbox" name="remember" id="rememberMe" <?=!empty($cookie_email)?'checked':''?>>
          <label for="rememberMe"><?=lang('remember_me')?></label>
        </div>
        <a href="<?=cn('auth/forgot_password')?>" class="lv-auth-forgot" style="display:inline;margin:0"><?=lang('forgot_password')?></a>
      </div>
      <?php if(get_option('enable_goolge_recapcha') && get_option('google_capcha_site_key')):?>
      <div class="g-recaptcha" data-sitekey="<?=get_option('google_capcha_site_key')?>" style="margin-bottom:14px"></div>
      <?php endif;?>
      <button type="submit" class="lv-btn-auth btn-submit">⚡ Login to Dashboard</button>
    </form>
    <?php if(!get_option('disable_signup_page')):?>
    <div class="lv-auth-or">or</div>
    <a href="<?=cn('auth/signup')?>" class="lv-btn-auth" style="display:block;text-align:center;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);box-shadow:none">Create Free Account 🚀</a>
    <?php endif;?>
    <div class="lv-auth-bottom" style="margin-top:18px">
      <a href="<?=cn()?>" class="lv-auth-back"><i class="fa fa-arrow-left"></i> Back to Home</a>
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
