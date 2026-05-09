<?php
  $CI = &get_instance();
  $CI->load->model('model', 'model');
  $total_unread_tickets = $CI->model->count_results('id', TICKETS, ['user_read' => 1, 'uid' => session('uid')]);
  $header_elements = app_config('controller')['user'];

  $user = current_logged_user();
  $balance = isset($user->balance) ? $user->balance : 0;
  if (empty($balance) || $balance == 0) $balance = 0.00;
  else $balance = currency_format($balance);
  $currency = get_option('currency_symbol', '$');
  $first_name = isset($user->first_name) ? esc($user->first_name) : 'User';
  $last_name  = isset($user->last_name)  ? esc($user->last_name)  : '';
  $initial    = strtoupper(substr($first_name, 0, 1));

  $enable_affiliate = false;
  if (is_table_exists(AFFILIATE) && get_option('affiliate_mode', 0)) {
    $item_affiliate = $CI->model->get('status', AFFILIATE, ['uid' => session('uid')], '', '', true);
    if (!$item_affiliate || $item_affiliate['status']) $enable_affiliate = true;
  }

  $seg1 = segment(1);
  $seg2 = segment(2);
?>

<!-- SIDEBAR -->
<aside class="d-sidebar" id="dSidebar">

  <!-- Brand -->
  <div class="d-sidebar-brand">
    <img src="<?=get_option('website_logo', BASE.'assets/images/logo.png')?>" alt="Loishvizo">
    <div class="d-sidebar-brand-text">
      <span class="d-sidebar-brand-name">Loishvizo</span>
      <span class="d-sidebar-brand-tag">Boosting Panel</span>
    </div>
  </div>

  <!-- Nav -->
  <nav class="d-sidebar-nav">

    <span class="d-sidebar-section">Main</span>
    <a href="<?=cn($header_elements['statistics']['route-name'])?>" class="d-nav-item <?=($seg1==$header_elements['statistics']['route-name']?'active':'')?>">
      <i class="fa fa-tachometer"></i> Dashboard
    </a>
    <a href="<?=cn($header_elements['new_order']['route-name'])?>" class="d-nav-item <?=($seg1=='new_order'?'active':'')?>">
      <i class="fa fa-plus-circle"></i> New Order
    </a>
    <a href="<?=cn($header_elements['services']['route-name'])?>" class="d-nav-item <?=($seg1==$header_elements['services']['route-name']?'active':'')?>">
      <i class="fa fa-th-list"></i> <?=lang($header_elements['services']['name'])?>
    </a>

    <span class="d-sidebar-section">Orders</span>
    <a href="<?=cn($header_elements['order']['route-name'])?>" class="d-nav-item <?=($seg1=='order'&&$seg2!='new_order'?'active':'')?>">
      <i class="fa fa-inbox"></i> <?=lang($header_elements['order']['name'])?>
    </a>
    <a href="<?=cn($header_elements['dripfeed']['route-name'])?>" class="d-nav-item <?=($seg1==$header_elements['dripfeed']['route-name']?'active':'')?>">
      <i class="fa fa-clock-o"></i> <?=lang($header_elements['dripfeed']['name'])?>
    </a>
    <a href="<?=cn($header_elements['subscriptions']['route-name'])?>" class="d-nav-item <?=($seg1==$header_elements['subscriptions']['route-name']?'active':'')?>">
      <i class="fa fa-repeat"></i> <?=lang($header_elements['subscriptions']['name'])?>
    </a>
    <?php if (is_table_exists(ORDERS_REFILL)): ?>
    <a href="<?=cn($header_elements['refill']['route-name'])?>" class="d-nav-item <?=($seg1==$header_elements['refill']['route-name']?'active':'')?>">
      <i class="fa fa-refresh"></i> <?=lang($header_elements['refill']['name'])?>
    </a>
    <?php endif; ?>

    <span class="d-sidebar-section">Finance</span>
    <a href="<?=cn($header_elements['add_funds']['route-name'])?>" class="d-nav-item <?=($seg1==$header_elements['add_funds']['route-name']?'active':'')?>">
      <i class="fa fa-credit-card"></i> <?=lang($header_elements['add_funds']['name'])?>
    </a>
    <a href="<?=cn($header_elements['transactions']['route-name'])?>" class="d-nav-item <?=($seg1==$header_elements['transactions']['route-name']?'active':'')?>">
      <i class="fa fa-exchange"></i> <?=lang($header_elements['transactions']['name'])?>
    </a>

    <span class="d-sidebar-section">Support</span>
    <a href="<?=cn($header_elements['tickets']['route-name'])?>" class="d-nav-item <?=($seg1==$header_elements['tickets']['route-name']?'active':'')?>">
      <i class="fa fa-comments"></i>
      <?=lang($header_elements['tickets']['name'])?>
      <?php if ($total_unread_tickets > 0): ?>
      <span class="d-badge"><?=$total_unread_tickets?></span>
      <?php endif; ?>
    </a>
    <a href="<?=$header_elements['faq']['route-name']?>" class="d-nav-item <?=($seg1=='faq'?'active':'')?>">
      <i class="fa fa-question-circle"></i> <?=lang($header_elements['faq']['name'])?>
    </a>

    <?php if (get_option('enable_api_tab')): ?>
    <span class="d-sidebar-section">Developer</span>
    <a href="<?=cn($header_elements['api']['route-name'])?>" class="d-nav-item <?=($seg2=='docs'?'active':'')?>">
      <i class="fa fa-code"></i> <?=lang($header_elements['api']['name'])?>
    </a>
    <?php endif; ?>

    <?php if ($enable_affiliate): ?>
    <span class="d-sidebar-section">Rewards</span>
    <a href="<?=cn($header_elements['affiliates']['route-name'])?>" class="d-nav-item <?=($seg2==$header_elements['affiliates']['route-name']?'active':'')?>">
      <i class="fa fa-users"></i> <?=lang($header_elements['affiliates']['name'])?>
    </a>
    <?php endif; ?>

    <span class="d-sidebar-section">Account</span>
    <a href="<?=cn('profile')?>" class="d-nav-item <?=($seg1=='profile'?'active':'')?>">
      <i class="fa fa-user-circle"></i> <?=lang('Profile')?>
    </a>

  </nav>

  <!-- Sidebar footer -->
  <div class="d-sidebar-footer">
    <a href="<?=cn('auth/logout')?>" class="d-sidebar-logout">
      <i class="fa fa-sign-out"></i> <?=lang('Sign_out')?>
    </a>
  </div>

</aside>

<!-- TOPBAR -->
<header class="d-header" id="dHeader">
  <div class="d-header-left">
    <!-- Mobile toggle -->
    <button class="d-header-icon-btn d-mob-toggle" id="dMobToggle" onclick="toggleDashSidebar()" aria-label="Menu" style="display:none">
      <i class="fa fa-bars"></i>
    </button>
    <!-- Page breadcrumb -->
    <div style="font-size:13px;font-weight:600;color:var(--d-muted)">
      <?php if (allowed_search_bar(segment(1)) || allowed_search_bar(segment(2))): ?>
        <?php echo Modules::run('blocks/search_box'); ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="d-header-right">

    <!-- Balance chip -->
    <div style="display:flex;align-items:center;gap:6px;background:var(--d-olt);border:1px solid rgba(230,126,34,.3);border-radius:10px;padding:6px 14px;font-size:13px;font-weight:700;color:var(--d-orange);white-space:nowrap">
      <i class="fa fa-wallet" style="font-size:13px"></i>
      <span><?=$currency.$balance?></span>
      <a href="<?=cn('add_funds')?>" style="background:var(--d-orange);color:#fff;font-size:11px;font-weight:700;padding:2px 9px;border-radius:6px;text-decoration:none;margin-left:4px">+ Add</a>
    </div>

    <!-- Back to admin -->
    <?php if (session('uid_tmp')): ?>
    <a href="<?=cn('back-to-admin')?>" class="d-header-icon-btn" title="Back to Admin">
      <i class="fa fa-sign-out"></i>
    </a>
    <?php endif; ?>

    <!-- News / Announcements -->
    <?php if (get_option('enable_news_announcement') == 1): ?>
    <a href="<?=cn('news-annoucement')?>" class="d-header-icon-btn ajaxModal" title="<?=lang('news__announcement')?>">
      <i class="fa fa-bell"></i>
      <?php if (!(isset($_COOKIE['news_annoucement']) && $_COOKIE['news_annoucement'] == 'clicked')): ?>
      <span class="d-notif-dot"></span>
      <?php endif; ?>
    </a>
    <?php endif; ?>

    <!-- Tickets shortcut -->
    <a href="<?=cn('tickets')?>" class="d-header-icon-btn" title="Support Tickets">
      <i class="fa fa-comments"></i>
      <?php if ($total_unread_tickets > 0): ?>
      <span class="d-notif-dot"></span>
      <?php endif; ?>
    </a>

    <!-- User dropdown -->
    <div class="d-user-menu" id="dUserMenu">
      <button class="d-user-trigger" onclick="toggleUserMenu()" type="button">
        <div class="d-user-avatar"><?=$initial?></div>
        <span class="d-user-name"><?=$first_name?></span>
        <i class="fa fa-angle-down" style="font-size:11px;color:var(--d-muted);margin-left:2px"></i>
      </button>
      <div class="d-user-dropdown" id="dUserDropdown">
        <div style="padding:10px 14px 8px;border-bottom:1px solid var(--d-border);margin-bottom:4px">
          <div style="font-size:13px;font-weight:700;color:var(--d-navy)"><?=$first_name?> <?=$last_name?></div>
          <div style="font-size:11px;color:var(--d-muted)"><?=$currency.$balance?> balance</div>
        </div>
        <a href="<?=cn('profile')?>"><i class="fa fa-user" style="width:16px;text-align:center;color:var(--d-muted)"></i> <?=lang('Profile')?></a>
        <a href="<?=cn('transactions')?>"><i class="fa fa-history" style="width:16px;text-align:center;color:var(--d-muted)"></i> <?=lang('transactions')?></a>
        <a href="<?=cn('add_funds')?>"><i class="fa fa-credit-card" style="width:16px;text-align:center;color:var(--d-muted)"></i> <?=lang($header_elements['add_funds']['name'])?></a>
        <div style="height:1px;background:var(--d-border);margin:4px 0"></div>
        <a href="<?=cn('auth/logout')?>" style="color:#ef4444"><i class="fa fa-sign-out" style="width:16px;text-align:center"></i> <?=lang('Sign_out')?></a>
      </div>
    </div>

  </div>
</header>

<style>
/* User menu dropdown */
.d-user-menu{position:relative}
.d-user-trigger{display:flex;align-items:center;gap:8px;background:var(--d-bg);border:1px solid var(--d-border);border-radius:10px;padding:5px 12px 5px 6px;cursor:pointer;transition:all .2s}
.d-user-trigger:hover{border-color:var(--d-orange);background:var(--d-olt)}
.d-user-avatar{width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,var(--d-navy),var(--d-orange));display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:#fff;flex-shrink:0}
.d-user-name{font-size:13px;font-weight:600;color:var(--d-navy);white-space:nowrap}
.d-user-dropdown{display:none;position:absolute;top:calc(100% + 8px);right:0;background:#fff;border:1px solid var(--d-border);border-radius:14px;padding:6px;min-width:190px;box-shadow:0 12px 30px rgba(0,0,0,.1);z-index:500}
.d-user-dropdown.open{display:block}
.d-user-dropdown a{display:flex;align-items:center;gap:8px;padding:9px 12px;color:var(--d-text);font-size:13px;border-radius:8px;text-decoration:none;transition:all .2s;font-weight:500}
.d-user-dropdown a:hover{background:var(--d-bg);color:var(--d-navy)}
/* Mobile sidebar toggle */
@media(max-width:1024px){
  .d-mob-toggle{display:flex!important}
  .d-user-name{display:none}
}
@media(max-width:600px){
  .d-user-name{display:none}
}
</style>

<script>
function toggleUserMenu(){
  document.getElementById('dUserDropdown').classList.toggle('open');
}
document.addEventListener('click', function(e){
  var menu = document.getElementById('dUserMenu');
  if (menu && !menu.contains(e.target)) {
    var dd = document.getElementById('dUserDropdown');
    if (dd) dd.classList.remove('open');
  }
});
function toggleDashSidebar(){
  var s = document.getElementById('dSidebar');
  if(s) s.classList.toggle('open');
}
function closeDashSidebar(){
  var s = document.getElementById('dSidebar');
  if(s) s.classList.remove('open');
}
</script>
