<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Berkas_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_berkas($data_array){
			$input=$this->db->insert('pr_penelitian_berkas', $data_array);
			return $input;
		}

		function update_berkas($data_array,$id){
			$this->db->where('id_berkas',$id);
			$update=$this->db->update('pr_penelitian_berkas', $data_array);
			return $update;
		}

		function get_by_id_berkas($id){
			$this->db->select('*')->from('pr_penelitian_berkas');
			$this->db->where('id_berkas',$id);
			return  $this->db->get();
		}

		function show_data_berkas($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM pr_penelitian_berkas A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_berkas($id){
			$tabelku="pr_penelitian_berkas";
			$this->db->where('id_berkas',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pr_penelitian_berkas');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}