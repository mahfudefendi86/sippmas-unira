<?php
$is_edit=(isset($nilairev));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formnilairev" id="nilairev" action="<?php echo (!$is_edit) ? site_url("nilairev/nilairev_add") : site_url("nilairev/nilairev_upd").'/'.$nilairev->id_nilai;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->id_nilai;?>" name="nr_id_nilai" id="nr_id_nilai" placeholder="id_nilai"   /><input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->id_penelitian;?>" name="nr_id_penelitian" id="nr_id_penelitian" placeholder="id_penelitian"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="nr_hari">Hari</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->hari;?>" name="nr_hari" id="nr_hari" placeholder="Hari"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="nr_tanggal">tanggal</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->tanggal;?>" name="nr_tanggal" id="nr_tanggal" placeholder="tanggal"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="nr_nilai1">nilai1</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->nilai_1;?>" name="nr_nilai1" id="nr_nilai1" placeholder="nilai1"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="nr_nilai2">nilai2</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->nilai_2;?>" name="nr_nilai2" id="nr_nilai2" placeholder="nilai2"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="nr_nilai3">nilai3</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->nilai_3;?>" name="nr_nilai3" id="nr_nilai3" placeholder="nilai3"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="nr_nilai4">nilai4</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->nilai_4;?>" name="nr_nilai4" id="nr_nilai4" placeholder="nilai4"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="nr_nilai5">nilai5</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->nilai_5;?>" name="nr_nilai5" id="nr_nilai5" placeholder="nilai5"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="nr_saran">Saran</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $nilairev->saran_reviewer;?>" name="nr_saran" id="nr_saran" placeholder="Saran"   />
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
 $("#nilairev").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		
		  	submitHandler: function() {
				var frm=$("#nilairev");
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