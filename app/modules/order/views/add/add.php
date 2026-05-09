<?php
$items_category = array_column($items_category, 'id', 'name');
$form_items_category = array_flip(array_intersect_key($items_category, array_flip(array_keys($items_service))));
?>

<div class="d-tabs">
  <button class="d-tab active" data-tab="single_order">
    <i class="fe fe-shopping-cart"></i> <?=lang("single_order")?>
  </button>
  <button class="d-tab" data-tab="mass_order">
    <i class="fe fe-list"></i> <?=lang("mass_order")?>
  </button>
</div>

<!-- Single Order -->
<div class="d-tab-panel active" id="tab-single_order">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px" class="new-order-grid">

    <!-- Left: Order Form -->
    <div class="d-card">
      <div class="d-card-header">
        <span class="d-card-title"><i class="fe fe-plus-circle" style="color:var(--d-purple)"></i> <?=lang('add_new')?></span>
      </div>
      <div class="d-card-body">
        <form class="form actionForm" action="<?=cn($controller_name."/ajax_add_order")?>" data-redirect="<?=cn('new_order')?>" method="POST">

          <div class="d-form-group">
            <label class="d-label"><?=lang("Category")?></label>
            <select name="category_id" class="d-select ajaxChangeCategory" data-url="<?=cn($controller_name."/get_services/")?>">
              <option><?=lang("choose_a_category")?></option>
              <?php foreach ($form_items_category as $key => $category): ?>
              <option value="<?=$key?>"><?=$category?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="d-form-group" id="result_onChange">
            <label class="d-label"><?=lang("order_service")?></label>
            <select name="service_id" class="d-select ajaxChangeService" data-url="<?=cn($controller_name."/get_service/")?>">
              <option><?=lang("choose_a_service")?></option>
            </select>
          </div>

          <!-- Dynamic fields -->
          <div class="d-form-group order-default-link">
            <label class="d-label"><?=lang("Link")?></label>
            <div class="d-input-icon">
              <i class="fe fe-link"></i>
              <input class="d-input" type="text" name="link" placeholder="https://">
            </div>
          </div>

          <div class="d-form-group order-default-quantity">
            <label class="d-label"><?=lang("Quantity")?></label>
            <input class="d-input ajaxQuantity" name="quantity" type="number" placeholder="0">
          </div>

          <div class="d-form-group order-comments d-none">
            <label class="d-label"><?=lang("Comments")?></label>
            <textarea name="comments" class="d-textarea ajax_custom_comments" rows="6" placeholder="<?=lang("1_per_line")?>"></textarea>
          </div>

          <div class="d-form-group order-comments-custom-package d-none">
            <label class="d-label"><?=lang("Comments")?></label>
            <textarea name="comments_custom_package" class="d-textarea" rows="6"></textarea>
          </div>

          <div class="d-form-group order-usernames d-none">
            <label class="d-label"><?=lang("Usernames")?></label>
            <input type="text" class="d-input input-tags" name="usernames" value="usernameA,usernameB">
          </div>

          <div class="d-form-group order-usernames-custom d-none">
            <label class="d-label"><?=lang("Usernames")?></label>
            <textarea name="usernames_custom" class="d-textarea ajax_custom_lists" rows="6" placeholder="<?=lang("1_per_line")?>"></textarea>
          </div>

          <div class="d-form-group order-hashtags d-none">
            <label class="d-label"><?=lang("hashtags_format_hashtag")?></label>
            <input type="text" class="d-input input-tags" name="hashtags" value="#goodphoto,#love">
          </div>

          <div class="d-form-group order-hashtag d-none">
            <label class="d-label"><?=lang("Hashtag")?></label>
            <input class="d-input" type="text" name="hashtag">
          </div>

          <div class="d-form-group order-username d-none">
            <label class="d-label"><?=lang("Username")?></label>
            <input class="d-input" name="username" type="text">
          </div>

          <div class="d-form-group order-media d-none">
            <label class="d-label"><?=lang("Media_Url")?></label>
            <input class="d-input" name="media_url" type="url">
          </div>

          <!-- Subscriptions -->
          <div class="order-subscriptions d-none">
            <div class="d-form-row">
              <div class="d-form-group">
                <label class="d-label"><?=lang("Username")?></label>
                <input class="d-input" type="text" name="sub_username">
              </div>
              <div class="d-form-group">
                <label class="d-label"><?=lang("New_posts")?></label>
                <input class="d-input" type="number" placeholder="<?=lang("minimum_1_post")?>" name="sub_posts">
              </div>
              <div class="d-form-group">
                <label class="d-label"><?=lang("Quantity")?> (<?=lang("min")?>)</label>
                <input class="d-input" type="number" name="sub_min" placeholder="<?=lang("min")?>">
              </div>
              <div class="d-form-group">
                <label class="d-label"><?=lang("Quantity")?> (<?=lang("max")?>)</label>
                <input class="d-input" type="number" name="sub_max" placeholder="<?=lang("max")?>">
              </div>
              <div class="d-form-group">
                <label class="d-label"><?=lang("Delay")?> (<?=lang("minutes")?>)</label>
                <select name="sub_delay" class="d-select">
                  <option value="0"><?=lang("No_delay")?></option>
                  <?php foreach([5,10,15,30,60,90] as $d): ?><option value="<?=$d?>"><?=$d?></option><?php endforeach; ?>
                </select>
              </div>
              <div class="d-form-group">
                <label class="d-label"><?=lang("Expiry")?></label>
                <input type="text" class="d-input datepicker" name="sub_expiry" onkeydown="return false" id="expiry" placeholder="dd/mm/yyyy">
              </div>
            </div>
          </div>

          <!-- Drip Feed -->
          <?php if (get_option("enable_drip_feed","") == 1): ?>
          <div class="drip-feed-option d-none">
            <div class="d-form-group">
              <label class="d-switch">
                <input type="checkbox" name="is_drip_feed" class="is_drip_feed" data-toggle="collapse" data-target="#drip-feed">
                <span class="d-switch-track"></span>
                <span class="d-switch-label"><?=lang("dripfeed")?> <i class="fe fe-info" style="font-size:12px;color:var(--d-text2)" title="<?=lang("drip_feed_desc")?>"></i></span>
              </label>
            </div>
            <div class="collapse" id="drip-feed">
              <div class="d-form-row">
                <div class="d-form-group">
                  <label class="d-label"><?=lang("Runs")?></label>
                  <input class="d-input ajaxDripFeedRuns" type="number" name="runs" value="<?=get_option("default_drip_feed_runs","")?>">
                </div>
                <div class="d-form-group">
                  <label class="d-label"><?=lang("interval_in_minutes")?></label>
                  <select name="interval" class="d-select">
                    <?php for($i=1;$i<=60;$i++) { if($i%10==0) { ?>
                    <option value="<?=$i?>" <?=(get_option("default_drip_feed_interval","") == $i)? "selected" : ''?>><?=$i?></option>
                    <?php }} ?>
                  </select>
                </div>
                <div class="d-form-group">
                  <label class="d-label"><?=lang("total_quantity")?></label>
                  <input class="d-input" name="total_quantity" type="number" disabled>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <!-- Total Charge -->
          <div class="d-order-resume d-mb-16" id="result_total_charge">
            <input type="hidden" name="total_charge" value="0.00">
            <input type="hidden" name="currency_symbol" value="<?=get_option("currency_symbol","")?>">
            <div class="d-order-resume-row">
              <span class="d-order-resume-key"><?=lang("total_charge")?></span>
              <span class="d-total-charge-big total_charge"><span class="charge_number">$0.00</span></span>
            </div>
            <?php
              $user = $this->model->get("balance, custom_rate", 'general_users', ['id' => session('uid')]);
              if (!empty($user->custom_rate) && $user->custom_rate > 0):
            ?>
            <div class="d-order-resume-row">
              <span class="d-order-resume-key"><?=lang("custom_rate")?></span>
              <span class="d-order-resume-val" style="color:var(--d-green)"><?=$user->custom_rate?>%</span>
            </div>
            <?php endif; ?>
            <div class="d-alert d-alert-danger d-none" role="alert" style="margin-top:10px;margin-bottom:0">
              <i class="fe fe-alert-triangle"></i>
              <?=lang("order_amount_exceeds_available_funds")?>
            </div>
          </div>

          <div class="d-form-group">
            <label class="d-checkbox">
              <input type="checkbox" name="agree">
              <span class="d-switch-track" style="width:36px;height:20px"></span>
              <span class="d-checkbox-label"><?=lang("yes_i_have_confirmed_the_order")?></span>
            </label>
          </div>

          <button type="submit" class="d-btn d-btn-primary" style="width:100%;justify-content:center">
            <i class="fe fe-shopping-cart"></i> <?=lang("place_order")?>
          </button>

        </form>
      </div>
    </div>

    <!-- Right: Order Resume -->
    <div class="d-card" id="order_resume">
      <div class="d-card-header">
        <span class="d-card-title"><i class="fe fe-info" style="color:var(--d-green)"></i> <?=lang("order_resume")?></span>
      </div>
      <div class="d-card-body" id="result_onChangeService">
        <div class="d-form-group">
          <label class="d-label"><?=lang("service_name")?></label>
          <input type="hidden" name="service_id" id="service_id" value="<?=(!empty($service_item_default->id))? $service_item_default->id :''?>">
          <input class="d-input" name="service_name" type="text" readonly placeholder="—">
        </div>
        <div class="d-form-row-3">
          <div class="d-form-group">
            <label class="d-label"><?=lang("minimum_amount")?></label>
            <input class="d-input" name="service_min" type="text" readonly placeholder="—">
          </div>
          <div class="d-form-group">
            <label class="d-label"><?=lang("maximum_amount")?></label>
            <input class="d-input" name="service_max" type="text" readonly placeholder="—">
          </div>
          <div class="d-form-group">
            <label class="d-label"><?=lang("price_per_1000")?></label>
            <input class="d-input" name="service_price" type="text" readonly placeholder="—">
          </div>
        </div>
        <div class="d-form-group">
          <label class="d-label"><?=lang("Description")?></label>
          <textarea rows="8" name="service_desc" class="d-textarea" readonly placeholder="—"></textarea>
        </div>
      </div>
    </div>

  </div><!-- /grid -->
</div>

<!-- Mass Order -->
<div class="d-tab-panel" id="tab-mass_order">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px" class="new-order-grid">
    <div class="d-card">
      <div class="d-card-header">
        <span class="d-card-title"><i class="fe fe-list" style="color:var(--d-purple)"></i> <?=lang("mass_order")?></span>
      </div>
      <div class="d-card-body">
        <form class="form actionForm" action="<?=cn($controller_name."/ajax_mass_order")?>" data-redirect="<?=cn($controller_name."/log")?>" method="POST">
          <div class="d-form-group">
            <label class="d-label"><?=lang("one_order_per_line_in_format")?></label>
            <textarea id="editor" rows="12" name="mass_order" class="d-textarea" placeholder="service_id|quantity|link"></textarea>
          </div>
          <div class="d-form-group">
            <label class="d-checkbox">
              <input type="checkbox" name="agree">
              <span class="d-checkbox-label"><?=lang("yes_i_have_confirmed_the_order")?></span>
            </label>
          </div>
          <button type="submit" class="d-btn d-btn-primary" style="width:100%;justify-content:center">
            <i class="fe fe-send"></i> <?=lang("place_order")?>
          </button>
        </form>
      </div>
    </div>
    <div class="d-card">
      <div class="d-card-header">
        <span class="d-card-title"><i class="fe fe-info" style="color:var(--d-amber)"></i> <?=lang("note")?></span>
      </div>
      <div class="d-card-body">
        <p style="color:var(--d-text);font-size:14px;line-height:1.8"><?=lang("here_you_can_place_your_orders_easy_please_make_sure_you_check_all_the_prices_and_delivery_times_before_you_place_a_order_after_a_order_submited_it_cannot_be_canceled")?></p>
      </div>
    </div>
  </div>
</div>

<?php if (get_option('enable_attentions_orderpage')): ?>
<div class="d-card" style="margin-top:20px">
  <div class="d-card-header">
    <span class="d-card-title"><i class="fe fe-book-open" style="color:var(--d-green)"></i> <?=get_option('title_attentions_orderpage','Guides & Descriptions')?></span>
  </div>
  <div class="d-card-body" style="color:var(--d-text);font-size:14px;line-height:1.8">
    <?=get_option("guides_and_desc","")?>
  </div>
</div>
<?php endif; ?>

<style>
@media(max-width:768px) { .new-order-grid { grid-template-columns: 1fr !important; } }
</style>
<script>
$(function(){
  // Tab switching
  $('.d-tab').on('click', function(){
    var tab = $(this).data('tab');
    $('.d-tab').removeClass('active');
    $('.d-tab-panel').removeClass('active');
    $(this).addClass('active');
    $('#tab-' + tab).addClass('active');
  });
  // Datepicker
  $('.datepicker').datepicker({ format:"dd/mm/yyyy", autoclose:true, startDate: new Date() });
  // Selectize tags
  $('.input-tags').selectize({ delimiter:',', persist:false, create:function(input){ return {value:input,text:input}; } });
});
</script>
