/* ============================================================
   LOISHVIZO — DASHBOARD JS
   ============================================================ */
$(function(){

  /* ── PAGE LOADER ─────────────────────────────── */
  var $overlay = $('#page-overlay');
  if ($overlay.length) {
    setTimeout(function(){ $overlay.addClass('outgoing'); }, 300);
    setTimeout(function(){ $overlay.hide(); }, 700);
  }

  /* ── TAB SYSTEM ──────────────────────────────── */
  $(document).on('click', '.d-tab[data-tab]', function(){
    var tab = $(this).data('tab');
    var $parent = $(this).closest('[id]');
    $parent.find('.d-tab').removeClass('active');
    $(this).addClass('active');
    var $panels = $(this).closest('div').next('#payment-panels, .d-tab-panels');
    if (!$panels.length) $panels = $('[id^="tab-"]').parent();
    $('[id^="tab-"]').removeClass('active');
    $('#tab-' + tab).addClass('active');
  });

  /* ── AJAX SEARCH / FILTER ───────────────────── */
  $(document).on('change', '.ajaxChange', function(){
    var url = $(this).data('url') + $(this).val();
    pageOverlay && pageOverlay.show && pageOverlay.show();
    $.get(url, function(html){
      $('#result_ajaxSearch').html(html);
      pageOverlay && pageOverlay.hide && pageOverlay.hide();
    });
  });

  /* ── COPY BUTTON ────────────────────────────── */
  $(document).on('click', '.d-copy-btn', function(){
    var text = $(this).data('copy') || $(this).prev().text();
    if (navigator.clipboard) {
      navigator.clipboard.writeText(text.trim());
    } else {
      var $t = $('<textarea>').val(text).appendTo('body').select();
      document.execCommand('copy');
      $t.remove();
    }
    $(this).text('Copied!');
    var self = this;
    setTimeout(function(){ $(self).text('Copy'); }, 2000);
  });

  /* ── MOBILE: close sidebar on nav click ─────── */
  $(document).on('click', '.d-nav-item', function(){
    if (window.innerWidth <= 1024) {
      closeDashSidebar && closeDashSidebar();
    }
  });

});

/* Page overlay helpers (global) */
var pageOverlay = {
  show: function(){ $('#page-overlay').addClass('visible').show(); },
  hide: function(){ $('#page-overlay').removeClass('visible'); setTimeout(function(){ $('#page-overlay').hide(); }, 400); }
};
