<?php
$is_edit=(isset($peserta_kkn));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formpeserta_kkn" id="peserta_kkn" action="<?php echo (!$is_edit) ? site_url("peserta_kkn/peserta_kkn_add") : site_url("peserta_kkn/peserta_kkn_upd").'/'.$peserta_kkn->id_peserta;?>" method="post" >
	<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->id_peserta;?>" name="kknn_id_peserta" id="kknn_id_peserta" placeholder="Id Peserta"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_nama_lengkap">Nama Lengkap</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->nama_mhs;?>" name="kknn_nama_lengkap" id="kknn_nama_lengkap" placeholder="Nama Lengkap"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_email">Email</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->email;?>" name="kknn_email" id="kknn_email" placeholder="Email"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_nomer_hp">Nomer HP</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->hp;?>" name="kknn_nomer_hp" id="kknn_nomer_hp" placeholder="Nomer HP"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_nim">NIM</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->nim;?>" name="kknn_nim" id="kknn_nim" placeholder="NIM"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_jenis_kelamin">Jenis Kelamin</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<select name="kknn_jenis_kelamin" id="kknn_jenis_kelamin" class="custom-select" >
	
						</select>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_tempat_lahir">Tempat Lahir</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->tempat_lahir;?>" name="kknn_tempat_lahir" id="kknn_tempat_lahir" placeholder="Tempat Lahir"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_tanggal_lahir">Tanggal Lahir</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->tgl_lahir;?>" name="kknn_tanggal_lahir" id="kknn_tanggal_lahir" placeholder="Tanggal Lahir"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_alamat_domisili">Alamat Domisili</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->alamat_domisili;?>" name="kknn_alamat_domisili" id="kknn_alamat_domisili" placeholder="Alamat Domisili"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_desa">Desa</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->desa;?>" name="kknn_desa" id="kknn_desa" placeholder="Desa"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_kecamatan">Kecamatan</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->kecamatan;?>" name="kknn_kecamatan" id="kknn_kecamatan" placeholder="Kecamatan"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_kota">Kota</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->kotakab;?>" name="kknn_kota" id="kknn_kota" placeholder="Kota"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_fakultas">Fakultas</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<select name="kknn_fakultas" id="kknn_fakultas" class="custom-select" >
						<option value="">== Pilih Fakultas ==</option>
		                    	<?php
									if(isset($id_fakultas)){
										foreach($id_fakultas as $data_id_fakultas){
											if($data_id_fakultas->id_fakultas==((!$is_edit) ? '' : $peserta_kkn->id_fakultas)){
												echo '<option value="'.$data_id_fakultas->id_fakultas.'" selected>'.$data_id_fakultas->nama_fakultas.'</option>';
											}else{
												echo '<option value="'.$data_id_fakultas->id_fakultas.'" >'.$data_id_fakultas->nama_fakultas.'</option>';
											}
										}
									}
								?>						
						</select>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_program_pendidikan">Program Pendidikan</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<select name="kknn_program_pendidikan" id="kknn_program_pendidikan" class="custom-select" >
						<option value="">== Pilih Program Pendidikan ==</option>
		                    	<?php
									if(isset($id_prodi)){
										foreach($id_prodi as $data_id_prodi){
											if($data_id_prodi->id_prodi==((!$is_edit) ? '' : $peserta_kkn->id_prodi)){
												echo '<option value="'.$data_id_prodi->id_prodi.'" selected>'.$data_id_prodi->nama_prodi.'</option>';
											}else{
												echo '<option value="'.$data_id_prodi->id_prodi.'" >'.$data_id_prodi->nama_prodi.'</option>';
											}
										}
									}
								?>						
						</select>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_kondisi_kesehatan">Kondisi Kesehatan</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<div class="custom-control custom-radio">
   						<input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->kesehatan;?>" name="kknn_kondisi_kesehatan" id="kknn_kondisi_kesehatan" placeholder="Kondisi Kesehatan"  />
   						<label class="custom-control-label" for="kknn_kondisi_kesehatan">Kondisi Kesehatan</label>
   					</div>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_penyakit">Penyakit</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<div class="custom-control custom-radio">
   						<input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->penyakit_diderita;?>" name="kknn_penyakit" id="kknn_penyakit" placeholder="Penyakit"  />
   						<label class="custom-control-label" for="kknn_penyakit">Penyakit</label>
   					</div>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_memiliki_istri">Memiliki Istri</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<div class="custom-control custom-checkbox">
							   <input type="checkbox" class="custom-control-input" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->keluarga;?>" name="kknn_memiliki_istri" id="kknn_memiliki_istri" placeholder="Memiliki Istri"  />
							   <label class="custom-control-label" for="kknn_memiliki_istri">Memiliki Istri</label>
						   </div>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_hamil">Hamil</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						
							<div class="custom-control custom-radio">
		   						<input type="radio" class="custom-control-input" value="Y" name="kknn_hamil" id="kknn_hamil_Y" placeholder="Hamil"  />
		   						<label class="custom-control-label" for="kknn_hamil_Y">Y</label>
	   						</div>
							<div class="custom-control custom-radio">
		   						<input type="radio" class="custom-control-input" value="N" name="kknn_hamil" id="kknn_hamil_N" placeholder="Hamil"  />
		   						<label class="custom-control-label" for="kknn_hamil_N">N</label>
	   						</div>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_bekerja">Bekerja</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						
							<div class="custom-control custom-radio">
		   						<input type="radio" class="custom-control-input" value="Y" name="kknn_bekerja" id="kknn_bekerja_Y" placeholder="Bekerja"  />
		   						<label class="custom-control-label" for="kknn_bekerja_Y">Y</label>
	   						</div>
							<div class="custom-control custom-radio">
		   						<input type="radio" class="custom-control-input" value="N" name="kknn_bekerja" id="kknn_bekerja_N" placeholder="Bekerja"  />
		   						<label class="custom-control-label" for="kknn_bekerja_N">N</label>
	   						</div>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_pekerjaan">Pekerjaan</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->pekerjaan;?>" name="kknn_pekerjaan" id="kknn_pekerjaan" placeholder="Pekerjaan"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_status_pekerjaan">Status Pekerjaan</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<div class="custom-control custom-radio">
   						<input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->status_pekerjaan;?>" name="kknn_status_pekerjaan" id="kknn_status_pekerjaan" placeholder="Status Pekerjaan"  />
   						<label class="custom-control-label" for="kknn_status_pekerjaan">Status Pekerjaan</label>
   					</div>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_alamat_kerja">Alamat Kerja</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->alamat_kerja;?>" name="kknn_alamat_kerja" id="kknn_alamat_kerja" placeholder="Alamat Kerja"   />
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_ukuran_jaket">Ukuran Jaket</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<div class="custom-control custom-radio">
   						<input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->ukuran_jaket;?>" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket" placeholder="Ukuran Jaket"  />
   						<label class="custom-control-label" for="kknn_ukuran_jaket">Ukuran Jaket</label>
   					</div>
					</div>
				</div>
			
				<div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="kknn_upload">Upload</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->berkas;?>" name="kknn_upload" id="kknn_upload" placeholder="Upload"   />
					</div>
				</div>
			
<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<div class="col-md-4 col-lg-4 col-sm-12 m-1">
						<button type="submit" class="btn btn-primary btn-lg col-12"><span class="fa fa-save"></span> Simpan</button>
					</div>
					<div class="col-md-4 col-lg-4 col-sm-12 m-1">
						<button type="reset"  class="btn btn-warning btn-lg col-12" onclick="$('#modalView_peserta_kkn').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
					</div>
				</div>
			</div>
		</div>

</form>
</div>

<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $("#peserta_kkn").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
					kknn_nama_lengkap: { required: true },
					kknn_email: { required: true },
					kknn_nomer_hp: { required: true },
					kknn_nim: { required: true },
					kknn_jenis_kelamin: { required: true },
					kknn_fakultas: { required: true },
					kknn_program_pendidikan: { required: true },
					kknn_bekerja: { required: true }
 			 },
			messages:{
					kknn_nama_lengkap: { required: '<div class="badge badge-danger badge-pill">Nama Lengkap wajib diisi!</div>'  },
					kknn_email: { required: '<div class="badge badge-danger badge-pill">Email wajib diisi!</div>'  },
					kknn_nomer_hp: { required: '<div class="badge badge-danger badge-pill">Nomer HP wajib diisi!</div>'  },
					kknn_nim: { required: '<div class="badge badge-danger badge-pill">NIM wajib diisi!</div>'  },
					kknn_jenis_kelamin: { required: '<div class="badge badge-danger badge-pill">Jenis Kelamin wajib diisi!</div>'  },
					kknn_fakultas: { required: '<div class="badge badge-danger badge-pill">Fakultas wajib diisi!</div>'  },
					kknn_program_pendidikan: { required: '<div class="badge badge-danger badge-pill">Program Pendidikan wajib diisi!</div>'  },
					kknn_bekerja: { required: '<div class="badge badge-danger badge-pill">Bekerja wajib diisi!</div>'  }
 			 },

		  	submitHandler: function() {
				var frm=$("#peserta_kkn");
				$.ajax({
					url       : frm.attr("action"),
					type      : frm.attr("method"),
					headers	  : {'X-Requested-With': 'XMLHttpRequest'},
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
								reload_data_peserta_kkn();
							}else
							if(obj.status=="ERROR"){
								$("#alert_info").html(obj.msg);
							}
							$("#modalView_peserta_kkn").modal("hide");
							$("#ajax_loader").fadeOut(100);
					}
				});///end Of Ajax
		 }
	 });
</script>