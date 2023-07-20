<p>
	<a href="<?php echo base_url('admin/sewa/tambah') ?>" class="btn btn-success">
		<i class="fa fa-plus"></i> Tambah Baru
	</a>
</p>

<table class="table table-bordered">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="8%">Gambar</th>
			<th width="55%">Judul</th>
			<th width="15%">Author - Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($sewa as $sewa) { ?>
		<tr>
			<td><?php echo $no ?></td>
			<td>
				<?php if($sewa['gambar']=="") { echo '-'; }else{ ?>
					<img src="<?php echo base_url('assets/upload/image/thumbs/'.$sewa['gambar']) ?>" class="img img-thumbnail">
				<?php } ?>
			</td>
			<td><a href="<?php echo base_url('admin/sewa/edit/'.$sewa['id_sewa']) ?>">
					<?php echo $sewa['judul_sewa'] ?>
				</a>
				<small>
					<br><i class="fa fa-home"></i> Icon: <i class="<?php echo $sewa['icon'] ?>"></i> <?php echo $sewa['icon'] ?>
					<br><i class="fa fa-calendar-check"></i> Publish: <?php echo tanggal_bulan_menit($sewa['tanggal_publish']) ?>
					<br><i class="fa fa-calendar"></i> Updated: <?php echo tanggal_bulan_menit($sewa['tanggal']) ?>
				</small>
			</td>			
			<td><small>
					<i class="fa fa-user"></i> <a href="<?php echo base_url('admin/sewa/author/'.$sewa['id_user']) ?>">
						<?php echo $sewa['nama'] ?>
					</a>
					<br>
					<i class="fa fa-check"></i> <a href="<?php echo base_url('admin/sewa/status_sewa/'.$sewa['status_sewa']) ?>">
					<?php echo $sewa['status_sewa'] ?>
				</a>
				</small>
			</td>
			<td>
				<a href="<?php echo base_url('sewa/informasi/'.$sewa['slug_sewa']) ?>" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i> Baca</a>
				<a href="<?php echo base_url('admin/sewa/edit/'.$sewa['id_sewa']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
				<a href="<?php echo base_url('admin/sewa/delete/'.$sewa['id_sewa']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>