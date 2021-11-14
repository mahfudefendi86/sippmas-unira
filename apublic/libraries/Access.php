<?php if(!defined('BASEPATH'))exit('No direct script acces allowed');

class Access
{
	public $user;
	protected $CI;
	/** COnstruktor */

	function __construct()
	{
		$this->CI =& get_instance();
		//$auth = $this->CI->config->item('auth');

		$this->CI->load->helper('cookie');
		$this->CI->load->model('cekin_model');

		$this->cekin_model =& $this->CI->cekin_model;
	}

	/*cek Login User*/
	function login($username,$password)
	{
		$result=$this->cekin_model->get_login_info($username);
		if($result)
		{
			//cek akses bagian
			//if($result->identifikasi=="ADM" || $result->identifikasi=="SUA" || $result->identifikasi=="PENELITI"  || $result->identifikasi=="REVIEWER" ){
				$password=do_hash('de23239mex'.$password.'by4489#&4','md5');
				if($password === $result->password)
				{
					if($result->status=="AKTIF"){
						$this->CI->session->set_userdata('id_user',$result->userid);
						$this->CI->session->set_userdata('akses',$result->identifikasi);
						$this->CI->session->set_userdata('nama',$result->nama);
						$this->CI->session->set_userdata('status',$result->status);
						return TRUE;
					}
					return FALSE;
				}
				return FALSE;
			//}
			//return FALSE;
		}
		return FALSE;
	}

	/* cek Apakah sudah login atau belum*/
	function is_login()
	{
		return (($this->CI->session->userdata('id_user') ) ? TRUE : FALSE);
	}

	/** Logout */
	function logout()
	{
		$this->CI->session->unset_userdata('id_user');
		$this->CI->session->unset_userdata('akses');
		$this->CI->session->unset_userdata('nama');
		$this->CI->session->unset_userdata('status');
		$this->CI->session->sess_destroy();
	}


}
