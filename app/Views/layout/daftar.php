<?php 
echo form_open(base_url('home')); 
echo csrf_field(); 
?>
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Daftar Akun</h4>
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label class="col-3">Nama Pengguna</label>
					<div class="col-9">
						<input type="text" name="nama" class="form-control" placeholder="Nama user" value="<?php echo set_value('nama') ?>" required>
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label class="col-3">Email</label>
					<div class="col-9">
						<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" required>
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label class="col-3">Username</label>
					<div class="col-9">
						<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username') ?>" required>
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label class="col-3">No Handphone</label>
					<div class="col-9">
						<input type="text" name="nohp" class="form-control" placeholder="No Handphone" value="<?php echo set_value('nohp') ?>" required>
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label class="col-3">Alamat</label>
					<div class="col-9">
						<input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?php echo set_value('alamat_user') ?>" required>
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label class="col-3">Password</label>
					<div class="col-9">
						<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>" required>
					</div>
				</div>

				<br>

			</div>
			<div class="modal-footer justify-content-between">
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>