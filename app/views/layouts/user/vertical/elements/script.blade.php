<script src="<?=BASE?>assets/js/vendors/bootstrap.bundle.min.js"></script>
<script src="<?=BASE?>assets/js/vendors/jquery.sparkline.min.js"></script>
<script src="<?=BASE?>assets/js/vendors/selectize.min.js"></script>
<script src="<?=BASE?>assets/admin/vendors/autosize/autosize.min.js"></script>
<script src="<?=BASE?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?=BASE?>assets/js/core.js"></script>
<script src="<?=BASE?>assets/admin/dist/js/admin-core.min.js"></script>
<?php if(segment('1') == 'statistics'){ ?>
<script src="<?=BASE?>assets/js/chart_template.js"></script>
<?php }?>
<script src="<?=BASE?>assets/plugins/jquery-toast/js/jquery.toast.js"></script>
<script src="<?=BASE?>assets/plugins/flags/js/docs.js"></script>
<script src="<?=BASE?>assets/js/process.js"></script>
<script src="<?=BASE?>assets/js/general.js"></script>

<script>
// ── Dashboard UI ─────────────────────────────────
(function(){
  // Sidebar toggle
  var sidebar = document.getElementById('dSidebar');
  var overlay = document.getElementById('dOverlay');
  document.getElementById('dHamburger') && document.getElementById('dHamburger').addEventListener('click', function(){
    sidebar.classList.toggle('open');
    overlay.classList.toggle('show');
    document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
  });
  overlay && overlay.addEventListener('click', function(){
    sidebar.classList.remove('open');
    overlay.classList.remove('show');
    document.body.style.overflow = '';
  });

  // User dropdown
  document.querySelectorAll('[data-ddtoggle]').forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.stopPropagation();
      var target = document.getElementById(btn.dataset.ddtoggle);
      var isOpen = target.classList.contains('show');
      document.querySelectorAll('.d-dropdown-menu.show').forEach(function(m){ m.classList.remove('show'); });
      if(!isOpen) target.classList.add('show');
    });
  });
  document.addEventListener('click', function(){
    document.querySelectorAll('.d-dropdown-menu.show').forEach(function(m){ m.classList.remove('show'); });
  });

  // Page loader fade out
  var overlay2 = document.getElementById('page-overlay');
  if(overlay2){
    overlay2.classList.remove('incoming');
    setTimeout(function(){ overlay2.classList.add('outgoing'); setTimeout(function(){ overlay2.style.display='none'; }, 400); }, 100);
  }
})();
</script>
<?=htmlspecialchars_decode(get_option('embed_javascript', ''), ENT_QUOTES)?>
