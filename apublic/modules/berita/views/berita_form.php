<?php
$is_edit=(isset($berita));
?>
<h2 class="text-primary p-0"><?php echo $title;?></h2>
<form role="form" name="formberita" id="formberita" action="<?php echo (!$is_edit) ? site_url("berita/berita_add") : site_url("berita/berita_upd").'/'.$berita->id_berita;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $berita->id_berita;?>" name="brt_id_berita" id="brt_id_berita" placeholder="id_berita"   />
<div class="row">
	<div class="col-sm-12 col-md-9 p-1">
		<div class="card mb-3 px-1 py-2">
			<!-- <div class="form-group row">
				<label class="col-sm-12" for="brt_tanggal">Tanggal</label>
				<div class="col-sm-12 col-md-12">
					<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $berita->tanggal;?>" name="brt_tanggal" id="brt_tanggal" placeholder="Tanggal"   />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-12" for="brt_jam">Jam</label>
				<div class="col-sm-12 col-md-12">
					<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $berita->jam;?>" name="brt_jam" id="brt_jam" placeholder="Jam"   />
				</div>
			</div> -->

			<div class="form-group">
				<label class="col-sm-12" for="brt_judul">Judul Berita</label>
				<div class="col-sm-12 col-md-12">
					<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $berita->judul;?>" name="brt_judul" id="brt_judul" placeholder="Judul"   />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-12" for="brt_isi_berita">Isi Berita</label>
				<div class="col-sm-12 col-md-12">
					<textarea name="brt_isi_berita" id="brt_isi_berita"   class="form-control" placeholder="Isi Berita" ><?php echo (!$is_edit) ? '' : $berita->isi_berita;?></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-3 p-1">
		<div class="card px-1 py-2">
			<div class="form-group">
				<label class="col-sm-12" for="brt_kategori_berita">Kategori Berita</label>
				<div class="col-sm-12 col-md-12">
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
			<div class="form-group">
				<label class="col-sm-12" for="brt_status">Status</label>
				<div class="col-sm-12 col-md-12">
					<select name="brt_status" id="brt_status" class="custom-select" >
						<?php
						$st=array('PUBLISH','UNPUBLISH');
						foreach ($st as $value) {
							if(((!$is_edit) ? '' : $berita->status)==$value){
								echo '<option value="'.$value.'" selected>'.$value.'</option>';
							}else{
								echo '<option value="'.$value.'">'.$value.'</option>';
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<hr/>
<div class="form-group row">
	<div class="col-sm-12 col-md-12">
		<div class="row justify-content-md-center">
			<button type="submit" class="btn btn-primary btn-lg col-3 mx-2"><span class="fa fa-save"></span> Simpan</button>
			<button type="reset" class="btn btn-warning btn-lg col-3 mx-2" onclick="window.history.back()"><span class="fa fa-chevron-left"></span> Batal</button>
		</div>
	</div>
</div>
</form>
<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $("#formberita").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
				brt_kategori_berita: { required: true },
				brt_judul: { required: true },
				brt_status: { required: true }
 			 },

		  	submitHandler: function() {
				tinyMCE.triggerSave();
				return true;
		 }
	 });
</script>
<!-- Loading TinyMCE-->
<script src="<?php echo base_url();?>asset/addon/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
tinymce.init({
  selector: '#brt_isi_berita',
  height: 300,
  theme: 'modern',
  plugins: [
		'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code textcolor colorpicker'
  ],
	toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist forecolor backcolor | link image'
 });

</script>
