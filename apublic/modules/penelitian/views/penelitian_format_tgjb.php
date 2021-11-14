<?php if(isset($penelitian)){
$is_edit=(isset($format));
?>
<form action="<?php echo site_url('penelitian/savecetak') ;?>" method="post" target="_blank" />
<input type="hidden" name="id_penelitian" id="id_penelitian" value="<?php echo $penelitian->id_penelitian;?>" />
<div class="card">
    <div class="card-body">
        <h3 class="border-bottom border-primary text-primary pb-2"><?php echo $title;?></h3>
        <!-- A4 template CSS-->
        <link type="text/css" href="<?php echo base_url();?>asset/css/page_a4_template.css" rel="stylesheet">
        <span class="float-md-right">
            <button type="submit" class="btn btn-sm btn-success" onclick="printDiv('section')"><i class="fa fa-file-pdf-o"></i> Simpan & Cetak</button>
            <button type="button" class="btn btn-sm btn-warning" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button>
        </span>
    </div>
</div>
<div class="py-3" style="overflow:auto;">
    <page size="A4" id="section">
        <p align="center"><strong><u>SURAT PERNYATAAN TANGGUNG JAWAB BELANJA</u></strong></p>
        <p>Yang bertanda tangan di bawah ini :<br/>
             <table>
                 <tr><td style="width:10px">Nama</td><td>: <?php echo $penelitian->nama;?></td></tr>
                 <tr><td style="width:100px">Alamat</td><td>: <?php echo ucwords(strtolower($penelitian->alamat.' '.$penelitian->desa.' '.$penelitian->kecamatan.' '.$penelitian->kotakab));?></td></tr>
            </table>
        </p>
        <p class="justify">
            Berdasarkan Surat Keputusan Nomor
            <input type="text" name="surat_keputusan"  id="surat_keputusan" value="<?php echo (!$is_edit) ? '' : $format->no_keputusan;?>" placeholder="...................................." />
            dan Perjanjian / Kontrak Nomor
            <input type="text" name="nomer_kontrak"  id="nomer_kontrak" value="<?php echo (!$is_edit) ? '' : $format->no_kontrak;?>" placeholder="...................................." />
            mendapatkan Anggaran Penelitian <?php echo strtoupper($penelitian->judul_penelitian);?> sebesar
            Rp. <input type="text" name="nominal_dana"  id="nominal_dana" value="<?php echo (!$is_edit) ? $penelitian->dana_disetujui : $format->nominal_dana;?>" placeholder="...................................." />.
        </p>
        <p>
            Dengan ini menyatakan bahwa:
            <ol style="margin-top:-15px;">
                <li>Biaya kegiatan penelitian di bawah ini meliputi :
                    <table class="tabel" width="100%">
                        <tr><th width="8%" style="text-align:center;">NO.</th><th width="72%" style="text-align:center;">URAIAN</th><th width="10%" style="text-align:center;">JUMLAH</th></tr>
                        <tr>
                            <td>1.</td>
                            <td>
                                <strong>Honorarium</strong><br/>
                                <textarea name="ket_honorarium" id="ket_honorarium" style="width:100%;" rows="4"><?php echo (!$is_edit) ? '' : $format->ket_honorarium;?></textarea>
                            </td>
                            <td>
                                <input type="number" name="nominal_honorarium"  id="nominal_honorarium" value="<?php echo (!$is_edit) ? '' : $format->nominal_honorarium;?>" size="10" min="0" placeholder="Rp. ..................................." onblur="hitung();" onkeyup="hitung();" style="text-align:right;"/>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>
                                <strong>Peralatan Penunjang</strong><br/>
                                <textarea name="ket_peralatan_penunjang" id="ket_peralatan_penunjang" style="width:100%;" rows="4"><?php echo (!$is_edit) ? '' : $format->ket_peralatan_penunjang;?></textarea>
                            </td>
                            <td>
                                <input type="number" name="nominal_peralatan_penunjang"  id="nominal_peralatan_penunjang" value="<?php echo (!$is_edit) ? '' : $format->nominal_peralatan_penunjang;?>" size="10" min="0" placeholder="Rp. ..................................." onblur="hitung();" onkeyup="hitung();" style="text-align:right;"/>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>
                                <strong>Bahan Habis Pakai</strong><br/>
                                <textarea name="ket_bhp" id="ket_bhp" style="width:100%;" rows="4"><?php echo (!$is_edit) ? '' : $format->ket_bhp;?></textarea>
                            </td>
                            <td>
                                <input type="number" name="nominal_bhp"  id="nominal_bhp" value="<?php echo (!$is_edit) ? '' : $format->nominal_bhp;?>" size="10" min="0" placeholder="Rp. ..................................." onblur="hitung();" onkeyup="hitung();" style="text-align:right;"/>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>
                                <strong>Perjalanan</strong><br/>
                                <textarea name="ket_perjalanan" id="ket_perjalanan" style="width:100%;" rows="4"><?php echo (!$is_edit) ? '' : $format->ket_perjalanan;?></textarea>
                            </td>
                            <td>
                                <input type="number" name="nominal_perjalanan"  id="nominal_perjalanan" value="<?php echo (!$is_edit) ? '' : $format->nominal_perjalanan;?>" size="10" min="0" placeholder="Rp. ..................................." onblur="hitung();" onkeyup="hitung();" style="text-align:right;" />
                            </td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>
                                <strong>Lain-lain</strong><br/>
                                <textarea name="ket_lain_lain" id="ket_lain_lain" style="width:100%;" rows="4"><?php echo (!$is_edit) ? '' : $format->ket_lain_lain;?></textarea>
                            </td>
                            <td>
                                <input type="number" name="nominal_lain_lain"  id="nominal_lain_lain" value="<?php echo (!$is_edit) ? '' : $format->nominal_lain_lain;?>" size="10" min="0" placeholder="Rp. ..................................." onblur="hitung();" onkeyup="hitung();" style="text-align:right;" />
                            </td>
                        </tr>
                        <tr><td colspan="2" style="text-align:right;"><strong>JUMLAH (Rp. )</strong></td><td><strong><input type="number" name="total_biaya"  id="total_biaya" value="<?php echo (!$is_edit) ? '' : $format->total_biaya;?>" size="10" min="0" readonly placeholder="Rp. ..................................." style="text-align:right;font-weight:bold;"/></td></tr>
                    </table>
                </li>
                <li>Jumlah uang tersebut pada angka 1, benar-benar dikeluarkan untuk pelaksanaan kegiatan penelitian dimaksud.</li>
                <li>Bersedia menyimpan dengan baik seluruh bukti pengeluaran belanja yang telah dilaksanakan.</li>
                <li>Bersedia untuk dilakukan pemeriksaan terhadap bukti-bukti pengeluaran oleh aparat pengawas fungsional Pemerintah</li>
                <li>Apabila di kemudian hari, pernyataan yang saya buat ini mengakibatkan kerugian Negara maka saya bersedia dituntut penggantian kerugian negara dimaksud sesuai dengan ketentuan peraturan perundang-undangan.</li>
            </ol>
        </p>
        <p>Demikian surat pernyataan ini dibuat dengan sebenarnya.</p>
        <p style="text-align:center; margin-left:350px;">
            <input type="text" name="tgl_pengesahan"  id="tgl_pengesahan" size="30" value="<?php echo (!$is_edit) ? "": $format->tgl_pengesahan;?>" placeholder="Malang, ..................2018" /><br/>
            Ketua,<br/><br/><br/><br/>
            <u><strong>( <?php echo $penelitian->nama;?> )</strong></u><br/>
            NIP/NIK. <input type="text" name="nik_nip"  id="nik_nip" value="<?php echo (!$is_edit) ? "": $format->nik_nip;?>" placeholder="...................................." /><br/>
        </p>
    </page>
</div>
</form>
<script>
function hitung(){
    var t=0;
    var a=parseFloat($("#nominal_honorarium").val()); if(isNaN(a)) a=0;
    var b=parseFloat($("#nominal_peralatan_penunjang").val()); if(isNaN(b)) b=0;
    var c=parseFloat($("#nominal_bhp").val()); if(isNaN(c)) c=0;
    var d=parseFloat($("#nominal_perjalanan").val()); if(isNaN(d)) d=0;
    var e=parseFloat($("#nominal_lain_lain").val()); if(isNaN(e)) e=0;
    var t=a+b+c+d+e;
    $("#total_biaya").val(t);
}
</script>
<?php }else{ ;?>
    <div class="card">
        <div class="card-body">
            <h3 class="text-danger pb-2">Maaf data tidak ditemukan....!</h3>
            <button class="btn btn-sm btn-warning" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button>
        </div>
    </div>
<?php };?>
