<?php
$is_edit=(isset($kelompok_kkn));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_kelompok_kkn" id="search_kelompok_kkn" action="<?php echo site_url("kelompok_kkn/kelompok_kkn_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="klp__tempat_kkn">Tempat KKN</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<select name="klp__tempat_kkn" id="klp__tempat_kkn" class="custom-select" >
						<option value="">== Pilih Tempat KKN ==</option>
		                    	<?php
									if(isset($id_tempat)){
										foreach($id_tempat as $data_id_tempat){
											if($data_id_tempat->id_tempat==((!$is_edit) ? '' : $kelompok_kkn->id_tempat)){
												echo '<option value="'.$data_id_tempat->id_tempat.'" selected>'.$data_id_tempat->nama_tempat.'</option>';
											}else{
												echo '<option value="'.$data_id_tempat->id_tempat.'" >'.$data_id_tempat->nama_tempat.'</option>';
											}
										}
									}
								?>						
						</select>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="klp__nama_kelompok_kkn">Nama Kelompok KKN</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $kelompok_kkn->nama_kelompok;?>" name="klp__nama_kelompok_kkn" id="klp__nama_kelompok_kkn" placeholder="Nama Kelompok KKN"   />
					</div>
				</div>
			
<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<div class="col-md-4 col-lg-4 col-sm-12 m-1">
						<button type="submit" class="btn btn-primary btn-lg col-12"><span class="fa fa-search"></span> Cari Data</button>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 m-1">
						<button type="reset"  class="btn btn-warning btn-lg col-12" onclick="$('#modalView').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
					</div>
				</div>
			</div>
		</div>

</form>
</div>

<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#search_kelompok_kkn").validate({
		
		submitHandler: function() {
			var frm=$("#search_kelompok_kkn");
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