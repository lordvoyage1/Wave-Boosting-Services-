<?php
$CI = &get_instance();
$CI->load->model('model');
$total_unread_tickets = $CI->model->count_results('id', TICKETS, ['user_read' => 1, 'uid' => session('uid')]);
$enable_item_api_menu = get_option('enable_api_tab');

$sidebar_elements = app_config('controller')['user'];
if (!is_table_exists(AFFILIATE) || !get_option('affiliate_mode', 0)) unset($sidebar_elements['affiliates']);
if (is_table_exists(AFFILIATE)) {
  $item_affiliate = $CI->model->get('status', AFFILIATE, ['uid' => session('uid')], '', '', true);
  if ($item_affiliate && !$item_affiliate['status']) unset($sidebar_elements['affiliates']);
}
if (!is_table_exists(ORDERS_REFILL)) unset($sidebar_elements['refill']);

$icon_map = [
  'statistics'    => 'fe fe-bar-chart-2',
  'new_order'     => 'fe fe-shopping-cart',
  'order'         => 'fe fe-list',
  'dripfeed'      => 'fe fe-droplet',
  'subscriptions' => 'fe fe-refresh-cw',
  'refill'        => 'fe fe-rotate-cw',
  'services'      => 'fe fe-grid',
  'add_funds'     => 'fe fe-dollar-sign',
  'transactions'  => 'fe fe-file-text',
  'tickets'       => 'fe fe-message-circle',
  'faq'           => 'fe fe-help-circle',
  'api'           => 'fe fe-code',
  'affiliates'    => 'fe fe-percent',
  'terms'         => 'fe fe-shield',
];
?>

<div class="d-overlay" id="dOverlay"></div>
<aside class="d-sidebar" id="dSidebar">
  <!-- Brand -->
  <div class="d-sidebar-brand">
    <a href="<?=cn('statistics')?>">
      <img src="<?=get_option('website_logo', BASE.'assets/images/favicon.png')?>" alt="Logo">
    </a>
    <div class="d-sidebar-brand-text">
      <span class="d-sidebar-brand-name"><?=get_option('website_name','Loishvizo')?></span>
      <span class="d-sidebar-brand-tag">SMM Dashboard</span>
    </div>
  </div>

  <!-- Nav -->
  <nav class="d-sidebar-nav">
    <?php foreach ($sidebar_elements as $key => $item):
      if ($key == 'api' && !$enable_item_api_menu) continue;
      if ($item['area_title']): ?>
        <span class="d-sidebar-section"><?=lang($item['name'])?></span>
      <?php else:
        $route_name = $item['route-name'];
        $is_active  = ($route_name == segment(1)) ? 'active' : '';
        $icon       = isset($icon_map[$key]) ? $icon_map[$key] : $item['icon'];
    ?>
    <a class="d-nav-item <?=$is_active?>" href="<?=cn($route_name)?>">
      <i class="<?=$icon?>"></i>
      <span><?=lang($item['name'])?></span>
      <?php if ($key == 'tickets' && $total_unread_tickets > 0): ?>
      <span class="d-badge"><?=$total_unread_tickets?></span>
      <?php endif; ?>
    </a>
    <?php endif; endforeach; ?>
  </nav>

  <!-- Footer -->
  <div class="d-sidebar-footer">
    <a href="<?=cn('auth/logout')?>" class="d-sidebar-logout">
      <i class="fe fe-power"></i>
      <span><?=lang('Logout')?></span>
    </a>
  </div>
</aside>
