<?php 
	$session = \Config\Services::session();
?>

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="12%">Nama Alat</th>
			<th width="12%">Bukti Pembayaran</th>
			<th width="11%">Jenis Sewa</th>
			<th width="10%">Jumlah Sewa</th>
			<th width="12%">Total Harga</th>
			<th width="11%">Bayar</th>
			<th width="10%">Tanggal Sewa</th>
			<th width="10%">Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($history as $history) { ?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $history['nama_alat'] ?></td>
			<td>
				<?php if($history['bukti_foto']=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$history['bukti_foto']) ?>" class="img img-thumbnail" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)">
				<?php } ?>
			</td>
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

			<?php
				$jb = "";
				if ($history['jenis_bayar'] == "lunas") {
					$jb = " (Lunas)";
				} else {
					$jb = " (DP)<br><u>Sisa Bayar :</u> <br>"."Rp. ".number_format($history['sisa_bayar'], 0, ',', '.');
				}
			?>

			<td><?php echo "Rp. ".number_format($history['total_bayar'], 0, ',', '.').$jb; ?></td>
			<td>
				<?php
					$dateString = $history['tgl_sewa'];
					$dateTime = \DateTime::createFromFormat('Y-m-d', $dateString);
					$formattedDate = $dateTime->format('d M Y');
					echo $formattedDate;
				?>
			</td>
			<td><?php echo $history['status_order'] ?></td>
			<td>
				<?php 
					if ($history['status_order'] == "Konfirmasi") {
						if ($history['jenis_bayar'] == "lunas") {
							echo "-";
						} else { ?>
							<a href="<?php echo base_url('admin/sewa/lunas/'.$history['id_order'].'/'.$history['total_harga']) ?>" class="btn btn-danger btn-sm">Lunas</a>
						<?php }
					} else {
				?>
					<?php if ($session->get('akses_level') == "Superadmin" || $session->get('id_user') == $history['id_user']) { ?>
						<a href="<?php echo base_url('admin/sewa/konfirm/'.$history['id_order']) ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
					<?php } ?>
				<?php } ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>

<script>
	function zoomIn(image) {
		image.style.transform = "scale(3.5)";
		image.style.transition = "transform 0.2s ease"; // Tambahkan efek transisi
	}

	function zoomOut(image) {
		image.style.transform = "scale(1)";
	}

</script>