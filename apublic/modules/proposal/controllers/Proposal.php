<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proposal extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper(array('url','global_function','format_tanggal'));
					$this->load->model(array('proposal_model','penelitian/penelitian_model'));
					active_link("penelitian");
			   }

			function index($s=0){
				redirect('penelitian');
			}

			function show($id=0){
				if($id!="" || $id!=NULL){
					/* cek penelitian */
					$p=$this->penelitian_model->show_data_penelitian(" WHERE A.id_penelitian='".$id."' LIMIT 1");
					if($p->num_rows()>0){
		   				$data['penelitian']=$p->row();
					}
					$data['title']="Berkas Proposal";
					$data['op_search']=array("A.file_name"=>"Nama File","A.keterangan"=>"Keterangan");
					$this->template->mainview('proposal/proposal_index',$data);
				}else{
					redirect('penelitian');
				}
			}
			function proposal_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.id_penelitian LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				 if(isset($in['id_penelitian']) && $in['id_penelitian']!=""){
 					($option=="")?$option.=" WHERE " : $option.=" AND ";
					$option.=" A.id_penelitian='".$in['id_penelitian']."' ";
 				}
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('proposal/proposal_show');
				 $config['first_url'] = site_url('proposal/proposal_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->proposal_model->show_data_proposal($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['proposal']=$this->proposal_model->show_data_proposal($option,$start,$config['per_page'])->result();
				$this->load->view('proposal/proposal_show',$data);
			}

			function proposal_add($id=""){
				$in=$this->input->post(null,true);
				if($id!=""){
					$p=$this->penelitian_model->show_data_penelitian(" WHERE A.id_penelitian='".$id."' LIMIT 1");
					if($p->num_rows()>0){
						$data['penelitian']=$p->row();
						$this->load->view('proposal/proposal_form',$data);
					}else{
						echo '<div class="aler alert-danger">Maaf, data tidak ditemukan...</div>';
					}
				}else{
					echo '<div class="alert alert-danger">Maaf, data tidak ditemukan...</div>';
				}
			}

			function proposal_save(){
				$in=$this->input->post(null,true);
				if($in){
					$path_dir_file='file_uploaded/proposal/'.$in['psn_id_penelitian'].'/';
					if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}
					//upload gambar
					$fn=$_FILES["userfile"]["name"];
					$config['upload_path'] = $path_dir_file;
					$config['file_name'] =date('ymdhis')."_".$fn;
					$config['allowed_types'] = 'pdf';
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
						'id_proposal' => random_id(),
						'id_penelitian' => $in['psn_id_penelitian'],
						'keterangan' => $in['prp_keterangan'],
						'jenis_berkas'=>$in['prp_jenis_berkas'],
						'file' => $url,
						'file_name'=>$fn,
						'upload_date'=>date('Y-m-d H:i:s')
						);
						$input_data=$this->proposal_model->input_proposal($data_in);
						if($input_data){
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

			function proposal_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$p=$this->proposal_model->show_data_proposal(" WHERE A.id_proposal='".$id."' LIMIT 1")->row();
					$hapus=$this->proposal_model->delete_proposal($id);
					if($hapus){
						if(file_exists($p->file)) unlink ($p->file);
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal dihapus...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			function download_pdf($id=""){
				if($id!=""){
					$p=$this->proposal_model->show_data_proposal(" WHERE A.id_proposal='".$id."' LIMIT 1");
					if($p->num_rows()>0){
						$proposal=$p->row();
						$download=forcedownload($proposal->file);

						$notif='<div class="alert alert-success alert-dismissable" ><i class="fa fa-info-circle"></i> Data berhasil diunduh...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));

					}else{
						$notif='<div class="alert alert-danger alert-dismissable" ><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data tidak ditemukan...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}

				}
			}

		function showup($id=""){
			if($id!=""){
				$p=$this->proposal_model->show_data_proposal(" WHERE A.id_proposal='".$id."' LIMIT 1");
				if($p->num_rows()>0){
					$data['proposal']=$p->row();
					$this->load->view('proposal/fancy_view_pdf',$data);
				}else{
					$notif='<div class="alert alert-danger alert-dismissable" ><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data tidak ditemukan...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
					echo $notif;
				}

			}
		}
}
