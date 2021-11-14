<?php if(!defined('BASEPATH'))exit('No direct script acces allowed');

class Cekin_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_login_info($username)
	{
		$sql="SELECT A.* FROM _m_usr_login A WHERE A.username='".$username."' LIMIT 1 ";
		$query=$this->db->query($sql);
		return ($query->num_rows()>0) ? $query->row() : FALSE;
	}

	function get_user($email)
	{
		$sql="
		SELECT A.*,B.id_login,B.userid,B.password,B.identifikasi,B.status 
		FROM tbl_peneliti A 
		LEFT JOIN _m_usr_login B ON B.userid=A.id_user 
		WHERE A.email=".$this->db->escape($email)." LIMIT 1 ";
		return $this->db->query($sql);
	}

	function update_userlogin($data,$id){
		$this->db->where('id_login',$id);
		$update=$this->db->update('_m_usr_login', $data);
		return $update;
	}

}
