<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member extends Member_Control {

			public function __construct()
			{
			 parent::__construct();
			 $this->load->helper(array('url','format_tanggal'));
			 $this->load->model(array('member_model'));
			}

			function index(){
					//$this->template->display('member/welcome_message');
					redirect('member/member_index');
			}

			function identitas_personal(){
					$data['title']="Personal Account";
					$this->template->display('member/personal_form',$data);
			}

			function test_dekrip_pasw(){
				$psw_e=enkripsi_psw('FzP0L/MkBT/kt+rLeJLbU8crpIpvzFzVRwNdD9KGybmpCCHQe9EvGkflMZPj5RUExHUqt2oKl+AZ1fpviPw80Q==','dec');
				echo $psw_e;
			}

			function member_register(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['provinsi']=$this->web_model->load_provinsi()->result();
					$this->template->display('member/register_form',$data);
				}else{
					/* Get Max ID */
					$max=$this->web_model->get_id()->row();
					$id=$max->id+1;
					$data_in=array(
					'id_customer'=>$id,
					'nama_depan' => $in['reg_nama_depan'],
					'nama_belakang' => $in['reg_nama_belakang'],
					'email' => $in['reg_email'],
					'nomer_hp' => $in['reg_nomer_hp'],
					'jenis_kelamin' => $in['reg_jenis_kelamin'],
					'identitas' => $in['reg_identitas'],
					'tanggal_lahir' => $in['thn']."-".$in['bln']."-".$in['tgl'],
					'alamat' => $in['reg_alamat'],
					'kota' => $in['reg_kota'],
					'provinsi' => $in['reg_provinsi'],
					'negara' => $in['reg_negara'],
					'kode_pos' => $in['reg_kodepos'],
					'tgl_reg' => date('Y-m-d H:i:s'),
					'create_from' => 'Admin'
					);
					$input_data=$this->member_model->input_customer($data_in);

					/* Cerate userlogin */
					$p=generate_psw();//Membuat password random
					$psw=create_password($p);
					$psw_e=enkripsi_psw($p,'enc');

					/* input Userlogin */
					$data_user=array('id_customer'=>$id,'email' => $in['reg_email'], 'nomer_hp' => $in['reg_nomer_hp'], 'password'=>$psw,'psw'=>$psw_e,'level'=>'CUS');
					$input_user=$this->member_model->input_customer_user($data_user);

					/* INput Prefrence tabel */
					$data_pref=array('id_customer'=>$id);
					$input_pref=$this->member_model->input_customer_pref($data_pref);

					if($input_data && $input_user && $data_pref){
						/* Jika berhasil simpan kirim email ucapan terimakasih dan redirect ke Informasi Sukses*/
						$opt[]=array();
						$get_option=$this->web_model->get_option_by_group('reg')->result();
						foreach ($get_option as $data_option) {
							$opt[$data_option->option_name]=$data_option->option_value;
						}
						$option['dari']=$opt['reg_send_mail_from'];
						$option['dari_nama']=$opt['reg_send_mail_from_name'];
						$option['tujuan']=$in['reg_email'];
						$option['subject']=$opt['reg_send_mail_subject'];
						$option['pesan']=$opt['reg_send_mail_message'];

						kirim_email($option); //memanggil fungsi dari Helper Global Function
						redirect('member/info_sukses/');
					}else{
						redirect('webpu/info/reg/fail');
					}
				}
			}

			function update_identitas($id=NULL){
				$in=$this->input->post(null,true);
				if(!$in && $id!=NULL){
					$g=$this->member_model->get_customer($id);
					if($g->num_rows()>0){
						$data['title']="Update Data Identitas";
						$data['person']=$g->row();
						$data['provinsi']=$this->member_model->load_provinsi()->result();
						$data['kota']=$this->member_model->load_regencies()->result();
						$this->template->display('member/update_register_form',$data);
					}else{
						echo "<h1> Maaf, Data tidak ditemukan...</h1>";
					}

				}else{
					/* Get Max ID
					$max=$this->member_model->get_id()->row();
					$id=$max->id+1;*/
					$data_in=array(
					'nama_depan' => $in['reg_nama_depan'],
					'nama_belakang' => $in['reg_nama_belakang'],
					'jenis_kelamin' => $in['reg_jenis_kelamin'],
					'identitas' => $in['reg_identitas'],
					'tanggal_lahir' => $in['thn']."-".$in['bln']."-".$in['tgl'],
					'alamat' => $in['reg_alamat'],
					'kota' => $in['reg_kota'],
					'provinsi' => $in['reg_provinsi'],
					'negara' => $in['reg_negara'],
					'kode_pos' => $in['reg_kodepos']
					);
					$input_data=$this->member_model->update_customer($data_in,$in['reg_id_cutomer']);
					if($input_data){
						$notif='<div class="uk-text-large"><i class="uk-icon-check-circle"></i> Data Personal berhasil di Update...</div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="uk-text-large"><i class="uk-icon-check-circle"></i> Maaf, Data Personal gagal di Update...</div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			/* cek Email Customer */
			function cek_reg(){
				$in=$this->input->post(null,true);
				$c=$this->member_model->cek($in['field'],$in['value']);
				if($c->num_rows()>0){
					$d=$c->row();
						$notif="Maaf, ".strtoupper(str_replace("_"," ",$in['field']))." <strong>".strtoupper($d->$in['field'])."</strong> telah terdaftar, silahkan ganti dengan yang lain";
						echo json_encode(array('msg'=>$notif,'status'=>'1'));
				}else{
						$notif=strtoupper(str_replace("_"," ",$in['field']))." ".strtoupper($d->$in['field'])." masih tersedia, silahkan lanjutkan ";
						echo json_encode(array('msg'=>$notif,'status'=>'0'));
				}
			}

			/* Loading Kota/Kabupaten */
			public function load_r($id=NULL){
				$data=$this->member_model->load_regencies(" WHERE province_id='".$id."' ")->result();
				echo json_encode($data);
			}



	function info_sukses(){
		$data['option']=$this->web_model->get_option('reg_success')->row();
		$data['action']='<a class="uk-button uk-button-primary uk-button-large" href="'.site_url('member').'" title="Kembali ke Daftar Member" data-uk-tooltip><i class="uk-icon-chevron-left"></i> Daftar Member</a>&nbsp;<a class="uk-button uk-button-warning uk-button-large" href="'.site_url('member/tiketbox').'" title="Kembali ke Daftar Tiketbox" data-uk-tooltip><i class="uk-icon-chevron-left"></i> Daftar Tiketbox</a>';
		$this->template->display('webpu/register_info_right',$data);
	}

}
