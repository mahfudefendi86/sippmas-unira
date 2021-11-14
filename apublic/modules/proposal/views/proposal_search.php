<?php
$is_edit=(isset($proposal));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_proposal" id="search_proposal" action="<?php echo site_url("proposal/proposal_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="prp_id_penelitian">id_penelitian</label>
					<div class="col-sm-12 col-md-9">
						<select name="prp_id_penelitian" id="prp_id_penelitian" class="custom-select" >
						<option value="">== Pilih ==</option>
                        	<?php
								if(isset($id_penelitian)){
									foreach($id_penelitian as $data_id_penelitian){
										if($data_id_penelitian->id_penelitian==((!$is_edit) ? '' : $proposal->id_penelitian)){
											echo '<option value="'.$data_id_penelitian->id_penelitian.'" selected>'.$data_id_penelitian->judul_penelitian.'</option>';
										}else{
											echo '<option value="'.$data_id_penelitian->id_penelitian.'" >'.$data_id_penelitian->judul_penelitian.'</option>';
										}
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

	$("#search_proposal").validate({

		
		submitHandler: function() {
			var frm=$("#search_proposal");
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