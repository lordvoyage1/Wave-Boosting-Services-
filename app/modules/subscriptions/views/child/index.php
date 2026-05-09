<?php if (!empty($items)): ?>
<div class="d-card">
  <div class="d-table-wrap">
    <table class="d-table">
      <thead>
        <tr>
          <th>#</th>
          <th><?=lang("Details")?></th>
          <th class="d-td-center"><?=lang("created")?></th>
          <th class="d-td-center"><?=lang("updated")?></th>
          <th class="d-td-center"><?=lang("Status")?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $key => $item):
          $params['search']['field'] = 'id';
          $item_id = show_high_light(esc($item['id']), $params['search'], 'id');
          $item_details = show_item_order_details($controller_name, $item, $params, 'user');
          $item_status = (in_array(strtolower($item['sub_status']), ['error'])) ? 'active' : strtolower($item['sub_status']);
        ?>
        <tr class="tr_<?=$item['ids']?>">
          <td class="d-td-muted"><?=$item_id?></td>
          <td><?=$item_details?></td>
          <td class="d-td-center d-td-muted"><?=convert_timezone($item['created'], "user")?></td>
          <td class="d-td-center d-td-muted"><?=convert_timezone($item['changed'], "user")?></td>
          <td class="d-td-center"><?=show_item_status($controller_name, $item['id'], $item_status, '', 'user')?></td>
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
    <i class="fe fe-refresh-cw"></i>
    <h3><?=lang("no_results_found")?></h3>
    <p><?=lang("Look_like_there_are_no_results_in_here")?></p>
  </div>
</div>
<?php endif; ?>
