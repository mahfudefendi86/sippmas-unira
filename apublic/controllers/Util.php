<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
set_time_limit(0);

class Util extends Member_Control {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('format_tanggal','url','global_function'));
	 }

	 function backup(){
	 	$this->template->display('util/backup');
	 }

	 function restore(){
	 	$this->template->display('util/restore');
	 }

	 function proses_backup($tables = '*'){
	 	$nama_file= date('Y-m-d_His').'_klinikmitra_db.sql';
		$return='';

		if($tables == '*')
			{
				$tables = array();
				$result = mysql_query('SHOW TABLES');
				while($row = mysql_fetch_row($result))
				{
					$tables[] = $row[0];
				}
			}else{
				//jika hanya table-table tertentu
				$tables = is_array($tables) ? $tables : explode(',',$tables);
			}

	//looping dulu ah
		foreach($tables as $table)
		{
			$result = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);

			//menyisipkan query drop table untuk nanti hapus table yang lama
			$return.= 'DROP TABLE '.$table.';';
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";

			for ($i = 0; $i < $num_fields; $i++)
			{
				while($row = mysql_fetch_row($result))
				{
					//menyisipkan query Insert. untuk nanti memasukan data yang lama ketable yang baru dibuat. so toy mode : ON
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++)
					{
						//akan menelusuri setiap baris query didalam
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}

		$handle = fopen('db_bak/'.$nama_file,'w+');
		fwrite($handle,$return);
		fclose($handle);
	 	echo $nama_file;
	 }

	 function download_file($file){
		 // header yang menunjukkan nama file yang akan didownload
		header("Content-Disposition: attachment; filename=".$file);

		// header yang menunjukkan ukuran file yang akan didownload
		header("Content-length: ".$file);

		// header yang menunjukkan jenis file yang akan didownload
		header("Content-type: ".$file);

	   // proses membaca isi file yang akan didownload dari folder 'data'
	   $fp  = fopen("db_bak/".$file, 'r');
	   $content = fread($fp, filesize('db_bak/'.$file));
	   fclose($fp);

	   // menampilkan isi file yang akan didownload
	   echo $content;

	   exit;
	 }

	 function proses_restore(){

		$nama_file=$_FILES['datafile']['name'];
		$ukuran=$_FILES['datafile']['size'];

		//periksa jika data yang dimasukan belum lengkap
		if ($nama_file=="")
		{
			echo "Fatal Error";
		}else{
			//definisikan variabel file dan alamat file
			$uploaddir='db_res/';
			$alamatfile=$uploaddir.$nama_file;

			//periksa jika proses upload berjalan sukses
			if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile))
			{

				$filename = 'db_res/'.$nama_file;

				// Temporary variable, used to store current query
				$templine = '';
				// Read in entire file
				$lines = file($filename);
				// Loop through each line
				foreach ($lines as $line)
				{
					// Skip it if it's a comment
					if (substr($line, 0, 2) == '--' || $line == '')
						continue;

					// Add this line to the current segment
					$templine .= $line;
					// If it has a semicolon at the end, it's the end of the query
					if (substr(trim($line), -1, 1) == ';')
					{
						// Perform the query
						mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
						// Reset temp variable to empty
						$templine = '';
					}
				}
				echo '<div style="width:450px; height:50px; background: #CFD6FE; border:1px solid #0066FF; margin:auto; padding:10px; text-align:center">Berhasil Restore Database, silahkan di cek.<br/>
				<a href="'.site_url('util/restore').'" title="Kembali">.: Kembali :.</a>
				</div>';

			}else{
				//jika gagal
				echo '<div style="width:450px; height:50px; background: #CFD6FE; border:1px solid #0066FF; margin:auto; padding:10px; text-align:center">Proses upload gagal, kode error = ' . $_FILES['location']['error'].'</div>';
			}
		}

	 }


	/*** GANTI PASSWORD ***/

	///Membuat setup Capthca
	 private function _create_captcha()
	{
	  // we will first load the helper. We will not be using autoload because we only need it here
	  $this->load->helper('captcha');
	  // we will set all the variables needed to create the captcha image
		$options = array(
						'img_path'   => './captcha/',
						'img_url'    => base_url().'captcha/',
						'img_width'  => 150,
						'img_height' => 40,
						'border' => 0,
						'expiration' => 7200
					);
	  //now we will create the captcha by using the helper function create_captcha()
	  $cap = create_captcha($options);
	  // we will store the image html code in a variable
	  $image = $cap['image'];

	  // ...and store the captcha word in a session
	  $this->session->set_userdata('kode_capthca', $cap['word']);
	  // we will return the image html
	  return $image;
	}

	function gantipass(){
		//Cegah user menggunakan fungsi sebelum melakukan login, karena controller tidak ikut Member Controller
		if($this->session->userdata('id_user')){
			$data['image'] = $this->_create_captcha();
			$this->template->mainview('util/ganti_psw',$data);
		}else{
			///Abaikan kondisi ini
			echo '<h1>Maaf, Anda Belum Login</h1>';
		}
	}

	function simpan_password(){
	//Cegah user menggunakan fungsi sebelum melakukan login, karena controller tidak ikut Member Controller
	if($this->session->userdata('id_user')){
	 	$in=$this->input->post(null,true);
	 		$p1=create_password($in['p1']);
			$p2=$in['p2'];
			$p3=$in['p3'];
			$cap=$in['security_code'];
			//$cek=mysql_query("SELECT * FROM app_user WHERE IDUser='".$in['id']."' limit 0,1");
			//$data=mysql_fetch_array($cek);
			$sql="SELECT * FROM _m_usr_login WHERE userid='".$in['id']."' limit 1 ";
			$user=$this->db->query($sql)->row();

			if($cap==$this->session->userdata('kode_capthca')){
				if($p1!=$user->password){
					$data['info']= '<br />
					 <div class="alert alert-danger">Maaf Password yang anda masukkan salah, silahkan coba lagi...
					<a href="'.site_url('util/gantipass').'" title="Ganti Password" class="btn btn-xs btn-warning">Kembali</a></div>
					';
				}else{
					if($p2!=$p3){
						$data['info']= '<br />
						 <div class="alert alert-danger">Maaf Password Konfirmasi Anda tidak sama...
						 <a href="'.site_url('util/gantipass').'" title="Ganti Password" class="btn btn-xs btn-warning">Kembali</a></div>
						 ';
					}
					else{
						$data_array=array('password'=>create_password($p2));
						//$q=mysql_query("UPDATE app_user SET password='".md5($p2)."' WHERE IDUser='".$in['id']."'");
						$this->db->where('userid',$in['id']);
						$q=$this->db->update('_m_usr_login', $data_array);
						if($q){
							$data['info']= '<br />
							 <div class="alert alert-success">Password anda berhasil diubah...silahkan login kembali untuk memastikan<br /><br />
							 <a href="'.site_url('member_login/logout').'" title="logout" class="btn btn-xs btn-warning">[Logout]</a></div>
							';
						}
					}
				}

			}else{

				$data['info']= '<br />
				 <div class="alert alert-danger">Maaf Kode Capthca anda tidak sama...
					 <a href="'.site_url('util/gantipass').'" title="Ganti Password" class="btn btn-xs btn-warning">Kembali</a></div>
				';
			}
			///Hapus session ketika salah atupun selesai
			$this->session->unset_userdata('kode_capthca');
			$this->template->display('util/ganti_psw',$data);
		}else{
			//abaikan kondisi jika userbelum login dengan menampilkan halaman kosong
			echo '<h1>Maaf, Anda Belum Login</h1>';
		}
	 }

	 function link_reset_psw(){
	 	$in=$this->input->post(null,true);
		if(!$in){
	 		$this->load->view('util/form_reset_psw');
		}else{
			///cek Validasi Email
			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
			$email=$in['email'];
			if(empty($email)){
				$data['info']="<h3><font color=white>Anda belum memasukkan apapun..</font></h3>
				<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
			}
			else
			if (!preg_match($regex,$email)){
				$data['info']= "<h3><font color=white>Email anda tidak valid...</font></h3>
				<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
			}else{
				//cek Email terdaftar atau belum
				$sql=mysql_query("SELECT * FROM app_user WHERE email='".$in['email']."'");
				$cek=mysql_num_rows($sql);
				if($cek>0){
					$data_email=mysql_fetch_array($sql);
					function generate_random_string($name_length = 8) {
						$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
						return substr(str_shuffle($alpha_numeric), 0, $name_length);
					}
					$reset_pass = generate_random_string();
					$kepada     = $email;
					$judul      = "Reset Password Anda";
					$dari       = "From: Triodent Clinic <noreply@pandanwangi-cbezt.com>\r\n";
					$dari   .= "MIME-Version: 1.0\r\n";
					$dari   .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					$pesan      = "Seseorang telah melakukan Reset Password pada Aplikasi Triodent Clinic.<br/>Jika memang benar itu anda lakukan, maka berikut ini adalah Username dan Password Genarate dari program. <br/>Mohon, ganti password Anda, Setelah Login dengan Password dan Username berikut :<br/>";
					$pesan  .= "Username : ".$data_email['username']."<br>";
					$pesan  .= "Password : ".$reset_pass."<br>";
					$reset_encrypt = md5($reset_pass);

					$update=mysql_query("UPDATE app_user SET password = '".$reset_encrypt."' WHERE email_user = '".$email."'");
					if($update){
						mail($kepada,$judul,$pesan,$dari);///Jika berhasil update maka Kirim Email
						$data['info']="<span class=posting>&#187; <b>Reset Password</b></span><br /><br /><p align=center><b>Silahkan cek email untuk memeriksa username dan password Anda !<br /><a href='".site_url('member_login/login')."'>Klik untuk kembali ke beranda</a></b></p>";
					}

				}else{
						$data['info']="<span class=posting>&#187; <b>Reset Password</b></span><br /><br /><p align=center><b>Maaf <b>Email</b> anda tidak terdaftar sebagai member kami!<br /><a href='".site_url('member_login/login')."'>Klik untuk kembali ke beranda</a></b></p>";
				}

			}

			$this->load->view('util/form_reset_psw',$data);
		}
	 }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
