<?php 
use App\Models\Konfigurasi_model;
use App\Models\Menu_model;
$konfigurasi  = new Konfigurasi_model;
$menu         = new Menu_model();
$site         = $konfigurasi->listing();
$menu_sewa    = $menu->sewa();
$menu_informasi  = $menu->informasi();
$session = \Config\Services::session();
?>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="index.html" class="logo me-auto"><img src="<?php echo base_url('assets/upload/image/'.$site['logo']) ?>" alt="<?php echo $site['namaweb'] ?>"></a>
      
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="<?php echo base_url() ?>">Home</a></li>
          
          <li class="dropdown"><a href="<?php echo base_url('sewa') ?>"><span>Sewa</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php foreach($menu_sewa as $menu_sewa) { ?>
              <li><a href="<?php echo base_url('sewa/kategori/'.$menu_sewa['slug_kategori']) ?>"><?php echo $menu_sewa['nama_kategori'] ?></a></li>
              <?php } ?>
            </ul>
          </li>

          <li class="dropdown"><a href="#"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php foreach($menu_informasi as $menu_informasi) { ?>
              <li><a href="<?php echo base_url('sewa/informasi/'.$menu_informasi['slug_sewa']) ?>"><?php echo $menu_informasi['judul_sewa'] ?></a></li>
              <?php } ?>
            </ul>
          </li>

          <li><a class="nav-link scrollto" href="<?php echo base_url('kontak') ?>">Kontak</a></li>

          <?php if ($session->get('id_user') != NULL) { ?>
            <li><a class="nav-link scrollto" href="<?php echo base_url('history') ?>">History</a></li>
            
            <li><a class="nav-link scrollto" href="<?php echo base_url('admin/akun') ?>">Konfigurasi</a></li>
          <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <?php if ($session->get('id_user') == NULL) { ?>
        <a class="appointment-btn scrollto" data-toggle="modal" data-target="#loginUser">
          Login
        </a>
      <?php } else { ?>
        &nbsp;&nbsp;
        <a href="<?php echo base_url('login/logout2') ?>" class="btn btn-danger">
          Log Out
        </a>
      <?php } ?>

    </div>
  </header><!-- End Header -->
  
  <?php include('login.php'); ?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
