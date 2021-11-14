<?php
$is_edit=(isset($berita));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_berita" id="search_berita" action="<?php echo site_url("berita/berita_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="brt_kategori_berita">Kategori Berita</label>
					<div class="col-sm-12 col-md-9">
						<select name="brt_kategori_berita" id="brt_kategori_berita" class="custom-select" >
						<option value="">== Pilih ==</option>
                        	<?php
								if(isset($id_kategori)){
									foreach($id_kategori as $data_id_kategori){
										if($data_id_kategori->id_kategori==((!$is_edit) ? '' : $berita->id_kategori)){
											echo '<option value="'.$data_id_kategori->id_kategori.'" selected>'.$data_id_kategori->kategori.'</option>';
										}else{
											echo '<option value="'.$data_id_kategori->id_kategori.'" >'.$data_id_kategori->kategori.'</option>';
										}
									}
								}
							?>
						</select>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="brt_tanggal">Tanggal</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $berita->tanggal;?>" name="brt_tanggal" id="brt_tanggal" placeholder="Tanggal"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="brt_judul">Judul</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $berita->judul;?>" name="brt_judul" id="brt_judul" placeholder="Judul"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="brt_status">Status</label>
					<div class="col-sm-12 col-md-9">
						<select name="brt_status" id="brt_status" class="custom-select" >
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

	$("#search_berita").validate({

		
		submitHandler: function() {
			var frm=$("#search_berita");
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