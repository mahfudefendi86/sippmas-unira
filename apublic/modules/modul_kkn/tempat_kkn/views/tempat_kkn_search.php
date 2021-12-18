<?php
$is_edit=(isset($tempat_kkn));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_tempat_kkn" id="search_tempat_kkn" action="<?php echo site_url("tempat_kkn/tempat_kkn_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="tp__nama_tempat_kkn">Nama Tempat KKN</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $tempat_kkn->nama_tempat;?>" name="tp__nama_tempat_kkn" id="tp__nama_tempat_kkn" placeholder="Nama Tempat KKN"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="tp__alamat_kkn">Alamat KKN</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<textarea name="tp__alamat_kkn" id="tp__alamat_kkn"   class="form-control" placeholder="Alamat KKN" ><?php echo (!$is_edit) ? '' : $tempat_kkn->alamat;?></textarea>
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
	$("#search_tempat_kkn").validate({
		
		submitHandler: function() {
			var frm=$("#search_tempat_kkn");
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