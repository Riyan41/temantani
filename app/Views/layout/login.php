<?php 
echo form_open(base_url('login/loginuser')); 
echo csrf_field(); 
$session = \Config\Services::session();
?>
<div class="modal fade" id="loginUser">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Login</h4>
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label class="col-3">Username</label>
					<div class="col-9">
						<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username') ?>" required>
					</div>
				</div>

				<br>

				<div class="form-group row">
					<label class="col-3">Password</label>
					<div class="col-9">
						<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ?>" required>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Login</button>
				<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Daftar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo form_close(); ?>
  
<?php include('daftar.php'); ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
<?php if($session->getFlashdata('sukses')) { ?>
// Notifikasi
swal ( "Berhasil" ,  "<?php echo $session->getFlashdata('sukses'); ?>" ,  "success" )
<?php } ?>

<?php if(isset($_GET['logout'])) { ?>
// Notifikasi
swal ( "Berhasil" ,  "Anda berhasil logout." ,  "success" )
<?php } ?>

<?php if(isset($_GET['login'])) { ?>
// Notifikasi
swal ( "Oops..." ,  "Anda belum login." ,  "warning" )
<?php } ?>

<?php if($session->getFlashdata('warning')) { ?>
// Notifikasi
swal ( "Mohon maaf" ,  "<?php echo $session->getFlashdata('warning'); ?>" ,  "warning" )
<?php } ?>

</script>
