<?php
if(isset($reviewer)){
$is_edit=(isset($reviewer));
?>
<div class="row">
   <div class="col-sm-12 col-md-7">
      <h3 id="title" class="border-bottom border-primary text-primary pb-2" ><?php echo $title;?></h3>
   </div>
   <div class="col-sm-12 col-md-5">
      <div class="float-md-right">
         <a id="Update" href="<?php echo site_url("reviewer/reviewer_profil/".$reviewer->id_user);?>"title="Edit profil reviewer" ><button class="btn btn-primary btn-sm ml-3 my-1"><span class="fa fa-edit"></span> Edit Profil</button></a>
		 <a id="foto" href="<?php echo site_url('reviewer/foto/'.$reviewer->id_user);?>" title="Edit Foto reviewer" ><button class="btn btn-warning btn-sm ml-3 my-1"><span class="fa fa-image"></span> Edit Foto</button></a>
         <a id="refresh" title="Refresh" onclick="window.location.reload();" ><button class="btn btn-info btn-sm ml-2 my-1"><span class="fa fa-refresh"></span> Refresh</button></a>
      </div>
   </div>
</div>
<div class="card p-3 mb-3">
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_nama_lengkap">Nama Lengkap</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->nama;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_nidn">NIDN</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->nidn;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_alamat">Alamat</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->alamat;?></strong>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_desa">Desa/Kelurahan</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->nama_desa;?></strong>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_kecamatan">Kecamatan</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->nama_kecamatan;?></strong>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_kota">Kota/Kabupaten</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->nama_kota;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_email">Email</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->email;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_nomer_hp">Nomer HP</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->no_hp;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_tempat_lahir">Tempat Tanggal Lahir</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->tempat_lahir.", ".tgl_indo($reviewer->tgl_lahir);?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_fakultas">Fakultas</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->nama_fakultas;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_program_studi">Program Studi</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->nama_prodi;?></strong>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_bidang_keahlian">Bidang Keahlian</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->nama_bidang_keahlian;?></strong>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_bidang_keilmuan">Bidang Keilmuan</label>
		<div class="col-sm-12 col-md-9">
			: <strong><?php echo (!$is_edit) ? '' : $reviewer->nama_bidang_ilmu;?></strong>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3" for="pnl_foto">Foto Reviewer</label>
		<div class="col-sm-12 col-md-9">
			: <?php
				$f=(!$is_edit) ? '' : $reviewer->foto;
				if($f!=NULL || $f!=""){
					echo '<img class="img-thumbnail" src="'.base_url().$reviewer->foto_thumb.'" title="'.$reviewer->nama.'" width="200px;" />';
				}else{
					echo '<img  class="img-thumbnail" src="'.base_url().'asset/images/no-image.png" width="200px;" />';
				}
			?>
		</div>
	</div>
</div>
<?php }else{ ;?>
<div class="alert alert-danger text-center"><h3>Rupanya data Anda tidak ditemukan pada database!!</h3>&raquo; Silahkan Konfirmasi kepada Administrator untuk pengecekan data identitas anda sebagai Reviewer. </div>
<?php };?>
