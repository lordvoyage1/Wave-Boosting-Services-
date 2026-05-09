<?php
$class_element = app_config('template')['form']['class_element'];
$form_subjects = [
  'subject_order'   => lang("Order"),
  'subject_payment' => lang("Payment"),
  'subject_service' => lang("Service"),
  'subject_other'   => lang("Other"),
];
$form_request = [
  'refill'       => lang("Refill"),
  'cancellation' => lang("Cancellation"),
  'speed_up'     => lang("Speed_Up"),
  'other'        => lang("Other"),
];
$form_payments = [
  'paypal'   => lang("Paypal"),
  'stripe'   => lang("Stripe"),
  'speed_up' => lang("Stripe"),
  'other'    => lang("Other"),
];
$elements = [
  ['label' => form_label(lang('Subject')),     'element' => form_dropdown('subject', $form_subjects, '', ['class' => $class_element.' ajaxChangeTicketSubject']), 'class_main' => "col-md-12"],
  ['label' => form_label(lang('Request')),     'element' => form_dropdown('request', $form_request, '', ['class' => $class_element]),                           'class_main' => "col-md-12 subject-order"],
  ['label' => form_label(lang('order_id')),    'element' => form_input(['name'=>'orderid','value'=>'','placeholder'=>lang("for_multiple_orders_please_separate_them_using_comma_example_123451234512345"),'type'=>'text','class'=>$class_element]), 'class_main' => "col-md-12 subject-order"],
  ['label' => form_label(lang('Payment')),     'element' => form_dropdown('payment', $form_payments, '', ['class' => $class_element]),                         'class_main' => "col-md-12 subject-payment d-none"],
  ['label' => form_label(lang('Transaction_ID')),'element' => form_input(['name'=>'transaction_id','value'=>'','placeholder'=>lang("enter_the_transaction_id"),'type'=>'text','class'=>$class_element]), 'class_main' => "col-md-12 subject-payment d-none"],
  ['label' => form_label(lang("Description")), 'element' => form_textarea(['name'=>'description','value'=>'','class'=>$class_element]),                        'class_main' => "col-md-12"],
];
$form_url        = cn($controller_name."/store/");
$redirect_url    = cn($controller_name);
$form_attributes = ['class' => 'form actionForm', 'data-redirect' => $redirect_url, 'method' => "POST"];
?>

<div class="d-page-header">
  <h1><i class="fe fe-message-circle"></i> <?=lang("Tickets")?></h1>
</div>

<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:20px" id="tickets-layout">

  <!-- New Ticket -->
  <div class="d-card">
    <div class="d-card-header">
      <span class="d-card-title"><i class="fe fe-edit" style="color:var(--d-purple)"></i> <?=lang("add_new_ticket")?></span>
    </div>
    <div class="d-card-body">
      <?=form_open($form_url, $form_attributes)?>
        <div id="add_new_ticket">
          <div class="row">
            <?=render_elements_form($elements)?>
            <div class="col-md-12" style="margin-top:8px">
              <button type="submit" class="d-btn d-btn-primary" style="width:100%;justify-content:center">
                <i class="fe fe-send"></i> <?=lang('Submit')?>
              </button>
            </div>
          </div>
        </div>
      <?=form_close()?>
    </div>
  </div>

  <!-- Ticket List -->
  <div>
    <div class="d-card d-mb-16" style="background:transparent;border:none;padding:0">
      <!-- search -->
      <div class="d-search-row" style="margin-bottom:12px">
        <div class="d-search-wrap" style="flex:1">
          <i class="fe fe-search"></i>
          <input type="text" name="query" class="d-search-input" placeholder="<?=lang('Search')?>..." value="">
        </div>
        <a href="<?=cn($controller_name."/add")?>" class="d-btn d-btn-outline d-btn-sm d-none d-sm-inline-flex ajaxModal">
          <i class="fe fe-plus"></i> <?=lang("add_new")?>
        </a>
      </div>
    </div>

    <div class="row" id="result_ajaxSearch">
      <?php if (!empty($items)): ?>
        <div class="col-md-12">
          <?php foreach ($items as $item):
            $this->load->view('child/index', ['controller_name' => $controller_name, 'item' => $item]);
          endforeach; ?>
        </div>
      <?php else: ?>
        <div class="col-md-12">
          <div class="d-card">
            <div class="d-empty">
              <i class="fe fe-inbox"></i>
              <h3><?=lang("no_tickets_found")?></h3>
              <p><?=lang("open_a_ticket_if_you_need_help")?></p>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?=show_pagination($pagination)?>
    </div>
  </div>

</div>

<style>
@media(max-width:768px){ #tickets-layout{ grid-template-columns:1fr !important; } }
</style>
