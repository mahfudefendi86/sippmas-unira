<?php
$is_edit=(isset($penelitian));
?>
<h2 class="text-primary"><?php echo isset($title)?$title:"Tambah Usulan";?></h2>
<div class="card p-3 mb-3">
<form class="form-horizontal" role="form" name="formpenelitian" id="penelitianForm" action="<?php echo (!$is_edit) ? site_url("penelitian/penelitian_add") : site_url("penelitian/penelitian_upd").'/'.$penelitian->id_penelitian;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $penelitian->id_penelitian;?>" name="pnl_id_penelitian" id="pnl_id_penelitian" placeholder="id_penelitian"   />
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_jenis_usulan">Jenis usulan <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-10">
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
		<label class="col-sm-12 col-md-2" for="pnl_pengusul">Ketua pengusul <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-10">
			<select name="pnl_pengusul" id="pnl_pengusul" class="custom-select" >
			<option value="">== Pilih ==</option>
	        	<?php
					if(isset($id_ketua)){
						foreach($id_ketua as $data_id_ketua){
							if($this->session->userdata('akses')=="PENELITI"){
								if($data_id_ketua->id_user==$this->session->userdata('id_user')){
									echo '<option value="'.$data_id_ketua->id_user.'" selected>'.$data_id_ketua->nama." / NIDN.".$data_id_ketua->nidn.'</option>';
								}
							}else{
								if($data_id_ketua->id_user==((!$is_edit) ? '' : $penelitian->id_ketua)){
									echo '<option value="'.$data_id_ketua->id_user.'" selected>'.$data_id_ketua->nama." / NIDN.".$data_id_ketua->nidn.'</option>';
								}else{
									echo '<option value="'.$data_id_ketua->id_user.'" >'.$data_id_ketua->nama." / NIDN.".$data_id_ketua->nidn.'</option>';
								}
							}
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_tahun_anggaran">Tahun anggaran <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-10">
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
					}else{
						echo '<option value="" selected >[ Belum ada Anggran yang di Buka ]</option>';
					}
				?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_judul_penelitian">Judul proposal <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-10">
			<textarea name="pnl_judul_penelitian" id="pnl_judul_penelitian"   class="form-control" placeholder="Judul proposal" ><?php echo (!$is_edit) ? '' : $penelitian->judul_penelitian;?></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" id="panel_skema" for="pnl_skema_penelitian">Skema  <?php echo (!$is_edit) ? '' :strtolower($penelitian->jenis_usulan);?> <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-10">
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
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_abstraksi">Abstraksi <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-10">
			<textarea name="pnl_abstraksi" id="pnl_abstraksi"   class="form-control" placeholder="Abstraksi" ><?php echo (!$is_edit) ? '' : $penelitian->abstraksi;?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_kata_kunci">Kata kunci <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-10">
			<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $penelitian->katakunci;?>" name="pnl_kata_kunci" id="pnl_kata_kunci" placeholder="Kata Kunci"   />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_bidang_fokus">Bidang fokus</label>
		<div class="col-sm-12 col-md-10">
			<textarea name="pnl_bidang_fokus" id="pnl_bidang_fokus"   class="form-control" placeholder="Bidang Fokus" ><?php echo (!$is_edit) ? '' : $penelitian->bidang_fokus;?></textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_rumpun_ilmu">Rumpun ilmu</label>
		<div class="col-sm-12 col-md-10">
			<select name="pnl_rumpun_ilmu" id="pnl_rumpun_ilmu" class="custom-select" placeholder="Rumpun Ilmu">
				<option value="">== Pilih Rumpun Ilmu ==</option>
				<?php
				if(isset($keahlian))
					foreach ($keahlian as $key) {
						if($key->nama_bidang==((!$is_edit) ? '' : $penelitian->rumpun_ilmu)){
							echo '<option value="'.$key->nama_bidang.'" selected rel="'.$key->id_bidangkeahlian.'">'.$key->nama_bidang.'</option>';
						}else{
							echo '<option value="'.$key->nama_bidang.'" rel="'.$key->id_bidangkeahlian.'">'.$key->nama_bidang.'</option>';
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_bidang_ilmu"></label>
		<div class="col-sm-12 col-md-10">
			<select name="pnl_bidang_ilmu" id="pnl_bidang_ilmu" class="custom-select" placeholder="Bidang Ilmu">
				<?php if($is_edit){
					echo '<option value="'.$penelitian->bidang_ilmu.'">'.$penelitian->bidang_ilmu.'</option>';
				}else{
					if(isset($bidang_ilmu)){
						echo '<option value="">== Pilih Bidang Ilmu ==</option>';
						foreach ($bidang_ilmu as $key) {
							if($key->nama_bidang==((!$is_edit) ? '' : $penelitian->bidang_ilmu)){
								echo '<option value="'.$key->bidang_ilmu.'" selected>'.$key->bidang_ilmu.'</option>';
							}else{
								echo '<option value="'.$key->bidang_ilmu.'">'.$key->bidang_ilmu.'</option>';
							}
						}
					}else{
						echo '<option value="">[ Pilih rumpun ilmu terlebih dahulu ]</option>';
					}
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_dana_usulan">Pengajuan dana <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-10">
			<input type="number" min="0" name="pnl_dana_usulan" id="pnl_dana_usulan"  class="form-control" placeholder="Nominal dana yang diajukan" value="<?php echo (!$is_edit) ? '' : $penelitian->dana_usulan;?>" />
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_status_pengajuan">Status pengajuan <span class="text-danger">*</span></label>
		<div class="col-sm-12 col-md-10">
			<select name="pnl_status_pengajuan" id="pnl_status_pengajuan" class="custom-select" >
				<option value="">== Pilih ==</option>
				<?php
				if($this->session->userdata('akses')=="PENELITI"){
					echo '<option value="PENGAJUAN" selected>PENGAJUAN</option>';
				}else{
					$sp=array('DISETUJUI','DITOLAK','REVISI','PENGAJUAN');
					foreach ($sp as $key) {
							if($key==((!$is_edit) ? '' : $penelitian->status_pengajuan)){
								echo '<option value="'.$key.'" selected>'.$key.'</option>';
							}else{
								echo '<option value="'.$key.'">'.$key.'</option>';
							}
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
					<button type="reset" class="btn btn-warning btn-lg col-3 mx-2" onclick="window.history.back();"><span class="fa fa-refresh"></span> Batal</button>
				</div>
			</div>
		</div>

</form>
</div>
<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
<?php
	if($is_edit==true){
		echo 'select_skema("'.$penelitian->jenis_usulan.'");'
	;};
?>

function select_skema(id){
	var jenis_skema="<?php echo (!$is_edit) ? '' : $penelitian->id_skema;?>";
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
					  if(value.id_skema==jenis_skema){
						  html = html + '<option value="'+value.id_skema+'" selected>'+value.nama_skema+'</option>';
					  }else{
						  html = html + '<option value="'+value.id_skema+'">'+value.nama_skema+'</option>';
					  }
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

$(function() {
	 var validator = $("#penelitianForm").submit(function() {
			// update underlying textarea before submit validation
			tinyMCE.triggerSave();
		}).validate({

	 		errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
			  rules:{
				  	pnl_jenis_usulan:{ required: true },
				  	pnl_pengusul: { required: true },
				  	pnl_tahun_anggaran: { required: true },
					pnl_judul_penelitian: { required: true },
					pnl_abstraksi: { required: true },
					pnl_kata_kunci: { required: true },
					pnl_skema_penelitian: { required: true },
					pnl_dana_usulan: { required: true },
					pnl_status_pengajuan: { required: true }
			 		},
				messages:{
					pnl_jenis_usulan: "Jenis Usulan wajib diisi...",
					pnl_pengusul: "Ketua pengusul wajib dipilih...",
				  	pnl_tahun_anggaran: "Tahun anggaran wajib dipilih...",
					pnl_judul_penelitian: "Judul penelitian wajib diisi...",
					pnl_abstraksi: "Abstraksi pengusul wajib diisi...",
					pnl_kata_kunci: "Kata Kunci wajib diisi...",
					pnl_skema_penelitian: "Skema penelitian wajib dipilih...",
					pnl_dana_usulan: "Dana usulan wajib diisi...",
					pnl_status_pengajuan: "Status pengajuan wajib diisi...",
				},

				  submitHandler: function() {
					tinyMCE.triggerSave();
					return true;
				 }
	 		});
	 validator.focusInvalid = function() {
			// put focus on tinymce on submit validation
			if (this.settings.focusInvalid) {
				try {
					var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
					if (toFocus.is("textarea")) {
						tinyMCE.get(toFocus.attr("id")).focus();
					} else {
						toFocus.filter(":visible").focus();
					}
				} catch (e) {
					// ignore IE throwing errors when focusing hidden elements
				}
			}
		}
});

	 $("#pnl_rumpun_ilmu").change(function(){
		 select_bidang_ilmu($(this));
	 });

	<?php
		if($is_edit){ echo 'select_bidang_ilmu($("#pnl_rumpun_ilmu"));' ;};
	?>
	 function select_bidang_ilmu(id){
	     if(id.val() != 0){
	         var id = id.find('option:selected').attr('rel');
	     }
	    if(id==""){
	 	   $("#pnl_rumpun_ilmu").html('<option value=""> == Pilih ==</option>');
	 	   return false;
	    }
		var bidang_ilmu="<?php echo (!$is_edit) ? '' : $penelitian->bidang_ilmu;?>";
	    $.ajax({
	 	   url       : "<?php echo site_url('bidang_ilmu/select_ilmu');?>/",
	 	   dataType  : "html",
		   type      : "POST",
		   data      : "id="+id,
	 	   beforeSend: function(){
	 			   ///Event sebelum/proses data dikirim
	 			   $("#ajax_loader").fadeIn(100);
	 	   },
	 	   success   : function(data){
	 			   var html="";
	 			   obj = JSON.parse(data);
	 			   if(obj.status=='200'){
	 				   $.each( obj.data, function( key, value ) {
						   if(value.bidang_ilmu==bidang_ilmu){
							   html = html + '<option value="'+value.bidang_ilmu+'" selected>'+value.bidang_ilmu+'</option>';
						   }else{
							   html = html + '<option value="'+value.bidang_ilmu+'">'+value.bidang_ilmu+'</option>';
						   }
	 				   });
	 			   }else
	 			   if(obj.status=='404'){
	 				   html = html + '<option value="">Maaf, Error loading data...</option>';
	 				   return false;
	 			   }else{
	 				   html = html + '<option value="">Maaf, Error loading data...</option>';
	 				   return false;
	 			   }
				   $("#ajax_loader").fadeOut(100);
	 			   $("#pnl_bidang_ilmu").html(html);
	 	   }
	    });///end Of Ajax
	 }
</script>
<!-- Loading TinyMCE-->
<script src="<?php echo base_url();?>asset/addon/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
tinymce.init({
  selector: '#pnl_abstraksi',
  height: 300,
  theme: 'modern',
  plugins: [
		'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code textcolor colorpicker'
  ],
	toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist forecolor backcolor | link image',
	onchange_callback: function(editor) {
			tinyMCE.triggerSave();
			$("#" + editor.id).valid();
		}

 });

</script>
