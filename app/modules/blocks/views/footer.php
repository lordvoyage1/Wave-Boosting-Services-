<footer class="d-footer" style="margin-left:var(--d-sidebar);padding:18px 24px;border-top:1px solid var(--d-border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;font-size:12px;color:var(--d-muted);background:#fff">
  <div>
    &copy; <?=date('Y')?> <strong style="color:var(--d-navy)"><?=get_option('website_title','Loishvizo Boosting Solutions')?></strong> &mdash; Ultra Speed SMM Panel
  </div>
  <div style="display:flex;gap:16px;align-items:center">
    <a href="<?=cn('services')?>" style="color:var(--d-muted);text-decoration:none">Services</a>
    <a href="<?=cn('order/new_order')?>" style="color:var(--d-muted);text-decoration:none">New Order</a>
    <a href="<?=cn('add_funds')?>" style="color:var(--d-muted);text-decoration:none">Add Funds</a>
    <a href="<?=cn('tickets')?>" style="color:var(--d-muted);text-decoration:none">Support</a>
    <a href="<?=cn('terms')?>" style="color:var(--d-muted);text-decoration:none">Terms</a>
  </div>
  <div style="display:flex;align-items:center;gap:6px">
    <span style="width:7px;height:7px;border-radius:50%;background:#27ae60;display:inline-block"></span>
    All systems operational
  </div>
</footer>
<style>
@media(max-width:1024px){
  .d-footer{ margin-left:0 !important; }
}
</style>
