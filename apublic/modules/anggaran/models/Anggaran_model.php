<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Anggaran_model extends CI_Model {
	
		function __construct()
		{
			parent::__construct();
		}

		function input_anggaran($data_array){
			$input=$this->db->insert('tbl_thn_anggaran', $data_array);
			return $input;
		}

		function update_anggaran($data_array,$id){
			$this->db->where('id_anggaran',$id);
			$update=$this->db->update('tbl_thn_anggaran', $data_array);
			return $update;
		}

		function get_by_id_anggaran($id){
			$this->db->select('*')->from('tbl_thn_anggaran');
			$this->db->where('id_anggaran',$id);
			return  $this->db->get();
		}

		function show_data_anggaran($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM tbl_thn_anggaran A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_anggaran($id){
			$tabelku="tbl_thn_anggaran";
			$this->db->where('id_anggaran',$id);
			return $this->db->delete($tabelku); 
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('tbl_thn_anggaran');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}