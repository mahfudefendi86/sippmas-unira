<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tempat_kkn extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->model(array('tempat_kkn_model', 'main/main_model'));
    }

    public function index($s = 0)
    {
        return $this->show($s);
    }

    public function show($s = 0)
    {
        $data['title'] = "Daftar Tempat KKN";
        $data['s'] = $s;
        $data['op_search'] = array("A.nama_tempat" => "Nama Tempat KKN", "A.alamat" => "Alamat KKN");
        $this->template->mainview('tempat_kkn/tempat_kkn_index', $data);
    }

    public function tempat_kkn_show($st = null, $option = "")
    {
        $in = $this->input->post(null, true);
        $row = 10;
        $sort = "";
        $filt = "";
        $start = ($st == null) ? 0 : $st;
        if (isset($in['row']) && ($in['row'] != null || $in['row'] != "")) {
            $row = $in['row'];
        }
        if (isset($in['cari']) && ($in['cari'] != null || $in['cari'] != "")) {
            if ($in['filter'] != null || $in['filter'] != "") {
                ($option == "") ? $option .= " WHERE " : $option .= " AND ";
                $option .= $in['filter'] . " LIKE '%" . $in['cari'] . "%' ";
            } else {
                ($option == "") ? $option .= " WHERE " : $option .= " AND ";
                $option .= " ( A.nama_tempat LIKE '%" . $in['cari'] . "%'  OR A.alamat LIKE '%" . $in['cari'] . "%' ) ";
            }
        }

        /*** FILTER ORDER DATA ****/
        if (isset($in['sortby']) && $in['sortby'] != "") {
            $sort_field = array("a" => "A.id_thn_kkn", "b" => "A.nama_tempat", "c" => "A.alamat", "d" => "A.provinsi", "e" => "A.kota", "f" => "A.kecamatan", "g" => "A.kelurahan");
            $option .= " ORDER BY " . $sort_field[$in['sortby']] . " " . $in['sort'];
        }

        /**** pengaturan pagination ***/
        $this->load->library('pagination');
        $config['base_url'] = site_url('tempat_kkn/tempat_kkn_show');
        $config['first_url'] = site_url('tempat_kkn/tempat_kkn_show/0');
        $config['uri_segment'] = 3; ///Untuk menentukan jumlah record yang tampil
        $config['per_page'] = $row;
        $config['total_rows'] = $this->tempat_kkn_model->show_data_tempat_kkn($option)->num_rows();

        /*** inisialisasi config pagination ***/
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['start'] = $start;
        $data['end'] = $start + $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['tempat_kkn'] = $this->tempat_kkn_model->show_data_tempat_kkn($option, $start, $config['per_page'])->result();
        $this->load->view('tempat_kkn/tempat_kkn_show', $data);
    }

    public function tempat_kkn_add()
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "This Your Title";
            $data['id_thn_kkn'] = $this->tempat_kkn_model->lookup_kkn_m_tahun()->result();
            $data['provinsi'] = $this->main_model->selectProvinsi()->result();
            $this->load->view('tempat_kkn/tempat_kkn_form', $data);
        } else {
            $data_in = array(
                'id_tempat' => random_id(), //$in['tp__id_tempat_kkn'],
                'id_thn_kkn' => $in['tp__tahun_ajaran_kkn'],
                'nama_tempat' => $in['tp__nama_tempat_kkn'],
                'alamat' => $in['tp__alamat_kkn'],
                'provinsi' => $in['tp__provinsi'],
                'kota' => $in['tp__kota'],
                'kecamatan' => $in['tp__kecamatan'],
                'kelurahan' => $in['tp__kelurahan'],
            );
            $input_data = $this->tempat_kkn_model->input_tempat_kkn($data_in);
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

    public function tempat_kkn_upd($id = null)
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "This Your Title";
            $data['id_thn_kkn'] = $this->tempat_kkn_model->lookup_kkn_m_tahun()->result();
            $data['tempat_kkn'] = $this->tempat_kkn_model->get_by_id_tempat_kkn($id)->row();
            $data['provinsi'] = $this->main_model->selectProvinsi()->result();
            $data['kota'] = $this->main_model->selectKota($data['tempat_kkn']->provinsi)->result();
            $data['kecamatan'] = $this->main_model->selectKecamatan($data['tempat_kkn']->kota)->result();
            $data['kelurahan'] = $this->main_model->selectKelurahan($data['tempat_kkn']->kecamatan)->result();
            $this->load->view('tempat_kkn/tempat_kkn_form', $data);
        } else {
            $data_in = array(
                'id_thn_kkn' => $in['tp__tahun_ajaran_kkn'],
                'nama_tempat' => $in['tp__nama_tempat_kkn'],
                'alamat' => $in['tp__alamat_kkn'],
                'provinsi' => $in['tp__provinsi'],
                'kota' => $in['tp__kota'],
                'kecamatan' => $in['tp__kecamatan'],
                'kelurahan' => $in['tp__kelurahan'],
            );
            $update_data = $this->tempat_kkn_model->update_tempat_kkn($data_in, $in['tp__id_tempat_kkn']);
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

    public function tempat_kkn_dlt($id = '')
    {
        $in = $this->input->post(null, true);
        if (!$in && $id != '') {
            $hapus = $this->tempat_kkn_model->delete_tempat_kkn($id);
            if ($hapus) {
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

    public function tempat_kkn_actionAll($action = "")
    {
        $cMsg = 0;
        $in = $this->input->post(null, true);
        //change data sparated comma text to array
        $dataArray = explode(',', $in['dataArray']);
        //remove "no" dari array
        $idArray = array_diff($dataArray, array('on'));
        $cArray = count($idArray);

        ///jika action yang di klik adalah delete
        if ($action == "delete") {
            for ($x = 0; $x < $cArray; $x++) {
                $hapus = $this->tempat_kkn_model->delete_tempat_kkn($idArray[$x]);
                if ($hapus) {
                    $cMsg++;
                }

            }
            $notif = '<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            echo json_encode(array('msg' => $notif, 'status' => 'OK'));
        } else {
            return false;
        }
    }

}