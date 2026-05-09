<?php
$icon_map = [
  'bg-blue'   => ['icon' => 'fe fe-shopping-cart', 'cls' => 'purple'],
  'bg-green'  => ['icon' => 'fe fe-check-circle',  'cls' => 'green'],
  'bg-yellow' => ['icon' => 'fe fe-clock',          'cls' => 'amber'],
  'bg-red'    => ['icon' => 'fe fe-x-circle',       'cls' => 'red'],
  'bg-azure'  => ['icon' => 'fe fe-bar-chart-2',    'cls' => 'blue'],
  'bg-teal'   => ['icon' => 'fe fe-dollar-sign',    'cls' => 'green'],
  'bg-indigo' => ['icon' => 'fe fe-trending-up',    'cls' => 'purple'],
  'bg-purple' => ['icon' => 'fe fe-layers',         'cls' => 'purple'],
  'bg-orange' => ['icon' => 'fe fe-alert-circle',   'cls' => 'amber'],
];
?>

<!-- Account Stats -->
<?php if ($header_area): ?>
<div class="d-stats-grid d-mb-20">
  <?php foreach ($header_area as $key => $item):
    $icon_entry = isset($icon_map[$item['class']]) ? $icon_map[$item['class']] : ['icon' => $item['icon'], 'cls' => 'purple'];
  ?>
  <div class="d-stat-card">
    <div class="d-stat-icon <?=$icon_entry['cls']?>">
      <i class="<?=$icon_entry['icon']?>"></i>
    </div>
    <div class="d-stat-info">
      <div class="d-stat-val"><?=$item['value']?></div>
      <div class="d-stat-label"><?=$item['name']?></div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- Charts -->
<div class="d-grid-2 d-mb-20">
  <div class="d-card">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-trending-up" style="color:var(--d-purple)"></i> <?=lang("recent_orders")?></span>
    </div>
    <div class="d-card-body" style="padding-bottom:12px">
      <div id="orders_chart_spline" style="height:220px"></div>
    </div>
  </div>
  <div class="d-card">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-pie-chart" style="color:var(--d-green)"></i> <?=lang("order_breakdown")?></span>
    </div>
    <div class="d-card-body" style="padding-bottom:12px">
      <div id="orders_chart_pie" style="height:220px"></div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  Chart_template.chart_spline('#orders_chart_spline', <?=$chart_and_orders_area['chart_spline']?>);
  Chart_template.chart_pie('#orders_chart_pie', <?=$chart_and_orders_area['chart_pie']?>);
});
</script>

<!-- Order Stats -->
<?php if ($chart_and_orders_area && !empty($chart_and_orders_area['orders_statistics'])): ?>
<div class="d-stats-grid d-mb-20">
  <?php foreach ($chart_and_orders_area['orders_statistics'] as $item):
    $icon_entry = isset($icon_map[$item['class']]) ? $icon_map[$item['class']] : ['icon' => $item['icon'], 'cls' => 'blue'];
  ?>
  <div class="d-stat-card">
    <div class="d-stat-icon <?=$icon_entry['cls']?>">
      <i class="<?=(strpos($item['icon'],'fe fe-') === 0 ? $item['icon'] : $icon_entry['icon'])?>"></i>
    </div>
    <div class="d-stat-info">
      <div class="d-stat-val"><?=$item['value']?></div>
      <div class="d-stat-label"><?=$item['name']?></div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- Top Bestsellers -->
<?php $this->load->view('top_bestsellers'); ?>
