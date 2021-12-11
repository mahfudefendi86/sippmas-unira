<?php
$is_edit = (isset($peserta_kkn));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formpeserta_kkn" id="peserta_kkn" action="<?php echo (!$is_edit) ? site_url("peserta_kkn/peserta_kkn_add") : site_url("peserta_kkn/peserta_kkn_upd") . '/' . $peserta_kkn->id_peserta; ?>" method="post" enctype="multipart/form-data">
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
                    <input type="radio" class="custom-control-input" value="L" name="kknn_jenis_kelamin" id="kknn_jenis_kelamin_L" placeholder="Jenis Kelamin"  <?php echo ($is_edit && ($peserta_kkn->jenis_kelamin == "L")) ? "checked" : ""; ?>/>
                    <label class="custom-control-label" for="kknn_jenis_kelamin_L">Laki-laki</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="P" name="kknn_jenis_kelamin" id="kknn_jenis_kelamin_P" placeholder="Jenis Kelamin"  <?php echo ($is_edit && ($peserta_kkn->jenis_kelamin == "P")) ? "checked" : ""; ?>/>
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
    if ($prop->id == ((!$is_edit) ? '' : $peserta_kkn->provinsi)) {
        echo '<option value="' . $prop->id . '" selected>' . $prop->name . '</option>';
    } else {
        echo '<option value="' . $prop->id . '">' . $prop->name . '</option>';
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
    if ($kot->id == ((!$is_edit) ? '' : $peserta_kkn->kota)) {
        echo '<option value="' . $kot->id . '" selected>' . $kot->name . '</option>';
    } else {
        echo '<option value="' . $kot->id . '">' . $kot->name . '</option>';
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
    if ($kec->id == ((!$is_edit) ? '' : $peserta_kkn->kecamatan)) {
        echo '<option value="' . $kec->id . '" selected>' . $kec->name . '</option>';
    } else {
        echo '<option value="' . $kec->id . '">' . $kec->name . '</option>';
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
    if ($kel->id == ((!$is_edit) ? '' : $peserta_kkn->kelurahan)) {
        echo '<option value="' . $kel->id . '" selected>' . $kel->name . '</option>';
    } else {
        echo '<option value="' . $kel->id . '">' . $kel->name . '</option>';
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
                <input type="radio" class="custom-control-input" value="baik" name="kknn_kondisi_kesehatan" id="kknn_kondisi_kesehatan_b" placeholder="Kondisi Kesehatan"  <?php echo ($is_edit && ($peserta_kkn->kesehatan == "baik")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_kondisi_kesehatan_b">Baik</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="kurangbaik" name="kknn_kondisi_kesehatan" id="kknn_kondisi_kesehatan_kb" placeholder="Kondisi Kesehatan"  <?php echo ($is_edit && ($peserta_kkn->kesehatan == "kurangbaik")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_kondisi_kesehatan_kb">Kurang Baik</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_penyakit">Penyakit <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="memiliki" name="kknn_penyakit" id="kknn_penyakit_m" placeholder="Penyakit"  <?php echo ($is_edit && ($peserta_kkn->penyakit_diderita == "memiliki")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_penyakit_m">Memiliki</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="tidakmemiliki" name="kknn_penyakit" id="kknn_penyakit_tm" placeholder="Penyakit"  <?php echo ($is_edit && ($peserta_kkn->penyakit_diderita == "tidakmemiliki")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_penyakit_tm">Tidak Memiliki</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_memiliki_keluarga">Memiliki Suami/Istri/Anak <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-checkbox" id="suami">
                <input type="checkbox" class="custom-control-input" value="Suami" name="kknn_memiliki_keluarga[]" id="kknn_memiliki_keluarga_s" placeholder="Memiliki Keluarga"  <?php echo ($is_edit && (in_array("Suami", json_decode($peserta_kkn->keluarga, true)))) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_memiliki_keluarga_s">Suami</label>
            </div>
            <div class="custom-control custom-checkbox" id="istri">
                <input type="checkbox" class="custom-control-input" value="Istri" name="kknn_memiliki_keluarga[]" id="kknn_memiliki_keluarga_i" placeholder="Memiliki Keluarga"  <?php echo ($is_edit && (in_array("Istri", json_decode($peserta_kkn->keluarga, true)))) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_memiliki_keluarga_i">Istri</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="Anak" name="kknn_memiliki_keluarga[]" id="kknn_memiliki_keluarga_a" placeholder="Memiliki Keluarga"  <?php echo ($is_edit && (in_array("Anak", json_decode($peserta_kkn->keluarga, true)))) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_memiliki_keluarga_a">Anak</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="Tidak Memiliki" name="kknn_memiliki_keluarga[]" id="kknn_memiliki_keluarga_tm" placeholder="Memiliki Keluarga"  <?php echo ($is_edit && (in_array("Tidak Memiliki", json_decode($peserta_kkn->keluarga, true)))) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_memiliki_keluarga_tm">Tidak Memiliki</label>
            </div>
        </div>
    </div>

    <div class="form-group row" id="hamil">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_hamil">Hamil</label>
        <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="Y" name="kknn_hamil" id="kknn_hamil_Y" placeholder="Hamil"  <?php echo ($is_edit && ($peserta_kkn->is_hamil == "Y")) ? "checked" : ""; ?>/>
                    <label class="custom-control-label" for="kknn_hamil_Y">Ya</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="N" name="kknn_hamil" id="kknn_hamil_N" placeholder="Hamil"  <?php echo ($is_edit && ($peserta_kkn->is_hamil == "N")) ? "checked" : ""; ?>/>
                    <label class="custom-control-label" for="kknn_hamil_N">Tidak</label>
                </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_bekerja">Sedang Bekerja <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="Y" name="kknn_bekerja" id="kknn_bekerja_Y" placeholder="Bekerja"  <?php echo ($is_edit && ($peserta_kkn->is_kerja == "Y")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_bekerja_Y">Ya</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="N" name="kknn_bekerja" id="kknn_bekerja_N" placeholder="Bekerja"  <?php echo ($is_edit && ($peserta_kkn->is_kerja == "N")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_bekerja_N">Tidak</label>
            </div>
        </div>
    </div>

    <div class="form-group row" id="jenis_pekerjaan">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_pekerjaan">Jenis Pekerjaan</label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="guru" name="kknn_pekerjaan" id="kknn_pekerjaan_G" placeholder="Jenis Pekerjaan"  <?php echo ($is_edit && ($peserta_kkn->pekerjaan == "guru")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_pekerjaan_G">Guru</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="tendik" name="kknn_pekerjaan" id="kknn_pekerjaan_TP" placeholder="Jenis Pekerjaan"  <?php echo ($is_edit && ($peserta_kkn->pekerjaan == "tendik")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_pekerjaan_TP">Tenaga Pendidik / Administrasi Kantor</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="jagatoko" name="kknn_pekerjaan" id="kknn_pekerjaan_PT" placeholder="Jenis Pekerjaan"  <?php echo ($is_edit && ($peserta_kkn->pekerjaan == "jagatoko")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_pekerjaan_PT">Penjaga Toko</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="wiraswasta" name="kknn_pekerjaan" id="kknn_pekerjaan_W" placeholder="Jenis Pekerjaan"  <?php echo ($is_edit && ($peserta_kkn->pekerjaan == "wiraswasta")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_pekerjaan_W">Wiraswasta</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="keamanan" name="kknn_pekerjaan" id="kknn_pekerjaan_K" placeholder="Jenis Pekerjaan"  <?php echo ($is_edit && ($peserta_kkn->pekerjaan == "keamanan")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_pekerjaan_K">Petugas Keamanan</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo ($is_edit && (in_array($peserta_kkn->pekerjaan, ["guru", "tendik", "jagatoko", "wiraswasta", "keamanan"])) == false) ? $peserta_kkn->pekerjaan : ""; ?>" name="kknn_pekerjaan" id="kknn_pekerjaan_L" rel="attach" placeholder="Bekerja"  <?php echo ($is_edit && (in_array($peserta_kkn->pekerjaan, ["guru", "tendik", "jagatoko", "wiraswasta", "keamanan"])) == false) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_pekerjaan_L">Yang lain:
                    <input type="text" class="form-control" value="<?php echo ($is_edit && (in_array($peserta_kkn->pekerjaan, ["guru", "tendik", "jagatoko", "wiraswasta", "keamanan"])) == false) ? $peserta_kkn->pekerjaan : ""; ?>" id="kknn_pekerjaan_L_in" placeholder="Jenis Pekerjaan"/>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group row" id="status_pekerjaan">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_status_pekerjaan">Status Pekerjaan</label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="fulltime" name="kknn_status_pekerjaan" id="kknn_status_pekerjaan_FT" placeholder="Status Pekerjaan"  <?php echo ($is_edit && ($peserta_kkn->status_pekerjaan == "fulltime")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_status_pekerjaan_FT">Full Time</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="parttime" name="kknn_status_pekerjaan" id="kknn_status_pekerjaan_PT" placeholder="Status Pekerjaan"  <?php echo ($is_edit && ($peserta_kkn->status_pekerjaan == "parttime")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_status_pekerjaan_PT">Part Time</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="shifttime" name="kknn_status_pekerjaan" id="kknn_status_pekerjaan_ST" placeholder="Status Pekerjaan"  <?php echo ($is_edit && ($peserta_kkn->status_pekerjaan == "shifttime")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_status_pekerjaan_ST">Shift Time</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="<?php echo ($is_edit && (in_array($peserta_kkn->status_pekerjaan, ["fulltime", "parttime", "shifttime"])) == false) ? $peserta_kkn->status_pekerjaan : ""; ?>" name="kknn_status_pekerjaan" id="kknn_status_pekerjaan_L" placeholder="Status Pekerjaan"  <?php echo ($is_edit && (in_array($peserta_kkn->status_pekerjaan, ["fulltime", "parttime", "shifttime"])) == false) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_status_pekerjaan_L">Yang Lain:
                    <input type="text" class="form-control" value="<?php echo ($is_edit && (in_array($peserta_kkn->status_pekerjaan, ["fulltime", "parttime", "shifttime"])) == false) ? $peserta_kkn->status_pekerjaan : ""; ?>" id="kknn_status_pekerjaan_L_in" placeholder="Status Pekerjaan"/>
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
                <input type="radio" class="custom-control-input" value="S" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_S" placeholder="Ukuran Jaket"  <?php echo ($is_edit && ($peserta_kkn->ukuran_jaket == "S")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_ukuran_jaket_S">S</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="M" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_M" placeholder="Ukuran Jaket"  <?php echo ($is_edit && ($peserta_kkn->ukuran_jaket == "M")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_ukuran_jaket_M">M</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="L" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_L" placeholder="Ukuran Jaket"  <?php echo ($is_edit && ($peserta_kkn->ukuran_jaket == "L")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_ukuran_jaket_L">L</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="XL" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_XL" placeholder="Ukuran Jaket"  <?php echo ($is_edit && ($peserta_kkn->ukuran_jaket == "XL")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_ukuran_jaket_XL">XL</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" value="XXL" name="kknn_ukuran_jaket" id="kknn_ukuran_jaket_XXL" placeholder="Ukuran Jaket"  <?php echo ($is_edit && ($peserta_kkn->ukuran_jaket == "XXL")) ? "checked" : ""; ?>/>
                <label class="custom-control-label" for="kknn_ukuran_jaket_XXL">XXL</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-4 col-lg-3" for="kknn_upload">Upload Bukti Pembayaran (jpg/pdf) <span class="text-danger font-weight-bold">*</span></label>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <input type="hidden" name="berkas_lama" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->berkas; ?>">
            <?php if (isset($peserta_kkn->berkas) && $peserta_kkn->berkas != ""): ?>
                <a id="berkas" class="iframe" href="<?=base_url('asset/uploads/berkas/pembayaran_kkn/' . $peserta_kkn->berkas);?>" ><img src="<?=base_url('asset/imgext/File-PDF-Acrobat-icon.png');?>"/> <?=$peserta_kkn->berkas;?></a>
            <?php else: ?>
                <p style="color: red">Berkas belum diupload</p>
            <?php endif;?>
            <input type="file" class="form-control-file" name="kknn_upload" id="kknn_upload" accept=".jpg,.jpeg,.pdf">
            <label for="p3">(Ukuran file max 1MB)</label>
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

		  	submitHandler: function(form) {
                var formData = new FormData(form);
                var frm=$("#peserta_kkn");
                $.ajax({
                    url         : frm.attr("action"),
					type        : frm.attr("method"),
                    data        : formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
					beforeSend  : function(){
                                ///Event sebelum proses data dikirim
                                $("#ajax_loader").fadeIn(100);
					},
					success     : function(data){
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
                                html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
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
                                html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
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
                                html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
                            }
                            $('#kknn_kelurahan').html(html);
                        }
                    });
                    return false;
                });
            });
</script>
<script>
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

// $(document).ready(function(){

//     let suamiistri_check = $("#kknn_memiliki_keluarga_s, #kknn_memiliki_keluarga_i");
//     let suami = $("#suami");
//     let istri = $("#istri");

//     let hamil_check = $("input[name=kknn_hamil]");
//     let hamil = $("#hamil");

//     // suami.hide();
//     // istri.hide();

//     // hamil.hide();

//     jk_aksi();

//     //set when jenis kelamin selected
//     $("input[name=kknn_jenis_kelamin]").change(function(){
//         jk_aksi();
//     });

//     function jk_aksi()
//     {
//         let jk = $("input[name=kknn_jenis_kelamin]:checked").val();

//         if(jk == "L")
//         {
//             istri.show();
//             suami.hide();

//             hamil.hide();

//             suamiistri_check.prop('checked', false);
//             hamil_check.prop('checked', false);
//         }else if(jk == "P"){
//             suami.show();
//             istri.hide();

//             hamil.show();

//             suamiistri_check.prop('checked', false);
//             hamil_check.prop('checked', false);
//         }else{
//             suami.hide();
//             istri.hide();

//             hamil.hide();
//         }
//     }

//     let jenis_kerja = $("#jenis_pekerjaan");
//     let status_kerja = $("#status_pekerjaan");
//     let alamat_kerja = $("#alamat_kerja");

//     let jenis_k_check = $("input[name=kknn_pekerjaan]");
//     let status_k_check = $("input[name=kknn_status_pekerjaan]");
//     let alamat_k_in = $("#kknn_alamat_kerja");

//     // jenis_kerja.hide();
//     // status_kerja.hide();
//     // alamat_kerja.hide();

//     kerja_aksi();

//     //set when pekerjaan selected
//     $("input[name=kknn_bekerja]").change(function(){
//         kerja_aksi();
//     });

//     function kerja_aksi()
//     {
//         let kerja = $("input[name=kknn_bekerja]:checked").val();

//         if(kerja == "Y"){
//             jenis_kerja.show();
//             status_kerja.show();
//             alamat_kerja.show();

//             jenis_k_check.prop('checked', false);
//             status_k_check.prop('checked', false);
//             alamat_k_in.val("");
//         }else if(kerja == "N"){
//             jenis_kerja.hide();
//             status_kerja.hide();
//             alamat_kerja.hide();

//             jenis_k_check.prop('checked', false);
//             status_k_check.prop('checked', false);
//             alamat_k_in.val("");
//         }else{
//             jenis_kerja.hide();
//             status_kerja.hide();
//             alamat_kerja.hide();
//         }
//     }
//     //set custom value pekerjaan
//     $("input[name=kknn_pekerjaan]").change(function(){
//         $("#kknn_pekerjaan_L_in").val("");
//     });
//     $("#kknn_pekerjaan_L").change(function(){
//         if($(this).attr("rel") == "attach")
//         {
//             $(this).val($("#kknn_pekerjaan_L_in").val());
//         }
//     });

//    $("#kknn_pekerjaan_L_in").change(function(){
//         $("#kknn_pekerjaan_L").val($(this).val());
//    });

//    //set custom value jenis pekerjaan
//    $("input[name=kknn_status_pekerjaan]").change(function(){
//         $("#kknn_status_pekerjaan_L_in").val("");
//     });
//     $("#kknn_status_pekerjaan_L").change(function(){
//         if($(this).attr("rel") == "attach")
//         {
//             $(this).val($("#kknn_status_pekerjaan_L_in").val());
//         }
//     });

//    $("#kknn_status_pekerjaan_L_in").change(function(){
//         $("#kknn_status_pekerjaan_L").val($(this).val());
//    });
// });
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

<!--  LOADING FANCYBOX-->
<script src="<?php echo base_url(); ?>asset/addon/fancybox/jquery.fancybox.js"></script>
<link href="<?php echo base_url(); ?>asset/addon/fancybox/jquery.fancybox.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>theme/sbadmin/vendor/jquery-easing/jquery.easing.js"></script>
<style>
.fancybox-slide--iframe .fancybox-content {
	width  : 80%;
	height : 100%;
	max-width  : 80%;
	max-height : 100%;
	margin: 0;
}
</style>
<script>
    $("a#berkas").fancybox({
        'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600,
		'speedOut'		:	200,
		'overlayShow'	:	false,
    });
</script>
<!-- END FABCYBOX -->