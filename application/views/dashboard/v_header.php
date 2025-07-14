<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Website CMS | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- Custom plugins -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="Logo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image img-circle" alt="User Image">
          Hak Akses: <b><?php echo $this->session->userdata('level'); ?></b>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?php echo base_url('dashboard/profil'); ?>" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profil
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('dashboard/keluar'); ?>" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">WEBSITE CMS</span>
    </a>

    <div class="sidebar">
      <!-- User Panel -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php
            $id_user = $this->session->userdata('id');
            $user = $this->db->query("SELECT * FROM pengguna WHERE pengguna_id = '$id_user'")->row();
          ?>
          <a href="#" class="d-block"><?php echo $user->pengguna_nama; ?></a>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

          <!-- Menu Umum -->
          <li class="nav-item">
            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('dashboard/artikel'); ?>" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i> Artikel
            </a>
          </li>
					<li class="nav-item">
            <a href="<?php echo base_url('dashboard/layanan'); ?>" class="nav-link">
              <i class="nav-icon fas fa-file"></i> Layanan
            </a>
          </li>
					<li class="nav-item">
            <a href="<?php echo base_url('dashboard/testimoni'); ?>" class="nav-link">
              <i class="nav-icon fas fa-star"></i> Testimoni
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('dashboard/profil'); ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i> Profil
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('dashboard/ganti_password'); ?>" class="nav-link">
              <i class="nav-icon fas fa-lock"></i> Ganti Password
            </a>
          </li>

          <!-- Menu Khusus Admin -->
          <?php if ($this->session->userdata('level') == 'admin') { ?>
            <li class="nav-item">
              <a href="<?php echo base_url('dashboard/kategori'); ?>" class="nav-link">
                <i class="nav-icon fas fa-th"></i> Kategori
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('dashboard/pages'); ?>" class="nav-link">
                <i class="nav-icon fas fa-copy"></i> Pages
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('dashboard/pengguna'); ?>" class="nav-link">
                <i class="nav-icon fas fa-users"></i> Pengguna
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('dashboard/pengaturan'); ?>" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i> Pengaturan Website
              </a>
            </li>
            <li class="nav-item">
  <a href="<?php echo base_url('dashboard/portofolio'); ?>" class="nav-link">
    <i class="nav-icon fas fa-images"></i> Portofolio
  </a>
</li>
          <?php } ?>

          <!-- Menu Logout -->
          <li class="nav-item">
            <a href="<?php echo base_url('dashboard/keluar'); ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i> Keluar
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>
