<?php
$is_edit=(isset($prodi));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formprodi" id="prodi" action="<?php echo (!$is_edit) ? site_url("prodi/prodi_add") : site_url("prodi/prodi_upd").'/'.$prodi->id_prodi;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $prodi->id_prodi;?>" name="pr_" id="pr_" placeholder="id_prodi"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="pr_pilih_fakultas">Pilih Fakultas</label>
					<div class="col-sm-12 col-md-9">
						<select name="pr_pilih_fakultas" id="pr_pilih_fakultas" class="custom-select" >
						<option value="">== Pilih ==</option>
                        	<?php
								if(isset($id_fakultas)){
									foreach($id_fakultas as $data_id_fakultas){
										if($data_id_fakultas->id_fakultas==((!$is_edit) ? '' : $prodi->id_fakultas)){
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
					<label class="col-sm-12 col-md-3" for="pr_nama_program_studi">Nama Program Studi</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="pr_nama_program_studi" id="pr_nama_program_studi"   class="form-control" placeholder="Nama Program Studi" ><?php echo (!$is_edit) ? '' : $prodi->nama_prodi;?></textarea>
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
			 $("#prodi").validate({
			 		errorClass: "is-invalid",
					validClass: "is-valid",
					wrapper: "span",
				  rules:{
			pr_pilih_fakultas: { required: true },
			pr_nama_program_studi: { required: true }
 			 },

				  submitHandler: function() {
					var frm=$("#prodi");
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