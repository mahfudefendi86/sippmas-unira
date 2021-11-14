<?php
$is_edit=(isset($userlogin));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="userlogin" id="userlogin" action="<?php echo (!$is_edit) ? site_url("userlogin/userlogin_add") : site_url("userlogin/userlogin_upd").'/'.$userlogin->id_login;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->id_login;?>" name="usr_id_login" id="usr_id_login" placeholder="id_login"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? "" : $userlogin->userid;?>" name="user_id" id="user_id" placeholder="user_id"   />

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_type">Type</label>
		<div class="col-sm-12 col-md-9">
			<select class="form-control"  name="usr_type" id="usr_type" placeholder="Type">
				<option value="-">= Pilih Type User = </option>
				<?php
					if($this->session->userdata('akses')==="SUA"){
						echo '<option value="SUA" selected>Super Admin</option>';
					}
					$ty=array('ADM'=>'Administrator','PENELITI'=>'Author/Peneliti','REVIEWER'=>'Reviewer');
					$identifikasi=(!$is_edit) ? '' : $userlogin->identifikasi;
					foreach ($ty as $key=>$value) {
						if($key==$identifikasi){
							echo '<option value="'.$key.'" selected>'.$value.'</option>';
						}else{
							echo '<option value="'.$key.'">'.$value.'</option>';
						}
					}
				?>
			</select>
		</div>
	</div>
	<span id="akun"></span>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_username">Username</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->username;?>" name="usr_username" id="usr_username" placeholder="Username"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_password">Password</label>
		<div class="col-sm-12 col-md-9">
			<input type="password" class="form-control" name="usr_password" id="usr_password" placeholder="Password"   />
			<?php
			if($is_edit){
				echo '<span class="badge badge-success">Biarkan Kolom Password Kosong, jika tidak ingin mengganti Password.</span>';
			}
			?>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_nama">Nama</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->nama;?>" name="usr_nama" id="usr_nama" placeholder="Nama"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_alamat">Alamat</label>
		<div class="col-sm-12 col-md-9">
			<textarea name="usr_alamat" id="usr_alamat"   class="form-control" placeholder="Alamat" ><?php echo (!$is_edit) ? '' : $userlogin->alamat;?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_email">Email</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->email_recv;?>" name="usr_email" id="usr_email" placeholder="Email"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="usr_no__hp">No. HP</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->hp_recv;?>" name="usr_no__hp" id="usr_no__hp" placeholder="No. HP"   />
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
<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<button type="submit" class="btn btn-primary btn-lg col-3 mx-2"><span class="fa fa-save"></span> Simpan</button>
					<button type="reset" class="btn btn-warning btn-lg col-3 mx-2" onclick="$('#modalView').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
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
				<?php if(!$is_edit){echo 'usr_password:{ required: true },';}?>
				usr_nama: { required: true },
				usr_type: { required: true },
				usr_status: { required: true }
		 	},
			messages:{
				usr_username: "Username untuk login wajib diisi...",
				<?php if(!$is_edit){echo 'usr_password:"Password wajib diisi...",';}?>
				usr_nama: "Nama user wajib diisi...",
				usr_type: "Type user wajib dipilih...",
				usr_status: "Status wajib dipilih..."
	 		},
		  submitHandler: function() {
					var usertype=$("#usr_type").val();
					var type_akun=$("#type_akun").val();
				
				if(type_akun=="" || type_akun==null  || usertype=="-" || usertype==null){
					alert("Maaf anda masih belum memilih Author/Reviewer!");
					return false;
				}else{
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
				
			}

	 });

	setTimeout("get_akun()",300);

	 $("#usr_type").change(function(){
		get_akun();
	 })

	 function get_akun(){
		var usertype=$("#usr_type").val();
		var id_user=$("#user_id").val();
		if(usertype=="ADM" || usertype=="-"){
 			$("#akun").html("");
 		}else{
 			if(usertype=="PENELITI"){
 				var text="Author"
 			}else
 			if(usertype=="REVIEWER"){
 				var text="Reviewer"
 			}
 			$.ajax({
 				url       : "<?php echo site_url('userlogin/select_akun');?>/"+usertype+"/"+id_user,
 				dataType  : "html",
 				beforeSend: function(){
 							  $("#ajax_loader").fadeIn(100);
 				},
 				success   : function(data){

 					obj = JSON.parse(data);
 					if(obj.status=="OK"){
 						var option='<select name="type_akun" id="type_akun" class="form-control" >'
						option=option+'<option value="" selected>Pilih Nama Author/Reviewer</option>';
 						$.each(obj.user, function(index, value){
							if(id_user==value.id_user){
								option=option+'<option value="'+value.id_user+'" selected>'+value.nama+'</option>';
							}else{
								option=option+'<option value="'+value.id_user+'">'+value.nama+'</option>';
							}
 						})
 						option=option+'</select>';
 					}else
 					if(obj.status=="GAGAL"){
 						var option='<select name="type_akun" id="type_akun" class="form-control" >';
 						option=option+'<option value="">-- Tidak ditemukan data '+text+'</option>';
 						option=option+'</select>';
 					}
 					var html='<div class="form-group row alert alert-danger">'
 						+'<label class="col-sm-12 col-md-3" style="text-transform:capitalize;" for="akun">Pilih '+text+'</label>'
 						+'<div class="col-sm-12 col-md-9">'
 						+option
 						+'</div>'
 					+'</div>';
 					$("#ajax_loader").fadeOut(100);
 					$("#akun").html(html);
 				}
 			}); //end Of Ajax
 		}
	 }
</script>
