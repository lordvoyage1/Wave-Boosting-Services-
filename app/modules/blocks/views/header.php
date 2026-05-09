<?php
$current_seg  = segment(1);
$current_seg2 = segment(2);
$user_name    = session('user_name') ?: 'User';
$user_email   = session('user_email') ?: '';
$user_balance = session('user_balance');
$currency_sym = get_option('currency_symbol', '$');
$initials     = strtoupper(substr($user_name, 0, 1));

function d_nav($url, $icon, $label, $seg, $current) {
    $active = ($current == $seg) ? ' active' : '';
    return '<a class="d-nav-item'.$active.'" href="'.cn($url).'"><i class="fe '.$icon.'"></i>'.$label.'</a>';
}
$ticket_count = 0;
try {
    $CI =& get_instance();
    $ticket_count = (int)$CI->db->where(['user_id' => session('uid'), 'user_read' => 1])->count_all_results('tickets');
} catch(Exception $e) {}
?>
<!-- SIDEBAR -->
<aside class="d-sidebar" id="dSidebar">
  <div class="d-sidebar-brand">
    <img src="<?=get_option('website_logo', BASE.'assets/images/logo.png')?>" alt="Logo" onerror="this.style.display='none'">
    <div class="d-sidebar-brand-text">
      <span class="d-sidebar-brand-name"><?=get_option('website_title', 'Loishvizo')?></span>
      <span class="d-sidebar-brand-tag">SMM Panel</span>
    </div>
  </div>

  <nav class="d-sidebar-nav">
    <span class="d-sidebar-section">Main</span>
    <?=d_nav('statistics', 'fe-home', 'Dashboard', 'statistics', $current_seg)?>
    <?=d_nav('order/new_order', 'fe-plus-circle', 'New Order', 'new_order', $current_seg2)?>
    <?=d_nav('services', 'fe-grid', 'Services', 'services', $current_seg)?>
    <?=d_nav('order', 'fe-list', 'Order Logs', 'order', $current_seg)?>

    <span class="d-sidebar-section">Advanced</span>
    <?=d_nav('dripfeed', 'fe-droplet', 'Drip-feed', 'dripfeed', $current_seg)?>
    <?=d_nav('subscriptions', 'fe-refresh-cw', 'Subscriptions', 'subscriptions', $current_seg)?>

    <span class="d-sidebar-section">Account</span>
    <?=d_nav('add_funds', 'fe-dollar-sign', 'Add Funds', 'add_funds', $current_seg)?>
    <a class="d-nav-item<?=($current_seg=='tickets')?' active':''?>" href="<?=cn('tickets')?>">
      <i class="fe fe-message-circle"></i>Support Tickets
      <?php if ($ticket_count > 0): ?><span class="d-badge"><?=$ticket_count?></span><?php endif; ?>
    </a>
  </nav>

  <div class="d-sidebar-footer">
    <a class="d-sidebar-logout" href="<?=cn('auth/logout')?>">
      <i class="fe fe-log-out"></i> Logout
    </a>
  </div>
</aside>

<!-- TOP HEADER -->
<header class="d-header" id="dHeader">
  <div class="d-header-left">
    <button class="d-hamburger" id="dHamburger" onclick="toggleDashSidebar()" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
    <div class="d-page-title" id="dPageTitle">
      <?php
      $titles = [
        'statistics'    => 'Dashboard',
        'order'         => 'Order Logs',
        'services'      => 'Services',
        'dripfeed'      => 'Drip-feed',
        'subscriptions' => 'Subscriptions',
        'add_funds'     => 'Add Funds',
        'tickets'       => 'Support Tickets',
      ];
      $pg = ($current_seg2 == 'new_order') ? 'New Order' : (isset($titles[$current_seg]) ? $titles[$current_seg] : ucfirst(str_replace('_',' ',$current_seg)));
      echo $pg;
      ?>
    </div>
  </div>

  <div class="d-header-right">
    <div class="d-balance-chip">
      <span class="d-bal-label">Balance</span>
      <span class="d-bal-val"><?=$currency_sym?><?=number_format((float)$user_balance, 2)?></span>
    </div>
    <a href="<?=cn('add_funds')?>" class="d-btn-addfunds">
      <i class="fe fe-plus"></i> Add Funds
    </a>
    <div class="d-dropdown">
      <button class="d-user-btn" id="userDropBtn" onclick="toggleUserDrop()" type="button">
        <div class="d-user-avatar"><?=$initials?></div>
        <span class="d-user-name d-none d-sm-inline"><?=esc($user_name)?></span>
        <i class="fe fe-chevron-down" style="font-size:11px;color:var(--d-muted)"></i>
      </button>
      <div class="d-dropdown-menu" id="userDropMenu">
        <a class="d-dropdown-item" href="<?=cn('profile')?>">
          <i class="fe fe-user"></i> Profile
        </a>
        <a class="d-dropdown-item" href="<?=cn('profile/api')?>">
          <i class="fe fe-code"></i> API Access
        </a>
        <hr class="d-dropdown-divider">
        <a class="d-dropdown-item danger" href="<?=cn('auth/logout')?>">
          <i class="fe fe-log-out"></i> Logout
        </a>
      </div>
    </div>
  </div>
</header>

<script>
function toggleDashSidebar(){
  document.getElementById('dSidebar').classList.toggle('open');
  document.getElementById('dOverlay').classList.toggle('show');
}
function closeDashSidebar(){
  document.getElementById('dSidebar').classList.remove('open');
  document.getElementById('dOverlay').classList.remove('show');
}
function toggleUserDrop(){
  document.getElementById('userDropMenu').classList.toggle('show');
}
document.addEventListener('click', function(e){
  var btn = document.getElementById('userDropBtn');
  var menu = document.getElementById('userDropMenu');
  if(btn && menu && !btn.contains(e.target) && !menu.contains(e.target)){
    menu.classList.remove('show');
  }
});
</script>
