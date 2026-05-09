<?php
$item_created = show_item_datetime($item['created'], 'long');
$item_status  = show_item_status($controller_name, $item['id'], $item['status'], '');
?>

<div class="d-page-header">
  <h1><i class="fe fe-message-circle"></i> <?=lang("Ticket_no")?><?=$item['id']?></h1>
  <a href="<?=cn($controller_name)?>" class="d-btn d-btn-outline">
    <i class="fe fe-arrow-left"></i> <?=lang("Back")?>
  </a>
</div>

<div style="display:grid;grid-template-columns:280px 1fr;gap:20px;align-items:start" id="ticket-view-grid">

  <!-- Info Panel -->
  <div class="d-card">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-info" style="color:var(--d-orange)"></i> <?=lang("Details")?></span>
    </div>
    <div class="d-card-body" style="padding:0">
      <table class="d-table">
        <tbody>
          <tr><td class="d-td-muted" style="width:90px"><?=lang("Status")?></td><td><?=$item_status?></td></tr>
          <tr><td class="d-td-muted"><?=lang("Name")?></td><td><?=esc($item['first_name'].' '.$item['last_name'])?></td></tr>
          <tr><td class="d-td-muted"><?=lang("Email")?></td><td style="word-break:break-all"><?=esc($item['email'])?></td></tr>
          <tr><td class="d-td-muted"><?=lang("Created")?></td><td><?=$item_created?></td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Conversation -->
  <div class="d-card">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-message-square" style="color:var(--d-orange)"></i> <?=esc($item['subject'])?></span>
    </div>
    <div class="d-card-body">

      <!-- Message thread -->
      <div class="tc-thread">
        <?php
          $item['message'] = $item['description'];
          unset($item['description']);
          echo show_item_ticket_message_detail($controller_name, $item, 'user');
          if ($items_ticket_message) {
            foreach ($items_ticket_message as $item_message) {
              echo show_item_ticket_message_detail($controller_name, $item_message, 'user');
            }
          }
        ?>
      </div>

      <!-- Reply form -->
      <?php if ($item['status'] != 'closed'):
        $form_url     = cn($controller_name."/store_message/");
        $redirect_url = cn($controller_name.'/') . $item['id'];
        $form_attributes = ['class' => 'form actionForm', 'data-redirect' => $redirect_url, 'method' => 'POST'];
        $form_hidden  = ['ids' => @$item['ids']];
      ?>
      <div class="tc-reply-box">
        <div style="font-size:12px;font-weight:700;color:var(--d-navy);margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px"><?=lang("Reply")?></div>
        <?=form_open($form_url, $form_attributes, $form_hidden)?>
          <div class="d-form-group">
            <textarea rows="5" class="d-textarea" name="message" placeholder="<?=lang("Message")?>..."></textarea>
          </div>
          <button type="submit" class="d-btn d-btn-primary">
            <i class="fe fe-send"></i> <?=lang("Submit")?>
          </button>
        <?=form_close()?>
      </div>
      <?php else: ?>
      <div class="d-alert d-alert-warn" style="margin-top:16px">
        <i class="fe fe-lock"></i> <?=lang("this_ticket_is_closed")?>
      </div>
      <?php endif; ?>

    </div>
  </div>

</div>

<style>
@media(max-width:768px){#ticket-view-grid{grid-template-columns:1fr!important}}
</style>
