<?php
$is_edit=(isset($penelitian));
if($is_edit){
?>
<h3 class="text-primary"><?php echo "Detail Usulan Hibah Internal - ".ucfirst(strtolower($penelitian->jenis_usulan));?></h3>
<div class="p-3 mb-3">
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="status">Status <span class="float-md-right"> :</span></label>
		<div class="col-sm-11 col-md-10">
			<span class="badge badge-primary h4"><?php echo (!$is_edit) ? '' : $penelitian->status_pengajuan;?></span>
			<div class="float-right">
				<button type="button" data-toggle="tooltip" title="Kembali" onclick="window.history.back();" class="btn btn-sm btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button>
				<?php if($this->session->userdata("akses")=="ADM" || $this->session->userdata("akses")=="PENELITI" || $this->session->userdata("akses")=="SUA"){ ;?>
					<a href="<?php echo site_url('penelitian/penelitian_upd/'.$penelitian->id_penelitian);?>" class="edit btn btn-primary btn-sm"  title="Edit Data"><i class="fa fa-pencil"></i> Edit</a>
				<?php };?>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_pengusul">Jenis usulan <span class="float-md-right"> :</span></label>
		<div class="col-sm-11 col-md-9 text-muted">
			<h5><?php
			if($penelitian->jenis_usulan=="PENELITIAN"){
				echo '<span class="badge badge-pill badge-success"><i class="fa fa-gear"></i> Penelitian</span>';
			}else{
				echo '<span class="badge badge-pill badge-warning"><i class="fa fa-user"></i> Pengabdian</span>';
			};?></h5>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_pengusul">Ketua/Pengusul <span class="float-md-right"> :</span></label>
		<div class="col-sm-11 col-md-9 text-muted">
			<strong><?php echo $penelitian->nama_lookup;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_tahun_anggaran">Tahun anggaran<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 text-muted">
			<?php echo $penelitian->tahun_anggaran_lookup;?>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_judul_penelitian">Judul proposal<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 card border_left_3">
			<div class="card-body ">
				<span class="text-muted"><strong><?php echo (!$is_edit) ? '' : $penelitian->judul_penelitian;?></strong></span>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_skema_penelitian">Skema <?php echo strtolower($penelitian->jenis_usulan);?><span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 card  border_left_3">
			<div class="card-body text-muted">
				<?php echo (!$is_edit) ? '' : $penelitian->nama_skema_lookup;?>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_abstraksi">Abstraksi<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 card  border_left_3">
			<div class="card-body">
				<span class="text-muted"><?php echo (!$is_edit) ? '' : $penelitian->abstraksi;?></span>
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_kata_kunci">Kata kunci<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 card  border_left_3">
			<div class="card-body text-muted">
				<?php echo (!$is_edit) ? '' : $penelitian->katakunci;?>
			</div>
		</div>
	</div>



	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_bidang_fokus">Bidang fokus<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 card border_left_3">
			<div class="card-body text-muted">
				<?php echo (!$is_edit) ? '' : $penelitian->bidang_fokus;?>
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_rumpun_ilmu">Rumpun ilmu<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 card border_left_3">
			<div class="card-body text-muted">
				<?php  $x=explode("-",(!$is_edit) ? '' : $penelitian->rumpun_ilmu);
				echo (isset($x[0]))?$x[0]:"-";
				echo ' &nbsp;<i class="fa fa-chevron-right"></i>&nbsp; ';
				echo (isset($x[1]))?$x[1]:"-";
				echo ' &nbsp;<i class="fa fa-chevron-right"></i>&nbsp; ';
				echo (!$is_edit) ? '' : $penelitian->bidang_ilmu;
				?>
			</div>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_status_pengajuan">Personil<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 card border_left_3">
			<div class="card-body px-0">
				<?php
				if(isset($personil)){
				?>
				<table class="table table-sm table-bordered table-striped">
					<tr><th class="text-center text-muted">Status</th><th class="text-center text-muted">Nama</th><th class="text-center text-muted">NIM/NIDN</th><th class="text-center text-muted">Program Studi</th></tr>
					<?php foreach ($personil as $value) {
						echo '<tr>';
						echo '<td class="text-large text-muted">'.$value->jenis_personil.'</td>';
						echo '<td class="text-large text-muted">'.$value->nama_personil.'</td>';
						echo '<td class="text-large text-muted">'.$value->nim_nidn.'</td>';
						echo '<td class="text-large text-muted">'.$value->nama_prodi_lookup.'</td>';
						echo '</tr>';
					} ?>
				</table>
				<?php
				}else{
					echo '<span class="text-danger"><strong>Tidak ada Personil...!</strong></span>';
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2" for="pnl_status_pengajuan">Berkas proposal<span class="float-md-right"> :</span></label>
		<div class="col-sm-12 col-md-10 card border_left_3">
			<div class="card-body px-0 pb-1">
				<?php
				if(isset($proposal)){
				?>
				<table class="table table-sm table-bordered table-striped">
					<tr>
						<th width="10%"></th>
						<th width="20%" class="text-muted">Jenis</th>
						<th width="50%" class="text-muted">Berkas</th>
						<th width="20%" class="text-muted">Keterangan</th>
					</tr>
					<?php foreach ($proposal as $prop) {
						echo '<tr>';
						echo '<td>
						<a data-toggle="tooltip" title="Lihat berkas" data-fancybox data-type="iframe" href="javascript:;" data-src="'.site_url('proposal/showup/'.$prop->id_proposal).'" data-caption="Proposal: '.$prop->judul_penelitian_lookup.'"><img src="'.base_url().'asset/imgext/File-PDF-Acrobat-icon.png" /></a>
						<a data-toggle="tooltip" title="Unduh" class="download btn btn-success btn-sm" target="_blank" href="'.site_url('proposal/download_pdf/'.$prop->id_proposal).'" ><i class="fa fa-cloud-download"></i></a>
						</td>';
						echo '<td class="text-large text-muted">'.$prop->jenis_berkas.'</td>';
						echo '<td class="text-large text-muted">'.$prop->file_name.'</td>';
						echo '<td class="text-medium text-muted">'.$prop->keterangan.'</td>';
						echo '</tr>';
					}; ?>
				</table>
				<?php
				}else{
					echo '<span class="text-danger"><strong>Tidak ada Personil...!</strong></span>';
				}
				?>
			</div>
		</div>
	</div>
	<hr/>
	<div class="form-group row">
		<div class="col-sm-12 col-md-12">
			<div class="row justify-content-md-center">
				<button type="reset" class="btn btn-warning btn-lg col-sm-8 col-md-3 mx-2" onclick="window.history.back();"><span class="fa fa-chevron-left"></span> Kembali</button>
			</div>
		</div>
	</div>

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
