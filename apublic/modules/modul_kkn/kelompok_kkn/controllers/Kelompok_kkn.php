<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kelompok_kkn extends Member_Control
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->model(array('kelompok_kkn_model'));
        active_link("master");
        active_sublink("kelompok_kkn");
    }

    public function index($s = 0)
    {
        return $this->show($s);
    }

    public function show($s = 0)
    {
        $data['title'] = "Daftar Kelompok KKN";
        $data['s'] = $s;
        $data['op_search'] = array("C.nama_tempat" => "Tempat KKN", "A.nama_kelompok" => "Nama Kelompok KKN");
        $this->template->kknview('kelompok_kkn/kelompok_kkn_index', $data);
    }

    public function kelompok_kkn_show($st = null, $option = "")
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
                $option .= " ( C.nama_tempat LIKE '%" . $in['cari'] . "%'  OR A.nama_kelompok LIKE '%" . $in['cari'] . "%' ) ";
            }
        }

        /*** FILTER ORDER DATA ****/
        if (isset($in['sortby']) && $in['sortby'] != "") {
            $sort_field = array("a" => "A.id_tempat", "b" => "A.nama_kelompok", "c" => "A.ketua_kelompok");
            $option .= " ORDER BY " . $sort_field[$in['sortby']] . " " . $in['sort'];
        }

        /**** pengaturan pagination ***/
        $this->load->library('pagination');
        $config['base_url'] = site_url('kelompok_kkn/kelompok_kkn_show');
        $config['first_url'] = site_url('kelompok_kkn/kelompok_kkn_show/0');
        $config['uri_segment'] = 3; ///Untuk menentukan jumlah record yang tampil
        $config['per_page'] = $row;
        $config['total_rows'] = $this->kelompok_kkn_model->show_data_kelompok_kkn($option)->num_rows();

        /*** inisialisasi config pagination ***/
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['start'] = $start;
        $data['end'] = $start + $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['kelompok_kkn'] = $this->kelompok_kkn_model->show_data_kelompok_kkn($option, $start, $config['per_page'])->result();
        $this->load->view('kelompok_kkn/kelompok_kkn_show', $data);
    }

    public function kelompok_kkn_add()
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "This Your Title";
            $data['id_tempat'] = $this->kelompok_kkn_model->lookup_kkn_m_tempat()->result();
            $data['ketua_kelompok'] = $this->kelompok_kkn_model->lookup__m_usr_login()->result();
            $this->load->view('kelompok_kkn/kelompok_kkn_form', $data);
        } else {
            $data_in = array(
                'id_kelompok' => random_id(), //$in['klp__id_kelompok_kkn'],
                'id_tempat' => $in['klp__tempat_kkn'],
                'nama_kelompok' => $in['klp__nama_kelompok_kkn'],
                'ketua_kelompok' => $in['klp__nama_ketua_kelompok'],
            );
            $input_data = $this->kelompok_kkn_model->input_kelompok_kkn($data_in);
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

    public function kelompok_kkn_upd($id = null)
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "This Your Title";
            $data['id_tempat'] = $this->kelompok_kkn_model->lookup_kkn_m_tempat()->result();
            $data['ketua_kelompok'] = $this->kelompok_kkn_model->lookup__m_usr_login()->result();
            $data['kelompok_kkn'] = $this->kelompok_kkn_model->get_by_id_kelompok_kkn($id)->row();
            $this->load->view('kelompok_kkn/kelompok_kkn_form', $data);
        } else {
            $data_in = array(
                'id_tempat' => $in['klp__tempat_kkn'],
                'nama_kelompok' => $in['klp__nama_kelompok_kkn'],
                'ketua_kelompok' => $in['klp__nama_ketua_kelompok'],
            );
            $update_data = $this->kelompok_kkn_model->update_kelompok_kkn($data_in, $in['klp__id_kelompok_kkn']);
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

    public function kelompok_kkn_dlt($id = '')
    {
        $in = $this->input->post(null, true);
        if (!$in && $id != '') {
            $hapus = $this->kelompok_kkn_model->delete_kelompok_kkn($id);
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

    public function kelompok_kkn_actionAll($action = "")
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
                $hapus = $this->kelompok_kkn_model->delete_kelompok_kkn($idArray[$x]);
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
