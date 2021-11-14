<?php
$is_edit=(isset($catatan));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formcatatan" id="catatan" action="<?php echo (!$is_edit) ? site_url("catatan/catatan_add") : site_url("catatan/catatan_upd").'/'.$catatan->id_catatan;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $catatan->id_catatan;?>" name="ctn_id_catatan" id="ctn_id_catatan" placeholder="id_catatan"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? $id_penelitian : $catatan->id_penelitian;?>" name="ctn_id_penelitian" id="ctn_id_penelitian" placeholder="id_penelitian"   />
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="ctn_tanggal">Tanggal</label>
		<div class="col-sm-12 col-md-9">
			<div class="input-group date">
				<div class="input-group-addon input-group-prepend">
				    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
				</div>
				<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $catatan->tgl;?>" name="ctn_tanggal" id="ctn_tanggal" placeholder="Tanggal"   />
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="ctn_uarain_kegiatan">Uarain Kegiatan</label>
		<div class="col-sm-12 col-md-9">
			<textarea type="text" class="form-control" name="ctn_uarain_kegiatan" id="ctn_uarain_kegiatan" placeholder="Uarain Kegiatan" ><?php echo (!$is_edit) ? '' : $catatan->uraian;?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="ctn_persentase_kegiatan">Persentase Kegiatan</label>
		<div class="col-sm-12 col-md-9">
			<input type="number" min="0" max="100" class="form-control" value="<?php echo (!$is_edit) ? '' : $catatan->persentase;?>" name="ctn_persentase_kegiatan" id="ctn_persentase_kegiatan" placeholder="%"   />
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
 $("#catatan").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
			ctn_tanggal: { required: true },
			ctn_uarain_kegiatan: { required: true },
			ctn_persentase_kegiatan: { required: true }
 			 },

		  	submitHandler: function() {
				var frm=$("#catatan");
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
