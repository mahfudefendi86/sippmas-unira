<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Reviewer_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_reviewer($data_array){
			$input=$this->db->insert('tbl_reviewer', $data_array);
			return $input;
		}

		function update_reviewer($data_array,$id){
			$this->db->where('id_user',$id);
			$update=$this->db->update('tbl_reviewer', $data_array);
			return $update;
		}

		function get_by_id_reviewer($id){
			$sql="SELECT A.*,B.name as nama_desa,C.name as nama_kecamatan,D.name as nama_kota,E.nama_fakultas,F.nama_prodi,G.nama_bidang as nama_bidang_keahlian, H.bidang_ilmu as nama_bidang_ilmu FROM tbl_reviewer A
				  LEFT JOIN _m_desa B ON A.desa=B.id
				  LEFT JOIN _m_kecamatan C ON A.kecamatan=C.id
				  LEFT JOIN _m_kotakab D ON A.kota_kab=D.id
				  LEFT JOIN tbl_fakultas E ON A.fakultas=E.id_fakultas
				  LEFT JOIN tbl_prodi F ON A.prodi=F.id_prodi
				  LEFT JOIN tbl_bidang_keahlian G ON A.bidang_keahlian=G.id_bidangkeahlian
				  LEFT JOIN tbl_bidang_keahlian_ilmu H ON A.bidang_ilmu=H.id_bidangilmu
				  WHERE A.id_user='".$id."' ";
			return $this->db->query($sql);
		}

		function show_data_reviewer($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.name as desa,C.name as kecamatan,D.name as kota,E.nama_fakultas,F.nama_prodi FROM tbl_reviewer A
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

		function delete_reviewer($id){
			$tabelku="tbl_reviewer";
			$this->db->where('id_user',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('tbl_reviewer');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}
