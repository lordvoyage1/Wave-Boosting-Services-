<?php
$items_category = array_column($items_category, 'id', 'name');
$items_category = array_flip(array_intersect_key($items_category, array_flip(array_keys($items))));
?>
<div class="d-page-header">
  <h1><i class="fe fe-grid"></i> <?=lang("Services")?></h1>
  <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
    <?php if (get_option("enable_explication_service_symbol")): ?>
    <div style="display:flex;gap:6px;flex-wrap:wrap">
      <?php foreach(['⭐'=>lang("__good_seller"),'⚡️'=>lang("__speed_level"),'🔥'=>lang("__hot_service"),'💎'=>lang("__best_service"),'💧'=>lang("__drip_feed")] as $sym=>$lbl): ?>
      <span style="padding:4px 10px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:20px;font-size:11px;color:rgba(255,255,255,.6)"><?=$sym?> <?=$lbl?></span>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <select name="status" class="d-select ajaxChange" data-url="<?=cn($controller_name."/sort/")?>" style="min-width:160px;width:auto">
      <option value="0"><?=lang("all")?></option>
      <?php foreach ($items_category as $key => $category): ?>
      <option value="<?=$key?>"><?=$category?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>
<div id="result_ajaxSearch">
<?php if(!empty($items)):
  $data = ["controller_name"=>$controller_name,"params"=>$params,"columns"=>$columns,"items"=>$items,"items_custom_rate"=>$items_custom_rate];
  $this->load->view('child/index', $data);
else: echo show_empty_item(); endif; ?>
</div>
<!-- keep old section tag close for safety -->
