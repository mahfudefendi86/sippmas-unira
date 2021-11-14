<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Prodi_model extends CI_Model {
	
		function __construct()
		{
			parent::__construct();
		}

		function input_prodi($data_array){
			$input=$this->db->insert('tbl_prodi', $data_array);
			return $input;
		}

		function update_prodi($data_array,$id){
			$this->db->where('id_prodi',$id);
			$update=$this->db->update('tbl_prodi', $data_array);
			return $update;
		}

		function get_by_id_prodi($id){
			$this->db->select('*')->from('tbl_prodi');
			$this->db->where('id_prodi',$id);
			return  $this->db->get();
		}

		function show_data_prodi($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.nama_fakultas as nama_fakultas_lookup FROM tbl_prodi A 
				  LEFT JOIN tbl_fakultas B ON A.id_fakultas=B.id_fakultas ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_tbl_fakultas(){ return $this->db->get("tbl_fakultas"); }

		function delete_prodi($id){
			$tabelku="tbl_prodi";
			$this->db->where('id_prodi',$id);
			return $this->db->delete($tabelku); 
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('tbl_prodi');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}