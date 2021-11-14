<?php
$is_edit=(isset($capaian_invitasi));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formcapaian_invitasi" id="capaian_invitasi" action="<?php echo (!$is_edit) ? site_url("capaian_invitasi/capaian_invitasi_add") : site_url("capaian_invitasi/capaian_invitasi_upd").'/'.$capaian_invitasi->id_inv_speaker;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_invitasi->id_inv_speaker;?>" name="ci_id_invitasi" id="ci_id_invitasi" placeholder="id_invitasi"   /><input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_invitasi->id_penelitian;?>" name="ci_id_penelitian" id="ci_id_penelitian" placeholder="id_penelitian"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="ci_skala_kegiatan">Skala Kegiatan</label>
					<div class="col-sm-12 col-md-9">
						<select name="ci_skala_kegiatan" id="ci_skala_kegiatan" class="custom-select" >
	<option value="<?php echo (!$is_edit) ? '' : $capaian_invitasi->skala_kegiatan;?>" selected><?php echo (!$is_edit) ? '' : $capaian_invitasi->skala_kegiatan;?></option>
						</select>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="ci_judul_makalah">Judul Makalah</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="ci_judul_makalah" id="ci_judul_makalah"   class="form-control" placeholder="Judul Makalah" ><?php echo (!$is_edit) ? '' : $capaian_invitasi->judul_makalah;?></textarea>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="ci_penulis">Penulis</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_invitasi->penulis;?>" name="ci_penulis" id="ci_penulis" placeholder="Penulis"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="ci_penyelanggara">Penyelanggara</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_invitasi->penyelenggara;?>" name="ci_penyelanggara" id="ci_penyelanggara" placeholder="Penyelanggara"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="ci_tempat">Tempat</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_invitasi->tempat;?>" name="ci_tempat" id="ci_tempat" placeholder="Tempat"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="ci_tanggal">Tanggal</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_invitasi->tanggal;?>" name="ci_tanggal" id="ci_tanggal" placeholder="Tanggal"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="ci_status_makalah">Status Makalah</label>
					<div class="col-sm-12 col-md-9">
						<select name="ci_status_makalah" id="ci_status_makalah" class="custom-select" >
	<option value="<?php echo (!$is_edit) ? '' : $capaian_invitasi->status_makalah;?>" selected><?php echo (!$is_edit) ? '' : $capaian_invitasi->status_makalah;?></option>
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
 $("#capaian_invitasi").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
			ci_skala_kegiatan: { required: true },
			ci_judul_makalah: { required: true },
			ci_tempat: { required: true },
			ci_tanggal: { required: true },
			ci_status_makalah: { required: true }
 			 },

		  	submitHandler: function() {
				var frm=$("#capaian_invitasi");
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