<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Bidang_ilmu_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_bidang_ilmu($data_array){
			$input=$this->db->insert('tbl_bidang_keahlian_ilmu', $data_array);
			return $input;
		}

		function update_bidang_ilmu($data_array,$id){
			$this->db->where('id_bidangilmu',$id);
			$update=$this->db->update('tbl_bidang_keahlian_ilmu', $data_array);
			return $update;
		}

		function get_by_id_bidang_ilmu($id){
			$this->db->select('*')->from('tbl_bidang_keahlian_ilmu');
			$this->db->where('id_bidangilmu',$id);
			return  $this->db->get();
		}

		function show_data_bidang_ilmu($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.nama_bidang as nama_bidang_lookup FROM tbl_bidang_keahlian_ilmu A 
				  LEFT JOIN tbl_bidang_keahlian B ON A.id_bidangkeahlian=B.id_bidangkeahlian ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_tbl_bidang_keahlian(){ return $this->db->get("tbl_bidang_keahlian"); }

		function delete_bidang_ilmu($id){
			$tabelku="tbl_bidang_keahlian_ilmu";
			$this->db->where('id_bidangilmu',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('tbl_bidang_keahlian_ilmu');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}