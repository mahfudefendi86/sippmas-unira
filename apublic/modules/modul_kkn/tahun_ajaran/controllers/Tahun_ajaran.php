<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tahun_ajaran extends Member_Control
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'format_tanggal'));
        $this->load->model(array('tahun_ajaran_model'));
        active_link("master");
        active_sublink("tahun_ajaran");
    }

    public function index($s = 0)
    {
        return $this->show($s);
    }

    public function show($s = 0)
    {
        $data['title'] = "Daftar Tahun Ajaran";
        $data['s'] = $s;
        $data['op_search'] = array("A.nama_kkn" => "Nama KKN");
        $this->template->kknview('tahun_ajaran/tahun_ajaran_index', $data);
    }

    public function tahun_ajaran_show($st = null, $option = "")
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
                $option .= " ( A.nama_kkn LIKE '%" . $in['cari'] . "%' ) ";
            }
        }

        /*** FILTER ORDER DATA ****/
        if (isset($in['sortby']) && $in['sortby'] != "") {
            $sort_field = array("a" => "A.nama_kkn", "b" => "A.tgl_mulai", "c" => "A.tgl_selesai", "d" => "A.keterangan");
            $option .= " ORDER BY " . $sort_field[$in['sortby']] . " " . $in['sort'];
        }

        /**** pengaturan pagination ***/
        $this->load->library('pagination');
        $config['base_url'] = site_url('tahun_ajaran/tahun_ajaran_show');
        $config['first_url'] = site_url('tahun_ajaran/tahun_ajaran_show/0');
        $config['uri_segment'] = 3; ///Untuk menentukan jumlah record yang tampil
        $config['per_page'] = $row;
        $config['total_rows'] = $this->tahun_ajaran_model->show_data_tahun_ajaran($option)->num_rows();

        /*** inisialisasi config pagination ***/
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['start'] = $start;
        $data['end'] = $start + $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['tahun_ajaran'] = $this->tahun_ajaran_model->show_data_tahun_ajaran($option, $start, $config['per_page'])->result();
        $this->load->view('tahun_ajaran/tahun_ajaran_show', $data);
    }

    public function tahun_ajaran_add()
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "This Your Title";
            $this->load->view('tahun_ajaran/tahun_ajaran_form', $data);
        } else {
            $data_in = array(
                'id_thn_kkn' => random_id(), //$in['th__id_tahun_ajaran_kkn'],
                'nama_kkn' => $in['th__nama_kkn'],
                'tgl_mulai' => $in['th__tanggal_mulai'],
                'tgl_selesai' => $in['th__tanggal_selesai'],
                'keterangan' => $in['th__keterangan'],
            );
            $input_data = $this->tahun_ajaran_model->input_tahun_ajaran($data_in);
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

    public function tahun_ajaran_upd($id = null)
    {
        $in = $this->input->post(null, true);
        if (!$in) {
            $data['title'] = "This Your Title";
            $data['tahun_ajaran'] = $this->tahun_ajaran_model->get_by_id_tahun_ajaran($id)->row();
            $this->load->view('tahun_ajaran/tahun_ajaran_form', $data);
        } else {
            $data_in = array(
                'nama_kkn' => $in['th__nama_kkn'],
                'tgl_mulai' => $in['th__tanggal_mulai'],
                'tgl_selesai' => $in['th__tanggal_selesai'],
                'keterangan' => $in['th__keterangan'],
            );
            $update_data = $this->tahun_ajaran_model->update_tahun_ajaran($data_in, $in['th__id_tahun_ajaran_kkn']);
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

    public function tahun_ajaran_dlt($id = '')
    {
        $in = $this->input->post(null, true);
        if (!$in && $id != '') {
            $hapus = $this->tahun_ajaran_model->delete_tahun_ajaran($id);
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

    public function tahun_ajaran_actionAll($action = "")
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
                $hapus = $this->tahun_ajaran_model->delete_tahun_ajaran($idArray[$x]);
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
