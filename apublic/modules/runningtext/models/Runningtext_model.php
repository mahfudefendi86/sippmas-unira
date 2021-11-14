<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Runningtext_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_runningtext($data_array){
			$input=$this->db->insert('pub_running_text', $data_array);
			return $input;
		}

		function update_runningtext($data_array,$id){
			$this->db->where('id_running',$id);
			$update=$this->db->update('pub_running_text', $data_array);
			return $update;
		}

		function get_by_id_runningtext($id){
			$this->db->select('*')->from('pub_running_text');
			$this->db->where('id_running',$id);
			return  $this->db->get();
		}

		function show_data_runningtext($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM pub_running_text A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_runningtext($id){
			$tabelku="pub_running_text";
			$this->db->where('id_running',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pub_running_text');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}