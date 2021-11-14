<?php
$is_edit=(isset($peneliti));
if($is_edit){
?>
<h2 class="text-primary"><strong>Upload Foto</strong></h2>
<form class="uk-form uk-form-stacked" name="imageUploadForm" id="imageUploadForm" action="<?php echo site_url("peneliti/save_foto");?>" method="post" enctype="multipart/form-data" >
<input type="hidden" class="uk-width-medium-1-1" value="<?php echo (!$is_edit) ? '' : $peneliti->id_user;?>" name="id_user" id="id_user" placeholder="id_user"   />
<table class="table table-striped table-sm">
	<tr>
		<th width="20%">Nama Author</th>
		<td>: <span class="uk-text-danger uk-text-large"><?php echo $peneliti->nama;?></span></td>
	</tr>
	<tr>
		<th width="20%">NIDN/NIP</th>
		<td>: <?php echo $peneliti->nidn;?></td>
	</tr>
	<tr>
		<th width="20%">Program Studi</th>
		<td>: <?php echo $peneliti->nama_prodi?></td>
	</tr>
	<tr>
		<th width="20%">Tempat, Tanggal Lahir</th>
		<td>: <?php echo $peneliti->tempat_lahir.', '.tgl_indo($peneliti->tgl_lahir);?></td>
	</tr>
	<tr>
		<th width="20%">Alamat</th>
		<td>: <?php echo $peneliti->alamat.' - '.$peneliti->nama_desa.' - '.$peneliti->nama_kecamatan.' - '.$peneliti->nama_kota?></td>
	</tr>
</table>
<div id="notif"></div>
<div class="card mb-3">
	<div class="card-body">
		<div id="spinner" style="text-align:center;display:none;"><i class="fa fa-spinner fa-4x"></i></div>
		<div id="foto_view"  style="text-align:center">
		<?php if($peneliti->foto=="" || $peneliti->foto==NULL){
			echo '<img src="'.base_url().'asset/images/no-image.png" class="img-thumbnail" width="200px" />';
		}else{
		?>
			<?php
			$sumber="";
			$j=$peneliti->foto;
			$sumber=base_url().$j;?>
			<a href="<?php echo $sumber;?>" data-fancybox title="<?php echo $peneliti->nama;?>">
			<img class="img-thumbnail" src="<?php echo base_url().$peneliti->foto_thumb;?>" align="absmiddle" alt="Foto" title="Foto" width="200px" /></a>
			<br/>
			<button type="button" name="hapus" class="btn btn-danger btn-sm mt-2"  onclick="hapus_foto('<?php echo $peneliti->id_user;?>');"><i class="fa fa-remove"></i> Hapus</button>
		<?php }; ?>
		</div>
	</div>
</div>
<div class="alert alert-success">
	<span class="text-success">Gambar yang diijinkan Jpg atau Png dengan Ukuran File maksimal 1000 Kb</span>
	<div class="custom-file">
	  <input type="file" class="custom-file-input" id="ImageBrowse" name="userfile" id="userfile" >
	  <label class="custom-file-label" for="customFile" id="label_file">Pilih file</label>
	</div>
</div>

		<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<!-- <button type="submit" class="btn btn-primary btn-lg col-3 mx-2"><span class="fa fa-cloud-upload"></span> Upload Foto</button> -->
					<button type="reset" class="btn btn-warning btn-lg col-3 mx-2" onclick="window.history.back();"><span class="fa fa-chevron-left"></span> Kembali</button>
				</div>
			</div>
		</div>

</form>

<style>
#spinner {
	position: absolute;
	top: 50%;
	left: 50%;
	width: 120px;
	margin:-60px 0 0 -60px;
	-webkit-animation:spin 2s linear infinite;
	-moz-animation:spin 2s linear infinite;
	animation:spin 2s linear infinite;
}
@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
</style>
<!--  LOADING FANCYBOX-->
<script src="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.js"></script>
<link href="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.css" rel="stylesheet" />
<!-- END FABCYBOX -->
<script>
$(document).ready(function (e) {

    $('#imageUploadForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
			beforeSend:function(data){
               $("#spinner").fadeIn(100);
            },
            success:function(data){
					var html="";
      				obj = JSON.parse(data);
      				if(obj.status=='OK'){
						html=html+'<a href="<?php echo base_url();?>'+obj.img+'" data-fancybox title="<?php echo addslashes($peneliti->nama);?>">';
      				 	html=html+'<img class="img-thumbnail" src="<?php echo base_url();?>/'+obj.img+'" align="absmiddle" alt="Foto" title="Foto" width="200px"  /></a><br/>';
						html=html+'<button type="button" name="hapus" class="btn btn-sm btn-danger mt-2" onclick="hapus_foto(\'<?php echo $peneliti->id_user;?>\');"><i class="fa fa-remove"></i> Hapus</button>';
					   $("#foto_view").html(html).fadeIn(100);
					   $("#userfile").val('');
					   $("#notif").html(obj.msg);
      				}else
      				if(obj.status=='ERROR'){
						$("#notif").html(obj.msg);
      					$("#userfile").val('');
      				}
                 $("#spinner").fadeOut(100);
            }
        });
    }));

	$('input[type="file"]').change(function(){
		 $('#imageUploadForm').submit();
	 });


});

function hapus_foto(id){
	var r=confirm("Apakah anda yakin akan menghapus data ini ?");
		if(r==true){
			$.ajax({
				url       : "<?php echo site_url('peneliti/foto_upload_remove');?>",
				type	  : "POST",
				data      : "id="+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#spinner").fadeIn(100);
				},
				success   : function(data){
							obj = JSON.parse(data);
							if(obj.status=='OK'){
								$("#notif").html(obj.msg);
								$("#foto_view").html('<img class="img-thumbnail" src="'+obj.img+'" align="absmiddle" alt="Foto" title="Foto" width="200px"  />').fadeIn(100);
							}else
							if(obj.status=='ERROR'){
								$("#notif").html(obj.msg);
							}
							$("#spinner").fadeOut(100);
				}
			}); //end Of Ajax
		}
};
</script>

<?php
}else{
	echo '<h1>Maaf, data tidak ditemukan...!!</h1>';
} ?>
