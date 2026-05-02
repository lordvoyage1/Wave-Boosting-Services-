    <?php if($display_html){?>
    <div class="footer footer_top dark">
      <div class="container m-t-60 m-b-50">
        <div class="row">
          <div class="col-lg-12">
            <div class="site-logo m-b-30">
              <a href="<?=cn()?>" class="m-r-20">
                <img src="<?=get_option('website_logo_white', BASE."assets/images/wave-logo-white.svg")?>" alt="Website logo">
              </a>
              <?php
                $redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              ?>
              <?php 
                if (!empty($languages)) {
              ?>
              <select class="footer-lang-selector ajaxChangeLanguage" name="ids" data-url="<?=cn('language/set_language/')?>" data-redirect="<?=$redirect?>">
                <?php 
                  foreach ($languages as $key => $row) {
                ?>
                <option value="<?=$row->ids?>" <?=(!empty($lang_current) && $lang_current->code == $row->code) ? 'selected' : '' ?> ><?=language_codes($row->code)?></option>
                <?php }?>
              </select>
              <?php }?>
            </div>
          </div>
          <div class="col-lg-8 m-t-30  mt-lg-0">
            <h4 class="title"><?=lang("Quick_links")?></h4>
            <div class="row">
              <div class="col-6 col-md-3  mt-lg-0">
                <ul class="list-unstyled quick-link mb-0">
                  <li><a href="<?=cn()?>"><?=lang("Home")?></a></li>
                  <?php 
                    if (!session('uid')) {
                  ?>
                  <li><a href="<?=cn('auth/login')?>"><?=lang("Login")?></a></li>
                  <li><a href="<?=cn('auth/signup')?>"><?=lang("Sign_Up")?></a></li>
                  <?php }else{?>
                  <li><a href="<?=cn('services')?>"><?=lang("Services")?></a></li>
                  <li><a href="<?=cn('tickets')?>"><?=lang("Tickets")?></a></li>  
                  <?php }?>
                </ul>
              </div>
              <div class="col-6 col-md-3">
                <ul class="list-unstyled quick-link mb-0">
                  <li><a href="<?=cn('terms')?>"><?=lang("terms__conditions")?></a></li>
                  <?php 
                    if (get_option('is_cookie_policy_page')) {
                  ?>
                  <li><a href="<?=cn('cookie-policy')?>"><?=lang("Cookie_Policy")?></a></li>
                  <?php }?>
                  <?php 
                    if (get_option('enable_api_tab')) {
                  ?>
                  <li><a href="<?=cn('api/docs')?>"><?=lang("api_documentation")?></a></li>
                  <?php }?>
                  <li><a href="<?=cn('faq')?>"><?=lang("FAQs")?></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-4 m-t-30 mt-lg-0">
            <h4 class="title"><?=lang("contact_informations")?></h4>
            <ul class="list-unstyled">
              <li><i class="fa fa-envelope mr-1"></i> <a href="mailto:delostvoyage@gmail.com" style="color:inherit;">delostvoyage@gmail.com</a></li>
              <li class="mt-2"><strong>Follow Us:</strong></li>
              <li class="mt-1" style="display:flex;gap:8px;flex-wrap:wrap;">
                <a href="https://www.tiktok.com/@itsmeddy?_r=1&_t=ZS-95zn8eiI69V" target="_blank" class="btn btn-icon" style="background:#000;color:#fff;width:34px;height:34px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;" title="TikTok">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.72a8.17 8.17 0 004.77 1.52V6.79a4.85 4.85 0 01-1-.1z"/></svg>
                </a>
                <a href="https://www.youtube.com/@Wave-platfoms" target="_blank" class="btn btn-icon btn-youtube" style="width:34px;height:34px;border-radius:50%;" title="YouTube"><i class="fa fa-youtube-play"></i></a>
                <a href="https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30" target="_blank" class="btn btn-icon" style="background:#25d366;color:#fff;width:34px;height:34px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
                <a href="mailto:delostvoyage@gmail.com" class="btn btn-icon" style="background:#7c3aed;color:#fff;width:34px;height:34px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;" title="Email"><i class="fa fa-envelope"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer footer_bottom dark">
      <div class="container">
        <div class="row align-items-center flex-row-reverse">
          <div class="col-auto ml-lg-auto">
            <div class="row align-items-center">
              <div class="col-auto">
                <ul class="list-inline mb-0">
                  <li class="list-inline-item">
                    <a href="https://www.tiktok.com/@itsmeddy?_r=1&_t=ZS-95zn8eiI69V" target="_blank" class="btn btn-icon" style="background:#000;color:#fff;" title="TikTok">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.72a8.17 8.17 0 004.77 1.52V6.79a4.85 4.85 0 01-1-.1z"/></svg>
                    </a>
                  </li>
                  <li class="list-inline-item"><a href="https://www.youtube.com/@Wave-platfoms" target="_blank" class="btn btn-icon btn-youtube" title="YouTube"><i class="fa fa-youtube-play"></i></a></li>
                  <li class="list-inline-item"><a href="https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30" target="_blank" class="btn btn-icon" style="background:#25d366;color:#fff;" title="WhatsApp"><i class="fa fa-whatsapp"></i></a></li>
                  <li class="list-inline-item"><a href="mailto:delostvoyage@gmail.com" class="btn btn-icon" style="background:#7c3aed;color:#fff;" title="Email"><i class="fa fa-envelope"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          
          <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
            <?=get_option('copy_right_content', "Copyright &copy; 2025 Wave Platforms, Inc. All Rights Reserved.")?>
          </div>
        </div>
      </div>
    </footer>
    <?php }?>
    
    <script src="<?=BASE?>assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="<?=BASE?>assets/js/vendors/jquery.sparkline.min.js"></script>
    <script src="<?=BASE?>assets/js/core.js"></script>
    <script type="text/javascript" src="<?=BASE?>assets/plugins/jquery-toast/js/jquery.toast.js"></script>
    <script src="<?=BASE?>themes/pergo/assets/plugins/aos/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <?php  if(segment(1) != 'auth'){?>
    <!-- theme Js -->
    <script src="<?=BASE?>themes/pergo/assets/js/theme.js"></script>
    <?php } ?>
    <!-- Script js -->
    <script src="<?=BASE?>assets/js/process.js"></script>
    <script src="<?=BASE?>assets/js/general.js"></script>
    <?=htmlspecialchars_decode(get_option('embed_javascript', ''), ENT_QUOTES)?>
    <script>
      $(document).ready(function(){
        var is_notification_popup = "<?=get_option('enable_notification_popup', 0)?>"
        setTimeout(function(){
            if (is_notification_popup == 1) {
              $("#notification").modal('show');
            }else{
              $("#notification").modal('hide');
            }
        },500);
     });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </body>
</html>