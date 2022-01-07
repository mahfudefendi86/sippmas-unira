<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Plotting_kkn_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function input_plotting_kkn($data_array)
    {
        $input = $this->db->insert_batch('kkn_plot', $data_array);
        return $input;
    }

    public function update_plotting_kkn($data_array, $id)
    {
        $this->db->where('id_plot', $id);
        $update = $this->db->update('kkn_plot', $data_array);
        return $update;
    }

    public function get_by_id_plotting_kkn($id)
    {
        $this->db->select('*')->from('kkn_plot');
        $this->db->where('id_plot', $id);
        return $this->db->get();
    }

    public function show_data_plotting_kkn($option = null, $start = null, $limit = null)
    {
        $sql = "SELECT A.*,C.nama_kelompok as nama_kelompok_lookup,D.nama as nama_lookup FROM kkn_plot A
				  LEFT JOIN kkn_m_kelompok C ON A.kelompok=C.id_kelompok
				  LEFT JOIN _m_usr_login D ON A.anggota=D.userid ";
        if ($option != null) {
            $sql .= $option;
        }
        if ($start != null && $limit != null) {
            $sql .= " LIMIT " . $start . "," . $limit;
        }
        return $this->db->query($sql);
    }

    public function lookup_kkn_m_kelompok()
    {
        return $this->db->get("kkn_m_kelompok");
    }

    public function get_kelompok($id)
    {
        $this->db->where('id_kelompok', $id);
        return $this->db->get("kkn_m_kelompok");
    }

    public function lookup__m_usr_login()
    {
        return $this->db->get("_m_usr_login");
    }

    public function delete_plotting_kkn($id)
    {
        $tabelku = "kkn_plot";
        $this->db->where('id_plot', $id);
        return $this->db->delete($tabelku);
    }

    public function get_member_by_kelompok($id)
    {
        $sql = "
		SELECT A.*,C.nama_kelompok as nama_kelompok_lookup,D.nama as nama_lookup FROM kkn_plot A
		LEFT JOIN kkn_m_kelompok C ON A.kelompok=C.id_kelompok
		LEFT JOIN _m_usr_login D ON A.anggota=D.userid
		WHERE A.kelompok=" . $this->db->escape($id);

        return $this->db->query($sql);
    }
}
