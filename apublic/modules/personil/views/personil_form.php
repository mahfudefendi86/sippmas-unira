<?php
$is_edit=(isset($personil));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formpersonil" id="personil" action="<?php echo (!$is_edit) ? site_url("personil/personil_add") : site_url("personil/personil_upd").'/'.$personil->id_personil;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $personil->id_personil;?>" name="psn_id_personil" id="psn_id_personil" placeholder="id_personil"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? $penelitian->id_penelitian : $personil->id_penelitian;?>" name="psn_id_penelitian" id="psn_id_penelitian" placeholder="id_penelitian"   />

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="psn_jenis_personil">Jenis Personil</label>
		<div class="col-sm-12 col-md-9">
			<select name="psn_jenis_personil" id="psn_jenis_personil" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					$jp=array('DOSEN','MAHASISWA','STAFF','ALUMNI');
					foreach($jp as $data_jp){
						if($data_jp==((!$is_edit) ? '' : $personil->jenis_personil)){
							echo '<option value="'.$data_jp.'" selected>'.$data_jp.'</option>';
						}else{
							echo '<option value="'.$data_jp.'" >'.$data_jp.'</option>';
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row" id="pnl_dosen" style="display:none;">
		<label class="col-sm-12 col-md-3" for="psn_pilih_dosen">Pilih Dosen</label>
		<div class="col-sm-12 col-md-9">
			<select name="psn_pilih_dosen" id="psn_pilih_dosen" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($id_user)){
						foreach($id_user as $data_id_user){
							if($data_id_user->id_user==((!$is_edit) ? '' : $personil->id_user)){
								echo '<option value="'.$data_id_user->id_user.'" selected>'.$data_id_user->nama.'</option>';
							}else{
								echo '<option value="'.$data_id_user->id_user.'" >'.$data_id_user->nama.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="psn_nama">Nama</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $personil->nama_personil;?>" name="psn_nama" id="psn_nama" placeholder="Nama"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="psn_nim">NIM/NIDN/NIP</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $personil->nim_nidn;?>" name="psn_nim" id="psn_nim" placeholder="NIM"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_fakultas">Fakultas</label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_fakultas" id="pnl_fakultas" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($fakultas)){
						foreach($fakultas as $data_id_fakultas){
							if($data_id_fakultas->id_fakultas==((!$is_edit) ? '' : $personil->fakultas)){
								echo '<option value="'.$data_id_fakultas->id_fakultas.'" selected>'.$data_id_fakultas->nama_fakultas.'</option>';
							}else{
								echo '<option value="'.$data_id_fakultas->id_fakultas.'" >'.$data_id_fakultas->nama_fakultas.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="psn_program_studi">Program Studi</label>
		<div class="col-sm-12 col-md-9">
			<select name="psn_program_studi" id="psn_program_studi" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($program_studi)){
						foreach($program_studi as $data_prodi){
							if($data_prodi->id_prodi==((!$is_edit) ? '' : $personil->program_studi)){
								echo '<option value="'.$data_prodi->id_prodi.'" selected>'.$data_prodi->nama_prodi.'</option>';
							}else{
								echo '<option value="'.$data_prodi->id_prodi.'" >'.$data_prodi->nama_prodi.'</option>';
							}
						}
					}else{
						echo '<option value="" onclick="$(this).val(\'\');">[ Pilih Fakultas Dahulu]</option>';
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
<?php
if($is_edit){
	if($personil->jenis_personil=="DOSEN"){
		echo '$("pnl_dosen").show();';
		echo 'cek_dosen();';
	}
}
?>
 $("#personil").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
			psn_id_penelitian: { required: true },
			psn_jenis_personil: { required: true }
 			 },

		  	submitHandler: function() {
				var frm=$("#personil");
				$.ajax({
					url       : frm.attr("action"),
					type      : frm.attr("method"),
					dataType  : "html",
					data      : frm.serialize(),
					beforeSend: function(){
							///Event sebelum proses data dikirim
							$("#ajax_loader").fadeIn(100);
					},
					success   : function(data){
							///Event Jika data Berhasil diterima
							obj = JSON.parse(data);
							if(obj.status=="OK"){
								$("#alert_info").html(obj.msg);
								reload_data();
							}else
							if(obj.status=="ERROR"){
								$("#alert_info").html(obj.msg);
							}
							$("#modalView").modal("hide");
							$("#ajax_loader").fadeOut(100);
					}
				});///end Of Ajax
		 }
	 });

	 $("#psn_jenis_personil").change(function(){
		 return cek_dosen();
		 alert();
	 });

	 function cek_dosen(){
		var n=$("#psn_jenis_personil").val();
 		if(n=="DOSEN"){
 		   $("#pnl_dosen").show();
 		   $("#psn_nama").attr("readonly",true);
 		   $("#psn_nim").attr("readonly",true);
 		   $("#pnl_fakultas").attr("disabled",true);
 		   $("#psn_program_studi").attr("disabled",true);
		   $("#psn_pilih_dosen").change();
 		}else{
 		   $("#pnl_dosen").hide();
 		   $("#psn_nama").val("").attr("readonly",false);
 		   $("#psn_nim").val("").attr("readonly",false);
 		   $("#pnl_fakultas").val("").attr("disabled",false);
 		   $("#psn_program_studi").val("").attr("disabled",false);
 		}
	 }

	 $("#psn_pilih_dosen").change(function(){
	 	var id=$(this).val();
	 	if(id==""){
	 		alert("INFO: Pilihan Dosen Wajib tidak boleh Kosong...")
	 		return false;
	 	}
	 	$.ajax({
	 		url       : "<?php echo site_url('peneliti/select_dosen');?>",
	 		type      : "POST",
	 		dataType  : "html",
	 		data      : "id="+id,
	 		beforeSend: function(){
	 				///Event sebelum/proses data dikirim
	 				$("#ajax_loader").fadeIn(100);
	 		},
	 		success   : function(data){
					$("#ajax_loader").fadeOut(100);
	 				obj = JSON.parse(data);
	 				$("#psn_nama").val(obj.nama);
					$("#psn_nim").val(obj.nidn);
					$("#pnl_fakultas").val(obj.fakultas).change();
	 		}
	 	});///end Of Ajax
	 });

	 $("#pnl_fakultas").change(function(){
	 	var id=$(this).val();
	 	if(id==""){
	 		$("#pnl_program_studi").html('<option value=""> == Pilih ==</option>');
	 		return false;
	 	}
	 	$.ajax({
	 		url       : "<?php echo site_url('prodi/select_prodi');?>",
	 		type      : "POST",
	 		dataType  : "html",
	 		data      : "idfak="+id,
	 		beforeSend: function(){
	 				///Event sebelum/proses data dikirim
	 				$("#ajax_loader").fadeIn(100);
	 		},
	 		success   : function(data){
	 				var html="";
					$("#ajax_loader").fadeOut(100);
	 				obj = JSON.parse(data);
	 				if(obj.status=='200'){
	 					$.each( obj.data, function( key, value ) {
	 						html = html + '<option value="'+value.id_prodi+'">'+value.nama_prodi+'</option>';
	 					});
	 				}else
	 				if(obj.status=='401'){
	 					html = html + '<option value="">Maaf tidak ada data...</option>';
	 				}else{
	 					html = html + '<option value="">Maaf tidak ada data...</option>';
	 				}
	 				$("#psn_program_studi").html(html);
	 		}
	 	});///end Of Ajax
	 });

</script>
