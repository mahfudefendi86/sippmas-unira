<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Nilairev_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_nilairev($data_array){
			$input=$this->db->insert('pr_penelitian_cetak_pdf', $data_array);
			return $input;
		}

		function update_nilairev($data_array,$id){
			$this->db->where('id_ctk',$id);
			$update=$this->db->update('pr_penelitian_cetak_pdf', $data_array);
			return $update;
		}

		function get_nilairev($id_penelitian,$id_user){
			$this->db->select('*')->from('pr_penelitian_cetak_pdf');
			$this->db->where('jenis_cetak','nilai');
			$this->db->where('id_penelitian',$id_penelitian);
			$this->db->where('id_user',$id_user);
			return  $this->db->get();
		}


		// function input_nilairev($data_array){
		// 	$input=$this->db->insert('pr_penelitian_nilai_rev', $data_array);
		// 	return $input;
		// }
		//
		// function update_nilairev($data_array,$id){
		// 	$this->db->where('id_nilai',$id);
		// 	$update=$this->db->update('pr_penelitian_nilai_rev', $data_array);
		// 	return $update;
		// }
		//
		// function get_by_id_nilairev($id){
		// 	$this->db->select('*')->from('pr_penelitian_nilai_rev');
		// 	$this->db->where('id_nilai',$id);
		// 	return  $this->db->get();
		// }

		// function show_data_nilairev($option=NULL,$start=NULL,$limit=NULL){
		// 	$sql="SELECT A.* FROM pr_penelitian_nilai_rev A ";
		// 	if($option!=NULL){
		// 		 $sql.=$option;
		// 	 }
		// 	 if($start!=NULL && $limit!=NULL){
		// 		 $sql.=" LIMIT ".$start.",".$limit ;
		// 	 }
		// 	return $this->db->query($sql);
		// }
		//
		//
		// function delete_nilairev($id){
		// 	$tabelku="pr_penelitian_nilai_rev";
		// 	$this->db->where('id_nilai',$id);
		// 	return $this->db->delete($tabelku);
		// }
		//
		// function cek_data($field,$id){
		// 	$this->db->select('*')->from('pr_penelitian_nilai_rev');
		// 	$this->db->where($field,$id);
		// 	return  $this->db->get();
		// }
}
