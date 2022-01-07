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
    <form name="form_cb" id="form_cb" class="uk-form" style="margin-bottom:10px;">
        <table class="table table-sm table-hover table-bordered table-striped" id="tabel_peserta_kkn">
            <thead class="thead-light">
                <!-- <tr>
	<td colspan="10">
		<div class="col-xs-5">
    		<select name="list_peserta" id="list_peserta_arr" class="form-control" size="8" multiple="multiple">
    		</select>
  		</div>
	</td>
</tr> -->
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <!-- <input type="checkbox" name="checkAll" id="checkAll" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
        <label class="custom-control-label" for="checkAll"> All</label> -->
                        </div>
                    </td>
                    <td colspan="24">
                        <!-- <button type="button" name="btn_hapus1" id="btn_hapus1" onclick="actionAll('delete');" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button> -->
                        &nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start + 1); ?> -
                                <?php echo $end; ?> dari <?php echo $total_rows; ?> data ditemukan,</i></strong>
                    </td>
                </tr>
                <tr>
                    <th>No.</th>
                    <th>Action</th>
                    <th class="sort" data-field="x" onclick="sorted('x');">Status</th>
                    <th class="sort" data-field="a" onclick="sorted('a');">Nama Lengkap</th>
                    <th class="sort" data-field="b" onclick="sorted('b');">Email</th>
                    <th class="sort" data-field="c" onclick="sorted('c');">Nomer HP</th>
                    <th class="sort" data-field="d" onclick="sorted('d');">NIM</th>
                    <th class="sort" data-field="e" onclick="sorted('e');">Jenis Kelamin</th>
                    <th class="sort" data-field="f" onclick="sorted('f');">Tempat Lahir</th>
                    <th class="sort" data-field="g" onclick="sorted('g');">Tanggal Lahir</th>
                    <th class="sort" data-field="h" onclick="sorted('h');">Alamat Domisili</th>
                    <th class="sort" data-field="i" onclick="sorted('i');">Provinsi</th>
                    <th class="sort" data-field="j" onclick="sorted('j');">Kota</th>
                    <th class="sort" data-field="k" onclick="sorted('k');">Kecamatan</th>
                    <th class="sort" data-field="k" onclick="sorted('l');">Kelurahan/Desa</th>
                    <th class="sort" data-field="l" onclick="sorted('m');">Fakultas</th>
                    <th class="sort" data-field="m" onclick="sorted('n');">Program Pendidikan</th>
                    <th class="sort" data-field="n" onclick="sorted('o');">Kondisi Kesehatan</th>
                    <th class="sort" data-field="o" onclick="sorted('p');">Penyakit</th>
                    <th class="sort" data-field="p" onclick="sorted('q');">Memiliki Istri</th>
                    <th class="sort" data-field="q" onclick="sorted('r');">Hamil</th>
                    <th class="sort" data-field="r" onclick="sorted('s');">Bekerja</th>
                    <th class="sort" data-field="s" onclick="sorted('t');">Pekerjaan</th>
                    <th class="sort" data-field="t" onclick="sorted('u');">Status Pekerjaan</th>
                    <th class="sort" data-field="u" onclick="sorted('v');">Alamat Kerja</th>
                    <th class="sort" data-field="v" onclick="sorted('w');">Ukuran Jaket</th>
                    <th class="sort" data-field="w" onclick="sorted('x');">Upload</th>
                </tr>
            </thead>
            <tbody>
                <?php
(isset($start)) ? $no = $start : $no = 0;
if (count($peserta_kkn) > 0) {
    foreach ($peserta_kkn as $dataview) {
        $no++;
        ?>
                <tr id="tr_<?php echo $dataview->id_peserta; ?>"
                    style="background:<?php echo ($no % 2 == 0) ? '#f4f6f9' : ''; ?>">
                    <td onclick="selectCb('<?php echo $dataview->id_peserta; ?>');">
                        <div class="custom-control custom-checkbox">
                            <!-- <input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_peserta; ?>" value="<?php echo $dataview->id_peserta; ?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_peserta; ?>"> <?php echo $no; ?></label> -->
                            <?php echo $no; ?>
                        </div>
                    </td>
                    <!-- <td>
		<button type="button" class="edit btn btn-primary btn-sm" rel="<?php echo $dataview->id_peserta; ?>"  title="Edit Data"><i class="fa fa-pencil"></i></button>
		<button type="button" class="delete btn btn-danger btn-sm" rel="<?php echo $dataview->id_peserta; ?>"  title="Delete Data"><i class="fa fa-trash"></i></button>
		<?php if ($dataview->status == "NONAKTIF"): ?>
		<button type="button" class="validasi btn btn-success btn-sm" rel="set_aktif/<?php echo $dataview->id_peserta; ?>"  title="Aktifkan"><i class="fa fa-check"></i></button>
		<?php elseif ($dataview->status == "AKTIF"): ?>
		<button type="button" class="validasi btn btn-warning btn-sm" rel="set_nonaktif/<?php echo $dataview->id_peserta; ?>"  title="Nonaktifkan"><i class="fa fa-remove"></i></button>
		<?php endif;?>
	</td> -->

                    <td>
                        <!-- <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action
		</button>
		<div class="dropdown-menu">
			<a class="edit dropdown-item" href="#" rel="<?php echo $dataview->id_peserta; ?>">Edit Data</a>
			<a class="delete dropdown-item" href="#" rel="<?php echo $dataview->id_peserta; ?>">Delete Data</a>
			<a class="detail dropdown-item" href="#" rel="<?php echo $dataview->id_peserta; ?>">Detail Data</a>
		</div> -->
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="pilih_peserta custom-control-input"
                                id="<?php echo $dataview->id_peserta; ?>" rel="<?php echo $dataview->nama_mhs; ?>"
                                name="pilih_peserta">
                            <label class="custom-control-label" for="<?php echo $dataview->id_peserta; ?>"></label>
                        </div>
                    </td>

                    <td><span
                            class="badge badge-<?=($dataview->status == "AKTIF") ? "success" : "danger";?> ?>"><?php echo $dataview->status; ?></span>
                    </td>
                    <td><?php echo $dataview->nama_mhs; ?></td>
                    <td><?php echo $dataview->email; ?></td>
                    <td><?php echo $dataview->hp; ?></td>
                    <td><?php echo $dataview->nim; ?></td>
                    <td><?php echo $dataview->jenis_kelamin; ?></td>
                    <td><?php echo $dataview->tempat_lahir; ?></td>
                    <td><?php echo tgl_indo($dataview->tgl_lahir); ?></td>
                    <td><?php echo $dataview->alamat_domisili; ?></td>
                    <td><?php echo nama_provinsi($dataview->provinsi); ?></td>
                    <td><?php echo nama_kota($dataview->kota); ?></td>
                    <td><?php echo nama_kecamatan($dataview->kecamatan); ?></td>
                    <td><?php echo nama_kelurahan($dataview->kelurahan); ?></td>
                    <td><?php echo nama_fakultas($dataview->id_fakultas); ?></td>
                    <td><?php echo nama_prodi($dataview->id_prodi); ?></td>
                    <td><?php echo $dataview->kesehatan; ?></td>
                    <td><?php echo $dataview->penyakit_diderita; ?></td>
                    <td><?php echo implode(", ", json_decode($dataview->keluarga, true)); ?></td>
                    <td><?php echo ($dataview->is_hamil == "Y") ? "Ya" : "Tidak"; ?></td>
                    <td><?php echo ($dataview->is_kerja == "Y") ? "Ya" : "Tidak"; ?></td>
                    <td><?php echo $dataview->pekerjaan; ?></td>
                    <td><?php echo $dataview->status_pekerjaan; ?></td>
                    <td><?php echo $dataview->alamat_kerja; ?></td>
                    <td><?php echo $dataview->ukuran_jaket; ?></td>
                    <td><?php echo $dataview->berkas; ?></td>
                </tr>
                <?php
}
} else {
    echo '<tr><td colspan="26"><div class="alert alert-primary text-center"><h5><i class="fa fa-grav"></i> Data tidak ditemukan</h5></div></td></tr>';
}
;?>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <!-- <input type="checkbox" name="checkAll2" id="checkAll2" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
			<label class="custom-control-label" for="checkAll2"> All</label> -->
                        </div>
                    </td>
                    <td colspan="24">
                        <!-- <button type="button" onclick="actionAll('delete');" name="btn_hapus2" id="btn_hapus2" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button> -->
                        &nbsp;&nbsp;&nbsp;Menampilkan record ke <?php echo ($start + 1); ?> - <?php echo $end; ?> dari
                        <?php echo $total_rows; ?> data ditemukan,
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>

</div>
<!--End of Table Responsive-->
<div class="row justify-content-center text-center">
    <div class="card card-body p-1 pt-3 mx-4">
        <div class="col-sm-12 col-md-12" id="link_pagination"><?php echo $links ?></div>
    </div>
</div>

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
        $(":checkbox").each(function() {
            this.checked = true;
            $("#tabel_peserta_kkn tbody tr").addClass("select_warna");
            addItem(this.value);
        });
    } else {
        $(":checkbox").each(function() {
            this.checked = false;
            $("#tabel_peserta_kkn tbody tr").removeClass("select_warna");
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
            url: "<?php echo site_url('peserta_kkn/peserta_kkn_actionAll'); ?>/" + act,
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
                    reload_data_peserta_kkn();
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
            url: "<?php echo site_url('peserta_kkn/peserta_kkn_upd'); ?>/" + id,
            dataType: "html",
            beforeSend: function() {
                $("#ajax_loader").fadeIn(100);
            },
            success: function(data) {
                $("#ajax_loader").fadeOut(100);
                $("#dataview_modal_peserta_kkn").html(data);
                $("#modalTitle_peserta_kkn").html("Edit Data Peserta Kkn");
                $("#modalView_peserta_kkn").modal("show")
            }
        }); //end Of Ajax

    });

    $(".delete").click(function() {
        var id = $(this).attr("rel");
        if (confirm("Apakah anda yakin akan menghapus data ?") == true) {
            $.ajax({
                url: "<?php echo site_url('peserta_kkn/peserta_kkn_dlt'); ?>/" + id,
                dataType: "html",
                beforeSend: function() {
                    $("#ajax_loader").fadeIn(100);
                },
                success: function(data) {
                    obj = JSON.parse(data);
                    if (obj.status == "OK") {
                        $("#alert_info").html(obj.msg);
                        reload_data_peserta_kkn();
                    } else
                    if (obj.status == "ERROR") {
                        $("#alert_info").html(obj.msg);
                    }
                    $("#ajax_loader").fadeOut(100);
                }
            }); //end Of Ajax
        }
    });

    // $(".validasi").click(function(){
    // 	var id=$(this).attr("rel");
    // 	$.ajax({
    // 		url       : "<?php echo site_url('validasi/peserta/kkn'); ?>/"+id,
    // 		dataType  : "html",
    // 		beforeSend: function(){
    // 						$("#ajax_loader").fadeIn(100);
    // 		},
    // 		success   : function(data){
    // 					obj = JSON.parse(data);
    // 					if(obj.status=="OK"){
    // 						$("#alert_info").html(obj.msg);
    // 						reload_data_peserta_kkn();
    // 					}else
    // 					if(obj.status=="ERROR"){
    // 						$("#alert_info").html(obj.msg);
    // 					}
    // 					$("#ajax_loader").fadeOut(100);
    // 		}
    // 	});
    // });

    $(".detail").click(function() {
        var id = $(this).attr("rel");
        $.ajax({
            url: "<?php echo site_url('peserta_kkn/peserta_kkn_detail'); ?>/" + id,
            dataType: "html",
            beforeSend: function() {
                $("#ajax_loader").fadeIn(100);
            },
            success: function(data) {
                $("#ajax_loader").fadeOut(100);
                $("#dataview_modal_peserta_kkn").html(data);
                $("#modalTitle_peserta_kkn").html("Detail Data Peserta Kkn");
                $("#modalView_peserta_kkn").modal("show");
            }
        }); //end Of Ajax

    });

    $(".pilih_peserta").on("change", function() { //click(function(){

        let checked = $(this).prop("checked");
        let id = $(this).attr("id");
        let nama = $(this).attr("rel");
        if (checked == true) {
            $("tr[id=no_data]").remove();
            let last_tr = $("#list_peserta_arr").find("tr").last().attr("id");
            let i = (last_tr == undefined) ? 1 : parseInt(last_tr) + 1;
            let no = '<td>' + i + '</td>';
            let input = '<td><input type="hidden" name="pt__anggota_kelompok[]" value="' + id +
                '"><input type="text" class="form-control" name="list_peserta[]" value="' + nama +
                '" readonly></td>';
            let btn =
                '<td><a href="javascript:void(0)" class="btn btn-danger remove" onClick="remove_list($(this));"><i class="fa fa-trash"></i></a></td>';
            let html = '<tr class="op_' + id + '" id="' + i + '">' + no + input + btn + '</tr>';

            //let html = '<td class="op op_' + id + '" ondblClick="$(this).remove();"> ' + nama + ' <i class="op-remove fa fa-close"></i></td>';

            /*if(curr_list == undefined){
            	html = '<tr id="no_data"><td colspan="3" style="text-align: center">No Data</td></tr>';
            	$("#list_peserta_arr").append(html);
            }else{
            	html = '<tr class="op_'+id+'" id="'+i+'">'+no+input+btn+'</tr>';
            	$("#list_peserta_arr").append(html);
            }*/

            let duplicate = $("#list_peserta_arr").find('tr.op_' + id + '');
            if (duplicate.length > 0) {
                alert("Peserta sudah ada dalam list");
            } else {
                $("#list_peserta_arr").append(html);
            }

            if (typeof select_peserta_kkn != "undefined") {
                select_peserta_kkn(html);
            }
        } else if (checked == false) {
            let tr = $(this);
            let rm_id = tr.attr("id");

            curr_tr = $("#list_peserta").find("tr.op_" + rm_id + "").attr("id");
            let nx_tr = $("#list_peserta").find("tr.op_" + rm_id + "").nextAll();

            //console.log(nx_tr);

            // let nx_tr = obj.closest("tr").nextAll();
            nx_tr.each(function() {
                let nx_id = $(this).attr("id");
                let val = nx_id - 1;
                let target = $("tr[id=" + nx_id + "]").attr("id", val);
                let ch = $(this).children("td:first-child").html(val);
            })

            $('tr.op_' + id + '').remove();

            let curr_list = $("#list_peserta_arr").find("tr");
            console.log(curr_list);
            if (curr_list.length == 0) {
                let html =
                    '<tr id="no_data"><td colspan="3" style="text-align: center">No Data</td></tr>';
                $("#list_peserta_arr, #list_peserta").append(html);
            }
        }
    });

    cek_mhs();

    function cek_mhs() {
        let curr_list = $("#list_peserta").find("tr");
        $.each(curr_list, function(index, value) {
            let get_id = $(this).attr("class");
            let id = "";
            if (get_id) {
                id = get_id.replace("op_", "");
                if (id) {
                    $(".pilih_peserta[id=" + id + "]").attr("checked", true);
                }

                // let curr_list = $("#list_peserta").find("tr");
                // if(curr_list.length == 0){
                // 	let html = '<tr id="no_data"><td colspan="3" style="text-align: center">No Data</td></tr>';
                // 	$("#list_peserta").append(html);
                // }
            }
        })
    }

    if (typeof remove_list != "undefined") {
        remove_list($(this));
    }

    // $(".op").click(function(){
    // 	// if($('option[value="'+id+'"').dblclick()){
    // 	// 	$('option[value="'+id+'"').remove();
    // 	// }
    // 	//let target = $(this).attr("class"); //.val();
    // 	//alert(target);
    // 	console.log(target);
    // });

});
</script>