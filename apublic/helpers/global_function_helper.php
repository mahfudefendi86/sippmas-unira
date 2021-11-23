<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

////Membuat SESSION TEMPDATA (session sementara pada codeigniter)
if (!function_exists('active_link')) {
    function active_link($link)
    {
        $CI = &get_instance();
        $CI->load->library('session');
        if ($CI->session->tempdata('active_link') != $link) {
            $CI->session->unset_tempdata('active_link');
            $CI->session->set_tempdata('active_link', $link, 600);
        }
        return true;
    }
}

////Merubah bentuk digit kedalam bentuk Nominal Rupiah
if (!function_exists('convertRP')) {
    function convertRP($nominal, $dec = null)
    {
        $rp = '';
        if (empty($dec)) {
            $dec = 0;
        }

        $rp .= '<span style="text-align:right;">' . number_format($nominal, $dec, ',', '.') . '</span>';
        return $rp;
    }
}
////Membuat pilihan Jenis bayar
if (!function_exists('jenisKelamin')) {
    function jenisKelamin($keyselect = '', $option = false)
    {
        $data_array = array("Laki-laki" => "Laki-laki", "Perempuan" => "Perempuan");
        $opt = '';
        foreach ($data_array as $d1 => $d2) {
            if ($option == false) {
                if ($d1 == $keyselect) {
                    $opt .= '<option value="' . $d1 . '" selected>' . $d2 . '</option>';
                } else {
                    $opt .= '<option value="' . $d1 . '">' . $d2 . '</option>';
                }
            } else {
                if ($d1 == $keyselect) {
                    $opt .= $d2;
                }
            }
        }
        return $opt;
    }
}

////Membuat Fungsi Terbilang
if (!function_exists('Terbilang')) {
    function Terbilang($x)
    {
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12) {
            return " " . $abil[$x];
        } elseif ($x < 20) {
            return Terbilang($x - 10) . "belas";
        } elseif ($x < 100) {
            return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
        } elseif ($x < 200) {
            return " seratus" . Terbilang($x - 100);
        } elseif ($x < 1000) {
            return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
        } elseif ($x < 2000) {
            return " seribu" . Terbilang($x - 1000);
        } elseif ($x < 1000000) {
            return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
        } elseif ($x < 1000000000) {
            return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
        }

    }
}

/* Generate Password Random */
if (!function_exists('generate_psw')) {
    function generate_psw()
    {
        /* Generating Password */
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}

/* Create Password */
if (!function_exists('create_password')) {
    function create_password($psw = "")
    {
        $p = "";
        if ($psw != "") {
            $p = do_hash('de23239mex' . $psw . 'by4489#&4', 'md5');
        }
        return $p;
    }
}

/* untuk membuat enkripsi data */
if (!function_exists('enkripsi_psw')) {
    function enkripsi_psw($string = "", $opt = "enc")
    {
        $CI = &get_instance();
        $CI->load->library('encrypt'); // load library
        //$CI->encrypt->set_cipher(MCRYPT_BLOWFISH);//tambahan untuk jenis enkripsi
        $e = "";
        //$this->load->library('encryption');
        if ($opt == "enc") {
            $e = $CI->encrypt->encode($string); //enkripsi string
        } else
        if ($opt == "dec") {
            $e = $CI->encrypt->decode($string);
        }
        return $e;
    }
}

/* Fungsi kirim email */
if (!function_exists('kirim_email')) {
    function kirim_email($option = [], $att = [])
    {
        $CI = &get_instance();
        $CI->load->library('email');
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = true;
        $CI->email->initialize($config);

        $CI->email->clear();
        $CI->email->from($option['dari'], $option['dari_nama']);
        $CI->email->to($option['tujuan']);
        if ($option['cc'] != "" || $option['cc'] != null) {
            $CI->email->cc($option['cc']);
        }
        $CI->email->subject($option['subject']);
        $CI->email->message($option['pesan']);
        if (count($att) > 0) {
            for ($c = 0; $c < count($att); $c++) {
                $CI->email->attach($att[$c]);
            }
        }
        $CI->email->send();
        return true;
    }
}

/* MEMBUAT ID RANDOM */
if (!function_exists('random_id')) {
    function random_id()
    {
        $id = uniqid(time() . mt_rand());
        return md5($id);
    }
}
/* END ID RANDOM */

/*fungsi untuk mendownload FILE */
if (!function_exists('forcedownload')) {
    function forcedownload($url)
    {
        $CI = &get_instance();
        $CI->load->helper('download');
        force_download($url, null, true);
    }
}

/* untuk Melakukan translasi Text kedalam hasil */
if (!function_exists('replace_text')) {
    function replace_text(array $replace, $subject)
    {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

/* untuk membuat enkripsi data */
if (!function_exists('enkripsi_data')) {
    function enkripsi_data($string = "", $opt = "enc")
    {
        $CI = &get_instance();
        $CI->load->library('encrypt'); // load library
        $CI->encrypt->set_cipher(MCRYPT_BLOWFISH); //tambahan untuk jenis enkripsi
        $e = "";
        //$this->load->library('encryption');
        if ($opt == "enc") {
            $e = $CI->encrypt->encode($string); //enkripsi string
        } else
        if ($opt == "dec") {
            $e = $CI->encrypt->decode($string);
        }
        return $e;
    }
}

//get nama daerah by id
if (!function_exists('nama_provinsi')) {
    function nama_provinsi($id_provinsi)
    {
        $CI = &get_instance();
        $provinsi = $CI->db->get_where('provinsi', ['id_prov' => $id_provinsi])->row_array();
        $nama_provinsi = $provinsi['nama_prov'];

        return $nama_provinsi;
    }
}

if (!function_exists('nama_kota')) {
    function nama_kota($id_kota)
    {
        $CI = &get_instance();
        $kota = $CI->db->get_where('kota', ['id_kota' => $id_kota])->row_array();
        $nama_kota = $kota['nama_kota'];

        return $nama_kota;
    }
}

if (!function_exists('nama_kecamatan')) {
    function nama_kecamatan($id_kecamatan)
    {
        $CI = &get_instance();
        $kecamatan = $CI->db->get_where('kecamatan', ['id_kec' => $id_kecamatan])->row_array();
        $nama_kecamatan = $kecamatan['nama_kec'];

        return $nama_kecamatan;
    }
}

if (!function_exists('nama_kelurahan')) {
    function nama_kelurahan($id_kelurahan)
    {
        $CI = &get_instance();
        $kelurahan = $CI->db->get_where('kelurahan', ['id_kel' => $id_kelurahan])->row_array();
        $nama_kelurahan = $kelurahan['nama_kel'];

        return $nama_kelurahan;
    }
}

//get nama fakultas & prodi
if (!function_exists('nama_fakultas')) {
    function nama_fakultas($id_fakultas)
    {
        $CI = &get_instance();
        $fakultas = $CI->db->get_where('tbl_fakultas', ['id_fakultas' => $id_fakultas])->row_array();
        $nama_fakultas = $fakultas['nama_fakultas'];

        return $nama_fakultas;
    }
}

if (!function_exists('nama_prodi')) {
    function nama_prodi($id_prodi)
    {
        $CI = &get_instance();
        $prodi = $CI->db->get_where('tbl_prodi', ['id_prodi' => $id_prodi])->row_array();
        $nama_prodi = $prodi['nama_prodi'];

        return $nama_prodi;
    }
}
