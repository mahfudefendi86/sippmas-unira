<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Plotting_kkn extends Member_Control
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->model(array('plotting_kkn_model'));
        active_link("master");
        active_sublink("plotting_kkn");
    }

    public function index($s = 0)
    {
        return $this->show($s);
    }

    public function show($s = 0)
    {
        $data['title'] = "Daftar Plotting Peserta KKN";
        $data['s'] = $s;
        $data['op_search'] = array("C.nama_kelompok" => "Nama Kelompok", "D.nama" => "Anggota Kelompok");
        $this->template->kknview('plotting_kkn/plotting_kkn_index', $data);
    }

    public function plotting_kkn_show($st = null, $option = "")
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
                $option .= " ( A.kelompok LIKE '%" . $in['cari'] . "%'  OR A.anggota LIKE '%" . $in['cari'] . "%' ) ";
            }
        }

        /*** FILTER ORDER DATA ****/
        if (isset($in['sortby']) && $in['sortby'] != "") {
            $sort_field = array("a" => "C.nama_kelompok", "b" => "D.nama");
            $option .= " ORDER BY " . $sort_field[$in['sortby']] . " " . $in['sort'];
        }

        var_dump($option);

        /**** pengaturan pagination ***/
        $this->load->library('pagination');
        $config['base_url'] = site_url('plotting_kkn/plotting_kkn_show');
        $config['first_url'] = site_url('plotting_kkn/plotting_kkn_show/0');
        $config['uri_segment'] = 3; ///Untuk menentukan jumlah record yang tampil
        $config['per_page'] = $row;
        $config['total_rows'] = $this->plotting_kkn_model->show_data_plotting_kkn($option)->num_rows();

        /*** inisialisasi config pagination ***/
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['start'] = $start;
        $data['end'] = $start + $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['plotting_kkn'] = $this->plotting_kkn_model->show_data_plotting_kkn($option, $start, $config['per_page'])->result();
        $this->load->view('plotting_kkn/plotting_kkn_show', $data);
    }

    public function plotting_kkn_add($id = "")
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "Plotting Peserta KKN";
            if ($id != "") {
                $p = $this->plotting_kkn_model->get_member_by_kelompok($id);
                if ($p->num_rows() > 0) {
                    $data['anggota'] = $p->result();
                }
                $data['id_kelompok'] = $id;
            }
            $data['kelompok'] = $this->plotting_kkn_model->lookup_kkn_m_kelompok()->result();

            // $data['anggota'] = $this->plotting_kkn_model->lookup__m_usr_login()->result();

            $this->template->kknview('plotting_kkn/plotting_kkn_form', $data);
        } else {
            //insert multiple peserta
            if (!empty($in['pt__anggota_kelompok'])) {
                $insertArray = array();
                for ($i = 0; $i < count($in['pt__anggota_kelompok']); $i++) {
                    if (!empty($in['pt__anggota_kelompok'][$i])) {
                        $data_in = array(
                            'id_plot' => random_id(), //$in['pt__id_plotting'],
                            'kelompok' => $in['pt__nama_kelompok'],
                            'anggota' => $in['pt__anggota_kelompok'][$i],
                        );
                        array_push($insertArray, $data_in);
                    }
                }
                $input_data = $this->plotting_kkn_model->input_plotting_kkn($insertArray);
            }

            if ($input_data) {
                $notif = "Plotting berhasil";
                // $notif = '<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil disimpan...
                //     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                echo json_encode(array('msg' => $notif, 'status' => 'OK'));
            } else {
                $notif = "Plotting gagal";
                // $notif = '<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data gagal disimpan...
                //     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
            }
        }
    }

    public function plotting_kkn_upd($id = null)
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "This Your Title";
            $data['kelompok'] = $this->plotting_kkn_model->lookup_kkn_m_kelompok()->result();
            $data['anggota'] = $this->plotting_kkn_model->lookup__m_usr_login()->result();
            $data['plotting_kkn'] = $this->plotting_kkn_model->get_by_id_plotting_kkn($id)->row();
            $this->load->view('plotting_kkn/plotting_kkn_form', $data);
        } else {
            $data_in = array(
                'kelompok' => $in['pt__nama_kelompok'],
                'anggota' => $in['pt__anggota_kelompok'],
            );
            $update_data = $this->plotting_kkn_model->update_plotting_kkn($data_in, $in['pt__id_plotting']);
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

    public function plotting_kkn_dlt($id = '')
    {
        $in = $this->input->post(null, true);
        if (!$in && $id != '') {
            $hapus = $this->plotting_kkn_model->delete_plotting_kkn($id);
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

    public function plotting_kkn_actionAll($action = "")
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
                $hapus = $this->plotting_kkn_model->delete_plotting_kkn($idArray[$x]);
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

    public function get_member($id = "")
    {
        if ($id != "") {
            $p = $this->plotting_kkn_model->get_member_by_kelompok($id);
            if ($p->num_rows() > 0) {
                $data['peserta'] = $p->result();
                $data['status'] = "OK";
                $data['msg'] = "Data ditemukan sebanyak " . $p->num_rows();
            } else {
                $data['status'] = "ERROR";
                $data['msg'] = "Data tidak ditemukan!";
            }
        } else {
            $data['status'] = "ERROR";
            $data['msg'] = "Parameter tidak lengkap";
        }
        echo json_encode($data);
    }
}
