<?php if(isset($penelitian)){
$is_edit=(isset($conten));
$format=array();
$format=(!$is_edit) ? '' : json_decode($conten->content);
//var_dump($format);
?>
    <page size="A4" id="section">
        <p style="text-align:center;"><strong><u>SURAT PERNYATAAN TANGGUNG JAWAB BELANJA</u></strong></p>
        <p>Yang bertanda tangan di bawah ini :<br/>
             <table>
                 <tr><td style="width:100px">Nama</td><td style="width:400px">: <?php echo $penelitian->nama;?></td></tr>
                 <tr><td style="width:100px">Alamat</td><td style="width:400px">: <?php echo ucwords(strtolower($penelitian->alamat.' '.$penelitian->desa.' '.$penelitian->kecamatan.' '.$penelitian->kotakab));?></td></tr>
            </table>
        <br/>
        </p>
        Berdasarkan Surat Keputusan Nomor <?php echo (!$is_edit) ? '' : $format->no_keputusan;?> dan Perjanjian / Kontrak Nomor <?php echo (!$is_edit) ? '' : $format->no_kontrak;?>
        mendapatkan Anggaran Penelitian <?php echo strtoupper($penelitian->judul_penelitian);?> sebesar Rp. <?php echo (!$is_edit) ? "": number_format($format->nominal_dana,2,",",".");?>.
        <p>
            Dengan ini menyatakan bahwa:
            <ol style="margin-top:-15px;">
                <li>Biaya kegiatan penelitian di bawah ini meliputi :<br/>
                    <table cellpadding="4" cellspacing="0" border="1" width="100%">
                        <tr><th width="8%" style="text-align:center;">NO.</th><th width="65%" style="text-align:center;">URAIAN</th><th width="25%" style="text-align:center;">JUMLAH</th></tr>
                        <tr>
                            <td>1.</td>
                            <td>
                                <strong>Honorarium</strong><br/>
                                <?php echo (!$is_edit) ? '' : $format->ket_honorarium;?>
                            </td>
                            <td style="text-align:right;">
                                Rp. <?php echo (!$is_edit) ? '' : number_format($format->nominal_honorarium,2,",",".");?>
                            </td>
                        </tr>
                         <tr>
                            <td>2.</td>
                            <td>
                                <strong>Peralatan Penunjang</strong><br/>
                                <?php echo (!$is_edit) ? '' : $format->ket_peralatan_penunjang;?>
                            </td>
                            <td style="text-align:right;">
                                Rp. <?php echo (!$is_edit) ? '' : number_format($format->nominal_peralatan_penunjang,2,",",".");?>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>
                                <strong>Bahan Habis Pakai</strong><br/>
                                <?php echo (!$is_edit) ? '' : $format->ket_bhp;?>
                            </td>
                            <td style="text-align:right;">
                                Rp. <?php echo (!$is_edit) ? '' : number_format($format->nominal_bhp,2,",",".");?>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>
                                <strong>Perjalanan</strong><br/>
                                <?php echo (!$is_edit) ? '' : $format->ket_perjalanan;?>
                            </td>
                            <td style="text-align:right;">
                                Rp. <?php echo (!$is_edit) ? '' : number_format($format->nominal_perjalanan,2,",",".");?>
                            </td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>
                                <strong>Lain-lain</strong><br/>
                                <?php echo (!$is_edit) ? '' : $format->ket_lain_lain;?>
                            </td>
                            <td style="text-align:right;">
                                Rp. <?php echo (!$is_edit) ? '' : number_format($format->nominal_lain_lain,2,",",".");?>
                            </td>
                        </tr>
                        <tr><td colspan="2" style="text-align:right;"><strong>JUMLAH</strong></td><td style="text-align:right;"><strong>Rp. <?php echo (!$is_edit) ? '' : number_format($format->total_biaya,2,",",".");?></strong></td></tr>
                    </table>
                </li>
                <li>Jumlah uang tersebut pada angka 1, benar-benar dikeluarkan untuk pelaksanaan kegiatan penelitian dimaksud.</li>
                <li>Bersedia menyimpan dengan baik seluruh bukti pengeluaran belanja yang telah dilaksanakan.</li>
                <li>Bersedia untuk dilakukan pemeriksaan terhadap bukti-bukti pengeluaran oleh aparat pengawas fungsional Pemerintah</li>
                <li>Apabila di kemudian hari, pernyataan yang saya buat ini mengakibatkan kerugian Negara maka saya bersedia dituntut penggantian kerugian negara dimaksud sesuai dengan ketentuan peraturan perundang-undangan.</li>
            </ol>
        <br/>Demikian surat pernyataan ini dibuat dengan sebenarnya.</p>
        <br/><br/><br/>
         <table align="right">
            <tr>
            <td align="center">

                        <?php echo (!$is_edit) ? "": $format->tgl_pengesahan;?><br/>
                        Ketua,<br/><br/><br/><br/><br/><br/>
                        <strong>( <?php echo $penelitian->nama;?> )</strong><br/>
                        <?php echo (!$is_edit) ? "": ($format->nik_nip==""?"":"NIP/NIK. ".$format->nik_nip);?><br/>
            </td>
            </tr>
        </table>
    </page>

<?php }else{ ;?>
    <p>Maaf data tidak ditemukan....!</p>    
<?php };?>
