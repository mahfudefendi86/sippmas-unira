<?php
$is_edit=(isset($penelitian));
if($is_edit){
?>
<h3 class="text-primary"><?php echo isset($title)?$title:"Detail Penelitian";?></h3>
<div class="p-3 mb-3">
<form class="form-horizontal" role="form" name="formpenelitian" id="penelitianForm" action="<?php echo site_url("penelitian/penelitian_plot_reviewer");?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $penelitian->id_penelitian;?>" name="pnl_id_penelitian" id="pnl_id_penelitian" placeholder="id_penelitian"   />
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="status">Status <span class="float-md-right"> :</span></label>
		<div class="col-sm-11 col-md-10">
			<span class="badge badge-primary h4"><?php echo (!$is_edit) ? '' : $penelitian->status_pengajuan;?></span>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_pengusul">Ketua/Pengusul <span class="float-md-right"> :</span></label>
		<div class="col-sm-11 col-md-9 text-muted">
			<strong><?php echo $penelitian->nama_lookup;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_tahun_anggaran">Tahun Anggaran<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 text-muted">
			<?php echo $penelitian->tahun_anggaran_lookup;?>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_judul_penelitian">Judul Penelitian<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10">
			<span class="text-muted"><strong><?php echo (!$is_edit) ? '' : $penelitian->judul_penelitian;?></strong></span>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="reviewer1">Reviewer 1<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10">
			<select name="reviewer1" id="reviewer1" class="custom-select" >
			<option value="">== Pilih ==</option>
	        	<?php
					if(isset($reviewer)){
						foreach($reviewer as $drev){
							if($drev->id_user==((!$is_edit) ? '' : $penelitian->reviewer1)){
								echo '<option value="'.$drev->id_user.'" selected>'.$drev->nama." / NIDN.".$drev->nidn.'</option>';
							}else{
								echo '<option value="'.$drev->id_user.'">'.$drev->nama." / NIDN.".$drev->nidn.'</option>';
							}
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="reviewer2">Reviewer 2<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10">
			<select name="reviewer2" id="reviewer2" class="custom-select" >
			<option value="">== Pilih ==</option>
	        	<?php
					if(isset($reviewer)){
						foreach($reviewer as $drev){
							if($drev->id_user==((!$is_edit) ? '' : $penelitian->reviewer2)){
								echo '<option value="'.$drev->id_user.'" selected>'.$drev->nama." / NIDN.".$drev->nidn.'</option>';
							}else{
								echo '<option value="'.$drev->id_user.'">'.$drev->nama." / NIDN.".$drev->nidn.'</option>';
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
				<button type="submit" class="btn btn-primary btn-lg col-sm-8 col-md-3 mx-2" ><span class="fa fa-save"></span> Simpan</button>
				<button type="reset" class="btn btn-warning btn-lg col-sm-8 col-md-3 mx-2" onclick="window.history.back();"><span class="fa fa-chevron-left"></span> Kembali</button>
			</div>
		</div>
	</div>
</form>
</div>
<!--  LOADING FANCYBOX-->
<script src="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.js"></script>
<link href="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.css" rel="stylesheet" />
<style>
.fancybox-slide--iframe .fancybox-content {
	width  : 80%;
	height : 100%;
	max-width  : 80%;
	max-height : 100%;
	margin: 0;
}
</style>
<!-- END FABCYBOX -->
<?php
}else{
?>

<div class="alert alert-danger h3"><i class="fa fa-warning"></i> Data Tidak ditemukan...</div>
<div class="float-right">
	<button type="button" onclick="window.history.back();" class="btn btn-sm btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button>
</div>

<?php };?>
