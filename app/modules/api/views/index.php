<div class="d-page-header">
  <h1><i class="fe fe-code"></i> <?=lang("api_documentation")?></h1>
  <a href="<?=BASE?>example.txt" class="d-btn d-btn-outline" target="_blank">
    <i class="fe fe-download"></i> <?=lang("download_php_code_examples")?>
  </a>
</div>

<div style="max-width:860px">

  <!-- Credentials -->
  <div class="d-card d-mb-20">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-key" style="color:var(--d-amber)"></i> <?=lang("api_credentials")?></span>
    </div>
    <div class="d-card-body">
      <div class="d-alert d-alert-info d-mb-16">
        <i class="fe fe-info"></i>
        <?=lang("note_please_read_the_api_intructions_carefully_its_your_solo_responsability_what_you_add_by_our_api")?>
      </div>
      <div class="d-form-group">
        <label class="d-label"><?=lang("http_method")?></label>
        <div class="d-api-url">POST</div>
      </div>
      <div class="d-form-group">
        <label class="d-label">API URL</label>
        <div class="d-api-url"><a href="<?=$api_url?>" style="color:#c4b5fd"><?=$api_url?></a></div>
      </div>
      <div class="d-form-group">
        <label class="d-label"><?=lang("response_format")?></label>
        <div class="d-api-url">JSON</div>
      </div>
      <div class="d-form-group">
        <label class="d-label"><?=lang("api_key")?></label>
        <div class="d-api-key-box">
          <div class="d-api-key-val"><?=$api_key?></div>
          <button type="button" class="d-btn d-btn-outline d-btn-sm" onclick="navigator.clipboard.writeText('<?=esc($api_key)?>');this.innerHTML='<i class=\'fe fe-check\'></i> Copied'">
            <i class="fe fe-copy"></i> Copy
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Place Order -->
  <div class="d-card d-mb-20">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-shopping-cart" style="color:var(--d-purple)"></i> <?=lang("place_new_order")?></span>
    </div>
    <div class="d-card-body">
      <div class="d-form-group">
        <label class="d-label"><?=lang("order_type")?></label>
        <select name="service-type" class="d-select ajaxChangeOrderType">
          <option value="default">Default</option>
          <option value="custom_comments">Custom Comments</option>
          <option value="package">Package</option>
          <option value="mentions_with_hashtags">Mentions with Hashtags</option>
          <option value="mentions_custom_list">Mentions Custom List</option>
          <option value="mentions_hashtag">Mentions Hashtag</option>
          <option value="mentions_user_followers">Mentions User Followers</option>
          <option value="mentions_media_likers">Mentions Media Likers</option>
          <option value="custom_comments_package">Custom Comments Package</option>
          <option value="comment_likes">Comment Likes</option>
          <option value="subscriptions">Subscriptions</option>
        </select>
      </div>

      <?php
      $api_tables = [
        'service-default' => ['key','action','service','link','quantity','runs (optional)','interval (optional)'],
        'service-package' => ['key','action','service','link'],
        'service-custom-comments' => ['key','action','service','link','comments'],
        'service-mentions-with-hashtags' => ['key','action','service','link','quantity','usernames','hashtags'],
        'service-mentions-custom-list' => ['key','action','service','link','usernames'],
        'service-mentions-hashtag' => ['key','action','service','link','quantity','hashtag'],
        'service-mentions-user-followers' => ['key','action','service','link','quantity','username'],
        'service-mentions-media-likers' => ['key','action','service','link'],
        'service-custom-comments-package' => ['key','action','service','link','comments'],
        'service-comment-likes' => ['key','action','service','link','quantity','username'],
        'service-subscriptions' => ['key','action','service','username','min','max','delay','expiry (optional)'],
      ];
      $api_descs = [
        'key' => 'Your API key', 'action' => 'add', 'service' => 'Service ID',
        'link' => 'Link to page', 'quantity' => 'Needed quantity', 'runs (optional)' => 'Runs to deliver',
        'interval (optional)' => 'Interval in minutes', 'comments' => 'Comments list separated by \\r\\n or \\n',
        'usernames' => 'Usernames list separated by \\r\\n or \\n', 'hashtags' => 'Hashtags list separated by \\r\\n or \\n',
        'hashtag' => 'Hashtag to scrape usernames from', 'username' => 'Username or URL to scrape from',
        'min' => 'Quantity min', 'max' => 'Quantity max', 'delay' => 'Delay in minutes (0,5,10,15,30,60,90)',
        'expiry (optional)' => 'Expiry date. Format d/m/Y',
      ];
      foreach ($api_tables as $cls => $fields):
        $hidden = ($cls !== 'service-default') ? 'd-none' : '';
      ?>
      <div class="d-card <?=$hidden?> <?=$cls?>" style="background:rgba(0,0,0,.2);border-color:rgba(255,255,255,.06)">
        <div class="d-table-wrap">
          <table class="d-table">
            <thead>
              <tr>
                <th><?=lang("parameter")?></th>
                <th><?=lang("Description")?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($fields as $f): ?>
              <tr>
                <td style="color:#c4b5fd;font-family:monospace;font-size:12px"><?=$f?></td>
                <td class="d-td-muted"><?=isset($api_descs[$f]) ? $api_descs[$f] : $f?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php endforeach; ?>

      <div class="d-mt-16">
        <label class="d-label"><?=lang("example_response")?></label>
        <pre>{"status": "success", "order": 32}</pre>
      </div>
    </div>
  </div>

  <!-- Status, Balance, Services endpoints -->
  <?php
  $endpoints = [
    lang("get_order_status") => [['key','action','order'],['Your API key','status','Order ID']],
    lang("get_services")     => [['key','action'],        ['Your API key','services']],
    lang("get_balance")      => [['key','action'],        ['Your API key','balance']],
    lang("refill_order")     => [['key','action','order'],['Your API key','refill','Order ID']],
    lang("cancel_orders")    => [['key','action','orders'],['Your API key','cancel','Orders IDs separated by comma']],
  ];
  foreach ($endpoints as $ep_name => $ep): ?>
  <div class="d-card d-mb-16">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-terminal" style="color:var(--d-green);font-size:13px"></i> <?=$ep_name?></span>
    </div>
    <div class="d-card-body" style="padding:0">
      <div class="d-table-wrap">
        <table class="d-table">
          <thead><tr><th><?=lang("parameter")?></th><th><?=lang("value")?></th></tr></thead>
          <tbody>
            <?php for($x=0;$x<count($ep[0]);$x++): ?>
            <tr>
              <td style="color:#c4b5fd;font-family:monospace;font-size:12px"><?=$ep[0][$x]?></td>
              <td class="d-td-muted"><?=$ep[1][$x]?></td>
            </tr>
            <?php endfor; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

</div>

<script>
$(document).on("change", ".ajaxChangeOrderType", function(){
  var type = $(this).val();
  var map = {
    'default':'service-default','package':'service-package','custom_comments':'service-custom-comments',
    'mentions_with_hashtags':'service-mentions-with-hashtags','mentions_custom_list':'service-mentions-custom-list',
    'mentions_hashtag':'service-mentions-hashtag','mentions_user_followers':'service-mentions-user-followers',
    'mentions_media_likers':'service-mentions-media-likers','custom_comments_package':'service-custom-comments-package',
    'comment_likes':'service-comment-likes','subscriptions':'service-subscriptions'
  };
  $('[class*="service-"]').each(function(){ $(this).addClass('d-none'); });
  var cls = map[type] || 'service-default';
  $('.'+cls).removeClass('d-none');
});
</script>
