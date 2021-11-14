<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slideshow extends CI_Controller {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper(array('url','global_function','format_tanggal'));
					$this->load->model(array('slideshow_model'));
					active_link("berita");
			   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Slideshow";
				 $data['s']=$s;
				 $data['op_search']=array("A.judul_slide"=>"Nama Slide", "A.deskripsi"=>"Deskripsi");
				 $this->template->mainview('slideshow/slideshow_index',$data);
			}
			function slideshow_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.judul_slide LIKE '%".$in['cari']."%'  OR A.deskripsi LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('slideshow/slideshow_show');
				 $config['first_url'] = site_url('slideshow/slideshow_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->slideshow_model->show_data_slideshow($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['slideshow']=$this->slideshow_model->show_data_slideshow($option,$start,$config['per_page'])->result();
				$this->load->view('slideshow/slideshow_show',$data);
			}

			function slideshow_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data='';
					$this->load->view('slideshow/slideshow_search',$data);
				}else{

					if($in['sls_nama_slide']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.judul_slide LIKE '%".$in['sls_nama_slide']."%' ";
					}
					if($in['sls_deskripsi']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.deskripsi LIKE '%".$in['sls_deskripsi']."%' ";
					}
				$numRows=$this->slideshow_model->show_data_slideshow($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['slideshow']=$this->slideshow_model->show_data_slideshow($option)->result();
				$this->load->view('slideshow/slideshow_show',$data);
				}
			}

			function slideshow_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$this->load->view('slideshow/slideshow_form',$data);
				}else{
					$path_dir_file='file_uploaded/slideshow/';
					if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}
					//upload gambar
					$fn=$_FILES["userfile"]["name"];
					$config['upload_path'] = $path_dir_file;
					$config['file_name'] =date('ymdhis')."_".$fn;
					$config['allowed_types'] = 'jpg|png|jpeg|gif';
					$config['max_size'] = '2100';
					$config['remove_spaces']=TRUE;

					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload())
					{
						$notif='<div class="h3 alert alert-danger" onclick="$(this).fadeOut(300);"><i class="fa fa-warning"></i> <strong>File PDF Gagal di Upload!!</strong><br/>*) Pastikan anda telah memilih File...!<br/>*) Kapasitas File PDF maksimal adalah 2000Kb (2Mb)...!</div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}else{
						$data=$this->upload->data();
						$url= $config['upload_path'].$data['file_name'];
						$data_in=array(
						'id_slideshow' => random_id(),
						'judul_slide' => $in['sls_nama_slide'],
						'deskripsi' => $in['sls_deskripsi'],
						'gambar' => $url,
						'tanggal' => date('Y-m-d'),
						'status' => $in['sls_status'],
						'link' => $in['sls_link'],
						'target_link'=>$in['target'],
						'userid'=>$this->session->userdata('id_user')
						);
						$input_data=$this->slideshow_model->input_slideshow($data_in);
						if($input_data){
							$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><h3><i class="fa fa-info-circle"></i> Data slideshow berhasil disimpan...
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3></div>';
							echo json_encode(array('msg'=>$notif,'status'=>'OK'));
						}else{
							$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><h3><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data gagal disimpan...
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3></div>';
							echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
						}
					}/* END CEK UPLOAD */
				}
			}

			function slideshow_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['slideshow']=$this->slideshow_model->get_by_id_slideshow($id)->row();
						$this->load->view('slideshow/slideshow_form',$data);
				}else{
					$path_dir_file='file_uploaded/slideshow/';
					if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}
					//upload gambar
					$fn=$_FILES["userfile"]["name"];
					$config['upload_path'] = $path_dir_file;
					$config['file_name'] =date('ymdhis')."_".$fn;
					$config['allowed_types'] = 'jpg|png|jpeg|gif';
					$config['max_size'] = '2100';
					$config['remove_spaces']=TRUE;

					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload()){
						$data_in=array(
						'judul_slide' => $in['sls_nama_slide'],
						'deskripsi' => $in['sls_deskripsi'],
						'tanggal' => date('Y-m-d'),
						'status' => $in['sls_status'],
						'link' => $in['sls_link'],
						'target_link'=>$in['target'],
						'userid'=>$this->session->userdata('id_user')
						);
					}else{
						$data=$this->upload->data();
						$url= $config['upload_path'].$data['file_name'];
						$data_in=array(
						'judul_slide' => $in['sls_nama_slide'],
						'deskripsi' => $in['sls_deskripsi'],
						'gambar' => $url,
						'tanggal' => date('Y-m-d'),
						'status' => $in['sls_status'],
						'link' => $in['sls_link'],
						'target_link'=>$in['target'],
						'userid'=>$this->session->userdata('id_user')
						);
					}

					$update_data=$this->slideshow_model->update_slideshow($data_in,$in['sls_id_slideshow']);
					if($update_data){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><h3><i class="fa fa-info-circle"></i> Data slideshow berhasil disimpan...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><h3><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data gagal disimpan...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			function slideshow_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$data=$this->slideshow_model->get_by_id_slideshow($id)->row();
					$hapus=$this->slideshow_model->delete_slideshow($id);
					if($hapus){
						if(file_exists($data->gambar)) unlink($data->gambar);
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

			function slideshow_actionAll($action=""){
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
					$data=$this->slideshow_model->get_by_id_slideshow($idArray[$x])->row();
					$hapus=$this->slideshow_model->delete_slideshow($idArray[$x]);
					if($hapus){ $cMsg++; if(file_exists($data->gambar)) unlink($data->gambar); }
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

}
