<?php foreach ($items as $category_name => $item_category): ?>
<div class="d-card d-mb-16">
  <div class="d-card-header">
    <span class="d-card-title">
      <i class="fe fe-layers" style="color:var(--d-orange);margin-right:6px"></i>
      <?=esc($category_name)?>
    </span>
    <span style="font-size:11px;color:var(--d-muted)"><?=count($item_category)?> <?=lang("Services")?></span>
  </div>
  <div class="d-table-wrap">
    <table class="d-table">
      <thead>
        <tr>
          <th style="width:50px">ID</th>
          <th><?=lang("Name")?></th>
          <th class="d-td-center" style="width:120px"><?=lang("price_per_1000")?></th>
          <th class="d-td-center" style="width:140px"><?=lang("min_max_order")?></th>
          <th class="d-td-center" style="width:80px"><?=lang("Description")?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($item_category as $item):
          $item_price = show_item_rate($item, $items_custom_rate, 'user');
          $show_item_view = show_item_details('services', $item);
        ?>
        <tr class="tr_<?=esc($item['id'])?>">
          <td class="d-td-muted"><?=esc($item['id'])?></td>
          <td>
            <div class="d-service-name"><?=esc($item['name'])?></div>
          </td>
          <td class="d-td-center d-td-bold"><?=$item_price?></td>
          <td class="d-td-center d-td-muted"><?=$item['min'].' / '.$item['max']?></td>
          <td class="d-td-center"><?=$show_item_view?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endforeach; ?>
