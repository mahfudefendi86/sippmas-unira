<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Peserta_kkn extends Member_Control
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'format_tanggal'));
        $this->load->model(array('peserta_kkn_model', 'main/main_model'));
        active_link("master");
    }

    public function index($s = 0)
    {
        return $this->show($s);
    }

    public function show($s = 0)
    {
        $data['title'] = "Daftar Peserta KKN";
        $data['s'] = $s;
        $data['op_search'] = array();
        $this->template->kknview('peserta_kkn/peserta_kkn_index', $data);
    }

    public function peserta_kkn_show($st = null, $option = "")
    {
        $in = $this->input->post(null, true);
        $row = 10;
        $sort = "";
        $filt = "";
        $start = ($st == null) ? 0 : $st;
        if (isset($in['row']) && ($in['row'] != null || $in['row'] != "")) {
            $row = $in['row'];
        }

        /*** FILTER ORDER DATA ****/
        if (isset($in['sortby']) && $in['sortby'] != "") {
            $sort_field = array("x" => "X.status", "a" => "A.nama_mhs", "b" => "A.email", "c" => "A.hp", "d" => "A.nim", "e" => "A.jenis_kelamin", "f" => "A.tempat_lahir", "g" => "A.tgl_lahir", "h" => "A.alamat_domisili", "i" => "A.provinsi", "j" => "A.kota", "k" => "A.kecamatan", "l" => "A.kelurahan", "m" => "A.id_fakultas", "n" => "A.id_prodi", "o" => "A.kesehatan", "p" => "A.penyakit_diderita", "q" => "A.keluarga", "r" => "A.is_hamil", "s" => "A.is_kerja", "t" => "A.pekerjaan", "u" => "A.status_pekerjaan", "v" => "A.alamat_kerja", "w" => "A.ukuran_jaket", "x" => "A.berkas");
            $option .= " ORDER BY " . $sort_field[$in['sortby']] . " " . $in['sort'];
        }

        /**** pengaturan pagination ***/
        $this->load->library('pagination');
        $config['base_url'] = site_url('peserta_kkn/peserta_kkn_show');
        $config['first_url'] = site_url('peserta_kkn/peserta_kkn_show/0');
        $config['uri_segment'] = 3; ///Untuk menentukan jumlah record yang tampil
        $config['per_page'] = $row;
        $config['total_rows'] = $this->peserta_kkn_model->show_data_peserta_kkn($option)->num_rows();

        /*** inisialisasi config pagination ***/
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['start'] = $start;
        $data['end'] = $start + $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['peserta_kkn'] = $this->peserta_kkn_model->show_data_peserta_kkn($option, $start, $config['per_page'])->result();
        $this->load->view('peserta_kkn/peserta_kkn_show', $data);
    }

    public function peserta_kkn_add()
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "Tambah Peserta Kkn";
            $data['provinsi'] = $this->main_model->selectProvinsi()->result();
            $data['id_fakultas'] = $this->peserta_kkn_model->lookup_tbl_fakultas()->result();
            $data['id_prodi'] = $this->peserta_kkn_model->lookup_tbl_prodi()->result();
            $this->load->view('peserta_kkn/peserta_kkn_form', $data);
        } else {
            $data_in = [
                "id_peserta" => random_id(),
                "nama_mhs" => $in["kknn_nama_lengkap"],
                "email" => $in["kknn_email"],
                "hp" => $in["kknn_nomer_hp"],
                "nim" => $in["kknn_nim"],
                "jenis_kelamin" => $in["kknn_jenis_kelamin"],
                "tempat_lahir" => $in["kknn_tempat_lahir"],
                "tgl_lahir" => $in["kknn_tanggal_lahir"],
                "usia" => $in["kknn_usia"],
                "alamat_domisili" => $in["kknn_alamat_domisili"],
                "provinsi" => $in["kknn_provinsi"],
                "kota" => $in["kknn_kota"],
                "kecamatan" => $in["kknn_kecamatan"],
                "kelurahan" => $in["kknn_kelurahan"],
                "id_fakultas" => $in["kknn_fakultas"],
                "id_prodi" => $in["kknn_program_pendidikan"],
                "kesehatan" => $in["kknn_kondisi_kesehatan"],
                "penyakit_diderita" => $in["kknn_penyakit"],
                "keluarga" => json_encode($in["kknn_memiliki_keluarga"]),
                "is_hamil" => (isset($in["kknn_hamil"]) ? $in["kknn_hamil"] : ''),
                "is_kerja" => $in["kknn_bekerja"],
                "pekerjaan" => (isset($in["kknn_pekerjaan"]) ? $in["kknn_pekerjaan"] : ''),
                "status_pekerjaan" => (isset($in["kknn_status_pekerjaan"]) ? $in["kknn_status_pekerjaan"] : ''),
                "alamat_kerja" => (isset($in["kknn_alamat_kerja"]) ? $in["kknn_alamat_kerja"] : ''),
                "ukuran_jaket" => $in["kknn_ukuran_jaket"],
                //"berkas" => $upload_image, //$in["kknn_upload"],
            ];

            if ($upload_image) {
                $config = [
                    'allowed_types' => 'jpg|jpeg|pdf',
                    'max_size' => '1024',
                    'file_name' => str_replace(' ', '_', 'kkn_' . $data_in['nim']),
                    'upload_path' => './asset/uploads/berkas/pembayaran_kkn/',
                ];

                $this->load->library('upload');

                $this->upload->initialize($config);

                if ($this->upload->do_upload('kknn_upload')) {
                    $new_image = [
                        'berkas' => $this->upload->data('file_name'),
                    ];
                    $data_in = array_merge($data_in, $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $input_data = $this->peserta_kkn_model->input_peserta_kkn($data_in);
            if ($input_data) {
                $notif = '<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil disimpan...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                echo json_encode(array('msg' => $notif, 'status' => 'OK'));
            } else {
                $notif = '<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data gagal disimpan...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
            }
        }
    }

    public function peserta_kkn_upd($id = null)
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "Update Peserta Kkn";
            $data['id_fakultas'] = $this->peserta_kkn_model->lookup_tbl_fakultas()->result();
            $data['id_prodi'] = $this->peserta_kkn_model->lookup_tbl_prodi()->result();
            $data['peserta_kkn'] = $this->peserta_kkn_model->get_by_id_peserta_kkn($id)->row();
            $data['provinsi'] = $this->main_model->selectProvinsi()->result();
            $data['kota'] = $this->main_model->selectKota($data['peserta_kkn']->provinsi)->result();
            $data['kecamatan'] = $this->main_model->selectKecamatan($data['peserta_kkn']->kota)->result();
            $data['kelurahan'] = $this->main_model->selectKelurahan($data['peserta_kkn']->kecamatan)->result();
            $this->load->view('peserta_kkn/peserta_kkn_form', $data);
        } else {
            $data_in = [
                //"id_peserta" => random_id(),
                "nama_mhs" => $in["kknn_nama_lengkap"],
                "email" => $in["kknn_email"],
                "hp" => $in["kknn_nomer_hp"],
                "nim" => $in["kknn_nim"],
                "jenis_kelamin" => $in["kknn_jenis_kelamin"],
                "tempat_lahir" => $in["kknn_tempat_lahir"],
                "tgl_lahir" => $in["kknn_tanggal_lahir"],
                "usia" => $in["kknn_usia"],
                "alamat_domisili" => $in["kknn_alamat_domisili"],
                "provinsi" => $in["kknn_provinsi"],
                "kota" => $in["kknn_kota"],
                "kecamatan" => $in["kknn_kecamatan"],
                "kelurahan" => $in["kknn_kelurahan"],
                "id_fakultas" => $in["kknn_fakultas"],
                "id_prodi" => $in["kknn_program_pendidikan"],
                "kesehatan" => $in["kknn_kondisi_kesehatan"],
                "penyakit_diderita" => $in["kknn_penyakit"],
                "keluarga" => json_encode($in["kknn_memiliki_keluarga"]),
                "is_hamil" => (isset($in["kknn_hamil"]) ? $in["kknn_hamil"] : ''),
                "is_kerja" => $in["kknn_bekerja"],
                "pekerjaan" => (isset($in["kknn_pekerjaan"]) ? $in["kknn_pekerjaan"] : ''),
                "status_pekerjaan" => (isset($in["kknn_status_pekerjaan"]) ? $in["kknn_status_pekerjaan"] : ''),
                "alamat_kerja" => (isset($in["kknn_alamat_kerja"]) ? $in["kknn_alamat_kerja"] : ''),
                "ukuran_jaket" => $in["kknn_ukuran_jaket"],
                //"berkas" => $upload_image, //$in["kknn_upload"],
            ];

            $upload_image = $_FILES['kknn_upload']['name'];

            if ($upload_image) {
                $config = [
                    'allowed_types' => 'jpg|jpeg|pdf',
                    'max_size' => '1024',
                    'file_name' => str_replace(' ', '_', 'kkn_' . $data_in['nim']),
                    'upload_path' => './asset/uploads/berkas/pembayaran_kkn/',
                ];

                $this->load->library('upload');

                $this->upload->initialize($config);

                if ($this->upload->do_upload('kknn_upload')) {
                    $berkas_lama = $in['berkas_lama'];
                    if ($berkas_lama != '') {
                        unlink(FCPATH . 'asset/uploads/berkas/pembayaran_kkn/' . $berkas_lama);
                    }
                    $new_image = [
                        'berkas' => $this->upload->data('file_name'),
                    ];
                    $data_in = array_merge($data_in, $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $update_data = $this->peserta_kkn_model->update_peserta_kkn($data_in, $in['kknn_id_peserta']);
            if ($update_data) {
                $notif = '<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di-update...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                echo json_encode(array('msg' => $notif, 'status' => 'OK'));
            } else {
                $notif = '<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal di-update...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
            }
        }
    }

    public function peserta_kkn_detail($id = null)
    {
        $data['title'] = "Detail Peserta Kkn";
        $data['id_fakultas'] = $this->peserta_kkn_model->lookup_tbl_fakultas()->result();
        $data['id_prodi'] = $this->peserta_kkn_model->lookup_tbl_prodi()->result();
        $data['peserta_kkn'] = $this->peserta_kkn_model->get_by_id_peserta_kkn($id)->row();
        $data['akun_kkn'] = $this->peserta_kkn_model->select_user_login($id)->row();
        $data['provinsi'] = $this->main_model->selectProvinsi()->result();
        $data['kota'] = $this->main_model->selectKota($data['peserta_kkn']->provinsi)->result();
        $data['kecamatan'] = $this->main_model->selectKecamatan($data['peserta_kkn']->kota)->result();
        $data['kelurahan'] = $this->main_model->selectKelurahan($data['peserta_kkn']->kecamatan)->result();
        $this->load->view('peserta_kkn/peserta_kkn_detail', $data);
    }

    public function peserta_kkn_dlt($id = '')
    {
        $in = $this->input->post(null, true);
        if (!$in && $id != '') {
            $hapus = $this->peserta_kkn_model->delete_peserta_kkn($id);
            $hapus_user = $this->peserta_kkn_model->delete_user_login($id);
            if ($hapus && $hapus_user) {
                $notif = '<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                echo json_encode(array('msg' => $notif, 'status' => 'OK'));
            } else {
                $notif = '<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal dihapus...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
            }
        }
    }

    public function peserta_kkn_actionAll($action = "")
    {
        $cMsg = 0;
        $in = $this->input->post(null, true);
        //change data sparated comma text to array
        $dataArray = explode(',', $in['dataArray']);
        //remove "no" dari array
        $idArray = array_diff($dataArray, array('on'));
        $cArray = count($idArray);
        $newIdArray = array();
        for ($x = 0; $x < $cArray; $x++) {
            array_push($newIdArray, $idArray[$x]);
        }
        ///jika action yang di klik adalah delete
        if ($action == "delete") {
            $hapus = $this->peserta_kkn_model->delete_peserta_kkn($newIdArray);
            $hapus_user = $this->peserta_kkn_model->delete_user_login($newIdArray);
            if ($hapus && $hapus_user) {
                $cMsg++;
            }

            $notif = '<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            echo json_encode(array('msg' => $notif, 'status' => 'OK'));
        } else {
            return false;
        }
    }

    public function validasi_peserta($action, $userid)
    {
        $params = ($action == "set_aktif") ? ["status" => "AKTIF"] : ["status" => "NONAKTIF"];
        $status = ($action == "set_aktif") ? "aktif" : "nonaktif";
        $validasi = $this->peserta_kkn_model->update_usr_mhs($params, $userid);

        if ($validasi) {
            $notif = '<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Mahasiswa berhasil divalidasi, akun berhasil di' . $status . 'kan...
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            echo json_encode(array('msg' => $notif, 'status' => 'OK'));
        } else {
            $notif = '<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Mahasiswa gagal divalidasi, akun gagal di' . $status . 'kan...
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
        }
    }

}
