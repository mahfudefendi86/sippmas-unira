<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Keahlian_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_keahlian($data_array){
			$input=$this->db->insert('tbl_bidang_keahlian', $data_array);
			return $input;
		}

		function update_keahlian($data_array,$id){
			$this->db->where('id_bidangkeahlian',$id);
			$update=$this->db->update('tbl_bidang_keahlian', $data_array);
			return $update;
		}

		function get_by_id_keahlian($id){
			$this->db->select('*')->from('tbl_bidang_keahlian');
			$this->db->where('id_bidangkeahlian',$id);
			return  $this->db->get();
		}

		function show_data_keahlian($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM tbl_bidang_keahlian A  ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function delete_keahlian($id){
			$tabelku="tbl_bidang_keahlian";
			$this->db->where('id_bidangkeahlian',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('tbl_bidang_keahlian');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}
