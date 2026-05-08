<?php include_once 'blocks/head.blade.php'; ?>

<!-- MOBILE SIDEBAR OVERLAY -->
<div class="lv-overlay" id="lvOverlay" onclick="closeMobMenu()"></div>

<!-- MOBILE SIDEBAR -->
<nav class="lv-mobile-nav" id="lvMobNav">
  <div class="lv-mob-header">
    <div class="lv-mob-logo">
      <img src="<?=BASE?>assets/images/logo.png" alt="Loishvizo" height="36">
      <span>Loishvizo</span>
    </div>
    <button class="lv-mob-close" onclick="closeMobMenu()">✕</button>
  </div>
  <div class="lv-mob-links">
    <a href="<?=cn()?>">Home</a>
    <a href="#platforms">Platforms</a>
    <?php if(get_option("enable_service_list_no_login") == 1):?>
    <a href="<?=cn('services')?>">Services</a>
    <?php endif;?>
    <a href="#faq">FAQ</a>
  </div>
  <div class="lv-mob-actions">
    <a href="<?=cn('auth/login')?>" class="lv-mob-btn-login">Login</a>
    <?php if(!get_option('disable_signup_page')):?>
    <a href="<?=cn('auth/signup')?>" class="lv-mob-btn-signup">Sign Up Free</a>
    <?php endif;?>
  </div>
</nav>

<!-- TOP NAVBAR -->
<nav class="lv-navbar" id="lvNavbar">
  <div class="lv-container lv-navbar-inner">
    <a href="<?=cn()?>" class="lv-logo-wrap">
      <img src="<?=BASE?>assets/images/logo.png" alt="Loishvizo" class="lv-logo-img">
      <div class="lv-logo-text">
        <span class="lv-logo-name">Loishvizo</span>
        <span class="lv-logo-tagline">Boosting Solutions</span>
      </div>
    </a>
    <ul class="lv-nav-menu">
      <li><a href="<?=cn()?>" class="active">Home</a></li>
      <li><a href="#platforms">Platforms</a></li>
      <?php if(get_option("enable_service_list_no_login") == 1):?>
      <li><a href="<?=cn('services')?>">Services</a></li>
      <?php endif;?>
      <li><a href="#faq">FAQ</a></li>
    </ul>
    <div class="lv-nav-right">
      <?php if(!session('uid')):?>
      <a href="<?=cn('auth/login')?>" class="lv-btn-ghost">Login</a>
      <?php if(!get_option('disable_signup_page')):?>
      <a href="<?=cn('auth/signup')?>" class="lv-btn-accent">Sign Up Free</a>
      <?php endif;?>
      <?php else:?>
      <a href="<?=cn('statistics')?>" class="lv-btn-accent">Dashboard</a>
      <?php endif;?>
      <button class="lv-hamburger" id="lvHamburger" onclick="openMobMenu()" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

<!-- HERO SECTION -->
<section class="lv-hero-section">
  <div class="lv-hero-bg"></div>
  <div class="lv-container">
    <div class="lv-hero-layout">
      <!-- TEXT SIDE -->
      <div class="lv-hero-text">
        <div class="lv-hero-pill">⚡ Ultra Speed Social Media Boosting</div>
        <h1 class="lv-hero-heading">
          Grow Your<br>
          <span class="lv-gradient-text">Social Media</span><br>
          Faster Than Ever
        </h1>
        <p class="lv-hero-para">
          Loishvizo delivers followers, likes, views and engagement across all major platforms — fast, affordable, and safe.
        </p>
        <div class="lv-hero-cta">
          <?php if(!session('uid')):?>
          <a href="<?=cn('auth/signup')?>" class="lv-btn-main">Get Started Free</a>
          <a href="<?=cn('auth/login')?>" class="lv-btn-sec">Login to Dashboard</a>
          <?php else:?>
          <a href="<?=cn('new_order')?>" class="lv-btn-main">Place New Order</a>
          <a href="<?=cn('services')?>" class="lv-btn-sec">Browse Services</a>
          <?php endif;?>
        </div>
      </div>
      <!-- PLATFORM LOGOS SIDE -->
      <div class="lv-hero-visual">
        <div class="lv-plat-mosaic">
          <div class="lv-pm-card lv-pm-tiktok">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.7a8.27 8.27 0 004.84 1.55V6.79a4.85 4.85 0 01-1.07-.1z"/></svg>
            <span>TikTok</span>
          </div>
          <div class="lv-pm-card lv-pm-instagram">
            <i class="fa fa-instagram"></i>
            <span>Instagram</span>
          </div>
          <div class="lv-pm-card lv-pm-youtube">
            <i class="fa fa-youtube-play"></i>
            <span>YouTube</span>
          </div>
          <div class="lv-pm-card lv-pm-facebook">
            <i class="fa fa-facebook"></i>
            <span>Facebook</span>
          </div>
          <div class="lv-pm-card lv-pm-twitter">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.259 5.631 5.905-5.631zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            <span>X / Twitter</span>
          </div>
          <div class="lv-pm-card lv-pm-spotify">
            <i class="fa fa-spotify"></i>
            <span>Spotify</span>
          </div>
          <div class="lv-pm-card lv-pm-telegram">
            <i class="fa fa-telegram"></i>
            <span>Telegram</span>
          </div>
          <div class="lv-pm-card lv-pm-linkedin">
            <i class="fa fa-linkedin"></i>
            <span>LinkedIn</span>
          </div>
          <div class="lv-pm-card lv-pm-pinterest">
            <i class="fa fa-pinterest"></i>
            <span>Pinterest</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SCROLLING TICKER -->
<div class="lv-ticker-wrap">
  <div class="lv-ticker-scroll">
    <?php $ticks = ['TikTok Followers','Instagram Likes','YouTube Views','Facebook Likes','Twitter/X Followers','Spotify Streams','Telegram Members','LinkedIn Followers','Pinterest Repins','Twitch Followers','Snapchat Views','SoundCloud Plays','Discord Members','WhatsApp Members','Reddit Upvotes']; ?>
    <?php foreach(array_merge($ticks,$ticks) as $t): ?>
    <span class="lv-tick-item">⚡ <?=htmlspecialchars($t)?></span>
    <?php endforeach; ?>
  </div>
</div>

<!-- PLATFORMS SECTION -->
<section class="lv-section" id="platforms">
  <div class="lv-container">
    <div class="lv-sec-head">
      <h2>15+ Platforms. <span class="lv-gradient-text">One Panel.</span></h2>
      <p>Boost your presence on every major social media platform from a single dashboard.</p>
    </div>
    <div class="lv-platforms-grid">
      <?php
      $platforms = [
        ['TikTok',     'lv-p-tiktok',    '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.7a8.27 8.27 0 004.84 1.55V6.79a4.85 4.85 0 01-1.07-.1z"/></svg>', 'Followers · Likes · Views'],
        ['Instagram',  'lv-p-ig',        '<i class="fa fa-instagram fa-lg"></i>', 'Followers · Likes · Reels'],
        ['YouTube',    'lv-p-yt',        '<i class="fa fa-youtube-play fa-lg"></i>', 'Subscribers · Views · Likes'],
        ['Facebook',   'lv-p-fb',        '<i class="fa fa-facebook fa-lg"></i>', 'Likes · Followers · Shares'],
        ['Twitter / X','lv-p-tw',        '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.259 5.631 5.905-5.631zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>', 'Followers · Likes · Retweets'],
        ['Spotify',    'lv-p-sp',        '<i class="fa fa-spotify fa-lg"></i>', 'Streams · Followers · Saves'],
        ['Telegram',   'lv-p-tg',        '<i class="fa fa-telegram fa-lg"></i>', 'Members · Views · Reactions'],
        ['LinkedIn',   'lv-p-li',        '<i class="fa fa-linkedin fa-lg"></i>', 'Followers · Connections'],
        ['Pinterest',  'lv-p-pn',        '<i class="fa fa-pinterest fa-lg"></i>', 'Followers · Repins · Likes'],
        ['Twitch',     'lv-p-twitch',    '<i class="fa fa-twitch fa-lg"></i>', 'Followers · Views · Clips'],
        ['Snapchat',   'lv-p-snap',      '<i class="fa fa-snapchat-ghost fa-lg"></i>', 'Followers · Views'],
        ['SoundCloud', 'lv-p-sc',        '<i class="fa fa-soundcloud fa-lg"></i>', 'Plays · Followers · Likes'],
        ['Discord',    'lv-p-discord',   '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.79 19.79 0 00-4.885-1.515.074.074 0 00-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 00-5.487 0 12.64 12.64 0 00-.617-1.25.077.077 0 00-.079-.037A19.736 19.736 0 003.677 4.37a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057c.002.022.015.043.031.055a19.9 19.9 0 005.993 3.03.078.078 0 00.084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 00-.041-.106 13.107 13.107 0 01-1.872-.892.077.077 0 01-.008-.128 10.2 10.2 0 00.372-.292.074.074 0 01.077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 01.078.01c.12.098.246.198.373.292a.077.077 0 01-.006.127 12.299 12.299 0 01-1.873.892.077.077 0 00-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 00.084.028 19.839 19.839 0 006.002-3.03.077.077 0 00.032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 00-.031-.03z"/></svg>', 'Members · Boosts'],
        ['Reddit',     'lv-p-reddit',    '<i class="fa fa-reddit fa-lg"></i>', 'Upvotes · Followers'],
        ['WhatsApp',   'lv-p-wa',        '<i class="fa fa-whatsapp fa-lg"></i>', 'Channel Members'],
        ['Threads',    'lv-p-threads',   '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.028-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.589 12c.027 3.086.718 5.496 2.057 7.164 1.43 1.783 3.631 2.698 6.54 2.717 2.623-.02 4.358-.631 5.8-2.045 1.647-1.613 1.618-3.593 1.09-4.798-.31-.71-.873-1.3-1.634-1.75-.192 1.352-.622 2.446-1.284 3.272-.886 1.102-2.14 1.704-3.73 1.79-1.202.065-2.361-.218-3.259-.801-1.063-.689-1.685-1.74-1.752-2.964-.065-1.19.408-2.285 1.33-3.082.88-.76 2.119-1.207 3.583-1.291a13.853 13.853 0 012.26.126v-.529c0-1.813-.554-2.7-1.783-2.715a2.04 2.04 0 00-1.29.436l-1.168-1.62A4.06 4.06 0 0112.29 7.7c1.05 0 1.95.3 2.633.866.957.787 1.413 2.011 1.413 3.729v5.072a5.6 5.6 0 001.48 1.018c.47.213.977.336 1.503.366.012.162.018.329.018.498 0 1.762-.602 3.09-1.789 3.942-1.09.783-2.589 1.194-4.362 1.209zm-1.088-8.64c-.63 0-1.174.144-1.577.416-.5.332-.754.798-.72 1.316.032.508.29.93.727 1.211.518.335 1.218.499 2.003.456 1.009-.055 1.773-.469 2.272-1.233.362-.551.548-1.259.593-2.233a11.4 11.4 0 00-1.298-.083c-.651-.02-1.316.044-2 .15z"/></svg>', 'Followers · Likes'],
      ];
      foreach($platforms as $p): ?>
      <a href="<?=cn('auth/signup')?>" class="lv-plat-card <?=$p[1]?>">
        <div class="lv-plat-icon"><?=$p[2]?></div>
        <div class="lv-plat-name"><?=htmlspecialchars($p[0])?></div>
        <div class="lv-plat-subs"><?=htmlspecialchars($p[3])?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- WHY US SECTION -->
<section class="lv-section lv-section-dark" id="features">
  <div class="lv-container">
    <div class="lv-sec-head lv-sec-head-light">
      <h2>Why Choose <span class="lv-gradient-text">Loishvizo?</span></h2>
      <p>Built for creators, agencies and resellers who want real results — fast.</p>
    </div>
    <div class="lv-features-grid">
      <div class="lv-feat-box">
        <div class="lv-feat-ic lv-ic-purple">⚡</div>
        <div class="lv-feat-title">Ultra-Fast Delivery</div>
        <div class="lv-feat-body">Orders start processing in seconds. Most complete within minutes — the fastest delivery in the industry.</div>
      </div>
      <div class="lv-feat-box">
        <div class="lv-feat-ic lv-ic-green">🛡️</div>
        <div class="lv-feat-title">100% Account Safe</div>
        <div class="lv-feat-body">No password required. All services are delivered externally and comply with platform guidelines.</div>
      </div>
      <div class="lv-feat-box">
        <div class="lv-feat-ic lv-ic-purple">💰</div>
        <div class="lv-feat-title">Lowest Prices</div>
        <div class="lv-feat-body">Industry's most competitive rates with bulk discounts and custom pricing for agencies and resellers.</div>
      </div>
      <div class="lv-feat-box">
        <div class="lv-feat-ic lv-ic-green">🔄</div>
        <div class="lv-feat-title">Auto Refill</div>
        <div class="lv-feat-body">Followers drop? Our auto-refill system replenishes your orders automatically at no extra cost.</div>
      </div>
      <div class="lv-feat-box">
        <div class="lv-feat-ic lv-ic-purple">📊</div>
        <div class="lv-feat-title">Real-Time Dashboard</div>
        <div class="lv-feat-body">Track every order live — status, delivered count, remaining — all updated in real-time.</div>
      </div>
      <div class="lv-feat-box">
        <div class="lv-feat-ic lv-ic-green">🤝</div>
        <div class="lv-feat-title">24/7 Support</div>
        <div class="lv-feat-body">Our support team responds around the clock via tickets. Average response under 30 minutes.</div>
      </div>
      <div class="lv-feat-box">
        <div class="lv-feat-ic lv-ic-purple">🌍</div>
        <div class="lv-feat-title">15+ Platforms</div>
        <div class="lv-feat-body">TikTok, Instagram, YouTube, Spotify, Telegram and more — all from a single, simple dashboard.</div>
      </div>
      <div class="lv-feat-box">
        <div class="lv-feat-ic lv-ic-green">🎯</div>
        <div class="lv-feat-title">Drip Feed &amp; API</div>
        <div class="lv-feat-body">Natural-looking growth with drip feed delivery. Full API access for resellers and developers.</div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ SECTION -->
<section class="lv-section" id="faq">
  <div class="lv-container">
    <div class="lv-sec-head">
      <h2>Frequently Asked <span class="lv-gradient-text">Questions</span></h2>
      <p>Everything you need to know about Loishvizo Boosting Solutions.</p>
    </div>
    <div class="lv-faq-wrap">
      <?php
      $faqs = [
        ['Is it safe to use Loishvizo?', 'Yes. We never ask for your password. Services are delivered externally without accessing your account. Your account security is always protected.'],
        ['How fast will I receive results?', 'Most orders start within seconds and complete within minutes to a few hours depending on the service type and quantity ordered.'],
        ['Which platforms do you support?', 'We support 15+ platforms including TikTok, Instagram, YouTube, Facebook, Twitter/X, Spotify, Telegram, LinkedIn, Pinterest, Twitch, Snapchat, SoundCloud, Discord, Reddit, WhatsApp and more.'],
        ['Do you offer a refill guarantee?', 'Yes. Many of our services include a refill guarantee period. If your count drops, we refill it at no extra cost within the guarantee window.'],
        ['Can I use Loishvizo for my clients as an agency?', 'Absolutely. Loishvizo is built for agencies and resellers. You can manage multiple accounts and access our API for automated order placement.'],
        ['What payment methods do you accept?', 'We accept major payment methods available in your region. Log in and visit the Add Funds page to see all options available to you.'],
        ['Can I cancel an order after placing it?', 'Orders can be cancelled if they have not started processing yet. Once started, cancellation depends on the service type. Contact support for help.'],
        ['Is there a minimum order amount?', 'Minimum order quantities vary per service. You can see the minimum and maximum for each service on the services page before placing your order.'],
      ];
      foreach($faqs as $i => $faq): ?>
      <div class="lv-faq-row" id="faqRow<?=$i?>">
        <button class="lv-faq-question" onclick="toggleFaq(<?=$i?>)" aria-expanded="false">
          <span><?=htmlspecialchars($faq[0])?></span>
          <span class="lv-faq-arrow" id="faqArrow<?=$i?>">＋</span>
        </button>
        <div class="lv-faq-answer" id="faqAns<?=$i?>"><?=htmlspecialchars($faq[1])?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA SECTION -->
<section class="lv-cta-section">
  <div class="lv-container">
    <div class="lv-cta-box">
      <h2>Ready to Grow Your Social Media?</h2>
      <p>Join thousands of creators and businesses who trust Loishvizo for ultra-speed social media growth.</p>
      <div class="lv-cta-btns">
        <?php if(!session('uid')):?>
        <a href="<?=cn('auth/signup')?>" class="lv-btn-main">Create Free Account</a>
        <?php else:?>
        <a href="<?=cn('new_order')?>" class="lv-btn-main">Place New Order</a>
        <?php endif;?>
        <a href="#platforms" class="lv-btn-sec">View All Platforms</a>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<?php include_once 'blocks/footer.php'; ?>

<!-- SCRIPTS -->
<script>
function openMobMenu() {
  document.getElementById('lvMobNav').classList.add('open');
  document.getElementById('lvOverlay').classList.add('show');
  document.body.style.overflow = 'hidden';
}
function closeMobMenu() {
  document.getElementById('lvMobNav').classList.remove('open');
  document.getElementById('lvOverlay').classList.remove('show');
  document.body.style.overflow = '';
}

// Sticky navbar
window.addEventListener('scroll', function() {
  var nav = document.getElementById('lvNavbar');
  if(window.scrollY > 60) nav.classList.add('lv-navbar-stuck');
  else nav.classList.remove('lv-navbar-stuck');
});

// FAQ accordion
function toggleFaq(i) {
  var ans = document.getElementById('faqAns' + i);
  var arrow = document.getElementById('faqArrow' + i);
  var btn = ans.previousElementSibling;
  var open = ans.classList.contains('open');
  // close all
  document.querySelectorAll('.lv-faq-answer').forEach(function(el) { el.classList.remove('open'); });
  document.querySelectorAll('.lv-faq-arrow').forEach(function(el) { el.textContent = '＋'; });
  document.querySelectorAll('.lv-faq-question').forEach(function(el) { el.classList.remove('active'); el.setAttribute('aria-expanded','false'); });
  if(!open) {
    ans.classList.add('open');
    arrow.textContent = '－';
    btn.classList.add('active');
    btn.setAttribute('aria-expanded','true');
  }
}
</script>
