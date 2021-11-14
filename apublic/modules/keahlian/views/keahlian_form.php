<?php
$is_edit=(isset($keahlian));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formkeahlian" id="keahlian" action="<?php echo (!$is_edit) ? site_url("keahlian/keahlian_add") : site_url("keahlian/keahlian_upd").'/'.$keahlian->id_bidangkeahlian;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $keahlian->id_bidangkeahlian;?>" name="ka_id" id="ka_id" placeholder="id"   />
		<div class="form-group row">
			<label class="col-sm-12 col-md-3" for="ka_nama_bidang_keahlian">Nama Bidang Keahlian</label>
			<div class="col-sm-12 col-md-9">
				<textarea name="ka_nama_bidang_keahlian" id="ka_nama_bidang_keahlian"   class="form-control" placeholder="Nama Bidang Keahlian" ><?php echo (!$is_edit) ? '' : $keahlian->nama_bidang;?></textarea>
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
 $("#keahlian").validate({
 		errorClass: "is-invalid",
		validClass: "is-valid",
		wrapper: "span",
	  rules:{
		ka_pilih_fakultas: { required: true },
		ka_pilih_prodi: { required: true },
		ka_nama_bidang_keahlian: { required: true }
	 },

	  submitHandler: function() {
		var frm=$("#keahlian");
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

$("#ka_pilih_fakultas").change(function(){
	var id=$(this).val();
	if(id==""){
		$("#ka_pilih_prodi").html('<option value=""> == Pilih ==</option>');
		return false;
	}
	$.ajax({
		url       : "<?php echo site_url('prodi/select_prodi');?>",
		type      : "POST",
		dataType  : "html",
		data      : "idfak="+id,
		beforeSend: function(){
				///Event sebelum/proses data dikirim
				$("#ajax_loader").fadeIn(100);
		},
		success   : function(data){
				var html="";
				obj = JSON.parse(data);
				if(obj.status=='200'){
					$.each( obj.data, function( key, value ) {
						html = html + '<option value="'+value.id_prodi+'">'+value.nama_prodi+'</option>';
					});
				}else
				if(obj.status=='401'){
					html = html + '<option value="">Maaf, Error loading data...</option>';
					return false;
				}else{
					html = html + '<option value="">Maaf, Error loading data...</option>';
					return false;
				}
				$("#ka_pilih_prodi").html(html);
		}
	});///end Of Ajax
});

</script>
