<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta name="description" content="<?=get_option('website_desc', 'Loishvizo Boosting Solutions - Ultra Speed Social Media Boosting Panel')?>">
    <meta name="keywords" content="<?=get_option('website_keywords', 'loishvizo, smm panel, social media boosting, tiktok panel, instagram panel, youtube panel')?>">
    <title><?=get_option('website_title', 'Loishvizo Boosting Solutions')?></title>
    <link rel="shortcut icon" type="image/png" href="<?=get_option('website_favicon', BASE.'assets/images/favicon.png')?>">
    <meta name="theme-color" content="#7c22f8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=BASE?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- jQuery -->
    <script src="<?=BASE?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <!-- Flags -->
    <?php if (segment('1') == 'language'): ?>
    <link href="<?=BASE?>assets/plugins/flags/css/flag-icon.css" rel="stylesheet">
    <?php endif; ?>
    <!-- Core -->
    <link href="<?=BASE?>assets/css/core.css" rel="stylesheet">
    <!-- Charts -->
    <?php if (segment('1') == 'statistics'): ?>
    <link href="<?=BASE?>assets/plugins/charts-c3/c3.css" rel="stylesheet">
    <script src="<?=BASE?>assets/plugins/charts-c3/d3.v3.min.js"></script>
    <script src="<?=BASE?>assets/plugins/charts-c3/c3.min.js"></script>
    <?php endif; ?>
    <!-- Toast -->
    <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/jquery-toast/css/jquery.toast.css">
    <link rel="stylesheet" href="<?=BASE?>assets/plugins/boostrap/colors.css">
    <link rel="stylesheet" href="<?=BASE?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?=BASE?>assets/plugins/boostrap-datetimepicket/bootstrap-datetimepicker.min.css">
    <link href="<?=BASE?>assets/plugins/emoji-picker/lib/css/emoji.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="<?=BASE?>themes/pergo/assets/css/theme_style.css" rel="stylesheet">
    <style>
      /* Override old layout for new sidebar-based design */
      body { background: #06010f; font-family: 'Inter', 'Segoe UI', sans-serif; }
      .page, .page-main { display: block; }
      .my-3.my-md-5 { margin: 0 !important; }
      .my-3.my-md-5 > .container { max-width: 100% !important; padding: 0 !important; }
    </style>
    <script type="text/javascript">
      var token = '<?=htmlspecialchars($this->security->get_csrf_hash())?>',
          PATH  = '<?=PATH?>',
          BASE  = '<?=BASE?>';
    </script>
    <?=htmlspecialchars_decode(get_option('embed_head_javascript', ''), ENT_QUOTES)?>
  </head>
  <body class="lv-user-body">
    <!-- Page loader -->
    <div id="page-overlay" class="visible incoming">
      <div class="loader-wrapper-outer">
        <div class="loader-wrapper-inner">
          <div class="lds-double-ring"><div></div><div></div><div><div></div></div><div><div></div></div></div>
        </div>
      </div>
    </div>

    <!-- Header + Sidebar (injected by blocks/header.php) -->
    <?php include_once 'blocks/header.php'; ?>

    <!-- Main content -->
    <div class="lv-user-main">
      <div class="lv-page-wrap" style="padding:24px 22px">
        <!-- Mobile search -->
        <div class="d-md-none" style="margin-bottom:16px">
          <?php if (allowed_search_bar(segment(1)) || allowed_search_bar(segment(2))): ?>
          <?php echo Modules::run('blocks/search_box'); ?>
          <?php endif; ?>
        </div>
        <?=$template['body']?>
      </div>
    </div>

    <!-- Footer -->
    <?php include_once 'blocks/footer.php'; ?>

    <!-- Modal -->
    <div id="modal-ajax" class="modal fade" tabindex="-1"></div>
    <div id="modal-ajax-notification" class="modal fade" tabindex="-1"></div>

    <!-- Scripts -->
    <script src="<?=BASE?>assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="<?=BASE?>assets/js/vendors/jquery.sparkline.min.js"></script>
    <script src="<?=BASE?>assets/js/vendors/selectize.min.js"></script>
    <script src="<?=BASE?>assets/js/vendors/jquery.tablesorter.min.js"></script>
    <script src="<?=BASE?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?=BASE?>assets/plugins/boostrap-datetimepicket/moment.min.js"></script>
    <script src="<?=BASE?>assets/plugins/boostrap-datetimepicket/bootstrap-datetimepicker.min.js"></script>
    <script src="<?=BASE?>assets/js/core.js"></script>
    <script src="<?=BASE?>assets/plugins/jquery-toast/js/jquery.toast.js"></script>
    <script src="<?=BASE?>assets/plugins/emoji-picker/lib/js/config.js"></script>
    <script src="<?=BASE?>assets/plugins/emoji-picker/lib/js/util.js"></script>
    <script src="<?=BASE?>assets/plugins/emoji-picker/lib/js/jquery.emojiarea.js"></script>
    <script src="<?=BASE?>assets/plugins/emoji-picker/lib/js/emoji-picker.js"></script>
    <script src="<?=BASE?>assets/plugins/flags/js/docs.js"></script>
    <?php if (segment('1') == 'statistics'): ?>
    <script src="<?=BASE?>assets/js/chart_template.js"></script>
    <?php endif; ?>
    <script src="<?=BASE?>assets/js/process.js"></script>
    <script src="<?=BASE?>assets/js/general.js"></script>
    <?=htmlspecialchars_decode(get_option('embed_javascript', ''), ENT_QUOTES)?>
  </body>
</html>
