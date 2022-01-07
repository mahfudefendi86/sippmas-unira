<?php
$is_edit=(isset($plotting_kkn));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_plotting_kkn" id="search_plotting_kkn" action="<?php echo site_url("plotting_kkn/plotting_kkn_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="pt__nama_kelompok">Nama Kelompok</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<select name="pt__nama_kelompok" id="pt__nama_kelompok" class="custom-select" >
						<option value="">== Pilih Nama Kelompok ==</option>
		                    	<?php
									if(isset($kelompok)){
										foreach($kelompok as $data_kelompok){
											if($data_kelompok->id_kelompok==((!$is_edit) ? '' : $plotting_kkn->kelompok)){
												echo '<option value="'.$data_kelompok->id_kelompok.'" selected>'.$data_kelompok->nama_kelompok.'</option>';
											}else{
												echo '<option value="'.$data_kelompok->id_kelompok.'" >'.$data_kelompok->nama_kelompok.'</option>';
											}
										}
									}
								?>						
						</select>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="pt__anggota_kelompok">Anggota Kelompok</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<select name="pt__anggota_kelompok" id="pt__anggota_kelompok" class="custom-select" >
						<option value="">== Pilih Anggota Kelompok ==</option>
		                    	<?php
									if(isset($anggota)){
										foreach($anggota as $data_anggota){
											if($data_anggota->userid==((!$is_edit) ? '' : $plotting_kkn->anggota)){
												echo '<option value="'.$data_anggota->userid.'" selected>'.$data_anggota->nama.'</option>';
											}else{
												echo '<option value="'.$data_anggota->userid.'" >'.$data_anggota->nama.'</option>';
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
	$("#search_plotting_kkn").validate({
		
		submitHandler: function() {
			var frm=$("#search_plotting_kkn");
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