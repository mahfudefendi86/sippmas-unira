<?php
$is_edit = (isset($tahun_ajaran));
?>
<div class="card p-3 mb-3">
    <form class="form-horizontal" role="form" name="formtahun_ajaran" id="tahun_ajaran"
        action="<?php echo (!$is_edit) ? site_url("tahun_ajaran/tahun_ajaran_add") : site_url("tahun_ajaran/tahun_ajaran_upd") . '/' . $tahun_ajaran->id_thn_kkn; ?>"
        method="post">
        <input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $tahun_ajaran->id_thn_kkn; ?>"
            name="th__id_tahun_ajaran_kkn" id="th__id_tahun_ajaran_kkn" placeholder="ID Tahun Ajaran KKN" />
        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="th__nama_kkn">Nama KKN</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <input type="text" class="form-control"
                    value="<?php echo (!$is_edit) ? '' : $tahun_ajaran->nama_kkn; ?>" name="th__nama_kkn"
                    id="th__nama_kkn" placeholder="Nama KKN" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="th__tanggal_mulai">Tanggal Mulai</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="input-group date">
                    <div class="input-group-addon input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control"
                        value="<?php echo (!$is_edit) ? '' : $tahun_ajaran->tgl_mulai; ?>" name="th__tanggal_mulai"
                        id="th__tanggal_mulai" placeholder="Tanggal Mulai" />
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="th__tanggal_selesai">Tanggal Selesai</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <div class="input-group date">
                    <div class="input-group-addon input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control"
                        value="<?php echo (!$is_edit) ? '' : $tahun_ajaran->tgl_selesai; ?>" name="th__tanggal_selesai"
                        id="th__tanggal_selesai" placeholder="Tanggal Selesai" />
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="th__keterangan">Keterangan</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <textarea name="th__keterangan" id="th__keterangan" class="form-control"
                    placeholder="Keterangan"><?php echo (!$is_edit) ? '' : $tahun_ajaran->keterangan; ?></textarea>
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
$("#tahun_ajaran").validate({
    errorClass: "is-invalid",
    validClass: "is-valid",
    wrapper: "span",
    rules: {
        th__nama_kkn: {
            required: true
        },
        th__tanggal_mulai: {
            required: true
        },
        th__tanggal_selesai: {
            required: true
        }
    },
    messages: {
        th__nama_kkn: {
            required: "Nama KKN wajib diisi..."
        },
        th__tanggal_mulai: {
            required: "Tanggal Mulai wajib diisi..."
        },
        th__tanggal_selesai: {
            required: "Tanggal Selesai wajib diisi..."
        }
    },

    submitHandler: function() {
        var frm = $("#tahun_ajaran");
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
                    reload_data_tahun_ajaran();
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
    format: "yyyy-mm-dd"
});
</script>

<!--  END DATA PICKER LOADING-->