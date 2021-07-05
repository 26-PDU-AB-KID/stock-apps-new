<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <!-- Favicons -->
    <link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="<?= base_url('assets/images/favicons/apple-touch-icon.png') ?>">
    
    <!-- Fontawesome -->
    <link href="<?= base_url('assets/fontawesome-free-5.15.3-web/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-4.6.0/css/bootstrap.min.css') ?>">

    <!-- Date Time Picker -->
    <link rel="stylesheet" href="<?= base_url('assets/datetimepicker/jquery.datetimepicker.css') ?>">

    <!-- Jquery -->
    <script src="<?= base_url('assets/jquery.js') ?>"></script>
    
    <!-- Sweetalert -->
    <script src="<?= base_url('assets/sweetalert2-11.0.16/dist/sweetalert2.all.min.js') ?>"></script>

    <!-- Date Time Picker -->
    <script src="<?= base_url('assets/datetimepicker/build/jquery.datetimepicker.full.min.js') ?>"></script>
    
</head>
<body>

<?= $this->session->flashdata('flash'); ?>  

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?= base_url('dashboard') ?>">Dashboard<span class="sr-only">(current)</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('supplier') ?>">Supplier</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('customer') ?>">Customer</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Goods
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= base_url('raw_material')?>">Raw Material</a>
          <a class="dropdown-item" href="<?= base_url('product')?>">Product</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Transaction
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= base_url('stock_in_raw_material')?>">Stock In Raw Material</a>
          <a class="dropdown-item" href="<?= base_url('convert')?>">Convert</a>
          <a class="dropdown-item" href="<?= base_url('stock_in_product')?>">Stock In Product</a>
          <a class="dropdown-item" href="<?= base_url('stock_out_product') ?>">Stock Out Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link font-weight-bolder" href="#" data-toggle="modal" data-target="#logoutModal"><span data-feather="log-out"></span> Log Out</a>
      </li>
    </ul>
  </div>
</nav>