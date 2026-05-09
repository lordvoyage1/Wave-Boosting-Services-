<?php
$button_type = 'info';
if (!empty($ticket->status)) {
  switch ($ticket->status) {
    case 'pending':  $button_type = 'info'; break;
    case 'closed':   $button_type = 'gray-dark'; break;
    case 'answered': $button_type = 'gray'; break;
  }
}
?>

<div class="d-page-header">
  <h1><i class="fe fe-message-circle"></i> <?=lang("Ticket_no")?><?=$ticket->id?></h1>
  <a href="<?=cn($module)?>" class="d-btn d-btn-outline">
    <i class="fe fe-arrow-left"></i> <?=lang("Back")?>
  </a>
</div>

<div style="display:grid;grid-template-columns:280px 1fr;gap:20px;align-items:start" id="ticket-update-grid">

  <!-- Info Panel -->
  <div class="d-card">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-info" style="color:var(--d-orange)"></i> <?=lang("Details")?></span>
    </div>
    <div class="d-card-body" style="padding:0">
      <table class="d-table">
        <tbody>
          <tr>
            <td class="d-td-muted" style="width:80px"><?=lang("Status")?></td>
            <td>
              <?php if (get_role("admin") || get_role('supporter')): ?>
              <div class="d-dropdown" style="display:inline-block">
                <button class="d-btn d-btn-outline d-btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" type="button">
                  <?=ticket_status_title($ticket->status)?> <i class="fe fe-chevron-down" style="font-size:10px"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="min-width:160px">
                  <a href="javascript:void(0)" data-url="<?=cn($module."/ajax_change_status/".$ticket->ids)?>" data-status="closed"   class="ajaxChangeStatus dropdown-item d-dropdown-item"><?=lang("submit_as_closed")?></a>
                  <a href="javascript:void(0)" data-url="<?=cn($module."/ajax_change_status/".$ticket->ids)?>" data-status="pending"  class="ajaxChangeStatus dropdown-item d-dropdown-item"><?=lang("submit_as_pending")?></a>
                  <a href="javascript:void(0)" data-url="<?=cn($module."/ajax_change_status/".$ticket->ids)?>" data-status="answered" class="ajaxChangeStatus dropdown-item d-dropdown-item"><?=lang("submit_as_answered")?></a>
                  <a href="javascript:void(0)" data-url="<?=cn($module."/ajax_change_status/".$ticket->ids)?>" data-status="unread"   class="ajaxChangeStatus dropdown-item d-dropdown-item"><?=lang("mark_as_unread")?></a>
                </div>
              </div>
              <?php else: ?>
              <span class="d-badge-status d-s-<?=$ticket->status?>"><?=ticket_status_title($ticket->status)?></span>
              <?php endif; ?>
            </td>
          </tr>
          <?php if (!empty($ticket->first_name)): ?>
          <tr><td class="d-td-muted"><?=lang("Name")?></td><td><?=esc($ticket->first_name.' '.$ticket->last_name)?></td></tr>
          <?php endif; ?>
          <?php if (!empty($ticket->user_email)): ?>
          <tr><td class="d-td-muted"><?=lang("Email")?></td><td style="word-break:break-all"><?=esc($ticket->user_email)?></td></tr>
          <?php endif; ?>
          <?php if (!empty($ticket->created)): ?>
          <tr><td class="d-td-muted"><?=lang("Created")?></td><td><?=convert_timezone($ticket->created,'user')?></td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Conversation -->
  <div class="d-card">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-message-square" style="color:var(--d-orange)"></i> <?=esc($ticket->subject)?></span>
    </div>
    <div class="d-card-body">

      <!-- Message thread -->
      <div class="tc-thread">
        <?php
          if ($ticket->uid == session('uid')) { $messate_type = 'replies'; } else { $messate_type = 'sent'; }
          if (get_field(USERS, ['id' => $ticket->uid], "role") == 'user') { $img_url = BASE.'assets/images/client-icon.png'; } else { $img_url = BASE.'assets/images/support-icon.png'; }
        ?>
        <li class="<?=$messate_type?>" style="list-style:none">
          <div class="tc-msg">
            <div class="tc-msg-avatar"><img src="<?=$img_url?>" alt="icon" style="width:32px;height:32px;border-radius:50%;object-fit:cover"></div>
            <div class="tc-msg-body">
              <div class="tc-msg-meta">
                <strong style="color:var(--d-navy);font-size:13px"><?=(!empty($ticket->first_name)) ? esc($ticket->first_name.' '.$ticket->last_name) : ''?></strong>
                <span style="color:var(--d-muted);font-size:11px;margin-left:8px"><?=(!empty($ticket->created)) ? convert_timezone($ticket->created,'user') : ''?></span>
              </div>
              <div class="tc-msg-text"><?=str_replace("\n","<br>",esc($ticket->description ?? ''))?></div>
            </div>
          </div>
        </li>

        <?php if (!empty($ticket_content)):
          foreach ($ticket_content as $row):
            $is_support = (get_field(USERS, ['id' => $row->uid], "role") != 'user');
            $row_img    = $is_support ? BASE.'assets/images/support-icon.png' : BASE.'assets/images/client-icon.png';
            $row_type   = ($row->uid == session('uid')) ? 'replies' : 'sent';
        ?>
        <li class="<?=$row_type?> tr_<?=$row->ids?>" style="list-style:none">
          <div class="tc-msg <?=$is_support ? 'tc-msg-support' : ''?>">
            <div class="tc-msg-avatar"><img src="<?=$row_img?>" alt="icon" style="width:32px;height:32px;border-radius:50%;object-fit:cover"></div>
            <div class="tc-msg-body">
              <div class="tc-msg-meta">
                <strong style="color:var(--d-navy);font-size:13px"><?=(!empty($row->first_name)) ? esc($row->first_name.' '.$row->last_name) : ''?></strong>
                <span style="color:var(--d-muted);font-size:11px;margin-left:8px"><?=(!empty($row->created)) ? convert_timezone($row->created,'user') : ''?></span>
                <?php if (!$is_support && get_role('admin')): ?>
                <a href="<?=cn("$module/ajax_delete_message_item/".$row->ids)?>" class="ajaxDeleteItem d-btn d-btn-danger d-btn-sm" style="margin-left:8px;padding:2px 8px;font-size:11px">
                  <i class="fe fe-trash"></i>
                </a>
                <?php endif; ?>
              </div>
              <div class="tc-msg-text"><?=!empty($row->message) ? str_replace("\n","<br>",esc($row->message)) : ''?></div>
            </div>
          </div>
        </li>
        <?php endforeach; endif; ?>
      </div>

      <!-- Reply form -->
      <?php if (get_role("admin") || get_role("supporter") || $ticket->status == 'pending' || $ticket->status == 'answered'): ?>
      <div class="tc-reply-box">
        <div style="font-size:12px;font-weight:700;color:var(--d-navy);margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px"><?=lang("Reply")?></div>
        <form class="form actionForm" action="<?=cn($module."/ajax_update/".$ticket->ids)?>" data-redirect="<?=cn("$module/view/".$ticket->id)?>" method="POST">
          <div class="d-form-group">
            <textarea rows="6" class="d-textarea square plugin_editor" name="message" placeholder="<?=lang("Message")?>..."></textarea>
          </div>
          <button type="submit" class="d-btn d-btn-primary">
            <i class="fe fe-send"></i> <?=lang("Submit")?>
          </button>
        </form>
      </div>
      <?php endif; ?>

    </div>
  </div>

</div>

<style>
@media(max-width:768px){#ticket-update-grid{grid-template-columns:1fr!important}}
</style>
