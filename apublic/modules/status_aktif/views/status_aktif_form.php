<?php
$is_edit=(isset($status_aktif));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formstatus_aktif" id="status_aktif" action="<?php echo (!$is_edit) ? site_url("status_aktif/status_aktif_add") : site_url("status_aktif/status_aktif_upd").'/'.$status_aktif->id_status_author;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $status_aktif->id_status_author;?>" name="sa_id_status" id="sa_id_status" placeholder="id_status"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="sa_nama_author">Nama Author</label>
					<div class="col-sm-12 col-md-9">
						<select name="sa_nama_author" id="sa_nama_author" class="custom-select" >
						<option value="">== Pilih ==</option>
                        	<?php
								if(isset($id_peneliti)){
									foreach($id_peneliti as $data_id_peneliti){
										if($data_id_peneliti->id_user==((!$is_edit) ? '' : $status_aktif->id_peneliti)){
											echo '<option value="'.$data_id_peneliti->id_user.'" selected>'.$data_id_peneliti->nama.'</option>';
										}else{
											echo '<option value="'.$data_id_peneliti->id_user.'" >'.$data_id_peneliti->nama.'</option>';
										}
									}
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="sa_alasan_nonaktif">Alasan Nonaktif</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="sa_alasan_nonaktif" id="sa_alasan_nonaktif"   class="form-control" placeholder="Alasan Nonaktif" ><?php echo (!$is_edit) ? '' : $status_aktif->alasan_nonaktif;?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="sa_tanggal_non_aktif">Tanggal Non Aktif</label>
					<div class="col-sm-12 col-md-9">
						<div class="input-group date">
							<div class="input-group-addon input-group-prepend">
							    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
							</div>
						  <input type="text" class="form-control"  value="<?php echo (!$is_edit) ? date('Y-m-d') : $status_aktif->tanggal_nonaktif;?>" name="sa_tanggal_non_aktif" id="sa_tanggal_non_aktif" placeholder="Tanggal Non Aktif"  >
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
<script type="text/javascript">
 $("#status_aktif").validate({
		errorClass: "is-invalid",
		validClass: "is-valid",
		wrapper: "span",
  		rules:{
			sa_nama_author: { required: true },
			sa_alasan_nonaktif: { required: true },
			sa_tanggal_non_aktif: { required: true }
		},
		messages:{
			sa_nama_author:"Nama Author wajib diisi...",
			sa_alasan_nonaktif: "Alasan Non Aktif wajib diisi...",
			sa_tanggal_non_aktif:"Tanggal Non Aktif wajib diisi..."
		},

	  	submitHandler: function() {
			var frm=$("#status_aktif");
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
	 <!--  LOADING DATEPICKER -->
	 <link href="<?php echo base_url();?>asset/addon/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
	 <script src="<?php echo base_url();?>asset/addon/datepicker/js/bootstrap-datepicker.min.js"></script>
	 <script src="<?php echo base_url();?>asset/addon/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
	 <script>
	 $('.input-group.date').datepicker({
	     maxViewMode: 2,
	     language: "id",
	     autoclose: true,
	     toggleActive: true,
	 	format:"yyyy-mm-dd"
	 });
	 </script>
	 <!--  END DATA PICKER LOADING-->
