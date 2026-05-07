<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta name="description" content="<?=get_option('website_desc', 'Loishvizo Boosting Solutions - The ultra speed social media boosting platform. Boost TikTok, YouTube, Instagram, Facebook, Twitter, Spotify & more instantly.')?>">
    <meta name="keywords" content="<?=get_option('website_keywords', 'loishvizo, smm panel, social media boosting, boost followers, boost likes, tiktok panel, youtube panel, instagram panel, fast smm panel')?>">
    <title><?=get_option('website_title', 'Loishvizo Boosting Solutions - Ultra Speed SMM Panel')?></title>
    <link rel="shortcut icon" type="image/png" href="<?=get_option('website_favicon', BASE.'assets/images/favicon.png')?>">
    <link rel="icon" type="image/png" href="<?=get_option('website_favicon', BASE.'assets/images/favicon.png')?>">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="theme-color" content="#7c22f8">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=BASE?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- jQuery -->
    <script src="<?=BASE?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <!-- Core CSS -->
    <link href="<?=BASE?>assets/css/core.css" rel="stylesheet">
    <!-- Toast -->
    <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/plugins/jquery-toast/css/jquery.toast.css">
    <!-- Theme Style -->
    <link href="<?=BASE?>themes/pergo/assets/css/theme_style.css" rel="stylesheet">
    <script type="text/javascript">
      var token = '<?=$this->security->get_csrf_hash()?>',
          PATH  = '<?=PATH?>',
          BASE  = '<?=BASE?>';
      var deleteItem = '<?=lang("Are_you_sure_you_want_to_delete_this_item")?>';
      var deleteItems = '<?=lang("Are_you_sure_you_want_to_delete_all_items")?>';
    </script>
    <?=htmlspecialchars_decode(get_option('embed_head_javascript', ''), ENT_QUOTES)?>
  </head>
  <body>
