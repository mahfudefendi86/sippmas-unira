<?php
$is_edit=(isset($status_aktif));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_status_aktif" id="search_status_aktif" action="<?php echo site_url("status_aktif/status_aktif_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="sa_nama_author">Nama Author</label>
					<div class="col-sm-12 col-md-9">
						<select name="sa_nama_author" id="sa_nama_author" class="custom-select" >
						<option value="">== Pilih ==</option>
                        	<?php
								if(isset($id_peneliti)){
									foreach($id_peneliti as $data_id_peneliti){
										if($data_id_peneliti->id_user==((!$is_edit) ? '' : $status_aktif->id_peneliti)){
											echo '<option value="'.$data_id_peneliti->id_user.'" selected>'.$data_id_peneliti->nama.'</option>';
										}else{
											echo '<option value="'.$data_id_peneliti->id_user.'" >'.$data_id_peneliti->nama.'</option>';
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

	$("#search_status_aktif").validate({

		
		submitHandler: function() {
			var frm=$("#search_status_aktif");
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