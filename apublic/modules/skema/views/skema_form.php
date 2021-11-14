<?php
$is_edit=(isset($skema));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formskema" id="skema" action="<?php echo (!$is_edit) ? site_url("skema/skema_add") : site_url("skema/skema_upd").'/'.$skema->id_skema;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $skema->id_skema;?>" name="skm_id_skema" id="skm_id_skema" placeholder="id_skema"   />
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="skm_jenis_skema">Jenis Skema</label>
		<div class="col-sm-12 col-md-9">
			<select name="skm_jenis_skema" id="skm_jenis_skema" class="custom-select" >
				<?php $jk=array('PENELITIAN','PENGABDIAN');
					foreach ($jk as $key) {
						if($key==((!$is_edit) ? '' : $skema->jenis_skema)){
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
		<label class="col-sm-12 col-md-3" for="skm_nama_skema">Nama Skema</label>
		<div class="col-sm-12 col-md-9">
			<textarea class="form-control" row="5" name="skm_nama_skema" id="skm_nama_skema" placeholder="Nama Skema" ><?php echo (!$is_edit) ? '' : $skema->nama_skema;?></textarea>
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
	 $("#skema").validate({
	 		errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
		  rules:{
			skm_jenis_skema: { required: true },
			skm_nama_skema: { required: true }
 			 },

		  submitHandler: function() {
			var frm=$("#skema");
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
