<?php
$is_edit=(isset($bidang_ilmu));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formbidang_ilmu" id="bidang_ilmu" action="<?php echo (!$is_edit) ? site_url("bidang_ilmu/bidang_ilmu_add") : site_url("bidang_ilmu/bidang_ilmu_upd").'/'.$bidang_ilmu->id_bidangilmu;?>" method="post" >

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="bi_id_bidangilmu">id_bidangilmu</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $bidang_ilmu->id_bidangilmu;?>" name="bi_id_bidangilmu" id="bi_id_bidangilmu" placeholder="id_bidangilmu"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="bi_">id_bidangkeahlian</label>
					<div class="col-sm-12 col-md-9">
						<select name="bi_" id="bi_" class="custom-select" >
						<option value="">== Pilih ==</option>
                        	<?php
								if(isset($id_bidangkeahlian)){
									foreach($id_bidangkeahlian as $data_id_bidangkeahlian){
										if($data_id_bidangkeahlian->id_bidangkeahlian==((!$is_edit) ? '' : $bidang_ilmu->id_bidangkeahlian)){
											echo '<option value="'.$data_id_bidangkeahlian->id_bidangkeahlian.'" selected>'.$data_id_bidangkeahlian->nama_bidang.'</option>';
										}else{
											echo '<option value="'.$data_id_bidangkeahlian->id_bidangkeahlian.'" >'.$data_id_bidangkeahlian->nama_bidang.'</option>';
										}
									}
								}
							?>
						</select>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="bi_bidang_ilmu">Bidang Ilmu</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $bidang_ilmu->bidang_ilmu;?>" name="bi_bidang_ilmu" id="bi_bidang_ilmu" placeholder="Bidang Ilmu"   />
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
 $("#bidang_ilmu").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
			bi_: { required: true },
			bi_bidang_ilmu: { required: true }
 			 },

		  	submitHandler: function() {
				var frm=$("#bidang_ilmu");
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