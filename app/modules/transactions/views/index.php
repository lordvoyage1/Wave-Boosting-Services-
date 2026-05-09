<div class="d-page-header">
  <h1><i class="fe fe-file-text"></i> <?=lang("Transaction_logs")?></h1>
</div>

<?php if (!empty($items)): ?>
<div class="d-card">
  <div class="d-table-wrap">
    <table class="d-table">
      <thead>
        <tr>
          <th>#</th>
          <th class="d-td-center"><?=lang("Type")?></th>
          <th class="d-td-center"><?=lang("Amount")?></th>
          <th class="d-td-center"><?=lang("Fee")?></th>
          <th class="d-td-center"><?=lang("Date")?></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = $from; foreach ($items as $item):
          $i++;
          $item_payment_type = show_item_transaction_type($item['type']);
          $created = show_item_datetime($item['created'], 'long');
        ?>
        <tr class="tr_<?=$item['id']?>">
          <td class="d-td-muted"><?=$item['id']?></td>
          <td class="d-td-center"><?=$item_payment_type?></td>
          <td class="d-td-center d-td-bold" style="color:var(--d-green)"><?=$item['amount']?></td>
          <td class="d-td-center d-td-muted"><?=$item['txn_fee']?></td>
          <td class="d-td-center d-td-muted"><?=$created?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?=show_pagination($pagination)?>
<?php else: ?>
<div class="d-card">
  <div class="d-empty">
    <i class="fe fe-file-text"></i>
    <h3><?=lang("no_results_found")?></h3>
    <p><?=lang("no_transactions_yet")?></p>
  </div>
</div>
<?php endif; ?>
