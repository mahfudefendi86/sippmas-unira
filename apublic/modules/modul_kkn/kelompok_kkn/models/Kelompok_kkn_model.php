<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kelompok_kkn_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function input_kelompok_kkn($data_array)
    {
        $input = $this->db->insert('kkn_m_kelompok', $data_array);
        return $input;
    }

    public function update_kelompok_kkn($data_array, $id)
    {
        $this->db->where('id_kelompok', $id);
        $update = $this->db->update('kkn_m_kelompok', $data_array);
        return $update;
    }

    public function get_by_id_kelompok_kkn($id)
    {
        $this->db->select('*')->from('kkn_m_kelompok');
        $this->db->where('id_kelompok', $id);
        return $this->db->get();
    }

    public function show_data_kelompok_kkn($option = null, $start = null, $limit = null)
    {
        $sql = "SELECT A.*,C.nama_tempat as nama_tempat_lookup,E.nama as nama_lookup FROM kkn_m_kelompok A
				  LEFT JOIN kkn_m_tempat C ON A.id_tempat=C.id_tempat
				  LEFT JOIN _m_usr_login E ON A.ketua_kelompok=E.userid ";
        if ($option != null) {
            $sql .= $option;
        }
        if ($start != null && $limit != null) {
            $sql .= " LIMIT " . $start . "," . $limit;
        }
        return $this->db->query($sql);
    }

    public function lookup_kkn_m_tempat()
    {
        return $this->db->get("kkn_m_tempat");
    }
    public function lookup__m_usr_login()
    {
        $this->db->where('identifikasi', 'MAHASISWA');
        $this->db->where('status', 'AKTIF');
        return $this->db->get("_m_usr_login");
    }

    public function delete_kelompok_kkn($id)
    {
        $tabelku = "kkn_m_kelompok";
        $this->db->where('id_kelompok', $id);
        return $this->db->delete($tabelku);
    }
}