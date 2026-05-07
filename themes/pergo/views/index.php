<?php include_once 'blocks/head.blade.php'; ?>

<!-- EMOJI BACKGROUND -->
<div id="lv-emoji-bg"></div>

<!-- MOBILE MENU -->
<div class="lv-mobile-menu" id="lvMobMenu">
  <a href="<?=cn()?>">Home</a>
  <a href="#platforms">Platforms</a>
  <a href="<?=cn('services')?>">Services</a>
  <a href="#how">How It Works</a>
  <a href="#faq">FAQ</a>
  <div class="lv-mob-btns">
    <a href="<?=cn('auth/login')?>" style="background:rgba(255,255,255,.08);color:#fff">Login</a>
    <?php if(!get_option('disable_signup_page')):?>
    <a href="<?=cn('auth/signup')?>" style="background:linear-gradient(135deg,#7c22f8,#06d6a0);color:#fff">Get Started Free</a>
    <?php endif;?>
  </div>
</div>

<!-- NAVBAR -->
<nav class="lv-nav" id="lvNav">
  <div class="container lv-nav-inner">
    <a href="<?=cn()?>" class="lv-brand">
      <img src="<?=BASE?>assets/images/logo.png" alt="Loishvizo" class="lv-brand-img">
      <div class="lv-brand-info">
        <span class="lv-brand-name">Loishvizo</span>
        <span class="lv-brand-tagline">Boosting Solutions</span>
      </div>
    </a>
    <ul class="lv-nav-links">
      <li><a href="<?=cn()?>" class="active">Home</a></li>
      <li><a href="#platforms">Platforms</a></li>
      <?php if(get_option("enable_service_list_no_login") == 1):?>
      <li><a href="<?=cn('services')?>">Services</a></li>
      <?php endif;?>
      <li><a href="#how">How It Works</a></li>
      <li><a href="#faq">FAQ</a></li>
    </ul>
    <div class="lv-nav-actions">
      <?php if(!session('uid')):?>
      <a href="<?=cn('auth/login')?>" class="btn-nav-login">Login</a>
      <?php if(!get_option('disable_signup_page')):?>
      <a href="<?=cn('auth/signup')?>" class="btn-nav-signup">Get Started Free</a>
      <?php endif;?>
      <?php else:?>
      <a href="<?=cn('statistics')?>" class="btn-nav-signup">Dashboard</a>
      <?php endif;?>
      <button class="lv-hamburger" id="lvHamburger" onclick="toggleMobMenu()">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

<!-- HERO SECTION -->
<section class="lv-hero" id="home">
  <div class="lv-hero-grid"></div>
  <div class="container">
    <div class="lv-hero-content">
      <!-- LEFT -->
      <div class="lv-hero-left">
        <div class="lv-hero-badge">
          <span class="lv-hero-dot"></span>
          The Ultra Speed Boosting Platform
        </div>
        <h1 class="lv-hero-title">
          Boost Your<br>
          <span class="grad">Social Media</span><br>
          Instantly ⚡
        </h1>
        <p class="lv-hero-desc">
          Loishvizo Boosting Solutions delivers real followers, likes, views &amp; engagement across all major platforms — blazing fast, affordable, and 100% safe.
        </p>
        <div class="lv-hero-actions">
          <?php if(!session('uid')):?>
          <a href="<?=cn('auth/signup')?>" class="btn-primary-lv">
            🚀 Start Boosting Now
          </a>
          <a href="#how" class="btn-outline-lv">
            ▶ See How It Works
          </a>
          <?php else:?>
          <a href="<?=cn('new_order')?>" class="btn-primary-lv">
            🚀 Place New Order
          </a>
          <a href="<?=cn('services')?>" class="btn-outline-lv">
            📋 View Services
          </a>
          <?php endif;?>
        </div>
        <div class="lv-hero-numbers">
          <div class="lv-num">
            <span class="lv-num-val">50K+</span>
            <span class="lv-num-label">Happy Clients</span>
          </div>
          <div class="lv-num">
            <span class="lv-num-val">1M+</span>
            <span class="lv-num-label">Orders Done</span>
          </div>
          <div class="lv-num">
            <span class="lv-num-val">500+</span>
            <span class="lv-num-label">Services</span>
          </div>
          <div class="lv-num">
            <span class="lv-num-val">24/7</span>
            <span class="lv-num-label">Support</span>
          </div>
        </div>
      </div>
      <!-- RIGHT: PHONE MOCKUP -->
      <div class="lv-phone-wrap" id="heroPhoneWrap">
        <div class="lv-phone-glow"></div>
        <div class="lv-phone">
          <!-- Floating emojis around phone -->
          <span class="lv-pep">❤️</span>
          <span class="lv-pep">👍</span>
          <span class="lv-pep">🔥</span>
          <span class="lv-pep">⭐</span>
          <span class="lv-pep">🚀</span>
          <!-- Phone frame -->
          <div class="lv-phone-frame">
            <div class="lv-phone-notch"></div>
            <div class="lv-phone-ui-bar">
              <span class="lv-phone-ui-label">LOISHVIZO</span>
              <div class="lv-phone-status-ring">⚡</div>
            </div>
            <div class="lv-phone-metric">
              <div class="lv-phone-metric-label">INSTAGRAM FOLLOWERS</div>
              <div class="lv-phone-metric-val">+24,800</div>
              <div class="lv-phone-metric-bar"><div class="lv-phone-metric-fill lv-pmf-1"></div></div>
            </div>
            <div class="lv-phone-metric">
              <div class="lv-phone-metric-label">TIKTOK LIKES</div>
              <div class="lv-phone-metric-val">+156K</div>
              <div class="lv-phone-metric-bar"><div class="lv-phone-metric-fill lv-pmf-2"></div></div>
            </div>
            <div class="lv-phone-metric">
              <div class="lv-phone-metric-label">YOUTUBE VIEWS</div>
              <div class="lv-phone-metric-val">+2.4M</div>
              <div class="lv-phone-metric-bar"><div class="lv-phone-metric-fill lv-pmf-3"></div></div>
            </div>
            <div class="lv-phone-platform-row">
              <div class="lv-phone-platform-pill">📸 IG</div>
              <div class="lv-phone-platform-pill">🎵 TK</div>
              <div class="lv-phone-platform-pill">▶️ YT</div>
              <div class="lv-phone-platform-pill">👥 FB</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TICKER -->
<div class="lv-ticker">
  <div class="lv-ticker-track" id="tickerTrack">
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">📱</span><span class="lv-ticker-text">TikTok Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">❤️</span><span class="lv-ticker-text">Instagram Likes</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">▶️</span><span class="lv-ticker-text">YouTube Views</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">👥</span><span class="lv-ticker-text">Facebook Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">🐦</span><span class="lv-ticker-text">Twitter/X Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">🎵</span><span class="lv-ticker-text">Spotify Streams</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">💼</span><span class="lv-ticker-text">LinkedIn Connections</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">📌</span><span class="lv-ticker-text">Pinterest Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">💬</span><span class="lv-ticker-text">Telegram Members</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">🎮</span><span class="lv-ticker-text">Twitch Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">👻</span><span class="lv-ticker-text">Snapchat Views</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">🔊</span><span class="lv-ticker-text">SoundCloud Plays</span></div>
    <!-- Duplicate for seamless loop -->
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">📱</span><span class="lv-ticker-text">TikTok Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">❤️</span><span class="lv-ticker-text">Instagram Likes</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">▶️</span><span class="lv-ticker-text">YouTube Views</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">👥</span><span class="lv-ticker-text">Facebook Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">🐦</span><span class="lv-ticker-text">Twitter/X Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">🎵</span><span class="lv-ticker-text">Spotify Streams</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">💼</span><span class="lv-ticker-text">LinkedIn Connections</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">📌</span><span class="lv-ticker-text">Pinterest Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">💬</span><span class="lv-ticker-text">Telegram Members</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">🎮</span><span class="lv-ticker-text">Twitch Followers</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">👻</span><span class="lv-ticker-text">Snapchat Views</span></div>
    <div class="lv-ticker-item"><span class="lv-ticker-emoji">🔊</span><span class="lv-ticker-text">SoundCloud Plays</span></div>
  </div>
</div>

<!-- STATS BAR -->
<section class="lv-section" style="padding:40px 0">
  <div class="container">
    <div class="lv-statsbar">
      <div class="lv-statsbar-item">
        <span class="lv-statsbar-val grad">50,000+</span>
        <span class="lv-statsbar-label">Happy Customers</span>
      </div>
      <div class="lv-statsbar-item">
        <span class="lv-statsbar-val grad">1,000,000+</span>
        <span class="lv-statsbar-label">Orders Completed</span>
      </div>
      <div class="lv-statsbar-item">
        <span class="lv-statsbar-val grad">500+</span>
        <span class="lv-statsbar-label">Services Available</span>
      </div>
      <div class="lv-statsbar-item">
        <span class="lv-statsbar-val grad">15+</span>
        <span class="lv-statsbar-label">Platforms Supported</span>
      </div>
      <div class="lv-statsbar-item">
        <span class="lv-statsbar-val grad">99.9%</span>
        <span class="lv-statsbar-label">Uptime Guarantee</span>
      </div>
    </div>
  </div>
</section>

<!-- PLATFORMS SECTION -->
<section class="lv-section lv-section-alt" id="platforms">
  <div class="container">
    <div class="lv-section-header">
      <div class="lv-section-badge">🌐 All Platforms</div>
      <h2 class="lv-section-title">Boost On <span class="grad">Every Platform</span></h2>
      <p class="lv-section-sub">One dashboard to boost all your social media accounts across 15+ platforms instantly.</p>
    </div>
    <div class="lv-platform-grid">
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">📱</span>
        <div class="lv-platform-name">TikTok</div>
        <div class="lv-platform-services">Followers • Likes • Views</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">📸</span>
        <div class="lv-platform-name">Instagram</div>
        <div class="lv-platform-services">Followers • Likes • Views</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">▶️</span>
        <div class="lv-platform-name">YouTube</div>
        <div class="lv-platform-services">Subscribers • Views • Likes</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">👥</span>
        <div class="lv-platform-name">Facebook</div>
        <div class="lv-platform-services">Likes • Followers • Shares</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">🐦</span>
        <div class="lv-platform-name">Twitter / X</div>
        <div class="lv-platform-services">Followers • Likes • Retweets</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">🎵</span>
        <div class="lv-platform-name">Spotify</div>
        <div class="lv-platform-services">Streams • Followers • Plays</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">💼</span>
        <div class="lv-platform-name">LinkedIn</div>
        <div class="lv-platform-services">Connections • Followers</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">📌</span>
        <div class="lv-platform-name">Pinterest</div>
        <div class="lv-platform-services">Followers • Repins • Likes</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">💬</span>
        <div class="lv-platform-name">Telegram</div>
        <div class="lv-platform-services">Members • Views • Reactions</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">🎮</span>
        <div class="lv-platform-name">Twitch</div>
        <div class="lv-platform-services">Followers • Views • Clips</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">👻</span>
        <div class="lv-platform-name">Snapchat</div>
        <div class="lv-platform-services">Followers • Views • Score</div>
      </div>
      <div class="lv-platform-card" onclick="location.href='<?=cn('auth/signup')?>'">
        <span class="lv-platform-icon-wrap">🔊</span>
        <div class="lv-platform-name">SoundCloud</div>
        <div class="lv-platform-services">Plays • Followers • Likes</div>
      </div>
    </div>
  </div>
</section>

<!-- WHY LOISHVIZO SECTION -->
<section class="lv-section" id="features">
  <div class="container">
    <div class="lv-section-header">
      <div class="lv-section-badge">⚡ Why Choose Us</div>
      <h2 class="lv-section-title">The <span class="grad">Fastest &amp; Safest</span> SMM Panel</h2>
      <p class="lv-section-sub">Experience the difference of ultra-speed social media growth with military-grade security.</p>
    </div>
    <div class="lv-features-grid">
      <div class="lv-feat-card">
        <div class="lv-feat-icon">⚡</div>
        <div class="lv-feat-title">Ultra-Fast Delivery</div>
        <p class="lv-feat-desc">Orders start processing within seconds. Most orders deliver in minutes, not hours. We're the fastest SMM panel on the market.</p>
      </div>
      <div class="lv-feat-card">
        <div class="lv-feat-icon">🛡️</div>
        <div class="lv-feat-title">100% Safe & Secure</div>
        <p class="lv-feat-desc">No password needed. All our methods are compliant with platform terms. Your account is always safe with Loishvizo.</p>
      </div>
      <div class="lv-feat-card">
        <div class="lv-feat-icon">💎</div>
        <div class="lv-feat-title">Premium Quality</div>
        <p class="lv-feat-desc">We source only high-quality, real-looking engagement from our verified network of global API providers.</p>
      </div>
      <div class="lv-feat-card">
        <div class="lv-feat-icon">💰</div>
        <div class="lv-feat-title">Cheapest Prices</div>
        <p class="lv-feat-desc">Industry's most competitive rates. Bulk discounts available. Custom pricing for resellers and agencies.</p>
      </div>
      <div class="lv-feat-card">
        <div class="lv-feat-icon">🔄</div>
        <div class="lv-feat-title">Auto Refill</div>
        <p class="lv-feat-desc">Subscribers dropping? Our auto-refill system automatically replenishes your orders at no extra cost.</p>
      </div>
      <div class="lv-feat-card">
        <div class="lv-feat-icon">🌍</div>
        <div class="lv-feat-title">15+ Platforms</div>
        <p class="lv-feat-desc">From TikTok to Spotify, we cover every major social media platform with hundreds of unique services.</p>
      </div>
      <div class="lv-feat-card">
        <div class="lv-feat-icon">📊</div>
        <div class="lv-feat-title">Real-Time Dashboard</div>
        <p class="lv-feat-desc">Track all your orders live. See status, remaining, delivered count — all updated in real-time from your dashboard.</p>
      </div>
      <div class="lv-feat-card">
        <div class="lv-feat-icon">🤝</div>
        <div class="lv-feat-title">24/7 Support</div>
        <p class="lv-feat-desc">Our dedicated support team is available around the clock via tickets. Average response time under 30 minutes.</p>
      </div>
      <div class="lv-feat-card">
        <div class="lv-feat-icon">🔁</div>
        <div class="lv-feat-title">Drip Feed &amp; Subscriptions</div>
        <p class="lv-feat-desc">Natural-looking growth with our drip feed system. Set custom intervals and run automated subscription campaigns.</p>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="lv-section lv-section-alt" id="how">
  <div class="container">
    <div class="lv-section-header">
      <div class="lv-section-badge">📋 Simple Process</div>
      <h2 class="lv-section-title">How It <span class="grad">Works</span></h2>
      <p class="lv-section-sub">Get started in under 2 minutes. No technical knowledge required.</p>
    </div>
    <div class="lv-steps">
      <div class="lv-step">
        <div class="lv-step-num">1</div>
        <div class="lv-step-title">Create Account</div>
        <p class="lv-step-desc">Sign up free in 30 seconds. No credit card required to get started.</p>
      </div>
      <div class="lv-step">
        <div class="lv-step-num">2</div>
        <div class="lv-step-title">Add Funds</div>
        <p class="lv-step-desc">Top up your balance using your preferred payment method securely.</p>
      </div>
      <div class="lv-step">
        <div class="lv-step-num">3</div>
        <div class="lv-step-title">Choose Service</div>
        <p class="lv-step-desc">Browse 500+ services across 15+ platforms. Select what you need.</p>
      </div>
      <div class="lv-step">
        <div class="lv-step-num">4</div>
        <div class="lv-step-title">Place Order</div>
        <p class="lv-step-desc">Enter your social media link, quantity and confirm. That's it!</p>
      </div>
      <div class="lv-step">
        <div class="lv-step-num">5</div>
        <div class="lv-step-title">Watch It Grow 🚀</div>
        <p class="lv-step-desc">Your engagement starts instantly. Track everything in real-time.</p>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="lv-section">
  <div class="container">
    <div class="lv-section-header">
      <div class="lv-section-badge">⭐ Reviews</div>
      <h2 class="lv-section-title">What Our <span class="grad">Customers Say</span></h2>
      <p class="lv-section-sub">Thousands of creators and businesses trust Loishvizo to grow their presence.</p>
    </div>
    <div class="lv-test-grid">
      <div class="lv-test-card">
        <div class="lv-test-stars">★★★★★</div>
        <p class="lv-test-text">"Insane speed! My TikTok went from 2K to 50K followers in 3 days. Loishvizo is the real deal. No drops, no issues."</p>
        <div class="lv-test-author">
          <div class="lv-test-avatar">S</div>
          <div>
            <div class="lv-test-name">Sarah K.</div>
            <div class="lv-test-handle">@sarahcreates · TikTok Creator</div>
          </div>
        </div>
      </div>
      <div class="lv-test-card">
        <div class="lv-test-stars">★★★★★</div>
        <p class="lv-test-text">"I've tried 10+ SMM panels and Loishvizo is by far the fastest. My YouTube channel took off after using their views service."</p>
        <div class="lv-test-author">
          <div class="lv-test-avatar">M</div>
          <div>
            <div class="lv-test-name">Marcus T.</div>
            <div class="lv-test-handle">@marcustech · YouTuber</div>
          </div>
        </div>
      </div>
      <div class="lv-test-card">
        <div class="lv-test-stars">★★★★★</div>
        <p class="lv-test-text">"Perfect for my agency. We manage 40+ client accounts and Loishvizo handles all their social media growth efficiently."</p>
        <div class="lv-test-author">
          <div class="lv-test-avatar">A</div>
          <div>
            <div class="lv-test-name">Amara D.</div>
            <div class="lv-test-handle">@amaradigital · Agency Owner</div>
          </div>
        </div>
      </div>
      <div class="lv-test-card">
        <div class="lv-test-stars">★★★★★</div>
        <p class="lv-test-text">"Their Instagram followers service is top-notch. Quality is great and the customer support team replied within minutes!"</p>
        <div class="lv-test-author">
          <div class="lv-test-avatar">J</div>
          <div>
            <div class="lv-test-name">James O.</div>
            <div class="lv-test-handle">@jamesstyle · Influencer</div>
          </div>
        </div>
      </div>
      <div class="lv-test-card">
        <div class="lv-test-stars">★★★★★</div>
        <p class="lv-test-text">"I was skeptical at first but the results speak for themselves. Facebook page went from 500 to 15K likes. Highly recommend!"</p>
        <div class="lv-test-author">
          <div class="lv-test-avatar">L</div>
          <div>
            <div class="lv-test-name">Linda M.</div>
            <div class="lv-test-handle">@lindabusiness · Entrepreneur</div>
          </div>
        </div>
      </div>
      <div class="lv-test-card">
        <div class="lv-test-stars">★★★★★</div>
        <p class="lv-test-text">"Best Spotify streams service on the market. My tracks are getting real streams and showing up in playlists now. Game changer!"</p>
        <div class="lv-test-author">
          <div class="lv-test-avatar">D</div>
          <div>
            <div class="lv-test-name">DJ Phantom</div>
            <div class="lv-test-handle">@djphantom · Music Artist</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="lv-section lv-section-alt" id="faq">
  <div class="container">
    <div class="lv-section-header">
      <div class="lv-section-badge">❓ FAQ</div>
      <h2 class="lv-section-title">Frequently Asked <span class="grad">Questions</span></h2>
      <p class="lv-section-sub">Everything you need to know about Loishvizo Boosting Solutions.</p>
    </div>
    <div class="lv-faq-list">
      <div class="lv-faq-item">
        <div class="lv-faq-q" onclick="toggleFaq(this)">
          Is it safe to use Loishvizo?
          <span class="lv-faq-icon">+</span>
        </div>
        <div class="lv-faq-a">Yes, absolutely. We never ask for your password. All our services are delivered externally and safely without risking your account. We have a 100% safety track record with thousands of clients.</div>
      </div>
      <div class="lv-faq-item">
        <div class="lv-faq-q" onclick="toggleFaq(this)">
          How fast will I see results?
          <span class="lv-faq-icon">+</span>
        </div>
        <div class="lv-faq-a">Most orders start within seconds and complete within minutes to hours depending on the service and quantity. Our ultra-speed infrastructure processes orders faster than any competitor.</div>
      </div>
      <div class="lv-faq-item">
        <div class="lv-faq-q" onclick="toggleFaq(this)">
          What platforms do you support?
          <span class="lv-faq-icon">+</span>
        </div>
        <div class="lv-faq-a">We support 15+ platforms including TikTok, Instagram, YouTube, Facebook, Twitter/X, Spotify, LinkedIn, Pinterest, Telegram, Twitch, Snapchat, SoundCloud and more. We're constantly adding new platforms.</div>
      </div>
      <div class="lv-faq-item">
        <div class="lv-faq-q" onclick="toggleFaq(this)">
          What payment methods do you accept?
          <span class="lv-faq-icon">+</span>
        </div>
        <div class="lv-faq-a">We accept multiple payment methods. Check the "Add Funds" section after registering for all available options in your region.</div>
      </div>
      <div class="lv-faq-item">
        <div class="lv-faq-q" onclick="toggleFaq(this)">
          Do you offer refills if followers drop?
          <span class="lv-faq-icon">+</span>
        </div>
        <div class="lv-faq-a">Yes! Services marked with "Refill" automatically replenish any dropped engagement at no extra cost. Check each service's details for refill availability and period.</div>
      </div>
      <div class="lv-faq-item">
        <div class="lv-faq-q" onclick="toggleFaq(this)">
          Can I resell your services?
          <span class="lv-faq-icon">+</span>
        </div>
        <div class="lv-faq-a">Absolutely! We have a full API that allows you to integrate our services into your own panel. Many agencies and resellers use Loishvizo as their backend provider. Check the API section after logging in.</div>
      </div>
      <div class="lv-faq-item">
        <div class="lv-faq-q" onclick="toggleFaq(this)">
          What is Drip Feed?
          <span class="lv-faq-icon">+</span>
        </div>
        <div class="lv-faq-a">Drip Feed lets you spread your order delivery over a set period to look more natural. For example, you can get 1,000 followers delivered over 10 days at 100/day instead of all at once.</div>
      </div>
      <div class="lv-faq-item">
        <div class="lv-faq-q" onclick="toggleFaq(this)">
          How do I contact support?
          <span class="lv-faq-icon">+</span>
        </div>
        <div class="lv-faq-a">Submit a ticket from your dashboard and our team will respond within 30 minutes. We're available 24/7 to help with any issues or questions.</div>
      </div>
    </div>
  </div>
</section>

<!-- CTA SECTION -->
<section class="lv-section">
  <div class="container">
    <div class="lv-cta-box">
      <h2 class="lv-cta-title">Ready to Go <span class="grad">Viral? 🚀</span></h2>
      <p class="lv-cta-desc">Join 50,000+ creators and businesses who trust Loishvizo for their social media growth. Start boosting in minutes.</p>
      <div class="lv-cta-btns">
        <?php if(!session('uid')):?>
        <a href="<?=cn('auth/signup')?>" class="btn-primary-lv">🚀 Create Free Account</a>
        <a href="<?=cn('auth/login')?>" class="btn-outline-lv">Login to Dashboard</a>
        <?php else:?>
        <a href="<?=cn('new_order')?>" class="btn-primary-lv">🚀 Place New Order</a>
        <a href="<?=cn('services')?>" class="btn-outline-lv">Browse Services</a>
        <?php endif;?>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="lv-footer">
  <div class="container">
    <div class="lv-footer-grid">
      <div>
        <a href="<?=cn()?>" class="lv-brand">
          <img src="<?=BASE?>assets/images/logo.png" alt="Loishvizo" class="lv-brand-img" style="height:40px;width:40px">
          <div class="lv-brand-info">
            <span class="lv-brand-name">Loishvizo</span>
            <span class="lv-brand-tagline">Boosting Solutions</span>
          </div>
        </a>
        <p class="lv-footer-brand-desc">The ultra speed social media boosting platform. Trusted by 50,000+ creators and businesses worldwide.</p>
        <div class="lv-footer-socials">
          <a href="#" class="lv-footer-soc"><i class="fa fa-instagram"></i></a>
          <a href="#" class="lv-footer-soc"><i class="fa fa-twitter"></i></a>
          <a href="#" class="lv-footer-soc"><i class="fa fa-facebook"></i></a>
          <a href="#" class="lv-footer-soc"><i class="fa fa-telegram"></i></a>
        </div>
      </div>
      <div>
        <div class="lv-footer-col-head">Services</div>
        <ul class="lv-footer-links">
          <li><a href="<?=cn('auth/signup')?>">TikTok Boosting</a></li>
          <li><a href="<?=cn('auth/signup')?>">Instagram Growth</a></li>
          <li><a href="<?=cn('auth/signup')?>">YouTube Views</a></li>
          <li><a href="<?=cn('auth/signup')?>">Facebook Likes</a></li>
          <li><a href="<?=cn('auth/signup')?>">Spotify Streams</a></li>
          <li><a href="<?=cn('auth/signup')?>">Twitter/X Followers</a></li>
        </ul>
      </div>
      <div>
        <div class="lv-footer-col-head">Platform</div>
        <ul class="lv-footer-links">
          <?php if(!session('uid')):?>
          <li><a href="<?=cn('auth/login')?>">Login</a></li>
          <li><a href="<?=cn('auth/signup')?>">Sign Up Free</a></li>
          <?php else:?>
          <li><a href="<?=cn('statistics')?>">Dashboard</a></li>
          <li><a href="<?=cn('new_order')?>">New Order</a></li>
          <?php endif;?>
          <?php if(get_option("enable_service_list_no_login") == 1):?>
          <li><a href="<?=cn('services')?>">Services</a></li>
          <?php endif;?>
          <li><a href="<?=cn('api/docs')?>">API Docs</a></li>
          <li><a href="<?=cn('faq')?>">FAQ</a></li>
        </ul>
      </div>
      <div>
        <div class="lv-footer-col-head">Legal</div>
        <ul class="lv-footer-links">
          <li><a href="<?=cn('terms')?>">Terms of Service</a></li>
          <li><a href="<?=cn('cookie-policy')?>">Cookie Policy</a></li>
          <li><a href="<?=cn('tickets')?>">Support Tickets</a></li>
          <li><a href="<?=cn('news-annoucement')?>">Announcements</a></li>
        </ul>
      </div>
    </div>
    <div class="lv-footer-bottom">
      <span class="lv-footer-copy">© <?=date('Y')?> Loishvizo Boosting Solutions. All rights reserved.</span>
      <div class="lv-footer-legal">
        <a href="<?=cn('terms')?>">Terms</a>
        <a href="<?=cn('cookie-policy')?>">Privacy</a>
      </div>
    </div>
  </div>
</footer>

<!-- SCRIPTS -->
<script src="<?=BASE?>assets/js/vendors/bootstrap.bundle.min.js"></script>
<script src="<?=BASE?>assets/js/general.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-toast/js/jquery.toast.js"></script>
<script src="<?=BASE?>assets/js/process.js"></script>

<script>
// ─── EMOJI RAIN ───
(function(){
  var emojis = ['❤️','👍','🔥','⭐','🚀','💫','✨','💜','🎉','👏','😍','🤩','💎','⚡','🌟'];
  var bg = document.getElementById('lv-emoji-bg');
  if(!bg) return;
  function spawn(){
    var el = document.createElement('div');
    el.className = 'lv-ep';
    el.textContent = emojis[Math.floor(Math.random()*emojis.length)];
    el.style.left = Math.random()*100 + 'vw';
    el.style.animationDuration = (5 + Math.random()*5) + 's';
    el.style.animationDelay = (Math.random()*3) + 's';
    el.style.fontSize = (14 + Math.random()*18) + 'px';
    bg.appendChild(el);
    setTimeout(function(){el.remove()},10000);
  }
  setInterval(spawn, 600);
  for(var i=0;i<8;i++) setTimeout(spawn, i*300);
})();

// ─── HAMBURGER ───
function toggleMobMenu(){
  var menu = document.getElementById('lvMobMenu');
  var ham = document.getElementById('lvHamburger');
  menu.classList.toggle('open');
  ham.classList.toggle('open');
}

// ─── NAVBAR SCROLL ───
window.addEventListener('scroll', function(){
  var nav = document.getElementById('lvNav');
  if(window.scrollY > 50) nav.style.padding = '8px 0';
  else nav.style.padding = '12px 0';
});

// ─── FAQ TOGGLE ───
function toggleFaq(el){
  var item = el.parentElement;
  var allItems = document.querySelectorAll('.lv-faq-item');
  allItems.forEach(function(i){
    if(i !== item) i.classList.remove('open');
  });
  item.classList.toggle('open');
}

// ─── SMOOTH SCROLL ───
document.querySelectorAll('a[href^="#"]').forEach(function(a){
  a.addEventListener('click', function(e){
    var target = document.querySelector(this.getAttribute('href'));
    if(target){
      e.preventDefault();
      target.scrollIntoView({behavior:'smooth',block:'start'});
      var menu = document.getElementById('lvMobMenu');
      var ham = document.getElementById('lvHamburger');
      if(menu) menu.classList.remove('open');
      if(ham) ham.classList.remove('open');
    }
  });
});

// ─── CLOSE MOBILE MENU ON OUTSIDE CLICK ───
document.addEventListener('click', function(e){
  var menu = document.getElementById('lvMobMenu');
  var ham = document.getElementById('lvHamburger');
  if(menu && menu.classList.contains('open') && !menu.contains(e.target) && !ham.contains(e.target)){
    menu.classList.remove('open');
    ham.classList.remove('open');
  }
});
</script>
</body>
</html>
