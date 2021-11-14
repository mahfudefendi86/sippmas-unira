<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Capaian_jurnal extends Member_Control {

		   public function __construct()
		   {
				parent::__construct();
				$this->load->helper(array('url','global_function'));
				$this->load->model(array('capaian_jurnal_model'));
		   }

			function index($s=0){
				//return $this->show($s);
				redirect('penelitian/seminar_hasil/');
			}

			function show($s=0){
				redirect('penelitian/seminar_hasil/');
				 // $data['title']="Publikasi Ilmiah";
				 // $data['s']=$s;
				 // $data['op_search']=array();
				 // $this->template->mainview('capaian_jurnal/capaian_jurnal_index',$data);
			}
			function capaian_jurnal_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){redirect('penelitian/seminar_hasil/');};

				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				$option.=" WHERE A.id_penelitian='".$in['id_penelitian']."' ";

				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('capaian_jurnal/capaian_jurnal_show');
				 $config['first_url'] = site_url('capaian_jurnal/capaian_jurnal_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->capaian_jurnal_model->show_data_capaian_jurnal($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['capaian_jurnal']=$this->capaian_jurnal_model->show_data_capaian_jurnal($option,$start,$config['per_page'])->result();
				$this->load->view('capaian_jurnal/capaian_jurnal_show',$data);
			}

			function capaian_jurnal_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$this->load->view('capaian_jurnal/capaian_jurnal_search',$data);
				}else{

				$numRows=$this->capaian_jurnal_model->show_data_capaian_jurnal($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['capaian_jurnal']=$this->capaian_jurnal_model->show_data_capaian_jurnal($option)->result();
				$this->load->view('capaian_jurnal/capaian_jurnal_show',$data);
				}
			}

			function capaian_jurnal_add($id_penelitian=""){
				$in=$this->input->post(null,true);
				if(!$in && $id_penelitian!=""){
					$data['id_penelitian']=$id_penelitian;
					$this->load->view('capaian_jurnal/capaian_jurnal_form',$data);
				}else{
					$data_in=array(
					'id_jurnal' => $in['cj_id_jurnal'],
					'id_penelitian' => $in['cj_id_penelitian'],
					'nama_jurnal' => $in['cj_nama_jurnal'],
					'klasifkasi_jurnal' => $in['cj_klasifikasi_jurnal'],
					'impact_faktor' => $in['cj_impact_faktor'],
					'judul_artikel' => $in['cj_judul_artikel'],
					'status_naskah' => $in['cj_status_naskah']
					);
					$input_data=$this->capaian_jurnal_model->input_capaian_jurnal($data_in);
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


			function capaian_jurnal_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['capaian_jurnal']=$this->capaian_jurnal_model->get_by_id_capaian_jurnal($id)->row();
						$this->load->view('capaian_jurnal/capaian_jurnal_form',$data);
				}else{
					$data_in=array(
					'id_penelitian' => $in['cj_id_penelitian'],
					'nama_jurnal' => $in['cj_nama_jurnal'],
					'klasifkasi_jurnal' => $in['cj_klasifikasi_jurnal'],
					'impact_faktor' => $in['cj_impact_faktor'],
					'judul_artikel' => $in['cj_judul_artikel'],
					'status_naskah' => $in['cj_status_naskah']
					);
					$update_data=$this->capaian_jurnal_model->update_capaian_jurnal($data_in,$in['cj_id_jurnal']);
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

			function capaian_jurnal_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$j=$this->capaian_jurnal_model->get_by_id_capaian_jurnal($id)->row();
					$hapus=$this->capaian_jurnal_model->delete_capaian_jurnal($id);
					if($hapus){
						/*hapus data file lama*/
						if(file_exists($j->file_url)) unlink($j->file_url);
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di HAPUS...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data GAGAL di HAPUS...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

/* UPLOAD DOKUMEN */
		function upload_file($id=""){
			if($id!=""){
				$data['capaian_jurnal']=$this->capaian_jurnal_model->get_by_id_capaian_jurnal($id)->row();
				$this->load->view('capaian_jurnal/capaian_jurnal_upload',$data);
			}
		}
/* SIMPAN DOKUMEN PUBLIKASI ILMIAH */
		function dokumen_save(){
			$in=$this->input->post(null,true);
			if($in){
				$path_dir_file='file_uploaded/capaian/'.$in['id_penelitian'].'/publikasi_ilmiah/';
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
					$j=$this->capaian_jurnal_model->get_by_id_capaian_jurnal($in['id_jurnal']);
					if($j->num_rows()>0){
						$jurnal=$j->row();
						$data_in=array(
							'file_url' => $url,
							'file_name'=>$fn,
							'file_type'=>$data['file_ext']
						);
						$update=$this->capaian_jurnal_model->update_capaian_jurnal($data_in,$in['id_jurnal']);
						if($update){
							/*hapus data file lama*/
							if(file_exists($jurnal->file_url)) unlink($jurnal->file_url);
							$notif='<div class="h3 alert alert-success alert-dismissable" ><i class="fa fa-info-circle"></i> Data berhasil disimpan...
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							echo json_encode(array('msg'=>$notif,'status'=>'OK'));
						}else{
							$notif='<div class="h3 alert alert-danger alert-dismissable" ><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal disimpan...
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
						}
					}
				}
			}
		}

/* dokumen Download */
		function unduh($id_jurnal=""){
			if($id_jurnal!=""){
				/* ambil data terlebih dahulu */
				$j=$this->capaian_jurnal_model->get_by_id_capaian_jurnal($id_jurnal);
				if($j->num_rows()>0){
					$jurnal=$j->row();
					return forcedownload($jurnal->file_url);
				}else{
					echo "Maaf, dokumen tidak ditemukan....!!";
				}
			}
		}


}
