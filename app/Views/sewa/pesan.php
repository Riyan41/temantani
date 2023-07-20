<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $title ?></h2>
        
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-5">
         <div class="col-md-8">
           <div class="card" style="margin-bottom: 20px;">
            <img src="<?php echo base_url('assets/upload/image/'.$sewa['foto']) ?>">
            <div class="card-body">
              <h3><?php echo $sewa['nama_alat'] ?></h3>
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
              <?php echo $sewa['ringkasan'] ?>
              <br><br>
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
            </div>
          </div>
        </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3>Order</h3>
              </div>
              <form action="<?php echo base_url('sewa/order') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <label class="col-md-9">Pilih Tanggal</label>
                      <br>
                      <div class="col-md-10">
                        <input type="date" id="tanggal" name="tanggal" min="<?= date('Y-m-d'); ?>" required>
                      </div>
		                  <span id="cektgl"><small class="text-secondary">Cek Tanggal</small></span>
                    </div>
                  </div>
                  <br>
                  <div class="col-9">
                    <label class="col-md-9">Jenis Sewa</label>
                    <br>
                    <div class="col-md-10">
                      <select name="jenis_sewa" id="jenis_sewa" class="form-control">
                        <option value="sewa">Sewa</option>
                        <option value="sewapekerja">Sewa + Pekerja</option>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-9">
                      <label class="col-md-9">
                        <?php 
                          if($sewa['jenis_harga'] == "luastanah"){
                            echo "Luas Tanah (m&sup2;)";
                          } else {
                            echo "Per Jam";
                          }
                        ?>
                      </label>
                      <br>
                      <div class="col-md-10">
                        <input type="text" name="harga" id="harga" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-9">
                      <label class="col-md-9">Total</label>
                      <div class="col-md-10">
                        <input type="text" name="total_sewa" id="total_sewa" class="form-control" readonly>
                        <input type="hidden" name="total_sewa2" id="total_sewa2" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="col-9">
                    <label class="col-md-9">Pembayaran</label>
                    <br>
                    <div class="col-md-10">
                      <select name="jenis_bayar" id="jenis_bayar" class="form-control">
                        <option value="dp">DP / Uang Muka</option>
                        <option value="lunas">Lunas</option>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="col-11">
                    <label class="col-md-9">Total Bayar</label>
                    <div class="col-md-10">
                      <div class="col-md-10">
                        <input type="text" name="total_bayar" id="total_bayar" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="col-11">
                    <label class="col-md-9">Sisa Bayar</label>
                    <div class="col-md-10">
                      <div class="col-md-10">
                        <input type="text" name="sisa_bayar" id="sisa_bayar" class="form-control" readonly>
                        <input type="hidden" name="sisa_bayar2" id="sisa_bayar2" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="col-11">
                    <label class="col-md-9">Upload Bukti Bayar</label>
                    <div class="col-md-10">
                      <div class="col-md-10">
                        <input type="file" name="gambar" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <br>
                  <button id="buttonProses" class="btn btn-success" type="submit">Proses</button>
                </div>
                <input type="hidden" id="id_sewa" name="id_sewa" value="<?php echo $sewa['id_sewa2'] ?>">
                <input type="hidden" id="jns_harga" name="jns_harga" value="<?php echo $sewa['jenis_harga'] ?>">
              </form>
            </div>
          </div>
         </div>
      </div>
    </div>
  </section>
</main>

<script>
    var cektglElement = document.getElementById('cektgl');
    cektglElement.style.display = 'none';
    
    var hargaInput = document.getElementById('harga');
    var jenisSewaInput = document.getElementById('jenis_sewa');
    var totalSewaInput = document.getElementById('total_sewa');
    var totalSewaInput2 = document.getElementById('total_sewa2');
    // 
    var totalBayarInput = document.getElementById('total_bayar');
    var totalSisaBayar = document.getElementById('sisa_bayar');
    var totalSisaBayar2 = document.getElementById('sisa_bayar2');

    function formatRupiah(angka) {
        var numberString = angka.toString();
        var sisa = numberString.length % 3;
        var rupiah = numberString.substr(0, sisa);
        var ribuan = numberString.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return 'Rp ' + rupiah;
    }
    
    function calculateTotalSewa() {
        var harga = parseFloat(hargaInput.value);
        var hrg;

        var jenisSewa = jenisSewaInput.value;

        if (jenisSewa === 'sewa') {
            hrg = <?= $sewa['harga_sewa'] ?>;
        } else if (jenisSewa === 'sewapekerja') {
            hrg = <?= $sewa['hargasewa_pekerja'] ?>;
        }

        var totalSewa = harga * hrg;

        if (!isNaN(totalSewa)) {
            totalSewaInput.value = formatRupiah(totalSewa);
            totalSewaInput2.value = totalSewa;
        } else {
            totalSewaInput.value = '';
            totalSewaInput2.value = '';
        }
    }

    function calculateTotalBayar() {
        var harga2 = parseFloat(totalBayarInput.value);
        var hrg2 = parseFloat(totalSewaInput2.value);

        var totalBayar = hrg2 - harga2;

        if (!isNaN(totalBayar)) {
            totalSisaBayar.value = formatRupiah(totalBayar);
            totalSisaBayar2.value = totalBayar;
        } else {
            totalSisaBayar.value = '';
            totalSisaBayar2.value = '';
        }
    }

    totalBayarInput.addEventListener('input', calculateTotalBayar);
    hargaInput.addEventListener('input', calculateTotalSewa);
    jenisSewaInput.addEventListener('change', calculateTotalSewa);
    // ===================================================
    var tanggalInput = document.getElementById('tanggal');
    var idSewaInput = document.getElementById('id_sewa');
    var buttonProses = document.getElementById('buttonProses');

    tanggalInput.addEventListener('change', function() {
        var tanggal = tanggalInput.value;
        var idSewa = idSewaInput.value;

        // Panggil AJAX ke model untuk memeriksa ketersediaan tanggal
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo base_url('sewa/check_availability') ?>?tanggal=' + tanggal + '&idsewa=' + idSewa, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);

                if (!response.available) {
                    cektglElement.textContent = 'Tersedia';
                    cektglElement.style.color = 'black';
                    buttonProses.disabled = false;
                    cektglElement.style.display = 'block';
                } else {
                    cektglElement.textContent = 'Tidak Tersedia';
                    cektglElement.style.color = 'red';
                    buttonProses.disabled = true;
                    cektglElement.style.display = 'block';
                }
            }
        };

        xhr.send();
    });
</script>

