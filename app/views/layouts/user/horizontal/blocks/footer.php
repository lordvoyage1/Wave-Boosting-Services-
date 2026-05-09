<?php
  $redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $this->load->model('model');
  $items_languages = $this->model->fetch('id, ids, country_code, code, is_default', LANGUAGE_LIST, ['status' => 1]);
  $lang_current = get_lang_code_defaut();
?>
<footer class="d-dash-footer">
  <div class="d-dash-footer-inner">
    <div class="d-dash-footer-brand">
      <img src="<?=get_option('website_logo', BASE.'assets/images/logo.png')?>" alt="Loishvizo" style="height:28px;width:28px;border-radius:50%;object-fit:cover;border:2px solid var(--d-orange)">
      <span style="font-size:13px;font-weight:700;color:var(--d-navy)">Loishvizo Boosting Solutions</span>
    </div>
    <div class="d-dash-footer-links">
      <a href="<?=cn()?>">Home</a>
      <a href="<?=cn('services')?>"><?=lang('Services')?></a>
      <a href="<?=cn('add_funds')?>"><?=lang('add_funds')?></a>
      <a href="<?=cn('tickets')?>"><?=lang('Tickets')?></a>
      <a href="<?=cn('faq')?>"><?=lang('FAQs')?></a>
      <a href="<?=cn('terms')?>"><?=lang('terms__conditions')?></a>
      <?php if (get_option('enable_api_tab')): ?>
      <a href="<?=cn('api/docs')?>"><?=lang('api_documentation')?></a>
      <?php endif; ?>
    </div>
    <div class="d-dash-footer-right">
      <?php if (!empty($items_languages)): ?>
      <select class="d-select ajaxChangeLanguage" name="ids" data-url="<?=cn('set-language')?>" data-redirect="<?=$redirect?>" style="min-width:120px;padding:6px 10px;font-size:12px">
        <?php foreach ($items_languages as $row): ?>
        <option value="<?=$row->ids?>" <?=(!empty($lang_current) && $lang_current->code == $row->code) ? 'selected' : ''?>><?=language_codes($row->code)?></option>
        <?php endforeach; ?>
      </select>
      <?php endif; ?>
      <span style="font-size:12px;color:var(--d-muted)">
        <?=get_option('copy_right_content', 'Copyright &copy; '.date('Y').' Loishvizo Boosting Solutions. All Rights Reserved.')?>
      </span>
    </div>
  </div>
</footer>

<style>
.d-dash-footer{background:#fff;border-top:1px solid var(--d-border);margin-top:32px}
.d-dash-footer-inner{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;padding:16px 24px}
.d-dash-footer-brand{display:flex;align-items:center;gap:8px}
.d-dash-footer-links{display:flex;align-items:center;flex-wrap:wrap;gap:4px}
.d-dash-footer-links a{font-size:12px;color:var(--d-muted);text-decoration:none;padding:4px 8px;border-radius:6px;font-weight:500;transition:all .2s}
.d-dash-footer-links a:hover{background:var(--d-olt);color:var(--d-orange)}
.d-dash-footer-right{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
@media(max-width:768px){
  .d-dash-footer-inner{flex-direction:column;align-items:flex-start;gap:10px}
  .d-dash-footer-brand span{display:none}
}
</style>
