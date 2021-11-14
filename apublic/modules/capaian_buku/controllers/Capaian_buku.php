<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Capaian_buku extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper('url');
					$this->load->model(array('capaian_buku_model'));
			   }

			function index($s=0){
				//return $this->show($s);
				redirect('penelitian/seminar_hasil/');
			}

			function show($s=0){
				redirect('penelitian/seminar_hasil/');
				 // $data['title']="Daftar Capaian_buku";
				 // $data['s']=$s;
				 // $data['op_search']=array();
				 // $this->template->mainview('capaian_buku/capaian_buku_index',$data);
			}
			function capaian_buku_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){redirect('penelitian/seminar_hasil/');};

				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				$option.=" WHERE A.id_penelitian='".$in['id_penelitian']."' ";
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('capaian_buku/capaian_buku_show');
				 $config['first_url'] = site_url('capaian_buku/capaian_buku_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->capaian_buku_model->show_data_capaian_buku($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['capaian_buku']=$this->capaian_buku_model->show_data_capaian_buku($option,$start,$config['per_page'])->result();
				$this->load->view('capaian_buku/capaian_buku_show',$data);
			}

			function capaian_buku_add($id_penelitian=""){
				$in=$this->input->post(null,true);
				if(!$in && $id_penelitian!=""){
					$data['id_penelitian']=$id_penelitian;
					$this->load->view('capaian_buku/capaian_buku_form',$data);
				}else{
					$data_in=array(
					'id_buku' => $in['cb_id_buku'],
					'id_penelitian' => $in['cb_id_penelitian'],
					'judul_buku' => $in['cb_judul_buku'],
					'penulis' => $in['cb_penulis'],
					'penerbit' => $in['cb_penerbit'],
					'no_isbn' => $in['cb_nomer_isbn']
					);
					$input_data=$this->capaian_buku_model->input_capaian_buku($data_in);
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

			function capaian_buku_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['capaian_buku']=$this->capaian_buku_model->get_by_id_capaian_buku($id)->row();
						$this->load->view('capaian_buku/capaian_buku_form',$data);
				}else{
					$data_in=array(
					'id_penelitian' => $in['cb_id_penelitian'],
					'judul_buku' => $in['cb_judul_buku'],
					'penulis' => $in['cb_penulis'],
					'penerbit' => $in['cb_penerbit'],
					'no_isbn' => $in['cb_nomer_isbn']
					);
					$update_data=$this->capaian_buku_model->update_capaian_buku($data_in,$in['cb_id_buku']);
					if($update_data){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil disimpan...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data gagal di-update...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			function capaian_buku_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->capaian_buku_model->delete_capaian_buku($id);
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

			function upload_file($id=""){
				if($id!=""){
					$data['capaian_buku']=$this->capaian_buku_model->get_by_id_capaian_buku($id)->row();
					$this->load->view('capaian_buku/capaian_buku_upload',$data);
				}
			}
/* SIMPAN DOKUMEN PUBLIKASI ILMIAH */
		function dokumen_save(){
			$in=$this->input->post(null,true);
			if($in){
				$path_dir_file='file_uploaded/capaian/'.$in['id_penelitian'].'/buku_ajar/';
				if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}
				//upload gambar
				$fn=$_FILES["userfile"]["name"];
				$config['upload_path'] = $path_dir_file;
				$config['file_name'] =date('ymdhis')."_".$fn;
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|txt|jpg|jpeg|png';
				$config['max_size'] = '2100';
				$config['remove_spaces']=TRUE;

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$notif='<div class="h3 alert alert-danger"><i class="fa fa-warning"></i> <strong>File dokumen gagal diunggah!!</strong><br/>*) Pastikan anda telah memilih File...!<br/>*) Kapasitas File PDF maksimal adalah 2000Kb (2Mb)...!</div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
				}else{
					$data=$this->upload->data();
					$url= $config['upload_path'].$data['file_name'];
					/* ambil data terlebih dahulu */
					$b=$this->capaian_buku_model->get_by_id_capaian_buku($in['id_buku']);
					if($b->num_rows()>0){
						$buku=$b->row();
						$data_in=array(
							'file_url' => $url,
							'file_name'=>$fn,
							'file_type'=>$data['file_ext']
						);
						$update=$this->capaian_buku_model->update_capaian_buku($data_in,$in['id_buku']);
						if($update){
							/*hapus data file lama*/
							if(file_exists($buku->file_url)) unlink($buku->file_url);
							$notif='<div class="h3 alert alert-success alert-dismissable" ><i class="fa fa-info-circle"></i> Data berhasil disimpan...
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							echo json_encode(array('msg'=>$notif,'status'=>'OK'));
						}else{
							$notif='<div class="h3 alert alert-danger alert-dismissable" ><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data GAGAL di SIMPAN...
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
						}
					}
				}
			}
		}

/* dokumen Download */
		function unduh($id=""){
			if($id!=""){
				/* ambil data terlebih dahulu */
				$b=$this->capaian_buku_model->get_by_id_capaian_buku($id);
				if($b->num_rows()>0){
					$buku=$b->row();
					return forcedownload($buku->file_url);
				}else{
					echo "Maaf, dokumen tidak ditemukan....!!";
				}
			}
		}
}
