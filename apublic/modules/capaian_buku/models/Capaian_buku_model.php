<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Capaian_buku_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_capaian_buku($data_array){
			$input=$this->db->insert('pr_penelitian_capaian_buku', $data_array);
			return $input;
		}

		function update_capaian_buku($data_array,$id){
			$this->db->where('id_buku',$id);
			$update=$this->db->update('pr_penelitian_capaian_buku', $data_array);
			return $update;
		}

		function get_by_id_capaian_buku($id){
			$this->db->select('*')->from('pr_penelitian_capaian_buku');
			$this->db->where('id_buku',$id);
			return  $this->db->get();
		}

		function show_data_capaian_buku($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM pr_penelitian_capaian_buku A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_capaian_buku($id){
			$tabelku="pr_penelitian_capaian_buku";
			$this->db->where('id_buku',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pr_penelitian_capaian_buku');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}