<form action="<?php echo base_url('admin/sewa/edit/'.$sewa['id_sewa']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<?php 
echo csrf_field(); 
?>

<div class="form-group row">
	<label class="col-md-2">Judul</label>
	<div class="col-md-10">
		<input type="text" name="judul_sewa" class="form-control" value="<?php echo $sewa['judul_sewa'] ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Upload Gambar</label>
	<div class="col-md-10">
		<input type="file" name="gambar" class="form-control" value="<?php echo $sewa['gambar'] ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Status</label>
	<div class="col-md-2">
		<select name="status_sewa" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if($sewa['status_sewa']=="Draft") { echo 'selected'; } ?>>Draft</option>
		</select>
		<small class="text-secondary">Status publikasi</small>
	</div>
	<div class="col-md-2">
		<input type="text" name="icon" class="form-control" value="<?php echo $sewa['icon'] ?>">
		<small class="text-secondary">Icon <a href="https://fontawesome.com/icons" target="_blank">Fontawsome</a></small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Ringkasan</label>
	<div class="col-md-10">
		<textarea name="ringkasan" class="form-control"><?php echo $sewa['ringkasan'] ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2">Isi Sewa</label>
	<div class="col-md-10">
		<textarea name="isi" class="form-control konten"><?php echo $sewa['isi'] ?></textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2"></label>
	<div class="col-md-10">
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
	</div>
</div>

<input type="hidden" name="tanggal_publish" class="form-control tanggal" value="<?php if(isset($_POST['tanggal_publis'])) { echo set_value('tanggal_publish'); }else{ echo tanggal_id($sewa['tanggal_publish']); } ?>">
<input type="hidden" name="jam" class="form-control jam" value="<?php if(isset($_POST['jam'])) { echo set_value('jam'); }else{ echo date('H:i:s',strtotime($sewa['tanggal_publish'])); } ?>">
		
<?php echo form_close(); ?>