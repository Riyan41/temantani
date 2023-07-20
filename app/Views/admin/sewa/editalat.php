<form action="<?php echo base_url('admin/sewa/editalat/'.$sewa['id_sewa2']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-2">Nama ALat</label>
	<div class="col-md-10">
		<input type="text" name="nama_alat" class="form-control" value="<?php echo $sewa['nama_alat'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Upload Gambar</label>
	<div class="col-md-10">
		<input type="file" name="gambar" class="form-control" value="<?php echo $sewa['foto'] ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Kategori</label>
	<div class="col-md-2">
		<select name="id_kategori" class="form-control">
			<?php foreach($kategori as $kategori) { ?>
			<option value="<?php echo $kategori['id_kategori'] ?>" <?php if($sewa['kategori_id']==$kategori['id_kategori']) { echo 'selected'; } ?>>
				<?php echo $kategori['nama_kategori'] ?>
			</option>
			<?php } ?>
		</select>
		<small class="text-secondary">Kategori</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Ringkasan</label>
	<div class="col-md-10">
		<textarea name="ringkasan" class="form-control"><?php echo $sewa['ringkasan'] ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Jenis Harga</label>
	<div class="col-md-10">
		<select name="jenis_harga" class="form-control">
			<option value="jam">Per Jam</option>
			<option value="luastanah" <?php if($sewa['jenis_harga']=="luastanah") { echo 'selected'; } ?>>Per Luas Tanah (m&sup2;)</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Harga</label>
	<div class="col-md-10">
		<input type="text" name="harga_sewa" class="form-control" value="<?php echo $sewa['harga_sewa'] ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Harga + Pekerja</label>
	<div class="col-md-10">
		<input type="text" name="hargasewa_pekerja" class="form-control" value="<?php echo $sewa['hargasewa_pekerja'] ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Status Alat</label>
	<div class="col-md-10">
		<select name="status_alat" class="form-control">
			<option value="tersedia">Tersedia</option>
			<option value="tidak" <?php if($sewa['status_alat']=="tidak") { echo 'selected'; } ?>>Tidak Tersedia</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2"></label>
	<div class="col-md-10">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<?php echo form_close(); ?>