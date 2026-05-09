<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta http-equiv="Content-Language" content="en">
<meta name="description" content="<?=get_option('website_desc', 'Loishvizo Boosting Solutions - Ultra Speed Social Media Boosting Panel')?>">
<meta name="keywords" content="<?=get_option('website_keywords', 'loishvizo, smm panel, social media boosting')?>">
<title><?=get_option('website_title', 'Loishvizo Boosting Solutions - Ultra Speed SMM Panel')?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?=get_option('website_favicon', BASE.'assets/images/favicon.png')?>">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="theme-color" content="#e67e22">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?=BASE?>assets/plugins/font-awesome/css/font-awesome.min.css">
<!-- jQuery -->
<script src="<?=BASE?>assets/js/vendors/jquery-3.2.1.min.js"></script>
<!-- Toast -->
<link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/jquery-toast/css/jquery.toast.css">
<!-- Bootstrap (for modals + dropdowns) -->
<link href="<?=BASE?>assets/admin/vendors/css/vendor.css" rel="stylesheet">
<!-- Datepicker -->
<link rel="stylesheet" href="<?=BASE?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<!-- Selectize -->
<link href="<?=BASE?>assets/admin/dist/css/admin-core.css" rel="stylesheet">
<!-- Dashboard CSS -->
<link href="<?=BASE?>assets/css/dashboard.css" rel="stylesheet">

<?php if(segment('1') == 'statistics'){ ?>
<link href="<?=BASE?>assets/plugins/charts-c3/c3.css" rel="stylesheet">
<script src="<?=BASE?>assets/plugins/charts-c3/d3.v3.min.js"></script>
<script src="<?=BASE?>assets/plugins/charts-c3/c3.min.js"></script>
<?php }?>

<script type="text/javascript">
  var token = '<?=strip_tags($this->security->get_csrf_hash())?>',
      PATH  = '<?=PATH?>',
      BASE  = '<?=BASE?>';
  var deleteItem  = "<?=lang('Are_you_sure_you_want_to_delete_this_item')?>";
  var deleteItems = "<?=lang('Are_you_sure_you_want_to_delete_all_items')?>";
</script>
<?=htmlspecialchars_decode(get_option('embed_head_javascript', ''), ENT_QUOTES)?>
