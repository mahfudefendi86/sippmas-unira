<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Capaian_lain_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_capaian_lain($data_array){
			$input=$this->db->insert('pr_penelitian_capaian_lain', $data_array);
			return $input;
		}

		function update_capaian_lain($data_array,$id){
			$this->db->where('id_lain',$id);
			$update=$this->db->update('pr_penelitian_capaian_lain', $data_array);
			return $update;
		}

		function get_by_id_capaian_lain($id){
			$this->db->select('*')->from('pr_penelitian_capaian_lain');
			$this->db->where('id_lain',$id);
			return  $this->db->get();
		}

		function show_data_capaian_lain($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM pr_penelitian_capaian_lain A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_capaian_lain($id){
			$tabelku="pr_penelitian_capaian_lain";
			$this->db->where('id_lain',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pr_penelitian_capaian_lain');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}