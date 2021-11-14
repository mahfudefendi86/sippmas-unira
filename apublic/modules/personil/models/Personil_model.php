<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Personil_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_personil($data_array){
			$input=$this->db->insert('pr_penelitian_personil', $data_array);
			return $input;
		}

		function update_personil($data_array,$id){
			$this->db->where('id_personil',$id);
			$update=$this->db->update('pr_penelitian_personil', $data_array);
			return $update;
		}

		function get_by_id_personil($id){
			$this->db->select('*')->from('pr_penelitian_personil');
			$this->db->where('id_personil',$id);
			return  $this->db->get();
		}

		function show_data_personil($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.judul_penelitian as judul_penelitian_lookup,C.nama as nama_lookup,D.nama_prodi as nama_prodi_lookup FROM pr_penelitian_personil A 
				  LEFT JOIN pr_penelitian B ON A.id_penelitian=B.id_penelitian
				  LEFT JOIN tbl_peneliti C ON A.id_user=C.id_user
				  LEFT JOIN tbl_prodi D ON A.program_studi=D.id_prodi ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_pr_penelitian(){ return $this->db->get("pr_penelitian"); }
		function lookup_tbl_peneliti(){ return $this->db->get("tbl_peneliti"); }
		function lookup_tbl_prodi(){ return $this->db->get("tbl_prodi"); }

		function delete_personil($id){
			$tabelku="pr_penelitian_personil";
			$this->db->where('id_personil',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pr_penelitian_personil');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}