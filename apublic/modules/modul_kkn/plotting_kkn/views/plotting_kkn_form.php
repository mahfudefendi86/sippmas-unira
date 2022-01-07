<?php
$is_edit = (isset($plotting_kkn));
?>

<div class="row">
    <div class="col-sm-12 col-md-7">
        <h3 id="title" class="border-bottom border-primary text-primary pb-2"><?php echo $title; ?></h3>
    </div>
</div>

<div class="card p-3 mb-3">
    <form class="form-horizontal" role="form" name="formplotting_kkn" id="plotting_kkn"
        action="<?php echo (!$is_edit) ? site_url("plotting_kkn/plotting_kkn_add") : site_url("plotting_kkn/plotting_kkn_upd") . '/' . $plotting_kkn->id_plot; ?>"
        method="post">
        <input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $plotting_kkn->id_plot; ?>"
            name="pt__id_plotting" id="pt__id_plotting" placeholder="ID Plotting" />
        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="pt__nama_kelompok">Nama Kelompok</label>
            <div class="col-sm-12 col-md-8 col-lg-9">
                <select name="pt__nama_kelompok" id="pt__nama_kelompok" class="custom-select">

                    <?php
if (isset($kelompok)) {

    foreach ($kelompok as $data_kelompok) {
        if (isset($id_kelompok)) {
            if ($data_kelompok->id_kelompok == $id_kelompok) {
                $select = '<option value="' . $data_kelompok->id_kelompok . '" selected>' . $data_kelompok->nama_kelompok . '</option>';
            }
        } else {
            if ($data_kelompok->id_kelompok == ((!$is_edit) ? '' : $plotting_kkn->kelompok)) {
                $select .= '<option value="' . $data_kelompok->id_kelompok . '" selected>' . $data_kelompok->nama_kelompok . '</option>';
            } else {
                $select .= '<option value="' . $data_kelompok->id_kelompok . '" >' . $data_kelompok->nama_kelompok . '</option>';
            }
        }

    }
    echo !isset($id_kelompok) ? '<option value="">Pilih Kelompok</option>' . $select : $select;
}
?>

                </select>
            </div>
        </div>

        <!-- <div class="form-group row">
					<label class="col-sm-12 col-md-4 col-lg-3" for="pt__anggota_kelompok">Anggota Kelompok</label>
					<div class="col-sm-12 col-md-8 col-lg-9">
						<select name="pt__anggota_kelompok" id="pt__anggota_kelompok" class="custom-select" >
						<option value="">== Pilih Anggota Kelompok ==</option>
		                    	<?php
// if (isset($anggota)) {
//     foreach ($anggota as $data_anggota) {
//         if ($data_anggota->userid == ((!$is_edit) ? '' : $plotting_kkn->anggota)) {
//             echo '<option value="' . $data_anggota->userid . '" selected>' . $data_anggota->nama . '</option>';
//         } else {
//             echo '<option value="' . $data_anggota->userid . '" >' . $data_anggota->nama . '</option>';
//         }
//     }
// }
?>

						</select>
					</div>
				</div> -->

        <div class="form-group row">
            <label class="col-sm-12 col-md-4 col-lg-3" for="pt__anggota_kelompok">Nama Peserta KKN</label>

            <div class="col-sm-12 col-md-8 col-lg-9">
                <!-- <input type="text" class="form-control"  name="nama_peserta_kkn" id="nama_peserta_kkn" value="" onclick="cek_nama_peserta_kkn()"  onkeypress="cek_nama_peserta_kkn()" placeholder="Silahkan Cari Peserta KKN pada tombol disamping" />
						<input type="hidden" class="form-control" name="pt__anggota_kelompok" id="pt__anggota_kelompok" value="" /> -->
                <!-- <select name="list_peserta[]" id="list_peserta" class="form-control" size="3" multiple="multiple">
    					</select> -->
                <table class="table table-sm table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">No.</th>
                            <th>Nama</th>
                            <th width="50">
                                <button type="button" class="btn btn-primary" id="cari_peserta_kkn"
                                    data-toggle="tooltip" title="Cari atau Tambah Peserta KKN"> <i
                                        class="fa fa-search"></i> Cari Peserta KKN</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody name="list_peserta" id="list_peserta">
                        <?php
if (isset($anggota)) {
    $n = 0;
    foreach ($anggota as $danggota) {
        $n++;
        // echo '<tr class="op_' . $danggota->anggota . '" id="' . $n . '">';
        // echo '<td>' . $n . '</td><td>' . $danggota->nama_lookup . '</td>';
        // echo '<td><a href="javascript:void(0)" class="btn btn-danger remove" onClick="remove_list($(this));"><i class="fa fa-trash"></i></a></td>';
        // echo '</tr>';
        $no = '<td>' . $n . '</td>';
        $input = '<td><input type="hidden" name="pt__anggota_kelompok[]" value="' . $danggota->anggota . '"><input type="text" class="form-control" name="list_peserta[]" value="' . $danggota->nama_lookup . '" readonly></td>';
        $btn = '<td><a href="javascript:void(0)" class="btn btn-danger remove" onClick="remove_list($(this));"><i class="fa fa-trash"></i></a></td>';
        $html = '<tr class="op_' . $danggota->anggota . '" id="' . $n . '">' . $no . $input . $btn . '</tr>';
        echo $html;
    }

} else {
    ?>
                        <tr id="no_data">
                            <!-- <td></td>
									<td></td> -->
                            <td colspan="3" style="text-align: center">No Data</td>
                        </tr>
                        <?php }
;?>
                    </tbody>
                </table>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Modal label" aria-hidden="true" id="modalView"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="dataview_modal"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>
                    Close</button>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
$("#plotting_kkn").validate({
    errorClass: "is-invalid",
    validClass: "is-valid",
    wrapper: "span",
    rules: {
        pt__nama_kelompok: {
            required: true
        },
        //pt__anggota_kelompok: { required: true }
    },
    messages: {
        pt__nama_kelompok: {
            required: "Nama Kelompok wajib diisi..."
        },
        //pt__anggota_kelompok: { required: "Anggota Kelompok wajib diisi..."  }
    },

    submitHandler: function() {
        var frm = $("#plotting_kkn");
        $.ajax({
            url: frm.attr("action"),
            type: "POST",
            dataType: "html",
            data: frm.serialize(),
            beforeSend: function() {
                ///Event sebelum proses data dikirim
                $("#ajax_loader").fadeIn(100);
            },
            success: function(data) {
                console.log(data);
                ///Event Jika data Berhasil diterima
                obj = JSON.parse(data);
                if (obj.status == "OK") {
                    Swal.fire({
                        icon: 'success',
                        title: obj.status,
                        text: obj.msg,
                    }).then(function() {
                        //window.location.href = "<?=base_url()?>";
                        window.location.reload();
                    })
                } else
                if (obj.status == "ERROR") {
                    Swal.fire({
                        icon: 'error',
                        title: obj.status,
                        text: obj.msg,
                    })
                }
                $("#ajax_loader").fadeOut(100);
            }
        }); ///end Of Ajax
    }
});

$(document).ready(function() {
    $("#cari_peserta_kkn").click(function() {
        $.ajax({
            url: "<?php echo site_url('kkn/peserta/cari'); ?>",
            dataType: "html",
            beforeSend: function() {
                $("#ajax_loader").fadeIn(100);
            },
            success: function(data) {
                $("#ajax_loader").fadeOut(100);
                $("#modalTitle").html("<h4>Cari Data Peserta KKN</h4>");
                $("#dataview_modal").html(data);
                $("#modalView").modal("show");
            }
        }); /* End of Ajax */
    });

    // Swal.fire({
    // 	icon: 'error',
    // 	title: 'fghfgh',
    // 	text: 'hhjghjg',
    // })
});

function cek_nama_peserta_kkn() {
    //$("#pt__anggota_kelompok").val("");
    //$("#nama_peserta_kkn").val("");
    $("#cari_peserta_kkn").click();
}

function select_peserta_kkn(html) {
    //$("#list_peserta_arr").find("tr[id=no_data]").remove();
    $("#list_peserta").append(html);
}

function get_current_list() {
    let opt = $("#list_peserta").find("tr").clone();
    return opt;
}

if (typeof get_selected_list != "undefined") {
    let curr = get_selected_list();
    $("#list_peserta").append(curr);
}

function remove_list(obj) {
    let tr = obj.parents("tr");
    let rm_id = tr.attr("id");

    let nx_tr = obj.closest("tr").nextAll();
    nx_tr.each(function() {
        let nx_id = $(this).attr("id");
        let val = nx_id - 1;
        let target = $("tr[id=" + nx_id + "]").attr("id", val);
        let ch = $(this).children("td:first-child").html(val);
    })

    tr.remove();
    // let tr = obj.parents("tr");
    // console.log(obj.closest("tr").nextAll());
    // tr.remove();

    let get_id = tr.attr("class");
    let id = "";
    if (get_id) {
        id = get_id.replace("op_", "");

        if (id) {
            let peserta = $(".pilih_peserta[id=" + id + "]");
            let checked;
            checked = peserta.prop("checked");
            if (checked == true) {
                peserta.prop("checked", false);
            }
            $("tr.op_" + id).remove();
        }

        let curr_list = $("#list_peserta").find("tr");
        if (curr_list.length == 0) {
            let html = '<tr id="no_data"><td colspan="3" style="text-align: center">No Data</td></tr>';
            $("#list_peserta").append(html);
        }
    }
}

$("#pt__nama_kelompok").change(function() {
    var id = $(this).val();
    $.ajax({
        url: "<?php echo site_url('plotting_kkn/get_member'); ?>/" + id,
        type: "GET",
        dataType: "html",
        beforeSend: function() {
            ///Event sebelum proses data dikirim
            $("#ajax_loader").fadeIn(100);
        },
        success: function(data) {
            console.log(data);
            ///Event Jika data Berhasil diterima
            obj = JSON.parse(data);
            if (obj.status == "OK") {
                dataPeserta(obj.peserta);
            } else
            if (obj.status == "ERROR") {
                $("#list_peserta").html(
                    '<tr id="no_data"><td colspan="3" style="text-align: center">No Data</td></tr>'
                );
            }
            $("#ajax_loader").fadeOut(100);
        }
    }); ///end Of Ajax
})

function dataPeserta(data) {
    var html = "";
    var no = 1;
    $.each(data, function(i, v) {
        //html += `<tr><td>${no}</td><td>${v.nama_lookup}</td><td></td></tr>`;
        let td_no = '<td>' + no + '</td>';
        let input = '<td><input type="hidden" name="pt__anggota_kelompok[]" value="' + v.anggota +
            '"><input type="text" class="form-control" name="list_peserta[]" value="' + v.nama_lookup +
            '" readonly></td>';
        let btn =
            '<td><a href="javascript:void(0)" class="btn btn-danger remove" onClick="remove_list($(this));"><i class="fa fa-trash"></i></a></td>';
        html += '<tr class="op_' + v.anggota + '" id="' + no + '">' + td_no + input + btn + '</tr>';
        no++
    })
    $("#list_peserta").html(html);

}
</script>