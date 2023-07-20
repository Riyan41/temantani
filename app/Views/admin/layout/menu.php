<?php 
use App\Models\Konfigurasi_model;
$session = \Config\Services::session();
$konfigurasi  = new Konfigurasi_model;
$site         = $konfigurasi->listing();
?>
<style type="text/css" media="screen">
  .nav-item a:hover {
    color: yellow !important;
  }
</style>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url('assets/upload/image/'.$site['icon']) ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $site['namaweb'] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dahboard -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/dasbor') ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- Sewa -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>Sewa Alat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/sewa/sewaalat') ?>" class="nav-link">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Data Alat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/sewa/riwayatsewa') ?>" class="nav-link">
                  &nbsp;&nbsp;<i class="fas fa-history"></i>&nbsp;&nbsp;
                  <p>Riwayat</p>
                </a>
              </li>
              <?php
                if ($session->get('akses_level') != "User") {
              ?>
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/kategori') ?>" class="nav-link">
                    <i class="fas fa-tags nav-icon"></i>
                    <p>Kategori Alat</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
          <!--  -->
          <?php
            if ($session->get('akses_level') != "User") {
          ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>Informasi
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/sewa') ?>" class="nav-link">
                    <i class="fas fa-table nav-icon"></i>
                    <p>Data Postingan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/sewa/tambah') ?>" class="nav-link">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Tambah Postingan</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Galeri -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-image"></i>
                <p>Galeri &amp; Banner
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/galeri') ?>" class="nav-link">
                    <i class="fas fa-table nav-icon"></i>
                    <p>Data Galeri/Banner</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/galeri/tambah') ?>" class="nav-link">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Tambah Galeri/Banner</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- pengguna -->
            <li class="nav-item">
              <a href="<?php echo base_url('admin/user') ?>" class="nav-link">
                <i class="nav-icon fas fa-lock"></i>
                <p>Pengguna Website</p>
              </a>
            </li>
            <!-- Konfigurasi -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-wrench"></i>
                <p>Setting Website
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/konfigurasi') ?>" class="nav-link">
                    <i class="fas fa-tasks nav-icon"></i>
                    <p>Konfigurasi Umum</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/konfigurasi/logo') ?>" class="nav-link">
                    <i class="fas fa-image nav-icon"></i>
                    <p>Update Logo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url('admin/konfigurasi/icon') ?>" class="nav-link">
                    <i class="fas fa-leaf nav-icon"></i>
                    <p>Update Icon</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>
          <!-- logout -->
          <li class="nav-item">
            <a href="<?php echo base_url('login/logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dasbor') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active"><?php echo $title ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="min-height: 500px;">


<?php 
$validation = \Config\Services::validation();
    $errors = $validation->getErrors();
    if(!empty($errors))
    {
        echo '<span class="text-danger">'.$validation->listErrors().'</span>';
    }
?>

<?php if (session('msg')) : ?>
     <div class="alert alert-info alert-dismissible">
         <?= session('msg') ?>
         <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
     </div>
 <?php endif ?>