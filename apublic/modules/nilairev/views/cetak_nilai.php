<?php if(isset($penelitian)){
$is_edit=(isset($format));
?>

<?php
    /* Break content */
    $conten=array();
    $conten=(!$is_edit) ? '' : json_decode($format->content);
    //var_dump($conten);
?>
<style type="text/css" media="print">
@page{
    size: 8.27in 11.69in; /* <length>{1,2} | auto | portrait | landscape */
	      /* 'em' 'ex' and % are not allowed; length values are width height */
	margin-left: 15mm; /* <any of the usual CSS values for margins> */
    margin-right: 10mm;
	margin-top: 35mm;
    margin-bottom: 5mm;
}
#section2{
page-break-before: always;
}
</style>
    <page size="A4" id="section">
        <p align="center"><strong><u>BERITA ACARA REVIEW PROPOSAL HIBAH INTERNAL</u></strong></p>
        <p>Pada hari ini <strong><?php echo (!$is_edit) ? '' : $conten->hari;?></strong> tanggal <strong><?PHP echo (!$is_edit) ? '' :$conten->tgl;?></strong>
           bulan <strong>
                <?php
                    $b=array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
                    foreach ($b as $key => $value) {
                        if($key==((!$is_edit) ? '' :$conten->bln)){
                            echo $value;
                        }
                    }
                ?></strong>
            tahun <strong><?php echo (!$is_edit) ? "" : $conten->thn;?></strong> telah dilaksanakan review atas Proposal Penelitian Hibah Internal atas nama berikut:<br/>

            <table width="100%" cellspacing="0" cellpadding="3">
                <tr><td style="width:23%">Nama Ketua Pengusul</td><td width="2%">:</td><td width="70%"><?php echo $penelitian->nama_lookup;?></td></tr>
                <tr><td style="width:23%; vertical-align: text-top;">Judul <?php echo ucfirst(strtolower($penelitian->jenis_usulan));?></td><td width="2%" style="width:2%; vertical-align: text-top;">:</td><td width="70%"><?php echo $penelitian->judul_penelitian;?></td></tr>
                <tr><td style="width:23%; vertical-align: text-top;">Skema <?php echo ucfirst(strtolower($penelitian->jenis_usulan));?></td><td width="2%" style="width:2%; vertical-align: text-top;">:</td><td width="70%"><?php echo $penelitian->nama_skema_lookup;?></td></tr>
           </table>

            <h4>Komponen Penilaian</h4>
            <table width="100%" cellpadding="5" border="1" cellspacing="0">
                <tr><th width="8%" style="text-align:center;">NO.</th><th width="62%" style="text-align:center;">Kriteria Penilain</th><th width="20%" style="text-align:center;">Bobot (%)</th></tr>
                <tr>
                    <td align="center">1.</td>
                    <td>
                        <strong>Masalah yang diteliti:</strong>
                        <ol>
                            <li>Kontribusi pada IPTEK</li>
                            <li>Perumusan Masalah</li>
                            <li>Tinjauan Pustaka</li>
                        </ol>
                    </td>
                    <td align="center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai1;?>
                    </td>
                </tr>
                <tr>
                    <td align="center">2.</td>
                    <td>
                        <strong>Orientasi Penelitian:</strong>
                        <ol>
                            <li>Kesesuaian dengan Pilar/Bidang Unggulan UNIRA</li>
                            <li>Makna Ilmiah</li>
                            <li>Orisinalitas dan Kemutakhiran</li>
                        </ol>
                    </td>
                    <td align="center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai2;?>
                    </td>
                </tr>
                <tr>
                    <td align="center">3.</td>
                    <td>
                        <strong>Metode Penelitian:</strong>
                        <ol>
                            <li>Pola Pendekatan Ilmiah</li>
                            <li>Kesesuaian Metode</li>
                        </ol>
                    </td>
                    <td align="center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai3;?>
                    </td>
                </tr>
                <tr>
                    <td align="center">4.</td>
                    <td>
                        <strong>Luaran Penelitian:</strong>
                        <ol>
                            <li>Publikasi Ilmiah</li>
                            <li>Teori/Hipotesis Baru</li>
                            <li>Metode Baru dan Informasi/Desain baru</li>
                        </ol>
                    </td>
                    <td align="center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai4;?>
                    </td>
                </tr>
                <tr>
                    <td align="center">5.</td>
                    <td>
                        <strong>Kelayakan Sumberdaya:</strong>
                        <ol>
                            <li>Peneliti</li>
                            <li>Peralatan</li>
                            <li>Rencana Jadwal dan Rencana Biaya</li>
                        </ol>
                    </td>
                    <td align="center">
                        <?php echo (!$is_edit) ? '' : $conten->nilai5;?>
                    </td>
                </tr>
                <tr><td colspan="2" style="text-align:center;"><strong>JUMLAH</strong></td><td align="center"><strong><?php echo (!$is_edit) ? '' : $conten->total_nilai;?></td></tr>
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
    <page size="A4" >
        <h4 id="section2">Saran dan Koreksi</h4>
        <div style="border:1px solid #464646; padding:15px; min-height:200px;"><?php echo (!$is_edit) ? "": $conten->saran_reviewer;?></div>
    </page>

<?php }else{ ;?>
    <div class="card">
        <div class="card-body">
            <h3 class="text-danger pb-2">Maaf data tidak ditemukan....!</h3>
            <button class="btn btn-sm btn-warning" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button>
        </div>
    </div>
<?php };?>
