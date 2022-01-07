<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Peserta_kkn_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function input_peserta_kkn($data_array)
    {
        $input = $this->db->insert('kkn_peserta_registrasi', $data_array);
        return $input;
    }

    public function update_peserta_kkn($data_array, $id)
    {
        $this->db->where('id_peserta', $id);
        $update = $this->db->update('kkn_peserta_registrasi', $data_array);
        return $update;
    }

    public function get_by_id_peserta_kkn($id)
    {
        $this->db->select('*')->from('kkn_peserta_registrasi');
        $this->db->where('id_peserta', $id);
        return $this->db->get();
    }

    public function show_data_peserta_kkn($option = null, $start = null, $limit = null)
    {
        // $sql = "SELECT A.*,B.nama_fakultas as nama_fakultas, C.nama_prodi as nama_prodi
        //         FROM kkn_peserta_registrasi A
        //         LEFT JOIN tbl_fakultas B ON A.id_fakultas=B.id_fakultas
        //         LEFT JOIN tbl_prodi C ON A.id_prodi=C.id_prodi ";
        $sql = "SELECT X.status, A.* , B.nama_fakultas as nama_fakultas, C.nama_prodi as nama_prodi
                FROM _m_usr_login X
                LEFT JOIN kkn_peserta_registrasi A ON X.userid = A.id_peserta
                LEFT JOIN tbl_fakultas B ON A.id_fakultas=B.id_fakultas
                LEFT JOIN tbl_prodi C ON A.id_prodi=C.id_prodi
                "; //WHERE X.identifikasi = 'MAHASISWA'";
        if ($option != null) {
            $sql .= $option;
        }
        if ($start != null && $limit != null) {
            $sql .= " LIMIT " . $start . "," . $limit;
        }
        return $this->db->query($sql);
    }

    public function lookup_tbl_fakultas()
    {
        return $this->db->get("tbl_fakultas");
    }
    public function lookup_tbl_prodi()
    {
        return $this->db->get("tbl_prodi");
    }

    public function delete_peserta_kkn($id)
    {
        $tabelku = "kkn_peserta_registrasi";
        if (is_array($id)) {
            $this->db->where_in('id_peserta', $id);
        } else {
            $this->db->where('id_peserta', $id);
        }
        return $this->db->delete($tabelku);
    }

    public function delete_user_login($userid)
    {
        $tabelku = "_m_usr_login";
        if (is_array($userid)) {
            $this->db->where_in('userid', $userid);
        } else {
            $this->db->where('userid', $userid);
        }
        return $this->db->delete($tabelku);
    }

    public function select_user_login($userid)
    {
        return $this->db->get_where('_m_usr_login', ['userid' => $userid]);
    }

    public function update_usr_mhs($data, $userid)
    {
        $this->db->where('userid', $userid);
        return $this->db->update('_m_usr_login', $data);
    }
}