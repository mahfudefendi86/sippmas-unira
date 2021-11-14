<?php
$is_edit=(isset($proposal));
?>
<div class="card p-3 mb-3">
<form name="formproposal" id="formproposal" action="<?php echo site_url("proposal/proposal_save") ;?>" method="post" enctype="multipart/form-data">
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $proposal->id_proposal;?>" name="prp_id_proposal" id="prp_id_proposal" placeholder="id_proposal"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? $penelitian->id_penelitian : $proposal->id_penelitian;?>" name="psn_id_penelitian" id="psn_id_penelitian" placeholder="id_penelitian"   />
<div id="notif">
		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="prp_jenis_berkas">Jenis Berkas <span class="text-danger">*</span></label>
			<div class="col-sm-12 col-md-9">
				<select name="prp_jenis_berkas" id="prp_jenis_berkas" placeholder="Jenis Berkas" class="form-control">
					<option value="">== Pilih Jenis Berkas ==</option>
					<?php
					$jb=array('Proposal','Uraian Umum','Lembar Pengesahan');
					foreach ($jb as $value) {
						if($value==((!$is_edit) ? '' : $proposal->jenis_berkas)){
							echo '<option value="'.$value.'" selected>'.$value.'</option>';
						}else{
							echo '<option value="'.$value.'">'.$value.'</option>';
						}
					}
					;?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="userfile">File Proposal <span class="text-danger">*</span></label>
			<div class="col-sm-12 col-md-9">
				<input type="file" class="form-control" value="<?php echo (!$is_edit) ? '' : $proposal->urlfile;?>" name="userfile" id="userfile" placeholder="Userfile"   />
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="prp_keterangan">Keterangan </label>
			<div class="col-sm-12 col-md-9">
				<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $proposal->keterangan;?>" name="prp_keterangan" id="prp_keterangan" placeholder="Keterangan"   />
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
</div> <!-- END of Notif -->
</form>
</div>

<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
 //
 $("#formproposal").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
				prp_jenis_berkas : {required: true},
				userfile: {
					required: true,
					accept: "application/pdf"
					}
 			 },
			messages:{
				userfile: {
					required:"File belum anda pilih...",
					accept:"File yang diijinkan hanya PDF"
				},
				prp_jenis_berkas :"Pilih Jenis Berkas yang diunggah..."
			},
			submitHandler: function(form) {
		        var formData = new FormData(form);
		        $.ajax({
		            type:'POST',
		            url: "<?php echo site_url("proposal/proposal_save") ;?>",
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


});

</script>
