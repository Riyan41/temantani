<?php 
	$session = \Config\Services::session();
?>
<p>
	<a href="<?php echo base_url('admin/sewa/tambahalat') ?>" class="btn btn-success">
		<i class="fa fa-plus"></i> Tambah Baru
	</a>
</p>

<table class="table table-bordered">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="8%">Gambar</th>
			<th width="15%">Alat</th>
			<th width="30%">Ringkasan</th>
			<th width="12%">Jenis Harga</th>
			<th width="10%">Harga Sewa</th>
			<th width="13%">Harga Sewa + Pekerja</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($sewa as $sewa) { ?>
		<tr>
			<td><?php echo $no ?></td>
			<td>
				<?php if($sewa['foto']=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$sewa['foto']) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td>	
				<?php if ($session->get('akses_level') == "Superadmin" || $session->get('id_user') == $sewa['id_user2']) { ?>
					<a href="<?php echo base_url('admin/sewa/editalat/'.$sewa['id_sewa2']) ?>">
						<?php echo $sewa['nama_alat'] ?>
					</a>
				<?php } else { echo $sewa['nama_alat']; } ?>
				<br>
				<small>
					<?php 
						if($sewa['status_alat'] == "tersedia") {
							echo "Tersedia";
						} else {
							echo "Tidak Tersedia";
						}
					?>
				</small>
			</td>
			<td>
				<?php echo $sewa['ringkasan'] ?>
			</td>
			<td>
				<?php 
					if($sewa['jenis_harga'] == "luastanah") {
						echo "Per Luas Tanah (m&sup2;)";
					} else {
						echo "Per Jam";
					}
				?>
			</td>
			<td>
				<?php echo "Rp. ". angka($sewa['harga_sewa']) ?>
			</td>	
			<td>
				<?php echo "Rp. ". angka($sewa['hargasewa_pekerja']) ?>
			</td>
			<td>
				<?php if ($session->get('akses_level') == "Superadmin" || $session->get('id_user') == $sewa['id_user2']) { ?>
					<a href="<?php echo base_url('admin/sewa/editalat/'.$sewa['id_sewa2']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<?php } ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>