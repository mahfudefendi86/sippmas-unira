<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Peneliti_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_peneliti($data_array){
			$input=$this->db->insert('tbl_peneliti', $data_array);
			return $input;
		}

		function update_peneliti($data_array,$id){
			$this->db->where('id_user',$id);
			$update=$this->db->update('tbl_peneliti', $data_array);
			return $update;
		}

		function get_by_id_peneliti($id){
			$sql="SELECT A.*,B.name as nama_desa,C.name as nama_kecamatan,D.name as nama_kota,E.nama_fakultas,F.nama_prodi FROM tbl_peneliti A
				  LEFT JOIN _m_desa B ON A.desa=B.id
				  LEFT JOIN _m_kecamatan C ON A.kecamatan=C.id
				  LEFT JOIN _m_kotakab D ON A.kota_kab=D.id
				  LEFT JOIN tbl_fakultas E ON A.fakultas=E.id_fakultas
				  LEFT JOIN tbl_prodi F ON A.prodi=F.id_prodi
				  WHERE A.id_user='".$id."' ";
			return $this->db->query($sql);
		}

		function show_data_peneliti($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.name as desa,C.name as kecamatan,D.name as kota,E.nama_fakultas,F.nama_prodi FROM tbl_peneliti A
				  LEFT JOIN _m_desa B ON A.desa=B.id
				  LEFT JOIN _m_kecamatan C ON A.kecamatan=C.id
				  LEFT JOIN _m_kotakab D ON A.kota_kab=D.id
				  LEFT JOIN tbl_fakultas E ON A.fakultas=E.id_fakultas
				  LEFT JOIN tbl_prodi F ON A.prodi=F.id_prodi ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function delete_peneliti($id){
			$tabelku="tbl_peneliti";
			$this->db->where('id_user',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('tbl_peneliti');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}
