<?php
$is_edit=(isset($penelitian));
if($is_edit){
?>
<h3 class="text-primary"><?php echo isset($title)?$title:"Unggah SK Persetujuan Hibah Internal";?></h3>
<div class="p-3 mb-3">

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="status">Status <span class="float-md-right"> :</span></label>
		<div class="col-sm-11 col-md-10">
			<span class="badge badge-primary h4"><?php echo (!$is_edit) ? '' : $penelitian->status_pengajuan;?></span>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_pengusul">Ketua/Pengusul <span class="float-md-right"> :</span></label>
		<div class="col-sm-11 col-md-9 text-muted">
			<strong><?php echo $penelitian->nama_lookup;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_tahun_anggaran">Tahun Anggaran<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 text-muted">
			<?php echo $penelitian->tahun_anggaran_lookup;?>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_judul_penelitian">Judul <?php echo (!$is_edit) ? '' : ucfirst(strtolower($penelitian->jenis_usulan));?><span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10">
			<span class="text-muted"><strong><?php echo (!$is_edit) ? '' : $penelitian->judul_penelitian;?></strong></span>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="reviewer1">Reviewer 1<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10">
            <div class="row">
                <div class="col"><strong><?php echo (!$is_edit) ? '' : $penelitian->nama_reviewer1;?></strong></div>
                <div class="col">Perolehan nilai: <span class="text-danger font-weight-bold h5"><?php echo (!$is_edit) ? '' : $penelitian->total_nilai_rviewer1;?></span></div>
            </div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="reviewer2">Reviewer 2<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10">
            <div class="row">
                <div class="col"><strong><?php echo (!$is_edit) ? '' : $penelitian->nama_reviewer2;?></strong></div>
                <div class="col">Perolehan nilai: <span class="text-danger font-weight-bold h5"><?php echo (!$is_edit) ? '' : $penelitian->total_nilai_rviewer2;?></span></div>
            </div>
        </div>
	</div>
    <div class="card">
        <div class="card-body">
            <div id="notif"></div>
            <form class="form-horizontal" role="form" name="form_upload_sk" id="form_upload_sk" action="<?php echo site_url("penelitian/save_upload_sk");?>" method="post" enctype="multipart/form-data" >
            <input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $penelitian->id_penelitian;?>" name="pnl_id_penelitian" id="pnl_id_penelitian" placeholder="id_penelitian"   />
            <div class="form-group row">
        		<label class="col-sm-12 col-md-2" for="userfile">Pilih file SK<span class="float-md-right"> :</span></label>
        		<div class="col-sm-12 col-md-10">
					<?php if($this->session->userdata('akses')!="PENELITI"){;?>
	                    <div class="custom-file">
	                	  <input type="file" class="custom-file-input" name="userfile" id="userfile" >
	                	  <label class="custom-file-label" for="customFile" id="label_file">Pilih file</label>
	                	</div>
					<?php };?>
                    <?php
                        if(((!$is_edit) ? "" : $penelitian->sk_persetujuan)!=""){
                            $f=get_file_info($penelitian->sk_persetujuan);
                            $kap=($f['size']/1000);
                            echo '<div class="col-md-7 col-lg-5 col-sm-12 p-0">
                                <div class="card mt-2">
                                    <div class="card-header">
                                    Berkas Surat Keputusan (SK)
                                    </div>
                                    <div class="card-body mb-0">
                                        <div>Nama file: &nbsp;<span class="text-primary">'.$f['name'].'</span></div><div>Kapasitas file: &nbsp;<span class="text-primary">'.number_format((float)$kap, 2, '.', '').' Kb</span></div>
                                    </div>
                                    <div class="card-footer p-1 m-0">
                                        <a style="width:100%;" target="_blank" class="btn btn-light btn-sm rounded-top" href="'.site_url("penelitian/unduh_file_sk/".$penelitian->id_penelitian).'" alt="Download SK"><i class="fa fa-cloud-download"></i> Unduh SK</a>
                                    </div>
                                </div>
                            </div>';
                        }
                    ?>
                </div>
        	</div>
            <div class="form-group row">
        		<label class="col-sm-12 col-md-2" for="pnl_dana_disetujui">Dana disetujui<span class="float-md-right"> :</span></label>
        		<div class="col-sm-12 col-md-10">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Rp.</div>
                        </div>
                        <input type="text" class="form-control" name="pnl_dana_disetujui" id="pnl_dana_disetujui" value="<?php echo (!$is_edit) ? '' : $penelitian->dana_disetujui;?>" />
                      </div>
        		</div>
        	</div>
            <div class="form-group row">
        		<label class="col-sm-12 col-md-2" for="status_update">Update status <span class="float-md-right"> :</span></label>
        		<div class="col-sm-12 col-md-10">
                    <select name="status_update" id="status_update" class="custom-select" >
        			<option value="">== Pilih ==</option>
        	        	<?php
                        $st=array('DISETUJUI','DITOLAK','REVISI');
						foreach($st as $drev){
							if($drev==((!$is_edit) ? '' : $penelitian->status_pengajuan)){
								echo '<option value="'.$drev.'" selected>'.$drev.'</option>';
							}else{
								echo '<option value="'.$drev.'">'.$drev.'</option>';
							}
						}

        				?>
        			</select>
        		</div>
        	</div>
            <hr/>
			<?php if($this->session->userdata('akses')!="PENELITI"){;?>
	        	<div class="form-group row">
	        		<div class="col-sm-12 col-md-12">
	        			<div class="row justify-content-md-center">
	        				<button type="submit" class="btn btn-primary btn-lg col-sm-8 col-md-3 mx-2" ><span class="fa fa-save"></span> Simpan</button>
	        				<button type="reset" class="btn btn-warning btn-lg col-sm-8 col-md-3 mx-2" onclick="window.history.back();"><span class="fa fa-chevron-left"></span> Kembali</button>
	        			</div>
	        		</div>
	        	</div>
			<?php };?>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $("#form_upload_sk").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
				userfile:  {
					required: true,
					extension: "pdf|jpg|jpeg|png"
				},
				pnl_dana_disetujui:{required: true},
                status_update:{required: true}
 			 },
			 messages:{
 				userfile: {
 					required:"File belum anda pilih...",
 					extension:"File yang diijinkan hany dokumen dan foto (PDF,JPG,PNG)"
 				},
				pnl_dana_disetujui:"Form input dana disetujui wajib diisi....",
                status_update:"Update Status belum dipilih...."
 			},
		  	submitHandler: function(form) {
				var formData = new FormData(form);
		        $.ajax({
		            type:'POST',
		            url: "<?php echo site_url("penelitian/save_upload_sk");?>",
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
                               setTimeout(reload_page(),2500);
		      				}else
		      				if(obj.status=='ERROR'){
								$("#notif").html(obj.msg);
		      				}
		                 $("#ajax_loader").fadeOut(100);
		            }
		     });
		 }
	 });

     function reload_page(){
         window.location.reload();
     }
</script>
<!--  LOADING FANCYBOX-->
<script src="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.js"></script>
<link href="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.css" rel="stylesheet" />
<style>
.fancybox-slide--iframe .fancybox-content {
	width  : 80%;
	height : 100%;
	max-width  : 80%;
	max-height : 100%;
	margin: 0;
}
</style>
<!-- END FABCYBOX -->
<?php
}else{
?>

<div class="alert alert-danger h3"><i class="fa fa-warning"></i> Data Tidak ditemukan...</div>
<div class="float-right">
	<button type="button" onclick="window.history.back();" class="btn btn-sm btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button>
</div>

<?php };?>
