<?php
$is_edit = (isset($peserta_kkn));
?>
<div class="card p-5 mb-3">
    <div class="h5 mt-3 mb-5">
        Lengkapi formulir pendaftaran KKN berikut ini dan upload bukti pembayaran.
    </div>
	<form class="form-horizontal" role="form" name="formpeserta_kkn" id="peserta_kkn" action="<?php echo site_url('main/save_kkn'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->id_peserta; ?>" name="kknn_id_peserta" id="kknn_id_peserta" placeholder="Id Peserta"   />
    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_nama_lengkap">Nama Lengkap <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->nama_mhs; ?>" name="kknn_nama_lengkap" id="kknn_nama_lengkap" placeholder="Nama Lengkap"   />
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_email">Email  <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->email; ?>" name="kknn_email" id="kknn_email" placeholder="Email"   />
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_nomer_hp">Nomer HP  <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->hp; ?>" name="kknn_nomer_hp" id="kknn_nomer_hp" placeholder="Nomer HP"   />
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_nim">NIM  <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->nim; ?>" name="kknn_nim" id="kknn_nim" placeholder="NIM"   />
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_jenis_kelamin">Jenis Kelamin <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="L" name="kknn_jenis_kelamin" id="kknn_jenis_kelamin_L" placeholder="Jenis Kelamin"  />
                    <label class="custom-control-label" for="kknn_jenis_kelamin_L">Laki-laki</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="P" name="kknn_jenis_kelamin" id="kknn_jenis_kelamin_P" placeholder="Jenis Kelamin"  />
                    <label class="custom-control-label" for="kknn_jenis_kelamin_P">Perempuan</label>
                </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_tempat_lahir">Tempat Lahir <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->tempat_lahir; ?>" name="kknn_tempat_lahir" id="kknn_tempat_lahir" placeholder="Tempat Lahir"   />
        </div>
    </div>

    <div class="form-group row">
		<label class="col-sm-12 col-md-3" for="kknn_tanggal_lahir">Tanggal Lahir <span class="text-danger font-weight-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<div class="input-group date">
				<div class="input-group-addon input-group-prepend">
				    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
				  	</div>
			  <input type="text" class="form-control"  value="<?php echo (!$is_edit) ? '' : $peserta_kkn->tgl_lahir; ?>" name="kknn_tanggal_lahir" id="kknn_tanggal_lahir" placeholder="Tanggal Lahir"  >
			</div>
		</div>
	</div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_usia">Usia <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <input type="number" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->usia; ?>" name="kknn_usia" id="kknn_usia" placeholder="Usia"   />
        </div>
    </div>

    <div class="form-group row">
		<label class="col-sm-12 col-md-3" for="kknn_alamat_domisili">Alamat Domisili <span class="text-danger font-weight-bold">*</span></label>
		<div class="col-sm-12 col-md-9">
			<textarea name="kknn_alamat_domisili" id="kknn_alamat_domisili" class="form-control" placeholder="Alamat Domisili" ><?php echo (!$is_edit) ? '' : $peserta_kkn->alamat_domisili; ?></textarea>
		</div>
	</div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_provinsi">Provinsi <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <select class="form-control" name="kknn_provinsi" id="kknn_provinsi" placeholder="Provinsi">
                <option value="">= Pilih Provinsi =</option>
                <?php
foreach ($provinsi as $prop) {
    if ($prop->id_prov == ((!$is_edit) ? '' : $peserta_kkn->provinsi)) {
        echo '<option value="' . $prop->id_prov . '" selected>' . $prop->nama_prov . '</option>';
    } else {
        echo '<option value="' . $prop->id_prov . '">' . $prop->nama_prov . '</option>';
    }
}
?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_kota">Kota/Kabupaten <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <select class="form-control" name="kknn_kota" id="kknn_kota" placeholder="Kota/Kabupaten">
                <option value="">= Pilih Kota/Kabupaten =</option>
                <?php
foreach ($kota as $kot) {
    if ($kot->id_kota == ((!$is_edit) ? '' : $peserta_kkn->kota)) {
        echo '<option value="' . $kot->id_kota . '" selected>' . $kot->nama_kota . '</option>';
    } else {
        echo '<option value="' . $kot->id_kota . '">' . $kot->nama_kota . '</option>';
    }
}
?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_kecamatan">Kecamatan <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <select class="form-control" name="kknn_kecamatan" id="kknn_kecamatan" placeholder="Kecamatan">
                <option value="">= Pilih Kecamatan =</option>
                <?php
foreach ($kecamatan as $kec) {
    if ($kec->id_kec == ((!$is_edit) ? '' : $peserta_kkn->kecamatan)) {
        echo '<option value="' . $kec->id_kec . '" selected>' . $kec->nama_kec . '</option>';
    } else {
        echo '<option value="' . $kec->id_kec . '">' . $kec->nama_kec . '</option>';
    }
}
?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_kelurahan">Kelurahan/Desa <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <select class="form-control" name="kknn_kelurahan" id="kknn_kelurahan" placeholder="Kelurahan/Desa">
                <option value="">= Pilih Kelurahan =</option>
                <?php
foreach ($kelurahan as $kel) {
    if ($kel->id_kel == ((!$is_edit) ? '' : $peserta_kkn->kelurahan)) {
        echo '<option value="' . $kel->id_kel . '" selected>' . $kel->nama_kel . '</option>';
    } else {
        echo '<option value="' . $kel->id_kel . '">' . $kel->nama_kel . '</option>';
    }
}
?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_fakultas">Fakultas <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <select name="kknn_fakultas" id="kknn_fakultas" class="custom-select" >
            <option value="">== Pilih Fakultas ==</option>
                    <?php
if (isset($id_fakultas)) {
    foreach ($id_fakultas as $data_id_fakultas) {
        if ($data_id_fakultas->id_fakultas == ((!$is_edit) ? '' : $peserta_kkn->id_fakultas)) {
            echo '<option value="' . $data_id_fakultas->id_fakultas . '" selected>' . $data_id_fakultas->nama_fakultas . '</option>';
        } else {
            echo '<option value="' . $data_id_fakultas->id_fakultas . '" >' . $data_id_fakultas->nama_fakultas . '</option>';
        }
    }
}
?>

            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_program_pendidikan">Program Pendidikan <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <select name="kknn_program_pendidikan" id="kknn_program_pendidikan" class="custom-select" >
            <option value="">== Pilih Program Pendidikan ==</option>
                    <?php
if (isset($id_prodi)) {
    foreach ($id_prodi as $data_id_prodi) {
        if ($data_id_prodi->id_prodi == ((!$is_edit) ? '' : $peserta_kkn->id_prodi)) {
            echo '<option value="' . $data_id_prodi->id_prodi . '" selected>' . $data_id_prodi->nama_prodi . '</option>';
        } else {
            echo '<option value="' . $data_id_prodi->id_prodi . '" >' . $data_id_prodi->nama_prodi . '</option>';
        }
    }
}
?>

            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_kondisi_kesehatan">Kondisi Kesehatan <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? 'baik' : $peserta_kkn->kesehatan; ?>" name="kknn_kondisi_kesehatan" id="kknn_kondisi_kesehatan_b" placeholder="Kondisi Kesehatan"  />
                <label class="custom-control-label" for="kknn_kondisi_kesehatan_b">Baik</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? 'kurangbaik' : $peserta_kkn->kesehatan; ?>" name="kknn_kondisi_kesehatan" id="kknn_kondisi_kesehatan_kb" placeholder="Kondisi Kesehatan"  />
                <label class="custom-control-label" for="kknn_kondisi_kesehatan_kb">Kurang Baik</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_penyakit">Penyakit <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? 'memiliki' : $peserta_kkn->penyakit_diderita; ?>" name="kknn_penyakit" id="kknn_penyakit_m" placeholder="Penyakit"  />
                <label class="custom-control-label" for="kknn_penyakit_m">Memiliki</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? 'tidakmemiliki' : $peserta_kkn->penyakit_diderita; ?>" name="kknn_penyakit" id="kknn_penyakit_tm" placeholder="Penyakit"  />
                <label class="custom-control-label" for="kknn_penyakit_tm">Tidak Memiliki</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_memiliki_keluarga">Memiliki Suami/Istri/Anak <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-checkbox" id="suami">
                <input type="checkbox" class="custom-control-input" value="<?php echo (!$is_edit) ? 'Suami' : $peserta_kkn->keluarga; ?>" name="kknn_memiliki_keluarga[]" id="kknn_memiliki_keluarga_s" placeholder="Memiliki Keluarga"  />
                <label class="custom-control-label" for="kknn_memiliki_keluarga_s">Suami</label>
            </div>
            <div class="custom-control custom-checkbox" id="istri">
                <input type="checkbox" class="custom-control-input" value="<?php echo (!$is_edit) ? 'Istri' : $peserta_kkn->keluarga; ?>" name="kknn_memiliki_keluarga[]" id="kknn_memiliki_keluarga_i" placeholder="Memiliki Keluarga"  />
                <label class="custom-control-label" for="kknn_memiliki_keluarga_i">Istri</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="<?php echo (!$is_edit) ? 'Anak' : $peserta_kkn->keluarga; ?>" name="kknn_memiliki_keluarga[]" id="kknn_memiliki_keluarga_a" placeholder="Memiliki Keluarga"  />
                <label class="custom-control-label" for="kknn_memiliki_keluarga_a">Anak</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="<?php echo (!$is_edit) ? 'Tidak Memiliki' : $peserta_kkn->keluarga; ?>" name="kknn_memiliki_keluarga[]" id="kknn_memiliki_keluarga_tm" placeholder="Memiliki Keluarga"  />
                <label class="custom-control-label" for="kknn_memiliki_keluarga_tm">Tidak Memiliki</label>
            </div>
        </div>
    </div>

    <div class="form-group row" id="hamil">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_hamil">Hamil</label>
        <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="Y" name="kknn_hamil" id="kknn_hamil_Y" placeholder="Hamil"  />
                    <label class="custom-control-label" for="kknn_hamil_Y">Ya</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="N" name="kknn_hamil" id="kknn_hamil_N" placeholder="Hamil"  />
                    <label class="custom-control-label" for="kknn_hamil_N">Tidak</label>
                </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_bekerja">Sedang Bekerja <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="Y" name="kknn_bekerja" id="kknn_bekerja_Y" placeholder="Bekerja"  />
                <label class="custom-control-label" for="kknn_bekerja_Y">Ya</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="N" name="kknn_bekerja" id="kknn_bekerja_N" placeholder="Bekerja"  />
                <label class="custom-control-label" for="kknn_bekerja_N">Tidak</label>
            </div>
        </div>
    </div>

    <div class="form-group row" id="jenis_pekerjaan">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_pekerjaan">Jenis Pekerjaan</label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="guru" name="kknn_pekerjaan" id="kknn_pekerjaan_G" placeholder="Jenis Pekerjaan"  />
                <label class="custom-control-label" for="kknn_pekerjaan_G">Guru</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="tendik" name="kknn_pekerjaan" id="kknn_pekerjaan_TP" placeholder="Jenis Pekerjaan"  />
                <label class="custom-control-label" for="kknn_pekerjaan_TP">Tenaga Pendidik / Administrasi Kantor</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="jagatoko" name="kknn_pekerjaan" id="kknn_pekerjaan_PT" placeholder="Jenis Pekerjaan"  />
                <label class="custom-control-label" for="kknn_pekerjaan_PT">Penjaga Toko</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="wiraswasta" name="kknn_pekerjaan" id="kknn_pekerjaan_W" placeholder="Jenis Pekerjaan"  />
                <label class="custom-control-label" for="kknn_pekerjaan_W">Wiraswasta</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="keamanan" name="kknn_pekerjaan" id="kknn_pekerjaan_K" placeholder="Jenis Pekerjaan"  />
                <label class="custom-control-label" for="kknn_pekerjaan_K">Petugas Keamanan</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="" name="kknn_pekerjaan" id="kknn_pekerjaan_L" rel="attach" placeholder="Bekerja"  />
                <label class="custom-control-label" for="kknn_pekerjaan_L">Yang lain:
                    <input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->pekerjaan; ?>" id="kknn_pekerjaan_L_in" placeholder="Jenis Pekerjaan"/>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group row" id="status_pekerjaan">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_status_pekerjaan">Status Pekerjaan</label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="fulltime" name="kknn_status_pekerjaan" id="kknn_status_pekerjaan_FT" placeholder="Status Pekerjaan"  />
                <label class="custom-control-label" for="kknn_status_pekerjaan_FT">Full Time</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="parttime" name="kknn_status_pekerjaan" id="kknn_status_pekerjaan_PT" placeholder="Status Pekerjaan"  />
                <label class="custom-control-label" for="kknn_status_pekerjaan_PT">Part Time</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="shifttime" name="kknn_status_pekerjaan" id="kknn_status_pekerjaan_ST" placeholder="Status Pekerjaan"  />
                <label class="custom-control-label" for="kknn_status_pekerjaan_ST">Shift Time</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="lain" name="kknn_status_pekerjaan" id="kknn_status_pekerjaan_L" placeholder="Status Pekerjaan"  />
                <label class="custom-control-label" for="kknn_status_pekerjaan_L">Yang Lain:
                    <input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->status_pekerjaan; ?>" id="kknn_status_pekerjaan_L_in" placeholder="Status Pekerjaan"/>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group row" id="alamat_kerja">
		<label class="col-sm-12 col-md-3" for="kknn_alamat_kerja">Alamat Tempat Bekerja</label>
		<div class="col-sm-12 col-md-9">
			<textarea name="kknn_alamat_kerja" id="kknn_alamat_kerja" class="form-control" placeholder="Alamat Kerja" ><?php echo (!$is_edit) ? '' : $peserta_kkn->alamat_kerja; ?></textarea>
		</div>
	</div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_ukuran_jaket">Ukuran Jaket <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? 'S' : $peserta_kkn->ukuran_jaket; ?>" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_S" placeholder="Ukuran Jaket"  />
                <label class="custom-control-label" for="kknn_ukuran_jaket_S">S</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? 'M' : $peserta_kkn->ukuran_jaket; ?>" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_M" placeholder="Ukuran Jaket"  />
                <label class="custom-control-label" for="kknn_ukuran_jaket_M">M</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? 'L' : $peserta_kkn->ukuran_jaket; ?>" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_L" placeholder="Ukuran Jaket"  />
                <label class="custom-control-label" for="kknn_ukuran_jaket_L">L</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? 'XL' : $peserta_kkn->ukuran_jaket; ?>" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_XL" placeholder="Ukuran Jaket"  />
                <label class="custom-control-label" for="kknn_ukuran_jaket_XL">XL</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo (!$is_edit) ? 'XXL' : $peserta_kkn->ukuran_jaket; ?>" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_XXL" placeholder="Ukuran Jaket"  />
                <label class="custom-control-label" for="kknn_ukuran_jaket_XXL">XXL</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_upload">Upload Bukti Pembayaran (jpg/pdf) <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <input type="file" class="form-control-file" name="kknn_upload" id="kknn_upload" accept=".jpg,.jpeg,.pdf">
            <label for="p3">(Ukuran file max 1MB)</label>
        </div>
    </div>

    <hr>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="security_code"></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <p><?php echo $image; ?></p>
            <label for="p3">Masukan Kode Captcha Diatas</label>
            <input type="text" name="security_code" id="security_code"  value="" class="inputan form-control" placeholder="Kode Captcha" />
        </div>
    </div>
    <br/>

    <hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<div class="col-md-4 col-lg-4 col-sm-12 m-1">
						<button type="submit" class="btn btn-primary btn-lg col-12"><span class="fa fa-save"></span> Daftar</button>
					</div>
					<!-- <div class="col-md-4 col-lg-4 col-sm-12 m-1">
						<button type="reset"  class="btn btn-warning btn-lg col-12" onclick="$('#modalView_peserta_kkn').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
					</div> -->
				</div>
			</div>
		</div>

</form>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
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
            kknn_tempat_lahir: { required: true },
            kknn_tanggal_lahir: { required: true },
            kknn_usia: { required: true },
            kknn_alamat_domisili: { required: true },
            kknn_provinsi: { required: true },
            kknn_kota: { required: true },
            kknn_kecamatan: { required: true },
            kknn_kelurahan: { required: true },
            kknn_fakultas: { required: true },
            kknn_program_pendidikan: { required: true },
            kknn_kondisi_kesehatan: { required: true },
            kknn_penyakit: { required: true },
            "kknn_memiliki_keluarga[]": { required: true },
            kknn_bekerja: { required: true },
            kknn_ukuran_jaket: { required: true },
            kknn_upload: { required: true }
        },
    messages:{
            kknn_nama_lengkap: { required: 'Nama Lengkap wajib diisi' },
            kknn_email: { required: 'Email wajib diisi' },
            kknn_nomer_hp: { required: 'Nomor HP wajib diisi' },
            kknn_nim: { required: 'NIM wajib diisi' },
            kknn_jenis_kelamin: { required: 'Jenis Kelamin wajib dipilih' },
            kknn_tempat_lahir: { required: 'Tempat Lahir wajib diisi' },
            kknn_tanggal_lahir: { required: 'Tanggal Lahir wajib diisi' },
            kknn_usia: { required: 'Usia wajib diisi' },
            kknn_alamat_domisili: { required: 'Alamat Domisili wajib diisi' },
            kknn_provinsi: { required: 'Provinsi wajib dipilih' },
            kknn_kota: { required: 'Kota wajib dipilih' },
            kknn_kecamatan: { required: 'Kecamatan wajib dipilih' },
            kknn_kelurahan: { required: 'Kelurahan wajib dipilih' },
            kknn_fakultas: { required: 'Fakultas wajib dipilih' },
            kknn_program_pendidikan: { required: 'Prodi wajib dipilih' },
            kknn_kondisi_kesehatan: { required: 'Kondisi Kesehatan wajib dipilih' },
            kknn_penyakit: { required: 'Penyakit wajib dipilih' },
            "kknn_memiliki_keluarga[]": { required: 'Memiliki Suami/Istri/Anak wajib diceklis' },
            kknn_bekerja: { required: 'Sedang Bekerja wajib dipilih' },
            kknn_ukuran_jaket: { required: 'Ukuran Jaket wajib dipilih' },
            kknn_upload: { required: 'Berkas Bukti Pembayaran wajib diupload' }
        },

    submitHandler: function(form) {
        var formData = new FormData(form);
        $.ajax({
                type:'POST',
                url: "<?php echo site_url('main/save_kkn'); ?>",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(data){
                    $("#ajax_loader").fadeIn(100);
                },
                success:function(data){
                        obj = JSON.parse(data);
                        if(obj.status=="OK"){
                            Swal.fire({
                                icon: 'success',
                                title: obj.status,
                                text: obj.msg,
                            }).then(function(){
                                window.location.href = "<?=base_url()?>";
                            })
                        }else
                        if(obj.status=="ERROR"){
                            Swal.fire({
                                icon: 'error',
                                title: obj.status,
                                text: obj.msg,
                            })
                        }
                        $("#ajax_loader").fadeOut(100);
            }
        });
    }
});
</script>
<script>
            $(document).ready(function(){
                $('#kknn_fakultas').change(function(){
                    var id_fakultas = $(this).val();
                    $.ajax({
                        url: "<?php echo site_url('main/get_prodi'); ?>",
                        method: "POST",
                        data: {id_fakultas: id_fakultas},
                        async: true,
                        dataType: 'json',
                        success: function(data){
                            var html = '<option value=""> == Pilih Fakultas == </option>';
                            var i;
                            for(i=0; i<data.length; i++){
                                html += '<option value='+data[i].id_prodi+'>'+data[i].nama_prodi+'</option>';
                            }
                            $('#kknn_program_pendidikan').html(html);
                        }
                    });
                    return false;
                });
            });
</script>
<script>
            $(document).ready(function(){
                $('#kknn_provinsi').change(function(){
                    var id_prov = $(this).val();
                    $.ajax({
                        url: "<?php echo site_url('main/get_kota'); ?>",
                        method: "POST",
                        data: {id_prov: id_prov},
                        async: true,
                        dataType: 'json',
                        success: function(data){
                            var html = '<option value="">Pilih Kota/Kabupaten</option>';
                            var i;
                            for(i=0; i<data.length; i++){
                                html += '<option value='+data[i].id_kota+'>'+data[i].nama_kota+'</option>';
                            }
                            $('#kknn_kota').html(html);
                        }
                    });
                    return false;
                });
                $('#kknn_kota').change(function(){
                    var id_kota = $(this).val();
                    $.ajax({
                        url: "<?php echo site_url('main/get_kecamatan'); ?>",
                        method: "POST",
                        data: {id_kota: id_kota},
                        async: true,
                        dataType: 'json',
                        success: function(data){
                            var html = '<option value="">Pilih Kecamatan</option>';
                            var i;
                            for(i=0; i<data.length; i++){
                                html += '<option value='+data[i].id_kec+'>'+data[i].nama_kec+'</option>';
                            }
                            $('#kknn_kecamatan').html(html);
                        }
                    });
                    return false;
                });
                $('#kknn_kecamatan').change(function(){
                    var id_kec = $(this).val();
                    $.ajax({
                        url: "<?php echo site_url('main/get_kelurahan'); ?>",
                        method: "POST",
                        data: {id_kec: id_kec},
                        async: true,
                        dataType: 'json',
                        success: function(data){
                            var html = '<option value="">Pilih Desa/Kelurahan</option>';
                            var i;
                            for(i=0; i<data.length; i++){
                                html += '<option value='+data[i].id_kel+'>'+data[i].nama_kel+'</option>';
                            }
                            $('#kknn_kelurahan').html(html);
                        }
                    });
                    return false;
                });
            });
</script>
<script>
$(document).ready(function(){
    let suamiistri_check = $("#kknn_memiliki_keluarga_s, #kknn_memiliki_keluarga_i");
    let suami = $("#suami");
    let istri = $("#istri");

    let hamil_check = $("input[name=kknn_hamil]");
    let hamil = $("#hamil");

    suami.hide();
    istri.hide();

    hamil.hide();

    //set when jenis kelamin selected
    $("input[name=kknn_jenis_kelamin]").change(function(){
        let jk = $("input[name=kknn_jenis_kelamin]:checked").val();

        if(jk == "L"){
            istri.show();
            suami.hide();

            hamil.hide();

            suamiistri_check.prop('checked', false);
            hamil_check.prop('checked', false);
        }else{
            suami.show();
            istri.hide();

            hamil.show();

            suamiistri_check.prop('checked', false);
            hamil_check.prop('checked', false);
        }
    });

    let jenis_kerja = $("#jenis_pekerjaan");
    let status_kerja = $("#status_pekerjaan");
    let alamat_kerja = $("#alamat_kerja");

    let jenis_k_check = $("input[name=kknn_pekerjaan]");
    let status_k_check = $("input[name=kknn_status_pekerjaan]");
    let alamat_k_in = $("#kknn_alamat_kerja");

    jenis_kerja.hide();
    status_kerja.hide();
    alamat_kerja.hide();
    //set when pekerjaan selected
    $("input[name=kknn_bekerja]").change(function(){
        let kerja = $("input[name=kknn_bekerja]:checked").val();

        if(kerja == "Y"){
            jenis_kerja.show();
            status_kerja.show();
            alamat_kerja.show();

            jenis_k_check.prop('checked', false);
            status_k_check.prop('checked', false);
            alamat_k_in.val("");
        }else{
            jenis_kerja.hide();
            status_kerja.hide();
            alamat_kerja.hide();

            jenis_k_check.prop('checked', false);
            status_k_check.prop('checked', false);
            alamat_k_in.val("");
        }
    });
    //set custom value pekerjaan
    $("input[name=kknn_pekerjaan]").change(function(){
        $("#kknn_pekerjaan_L_in").val("");
    });
    $("#kknn_pekerjaan_L").change(function(){
        if($(this).attr("rel") == "attach")
        {
            $(this).val($("#kknn_pekerjaan_L_in").val());
        }
    });

   $("#kknn_pekerjaan_L_in").change(function(){
        $("#kknn_pekerjaan_L").val($(this).val());
   });

   //set custom value jenis pekerjaan
   $("input[name=kknn_status_pekerjaan]").change(function(){
        $("#kknn_status_pekerjaan_L_in").val("");
    });
    $("#kknn_status_pekerjaan_L").change(function(){
        if($(this).attr("rel") == "attach")
        {
            $(this).val($("#kknn_status_pekerjaan_L_in").val());
        }
    });

   $("#kknn_status_pekerjaan_L_in").change(function(){
        $("#kknn_status_pekerjaan_L").val($(this).val());
   });
});
</script>
<!--  LOADING DATEPICKER -->
<link href="<?php echo base_url(); ?>asset/addon/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/addon/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>asset/addon/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
<script>
$('.input-group.date').datepicker({
    maxViewMode: 2,
    language: "id",
    autoclose: true,
    toggleActive: true,
	format:"yyyy-mm-dd"
});
</script>

<!--  END DATA PICKER LOADING-->