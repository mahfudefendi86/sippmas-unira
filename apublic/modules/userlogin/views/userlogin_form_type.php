<?php
$is_edit=(isset($userlogin));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formuserlogin" id="userlogin" action="<?php echo (!$is_edit) ? site_url("userlogin/userlogin_add") : site_url("userlogin/userlogin_upd").'/'.$userlogin->id_login;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->id_login;?>" name="usr_id_login" id="usr_id_login" placeholder="id_login"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? $user->id_user : $userlogin->userid;?>" name="user_id" id="user_id" placeholder="user_id"   />
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_nama">Nama</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" readonly class="form-control" value="<?php echo (!$is_edit) ? $user->nama : $userlogin->nama;?>" name="usr_nama" id="usr_nama" placeholder="Nama"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_alamat">Alamat</label>
		<div class="col-sm-12 col-md-9">
			<textarea name="usr_alamat" readonly id="usr_alamat"   class="form-control" placeholder="Alamat" ><?php echo (!$is_edit) ? $user->alamat : $userlogin->alamat;?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_email">Email</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" readonly class="form-control" value="<?php echo (!$is_edit) ? $user->email : $userlogin->email_recv;?>" name="usr_email" id="usr_email" placeholder="Email"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_no__hp">No. HP</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" readonly class="form-control" value="<?php echo (!$is_edit) ? $user->no_hp : $userlogin->hp_recv;?>" name="usr_no__hp" id="usr_no__hp" placeholder="No. HP"   />
		</div>
	</div>
	<div class="card p-3">
		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="usr_type">Type</label>
			<div class="col-sm-12 col-md-9">
				<input type="text" readonly class="form-control" value="<?php echo (!$is_edit) ? $type : $userlogin->identifikasi;?>" name="usr_type" id="usr_type" placeholder="Type"   />
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="usr_username">Username</label>
			<div class="col-sm-12 col-md-9">
				<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->username;?>" name="usr_username" id="usr_username" placeholder="Username"   />
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="usr_password">Password</label>
			<div class="col-sm-12 col-md-9">
				<input type="text" class="form-control" value="" name="usr_password" id="usr_password" placeholder="Password"   />
				<?php
				if($is_edit){
					echo '<span class="badge badge-success">Biarkan Kolom Password Kosong, jika tidak ingin mengganti Password.</span>';
				}
				?>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="usr_status">Status</label>
			<div class="col-sm-12 col-md-9">
				<select class="form-control"  name="usr_status" id="usr_status" placeholder="Type">
					<option value="">= Pilih Status = </option>
					<?php
						$ts=array('AKTIF'=>'Aktif','NONAKTIF'=>'Non Aktif');
						foreach ($ts as $key2=>$value) {
							if($key2==((!$is_edit) ? '' : $userlogin->status)){
								echo '<option value="'.$key2.'" selected>'.$value.'</option>';
							}else{
								echo '<option value="'.$key2.'">'.$value.'</option>';
							}
						}
					?>
				</select>
			</div>
		</div>
	</div>
<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<div class="col-md-4 col-lg-4 col-sm-12 m-1">
						<button type="submit" class="btn btn-primary btn-lg col-12"><span class="fa fa-save"></span> Simpan</button>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 m-1">
						<button type="reset" class="btn btn-warning btn-lg col-12" onclick="$('#modalView').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
					</div>
				</div>
			</div>
		</div>

</form>
</div>
<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
			<script type="text/javascript">
			 $("#userlogin").validate({
			 		errorClass: "is-invalid",
					validClass: "is-valid",
					wrapper: "span",
				  rules:{
					usr_username: { required: true },
					<?php echo (!$is_edit) ? 'usr_password: { required: true },' :'';?>
					usr_nama: { required: true },
		  			usr_type: { required: true },
		  			usr_status: { required: true }
 			 	},

				  submitHandler: function() {
					var frm=$("#userlogin");
					$.ajax({
						url       : frm.attr("action"),
						type      : frm.attr("method"),
						dataType  : "html",
						data      : frm.serialize(),
						beforeSend: function(){
								///Event sebelum/proses data dikirim
								$("#ajax_loader").fadeIn(100);
						},
						success   : function(data){
								///Event Jika data Berhasil diterima
								obj = JSON.parse(data);
								if(obj.status=='OK'){
									$("#alert_info").html(obj.msg);
									reload_data();
								}else
								if(obj.status=='ERROR'){
									$("#alert_info").html(obj.msg);
								}
								$("#modalView").modal("hide");
								$("#ajax_loader").fadeOut(100);
						}
					});///end Of Ajax
				 }

			 });
		</script>
