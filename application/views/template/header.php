<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Erporate</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2/dist/css/select2.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('assets/') ?>images/favicon.png" />
  <!-- datatable -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css">
</head>

<body>
  <!-- datatable -->
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html">
          <img src="<?= base_url('assets/') ?>images/logo.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="<?= base_url('assets/') ?>images/logo-mini.svg" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="<?= base_url('assets/') ?>images/faces/face1.jpg" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">Mohammad Yusuf</p>
                  <div>
                    <small class="designation text-muted">Programmer</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              <button class="btn btn-success btn-block">New Project
                <i class="mdi mdi-plus"></i>
              </button>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('karyawan') ?>">
              <i class="menu-icon mdi mdi-account"></i>
              <span class="menu-title">Karyawan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('perhitungan') ?>">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Perhitungan</span>
            </a>
          </li>
        </ul>
      </nav>