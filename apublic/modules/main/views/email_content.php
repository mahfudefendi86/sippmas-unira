<!DOCTYPE html>
<html>
<head>
    <style type='text/css'>
        body {background-color: #CCD9F9;
             font-family: "Times New Roman", Times, serif}

        h3 {color: black}

        p {font-weight:bold}

        th{text-align:left}
    </style>
</head>
<body>

    <h3>Hai <?=$nama_mhs;?>,</h3>
    <h3>Terima kasih telah melakukan pendaftaran KKN.</h3>

    <p>Silahkan klik link di bawah ini untuk melanjutkan konfirmasi pendaftaran.</p>
    <a href = "http://sippmas.uniramalang.ac.id/konfirmasi/kkn/<?=$id_peserta;?>">Konfirmasi</a>

    <h3>Biodata Peserta:</h3>

    <table>
        <tbody>
            <tr>
                <th>Nama Lengkap</th>
                <td width="10">:</td>
                <td><?=$nama_mhs;?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td width="10">:</td>
                <td><?=$email;?></td>
            </tr>
            <tr>
                <th>No. HP</th>
                <td width="10">:</td>
                <td><?=$hp;?></td>
            </tr>
            <tr>
                <th>NIM</th>
                <td width="10">:</td>
                <td><?=$nim;?></td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td width="10">:</td>
                <td><?=($jenis_kelamin == "L") ? "Laki-laki" : "Perempuan";?></td>
            </tr>
            <tr>
                <th>Tempat Lahir</th>
                <td width="10">:</td>
                <td><?=$tempat_lahir;?></td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td width="10">:</td>
                <td><?=tgl_indo($tgl_lahir);?></td>
            </tr>
            <tr>
                <th>Usia</th>
                <td width="10">:</td>
                <td><?=$usia;?> tahun</td>
            </tr>
            <tr>
                <th>Alamat Domisili</th>
                <td width="10">:</td>
                <td><?=$alamat_domisili;?></td>
            </tr>
            <tr>
                <th>Provinsi</th>
                <td width="10">:</td>
                <td><?=nama_provinsi($provinsi);?></td>
            </tr>
            <tr>
                <th>Kota</th>
                <td width="10">:</td>
                <td><?=ucwords(strtolower(nama_kota($kota)));?></td>
            </tr>
            <tr>
                <th>Kecamatan</th>
                <td width="10">:</td>
                <td><?=nama_kecamatan($kecamatan);?></td>
            </tr>
            <tr>
                <th>Kelurahan</th>
                <td width="10">:</td>
                <td><?=nama_kelurahan($kelurahan);?></td>
            </tr>
            <tr>
                <th>Fakultas</th>
                <td width="10">:</td>
                <td><?=ucwords(strtolower(nama_fakultas($id_fakultas)));?></td>
            </tr>
            <tr>
                <th>Prodi</th>
                <td width="10">:</td>
                <td><?=ucwords(strtolower(nama_prodi($id_prodi)));?></td>
            </tr>
            <tr>
                <th>Kondisi Kesehatan</th>
                <td width="10">:</td>
                <td><?=($kesehatan == "baik") ? "Baik" : "Kurang Baik";?></td>
            </tr>
            <tr>
                <th>Penyakit Diderita</th>
                <td width="10">:</td>
                <td><?=($penyakit_diderita == "memiliki") ? "Memiliki" : "Tidak Memiliki";?></td>
            </tr>
            <tr>
                <th>Memiliki Istri/Suami/Anak</th>
                <td width="10">:</td>
                <td><?=implode(", ", json_decode($keluarga, true));?></td>
            </tr>
            <tr>
                <th>Sedang Hamil</th>
                <td width="10">:</td>
                <td><?=($is_hamil == "Y") ? "Ya" : "Tidak";?></td>
            </tr>
            <tr>
                <th>Sedang Bekerja</th>
                <td width="10">:</td>
                <td><?=($is_kerja == "Y") ? "Ya" : "Tidak";?></td>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <td width="10">:</td>
                <td><?=$pekerjaan;?></td>
            </tr>
            <tr>
                <th>Status Pekerjaan</th>
                <td width="10">:</td>
                <td><?=$status_pekerjaan;?></td>
            </tr>
            <tr>
                <th>Alamat Kerja</th>
                <td width="10">:</td>
                <td><?=$alamat_kerja;?></td>
            </tr>
            <tr>
                <th>Ukuran Jaket</th>
                <td width="10">:</td>
                <td><?=$ukuran_jaket;?></td>
            </tr>
            <tr>
                <th>Berkas Pembayaran</th>
                <td width="10">:</td>
                <td><?=$berkas;?></td>
            </tr>
        </tbody>
    </table>

</body>
</html>