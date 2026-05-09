<!doctype html>
<html lang="en" dir="ltr">
<head>
  <?php include 'elements/head.blade.php'; ?>
</head>
<body>

<div id="page-overlay" class="visible incoming">
  <div class="loader-wrapper-outer">
    <div class="loader-wrapper-inner">
      <div class="lds-double-ring"><div></div><div></div><div><div></div></div><div><div></div></div></div>
    </div>
  </div>
</div>

<?php include_once 'blocks/sidebar.php'; ?>
<?php include_once 'blocks/header_vertical.php'; ?>

<main class="d-main">
  <?php echo $template['body']; ?>
</main>

<!-- Modal -->
<div id="modal-ajax" class="modal fade" tabindex="-1"></div>

<?php include 'elements/script.blade.php'; ?>
</body>
</html>
