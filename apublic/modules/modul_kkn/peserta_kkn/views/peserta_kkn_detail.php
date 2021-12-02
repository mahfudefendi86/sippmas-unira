<?php
$is_edit = (isset($peserta_kkn));
?>
<div class="card p-3 mb-3">

    <input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $peserta_kkn->id_peserta; ?>" name="kknn_id_peserta" id="kknn_id_peserta" placeholder="Id Peserta"   />
    <table class="table table-borderless table-sm">
        <tbody>
            <tr>
                <th>Nama Lengkap</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->nama_mhs;?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->email;?></td>
            </tr>
            <tr>
                <th>No. HP</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->hp;?></td>
            </tr>
            <tr>
                <th>NIM</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->nim;?></td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td width="10">:</td>
                <td><?=($peserta_kkn->jenis_kelamin == "L") ? "Laki-laki" : "Perempuan";?></td>
            </tr>
            <tr>
                <th>Tempat Lahir</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->tempat_lahir;?></td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td width="10">:</td>
                <td><?=tgl_indo($peserta_kkn->tgl_lahir);?></td>
            </tr>
            <tr>
                <th>Usia</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->usia;?> tahun</td>
            </tr>
            <tr>
                <th>Alamat Domisili</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->alamat_domisili;?></td>
            </tr>
            <tr>
                <th>Provinsi</th>
                <td width="10">:</td>
                <td><?=nama_provinsi($peserta_kkn->provinsi);?></td>
            </tr>
            <tr>
                <th>Kota</th>
                <td width="10">:</td>
                <td><?=ucwords(strtolower(nama_kota($peserta_kkn->kota)));?></td>
            </tr>
            <tr>
                <th>Kecamatan</th>
                <td width="10">:</td>
                <td><?=nama_kecamatan($peserta_kkn->kecamatan);?></td>
            </tr>
            <tr>
                <th>Kelurahan</th>
                <td width="10">:</td>
                <td><?=nama_kelurahan($peserta_kkn->kelurahan);?></td>
            </tr>
            <tr>
                <th>Fakultas</th>
                <td width="10">:</td>
                <td><?=ucwords(strtolower(nama_fakultas($peserta_kkn->id_fakultas)));?></td>
            </tr>
            <tr>
                <th>Prodi</th>
                <td width="10">:</td>
                <td><?=ucwords(strtolower(nama_prodi($peserta_kkn->id_prodi)));?></td>
            </tr>
            <tr>
                <th>Kondisi Kesehatan</th>
                <td width="10">:</td>
                <td><?=($peserta_kkn->kesehatan == "baik") ? "Baik" : "Kurang Baik";?></td>
            </tr>
            <tr>
                <th>Penyakit Diderita</th>
                <td width="10">:</td>
                <td><?=($peserta_kkn->penyakit_diderita == "memiliki") ? "Memiliki" : "Tidak Memiliki";?></td>
            </tr>
            <tr>
                <th>Memiliki Istri/Suami/Anak</th>
                <td width="10">:</td>
                <td><?=implode(", ", json_decode($peserta_kkn->keluarga, true));?></td>
            </tr>
            <tr>
                <th>Sedang Hamil</th>
                <td width="10">:</td>
                <td><?=($peserta_kkn->is_hamil == "Y") ? "Ya" : "Tidak";?></td>
            </tr>
            <tr>
                <th>Sedang Bekerja</th>
                <td width="10">:</td>
                <td><?=($peserta_kkn->is_kerja == "Y") ? "Ya" : "Tidak";?></td>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->pekerjaan;?></td>
            </tr>
            <tr>
                <th>Status Pekerjaan</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->status_pekerjaan;?></td>
            </tr>
            <tr>
                <th>Alamat Kerja</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->alamat_kerja;?></td>
            </tr>
            <tr>
                <th>Ukuran Jaket</th>
                <td width="10">:</td>
                <td><?=$peserta_kkn->ukuran_jaket;?></td>
            </tr>
            <tr>
                <th>Berkas Pembayaran</th>
                <td width="10">:</td>
                <td>
                    <?php if (isset($peserta_kkn->berkas) && $peserta_kkn->berkas != ""): ?>
                        <a id="berkas" class="iframe" href="<?=base_url('asset/uploads/berkas/pembayaran_kkn/' . $peserta_kkn->berkas);?>" ><img src="<?=base_url('asset/imgext/File-PDF-Acrobat-icon.png');?>"/> <?=$peserta_kkn->berkas;?></a>
                    <?php else: ?>
                        <p style="color: red">Berkas belum diupload</p>
                    <?php endif;?>
                </td>
            </tr>
        </tbody>
    </table>

<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<div class="col-md-4 col-lg-4 col-sm-12 m-1">
                    <?php $is_disabled = (isset($peserta_kkn->berkas) && $peserta_kkn->berkas != "") ? "" : "disabled";?>
                    <?php if ($akun_kkn->status == "NONAKTIF"): ?>
						<button type="submit" class="btn btn-success btn-lg col-12 validasi" rel="set_aktif/<?php echo $peserta_kkn->id_peserta; ?>" <?=$is_disabled;?>><span class="fa fa-check"></span> Aktifkan</button>
					<?php elseif ($akun_kkn->status == "AKTIF"): ?>
                        <button type="submit" class="btn btn-danger btn-lg col-12 validasi" rel="set_nonaktif/<?php echo $peserta_kkn->id_peserta; ?>" <?=$is_disabled;?>><span class="fa fa-remove"></span> Nonaktifkan</button>
                    <?php endif;?>
                    </div>
					<div class="col-md-4 col-lg-4 col-sm-12 m-1">
						<button type="reset"  class="btn btn-warning btn-lg col-12" onclick="$('#modalView_peserta_kkn').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
					</div>
				</div>
			</div>
		</div>

</div>

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

<script>
    $(".validasi").click(function(){
		var id=$(this).attr("rel");
		$.ajax({
			url       : "<?php echo site_url('validasi/peserta/kkn'); ?>/"+id,
			dataType  : "html",
			beforeSend: function(){
							$("#ajax_loader").fadeIn(100);
			},
			success   : function(data){
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
		});
	});
</script>

