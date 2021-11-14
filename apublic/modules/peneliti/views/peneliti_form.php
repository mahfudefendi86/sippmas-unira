<?php
$is_edit=(isset($peneliti));
if(isset($title)){
	echo '<h3 id="title" class="border-bottom border-primary text-primary pb-2" >'.$title.'</h3>';
}
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formpeneliti" id="peneliti" action="<?php echo (!$is_edit) ? site_url("peneliti/peneliti_add") : site_url("peneliti/peneliti_upd").'/'.$peneliti->id_user;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->id_user;?>" name="pnl_id_user" id="pnl_id_user" placeholder="id_user"   />
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_nama_lengkap">Nama Lengkap <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->nama;?>" name="pnl_nama_lengkap" id="pnl_nama_lengkap" placeholder="Nama Lengkap"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_nidn">NIDN <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->nidn;?>" name="pnl_nidn" id="pnl_nidn" placeholder="Nomer Induk Dosen Nasional (NIDN)"   />
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_nidn">NIY <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->niy;?>" name="pnl_niy" id="pnl_niy" placeholder="Nomer Induk Yayasan (NIY)"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_alamat">Alamat <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<textarea name="pnl_alamat" id="pnl_alamat"   class="form-control" placeholder="Alamat" ><?php echo (!$is_edit) ? '' : $peneliti->alamat;?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_kota">Kota/Kabupaten <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_kota" id="pnl_kota" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($kota_kab)){
						foreach($kota_kab as $data_kota_kab){
							if($data_kota_kab->id==((!$is_edit) ? '' : $peneliti->kota_kab)){
								echo '<option value="'.$data_kota_kab->id.'" selected>'.$data_kota_kab->name.'</option>';
							}else{
								echo '<option value="'.$data_kota_kab->id.'" >'.$data_kota_kab->name.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_kecamatan">Kecamatan <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_kecamatan" id="pnl_kecamatan" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($kecamatan)){
						foreach($kecamatan as $data_kecamatan){
							if($data_kecamatan->id== ((!$is_edit) ? '' : $peneliti->kecamatan) ){
								echo '<option value="'.$data_kecamatan->id.'" selected>'.$data_kecamatan->name.'</option>';
							}else{
								echo '<option value="'.$data_kecamatan->id.'" >'.$data_kecamatan->name.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_desa">Desa/Kelurahan <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_desa" id="pnl_desa" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($desa)){
						foreach($desa as $data_desa){
							if($data_desa->id==((!$is_edit) ? '' : $peneliti->desa)){
								echo '<option value="'.$data_desa->id.'" selected>'.$data_desa->name.'</option>';
							}else{
								echo '<option value="'.$data_desa->id.'" >'.$data_desa->name.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_email">Email <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<input type="email" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->email;?>" name="pnl_email" id="pnl_email" placeholder="Email"    />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_nomer_hp">Nomer HP</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->no_hp;?>" name="pnl_nomer_hp" id="pnl_nomer_hp" placeholder="Nomer HP"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_tempat_lahir">Tempat Lahir</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->tempat_lahir;?>" name="pnl_tempat_lahir" id="pnl_tempat_lahir" placeholder="Tempat Lahir"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_tanggal_lahir">Tanggal Lahir <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<div class="input-group date">
				<div class="input-group-addon input-group-prepend">
				    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
				</div>
			  <input type="text" class="form-control"  value="<?php echo (!$is_edit) ? '' : $peneliti->tgl_lahir;?>" name="pnl_tanggal_lahir" id="pnl_tanggal_lahir" placeholder="Tanggal Lahir"  >
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_fakultas">Fakultas <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_fakultas" id="pnl_fakultas" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($fakultas)){
						foreach($fakultas as $data_id_fakultas){
							if($data_id_fakultas->id_fakultas==((!$is_edit) ? '' : $peneliti->fakultas)){
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
		<label class="col-sm-12 col-md-3" for="pnl_program_studi">Program Studi <span class="h4 text-danger text-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_program_studi" id="pnl_program_studi" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($prodi)){
						foreach($prodi as $data_prodi){
							if($data_prodi->id_prodi==((!$is_edit) ? '' : $peneliti->prodi)){
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

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_bidang_keahlian">Bidang Keahlian</label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_bidang_keahlian" id="pnl_bidang_keahlian" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($keahlian)){
						foreach($keahlian as $data_keahlian){
							if($data_keahlian->id_bidangkeahlian==((!$is_edit) ? '' : $peneliti->bidang_keahlian)){
								echo '<option value="'.$data_keahlian->id_bidangkeahlian.'" selected>'.$data_keahlian->nama_bidang.'</option>';
							}else{
								echo '<option value="'.$data_keahlian->id_bidangkeahlian.'" >'.$data_keahlian->nama_bidang.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_bidang_ilmu">Bidang Ilmu</label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_bidang_ilmu" id="pnl_bidang_ilmu" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($keilmuan)){
						foreach($keilmuan as $data_ilmu){
							if($data_ilmu->id_bidangilmu==((!$is_edit) ? '' : $peneliti->bidang_ilmu)){
								echo '<option value="'.$data_ilmu->id_bidangilmu.'" selected>'.$data_ilmu->bidang_ilmu.'</option>';
							}else{
								echo '<option value="'.$data_ilmu->id_bidangilmu.'" >'.$data_ilmu->bidang_ilmu.'</option>';
							}
						}
					}else{
						echo '<option value="" onclick="$(this).val(\'\');">[ Pilih Bidang Keahlian Dahulu]</option>';
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
					<?php if($this->session->userdata("akses")=="ADM" || $this->session->userdata("akses")=="ADM"){ ;?>
					<button type="reset" class="btn btn-warning btn-lg col-3 mx-2" onclick="$('#modalView').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
					<?php };?>
				</div>
			</div>
		</div>

</form>

</div>
<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $("#peneliti").validate({
 		errorClass: "is-invalid",
		validClass: "is-valid",
		wrapper: "span",
	  rules:{
		pnl_nama_lengkap: { required: true },
		pnl_nidn: { required: true },
		pnl_niy: { required: true },
		pnl_alamat: { required: true },
		pnl_desa: { required: true },
		pnl_kecamatan: { required: true },
		pnl_kota: { required: true },
		pnl_email: { required: true, email :true},
		pnl_tanggal_lahir: { required: true },
		pnl_fakultas: { required: true },
		pnl_program_studi: { required: true }
		},
		messages:{
			pnl_nama_lengkap: "Nama wajib diisi...",
			pnl_nidn: "Nomer Induk Dosen Nasional wajib diisi...",
			pnl_niy: "Nomer Induk Yayasan wajib diisi...",
			pnl_alamat: "Alamat wajib diisi...",
			pnl_desa: "Nama Desa wajib dipilih...",
			pnl_kecamatan: "Nama kecamatan wajib dipilih...",
			pnl_kota: "Nama Kota/Kabupaten wajib dipilih...",
			pnl_email: { required: "E-Mail wajib diisi...", email:"Format e-mail tidak valid!!" },
			pnl_tanggal_lahir: "Tanggal lahir wajib diisi...",
			pnl_fakultas: "Fakultas belum dipilih...",
			pnl_program_studi: "Program studi belum dipilih..."
		},

	  submitHandler: function() {
		var frm=$("#peneliti");
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
						<?php if($this->session->userdata("akses")=="PENELITI"){
							echo 'alert("Data profil berhasil disimpan....!");';
						}else{
							echo '$("#alert_info").html(obj.msg);';
							echo 'reload_data();';
						}
						?>
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

 $("#pnl_kota").change(function(){
    var id=$(this).val();
    if(id==""){
 	   $("#pnl_kota").html('<option value=""> == Pilih ==</option>');
 	   return false;
    }
    $.ajax({
 	   url       : "<?php echo site_url('wilayah/getkecamatan');?>/"+id,
 	   dataType  : "html",
 	   beforeSend: function(){
 			   ///Event sebelum/proses data dikirim
 			   $("#ajax_loader").fadeIn(100);
 	   },
 	   success   : function(data){
 			   var html="";
 			   obj = JSON.parse(data);
 			   if(obj.status=='200'){
 				   $.each( obj.kecamatan, function( key, value ) {
 					   html = html + '<option value="'+value.id+'">'+value.name+'</option>';
 				   });
 			   }else
 			   if(obj.status=='404'){
 				   html = html + '<option value="">Maaf, Error loading data...</option>';
 				   return false;
 			   }else{
 				   html = html + '<option value="">Maaf, Error loading data...</option>';
 				   return false;
 			   }
			   $("#ajax_loader").fadeOut(100);
 			   $("#pnl_kecamatan").html(html);
 	   }
    });///end Of Ajax
 });

 $("#pnl_kecamatan").change(function(){
    var id=$(this).val();
    if(id==""){
 	   $("#pnl_kecamatan").html('<option value=""> == Pilih ==</option>');
 	   return false;
    }
    $.ajax({
 	   url       : "<?php echo site_url('wilayah/getdesa');?>/"+id,
 	   dataType  : "html",
 	   beforeSend: function(){
 			   ///Event sebelum/proses data dikirim
 			   $("#ajax_loader").fadeIn(100);
 	   },
 	   success   : function(data){
 			   var html="";
 			   obj = JSON.parse(data);
 			   if(obj.status=='200'){
 				   $.each( obj.desa, function( key, value ) {
 					   html = html + '<option value="'+value.id+'">'+value.name+'</option>';
 				   });
 			   }else
 			   if(obj.status=='404'){
 				   html = html + '<option value="">Maaf, Error loading data...</option>';
 				   return false;
 			   }else{
 				   html = html + '<option value="">Maaf, Error loading data...</option>';
 				   return false;
 			   }
			   $("#ajax_loader").fadeOut(100);
 			   $("#pnl_desa").html(html);
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
 				$("#pnl_program_studi").html(html);
 		}
 	});///end Of Ajax
 });

 $("#pnl_bidang_keahlian").change(function(){
    var id=$(this).val();
    if(id==""){
 	   $("#pnl_bidang_ilmu").html('<option value=""> == Pilih ==</option>');
 	   return false;
    }
    $.ajax({
 	   url       : "<?php echo site_url('bidang_ilmu/select_ilmu');?>",
 	   type      : "POST",
 	   dataType  : "html",
 	   data      : "id="+id,
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
 					   html = html + '<option value="'+value.id_bidangilmu+'">'+value.bidang_ilmu+'</option>';
 				   });
 			   }else
 			   if(obj.status=='401'){
 				   html = html + '<option value="">Maaf tidak ada data...</option>';
 			   }else{
 				   html = html + '<option value="">Maaf tidak ada data...</option>';
 			   }
 			   $("#pnl_bidang_ilmu").html(html);
 	   }
    });///end Of Ajax
 });

</script>
<!--  LOADING DATEPICKER -->
<link href="<?php echo base_url();?>asset/addon/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>asset/addon/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>asset/addon/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
<script>
$('.input-group.date').datepicker({
    maxViewMode: 2,
    language: "id",
    autoclose: true,
    toggleActive: true,
	format:"yyyy-mm-dd"
});
</script>
<!--  END DATA PICKER LOADING-->
