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



}
