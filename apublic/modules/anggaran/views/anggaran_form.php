<?php
$is_edit=(isset($anggaran));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formanggaran" id="anggaran" action="<?php echo (!$is_edit) ? site_url("anggaran/anggaran_add") : site_url("anggaran/anggaran_upd").'/'.$anggaran->id_anggaran;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $anggaran->id_anggaran;?>" name="agr_di_anggaran" id="agr_di_anggaran" placeholder="di_anggaran"   />
	<div class="form-group row">
		<label class="col-sm-12 col-md-4" for="agr_tahun_anggaran">Tahun Anggaran</label>
		<div class="col-sm-12 col-md-8">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $anggaran->tahun_anggaran;?>" name="agr_tahun_anggaran" id="agr_tahun_anggaran" placeholder="Tahun Anggaran"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-4" for="agr_jumlah_anggaran">Jumlah Anggaran</label>
		<div class="col-sm-12 col-md-8">
			<input type="number" class="form-control" value="<?php echo (!$is_edit) ? '' : $anggaran->jumlah;?>" name="agr_jumlah_anggaran" id="agr_jumlah_anggaran" placeholder="Jumlah Anggaran"    />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-4 text-success" for="agr_tgl_mulai_proposal">Jadwal Upload Proposal</label>
		<div class="col-sm-12 col-md-8">
			<div class="row">
				<div class="col-md-5">
					<div class="input-group date">
						<div class="input-group-addon input-group-prepend">
						    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
						</div>
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $anggaran->tgl_awal_proposal;?>" name="agr_tgl_mulai_proposal" id="agr_tgl_mulai_proposal" placeholder="Mulai Tanggal"   />
					</div>
				</div>
				<div class="col-md-2"> s/d </div>
				<div class="col-md-5">
					<div class="input-group date">
						<div class="input-group-addon input-group-prepend">
						    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
						</div>
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $anggaran->tgl_akhir_proposal;?>" name="agr_tgl_akhir_proposal" id="agr_tgl_akhir_proposal" placeholder="Sampai Tanggal"   />
					</div>
				</div>
			</div>

		</div>
	</div>


	<div class="form-group row">
		<label class="col-sm-12 col-md-4 text-danger" for="agr_tgl_mulai_laporan">Jadwal Upload Laporan</span></label>
		<div class="col-sm-12 col-md-8">
			<div class="row">
				<div class="col-md-5">
					<div class="input-group date">
						<div class="input-group-addon input-group-prepend">
						    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
						</div>
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $anggaran->tgl_awal_laporan;?>" name="agr_tgl_mulai_laporan" id="agr_tgl_mulai_laporan" placeholder="Mulai Tanggal"   />
					</div>
				</div>
				<div class="col-md-2"> s/d </div>
				<div class="col-md-5">
					<div class="input-group date">
						<div class="input-group-addon input-group-prepend">
						    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
						</div>
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $anggaran->tgl_akhir_laporan;?>" name="agr_tgl_akhir_laporan" id="agr_tgl_akhir_laporan" placeholder="Sampai Tanggal"   />
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-4" for="status">Status</label>
		<div class="col-sm-12 col-md-8">
			<select name="status" id="status" class="form-control" >
				<option value="">= Pilih Status =</option>
				<?php $st=array('OPEN','CLOSE');
					foreach ($st as $key) {
						if($key==((!$is_edit) ? '' : $anggaran->status)){
							echo '<option value="'.$key.'" selected>'.$key.'</option>';
						}else {
							echo '<option value="'.$key.'">'.$key.'</option>';
						}
					}
				?>
			</select>
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
 $("#anggaran").validate({
 		errorClass: "is-invalid",
		validClass: "is-valid",
		wrapper: "span",
		rules:{
		   agr_jumlah_anggaran: { required: true },
		   agr_tahun_anggaran: { required: true },
		   status: { required: true }
		},

	  submitHandler: function() {
		var frm=$("#anggaran");
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
					///Event Jika data Berhasil diterima
					obj = JSON.parse(data);
					if(obj.status=='OK'){
						$("#alert_info").html(obj.msg);
						reload_data();
					}else
					if(obj.status=='ERROR'){
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
