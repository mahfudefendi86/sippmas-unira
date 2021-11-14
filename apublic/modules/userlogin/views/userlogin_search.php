<?php
$is_edit=(isset($userlogin));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formsearch_userlogin" id="search_userlogin" action="<?php echo site_url("userlogin/userlogin_search") ;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="usr_username">Username</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->username;?>" name="usr_username" id="usr_username" placeholder="Username"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="usr_nama">Nama</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->nama;?>" name="usr_nama" id="usr_nama" placeholder="Nama"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="usr_type">Type</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->identifikasi;?>" name="usr_type" id="usr_type" placeholder="Type"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="usr_status">Status</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $userlogin->status;?>" name="usr_status" id="usr_status" placeholder="Status"   />
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

			 $("#search_userlogin").validate({
			 
				  
				  submitHandler: function() {
					var frm=$("#search_userlogin");
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