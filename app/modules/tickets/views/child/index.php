<?php
$item_link_detail = cn($controller_name.'/'.$item['id']);
$status_map = [
  'closed'   => ['cls' => 'd-s-error',     'icon' => 'fe fe-x-circle',     'color' => 'rgba(255,255,255,.3)'],
  'pending'  => ['cls' => 'd-s-pending',   'icon' => 'fe fe-clock',         'color' => '#fbbf24'],
  'answered' => ['cls' => 'd-s-completed', 'icon' => 'fe fe-check-circle',  'color' => '#06d6a0'],
];
$s = isset($status_map[$item['status']]) ? $status_map[$item['status']] : ['cls'=>'d-s-pending','icon'=>'fe fe-circle','color'=>'#fbbf24'];
?>
<a href="<?=$item_link_detail?>" style="text-decoration:none;display:block;margin-bottom:8px">
<div class="d-ticket-item tr_<?=$item['ids']?>">
  <div class="d-ticket-icon">
    <i class="<?=$s['icon']?>" style="font-size:18px;color:<?=$s['color']?>"></i>
  </div>
  <div class="d-ticket-body">
    <div class="d-ticket-title" style="<?=($item['status']=='closed')?'opacity:.5':''?>">
      #<?=$item['id']?> — <?=esc($item['subject'])?>
      <?php if ($item['user_read']): ?>
      <span style="background:var(--d-amber);color:#000;font-size:9px;font-weight:800;padding:2px 7px;border-radius:10px;margin-left:6px;vertical-align:middle">NEW</span>
      <?php endif; ?>
    </div>
    <div class="d-ticket-meta"><?=convert_timezone($item['changed'], 'user')?></div>
  </div>
  <div style="flex-shrink:0;align-self:center">
    <span class="d-badge-status <?=$s['cls']?>"><?=ticket_status_title($item['status'])?></span>
  </div>
</div>
</a>
