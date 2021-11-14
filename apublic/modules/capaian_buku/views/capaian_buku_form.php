<?php
$is_edit=(isset($capaian_buku));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formcapaian_buku" id="capaian_buku" action="<?php echo (!$is_edit) ? site_url("capaian_buku/capaian_buku_add") : site_url("capaian_buku/capaian_buku_upd").'/'.$capaian_buku->id_buku;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_buku->id_buku;?>" name="cb_id_buku" id="cb_id_buku" placeholder="id_buku"   />
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? $id_penelitian : $capaian_buku->id_penelitian;?>" name="cb_id_penelitian" id="cb_id_penelitian" placeholder="id_penelitian"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cb_judul_buku">Judul Buku</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="cb_judul_buku" id="cb_judul_buku" rows="4"  class="form-control" placeholder="Judul Buku" ><?php echo (!$is_edit) ? '' : $capaian_buku->judul_buku;?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cb_penulis">Penulis</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_buku->penulis;?>" name="cb_penulis" id="cb_penulis" placeholder="Penulis"   />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cb_penerbit">Penerbit</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_buku->penerbit;?>" name="cb_penerbit" id="cb_penerbit" placeholder="Penerbit"   />
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="cb_nomer_isbn">Nomer ISBN</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $capaian_buku->no_isbn;?>" name="cb_nomer_isbn" id="cb_nomer_isbn" placeholder="Nomer ISBN"   />
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
 $("#capaian_buku").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
			cb_judul_buku: { required: true },
			cb_penulis: { required: true },
			cb_penerbit: { required: true }
 			 },

		  	submitHandler: function() {
				var frm=$("#capaian_buku");
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
								reload_data_buku();
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
