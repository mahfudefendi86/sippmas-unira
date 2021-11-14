<?php
$is_edit=(isset($skema));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_skema" id="search_skema" action="<?php echo site_url("skema/skema_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="skm_jenis_skema">Jenis Skema</label>
					<div class="col-sm-12 col-md-9">
						<select name="skm_jenis_skema" id="skm_jenis_skema" class="custom-select" >
							<option value="">== PILIH ==</option>
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
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $skema->nama_skema;?>" name="skm_nama_skema" id="skm_nama_skema" placeholder="Nama Skema"   />
					</div>
				</div>

<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<button type="submit" class="btn btn-primary btn-lg col-3 mx-2"><span class="fa fa-save"></span> Cari Data</button>
					<button type="reset" class="btn btn-warning btn-lg col-3 mx-2" onclick="$('#modalView').hide();"><span class="fa fa-refresh"></span> Batal</button>
				</div>
			</div>
		</div>

</form>
</div>

		<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function(){

			 $("#search_skema").validate({


				  submitHandler: function() {
					var frm=$("#search_skema");
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
								$("#dataview").html(data);
								$("#modalView").modal("hide");
								$("#ajax_loader").fadeOut(100);
						}
					});///end Of Ajax
				 }
			 });

		});
		</script>
