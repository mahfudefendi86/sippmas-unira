<?php if(!defined('BASEPATH'))exit('No direct script acces allowed');

class Member_Control extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())
		{
			redirect('member_login/login');
		}

	}

	function is_login()
	{
		return $this->access->is_login();
	}

}

class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

}
