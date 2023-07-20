<?php
  $session = \Config\Services::session();
?>
<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $title ?></h2>
        <ol>
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li><?php echo $title ?></li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-5">
        <?php foreach($sewa as $sewa) { ?>
         <div class="col-md-4">
           <div class="card" style="margin-bottom: 20px;">
            <img src="<?php echo base_url('assets/upload/image/'.$sewa['foto']) ?>" style="height: 300px;">
            <div class="card-body">
              <h3><?php echo $sewa['nama_alat'] ?></h3>
              <?php if($sewa['ringkasan'] == "no") { ?>
                <p class="card-text">
                  Tidak Tersedia
                </p>
              <?php } ?>
              <a><b>Biaya Per <?php echo $sewa['jenis_harga'] ?></b></a>
              <table>
                <tr>
                  <td><b>Harga Sewa</b></td>
                  <td>&nbsp;:&nbsp;</td>
                  <td>Rp. <?php echo angka($sewa['harga_sewa']) ?></td>
                </tr>
                <tr>
                  <td><b>Harga Sewa + Pekerja</b></td>
                  <td>&nbsp;:&nbsp;</td>
                  <td>Rp. <?php echo angka($sewa['hargasewa_pekerja']) ?></td>
                </tr>
              </table>
              <br>
              <p class="card-text">
                <?php echo $sewa['ringkasan'] ?>
              </p>
              <h5>Informasi Owner</h5>
              <table>
                <tr>
                  <td><b>Nama</b></td>
                  <td>&nbsp;:&nbsp;</td>
                  <td><?php echo $sewa['nama'] ?></td>
                </tr>
                <tr>
                  <td><b>Alamat</b></td>
                  <td>&nbsp;:&nbsp;</td>
                  <td><?php echo $sewa['alamat_user'] ?></td>
                </tr>
              </table>
              <br>
              <p>
                <?php if ($session->get('id_user') == NULL) { ?>
                  <a class="btn btn-success" data-toggle="modal" data-target="#loginUser">
                    Pesan
                  </a>
                <?php } else { ?>
                  <a href="<?php echo base_url('sewa/pesan/'.$sewa['id_sewa2']) ?>" class="btn btn-success">
                    Pesan
                  </a>
                <?php } ?>
              </p>
            </div>
          </div>
         </div>
       <?php } ?>
      </div>
    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->

<?php include(APPPATH . 'views/layout/login.php'); ?>
