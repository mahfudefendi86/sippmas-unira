<style>
.select_warna {
    background: #ffd5ba !important;
}

.sort {
    cursor: pointer;
}

.sort:hover {
    background: #d6d6d6 !important;
    border-bottom: 2px solid #9d9d9d !important;
}
</style>
<div class="table-responsive">
    <form name="form_cb" id="form_cb" class="uk-form" style="margin-bottom:60px;">
        <table class="table table-sm table-hover table-bordered table-striped" id="tabel_tempat_kkn">
            <thead class="thead-light">
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="checkAll" id="checkAll" class="cekAll custom-control-input"
                                value="selectAll" onclick="cekAll();" />
                            <label class="custom-control-label" for="checkAll"> All</label>
                        </div>
                    </td>
                    <td colspan="8">
                        <button type="button" name="btn_hapus1" id="btn_hapus1" onclick="actionAll('delete');"
                            class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i>
                            Delete</button>
                        &nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start + 1); ?> -
                                <?php echo $end; ?> dari <?php echo $total_rows; ?> data ditemukan,</i></strong>
                    </td>
                </tr>
                <tr>
                    <th>No.</th>
                    <th class="sort" data-field="a" onclick="sorted('a');">Tahun Ajaran KKN</th>
                    <th class="sort" data-field="b" onclick="sorted('b');">Nama Tempat KKN</th>
                    <th class="sort" data-field="c" onclick="sorted('c');">Alamat KKN</th>
                    <th class="sort" data-field="d" onclick="sorted('d');">Provinsi</th>
                    <th class="sort" data-field="e" onclick="sorted('e');">Kota/Kabupaten</th>
                    <th class="sort" data-field="f" onclick="sorted('f');">Kecamatan</th>
                    <th class="sort" data-field="g" onclick="sorted('g');">Kelurahan/Desa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
(isset($start)) ? $no = $start : $no = 0;
foreach ($tempat_kkn as $dataview) {
    $no++;
    ?>
                <tr id="tr_<?php echo $dataview->id_tempat; ?>"
                    style="background:<?php echo ($no % 2 == 0) ? '#f4f6f9' : ''; ?>">
                    <td onclick="selectCb('<?php echo $dataview->id_tempat; ?>');">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="cb[]"
                                id="cb_<?php echo $dataview->id_tempat; ?>"
                                value="<?php echo $dataview->id_tempat; ?>" />
                            <label class="custom-control-label" for="cb_<?php echo $dataview->id_tempat; ?>">
                                <?php echo $no; ?></label>
                        </div>
                    </td>
                    <td><?php echo $dataview->nama_kkn_lookup; ?></td>
                    <td><?php echo $dataview->nama_tempat; ?></td>
                    <td><?php echo $dataview->alamat; ?></td>
                    <td><?php echo nama_provinsi($dataview->provinsi); ?></td>
                    <td><?php echo nama_kota($dataview->kota); ?></td>
                    <td><?php echo nama_kecamatan($dataview->kecamatan); ?></td>
                    <td><?php echo nama_kelurahan($dataview->kelurahan); ?></td>

                    <td>
                        <button type="button" class="edit btn btn-primary btn-sm"
                            rel="<?php echo $dataview->id_tempat; ?>" title="Edit Data"><i
                                class="fa fa-pencil"></i></button>
                        <button type="button" class="delete btn btn-danger btn-sm"
                            rel="<?php echo $dataview->id_tempat; ?>" title="Delete Data"><i
                                class="fa fa-remove"></i></button>
                    </td>
                </tr>
                <?php }
;?>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="checkAll2" id="checkAll2" class="cekAll custom-control-input"
                                value="selectAll" onclick="cekAll();" />
                            <label class="custom-control-label" for="checkAll2"> All</label>
                        </div>
                    </td>
                    <td colspan="8">
                        <button type="button" onclick="actionAll('delete');" name="btn_hapus2" id="btn_hapus2"
                            class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i>
                            Delete</button>
                        &nbsp;&nbsp;&nbsp;Menampilkan record ke <?php echo ($start + 1); ?> - <?php echo $end; ?> dari
                        <?php echo $total_rows; ?> data ditemukan,
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
    <div style="margin-top:20px!important;position:relative;" id="link_pagination" class="float-md-right">
        <?php echo $links ?></div>
</div>
<!--End of Table Responsive-->

<script type="text/javascript">
var item_global = new Array();

$("#link_pagination ul a").click(function() {
    var link = $(this).attr("href");
    updateLinkPage(link);
    return false;
})

function selectCb(no) {
    if ($('#cb_' + no).is(':checked')) {
        $('#cb_' + no).prop("checked", false);
        $('#tr_' + no).removeClass("select_warna");
        removeItem(no);
    } else {
        $('#cb_' + no).prop("checked", true);
        $('#tr_' + no).addClass("select_warna");
        addItem(no);
    }
}

function addItem(item) {
    if (item_global.indexOf(item) == -1)
        item_global.push(item);
    countItem();
}

function removeItem(item) {
    var index = item_global.indexOf(item);
    if (index > -1) {
        item_global.splice(index, 1);
    }
    countItem();
}

function countItem() {
    if (item_global.indexOf('selectAll') > -1) {
        var index = item_global.indexOf('selectAll');
        if (index > -1) {
            item_global.splice(index, 1);
        }
    }
    var citem = item_global.length;
    $(".c_hapus").html('<i class="uk-icon-remove"></i> Delete (' + citem + ')');
}

$(".cekAll").click(function(event) {
    if (this.checked) {
        // Iterate each checkbox
        $(":checkbox").each(function() {
            this.checked = true;
            $("#tabel_tempat_kkn tbody tr").addClass("select_warna");
            addItem(this.value);
        });
    } else {
        $(":checkbox").each(function() {
            this.checked = false;
            $("#tabel_tempat_kkn tbody tr").removeClass("select_warna");
            removeItem(this.value);
        });
    }
});

function actionAll(act) {
    if (item_global.length > 0) { ///untuk cek apakah ada record dipilih atau tidak
        if (act == "delete") {
            if (!confirm("Apakah anda yakin akan menghapus data ?")) return false;
        }
        $.ajax({
            url: "<?php echo site_url('tempat_kkn/tempat_kkn_actionAll'); ?>/" + act,
            type: "POST",
            dataType: "html",
            data: "dataArray=" + item_global.sort(),
            beforeSend: function() {
                $("#ajax_loader").fadeIn(100);
            },
            success: function(data) {
                obj = JSON.parse(data);
                if (obj.status == "OK") {
                    $("#alert_info").html(obj.msg);
                    reload_data_tempat_kkn();
                } else
                if (obj.status == "ERROR") {
                    $("#alert_info").html(obj.msg);
                }
                $("#ajax_loader").fadeOut(100);
            }
        }); //end Of Ajax
    } else {
        alert("Maaf anda belum memilih Record...");
    }
}

$(document).ready(function() {

    $(".edit").click(function() {
        var id = $(this).attr("rel");
        $.ajax({
            url: "<?php echo site_url('tempat_kkn/tempat_kkn_upd'); ?>/" + id,
            dataType: "html",
            beforeSend: function() {
                $("#ajax_loader").fadeIn(100);
            },
            success: function(data) {
                $("#ajax_loader").fadeOut(100);
                $("#dataview_modal").html(data);
                $("#modalTitle").html("Edit Data Tempat KKN");
                $("#modalView").modal("show")
            }
        }); //end Of Ajax

    });

    $(".delete").click(function() {
        var id = $(this).attr("rel");
        if (confirm("Apakah anda yakin akan menghapus data ?") == true) {
            $.ajax({
                url: "<?php echo site_url('tempat_kkn/tempat_kkn_dlt'); ?>/" + id,
                dataType: "html",
                beforeSend: function() {
                    $("#ajax_loader").fadeIn(100);
                },
                success: function(data) {
                    obj = JSON.parse(data);
                    if (obj.status == "OK") {
                        $("#alert_info").html(obj.msg);
                        reload_data_tempat_kkn();
                    } else
                    if (obj.status == "ERROR") {
                        $("#alert_info").html(obj.msg);
                    }
                    $("#ajax_loader").fadeOut(100);
                }
            }); //end Of Ajax
        }
    });

});
</script>