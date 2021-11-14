<?php
$is_edit=(isset($capaian_buku));
?>
<div id="notif">
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formberkas" id="formberkas" action="<?php echo site_url("capaian_buku/dokumen_save");?>" method="post" enctype="multipart/form-data" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_buku->id_buku;?>" name="id_buku" id="id_buku" placeholder="id_buku"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_buku->id_penelitian;?>" name="id_penelitian" id="id_penelitian" placeholder="id_penelitian"   />
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="userfile">Pilih Berkas <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-9">
			<input type="file" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_buku->file_url;?>" name="userfile" id="userfile" placeholder="userfile"   />
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
 					extension:"File yang diijinkan hanya dokumen dan foto (PDF,DOCX,DOC,XLSX,XLS,JPG,PNG)"
 				}
			},
		  	submitHandler: function(form) {
				var formData = new FormData(form);
		        $.ajax({
		            type:'POST',
		            url: "<?php echo site_url("capaian_buku/dokumen_save") ;?>",
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
							   reload_data_buku();
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
