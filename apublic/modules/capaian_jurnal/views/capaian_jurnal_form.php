<?php
$is_edit=(isset($capaian_jurnal));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formcapaian_jurnal" id="capaian_jurnal" action="<?php echo (!$is_edit) ? site_url("capaian_jurnal/capaian_jurnal_add") : site_url("capaian_jurnal/capaian_jurnal_upd").'/'.$capaian_jurnal->id_jurnal;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_jurnal->id_jurnal;?>" name="cj_id_jurnal" id="cj_id_jurnal" placeholder="id_jurnal"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? $id_penelitian : $capaian_jurnal->id_penelitian;?>" name="cj_id_penelitian" id="cj_id_penelitian" placeholder="id_penelitian"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cj_nama_jurnal">Nama jurnal yang dituju</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_jurnal->nama_jurnal;?>" name="cj_nama_jurnal" id="cj_nama_jurnal" placeholder="Nama Jurnal"   />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cj_klasifikasi_jurnal">Klasifikasi jurnal</label>
					<div class="col-sm-12 col-md-9">
						<select name="cj_klasifikasi_jurnal" id="cj_klasifikasi_jurnal" class="custom-select" >
							<option value="">== Pilih ==</option>
							<?php
								$k=array('Internasional','Nasional Terakreditasi','Nasional ber-ISSN');
								foreach ($k as $key) {
									if($key==((!$is_edit) ? '' : $capaian_jurnal->klasifkasi_jurnal)){
										echo '<option value="'.$key.'" selected>'.$key.'</option>';
									}else{
										echo '<option value="'.$key.'">'.$key.'</option>';
									}
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cj_impact_faktor">Impact Faktor Jurnal</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_jurnal->impact_faktor;?>" name="cj_impact_faktor" id="cj_impact_faktor" placeholder="Impact Faktor Jurnal"   />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cj_judul_artikel">Judul Artikel</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="cj_judul_artikel" id="cj_judul_artikel" rows="4"   class="form-control" placeholder="Judul Artikel" ><?php echo (!$is_edit) ? '' : $capaian_jurnal->judul_artikel;?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cj_status_naskah">Status Naskah</label>
					<div class="col-sm-12 col-md-9">
						<select name="cj_status_naskah" id="cj_status_naskah" class="custom-select" >
							<option value="">== Pilih ==</option>
							<?php
								$s=array('Draft Artikel','Sudah dikirim ke Jurnal','Sedang ditelaah','Sedang direvisi','Revisi sudah dikirim ulang','Sudah diterima','Sudah terbit');
								foreach ($s as $key) {
									if($key==((!$is_edit) ? '' : $capaian_jurnal->status_naskah)){
										echo '<option value="'.$key.'" selected>'.$key.'</option>';
									}else{
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
 $("#capaian_jurnal").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
				cj_nama_jurnal: { required: true },
				cj_klasifikasi_jurnal: { required: true },
				cj_judul_artikel: { required: true },
				cj_status_naskah: { required: true }
 			 },
			 messages:{
				 cj_nama_jurnal: "Jurnal yang dituju wajib diisi",
				 cj_klasifikasi_jurnal:"Klasifikasi jurnal belum dipilih",
				 cj_judul_artikel: "Judul Artikel wajib diisi",
				 cj_status_naskah: "Status naskah belum dipilih"
			 },

		  	submitHandler: function() {
				var frm=$("#capaian_jurnal");
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
								reload_data_jurnal();
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
