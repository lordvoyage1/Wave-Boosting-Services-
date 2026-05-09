<?php if (!empty($items)): ?>
<div class="d-card">
  <div class="d-table-wrap">
    <table class="d-table">
      <thead>
        <tr>
          <th>#</th>
          <th><?=lang("Details")?></th>
          <th class="d-td-center"><?=lang("created")?></th>
          <th class="d-td-center"><?=lang("Status")?></th>
          <?php if (is_table_exists(ORDERS_REFILL)): ?><th class="d-td-center"><?=lang("Refill")?></th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $key => $item):
          $params['search']['field'] = 'id';
          $item_id      = show_high_light(esc($item['id']), $params['search'], 'id');
          $item_details = show_item_order_details($controller_name, $item, $params, 'user');
          $item_status  = (in_array($item['status'], ['error'])) ? 'pending' : $item['status'];
        ?>
        <tr class="tr_<?=$item['ids']?>">
          <td class="d-td-muted"><?=$item_id?></td>
          <td><?=$item_details?></td>
          <td class="d-td-center d-td-muted"><?=convert_timezone($item['created'], "user")?></td>
          <td class="d-td-center"><?=show_item_status($controller_name, $item['id'], $item_status, '', 'user')?></td>
          <?php if (is_table_exists(ORDERS_REFILL)) echo show_item_refill_button($controller_name, $item); ?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php echo show_pagination($pagination); ?>
<?php else: ?>
<div class="d-card">
  <div class="d-empty">
    <i class="fe fe-inbox"></i>
    <h3><?=lang("no_results_found")?></h3>
    <p><?=lang("you_have_no_orders_yet")?></p>
    <a href="<?=cn('new_order')?>" class="d-btn d-btn-primary" style="display:inline-flex;margin-top:16px">
      <i class="fe fe-plus"></i> <?=lang("add_new")?>
    </a>
  </div>
</div>
<?php endif; ?>
