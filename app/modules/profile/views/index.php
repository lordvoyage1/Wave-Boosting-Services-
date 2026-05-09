<div class="d-page-header">
  <h1><i class="fe fe-user"></i> <?=lang('Your_account')?></h1>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px" id="profile-grid">

  <!-- Basic Info -->
  <div class="d-card">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-edit-2" style="color:var(--d-purple)"></i> <?=lang("basic_information")?></span>
    </div>
    <div class="d-card-body">
      <form class="form actionForm" action="<?=cn($module."/ajax_update")?>" data-redirect="<?=cn($module)?>" method="POST">
        <div class="d-form-row">
          <div class="d-form-group">
            <label class="d-label"><?=lang("first_name")?></label>
            <input class="d-input" name="first_name" type="text" value="<?=(!empty($user->first_name))? esc($user->first_name): ''?>">
          </div>
          <div class="d-form-group">
            <label class="d-label"><?=lang("last_name")?></label>
            <input class="d-input" name="last_name" type="text" value="<?=(!empty($user->last_name))? esc($user->last_name): ''?>">
          </div>
          <div class="d-form-group">
            <label class="d-label"><?=lang('Email')?></label>
            <input class="d-input" name="email" type="email" value="<?=(!empty($user->email))? esc($user->email): ''?>">
          </div>
          <div class="d-form-group">
            <label class="d-label"><?=lang('Timezone')?></label>
            <select name="timezone" class="d-select">
              <?php $time_zones = tz_list();
                foreach ($time_zones as $tz): ?>
              <option value="<?=$tz['zone']?>" <?=(!empty($user->timezone) && $user->timezone == $tz['zone'])? 'selected': ''?>><?=$tz['time']?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="d-form-group">
            <label class="d-label"><?=lang('Password')?></label>
            <input class="d-input" name="password" type="password" placeholder="••••••••">
            <div class="d-form-hint"><?=lang("note_if_you_dont_want_to_change_password_then_leave_these_password_fields_empty")?></div>
          </div>
          <div class="d-form-group">
            <label class="d-label"><?=lang('Confirm_password')?></label>
            <input class="d-input" name="re_password" type="password" placeholder="••••••••">
          </div>
        </div>
        <button type="submit" class="d-btn d-btn-primary" style="width:100%;justify-content:center;margin-top:4px">
          <i class="fe fe-save"></i> <?=lang('Save')?>
        </button>
      </form>
    </div>
  </div>

  <div style="display:flex;flex-direction:column;gap:20px">

    <!-- More Info -->
    <div class="d-card">
      <div class="d-card-header">
        <span class="d-card-title"><i class="fe fe-info" style="color:var(--d-green)"></i> <?=lang("more_informations")?></span>
      </div>
      <div class="d-card-body">
        <form class="form actionForm" action="<?=cn($module."/ajax_update_more_infors")?>" data-redirect="<?=cn($module)?>" method="POST">
          <?php
            $website = $phone = $skype_id = $what_asap = $address = '';
            if (!empty($user->more_information)) {
              $infors  = $user->more_information;
              $website   = get_value($infors, "website");
              $phone     = get_value($infors, "phone");
              $skype_id  = get_value($infors, "skype_id");
              $what_asap = get_value($infors, "what_asap");
              $address   = get_value($infors, "address");
            }
          ?>
          <div class="d-form-row">
            <div class="d-form-group">
              <label class="d-label"><?=lang('Website')?></label>
              <input class="d-input" name="website" type="text" value="<?=esc($website)?>">
            </div>
            <div class="d-form-group">
              <label class="d-label"><?=lang('Phone')?></label>
              <input class="d-input" name="phone" type="text" value="<?=esc($phone)?>">
            </div>
            <div class="d-form-group">
              <label class="d-label"><?=lang('Skype_id')?></label>
              <input class="d-input" name="skype_id" type="text" value="<?=esc($skype_id)?>">
            </div>
            <div class="d-form-group">
              <label class="d-label"><?=lang("whatsapp_number")?></label>
              <input class="d-input" name="what_asap" type="text" value="<?=esc($what_asap)?>">
            </div>
          </div>
          <div class="d-form-group">
            <label class="d-label"><?=lang('Address')?></label>
            <input class="d-input" name="address" type="text" value="<?=esc($address)?>">
            <div class="d-form-hint"><?=lang("note_if_you_dont_want_add_more_information_then_leave_these_informations_fields_empty")?></div>
          </div>
          <button type="submit" class="d-btn d-btn-outline" style="width:100%;justify-content:center">
            <i class="fe fe-save"></i> <?=lang("Save")?>
          </button>
        </form>
      </div>
    </div>

    <!-- API Key -->
    <div class="d-card">
      <div class="d-card-header">
        <span class="d-card-title"><i class="fe fe-key" style="color:var(--d-amber)"></i> <?=lang('your_api_key')?></span>
      </div>
      <div class="d-card-body">
        <form class="form actionForm" action="<?=cn($module."/ajax_update_api")?>" data-redirect="<?=cn($module)?>" method="POST">
          <div class="d-form-group">
            <label class="d-label"><?=lang('Key')?></label>
            <div class="d-api-key-box">
              <div class="d-api-key-val"><?=(!empty($user->api_key))? esc($user->api_key): lang("no_api_key_yet")?></div>
              <input type="hidden" name="api_key" value="<?=(!empty($user->api_key))? esc($user->api_key): ''?>">
            </div>
          </div>
          <button type="submit" class="d-btn d-btn-primary" style="width:100%;justify-content:center">
            <i class="fe fe-refresh-cw"></i> <?=lang("Generate_new")?>
          </button>
        </form>
      </div>
    </div>

  </div><!-- /right col -->
</div><!-- /grid -->

<style>
@media(max-width:768px){ #profile-grid{ grid-template-columns:1fr !important; } }
</style>
