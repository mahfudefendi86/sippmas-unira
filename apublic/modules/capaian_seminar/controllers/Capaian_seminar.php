<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Capaian_seminar extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper(array('url','format_tanggal'));
					$this->load->model(array('capaian_seminar_model'));
			   }

			function index($s=0){
				// return $this->show($s);
				redirect('penelitian/seminar_hasil/');
			}

			function show($s=0){
				redirect('penelitian/seminar_hasil/');
				 // $data['title']="Daftar Capaian_seminar";
				 // $data['s']=$s;
				 // $data['op_search']=array();
				 // $this->template->mainview('capaian_seminar/capaian_seminar_index',$data);
			}
			function capaian_seminar_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){redirect('penelitian/seminar_hasil/');};

				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				$option.=" WHERE A.id_penelitian='".$in['id_penelitian']."' ";
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('capaian_seminar/capaian_seminar_show');
				 $config['first_url'] = site_url('capaian_seminar/capaian_seminar_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->capaian_seminar_model->show_data_capaian_seminar($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['capaian_seminar']=$this->capaian_seminar_model->show_data_capaian_seminar($option,$start,$config['per_page'])->result();
				$this->load->view('capaian_seminar/capaian_seminar_show',$data);
			}

			function capaian_seminar_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$this->load->view('capaian_seminar/capaian_seminar_search',$data);
				}else{

				$numRows=$this->capaian_seminar_model->show_data_capaian_seminar($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['capaian_seminar']=$this->capaian_seminar_model->show_data_capaian_seminar($option)->result();
				$this->load->view('capaian_seminar/capaian_seminar_show',$data);
				}
			}

			function capaian_seminar_add($id_penelitian=""){
				$in=$this->input->post(null,true);
				if(!$in && $id_penelitian!=""){
					$data['id_penelitian']=$id_penelitian;
					$this->load->view('capaian_seminar/capaian_seminar_form',$data);
				}else{
					$data_in=array(
					'id_seminar' => $in['cs_id_seminar'],
					'id_penelitian' => $in['cs_id_penelitian'],
					'nama_pertemuan'=>$in['cs_nama_pertemuan'],
					'jenis_pertemuan' => $in['cs_jenis_pertemuan'],
					'tempat' => $in['cs_tempat'],
					'tanggal' => $in['cs_tanggal_pertemuan'],
					'judul_makalah' => $in['cs_judul_makalah'],
					'status_makalah' => $in['cs_status_makalah']
					);
					$input_data=$this->capaian_seminar_model->input_capaian_seminar($data_in);
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


			function capaian_seminar_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['capaian_seminar']=$this->capaian_seminar_model->get_by_id_capaian_seminar($id)->row();
						$this->load->view('capaian_seminar/capaian_seminar_form',$data);
				}else{
					$data_in=array(
					'id_penelitian' => $in['cs_id_penelitian'],
					'nama_pertemuan'=>$in['cs_nama_pertemuan'],
					'jenis_pertemuan' => $in['cs_jenis_pertemuan'],
					'tempat' => $in['cs_tempat'],
					'tanggal' => $in['cs_tanggal_pertemuan'],
					'judul_makalah' => $in['cs_judul_makalah'],
					'status_makalah' => $in['cs_status_makalah']
					);
					$update_data=$this->capaian_seminar_model->update_capaian_seminar($data_in,$in['cs_id_seminar']);
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

			function capaian_seminar_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->capaian_seminar_model->delete_capaian_seminar($id);
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
				$data['capaian_seminar']=$this->capaian_seminar_model->get_by_id_capaian_seminar($id)->row();
				$this->load->view('capaian_seminar/capaian_seminar_upload',$data);
			}
		}
/* SIMPAN DOKUMEN PUBLIKASI ILMIAH */
		function dokumen_save(){
			$in=$this->input->post(null,true);
			if($in){
				$path_dir_file='file_uploaded/capaian/'.$in['id_penelitian'].'/seminar/';
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
					$s=$this->capaian_seminar_model->get_by_id_capaian_seminar($in['id_seminar']);
					if($s->num_rows()>0){
						$seminar=$s->row();
						$data_in=array(
							'file_url' => $url,
							'file_name'=>$fn,
							'file_type'=>$data['file_ext']
						);
						$update=$this->capaian_seminar_model->update_capaian_seminar($data_in,$in['id_seminar']);
						if($update){
							/*hapus data file lama*/
							if(file_exists($seminar->file_url)) unlink($seminar->file_url);
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
		function unduh($id_seminar=""){
			if($id_seminar!=""){
				/* ambil data terlebih dahulu */
				$s=$this->capaian_seminar_model->get_by_id_capaian_seminar($id_seminar);
				if($s->num_rows()>0){
					$seminar=$s->row();
					return forcedownload($seminar->file_url);
				}else{
					echo "Maaf, dokumen tidak ditemukan....!!";
				}
			}
		}

}
