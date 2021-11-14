<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Status_aktif_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_status_aktif($data_array){
			$input=$this->db->insert('pr_penelitian_status_nonaktif', $data_array);
			return $input;
		}

		function update_status_aktif($data_array,$id){
			$this->db->where('id_status_author',$id);
			$update=$this->db->update('pr_penelitian_status_nonaktif', $data_array);
			return $update;
		}

		function get_by_id_status_aktif($id){
			$sql="SELECT A.*,B.nama as nama_lookup FROM pr_penelitian_status_nonaktif A
				  LEFT JOIN tbl_peneliti B ON A.id_peneliti=B.id_user
				  WHERE A.id_status_author='".$id."' ";
			return $this->db->query($sql);
		}

		function show_data_status_aktif($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.nama as nama_lookup FROM pr_penelitian_status_nonaktif A
				  LEFT JOIN tbl_peneliti B ON A.id_peneliti=B.id_user ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_tbl_peneliti(){ return $this->db->get("tbl_peneliti"); }

		function delete_status_aktif($id){
			$tabelku="pr_penelitian_status_nonaktif";
			$this->db->where('id_status_author',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pr_penelitian_status_nonaktif');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}
