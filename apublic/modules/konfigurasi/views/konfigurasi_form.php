<?php
$is_edit=(isset($konfigurasi));
?>
<h2 class="text-primary"><?php echo $title;?></h2>
<div id="alert_info"></div>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formkonfigurasi" id="konfigurasi" action="<?php echo (!$is_edit) ? site_url("konfigurasi/konfigurasi_add") : site_url("konfigurasi/konfigurasi_upd").'/'.$konfigurasi->id_konf;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $konfigurasi->id_konf;?>" name="kn_id_konf" id="kn_id_konf" placeholder="id_konf"   />
		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="kn_konfig">Nama Konfigurasi</label>
			<div class="col-sm-12 col-md-9">
				<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $konfigurasi->nama_konfig;?>" name="kn_konfig" id="kn_konfig" placeholder="Nama Konfigurasi"   />
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="kn_mulai_tanggal">Tanggal Pengajuan</label>
			<div class="col-sm-12 col-md-9">
				<div class="row">
					<div class="col-md-5">
						<div class="input-group date">
							<div class="input-group-addon input-group-prepend">
									<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
							</div>
							<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $konfigurasi->tgl_mulai;?>" name="kn_mulai_tanggal" id="kn_mulai_tanggal" placeholder="Mulai Tanggal"   />
						</div>
					</div>
					<div class="col-md-2">sampai</div>
					<div class="col-md-5">
						<div class="input-group date">
							<div class="input-group-addon input-group-prepend">
									<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
							</div>
							<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $konfigurasi->tgl_akhir;?>" name="kn_sampai_tanggal" id="kn_sampai_tanggal" placeholder="Sampai Tanggal"   />
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="kn_">keterangan</label>
			<div class="col-sm-12 col-md-9">
				<textarea name="kn_" id="kn_"   class="form-control" placeholder="keterangan" ><?php echo (!$is_edit) ? '' : $konfigurasi->keterangan;?></textarea>
			</div>
	</div>

<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<button type="submit" class="btn btn-primary btn-lg col-3 mx-2"><span class="fa fa-save"></span> Simpan</button>
					<button type="reset" class="btn btn-warning btn-lg col-3 mx-2" onclick="window.history.back();"><span class="fa fa-chevron-left"></span> Kembali</button>
				</div>
			</div>
		</div>

</form>
</div>

<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $("#konfigurasi").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",

		  	submitHandler: function() {
				var frm=$("#konfigurasi");
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
							}else
							if(obj.status=="ERROR"){
								$("#alert_info").html(obj.msg);
							}
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
