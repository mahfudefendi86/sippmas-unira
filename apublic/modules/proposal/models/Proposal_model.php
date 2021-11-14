<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Proposal_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_proposal($data_array){
			$input=$this->db->insert('pr_penelitian_proposal', $data_array);
			return $input;
		}

		function update_proposal($data_array,$id){
			$this->db->where('id_proposal',$id);
			$update=$this->db->update('pr_penelitian_proposal', $data_array);
			return $update;
		}

		function get_by_id_proposal($id){
			$this->db->select('*')->from('pr_penelitian_proposal');
			$this->db->where('id_proposal',$id);
			return  $this->db->get();
		}

		function show_data_proposal($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.judul_penelitian as judul_penelitian_lookup FROM pr_penelitian_proposal A 
				  LEFT JOIN pr_penelitian B ON A.id_penelitian=B.id_penelitian ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_pr_penelitian(){ return $this->db->get("pr_penelitian"); }

		function delete_proposal($id){
			$tabelku="pr_penelitian_proposal";
			$this->db->where('id_proposal',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pr_penelitian_proposal');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}