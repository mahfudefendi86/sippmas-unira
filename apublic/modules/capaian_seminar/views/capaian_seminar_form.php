<?php
$is_edit=(isset($capaian_seminar));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formcapaian_seminar" id="capaian_seminar" action="<?php echo (!$is_edit) ? site_url("capaian_seminar/capaian_seminar_add") : site_url("capaian_seminar/capaian_seminar_upd").'/'.$capaian_seminar->id_seminar;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_seminar->id_seminar;?>" name="cs_id_seminar" id="cs_id_seminar" placeholder="id_seminar"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? $id_penelitian : $capaian_seminar->id_penelitian;?>" name="cs_id_penelitian" id="cs_id_penelitian" placeholder="id_penelitian"   />
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="cs_nama_pertemuan">Nama Pertemuan</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_seminar->tempat;?>" name="cs_nama_pertemuan" id="cs_nama_pertemuan" placeholder="Nama Pertemuan"   />
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="cs_jenis_pertemuan">Jenis Pertemuan</label>
		<div class="col-sm-12 col-md-9">
			<select name="cs_jenis_pertemuan" id="cs_jenis_pertemuan" class="custom-select" >
				<option value="">== Pilih ==</option>
				<?php
					$k=array('Internasional','Nasional','Regional');
					foreach ($k as $key) {
						if($key==((!$is_edit) ? '' : $capaian_seminar->jenis_pertemuan)){
							echo '<option value="'.$key.'" selected>'.$key.'</option>';
						}else{
							echo '<option value="'.$key.'">'.$key.'</option>';
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="cs_tempat">Tempat</label>
		<div class="col-sm-12 col-md-9">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_seminar->tempat;?>" name="cs_tempat" id="cs_tempat" placeholder="Tempat"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="cs_tanggal_pertemuan">Tanggal Pertemuan</label>
		<div class="col-sm-12 col-md-9">
			<div class="input-group date">
				<div class="input-group-addon input-group-prepend">
				    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
				</div>
				<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_seminar->tanggal;?>" name="cs_tanggal_pertemuan" id="cs_tanggal_pertemuan" placeholder="Tanggal Pertemuan"   />
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="cs_judul_makalah">Judul Makalah</label>
		<div class="col-sm-12 col-md-9">
			<textarea name="cs_judul_makalah" id="cs_judul_makalah" rows="4"  class="form-control" placeholder="Judul Makalah" ><?php echo (!$is_edit) ? '' : $capaian_seminar->judul_makalah;?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="cs_status_makalah">Status Makalah</label>
		<div class="col-sm-12 col-md-9">
			<select name="cs_status_makalah" id="cs_status_makalah" class="custom-select" >
				<option value="">== Pilih ==</option>
				<?php
					$s=array('Sudah dikirim','Sedang direview','Sudah dilaksanakan');
					foreach ($s as $key) {
						if($key==((!$is_edit) ? '' : $capaian_seminar->status_makalah)){
							echo '<option value="'.$key.'" selected>'.$key.'</option>';
						}else{
							echo '<option value="'.$key.'">'.$key.'</option>';
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
 $("#capaian_seminar").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
				cs_nama_pertemuan: { required: true },
				cs_jenis_pertemuan: { required: true },
				cs_tempat: { required: true },
				cs_tanggal_pertemuan: { required: true },
				cs_judul_makalah: { required: true },
				cs_status_makalah: { required: true }
 			 },
			 messages:{
				cs_nama_pertemuan: "Nama pertemuan wajib diisi...",
 				cs_jenis_pertemuan: "Jenis pertemuan belum dipilih...",
 				cs_tempat: "Tempat pertemuan wajib diisi...",
 				cs_tanggal_pertemuan: "Tanggal pertemuan wajib diisi...",
 				cs_judul_makalah: "Judul makalah wajib diisi...",
 				cs_status_makalah: "Status makalah belum dipilih..."
			 },

		  	submitHandler: function() {
				var frm=$("#capaian_seminar");
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
								reload_data_seminar();
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
