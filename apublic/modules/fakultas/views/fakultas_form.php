<?php
$is_edit=(isset($fakultas));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formfakultas" id="fakultas" action="<?php echo (!$is_edit) ? site_url("fakultas/fakultas_add") : site_url("fakultas/fakultas_upd").'/'.$fakultas->id_fakultas;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $fakultas->id_fakultas;?>" name="fk_" id="fk_" placeholder="id_fakultas"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="fk_nama_fakultas">Nama Fakultas</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="fk_nama_fakultas" id="fk_nama_fakultas"   class="form-control" placeholder="Nama Fakultas" ><?php echo (!$is_edit) ? '' : $fakultas->nama_fakultas;?></textarea>
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
			 $("#fakultas").validate({
			 		errorClass: "is-invalid",
					validClass: "is-valid",
					wrapper: "span",
				  rules:{
			fk_nama_fakultas: { required: true }
 			 },

				  submitHandler: function() {
					var frm=$("#fakultas");
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