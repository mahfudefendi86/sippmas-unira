<?php
$is_edit=(isset($capaian_visiting));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formcapaian_visiting" id="capaian_visiting" action="<?php echo (!$is_edit) ? site_url("capaian_visiting/capaian_visiting_add") : site_url("capaian_visiting/capaian_visiting_upd").'/'.$capaian_visiting->id_visit_scientist;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_visiting->id_visit_scientist;?>" name="cv_id_visit" id="cv_id_visit" placeholder="id_visit"   /><input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_visiting->id_penelitian;?>" name="cv_id_penelitian" id="cv_id_penelitian" placeholder="id_penelitian"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cv_skala_kegiatan">Skala Kegiatan</label>
					<div class="col-sm-12 col-md-9">
						<select name="cv_skala_kegiatan" id="cv_skala_kegiatan" class="custom-select" >
	<option value="<?php echo (!$is_edit) ? '' : $capaian_visiting->skala_kegiatan;?>" selected><?php echo (!$is_edit) ? '' : $capaian_visiting->skala_kegiatan;?></option>
						</select>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cv_nama_pt">Nama PT</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_visiting->nama_perguruan_tinggi;?>" name="cv_nama_pt" id="cv_nama_pt" placeholder="Nama PT"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cv_lama_kagiatan">Lama Kagiatan</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_visiting->lama_kegiatan;?>" name="cv_lama_kagiatan" id="cv_lama_kagiatan" placeholder="Lama Kagiatan"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cv_kegiatan">Kegiatan</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="cv_kegiatan" id="cv_kegiatan"   class="form-control" placeholder="Kegiatan" ><?php echo (!$is_edit) ? '' : $capaian_visiting->kegiatan_yg_dilakukan;?></textarea>
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
 $("#capaian_visiting").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
			cv_skala_kegiatan: { required: true },
			cv_nama_pt: { required: true },
			cv_lama_kagiatan: { required: true },
			cv_kegiatan: { required: true }
 			 },

		  	submitHandler: function() {
				var frm=$("#capaian_visiting");
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