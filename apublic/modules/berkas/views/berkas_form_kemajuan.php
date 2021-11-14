<?php
$is_edit=(isset($berkas));
?>
<div id="notif">
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formberkas" id="formberkas" action="<?php echo site_url("berkas/berkas_save");?>" method="post" enctype="multipart/form-data" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $berkas->id_berkas;?>" name="bks_id_berkas" id="bks_id_berkas" placeholder="id_berkas"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? $penelitian->id_penelitian : $berkas->id_penelitian;?>" name="id_penelitian" id="id_penelitian" placeholder="id_penelitian"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? 'kemajuan' : $berkas->identifikasi_berkas;?>" name="bks_identifikasi_berkas" id="bks_identifikasi_berkas" placeholder="identifikasi_berkas"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? NULL : $berkas->identifikasi_id;?>" name="bks_identifikasi_id_berkas" id="bks_identifikasi_id_berkas" placeholder="identifikasi_id_berkas"   />
<input type="hidden" name="command" id="command" value="DELETE|INSERT" />

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="userfile">Pilih Berkas</label>
		<div class="col-sm-12 col-md-9">
			<input type="file" class="form-control" value="<?php echo (!$is_edit) ? '' : $berkas->file_url;?>" name="userfile" id="userfile" placeholder="userfile"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="bks_keterangan">Keterangan</label>
		<div class="col-sm-12 col-md-9">
			<textarea name="bks_keterangan" id="bks_keterangan"   class="form-control" placeholder="Keterangan" ><?php echo (!$is_edit) ? '' : $berkas->keterangan_berkas;?></textarea>
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
</div>
<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $("#formberkas").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
				userfile:  {
					required: true,
					extension: "pdf|doc|docx|xls|xlsx|txt|jpg|jpeg|png"
					}
 			 },
			 messages:{
 				userfile: {
 					required:"File belum anda pilih...",
 					extension:"File yang diijinkan hany dokumen dan foto (PDF,DOCX,DOC,XLSX,XLS,JPG,PNG)"
 				}
 			},
		  	submitHandler: function(form) {
				var formData = new FormData(form);
		        $.ajax({
		            type:'POST',
		            url: "<?php echo site_url("berkas/berkas_save") ;?>",
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
