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
        <div class="section-title">
          <h2><?php echo $title ?></h2>
        </div>
      </div>

      <div class="container">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="30%">Nama Alat</th>
              <th width="13%">Jenis Sewa</th>
              <th width="10%">Jumlah Sewa</th>
              <th width="12%">Total Harga</th>
              <th width="13%">Tanggal Sewa</th>
              <th width="10%">Status</th>
              <!-- <th>Aksi</th> -->
            </tr>
          </thead>
          <tbody style="align: middle;">
            <?php $no=1; foreach($history as $history) { ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $history['nama_alat'] ?></td>
              <td>
                <?php 
                  if ($history['jenis_sewa'] == "sewapekerja") {
                    echo "Sewa + Pekerja";
                  } else {
                    echo "Sewa Alat";
                  }
                ?>
              </td>
              <td>
                <?php echo $history['banyak_sewa'] ?>
                <?php
                  if ($history['jenisharga_sewa'] == "luastanah") {
                    echo " m&sup2;";
                  } else {
                    echo " Jam";
                  }
                ?>
              </td>
              <td><?php echo "Rp. ".number_format($history['total_harga'], 0, ',', '.'); ?></td>
              <td>
                <?php
                  $dateString = $history['tgl_sewa'];
                  $dateTime = \DateTime::createFromFormat('Y-m-d', $dateString);
                  $formattedDate = $dateTime->format('d M Y');
                  echo $formattedDate;
                ?>
              </td>
              <td><?php echo $history['status_order'] ?></td>
              <!-- <td>...</td> -->
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->