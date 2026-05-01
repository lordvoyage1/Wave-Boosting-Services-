    <?php 
      include_once 'blocks/head.blade.php';
    ?>
    <header class="header fixed-top" id="headerNav">
      <div class="container">
        <nav class="navbar navbar-expand-lg ">
          <a class="navbar-brand" href="#">
            <img class="site-logo d-none" src="<?=get_option('website_logo', BASE."assets/images/logo.png")?>" alt="Webstie logo">
            <img class="site-logo-white" src="<?=get_option('website_logo_white', BASE."assets/images/logo-white.png")?>" alt="Webstie logo">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="fe fe-menu"></i></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item active">
                <a class="nav-link js-scroll-trigger" href="#home"><?=lang("Home")?></a>
              </li>

              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#features"><?=lang("What_we_offer")?></a>
              </li>

              <?php
                if (get_option("enable_service_list_no_login") == 1) {
              ?>
              <li class="nav-item">
                <a class="nav-link" href="<?=cn("services")?>"><?=lang("Services")?></a>
              </li>
              <?php }?>

            </ul> 
            <div class="nav-item d-md-flex btn-login-signup">
              <?php 
                if (!session('uid')) {
              ?>
              <a class="link btn-login" href="<?=cn('auth/login')?>"><?=lang("Login")?></a>
              <?php if(!get_option('disable_signup_page')){ ?>
              <a href="<?=cn('auth/signup')?>" class="btn btn-pill btn-outline-primary sign-up"><?=lang("Sign_Up")?></a>
              <?php }; ?>
              <?php }else{?>
              <a href="<?=cn('statistics')?>" class="btn btn-pill btn-outline-primary btn-statistics text-uppercase"><?=lang("statistics")?></a>
              <?php }?>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <section class="banner wave-hero-banner" id="home" style="background-image: url('<?=BASE?>assets/images/wave_hero.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
      <div class="wave-hero-overlay"></div>
      <div class="container" style="position: relative; z-index: 2;">
        <div class="row align-items-center">
          <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
            <div class="contents">
              <div class="wave-brand-badge mb-3">
                <span class="badge-wave">&#9651; WAVE BOOSTING SERVICES</span>
              </div>
              <h2 class="head-title wave-title">
                Boost Your Social Media <span class="text-wave-accent">Instantly</span>
              </h2>
              <p class="wave-subtitle">
                Get real followers, likes, views and engagement for TikTok, YouTube, Instagram, Facebook and more — fast, affordable and reliable.
              </p>
              <div class="head-button m-t-40 wave-buttons">
                <a href="<?=cn('auth/signup')?>" class="btn btn-wave-primary btn-lg mr-3"><?=lang("get_start_now")?></a>
                <a href="<?=cn('auth/login')?>" class="btn btn-wave-outline btn-lg"><?=lang("Login")?></a>
              </div>
              <div class="wave-stats mt-4">
                <div class="wave-stat-item"><span class="wave-stat-num">10K+</span><span class="wave-stat-label">Happy Clients</span></div>
                <div class="wave-stat-item"><span class="wave-stat-num">500+</span><span class="wave-stat-label">Services</span></div>
                <div class="wave-stat-item"><span class="wave-stat-num">24/7</span><span class="wave-stat-label">Support</span></div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 text-center mt-4 mt-lg-0">
            <div class="wave-orb-container">
              <img class="wave-orb-img" src="<?=BASE?>assets/images/wave_hero.jpg" alt="Wave Boosting Services - Energy Sphere">
              <div class="wave-orb-glow"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <style>
    .wave-hero-banner { position: relative; min-height: 700px; padding: 160px 0 120px; }
    .wave-hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(10,5,30,0.92) 0%, rgba(30,10,70,0.85) 50%, rgba(10,5,30,0.92) 100%); z-index: 1; }
    .wave-brand-badge .badge-wave { background: linear-gradient(90deg, #7c3aed, #06b6d4); color: #fff; padding: 6px 18px; border-radius: 50px; font-size: 12px; letter-spacing: 2px; font-weight: 700; }
    .wave-title { font-size: 48px !important; line-height: 1.2 !important; }
    .text-wave-accent { background: linear-gradient(90deg, #7c3aed, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .wave-subtitle { font-size: 16px; color: rgba(255,255,255,0.85) !important; line-height: 1.8; max-width: 520px; }
    .btn-wave-primary { background: linear-gradient(135deg, #7c3aed, #06b6d4); border: none; color: #fff; padding: 14px 35px; border-radius: 50px; font-weight: 700; box-shadow: 0 8px 30px rgba(124,58,237,0.5); transition: all 0.3s; }
    .btn-wave-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(124,58,237,0.7); color: #fff; }
    .btn-wave-outline { background: transparent; border: 2px solid rgba(124,58,237,0.7); color: #fff; padding: 14px 35px; border-radius: 50px; font-weight: 700; transition: all 0.3s; }
    .btn-wave-outline:hover { background: rgba(124,58,237,0.2); border-color: #06b6d4; color: #fff; }
    .wave-stats { display: flex; gap: 30px; flex-wrap: wrap; }
    .wave-stat-item { display: flex; flex-direction: column; }
    .wave-stat-num { font-size: 28px; font-weight: 800; background: linear-gradient(90deg, #7c3aed, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .wave-stat-label { font-size: 12px; color: rgba(255,255,255,0.6); letter-spacing: 1px; }
    .wave-orb-container { position: relative; display: inline-block; }
    .wave-orb-img { width: 380px; max-width: 100%; border-radius: 50%; box-shadow: 0 0 60px rgba(124,58,237,0.8), 0 0 120px rgba(6,182,212,0.4); animation: waveFloat 4s ease-in-out infinite; }
    .wave-orb-glow { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 420px; height: 420px; border-radius: 50%; background: radial-gradient(circle, rgba(124,58,237,0.3) 0%, transparent 70%); animation: waveGlow 4s ease-in-out infinite; }
    @keyframes waveFloat { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-20px)} }
    @keyframes waveGlow { 0%,100%{opacity:0.5;transform:translate(-50%,-50%) scale(1)} 50%{opacity:1;transform:translate(-50%,-50%) scale(1.15)} }
    @media(max-width:768px) { .wave-title{font-size:32px!important} .wave-orb-img{width:240px} .wave-buttons .btn{margin-bottom:10px} }
    </style>
    
    <section class="core-services">
    </section>

    <section class="about-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12" data-aos="fade-left" data-aos-easing="ease-in" data-aos-delay="200">
            <div class="intro-img">
              <img class="img-fluid" src="<?=BASE?>themes/pergo/assets/images/best_service.png" alt="">
            </div>
          </div>

          <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12" data-aos="fade-right" data-aos-easing="ease-in" data-aos-delay="200">
            <div class="contents">
              <h2 class="head-title">
                <?=lang("best_smm_marketing_services")?>
              </h2>
              <p>
                <?=lang("best_smm_marketing_services_desc")?>
              </p>
              <div class="head-button">
                <a href="<?=cn('auth/signup')?>" class="btn btn-pill btn-signin btn-gradient btn-lg"><?=lang("get_start_now")?></a>
              </div>
            </div>
          </div>          
        </div>
      </div>
    </section>

    <section class="our-services text-center" id="features">
      <div class="container">
        <div class="row" >
          <div class="col-md-12 mx-auto" data-aos="fade-down" data-aos-easing="ease-in" data-aos-delay="200">
            <div class="contents">
              <div class="head-title">
                <?=lang("What_we_offer")?>
              </div>
              <div class="border-line">
                <hr>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-right" data-aos-easing="ease-in" data-aos-delay="400">
            <div class="feature-item">
              <div class="animation-box">
                <i class="fe fe-calendar icon"></i>
              </div>
              <h3><?=lang("Resellers")?></h3>
              <p class="text-muted"><?=lang("you_can_resell_our_services_and_grow_your_profit_easily_resellers_are_important_part_of_smm_panel")?>
              </p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-right" data-aos-easing="ease-in" data-aos-delay="600">
            <div class="feature-item">
              <div class="animation-box">
                <i class="fe fe-phone-call icon"></i>
              </div>
              <h3><?=lang("Supports")?></h3>
              <p class="text-muted"><?=lang("technical_support_for_all_our_services_247_to_help_you")?></p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-right" data-aos-easing="ease-in" data-aos-delay="800">
            <div class="feature-item">
              <div class="animation-box">
                <i class="fe fe-star icon"></i>
              </div>
              
              <h3><?=lang("high_quality_services")?></h3>
              <p class="text-muted"><?=lang("get_the_best_high_quality_services_and_in_less_time_here")?></p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-right" data-aos-easing="ease-in" data-aos-delay="1000">
            <div class="feature-item">
              <div class="animation-box">
                <i class="fe fe-upload-cloud icon"></i>
              </div>
              <h3><?=lang("Updates")?></h3>
              <p class="text-muted"><?=lang("services_are_updated_daily_in_order_to_be_further_improved_and_to_provide_you_with_best_experience")?></p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-right" data-aos-easing="ease-in" data-aos-delay="1200">
            <div class="feature-item">
              <div class="animation-box">
                <i class="fe fe-share-2 icon"></i>
              </div>
              <h3><?=lang("api_support")?></h3>
              <p class="text-muted"><?=lang("we_have_api_support_for_panel_owners_so_you_can_resell_our_services_easily")?></p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-right" data-aos-easing="ease-in" data-aos-delay="1400">
            <div class="feature-item">
              <div class="animation-box">
                <i class="fe fe-dollar-sign icon"></i>
              </div>
              <h3><?=lang("secure_payments")?></h3>
              <p class="text-muted"><?=lang("we_have_a_popular_methods_as_paypal_and_many_more_can_be_enabled_upon_request")?></p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="reviews text-center">
      <div class="container">
        <div class="row " data-aos="fade-down" data-aos-easing="ease-in" data-aos-delay="200">
          <div class="col-md-12 mx-auto">
            <div class="contents">
              <div class="head-title">
                <?=lang("what_people_say_about_us")?>
              </div>
              <span class="text-muted"><?=lang("our_service_has_an_extensive_customer_roster_built_on_years_worth_of_trust_read_what_our_buyers_think_about_our_range_of_service")?></span>
              <div class="border-line">
                <hr>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card item">
              <div class="person-info">
                <h3 class="name"><?=lang("client_one")?></h3>
                <span class="text-muted"><?=lang("client_one_jobname")?></span>
              </div>
              <div class="card-body">
                <p class="desc">
                  <?=lang('client_one_comment')?>
                </p>
                <div class="star-icon">
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card item">
              <div class="person-info">
                <h3 class="name"><?=lang('client_two')?></h3>
                <span class="text-muted"><?=lang('client_two_jobname')?></span>
              </div>
              <div class="card-body">
                <p class="desc">
                  <?=lang('client_two_comment')?>
                </p>
                <div class="star-icon">
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                </div>
              </div>
            </div>
          </div>          
          <div class="col-md-4">
            <div class="card item">
              <div class="person-info">
                <h3 class="name"><?=lang('client_three')?></h3>
                <span class="text-muted"><?=lang('client_three_jobname')?></span>
              </div>
              <div class="card-body">
                <p class="desc">
                  <?=lang('client_three_comment')?>
                  
                </p>
                <div class="star-icon">
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                  <span><i class="fa fa-star"></i></span>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="section-3 subscribe-form">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <form class="form actionFormWithoutToast" action="<?php echo cn("client/subscriber"); ?>" data-redirect="<?php echo cn(); ?>" method="POST">
              <div class="content text-center">
                <h1 class="title"><?php echo lang("newsletter"); ?></h1>
                <p><?php echo lang("fill_in_the_ridiculously_small_form_below_to_receive_our_ridiculously_cool_newsletter"); ?></p>
              </div>
              <div class="input-group">
                <input type="email" name="email" class="form-control email" placeholder="Enter Your email" required>
                <button class="input-group-append btn btn-pill btn-gradient btn-signin btn-submit" type="submit">
                  <?php echo lang("subscribe_now"); ?>
                </button>
              </div>
              <div class="form-group m-t-20">
                <div id="alert-message" class="alert-message-reponse"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <div class="modal-infor">
      <div class="modal" id="notification">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title"><i class="fe fe-bell"></i> <?=lang("Notification")?></h4>
              <button type="button" class="close" data-dismiss="modal"></button>
            </div>

            <div class="modal-body">
              <?=get_option('notification_popup_content')?>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><?=lang("Close")?></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer footer_top dark">
      <div class="container m-t-60 m-b-50">
        <div class="row">
          <div class="col-lg-12">
            <div class="site-logo m-b-30">
              <a href="<?=cn()?>" class="m-r-20">
                <img src="<?=get_option('website_logo_white', BASE."assets/images/logo-white.png")?>" alt="Website logo">
              </a>
              <?php
                $redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              ?>
              <?php 
                if (!empty($languages)) {
              ?>
              <select class="footer-lang-selector ajaxChangeLanguage" name="ids" data-url="<?=cn('set-language')?>" data-redirect="<?=$redirect?>">
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
            <ul class="list-unstyled wave-contact-list">
              <li><i class="fa fa-envelope mr-2"></i> <a href="mailto:delostvoyage@gmail.com" style="color:inherit;">delostvoyage@gmail.com</a></li>
              <li class="mt-2"><strong>Follow &amp; Connect:</strong></li>
              <li class="mt-2 wave-social-icons">
                <a href="https://www.tiktok.com/@itsmeddy?_r=1&_t=ZS-95zn8eiI69V" target="_blank" class="wave-social-btn wave-tiktok" title="TikTok">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.72a8.17 8.17 0 004.77 1.52V6.79a4.85 4.85 0 01-1-.1z"/></svg>
                </a>
                <a href="https://www.youtube.com/@Wave-platfoms" target="_blank" class="wave-social-btn wave-youtube" title="YouTube">
                  <i class="fa fa-youtube-play"></i>
                </a>
                <a href="https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30" target="_blank" class="wave-social-btn wave-whatsapp" title="WhatsApp">
                  <i class="fa fa-whatsapp"></i>
                </a>
                <a href="mailto:delostvoyage@gmail.com" class="wave-social-btn wave-email" title="Email">
                  <i class="fa fa-envelope"></i>
                </a>
              </li>
            </ul>
          </div>
          <style>
          .wave-social-icons { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
          .wave-social-btn { display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 50%; font-size: 16px; color: #fff; text-decoration: none; transition: all 0.3s; }
          .wave-tiktok { background: #000; }
          .wave-tiktok:hover { background: #111; transform: translateY(-3px); color: #fff; }
          .wave-youtube { background: #ff0000; }
          .wave-youtube:hover { background: #cc0000; transform: translateY(-3px); color: #fff; }
          .wave-whatsapp { background: #25d366; }
          .wave-whatsapp:hover { background: #1da851; transform: translateY(-3px); color: #fff; }
          .wave-email { background: #7c3aed; }
          .wave-email:hover { background: #6d28d9; transform: translateY(-3px); color: #fff; }
          .wave-contact-list li { color: rgba(255,255,255,0.85); }
          </style>
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
                  <li class="list-inline-item">
                    <a href="https://www.youtube.com/@Wave-platfoms" target="_blank" class="btn btn-icon btn-youtube" title="YouTube">
                      <i class="fa fa-youtube-play"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30" target="_blank" class="btn btn-icon" style="background:#25d366;color:#fff;" title="WhatsApp">
                      <i class="fa fa-whatsapp"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="mailto:delostvoyage@gmail.com" class="btn btn-icon" style="background:#7c3aed;color:#fff;" title="Email">
                      <i class="fa fa-envelope"></i>
                    </a>
                  </li>
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

    <?php 
      include_once 'blocks/script.blade.php';
    ?>