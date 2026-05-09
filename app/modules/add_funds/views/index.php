<?php if ($payments): ?>
<div class="d-page-header">
  <h1><i class="fe fe-dollar-sign"></i> <?=lang("add_funds")?></h1>
</div>

<div style="max-width:800px;margin:0 auto">
  <!-- Payment method tabs -->
  <div class="d-tabs" id="payment-tabs">
    <?php $i = 0; foreach ($payments as $row): if(!$row) continue; $i++; ?>
    <button class="d-tab <?=($i==1)?'active':''?>" data-tab="pay-<?=$row->type?>">
      <i class="fe fe-credit-card"></i> <?=$row->name?>
    </button>
    <?php endforeach; ?>
  </div>

  <!-- Payment forms -->
  <div id="payment-panels">
    <?php $i = 0; foreach ($payments as $row): $i++; ?>
    <div class="d-tab-panel <?=($i==1)?'active':''?>" id="tab-pay-<?=$row->type?>">
      <div class="d-card">
        <div class="d-card-header">
          <span class="d-card-title"><i class="fe fe-credit-card" style="color:var(--d-purple)"></i> <?=$row->name?></span>
        </div>
        <div class="d-card-body">
          <?php $this->load->view($row->type.'/index', ['payment_id' => $row->id, 'payment_params' => $row->params]); ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<?php if (get_option("is_active_manual")): ?>
<div style="max-width:800px;margin:20px auto 0">
  <div class="d-card">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-hand" style="color:var(--d-amber)"></i> <?=lang('manual_payment')?></span>
    </div>
    <div class="d-card-body" style="color:var(--d-text);font-size:14px;line-height:1.8">
      <?=htmlspecialchars_decode(get_option('manual_payment_content',''), ENT_QUOTES)?>
    </div>
  </div>
</div>
<?php endif; ?>

<script>
$(function(){
  $('#payment-tabs .d-tab').on('click', function(){
    var tab = $(this).data('tab');
    $('#payment-tabs .d-tab').removeClass('active');
    $('#payment-panels .d-tab-panel').removeClass('active');
    $(this).addClass('active');
    $('#tab-' + tab).addClass('active');
  });
});
</script>
