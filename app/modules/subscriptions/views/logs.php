<?php $show_search_area = show_search_area($controller_name, $params, 'user'); ?>

<div class="d-page-header">
  <h1><i class="fe fe-refresh-cw"></i> <?=lang("subscriptions")?></h1>
  <a href="<?=cn("order/new_order")?>" class="d-btn d-btn-primary">
    <i class="fe fe-plus"></i> <?=lang("add_new")?>
  </a>
</div>

<div class="d-search-row d-mb-16">
  <div class="d-filter-pills">
    <a class="d-pill <?=($params['filter']['status'] == 'all') ? 'active' : ''?>" href="<?=cn($controller_name)?>"><?=lang('All')?></a>
    <?php if (!empty($order_status_array)) foreach ($order_status_array as $row_status): ?>
    <a class="d-pill <?=($params['filter']['status'] == $row_status) ? 'active' : ''?>" href="<?=cn($controller_name.'?status='.$row_status)?>">
      <?=order_status_title($row_status)?>
    </a>
    <?php endforeach; ?>
  </div>
  <div><?=$show_search_area?></div>
</div>

<div id="result_ajaxSearch">
  <?php $this->load->view('child/index', ['items' => $items, 'controller_name' => $controller_name]); ?>
</div>
