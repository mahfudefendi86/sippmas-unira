<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Capaian_invitasi extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper('url');
					$this->load->model(array('capaian_invitasi_model'));
			   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Capaian_invitasi";
				 $data['s']=$s;
				 $data['op_search']=array();
				 $this->template->mainview('capaian_invitasi/capaian_invitasi_index',$data);
			}
			function capaian_invitasi_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE () ";
					}
				}
				 $option.=$filt;
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('capaian_invitasi/capaian_invitasi_show');
				 $config['first_url'] = site_url('capaian_invitasi/capaian_invitasi_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->capaian_invitasi_model->show_data_capaian_invitasi($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['capaian_invitasi']=$this->capaian_invitasi_model->show_data_capaian_invitasi($option,$start,$config['per_page'])->result();
				$this->load->view('capaian_invitasi/capaian_invitasi_show',$data);
			}

			function capaian_invitasi_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$this->load->view('capaian_invitasi/capaian_invitasi_search',$data);
				}else{

				$numRows=$this->capaian_invitasi_model->show_data_capaian_invitasi($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['capaian_invitasi']=$this->capaian_invitasi_model->show_data_capaian_invitasi($option)->result();
				$this->load->view('capaian_invitasi/capaian_invitasi_show',$data);
				}
			}

			function capaian_invitasi_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$this->load->view('capaian_invitasi/capaian_invitasi_form',$data);
				}else{
					$data_in=array(
					'id_inv_speaker' => $in['ci_id_invitasi'],
					'id_penelitian' => $in['ci_id_penelitian'],
					'skala_kegiatan' => $in['ci_skala_kegiatan'],
					'judul_makalah' => $in['ci_judul_makalah'],
					'penulis' => $in['ci_penulis'],
					'penyelenggara' => $in['ci_penyelanggara'],
					'tempat' => $in['ci_tempat'],
					'tanggal' => $in['ci_tanggal'],
					'status_makalah' => $in['ci_status_makalah']
					);
					$input_data=$this->capaian_invitasi_model->input_capaian_invitasi($data_in);
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


			function capaian_invitasi_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['capaian_invitasi']=$this->capaian_invitasi_model->get_by_id_capaian_invitasi($id)->row();
						$this->load->view('capaian_invitasi/capaian_invitasi_form',$data);
				}else{
					$data_in=array(
					'id_penelitian' => $in['ci_id_penelitian'],
					'skala_kegiatan' => $in['ci_skala_kegiatan'],
					'judul_makalah' => $in['ci_judul_makalah'],
					'penulis' => $in['ci_penulis'],
					'penyelenggara' => $in['ci_penyelanggara'],
					'tempat' => $in['ci_tempat'],
					'tanggal' => $in['ci_tanggal'],
					'status_makalah' => $in['ci_status_makalah']
					);
					$update_data=$this->capaian_invitasi_model->update_capaian_invitasi($data_in,$in['ci_id_invitasi']);
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

			function capaian_invitasi_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->capaian_invitasi_model->delete_capaian_invitasi($id);
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

			function capaian_invitasi_actionAll($action=""){
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
					$hapus=$this->capaian_invitasi_model->delete_capaian_invitasi($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

}
