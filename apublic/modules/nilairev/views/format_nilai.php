<?php if(isset($penelitian)){
$is_edit=(isset($format));
?>
<form action="<?php echo site_url('nilairev/savecetak') ;?>" method="post" name="saveform" id="saveform" />
<input type="hidden" name="id_ctk" id="id_ctk" value="<?php echo (!$is_edit) ? '' : $format->id_ctk;?>" />
<input type="hidden" name="id_penelitian" id="id_penelitian" value="<?php echo (!$is_edit) ? $penelitian->id_penelitian : $format->id_penelitian;?>" />
<div class="card">
    <div class="card-body">
        <h3 class="border-bottom border-primary text-primary pb-2"><?php echo $title;?></h3>
        <!-- A4 template CSS-->
        <link type="text/css" href="<?php echo base_url();?>asset/css/page_a4_template.css" rel="stylesheet">
        <span class="float-md-right">
            <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Simpan</button>
            <a href="<?php echo site_url('nilairev/cetakpdf/'.$penelitian->id_penelitian);?>" target="_blank" class="btn btn-sm btn-primary" ><i class="fa fa-file-pdf-o"></i> Cetak PDF</a>
            <button type="button" class="btn btn-sm btn-warning" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button>
        </span>
    </div>
</div>
<?php
    /* Break content */
    $conten=array();
    $conten=(!$is_edit) ? '' : json_decode($format->content);
    //var_dump($conten);
?>
<div class="py-3" style="overflow:auto;">
    <page size="A4" id="section">
        <p align="center"><strong><u>BERITA ACARA REVIEW PROPOSAL HIBAH INTERNAL</u></strong></p>
        <p>Pada hari ini <input type="text" name="hari" id="hari" placeholder="Hari" value="<?php echo (!$is_edit) ? '' : $conten->hari;?>"/> tanggal
            <select name="tgl" id="tgl" >
                <option value=""> pilih </option>
                <?php
                    for($x=1;$x<=31;$x++){
                        if($x<10){ $x="0".$x;};
                        if($x==((!$is_edit) ? '' :$conten->tgl)){
                            echo '<option value="'.$x.'" selected>'.$x.'</option>';
                        }else{
                            echo '<option value="'.$x.'">'.$x.'</option>';
                        }
                    }
                ?>
            </select>
            bulan
            <select name="bulan" id="bulan" >
                <option value=""> pilih </option>
                <?php
                    $b=array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
                    foreach ($b as $key => $value) {
                        if($key==((!$is_edit) ? '' :$conten->bln)){
                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                        }else{
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                    }
                ?>
            </select>
            tahun <input type="text" name="tahun" id="tahun" placeholder="Tahun" size="10" value="<?php echo (!$is_edit) ? date("Y") : $conten->thn;?>"/> telah dilaksanakan review atas Proposal Penelitian Hibah Internal atas nama berikut:<br/>
             <table width="100%" cellspacing="0" cellpadding="3">
                 <tr><td style="width:23%">Nama Ketua Pengusul</td><td width="2%">:</td><td width="70%"><?php echo $penelitian->nama_lookup;?></td></tr>
                 <tr><td style="width:23%">Judul <?php echo ucfirst(strtolower($penelitian->jenis_usulan));?></td><td width="2%">:</td><td width="70%"><?php echo $penelitian->judul_penelitian;?></td></tr>
                 <tr><td style="width:23%">Skema <?php echo ucfirst(strtolower($penelitian->jenis_usulan));?></td><td width="2%">:</td><td width="70%"><?php echo $penelitian->nama_skema_lookup;?></td></tr>
            </table>
        </p>
        <p class="justify">
            Komponen Penilaian<br/>
            <table class="tabel" width="100%">
                <tr><th width="8%" style="text-align:center;">NO.</th><th width="62%" style="text-align:center;">Kriteria Penilain</th><th width="20%" style="text-align:center;">Bobot (%)</th></tr>
                <tr>
                    <td>1.</td>
                    <td>
                        Masalah yang diteliti:
                        <ol>
                            <li>Kontribusi pada IPTEK</li>
                            <li>Perumusan Masalah</li>
                            <li>Tinjauan Pustaka</li>
                        </ol>
                    </td>
                    <td>
                        <input type="text" name="nilai1"  id="nilai1" value="<?php echo (!$is_edit) ? '' : $conten->nilai1;?>" min="0" placeholder="Maksimal 15" onblur="hitung();" onkeyup="hitung();" />
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>
                        Orientasi Penelitian:
                        <ol>
                            <li>Kesesuaian dengan Pilar/Bidang Unggulan UNIRA</li>
                            <li>Makna Ilmiah</li>
                            <li>Orisinalitas dan Kemutakhiran</li>
                        </ol>
                    </td>
                    <td>
                        <input type="text" name="nilai2"  id="nilai2" value="<?php echo (!$is_edit) ? '' : $conten->nilai2;?>" min="0" placeholder="Maksimal 30" onblur="hitung();" onkeyup="hitung();" />
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>
                        Metode Penelitian:
                        <ol>
                            <li>Pola Pendekatan Ilmiah</li>
                            <li>Kesesuaian Metode</li>
                        </ol>
                    </td>
                    <td>
                        <input type="text" name="nilai3"  id="nilai3" value="<?php echo (!$is_edit) ? '' : $conten->nilai3;?>" min="0" placeholder="Maksimal 15" onblur="hitung();" onkeyup="hitung();" />
                    </td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>
                        Luaran Penelitian:
                        <ol>
                            <li>Publikasi Ilmiah</li>
                            <li>Teori/Hipotesis Baru</li>
                            <li>Metode Baru dan Informasi/Desain baru</li>
                        </ol>
                    </td>
                    <td>
                        <input type="text" name="nilai4"  id="nilai4" value="<?php echo (!$is_edit) ? '' : $conten->nilai4;?>" min="0" placeholder="Maksimal 30" max="30" onblur="hitung();" onkeyup="hitung();"  />
                    </td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>
                        Kelayakan Sumberdaya:
                        <ol>
                            <li>Peneliti</li>
                            <li>Peralatan</li>
                            <li>Rencana Jadwal dan Rencana Biaya</li>
                        </ol>
                    </td>
                    <td>
                        <input type="text" name="nilai5"  id="nilai5" value="<?php echo (!$is_edit) ? '' : $conten->nilai5;?>" min="0" placeholder="Maksimal 10" onblur="hitung();" onkeyup="hitung();" />
                    </td>
                </tr>
                <tr><td colspan="2" style="text-align:center;"><strong>JUMLAH</strong></td><td><strong><input type="text" name="total_nilai"  id="total_nilai" value="<?php echo (!$is_edit) ? '' : $conten->total_nilai;?>" min="0" readonly placeholder="Maksimal 100" style="font-weight:bold;"/></td></tr>
            </table>
        </p>
        <?php
            $sl=(!$is_edit) ? '' : $conten->status_layak;
            if($sl=="LAYAK"){
                $st1="checked"; $st2="";
            }else
            if($sl=="TIDAK LAYAK"){
                $st2="checked"; $st1="";
            }else{
                $st2=""; $st1="";
            }
        ?>
        <p>Berdasarkan komponen penilaian diatas, proposal tersebut dinyatakan <label><input type="radio" name="status_layak" id="status1" value="LAYAK" <?php echo $st1;?> />LAYAK</label> / <label><input type="radio" name="status_layak" id="status2" <?php echo $st2;?> value="TIDAK LAYAK"/>TIDAK LAYAK</label> untuk lolos Program Penelitian Hibah Internal.</p>
        <p style="text-align:center; margin-left:350px;">
            Malang, <input type="text" name="tgl_pengesahan"  id="tgl_pengesahan" size="20" value="<?php echo (!$is_edit) ? "": $conten->tgl_pengesahan;?>" placeholder="..................2018" /><br/>
            Reviewer,<br/><br/><br/><br/>
            <u><strong>( <?php echo (!$is_edit) ? $this->session->userdata("nama"): $conten->nama_reviewer;?> )</strong></u><br/>
            <input type="hidden" name="nama_reviewer" id="nama_reviewer" value="<?php echo (!$is_edit) ? $this->session->userdata("nama"): $conten->nama_reviewer;?>" />
            <input type="hidden" name="id_reviewer" id="id_reviewer" value="<?php echo (!$is_edit) ? $this->session->userdata("id_user"): $conten->id_reviewer;?>" />
            NIP/NIK. <input type="text" name="nik_nip"  id="nik_nip" value="<?php echo (!$is_edit) ? "": $conten->nik_nip;?>" placeholder="...................................." /><br/>
        </p>
    </page>
    <page size="A4" id="section2">
        <h4>Saran dan Koreksi</h4>
        <textarea name="saran" id="saran" rows="15" placeholder="Saran dan Koreksi Reviewer" style="width:100%;"><?php echo (!$is_edit) ? "": $conten->saran_reviewer;?></textarea>
    </page>
</div>
</form>

<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
function hitung(){
    var t=0;
    var a=parseFloat($("#nilai1").val()); if(isNaN(a)) a=0;
    var b=parseFloat($("#nilai2").val()); if(isNaN(b)) b=0;
    var c=parseFloat($("#nilai3").val()); if(isNaN(c)) c=0;
    var d=parseFloat($("#nilai4").val()); if(isNaN(d)) d=0;
    var e=parseFloat($("#nilai5").val()); if(isNaN(e)) e=0;
    var t=a+b+c+d+e;
    $("#total_nilai").val(t);
}

$("#saveform").validate({
           errorClass: "is-invalid",
           validClass: "is-valid",
           wrapper: "span",
           rules:{
               hari: { required: true },
               tgl: { required: true },
               bulan: { required: true },
               tahun: { required: true },
               nilai1: { required: true, max: 15, number:true},
               nilai2: { required: true, max: 30, number:true},
               nilai3: { required: true, max: 15, number:true},
               nilai4: { required: true,  max: 30, number:true },
               nilai5: { required: true, max: 10, number:true },
               status_layak:{required:true}
               },
           messages:{
               hari: "Hari masih belum diisi....",
               tgl: "Tanggal belum dipilih....",
               bulan: "Bulan belum dipilih...",
               tahun: "Tahun belum diisi...",
               nilai1: {required:"Wajib diisi...", max:"Bobot maksimal adalah 15", number:"Hanya boleh berupa angka..."},
               nilai2: {required:"Wajib diisi...", max:"Bobot maksimal adalah 30", number:"Hanya boleh berupa angka..."},
               nilai3: {required:"Wajib diisi...", max:"Bobot maksimal adalah 15", number:"Hanya boleh berupa angka..."},
               nilai4: {required:"Wajib diisi...", max:"Bobot maksimal adalah 30", number:"Hanya boleh berupa angka..."},
               nilai5: {required:"Wajib diisi...", max:"Bobot maksimal adalah 10", number:"Hanya boleh berupa angka..."},
               status_layak:"Wajib dipilih..."
           },
           submitHandler: function() {
               return true;
        }
    });
</script>
<?php }else{ ;?>
    <div class="card">
        <div class="card-body">
            <h3 class="text-danger pb-2">Maaf data tidak ditemukan....!</h3>
            <button class="btn btn-sm btn-warning" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button>
        </div>
    </div>
<?php };?>
