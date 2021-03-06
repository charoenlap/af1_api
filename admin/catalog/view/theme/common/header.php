<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo (isset($title)?$title:'');?></title>
  <!-- bootstrap -->
  <link rel="stylesheet" type="text/css" href="assets/global/bootstrap-4.5.0/dist/css/bootstrap.min.css">
  <!-- css theme -->
  <link rel="stylesheet" type="text/css" href="assets/global/css/theme-admin.css">

  <!-- jquery -->
  <script type="text/javascript" src="assets/global/js/jquery-3.1.1.min.js"></script>

  <link rel="stylesheet" href="assets/global/css/bootstrap.min.css">
  <script src="assets/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
</head>
<body>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
<?php if(!empty($emp_id)){ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo route('home/logout'); ?>">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<?php } ?>
<div class="container-fluid">
  <div class="row">
    <?php if(!empty($emp_id)){ ?>
    <div class="col-2">
      <div id="sidebar" class="bg-dark">
        <ul class="menu-sidebar">
          <li><a href="<?php echo route('booking&date='.date('Y-m-d')); ?>">Booking</a></li>
          <li><a href="<?php echo route('connote&date='.date('Y-m-d')); ?>">Connote</a></li>
          <li><a href="<?php echo route('import&date='.date('Y-m-d')); ?>">Import</a></li>
        </ul>
      </div>
    </div>
    <?php } ?>
    <div class="col-1<?php echo (!empty($emp_id)?'0':'2');?>">
  
