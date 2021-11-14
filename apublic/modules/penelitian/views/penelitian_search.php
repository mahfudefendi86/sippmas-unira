<?php
$is_edit=(isset($penelitian));
?>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formsearch_penelitian" id="search_penelitian" action="<?php echo site_url("penelitian/penelitian_search") ;?>" method="post" >

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_pengusul">Ketua Pengusul</label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_pengusul" id="pnl_pengusul" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($id_ketua)){
						foreach($id_ketua as $data_id_ketua){
							if($data_id_ketua->id_user==((!$is_edit) ? '' : $penelitian->id_ketua)){
								echo '<option value="'.$data_id_ketua->id_user.'" selected>'.$data_id_ketua->nama.'</option>';
							}else{
								echo '<option value="'.$data_id_ketua->id_user.'" >'.$data_id_ketua->nama.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_tahun_anggaran">Tahun anggaran</label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_tahun_anggaran" id="pnl_tahun_anggaran" class="custom-select" >
			<option value="">== Pilih ==</option>
            	<?php
					if(isset($id_anggaran)){
						foreach($id_anggaran as $data_id_anggaran){
							if($data_id_anggaran->id_anggaran==((!$is_edit) ? '' : $penelitian->id_anggaran)){
								echo '<option value="'.$data_id_anggaran->id_anggaran.'" selected>'.$data_id_anggaran->tahun_anggaran.'</option>';
							}else{
								echo '<option value="'.$data_id_anggaran->id_anggaran.'" >'.$data_id_anggaran->tahun_anggaran.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_jenis_usulan">Jenis usulan <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_jenis_usulan" id="pnl_jenis_usulan" class="custom-select" onchange="select_skema(this.value);">
			<option value="">== Pilih ==</option>
				<?php
					$jsa=array('PENGABDIAN','PENELITIAN');
					$js=(!$is_edit) ? '' : $penelitian->jenis_usulan;
					foreach ($jsa as $key) {
						if($js==$key){
							echo '<option value="'.$key.'" selected>'.$key.'</option>';
						}else{
							echo '<option value="'.$key.'" >'.$key.'</option>';
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" id="panel_skema" for="pnl_skema_penelitian">Skema</label>
		<div class="col-sm-12 col-md-9">
			<select name="pnl_skema_penelitian" id="pnl_skema_penelitian" class="custom-select" >
			<option value="">== Pilih ==</option>
	        	<?php
					if(isset($id_skema)){
						foreach($id_skema as $data_id_skema){
							if($data_id_skema->id_skema==((!$is_edit) ? '' : $penelitian->id_skema)){
								echo '<option value="'.$data_id_skema->id_skema.'" selected>'.$data_id_skema->nama_skema.'</option>';
							}else{
								echo '<option value="'.$data_id_skema->id_skema.'" >'.$data_id_skema->nama_skema.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>
	<input type="hidden" name="status_pengajuan" id="status_pengajuan" value="<?php echo $status;?>" />
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

function select_skema(id){
	$("#panel_skema").html("Skema "+id.toLowerCase());
   $.ajax({
	  url       : "<?php echo site_url('skema/skema_select');?>",
	  dataType  : "html",
	  type      : "POST",
	  data      : "filter="+id,
	  beforeSend: function(){
			  ///Event sebelum/proses data dikirim
			  $("#ajax_loader").fadeIn(100);
	  },
	  success   : function(data){
			  var html="";
			  obj = JSON.parse(data);
			  if(obj.status=='200'){
				  var o='<option value="">== Pilih Skema</option>';
				  $.each( obj.data, function( key, value ) {
						html = html + '<option value="'+value.id_skema+'">'+value.nama_skema+'</option>';
				  });
				  html = o + html;
			  }else
			  if(obj.status=='400'){
				  html = html + '<option value="">Maaf, Error loading data...</option>';
				  return false;
			  }else{
				  html = html + '<option value="">Maaf, Error loading data...</option>';
				  return false;
			  }

			  $("#ajax_loader").fadeOut(100);
			  $("#pnl_skema_penelitian").html(html);
	  }
   });///end Of Ajax
};


$(document).ready(function(){

	 $("#search_penelitian").validate({


		  submitHandler: function() {
			var frm=$("#search_penelitian");
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
