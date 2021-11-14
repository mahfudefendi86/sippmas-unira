<?php
$is_edit=(isset($kategori));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_kategori" id="search_kategori" action="<?php echo site_url("kategori/kategori_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="kg_kategori">Kategori</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $kategori->kategori;?>" name="kg_kategori" id="kg_kategori" placeholder="Kategori"   />
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

	$("#search_kategori").validate({

		
		submitHandler: function() {
			var frm=$("#search_kategori");
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