<?php
  $CI = &get_instance();
  $CI->load->model('model');
  $user    = current_logged_user();
  $balance = (!empty($user->balance) && $user->balance != 0) ? currency_format($user->balance) : '0.00';
  $symbol  = get_option('currency_symbol','$');
  $fname   = !empty($user->first_name) ? ucfirst($user->first_name) : 'User';
  $initial = strtoupper(substr($fname, 0, 1));

  // page title map
  $page_titles = [
    'statistics'    => 'Dashboard',
    'new_order'     => 'New Order',
    'order'         => 'Order History',
    'dripfeed'      => 'Drip Feed',
    'subscriptions' => 'Subscriptions',
    'refill'        => 'Refills',
    'services'      => 'Services',
    'add_funds'     => 'Add Funds',
    'transactions'  => 'Transactions',
    'tickets'       => 'Support Tickets',
    'faq'           => 'FAQ',
    'api'           => 'API',
    'affiliates'    => 'Affiliates',
    'profile'       => 'My Profile',
    'terms'         => 'Terms',
  ];
  $seg1 = segment(1);
  $current_title = isset($page_titles[$seg1]) ? $page_titles[$seg1] : ucfirst(str_replace('_',' ',$seg1));
?>
<header class="d-header">
  <div class="d-header-left">
    <button class="d-hamburger" id="dHamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
    <span class="d-page-title"><?=$current_title?></span>
  </div>

  <div class="d-header-right">
    <!-- Balance -->
    <div class="d-balance-chip">
      <span class="d-bal-label">Balance</span>
      <span class="d-bal-val"><?=$symbol?><?=$balance?></span>
    </div>

    <!-- Add Funds -->
    <a href="<?=cn('add_funds')?>" class="d-btn-addfunds">
      <i class="fe fe-plus"></i>
      <span>Add Funds</span>
    </a>

    <?php if(get_option('enable_news_announcement') && get_option('news_announcement_button_position','header') == 'header'): ?>
    <a href="<?=cn('news-annoucement')?>" class="d-header-icon-btn ajaxModal" title="News">
      <i class="fe fe-bell"></i>
      <?php if(!isset($_COOKIE['news_annoucement']) || $_COOKIE['news_annoucement'] != 'clicked'): ?>
      <span class="d-notif-dot"></span>
      <?php endif; ?>
    </a>
    <?php endif; ?>

    <!-- User dropdown -->
    <div class="d-dropdown">
      <button class="d-user-btn" data-ddtoggle="userDropdown" type="button">
        <div class="d-user-avatar"><?=$initial?></div>
        <span class="d-user-name"><?=$fname?></span>
        <i class="fe fe-chevron-down" style="font-size:11px;color:var(--d-muted)"></i>
      </button>
      <div class="d-dropdown-menu" id="userDropdown">
        <a href="<?=cn('profile')?>" class="d-dropdown-item">
          <i class="fe fe-user"></i> Profile
        </a>
        <a href="<?=cn('add_funds')?>" class="d-dropdown-item">
          <i class="fe fe-dollar-sign"></i> Add Funds
        </a>
        <a href="<?=cn('api/docs')?>" class="d-dropdown-item">
          <i class="fe fe-code"></i> API Access
        </a>
        <div class="d-dropdown-divider"></div>
        <?php if(session('sid') && session('uid')): ?>
        <a href="<?=cn('back-to-admin')?>" class="d-dropdown-item ajaxViewUser">
          <i class="fe fe-log-out"></i> Back to Admin
        </a>
        <?php endif; ?>
        <a href="<?=cn('auth/logout')?>" class="d-dropdown-item danger">
          <i class="fe fe-power"></i> Logout
        </a>
      </div>
    </div>
  </div>
</header>
