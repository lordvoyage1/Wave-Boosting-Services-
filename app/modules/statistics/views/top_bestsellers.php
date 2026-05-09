<?php if ($items_top_best_seller): ?>
<div class="d-card">
  <div class="d-card-header">
    <span class="d-card-title"><i class="fe fe-star" style="color:var(--d-amber)"></i> <?=lang("top_bestsellers")?></span>
    <a href="<?=cn('services')?>" class="d-btn d-btn-outline d-btn-sm">
      <i class="fe fe-grid"></i> <?=lang("all_services")?>
    </a>
  </div>
  <div class="d-table-wrap">
    <table class="d-table">
      <thead>
        <tr>
          <th>#</th>
          <th><?=lang("Name")?></th>
          <th class="d-td-center"><?=lang("rate_per_1000")?></th>
          <th class="d-td-center"><?=lang("min__max_order")?></th>
          <th class="d-td-center"><?=lang("Description")?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items_top_best_seller as $item):
          $show_item_view = show_item_details('services', $item);
        ?>
        <tr>
          <td class="d-td-muted"><?=esc($item['id'])?></td>
          <td class="d-td-bold"><?=esc($item['name'])?></td>
          <td class="d-td-center" style="color:var(--d-green);font-weight:700"><?=(double)$item['price']?></td>
          <td class="d-td-center d-td-muted"><?=$item['min']?> / <?=$item['max']?></td>
          <td class="d-td-center"><?=$show_item_view?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>
