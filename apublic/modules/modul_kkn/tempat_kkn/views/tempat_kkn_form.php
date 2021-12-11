<?php
$is_edit = (isset($tempat_kkn));
?>
<div class="card p-3 mb-3">
    <form class="form-horizontal" role="form" name="formtempat_kkn" id="tempat_kkn"
        action="<?php echo (!$is_edit) ? site_url("tempat_kkn/tempat_kkn_add") : site_url("tempat_kkn/tempat_kkn_upd") . '/' . $tempat_kkn->id_tempat; ?>"
        method="post">
        <input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $tempat_kkn->id_tempat; ?>"
            name="tp__id_tempat_kkn" id="tp__id_tempat_kkn" placeholder="ID Tempat KKN" />
        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="tp__tahun_ajaran_kkn">Tahun Ajaran KKN</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <select name="tp__tahun_ajaran_kkn" id="tp__tahun_ajaran_kkn" class="custom-select">
                    <option value="">== Pilih Tahun Ajaran KKN ==</option>
                    <?php
if (isset($id_thn_kkn)) {
    foreach ($id_thn_kkn as $data_id_thn_kkn) {
        if ($data_id_thn_kkn->id_thn_kkn == ((!$is_edit) ? '' : $tempat_kkn->id_thn_kkn)) {
            echo '<option value="' . $data_id_thn_kkn->id_thn_kkn . '" selected>' . $data_id_thn_kkn->nama_kkn . '</option>';
        } else {
            echo '<option value="' . $data_id_thn_kkn->id_thn_kkn . '" >' . $data_id_thn_kkn->nama_kkn . '</option>';
        }
    }
}
?>

                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="tp__nama_tempat_kkn">Nama Tempat KKN</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <input type="text" class="form-control"
                    value="<?php echo (!$is_edit) ? '' : $tempat_kkn->nama_tempat; ?>" name="tp__nama_tempat_kkn"
                    id="tp__nama_tempat_kkn" placeholder="Nama Tempat KKN" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="tp__alamat_kkn">Alamat KKN</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <textarea name="tp__alamat_kkn" id="tp__alamat_kkn" class="form-control"
                    placeholder="Alamat KKN"><?php echo (!$is_edit) ? '' : $tempat_kkn->alamat; ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="tp__provinsi">Provinsi</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <select name="tp__provinsi" id="tp__provinsi" class="custom-select">
                    <option value="">= Pilih Provinsi =</option>
                    <?php
foreach ($provinsi as $prop) {
    if ($prop->id == ((!$is_edit) ? '' : $tempat_kkn->provinsi)) {
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
            <label class="col-sm-12 col-md-4 col-lg-3" for="tp__kota_kabupaten">Kota/Kabupaten</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <select name="tp__kota" id="tp__kota" class="custom-select">
                    <option value="">= Pilih Kota/Kabupaten =</option>
                    <?php
foreach ($kota as $kot) {
    if ($kot->id == ((!$is_edit) ? '' : $tempat_kkn->kota)) {
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
            <label class="col-sm-12 col-md-4 col-lg-3" for="tp__kecamatan">Kecamatan</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <select name="tp__kecamatan" id="tp__kecamatan" class="custom-select">
                    <option value="">= Pilih Kecamatan =</option>
                    <?php
foreach ($kecamatan as $kec) {
    if ($kec->id == ((!$is_edit) ? '' : $tempat_kkn->kecamatan)) {
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
            <label class="col-sm-12 col-md-4 col-lg-3" for="tp__kelurahan_desa">Kelurahan/Desa</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <select name="tp__kelurahan" id="tp__kelurahan" class="custom-select">
                    <option value="">= Pilih Kelurahan =</option>
                    <?php
foreach ($kelurahan as $kel) {
    if ($kel->id == ((!$is_edit) ? '' : $tempat_kkn->kelurahan)) {
        echo '<option value="' . $kel->id . '" selected>' . $kel->name . '</option>';
    } else {
        echo '<option value="' . $kel->id . '">' . $kel->name . '</option>';
    }
}
?>
                </select>
            </div>
        </div>

        <hr />
        <div class="form-group row">
            <div class="col-sm-12 col-md-12">
                <div class="row justify-content-md-center">
                    <div class="col-md-4 col-lg-4 col-sm-12 m-1">
                        <button type="submit" class="btn btn-primary btn-lg col-12"><span class="fa fa-save"></span>
                            Simpan</button>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 m-1">
                        <button type="reset" class="btn btn-warning btn-lg col-12"
                            onclick="$('#modalView').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<script src="<?php echo base_url(); ?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
$("#tempat_kkn").validate({
    errorClass: "is-invalid",
    validClass: "is-valid",
    wrapper: "span",
    rules: {
        tp__tahun_ajaran_kkn: {
            required: true
        },
        tp__nama_tempat_kkn: {
            required: true
        },
        tp__alamat_kkn: {
            required: true
        },
        tp__provinsi: {
            required: true
        },
        tp__kota_kabupaten: {
            required: true
        },
        tp__kecamatan: {
            required: true
        },
        tp__kelurahan_desa: {
            required: true
        }
    },
    messages: {
        tp__tahun_ajaran_kkn: {
            required: "Tahun Ajaran KKN wajib diisi..."
        },
        tp__nama_tempat_kkn: {
            required: "Nama Tempat KKN wajib diisi..."
        },
        tp__alamat_kkn: {
            required: "Alamat KKN wajib diisi..."
        },
        tp__provinsi: {
            required: "Provinsi wajib diisi..."
        },
        tp__kota_kabupaten: {
            required: "Kota/Kabupaten wajib diisi..."
        },
        tp__kecamatan: {
            required: "Kecamatan wajib diisi..."
        },
        tp__kelurahan_desa: {
            required: "Kelurahan/Desa wajib diisi..."
        }
    },

    submitHandler: function() {
        var frm = $("#tempat_kkn");
        $.ajax({
            url: frm.attr("action"),
            type: frm.attr("method"),
            dataType: "html",
            data: frm.serialize(),
            beforeSend: function() {
                ///Event sebelum proses data dikirim
                $("#ajax_loader").fadeIn(100);
            },
            success: function(data) {
                ///Event Jika data Berhasil diterima
                obj = JSON.parse(data);
                if (obj.status == "OK") {
                    $("#alert_info").html(obj.msg);
                    reload_data_tempat_kkn();
                } else
                if (obj.status == "ERROR") {
                    $("#alert_info").html(obj.msg);
                }
                $("#modalView").modal("hide");
                $("#ajax_loader").fadeOut(100);
            }
        }); ///end Of Ajax
    }
});
</script>
<script>
$(document).ready(function() {
    $('#tp__provinsi').change(function() {
        var id_prov = $(this).val();
        $.ajax({
            url: "<?php echo site_url('main/get_kota'); ?>",
            method: "POST",
            data: {
                id_prov: id_prov
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '<option value="">Pilih Kota/Kabupaten</option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
                }
                $('#tp__kota').html(html);
            }
        });
        return false;
    });
    $('#tp__kota').change(function() {
        var id_kota = $(this).val();
        $.ajax({
            url: "<?php echo site_url('main/get_kecamatan'); ?>",
            method: "POST",
            data: {
                id_kota: id_kota
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '<option value="">Pilih Kecamatan</option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
                }
                $('#tp__kecamatan').html(html);
            }
        });
        return false;
    });
    $('#tp__kecamatan').change(function() {
        var id_kec = $(this).val();
        $.ajax({
            url: "<?php echo site_url('main/get_kelurahan'); ?>",
            method: "POST",
            data: {
                id_kec: id_kec
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '<option value="">Pilih Desa/Kelurahan</option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
                }
                $('#tp__kelurahan').html(html);
            }
        });
        return false;
    });
});
</script>