<?php
$is_edit=(isset($berkas));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formberkas" id="berkas" action="<?php echo (!$is_edit) ? site_url("berkas/berkas_add") : site_url("berkas/berkas_upd").'/'.$berkas->id_berkas;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $berkas->id_berkas;?>" name="bks_id_berkas" id="bks_id_berkas" placeholder="id_berkas"   /><input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $berkas->id_penelitian;?>" name="bks_id_penelitian" id="bks_id_penelitian" placeholder="id_penelitian"   /><input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $berkas->identifikasi_berkas;?>" name="bks_identifikasi_berkas" id="bks_identifikasi_berkas" placeholder="identifikasi_berkas"   /><input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $berkas->identifikasi_id;?>" name="bks_identifikasi_id_berkas" id="bks_identifikasi_id_berkas" placeholder="identifikasi_id_berkas"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="bks_tanggal">Tanggal</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $berkas->tanggal_upload;?>" name="bks_tanggal" id="bks_tanggal" placeholder="Tanggal"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="bks_userfile">userfile</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $berkas->file_url;?>" name="bks_userfile" id="bks_userfile" placeholder="userfile"   />
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

<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $("#berkas").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
			bks_userfile: { required: true }
 			 },

		  	submitHandler: function() {
				var frm=$("#berkas");
				$.ajax({
					url       : frm.attr("action"),
					type      : frm.attr("method"),
					dataType  : "html",
					data      : frm.serialize(),
					beforeSend: function(){
							///Event sebelum proses data dikirim
							$("#ajax_loader").fadeIn(100);
					},
					success   : function(data){
							///Event Jika data Berhasil diterima
							obj = JSON.parse(data);
							if(obj.status=="OK"){
								$("#alert_info").html(obj.msg);
								reload_data();
							}else
							if(obj.status=="ERROR"){
								$("#alert_info").html(obj.msg);
							}
							$("#modalView").modal("hide");
							$("#ajax_loader").fadeOut(100);
					}
				});///end Of Ajax
		 }
	 });
</script>