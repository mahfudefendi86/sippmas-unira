<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Capaian_lain extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper('url');
					$this->load->model(array('capaian_lain_model'));
			   }

			function index($s=0){
				// return $this->show($s);
				redirect('penelitian/seminar_hasil/');
			}

			function show($s=0){
				redirect('penelitian/seminar_hasil/');
				 // $data['title']="Daftar Capaian_lain";
				 // $data['s']=$s;
				 // $data['op_search']=array();
				 // $this->template->mainview('capaian_lain/capaian_lain_index',$data);
			}
			function capaian_lain_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){redirect('penelitian/seminar_hasil/');};

				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				$option.=" WHERE A.id_penelitian='".$in['id_penelitian']."' ";
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('capaian_lain/capaian_lain_show');
				 $config['first_url'] = site_url('capaian_lain/capaian_lain_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->capaian_lain_model->show_data_capaian_lain($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['capaian_lain']=$this->capaian_lain_model->show_data_capaian_lain($option,$start,$config['per_page'])->result();
				$this->load->view('capaian_lain/capaian_lain_show',$data);
			}

			function capaian_lain_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$this->load->view('capaian_lain/capaian_lain_search',$data);
				}else{

				$numRows=$this->capaian_lain_model->show_data_capaian_lain($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['capaian_lain']=$this->capaian_lain_model->show_data_capaian_lain($option)->result();
				$this->load->view('capaian_lain/capaian_lain_show',$data);
				}
			}

			function capaian_lain_add($id_penelitian=""){
				$in=$this->input->post(null,true);
				if(!$in && $id_penelitian!=""){
					$data['id_penelitian']=$id_penelitian;
					$this->load->view('capaian_lain/capaian_lain_form',$data);
				}else{
					$data_in=array(
					'id_lain' => $in['cl_id_lain'],
					'id_penelitian' => $in['cl_id_penelitian'],
					'jenis_luaran' => $in['cl_jenis_luaran'],
					'urain' => $in['cl_uraian']
					);
					$input_data=$this->capaian_lain_model->input_capaian_lain($data_in);
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


			function capaian_lain_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['capaian_lain']=$this->capaian_lain_model->get_by_id_capaian_lain($id)->row();
						$this->load->view('capaian_lain/capaian_lain_form',$data);
				}else{
					$data_in=array(
					'id_penelitian' => $in['cl_id_penelitian'],
					'jenis_luaran' => $in['cl_jenis_luaran'],
					'urain' => $in['cl_uraian']
					);
					$update_data=$this->capaian_lain_model->update_capaian_lain($data_in,$in['cl_id_lain']);
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

			function capaian_lain_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->capaian_lain_model->delete_capaian_lain($id);
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
/* UPLOAD DOKUMEN */
		function upload_file($id=""){
			if($id!=""){
				$data['capaian_lain']=$this->capaian_lain_model->get_by_id_capaian_lain($id)->row();
				$this->load->view('capaian_lain/capaian_lain_upload',$data);
			}
		}
/* SIMPAN DOKUMEN PUBLIKASI ILMIAH */
		function dokumen_save(){
			$in=$this->input->post(null,true);
			if($in){
				$path_dir_file='file_uploaded/capaian/'.$in['id_penelitian'].'/lainnya/';
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
					$l=$this->capaian_lain_model->get_by_id_capaian_lain($in['id_lain']);
					if($l->num_rows()>0){
						$lain=$l->row();
						$data_in=array(
							'file_url' => $url,
							'file_name'=>$fn,
							'file_type'=>$data['file_ext']
						);
						$update=$this->capaian_lain_model->update_capaian_lain($data_in,$in['id_lain']);
						if($update){
							/*hapus data file lama*/
							if(file_exists($lain->file_url)) unlink($lain->file_url);
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
		function unduh($id_lain=""){
			if($id_lain!=""){
				/* ambil data terlebih dahulu */
				$l=$this->capaian_lain_model->get_by_id_capaian_lain($id_lain);
				if($l->num_rows()>0){
					$lain=$l->row();
					return forcedownload($lain->file_url);
				}else{
					echo "Maaf, dokumen tidak ditemukan....!!";
				}
			}
		}

}
