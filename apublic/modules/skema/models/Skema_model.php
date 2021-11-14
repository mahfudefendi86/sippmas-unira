<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Skema_model extends CI_Model {
	
		function __construct()
		{
			parent::__construct();
		}

		function input_skema($data_array){
			$input=$this->db->insert('tbl_skema', $data_array);
			return $input;
		}

		function update_skema($data_array,$id){
			$this->db->where('id_skema',$id);
			$update=$this->db->update('tbl_skema', $data_array);
			return $update;
		}

		function get_by_id_skema($id){
			$this->db->select('*')->from('tbl_skema');
			$this->db->where('id_skema',$id);
			return  $this->db->get();
		}

		function show_data_skema($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM tbl_skema A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_skema($id){
			$tabelku="tbl_skema";
			$this->db->where('id_skema',$id);
			return $this->db->delete($tabelku); 
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('tbl_skema');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}