<?php if(!defined('BASEPATH'))exit('No direct script acces allowed');

class Member_login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('access');
		$this->load->model(array('cekin_model'));
	}

	function index()
	{
		//$this->access->logout();
		$this->login();
	}

	function login()
	{
		if($this->session->userdata('id_user')){
			redirect('main/dashboard');
		}
		$this->load->library('form_validation');
		$this->load->helper('form');

		// $this->form_validation->set_rules('username','Username','trim|required|strip_tags');
		// $this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('token','token','callback_check_login');///memanggil fungsi check_login

		if($this->form_validation->run() == FALSE)
		{
			$data['title']="SIPPMas (Sistem Informasi Penelitian Dan Pengabdian Masyarakat)";
			$this->template->login('member/login-form',$data); ///diarahkan pada template halaman login
		}
		else
		{
			return $this->control_user();
		}
	}

	function control_user()
	{
			///$data['user']=$this->userlogin_model->get_by_id_userlogin($this->session->userdata('id_user'))->row();
			redirect('main/dashboard');
	}


	function logout()
	{
		$this->access->logout();
		redirect('member_login/login');
	}

	function check_login()
	{
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);

		$login= $this->access->login($username,$password);
		if($login)
		{
			return TRUE;
		}
		else
		{
			$msg='Username atau password anda tidak sesuai, silahkan diulang...';
			$this->form_validation->set_message('check_login',$msg);
			return FALSE;
		}
	}


	/*** RESET PASSWORD BY EMAIL ***/
	function reset_form(){
		$data['title']="Reset Password SIPPMAS";
		$this->template->login('member/lupa_password',$data); ///diarahkan pada template halaman login
	}

	function reset_password(){
		$email = $this->input->post('email',TRUE);
		if($email!="" || $email!=NULL){
			$reset= $this->access->reset_password($email);
			if($reset=="500"){
				$data['info']="Akun anda tidak aktif!";
				$data['content']="Untuk dapat menikmati fasilitas yang terdapat pada aplikasi ini, silahkan hubungi administrator SIPPMAS dan lakukan verifikasi data";
				$data['status']="error";
			}else
			if($reset=="404"){
				$data['info']="Akun tidak ditemukan!";
				$data['content']="Sistem kami tidak berhasil mendeteksi keberadaan akun/email anda, silahkan hubungi administrator SIPPMAS.";
				$data['status']="warning";
			}else
			if($reset=="error"){
				$data['info']="Reset Password Gagal!";
				$data['content']="Terjadi kesalahan saat sistem memproses password akun anda. Mohon untuk mengulangi proses Reset Password.";
				$data['status']="error";
			}else{
				$data['info']="Reset Password Sukses!";
				$data['content']="Selamat!, Proses reset password anda berhasil.<br/><br/>Kami telah mengirimkan password melalui alamat email anda. Silahkan periksa pada kotak masuk (inbox) atau folder spam pada akun email anda (".$email.").";
				$data['status']="sukses";
				/*** Jika berhasil maka lakukan kirim email ***/
				$send['dari_nama']=$this->config->item('email_name');
				$send['dari']=$this->config->item('email_address');
				$send['tujuan']=$email;
				$send['subject']='Reset Password';

				$message=$this->load->view('member/email_reset_password','',true);
				$send['pesan']=$message;
				$send['cc']="";
				//kirim_email($send);
			}

			$this->template->login('member/lupa_password',$data);
		}
	}
	
	/*API JSON LOGIN */
	function APIRequestLogin(){
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);

		if ($username!="" && $password!="") {

			$login= $this->access->login($username,$password);

			if($login){
				$result=$this->cekin_model->get_login_info($username);
				$data['user']['nama']=$result->nama;
				$data['user']['email']=$username;
				$data['user']['uid']=$result->uid;
				$data['user']['level']=$result->level;
				$data['user']['hp']=$result->nomer_hp;
				$data['user']['created_at']=$result->created_at;
				$data['status']="sukses";
				$data['pesan']="Anda berhasil Login!!";
				/*ambil tahun ajaran aktif*/
				$t=$this->tahunajaran_model->show_data_tahunajaran(" WHERE A.status='A' ");
				if($t->num_rows()>0){
					$tahun=$t->row();
					$data['tahunajaran']['id_tahun_ajaran']=$tahun->id_tahun_ajaran;
					$data['tahunajaran']['tahun']=$tahun->nama_tahun_ajaran;
					$data['tahunajaran']['semester']=$tahun->nama_semester;
				}else{
					$data['tahunajaran']['id_tahun_ajaran']="";
					$data['tahunajaran']['tahun']="";
					$data['tahunajaran']['semester']="";
				}
				echo json_encode($data);
			}else{
				$log=array("status"=>"gagal","pesan"=>"Autentifikasi Login gagal. Silahkan coba lagi!!");
				echo json_encode($log);
			}
		}else{
			$log=array("status"=>"gagal","pesan"=>"Username atau Password anda tidak cocok!!");
			echo json_encode($log);
		}

	}




}
