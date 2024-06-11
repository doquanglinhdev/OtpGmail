<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QUẢN LÝ WEBSITE CHẠY</title>
  <!-- DESCRIPTION WEBSITE -->
  <link rel="icon" type="image/png" href="">
  <meta name="description" content="<?= $LINH->site('mota'); ?>">
  <meta name="keywords" content="<?= $LINH->site('tukhoa'); ?>">
  <meta property="og:title" content="<?= $LINH->site('tenweb'); ?>">
  <meta property="og:type" content="website" />
  <meta property="og:description" content="<?= $LINH->site('mota'); ?>">
  <meta property="og:image" content="<?= URL('assets/img/head_img.jpg'); ?>">
  <meta property="og:url" content="<?= URL(''); ?>">
  <!-- JQUERY -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/jqvmap/jqvmap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/dist/css/adminlte.min.css'); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/daterangepicker/daterangepicker.css'); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/summernote/summernote-bs4.min.css'); ?>">
  <!-- CUTE ALERT -->
  <link rel="stylesheet" href="<?= URL('assets/vendor/cute-alert-master/style.css'); ?>">
  <script src="<?= URL('assets/vendor/cute-alert-master/cute-alert.js'); ?>"></script>
  <!-- DATATABLES -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <!-- <link rel="stylesheet" href="<?= URL('assets/vendor/admin_lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>"> -->

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />
  <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>

</head>
<?php CheckLogin(); ?>
<?php CheckAdmin(); ?>