<?php if(isset($penelitian)){
$is_edit=(isset($format));
if($is_edit){

    /* Break content */
    $conten=array();
    $conten=(!$is_edit) ? '' : json_decode($format->content);
    //var_dump($conten);
?>
<form  method="post" name="saveform" id="saveform" />
<input type="hidden" name="id_ctk" id="id_ctk" value="<?php echo (!$is_edit) ? '' : $format->id_ctk;?>" />
<input type="hidden" name="id_penelitian" id="id_penelitian" value="<?php echo (!$is_edit) ? $penelitian->id_penelitian : $format->id_penelitian;?>" />
<div class="card">
    <div class="card-body">
        <h3 class="border-bottom border-primary text-primary pb-2"><?php echo $title;?></h3>
        <!-- A4 template CSS-->
        <link type="text/css" href="<?php echo base_url();?>asset/css/page_a4_template.css" rel="stylesheet">
        <span class="float-md-right">
            <!-- <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Simpan</button> -->
            <a href="<?php echo site_url('nilairev/cetakpdf/'.$penelitian->id_penelitian.'/'.$conten->id_reviewer);?>" target="_blank" class="btn btn-sm btn-primary" ><i class="fa fa-file-pdf-o"></i> Cetak PDF</a>
            <button type="button" class="btn btn-sm btn-warning" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button>
        </span>
    </div>
</div>

<div class="py-3" style="overflow:auto;">
    <page size="A4" id="section">
        <p align="center"><strong><u>BERITA ACARA REVIEW PROPOSAL HIBAH INTERNAL</u></strong></p>
        <p>Pada hari ini &nbsp;<strong><?php echo (!$is_edit) ? '' : $conten->hari;?></strong>&nbsp; tanggal &nbsp;<strong><?php echo $conten->tgl;?></strong>&nbsp;
            bulan &nbsp;<strong><?php
            $b=array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
            foreach ($b as $key => $value) {
                if($key==$conten->bln){
                    echo $value;
                }
            }
            ;?></strong>&nbsp;
            tahun &nbsp;<strong><?php echo (!$is_edit) ? date("Y") : $conten->thn;?></strong>&nbsp; telah dilaksanakan review atas Proposal Penelitian Hibah Internal atas nama berikut:<br/>
             <table width="100%" cellspacing="0" cellpadding="3">
                 <tr><td style="width:23%">Nama Ketua Pengusul</td><td width="2%">:</td><td width="70%"><?php echo $penelitian->nama_lookup;?></td></tr>
                 <tr><td style="width:23%; vertical-align: text-top;">Judul Proposal</td><td width="2%" style="width:2%; vertical-align: text-top;">:</td><td width="70%"><?php echo $penelitian->judul_penelitian;?></td></tr>
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
                    <td class="text-center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai1;?>
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
                    <td class="text-center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai2;?>
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
                    <td class="text-center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai3;?>
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
                    <td class="text-center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai4;?>
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
                    <td class="text-center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai5;?>
                    </td>
                </tr>
                <tr><td colspan="2" style="text-align:center;"><strong>JUMLAH</strong></td><td class="text-center"><strong><?php echo (!$is_edit) ? '' : $conten->total_nilai;?></td></tr>
            </table>
        </p>
        <?php
            $sl=(!$is_edit) ? '' : $conten->status_layak;
            if($sl=="LAYAK"){
                $st2=' style="text-decoration:line-through;" '; $st1="";
            }else
            if($sl=="TIDAK LAYAK"){
                $st1=' style="text-decoration:line-through;" '; $st2="";
            }else{
                $st2=""; $st1="";
            }
        ?>
        <p>Berdasarkan komponen penilaian diatas, proposal tersebut dinyatakan <span <?php echo $st1;?> >LAYAK</span> / <span <?php echo $st2;?>>TIDAK LAYAK</span> untuk lolos Program Penelitian Hibah Internal.</p>
        <p style="text-align:center; margin-left:350px;">
            Malang, <?php echo (!$is_edit) ? "": $conten->tgl_pengesahan;?><br/>
            Reviewer,<br/><br/><br/><br/><br/>
            <u><strong>( <?php echo (!$is_edit) ? ".......................": $conten->nama_reviewer;?> )</strong></u><br/>
            NIP/NIK. <?php echo (!$is_edit) ? "": $conten->nik_nip;?><br/>
        </p>
    </page>
    <page size="A4" id="section2">
        <h4>Saran dan Koreksi</h4>
        <div style="border:1px solid #464646; padding:15px; min-height:200px;"><?php echo (!$is_edit) ? "": $conten->saran_reviewer;?></div>
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

</script>
<?php
    }else{
        echo '<div class="card">
            <div class="card-body">
                <h3 class="text-danger pb-2">Maaf belum ada hasil Penialaian Reviewer!</h3>
                <button class="btn btn-sm btn-warning" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button>
            </div>
        </div>';
    };
}else{ ;?>
    <div class="card">
        <div class="card-body">
            <h3 class="text-danger pb-2">Maaf data tidak ditemukan....!</h3>
            <button class="btn btn-sm btn-warning" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button>
        </div>
    </div>
<?php };?>
