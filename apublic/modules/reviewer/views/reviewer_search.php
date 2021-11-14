<?php
$is_edit=(isset($peneliti));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_peneliti" id="search_peneliti" action="<?php echo site_url("reviewer/reviewer_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="pnl_nama_lengkap">Nama Lengkap</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->nama;?>" name="pnl_nama_lengkap" id="pnl_nama_lengkap" placeholder="Nama Lengkap"   />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="pnl_nidn">NIDN</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->nidn;?>" name="pnl_nidn" id="pnl_nidn" placeholder="NIDN"   />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="pnl_fakultas">Fakultas </label>
					<div class="col-sm-12 col-md-9">
						<select name="pnl_fakultas" id="pnl_fakultas" class="custom-select" >
						<option value="">== Pilih ==</option>
			            	<?php
								if(isset($fakultas)){
									foreach($fakultas as $data_id_fakultas){
										if($data_id_fakultas->id_fakultas==((!$is_edit) ? '' : $peneliti->fakultas)){
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
					<label class="col-sm-12 col-md-3" for="pnl_program_studi">Program Studi</label>
					<div class="col-sm-12 col-md-9">
						<select name="pnl_program_studi" id="pnl_program_studi" class="custom-select" >
						<option value="">== Pilih ==</option>
			            	<?php
								if(isset($prodi)){
									foreach($prodi as $data_prodi){
										if($data_prodi->id_prodi==((!$is_edit) ? '' : $peneliti->prodi)){
											echo '<option value="'.$data_prodi->id_prodi.'" selected>'.$data_prodi->nama_prodi.'</option>';
										}else{
											echo '<option value="'.$data_prodi->id_prodi.'" >'.$data_prodi->nama_prodi.'</option>';
										}
									}
								}else{
									echo '<option value="" onclick="$(this).val(\'\');">[ Pilih Fakultas Dahulu]</option>';
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="pnl_alamat">Alamat</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="pnl_alamat" id="pnl_alamat"   class="form-control" placeholder="Alamat" ><?php echo (!$is_edit) ? '' : $peneliti->alamat;?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="pnl_email">Email</label>
					<div class="col-sm-12 col-md-9">
						<input type="email" class="form-control" value="<?php echo (!$is_edit) ? '' : $peneliti->email;?>" name="pnl_email" id="pnl_email" placeholder="Email"    />
					</div>
				</div>

<p class="text-muted text-bold"><strong>Keterangan:</strong> Untuk mencari data yang lebih spesifik, gunakan beberapa kolom/field pencarian.</p>
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

	 $("#search_peneliti").validate({


		  submitHandler: function() {
			var frm=$("#search_peneliti");
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


$("#pnl_fakultas").change(function(){
   var id=$(this).val();
   if(id==""){
	   $("#pnl_program_studi").html('<option value=""> == Pilih ==</option>');
	   return false;
   }
   $.ajax({
	   url       : "<?php echo site_url('prodi/select_prodi');?>",
	   type      : "POST",
	   dataType  : "html",
	   data      : "idfak="+id,
	   beforeSend: function(){
			   ///Event sebelum/proses data dikirim
			   $("#ajax_loader").fadeIn(100);
	   },
	   success   : function(data){
			   var html='<option value="">== Pilih Program Studi ==</option>';
			   $("#ajax_loader").fadeOut(100);
			   obj = JSON.parse(data);
			   if(obj.status=='200'){
				   $.each( obj.data, function( key, value ) {
					   html = html + '<option value="'+value.id_prodi+'">'+value.nama_prodi+'</option>';
				   });
			   }else
			   if(obj.status=='401'){
				   html = html + '<option value="">Maaf tidak ada data...</option>';
			   }else{
				   html = html + '<option value="">Maaf tidak ada data...</option>';
			   }
			   $("#pnl_program_studi").html(html);
	   }
   });///end Of Ajax
});
</script>
