<?php
$is_edit=(isset($slideshow));
?>
<div class="card p-3 mb-3" id="notif">
<form class="form-horizontal" role="form" name="formslideshow" id="slideshow" action="<?php echo (!$is_edit) ? site_url("slideshow/slideshow_add") : site_url("slideshow/slideshow_upd").'/'.$slideshow->id_slideshow;?>" method="post" enctype="multipart/form-data" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $slideshow->id_slideshow;?>" name="sls_id_slideshow" id="sls_id_slideshow" placeholder="id_slideshow"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="sls_nama_slide">Nama Slide</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $slideshow->judul_slide;?>" name="sls_nama_slide" id="sls_nama_slide" placeholder="Nama Slide"   />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="userfile">Gambar</label>
					<div class="col-sm-12 col-md-9">
						<input type="file" class="form-control" value="" name="userfile" id="userfile" placeholder="Gambar"  />
						<?php
							$g=(!$is_edit) ? '' : $slideshow->gambar;
							if($g!="" || $g!=NULL){
								echo '<a href="'.base_url().$g.'" data-fancybox title="'.$slideshow->judul_slide.'">';
								echo '<img src="'.base_url().$g.'" title="" width="200px" class="img-thumbnail"/>';
								echo '</a>';
							}
						?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="sls_deskripsi">Deskripsi</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="sls_deskripsi" id="sls_deskripsi"   class="form-control" placeholder="Deskripsi" ><?php echo (!$is_edit) ? '' : $slideshow->deskripsi;?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="sls_status">Status Publish</label>
					<div class="col-sm-12 col-md-9">
						<select name="sls_status" id="sls_status" class="custom-select" >
							<option value="">== Pilih Status ==</option>
							<?php $st=array('Publish','Unpublish');
							foreach ($st as $key) {
								if(((!$is_edit) ? '' : $slideshow->status)==$key){
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
					<label class="col-sm-12 col-md-3" for="sls_link">Link</label>
					<div class="col-sm-12 col-md-9">
						<div class="row">
							<div class="col-md-9 col-sm-12">
								<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $slideshow->link;?>" name="sls_link" id="sls_link" placeholder="Link"   />
							</div>
							<div class="col-md-3 col-sm-12">
								<button type="button" onclick="open_berita();" name="get_berita" id="get_berita" class="btn btn-sm btn-danger"><i class="fa fa-link"></i> Pilih Berita</button>
							</div>
						</div>
					</div>
				</div>
				<?php
				$tl=(!$is_edit) ? '' : $slideshow->target_link;
					if($tl=="_blank"){
						$bl='checked="checked"';
						$pr='';
					}else if($tl=="_parent"){
						$bl='';
						$pr='checked="checked"';
					}else{
						$bl='checked="checked"';
						$pr='';
					}
				?>
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="target1">Target Link</label>
					<div class="col-sm-12 col-md-9">
						<div class="custom-control custom-radio">
						  <input type="radio" id="target1" name="target" value="_blank" class="custom-control-input" <?php echo $bl;?>>
						  <label class="custom-control-label" for="target1">Halaman baru</label>
						</div>
						<div class="custom-control custom-radio">
						  <input type="radio" id="target2" name="target" value="_parent" class="custom-control-input" <?php echo $pr;?>>
						  <label class="custom-control-label" for="target2">Beda halaman</label>
						</div>
					</div>
				</div>

<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<button type="submit" class="btn btn-primary btn-lg col-3 mx-2"><span class="fa fa-save"></span> Simpan</button>
					<button type="reset" class="btn btn-warning btn-lg col-3 mx-2" onclick="$('#modalView').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
				</div>
			</div>
		</div>

</form>
</div>

<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
function open_berita(){
	newwindow=window.open("<?php echo site_url("berita/getlink/");?>","Ambil Link Berita",'height=550,width=760,location=0,resizable=0');
	  if (window.focus) {newwindow.focus()}
	  return false;
}
function getlink(u){
	$("#sls_link").val(u);
}

 $("#slideshow").validate({
		errorClass: "is-invalid",
		validClass: "is-valid",
		wrapper: "span",
  		rules:{
			sls_nama_slide: { required: true },
			sls_status: { required: true },
			<?php if(!$is_edit){ ;?>
			userfile: {
					required: true,
					extension: "jpg|jpeg|png|gif"
				}
			<?php };?>

			},
		messages:{
			 sls_nama_slide: "Nama slide wajib diisi...",
			 sls_status: "Status Publish wajib diisi...",
			 <?php if(!$is_edit){ ;?>
			 userfile: {
					 required:"File belum anda pilih...",
					 extension:"File yang diijinkan hanya JPG, PNG, GIF"
				 }
			<?php };?>
		 	},
	  	submitHandler: function(form) {
			var formData = new FormData(form);
			$.ajax({
				type:'POST',
				url: "<?php echo (!$is_edit) ? site_url("slideshow/slideshow_add") : site_url("slideshow/slideshow_upd").'/'.$slideshow->id_slideshow;?>",
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				beforeSend:function(data){
				   $("#ajax_loader").fadeIn(100);
				},
				success:function(data){
						var html="";
						obj = JSON.parse(data);
						if(obj.status=='OK'){
						   $("#notif").html(obj.msg);
						   reload_data();
						}else
						if(obj.status=='ERROR'){
							$("#notif").html(obj.msg);
						}
					 $("#ajax_loader").fadeOut(100);
				}
		 });
	 }
 });
</script>
