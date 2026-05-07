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
  $initial = strtoupper(substr($first_name, 0, 1));

  $enable_affiliate = false;
  if (is_table_exists(AFFILIATE) && get_option('affiliate_mode', 0)) {
    $item_affiliate = $CI->model->get('status', AFFILIATE, ['uid' => session('uid')], '', '', true);
    if (!$item_affiliate || $item_affiliate['status']) $enable_affiliate = true;
  }
?>
<style>
/* ── LV USER TOPBAR ── */
.lv-top-bar{position:fixed;top:0;left:0;right:0;height:64px;z-index:1000;display:flex;align-items:center;padding:0 20px;gap:12px;background:rgba(6,1,15,.97);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07)}
.lv-top-logo{width:220px;display:flex;align-items:center;gap:9px;flex-shrink:0;text-decoration:none}
.lv-top-logo img{height:34px;width:34px;border-radius:50%;object-fit:cover;border:2px solid rgba(124,34,248,.6)}
.lv-top-logo-text{line-height:1.1}
.lv-top-logo-name{font-size:13px;font-weight:800;color:#fff;display:block}
.lv-top-logo-sub{font-size:9px;color:#06d6a0;letter-spacing:1.2px;text-transform:uppercase;font-weight:600}
.lv-top-spacer{flex:1}
.lv-top-balance{display:flex;align-items:center;gap:6px;background:rgba(124,34,248,.15);border:1px solid rgba(124,34,248,.3);border-radius:9px;padding:6px 14px;font-size:13px;font-weight:700;color:#fff;white-space:nowrap}
.lv-top-bal-icon{color:#06d6a0;font-size:14px}
.lv-top-action{width:36px;height:36px;border-radius:9px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.6);font-size:15px;transition:all .2s;cursor:pointer;text-decoration:none;position:relative}
.lv-top-action:hover{background:rgba(255,255,255,.12);color:#fff}
.lv-top-dot{position:absolute;top:5px;right:5px;width:7px;height:7px;border-radius:50%;background:#ef4444;border:1.5px solid #06010f}
.lv-top-user-btn{display:flex;align-items:center;gap:8px;cursor:pointer;padding:4px 10px;border-radius:10px;transition:all .2s;position:relative}
.lv-top-user-btn:hover{background:rgba(255,255,255,.05)}
.lv-top-avatar{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#7c22f8,#06d6a0);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:800;color:#fff;flex-shrink:0}
.lv-top-uname{font-size:13px;font-weight:600;color:rgba(255,255,255,.8)}
.lv-top-udrop{position:absolute;top:calc(100% + 10px);right:0;background:#12022e;border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:6px;min-width:175px;box-shadow:0 20px 40px rgba(0,0,0,.5);display:none;z-index:300}
.lv-top-user-btn:hover .lv-top-udrop{display:block}
.lv-top-udrop a{display:flex;align-items:center;gap:8px;padding:9px 12px;color:rgba(255,255,255,.7);font-size:13px;border-radius:8px;text-decoration:none;transition:all .2s}
.lv-top-udrop a:hover{background:rgba(255,255,255,.06);color:#fff}
.lv-top-udrop .lv-logout{color:#f87171}
.lv-top-udrop-sep{height:1px;background:rgba(255,255,255,.07);margin:4px 0}
.lv-mob-toggle{display:none;background:none;border:none;color:rgba(255,255,255,.7);font-size:20px;cursor:pointer;padding:4px}

/* ── LV USER SIDEBAR ── */
.lv-user-sidebar{position:fixed;left:0;top:64px;bottom:0;width:220px;background:rgba(6,1,15,.99);border-right:1px solid rgba(255,255,255,.06);overflow-y:auto;z-index:999;padding:12px 8px;transition:transform .3s}
.lv-user-sidebar::-webkit-scrollbar{width:3px}
.lv-user-sidebar::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:2px}
.lv-sidebar-group{margin-bottom:2px}
.lv-sidebar-glabel{font-size:9.5px;font-weight:700;color:rgba(255,255,255,.2);letter-spacing:1.5px;text-transform:uppercase;padding:8px 12px 4px}
.lv-sidebar-link{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;color:rgba(255,255,255,.55);font-size:13px;font-weight:500;transition:all .2s;text-decoration:none}
.lv-sidebar-link:hover{background:rgba(255,255,255,.05);color:#fff;text-decoration:none}
.lv-sidebar-link.lv-active{background:rgba(124,34,248,.2);color:#fff;border:1px solid rgba(124,34,248,.28)}
.lv-sidebar-link.lv-active .lv-sl-ic{color:#a78bfa}
.lv-sl-ic{width:17px;text-align:center;font-size:14px;flex-shrink:0;opacity:.7}
.lv-sidebar-link.lv-active .lv-sl-ic{opacity:1}
.lv-sl-badge{margin-left:auto;background:#7c22f8;color:#fff;font-size:10px;font-weight:700;padding:1px 6px;border-radius:50px;min-width:18px;text-align:center}
.lv-sidebar-sep{height:1px;background:rgba(255,255,255,.05);margin:6px 4px}

/* ── MAIN CONTENT AREA ── */
.lv-user-main{margin-left:220px;padding-top:64px;min-height:100vh;background:#06010f}
.lv-overlay-mob{display:none;position:fixed;inset:0;background:rgba(0,0,0,.7);z-index:998}
.lv-overlay-mob.open{display:block}
@media(max-width:1024px){
  .lv-user-sidebar{transform:translateX(-220px)}
  .lv-user-sidebar.open{transform:translateX(0);z-index:1001}
  .lv-user-main{margin-left:0}
  .lv-mob-toggle{display:block}
  .lv-top-logo{width:auto}
  .lv-top-balance .lv-top-bal-label{display:none}
}
@media(max-width:600px){
  .lv-top-uname{display:none}
  .lv-top-balance span.lv-top-bal-label{display:none}
}
</style>

<!-- Mobile overlay -->
<div class="lv-overlay-mob" id="lvMobOverlay" onclick="lvCloseSidebar()"></div>

<!-- TOPBAR -->
<div class="lv-top-bar">
  <!-- Brand logo -->
  <button class="lv-mob-toggle" id="lvMobToggle" onclick="lvToggleSidebar()" aria-label="Menu">
    <i class="fa fa-bars"></i>
  </button>
  <a href="<?=cn('statistics')?>" class="lv-top-logo">
    <img src="<?=get_option('website_logo', BASE.'assets/images/logo.png')?>" alt="Loishvizo">
    <div class="lv-top-logo-text">
      <span class="lv-top-logo-name">Loishvizo</span>
      <span class="lv-top-logo-sub">Boosting Solutions</span>
    </div>
  </a>
  <div class="lv-top-spacer">
    <?php if (allowed_search_bar(segment(1)) || allowed_search_bar(segment(2))): ?>
    <div style="max-width:340px;display:none" class="d-lg-block">
      <?php echo Modules::run('blocks/search_box'); ?>
    </div>
    <?php endif; ?>
  </div>

  <!-- Balance -->
  <div class="lv-top-balance">
    <i class="fa fa-dollar lv-top-bal-icon"></i>
    <span><?=$currency.$balance?></span>
  </div>

  <!-- Back to admin -->
  <?php if (session('uid_tmp')): ?>
  <a href="<?=cn('back-to-admin')?>" class="lv-top-action" title="Back to Admin">
    <i class="fa fa-sign-out"></i>
  </a>
  <?php endif; ?>

  <!-- News / Bell -->
  <?php if (get_option('enable_news_announcement') == 1): ?>
  <a href="<?=cn('news-annoucement')?>" class="lv-top-action ajaxModal" title="<?=lang('news__announcement')?>">
    <i class="fa fa-bell"></i>
    <?php if (!(isset($_COOKIE['news_annoucement']) && $_COOKIE['news_annoucement'] == 'clicked')): ?>
    <span class="lv-top-dot"></span>
    <?php endif; ?>
  </a>
  <?php endif; ?>

  <!-- Tickets shortcut -->
  <a href="<?=cn('tickets')?>" class="lv-top-action" title="Support Tickets">
    <i class="fa fa-comments"></i>
    <?php if ($total_unread_tickets > 0): ?>
    <span class="lv-top-dot"></span>
    <?php endif; ?>
  </a>

  <!-- User menu -->
  <div class="lv-top-user-btn">
    <div class="lv-top-avatar"><?=$initial?></div>
    <span class="lv-top-uname"><?=$first_name?></span>
    <i class="fa fa-angle-down" style="color:rgba(255,255,255,.4);font-size:12px"></i>
    <div class="lv-top-udrop">
      <div style="padding:8px 12px 6px;border-bottom:1px solid rgba(255,255,255,.07);margin-bottom:4px">
        <div style="font-size:13px;font-weight:700;color:#fff"><?=$first_name?></div>
        <div style="font-size:11px;color:rgba(255,255,255,.4)"><?=$currency.$balance?> balance</div>
      </div>
      <a href="<?=cn('profile')?>"><i class="fa fa-user" style="width:16px;text-align:center"></i> <?=lang('Profile')?></a>
      <a href="<?=cn('transactions')?>"><i class="fa fa-history" style="width:16px;text-align:center"></i> <?=lang('transactions')?></a>
      <div class="lv-top-udrop-sep"></div>
      <a href="<?=cn('auth/logout')?>" class="lv-logout"><i class="fa fa-sign-out" style="width:16px;text-align:center"></i> <?=lang('Sign_out')?></a>
    </div>
  </div>
</div>

<!-- SIDEBAR -->
<nav class="lv-user-sidebar" id="lvSidebar">
  <!-- MAIN -->
  <div class="lv-sidebar-group">
    <div class="lv-sidebar-glabel">Main</div>
    <a href="<?=cn($header_elements['statistics']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)==$header_elements['statistics']['route-name']?'lv-active':'')?>">
      <i class="fa fa-tachometer lv-sl-ic"></i> Dashboard
    </a>
    <a href="<?=cn($header_elements['new_order']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)=='new_order'?'lv-active':'')?>">
      <i class="fa fa-plus-circle lv-sl-ic"></i> New Order
    </a>
    <a href="<?=cn($header_elements['services']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)==$header_elements['services']['route-name']?'lv-active':'')?>">
      <i class="fa fa-list lv-sl-ic"></i> <?=lang($header_elements['services']['name'])?>
    </a>
  </div>

  <div class="lv-sidebar-sep"></div>

  <!-- ORDERS -->
  <div class="lv-sidebar-group">
    <div class="lv-sidebar-glabel">Orders</div>
    <a href="<?=cn($header_elements['order']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)=='order'&&segment(2)!='new_order'?'lv-active':'')?>">
      <i class="fa fa-inbox lv-sl-ic"></i> <?=lang($header_elements['order']['name'])?>
    </a>
    <a href="<?=cn($header_elements['dripfeed']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)==$header_elements['dripfeed']['route-name']?'lv-active':'')?>">
      <i class="fa fa-clock-o lv-sl-ic"></i> <?=lang($header_elements['dripfeed']['name'])?>
    </a>
    <a href="<?=cn($header_elements['subscriptions']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)==$header_elements['subscriptions']['route-name']?'lv-active':'')?>">
      <i class="fa fa-repeat lv-sl-ic"></i> <?=lang($header_elements['subscriptions']['name'])?>
    </a>
    <?php if (is_table_exists(ORDERS_REFILL)): ?>
    <a href="<?=cn($header_elements['refill']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)==$header_elements['refill']['route-name']?'lv-active':'')?>">
      <i class="fa fa-refresh lv-sl-ic"></i> <?=lang($header_elements['refill']['name'])?>
    </a>
    <?php endif; ?>
  </div>

  <div class="lv-sidebar-sep"></div>

  <!-- FINANCE -->
  <div class="lv-sidebar-group">
    <div class="lv-sidebar-glabel">Finance</div>
    <a href="<?=cn($header_elements['add_funds']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)==$header_elements['add_funds']['route-name']?'lv-active':'')?>">
      <i class="fa fa-credit-card lv-sl-ic"></i> <?=lang($header_elements['add_funds']['name'])?>
    </a>
    <a href="<?=cn($header_elements['transactions']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)==$header_elements['transactions']['route-name']?'lv-active':'')?>">
      <i class="fa fa-exchange lv-sl-ic"></i> <?=lang($header_elements['transactions']['name'])?>
    </a>
  </div>

  <div class="lv-sidebar-sep"></div>

  <!-- SUPPORT -->
  <div class="lv-sidebar-group">
    <div class="lv-sidebar-glabel">Support</div>
    <a href="<?=cn($header_elements['tickets']['route-name'])?>" class="lv-sidebar-link <?=(segment(1)==$header_elements['tickets']['route-name']?'lv-active':'')?>">
      <i class="fa fa-comments lv-sl-ic"></i>
      <?=lang($header_elements['tickets']['name'])?>
      <?php if ($total_unread_tickets > 0): ?>
      <span class="lv-sl-badge"><?=$total_unread_tickets?></span>
      <?php endif; ?>
    </a>
    <a href="<?=$header_elements['faq']['route-name']?>" class="lv-sidebar-link <?=(segment(1)=='faq'?'lv-active':'')?>">
      <i class="fa fa-question-circle lv-sl-ic"></i> <?=lang($header_elements['faq']['name'])?>
    </a>
  </div>

  <?php if (get_option('enable_api_tab')): ?>
  <div class="lv-sidebar-sep"></div>
  <div class="lv-sidebar-group">
    <div class="lv-sidebar-glabel">Developer</div>
    <a href="<?=cn($header_elements['api']['route-name'])?>" class="lv-sidebar-link <?=(segment(2)=='docs'?'lv-active':'')?>">
      <i class="fa fa-code lv-sl-ic"></i> <?=lang($header_elements['api']['name'])?>
    </a>
  </div>
  <?php endif; ?>

  <?php if ($enable_affiliate): ?>
  <div class="lv-sidebar-sep"></div>
  <div class="lv-sidebar-group">
    <div class="lv-sidebar-glabel">Rewards</div>
    <a href="<?=cn($header_elements['affiliates']['route-name'])?>" class="lv-sidebar-link <?=(segment(2)==$header_elements['affiliates']['route-name']?'lv-active':'')?>">
      <i class="fa fa-users lv-sl-ic"></i> <?=lang($header_elements['affiliates']['name'])?>
    </a>
  </div>
  <?php endif; ?>

  <div class="lv-sidebar-sep"></div>

  <!-- ACCOUNT -->
  <div class="lv-sidebar-group">
    <div class="lv-sidebar-glabel">Account</div>
    <a href="<?=cn('profile')?>" class="lv-sidebar-link <?=(segment(1)=='profile'?'lv-active':'')?>">
      <i class="fa fa-user-circle lv-sl-ic"></i> <?=lang('Profile')?>
    </a>
    <a href="<?=cn('auth/logout')?>" class="lv-sidebar-link" style="color:rgba(248,113,113,.75)">
      <i class="fa fa-sign-out lv-sl-ic" style="opacity:1"></i> <?=lang('Sign_out')?>
    </a>
  </div>

  <!-- Sidebar bottom brand -->
  <div style="padding:16px 12px;margin-top:10px;text-align:center">
    <div style="font-size:10px;color:rgba(255,255,255,.2);line-height:1.5">
      Loishvizo Boosting Solutions<br>
      <span style="color:rgba(6,214,160,.4)">Ultra Speed SMM</span>
    </div>
  </div>
</nav>

<script>
function lvToggleSidebar(){
  var s=document.getElementById('lvSidebar');
  var o=document.getElementById('lvMobOverlay');
  s.classList.toggle('open');
  o.classList.toggle('open');
}
function lvCloseSidebar(){
  document.getElementById('lvSidebar').classList.remove('open');
  document.getElementById('lvMobOverlay').classList.remove('open');
}
</script>
