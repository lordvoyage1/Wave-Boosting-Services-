    <?php if($display_html){?>

    <!-- LOISHVIZO FOOTER -->
    <footer class="lv-site-footer">
      <div class="lv-container">
        <div class="lv-footer-grid">

          <!-- Brand Column -->
          <div>
            <div class="lv-footer-brand-logo">
              <img src="<?=get_option('website_logo', BASE.'assets/images/logo.png')?>" alt="Loishvizo">
              <span class="lv-footer-brand-name">Loishvizo</span>
            </div>
            <p class="lv-footer-brand-desc">The ultra speed social media boosting panel. Grow TikTok, Instagram, YouTube, Spotify and 15+ more platforms instantly.</p>
            <div class="lv-footer-socials">
              <a href="https://www.tiktok.com/@itsmeddy?_r=1&_t=ZS-95zn8eiI69V" target="_blank" class="lv-footer-soc" title="TikTok">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.72a8.17 8.17 0 004.77 1.52V6.79a4.85 4.85 0 01-1-.1z"/></svg>
              </a>
              <a href="https://www.youtube.com/@loishvizo" target="_blank" class="lv-footer-soc" title="YouTube"><i class="fa fa-youtube-play"></i></a>
              <a href="https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30" target="_blank" class="lv-footer-soc" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
              <a href="mailto:delostvoyage@gmail.com" class="lv-footer-soc" title="Email"><i class="fa fa-envelope"></i></a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <div class="lv-footer-col-title">Quick Links</div>
            <ul class="lv-footer-links">
              <li><a href="<?=cn()?>">Home</a></li>
              <li><a href="#platforms">Platforms</a></li>
              <?php if(!session('uid')):?>
              <li><a href="<?=cn('auth/login')?>">Login</a></li>
              <li><a href="<?=cn('auth/signup')?>">Sign Up Free</a></li>
              <?php else:?>
              <li><a href="<?=cn('new_order')?>">New Order</a></li>
              <li><a href="<?=cn('services')?>">Services</a></li>
              <?php endif;?>
              <li><a href="#faq">FAQ</a></li>
            </ul>
          </div>

          <!-- Support -->
          <div>
            <div class="lv-footer-col-title">Support</div>
            <ul class="lv-footer-links">
              <li><a href="<?=cn('tickets')?>">Submit Ticket</a></li>
              <li><a href="<?=cn('terms')?>">Terms &amp; Conditions</a></li>
              <?php if(get_option('is_cookie_policy_page')):?>
              <li><a href="<?=cn('cookie-policy')?>">Cookie Policy</a></li>
              <?php endif;?>
              <?php if(get_option('enable_api_tab')):?>
              <li><a href="<?=cn('api/docs')?>">API Documentation</a></li>
              <?php endif;?>
            </ul>
          </div>

          <!-- Contact -->
          <div>
            <div class="lv-footer-col-title">Contact Info</div>
            <div class="lv-footer-contact">
              <div class="lv-footer-contact-item">
                <i class="fa fa-envelope"></i>
                <a href="mailto:delostvoyage@gmail.com">delostvoyage@gmail.com</a>
              </div>
              <div class="lv-footer-contact-item">
                <i class="fa fa-clock-o"></i>
                <span>Support available 24/7 via ticket system</span>
              </div>
              <div class="lv-footer-contact-item">
                <i class="fa fa-bolt"></i>
                <span>Average response time: under 30 minutes</span>
              </div>
            </div>
          </div>

        </div>

        <!-- Bottom Bar -->
        <div class="lv-footer-bottom">
          <span class="lv-footer-copy"><?=get_option('copy_right_content', 'Copyright &copy; '.date('Y').' Loishvizo Boosting Solutions. All Rights Reserved.')?></span>
          <div class="lv-footer-legal">
            <a href="<?=cn('terms')?>">Terms of Service</a>
            <?php if(get_option('is_cookie_policy_page')):?>
            <a href="<?=cn('cookie-policy')?>">Privacy Policy</a>
            <?php endif;?>
          </div>
        </div>
      </div>
    </footer>

    <script src="<?=BASE?>assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="<?=BASE?>assets/js/vendors/jquery.sparkline.min.js"></script>
    <script src="<?=BASE?>assets/js/core.js"></script>
    <script type="text/javascript" src="<?=BASE?>assets/plugins/jquery-toast/js/jquery.toast.js"></script>
    <?php if(segment(1) != 'auth'):?>
    <script src="<?=BASE?>themes/pergo/assets/js/theme.js"></script>
    <?php endif;?>
    <script src="<?=BASE?>assets/js/process.js"></script>
    <script src="<?=BASE?>assets/js/general.js"></script>
    <?=htmlspecialchars_decode(get_option('embed_javascript', ''), ENT_QUOTES)?>
    <script>
      $(document).ready(function(){
        var is_notification_popup = "<?=get_option('enable_notification_popup', 0)?>";
        setTimeout(function(){
          if(is_notification_popup == 1){
            $("#notification").modal('show');
          } else {
            $("#notification").modal('hide');
          }
        }, 500);
      });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </body>
</html>
    <?php }?>
