<?php 
	$session = \Config\Services::session();
?>
<div class="row">
	<div class="col-3">
		<img src="<?php if($user['gambar']=="") { echo icon(); }else{ echo base_url('assets/upload/image/'.$user['gambar']); } ?>" class="img img-thumbnail">
	</div>
	<div class="col-9">
		<form action="<?php echo base_url('admin/akun') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<?php 
			echo csrf_field(); 
			?>
			<input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
			<div class="form-group row">
				<label class="col-3">Nama Pengguna</label>
				<div class="col-9">
					<input type="text" name="nama" class="form-control" placeholder="Nama user" value="<?php echo $user['nama'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Email</label>
				<div class="col-9">
					<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $user['email'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Username</label>
				<div class="col-9">
					<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $user['username'] ?>" readonly>
				</div>
			</div>

			<?php if ($session->get('akses_level') == "User") { ?>
				<div class="form-group row">
					<label class="col-3">No HP</label>
					<div class="col-9">
						<input type="text" name="nohpusr" class="form-control" placeholder="No Handphone" value="<?php echo $user['nohp'] ?>">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Alamat</label>
					<div class="col-9">
						<input type="text" name="alamatusr" class="form-control" placeholder="Alamat" value="<?php echo $user['alamat_user'] ?>">
					</div>
				</div>
			<?php } ?>

			<div class="form-group row">
				<label class="col-3">Password</label>
				<div class="col-9">
					<input type="text" name="password" class="form-control" placeholder="Password" value="">
					<small class="text-danger">Minimal 6 karakter dan maksimal 32 karakter atau biarkan kosong</small>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Upload Foto profil</label>
				<div class="col-9">
					<input type="file" name="gambar" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3"></label>
				<div class="col-9">
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>

			<?php echo form_close(); ?>
		</div>
	</div>
