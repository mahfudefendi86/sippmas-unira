<?php
$is_edit=(isset($capaian_lain));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formcapaian_lain" id="capaian_lain" action="<?php echo (!$is_edit) ? site_url("capaian_lain/capaian_lain_add") : site_url("capaian_lain/capaian_lain_upd").'/'.$capaian_lain->id_lain;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_lain->id_lain;?>" name="cl_id_lain" id="cl_id_lain" placeholder="id_lain"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? $id_penelitian : $capaian_lain->id_penelitian;?>" name="cl_id_penelitian" id="cl_id_penelitian" placeholder="id_penelitian"   />
		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="cl_jenis_luaran">Jenis Luaran</label>
			<div class="col-sm-12 col-md-9">
				<select name="cl_jenis_luaran" id="cl_jenis_luaran" class="custom-select" >
					<option value="">== Pilih Jenis Luaran ==</option>
					<?php
						$js=array('Hak kekayaan intelektual','Teknologi Tepat Guna','Rekayasa Sosial','Jejaring Kerjasama','Penghargaan','Jenis luaran lainnya');
						foreach ($js as $key) {
							if($key==($capaian_lain->jenis_luaran)){
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
			<label class="col-sm-12 col-md-3" for="cl_uraian">Uraian</label>
			<div class="col-sm-12 col-md-9">
				<textarea name="cl_uraian" id="cl_uraian" rows="5" class="form-control" placeholder="Uraian" ><?php echo (!$is_edit) ? '' : $capaian_lain->urain;?></textarea>
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
 $("#capaian_lain").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
			cl_jenis_luaran: { required: true },
			cl_uraian: { required: true }
 			 },

		  	submitHandler: function() {
				var frm=$("#capaian_lain");
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
								reload_data_lainnya();
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
