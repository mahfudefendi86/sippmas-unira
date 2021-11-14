<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Userlogin_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_userlogin($data_array){
			$input=$this->db->insert('_m_usr_login', $data_array);
			return $input;
		}

		function update_userlogin($data_array,$id){
			$this->db->where('id_login',$id);
			$update=$this->db->update('_m_usr_login', $data_array);
			return $update;
		}

		function get_by_id_userlogin($id){
			$this->db->select('*')->from('_m_usr_login');
			$this->db->where('id_login',$id);
			return  $this->db->get();
		}

		function get_by_userid($id){
			$this->db->select('*')->from('_m_usr_login');
			$this->db->where('userid',$id);
			return  $this->db->get();
		}

		function show_data_userlogin($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,
			(select id_user from tbl_peneliti x where x.id_user=A.userid
			UNION ALL
			select id_user from tbl_reviewer y  where y.id_user=A.userid
			) as is_ada
			FROM _m_usr_login A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_userlogin($id){
			$tabelku="_m_usr_login";
			$this->db->where('id_login',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('_m_usr_login');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}
