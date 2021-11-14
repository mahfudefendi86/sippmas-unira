<?php if(isset($penelitian)){
?>
<style>
    #section, p, span, table, div{
        font-family: 'ctimes';
        font-size: 11.5pt;
    }

    th{
        background-color: #e6eaf9;
        text-align:center;
        font-weight: bold;
    }
    td{
        vertical-align: text-top;
    }
    .judul{
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 7px;
    }
    .item_judul{
        margin-bottom: 3px;
    }
    table.tbl {
      border-collapse: collapse;
      border: 1px solid black;
      margin-bottom: 15px;
    }

    table.tbl td, table.tbl th {
      border: 1px solid black;
      padding: 3px 10px;
    }
</style>
    <page size="A4" id="section" style="font-family:'ctimes';">
        <p align="center" ><strong><u>FORMULIR EVALUASI ATAS CAPAIAN LUARAN KEGIATAN</u></strong></p>
             <table cellpadding="3" border="0" cellspacing="0" width="100%">
                 <tr><td style="width:23%">Nama</td><td style="width:2%">:</td><td style="width:74%"><?php echo $penelitian->nama_lookup;?></td></tr>
                 <tr><td style="width:23%">Perguruan Tinggi</td><td style="width:2%">:</td><td style="width:74%">Universitas Islam Raden Rahmat</td></tr>
                 <tr><td style="width:23%">Judul</td><td style="width:2%">:</td><td style="width:74%;"><?php echo $penelitian->judul_penelitian;?></td></tr>
                 <tr><td style="width:23%">Skema</td><td style="width:2%">:</td><td style="width:74%"><?php echo $penelitian->nama_skema_lookup;?></td></tr>
                 <tr><td style="width:23%">Tahun anggaran</td><td style="width:2%">:</td><td style="width:74%"><?php echo $penelitian->tahun_anggaran_lookup;?></td></tr>
            </table>
        <br/><br/>
        <div class="judul" >LUARAN YANG DIRENCANAKAN DAN JUMLAH CAPAIAN</div>
        <table class="tbl"  cellpadding="3" border="0" cellspacing="0" width="100%">
            <tr><th width="10%">No.</th><th width="70%">Luaran yang Direncanakan</th><th width="22%">Jumlah Capaian</th></tr>
            <?php if(isset($jumlah) && count($jumlah)>0){ ;?>
            <?php if($jumlah->jumlah_jurnal>0){ echo '<tr><td>1.</td><td>Publikasi ilmiah</td><td align="center">'.$jumlah->jumlah_jurnal.'</td></tr>';}?>
            <?php if($jumlah->jumlah_buku>0){ echo '<tr><td>2.</td><td>Buku/Bahan Ajar</td><td align="center">'.$jumlah->jumlah_buku.'</td></tr>';}?>
            <?php if($jumlah->jumlah_seminar>0){ echo '<tr><td>3.</td><td>Artikel ilmiah dimuat di prosiding (Pemakalah)</td><td align="center">'.$jumlah->jumlah_seminar.'</td></tr>';}?>
            <?php if($jumlah->jumlah_lain>0){ echo '<tr><td>4.</td><td>Karya Tulis Ilmiah</td><td align="center">'.$jumlah->jumlah_lain.'</td></tr>';}?>
            <?php };?>
        </table>
        <br/>
        <div class="judul">CAPAIAN DISERTAI DENGAN LAMPIRAN BUKTI-BUKTI LUARAN KEGIATAN</div>

        <div class="item_judul">1. PUBLIKASI ILMIAH</div>
        <table  class="tbl" cellspacing="0" width="100%">
            <thead>
                <tr><th width="30%"></th><th width="70%">Keterangan</th></tr>
            </thead>
            <tbody>
                <?php if(isset($jurnal) && count($jurnal)>0){
                    $nj=0;
                    foreach ($jurnal as $jurnalview) {
                        $nj++;
                ;?>
                <tr><td colspan="2" style="border-top:3px solid #4d4d4d; padding:6px;"><strong>Artikel jurnal ke-<?php echo $nj;?></strong></td></tr>
                <tr><td>Nama jurnal yang dituju</td><td><?php echo $jurnalview->nama_jurnal;?></td></tr>
                <tr><td>Klasifikasi jurnal</td><td><?php echo $jurnalview->klasifkasi_jurnal;?></td></tr>
                <tr><td>Impact faktor jurnal</td><td><?php echo $jurnalview->impact_faktor;?></td></tr>
                <tr><td>Judul artikel</td><td><?php echo $jurnalview->judul_artikel;?></td></tr>
                <tr><td>Status Naskah</td><td><?php echo $jurnalview->status_naskah;?></td></tr>
                <?php
                    }
                }else{
                    echo '<tr><td colspan="2">- tidak ada -</td></tr>';
                };?>
            </tbody>
        </table>

        <div class="item_judul">2. BUKU AJAR</div>
        <table  class="tbl" cellpadding="3" border="0" cellspacing="0" width="100%">
            <thead>
                <tr><th width="30%"></th><th width="70%">Keterangan</th></tr>
            </thead>
            <tbody>
                <?php if(isset($buku) && count($buku)>0){
                    $nb=0;
                    foreach ($buku as $bukuview) {
                        $nb++;
                ;?>
                <tr><td colspan="2" style="border-top:3px solid #4d4d4d;padding:6px;"><strong>Buku ajar ke-<?php echo $nb;?></strong></td></tr>
                <tr><td>Judul buku</td><td><?php echo $bukuview->judul_buku;?></td></tr>
                <tr><td>Penulis</td><td><?php echo $bukuview->penulis;?></td></tr>
                <tr><td>Penerbit</td><td><?php echo $bukuview->penerbit;?></td></tr>
                <tr><td>Nomer ISBN</td><td><?php echo $bukuview->no_isbn;?></td></tr>
                <?php
                    }
                }else{
                    echo '<tr><td colspan="2">- tidak ada -</td></tr>';
                };?>
            </tbody>
        </table>

        <div class="item_judul">3. PEMBICARA PADA PERTEMUAN ILMIAH (SEMINAR/SIMPOSIUM)</div>
        <table  class="tbl" cellpadding="3" border="0" cellspacing="0" width="100%">
            <thead>
                <tr><th width="30%"></th><th width="70%">Keterangan</th></tr>
            </thead>
            <tbody>
                <?php if(isset($seminar) && count($seminar)>0){
                    $ns=0;
                    foreach ($seminar as $seminarview) {
                        $ns++;
                ;?>
                <tr><td colspan="2" style="border-top:3px solid #4d4d4d;padding:6px;"><strong>Pertemuan ilmiah ke-<?php echo $ns;?></strong></td></tr>
                <tr><td>Nama pertemuan</td><td><?php echo $seminarview->nama_pertemuan ;?></td></tr>
                <tr><td>Jenis pertemuan</td><td><?php echo $seminarview->jenis_pertemuan ;?></td></tr>
                <tr><td>Tempat dan Tanggal</td><td><?php echo $seminarview->tempat.' | '.tgl_indo($seminarview->tanggal) ;?></td></tr>
                <tr><td>Judul makalah</td><td><?php echo $seminarview->judul_makalah ;?></td></tr>
                <tr><td>Status makalah</td><td><?php echo $seminarview->status_makalah ;?></td></tr>
                <?php
                    }
                }else{
                    echo '<tr><td colspan="2">- tidak ada -</td></tr>';
                };?>
            </tbody>
        </table>

        <div class="item_judul" style="page-break-inside: avoid;">4. CAPAIAN LUARAN LAINNYA</div>
        <table  class="tbl" cellpadding="3" border="0" cellspacing="0" width="100%">
            <thead>
                <tr><th width="35%">Capaian</th><th width="65%">Uraian</th></tr>
            </thead>
            <tbody>
                <?php if(isset($lain) && count($lain)>0){
                    $nl=0;
                    foreach ($lain as $lainview) {
                        $nl++;
                ;?>
                <tr><td><?php echo $nl.'. '.$lainview->jenis_luaran ;?></td><td><?php echo $lainview->urain ;?></td></tr>
                <?php
                    }
                }else{
                    echo '<tr><td colspan="2">- tidak ada -</td></tr>';
                };?>
            </tbody>
        </table>
        <br/>
        <table  width="100%">
            <tr><td width="70%"></td>
            <td align="center" width="30%">
                Malang, <?php echo tgl_indo(date('Y-m-d'));?><br/>
                Ketua,<br/><br/><br/><br/><br/>
                <div style="padding:3px;">( <u><?php echo $penelitian->nama_lookup;?></u> )</div>
            </td>
            </tr>
        </table>
    </page>

<?php }else{ ;?>
    <div class="card">
        <div class="card-body">
            <h3 class="text-danger pb-2">Maaf data tidak ditemukan....!</h3>
            <button class="btn btn-sm btn-warning" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button>
        </div>
    </div>
<?php };?>
