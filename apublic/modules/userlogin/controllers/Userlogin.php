<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userlogin extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper(array('url','global_function'));
					$this->load->model(array('userlogin_model','peneliti/peneliti_model','reviewer/reviewer_model'));
			   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				active_link("Konfigurasi");
				 $data['title']="Daftar Userlogin";
				 $data['s']=$s;
				 $data['op_search']=array("A.username"=>"Username", "A.nama"=>"Nama", "A.identifikasi"=>"Type", "A.status"=>"Status");
				 $this->template->mainview('userlogin/userlogin_index',$data);
			}
			function userlogin_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.username LIKE '%".$in['cari']."%'  OR A.nama LIKE '%".$in['cari']."%'  OR A.identifikasi LIKE '%".$in['cari']."%'  OR A.status LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				 $option.=" ORDER BY A.nama ASC ";
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('userlogin/userlogin_show');
				 $config['first_url'] = site_url('userlogin/userlogin_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->userlogin_model->show_data_userlogin($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['userlogin']=$this->userlogin_model->show_data_userlogin($option,$start,$config['per_page'])->result();
				$this->load->view('userlogin/userlogin_show',$data);
			}

			function userlogin_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data='';
					$this->load->view('userlogin/userlogin_search',$data);
				}else{

					if($in['usr_username']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.username LIKE '%".$in['usr_username']."%' ";
					}
					if($in['usr_nama']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.nama LIKE '%".$in['usr_nama']."%' ";
					}
					if($in['usr_type']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.identifikasi LIKE '%".$in['usr_type']."%' ";
					}
					if($in['usr_status']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.status LIKE '%".$in['usr_status']."%' ";
					}
				$numRows=$this->userlogin_model->show_data_userlogin($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['userlogin']=$this->userlogin_model->show_data_userlogin($option)->result();
				$this->load->view('userlogin/userlogin_show',$data);
				}
			}

			function userlogin_add($type=NULL,$id=NULL){
				$in=$this->input->post(null,true);
				$userid=""; $data[]=NULL;
				if(!$in){
					if($type!=NULL && $id!=NULL){
						if($type=="p"){
							$u=$this->peneliti_model->get_by_id_peneliti($id);
							$data['type']="PENELITI";
						}else
						if($type=="r"){
							$u=$this->reviewer_model->get_by_id_reviewer($id);
							$data['type']="REVIEWER";
						}
						if($u->num_rows()>0){
							/* cek data apakah sudah ada pada tabel user atau belum*/
							$s=$this->userlogin_model->get_by_userid($id);
							if($s->num_rows()>0){
								$data['userlogin']=$s->row();
								$data['action']='Update';
							}else{
								$data['user']=$u->row();
								$data['action']='Add';
							}
						}
						$this->load->view('userlogin/userlogin_form_type',$data);
					}else{
						$this->load->view('userlogin/userlogin_form');
					}
				}else{
					if(isset($in['user_id']) && $in['user_id']!=""){
						$userid=$in['user_id'];
					}else{
						if(isset($in['type_akun']) && $in['type_akun']!=""){
							$userid=$in['type_akun'];
						}else{
							$userid="usr-".random_id();
						}
					}
					$password=do_hash('de23239mex'.$in['usr_password'].'by4489#&4','md5');
					$data_in=array(
					'id_login' => random_id(),
					'userid'=>$userid,
					'username' => $in['usr_username'],
					'password' => $password,
					'nama' => $in['usr_nama'],
					'alamat' => $in['usr_alamat'],
					'email_recv' => $in['usr_email'],
					'hp_recv' => $in['usr_no__hp'],
					'identifikasi' => $in['usr_type'],
					'status' => $in['usr_status'],
					'created'=>date('Y-m-d H:i:s')
					);
					$input_data=$this->userlogin_model->input_userlogin($data_in);
					if($input_data){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil disimpan...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data gagal disimpan...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			function userlogin_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['userlogin']=$this->userlogin_model->get_by_id_userlogin($id)->row();
						$this->load->view('userlogin/userlogin_form',$data);
				}else{
					if(isset($in['user_id']) && $in['user_id']!=""){
						$userid=$in['user_id'];
					}else{
						if(isset($in['type_akun']) && $in['type_akun']!=""){
							$userid=$in['type_akun'];
						}else{
							$userid="usr-".random_id();
						}
					}
					if($in['usr_password']=="" || $in['usr_password']==NULL){
						$data_in=array(
						'userid'=>$userid,
						'username' => $in['usr_username'],
						'nama' => $in['usr_nama'],
						'alamat' => $in['usr_alamat'],
						'email_recv' => $in['usr_email'],
						'hp_recv' => $in['usr_no__hp'],
						'identifikasi' => $in['usr_type'],
						'status' => $in['usr_status'],
						'updated'=>date('Y-m-d H:i:s')
						);
					}else{
						$password=do_hash('de23239mex'.$in['usr_password'].'by4489#&4','md5');
						$data_in=array(
						'userid'=>$userid,
						'username' => $in['usr_username'],
						'password' =>$password,
						'nama' => $in['usr_nama'],
						'alamat' => $in['usr_alamat'],
						'email_recv' => $in['usr_email'],
						'hp_recv' => $in['usr_no__hp'],
						'identifikasi' => $in['usr_type'],
						'status' => $in['usr_status'],
						'updated'=>date('Y-m-d H:i:s')
						);
					}
					$update_data=$this->userlogin_model->update_userlogin($data_in,$in['usr_id_login']);
					if($update_data){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di-update...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data gagal di-update...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			function userlogin_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->userlogin_model->delete_userlogin($id);
					if($hapus){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data gagal dihapus...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			function userlogin_actionAll($action=""){
			$cMsg=0;
			$in=$this->input->post(null,true);
			//change data sparated comma text to array
			$dataArray=explode(',',$in['dataArray']);
			//remove "no" dari array
			$idArray = array_diff($dataArray,array('on'));
			$cArray=count($idArray);

			///jika action yang di klik adalah delete
			if($action=="delete"){
				for($x=0;$x<$cArray;$x++){
					$hapus=$this->userlogin_model->delete_userlogin($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di HAPUS...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

		function select_akun($type="",$id_user=""){
			$t=" tbl_peneliti "; $option="";
			if($type!=""){
				/* jika melakukan tambah atau edit dimana user belum terkonfigurasi dengan tabel authoer/reviewer */
				if($id_user==""){
					$option='WHERE id_user NOT IN (
							select userid from _m_usr_login x
						)';
				}
				if($type=="PENELITI"){ $t="tbl_peneliti";}
				if($type=="REVIEWER"){ $t="tbl_reviewer";}
				$sql="SELECT id_user,nama from ".$t." ".$option." ORDER BY nama ASC ";
				$u=$this->db->query($sql);
				if($u->num_rows()>0){
					$user=$u->result();
					$data['user']=$user;
					$data['status']="OK";
				}else{
					$data['user']=NULL;
					$data['status']="GAGAL";
				}
				echo json_encode($data);
			}
		}

}
