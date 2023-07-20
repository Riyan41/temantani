<?php 
$session = \Config\Services::session();
use App\Models\Dasbor_model;
$m_dasbor = new Dasbor_model();
?>
<div class="alert alert-info">
	<h4>Hai <em class="text-warning"><?php echo $session->get('nama') ?></em></h4>
	<hr>
	<p>Selamat datang di website <strong><?php echo namaweb() ?></strong>. Semoga membantu yah.</p>
</div>

 <!-- Info boxes -->
<?php
  if ($session->get('akses_level') != "User") {
?>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-newspaper"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Post Informasi</span>
          <span class="info-box-number">
            <?php echo angka($m_dasbor->sewa()) ?>
            <small>Konten</small>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Clients</span>
          <span class="info-box-number"><?php echo angka($m_dasbor->user()) ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
  <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-images"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Galeri &amp; Banner</span>
          <span class="info-box-number">
            <?php echo angka($m_dasbor->galeri()) ?>
            <small>Konten</small>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tags"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Kategori Sewa</span>
          <span class="info-box-number"><?php echo angka($m_dasbor->kategori()) ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
<?php } ?>
  
</div>
<!-- /.row -->