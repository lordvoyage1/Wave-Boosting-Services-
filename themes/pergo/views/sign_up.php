<?php include_once 'blocks/head.blade.php'; ?>

<div class="lv-auth-page">
  <div class="lv-auth-box" style="max-width:500px">
    <div class="lv-auth-logo">
      <img src="<?=BASE?>assets/images/logo.png" alt="Loishvizo" class="lv-auth-logo-img">
      <span class="lv-auth-logo-name">Loishvizo</span>
      <span class="lv-auth-logo-sub">Boosting Solutions</span>
    </div>
    <div class="lv-auth-head">
      <div class="lv-auth-title">Create Free Account 🚀</div>
      <div class="lv-auth-sub">Join 50,000+ creators and start boosting today</div>
    </div>
    <form class="actionForm" action="<?=cn('auth/ajax_sign_up')?>" data-redirect="<?=cn('statistics')?>" method="POST">
      <div class="lv-field-row">
        <div class="lv-field">
          <label><?=lang('first_name')?></label>
          <div class="lv-field-icon">
            <i class="fa fa-user"></i>
            <input type="text" class="lv-input" name="first_name" placeholder="John" required>
          </div>
        </div>
        <div class="lv-field">
          <label><?=lang('last_name')?></label>
          <div class="lv-field-icon">
            <i class="fa fa-user"></i>
            <input type="text" class="lv-input" name="last_name" placeholder="Doe" required>
          </div>
        </div>
      </div>
      <div class="lv-field">
        <label>Email Address</label>
        <div class="lv-field-icon">
          <i class="fa fa-envelope"></i>
          <input type="email" class="lv-input" name="email" placeholder="your@email.com" required>
        </div>
      </div>
      <?php if(get_option('enable_signup_skype_field')):?>
      <div class="lv-field">
        <label>Skype ID</label>
        <div class="lv-field-icon">
          <i class="fa fa-skype"></i>
          <input type="text" class="lv-input" name="skype_id" placeholder="your.skype.id" required>
        </div>
      </div>
      <?php endif;?>
      <div class="lv-field-row">
        <div class="lv-field">
          <label>Password</label>
          <div class="lv-field-icon">
            <i class="fa fa-lock"></i>
            <input type="password" class="lv-input" name="password" placeholder="Min 6 chars" required>
          </div>
        </div>
        <div class="lv-field">
          <label>Confirm Password</label>
          <div class="lv-field-icon">
            <i class="fa fa-lock"></i>
            <input type="password" class="lv-input" name="re_password" placeholder="Repeat password" required>
          </div>
        </div>
      </div>
      <input type="hidden" name="timezone" id="timezone" value="Africa/Nairobi">
      <div class="lv-check-row">
        <input type="checkbox" name="terms" id="termsCheck" required>
        <label for="termsCheck">I agree to the <a href="<?=cn('terms')?>">Terms of Service</a> and <a href="<?=cn('cookie-policy')?>">Privacy Policy</a></label>
      </div>
      <?php if(get_option('enable_goolge_recapcha') && get_option('google_capcha_site_key')):?>
      <div class="g-recaptcha" data-sitekey="<?=get_option('google_capcha_site_key')?>" style="margin-bottom:14px"></div>
      <?php endif;?>
      <button type="submit" class="lv-btn-auth btn-submit" style="margin-top:8px">🚀 Create My Free Account</button>
    </form>
    <div class="lv-auth-or">or</div>
    <a href="<?=cn('auth/login')?>" class="lv-btn-auth" style="display:block;text-align:center;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);box-shadow:none">Login to Existing Account</a>
    <div class="lv-auth-bottom">
      <a href="<?=cn()?>" class="lv-auth-back"><i class="fa fa-arrow-left"></i> Back to Home</a>
    </div>
  </div>
</div>

<script>
// Auto-detect timezone
try {
  document.getElementById('timezone').value = Intl.DateTimeFormat().resolvedOptions().timeZone || 'Africa/Nairobi';
} catch(e){}
</script>
<script src="<?=BASE?>assets/js/vendors/bootstrap.bundle.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-toast/js/jquery.toast.js"></script>
<script src="<?=BASE?>assets/js/process.js"></script>
<script src="<?=BASE?>assets/js/general.js"></script>
<?php if(get_option('enable_goolge_recapcha') && get_option('google_capcha_site_key')):?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif;?>
</body></html>
