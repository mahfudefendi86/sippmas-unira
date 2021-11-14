<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Fakultas_model extends CI_Model {
	
		function __construct()
		{
			parent::__construct();
		}

		function input_fakultas($data_array){
			$input=$this->db->insert('tbl_fakultas', $data_array);
			return $input;
		}

		function update_fakultas($data_array,$id){
			$this->db->where('id_fakultas',$id);
			$update=$this->db->update('tbl_fakultas', $data_array);
			return $update;
		}

		function get_by_id_fakultas($id){
			$this->db->select('*')->from('tbl_fakultas');
			$this->db->where('id_fakultas',$id);
			return  $this->db->get();
		}

		function show_data_fakultas($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM tbl_fakultas A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_fakultas($id){
			$tabelku="tbl_fakultas";
			$this->db->where('id_fakultas',$id);
			return $this->db->delete($tabelku); 
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('tbl_fakultas');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}