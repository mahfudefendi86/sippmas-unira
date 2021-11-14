<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Capaian_visiting extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper('url');
					$this->load->model(array('capaian_visiting_model'));
			   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Capaian_visiting";
				 $data['s']=$s;
				 $data['op_search']=array();
				 $this->template->mainview('capaian_visiting/capaian_visiting_index',$data);
			}
			function capaian_visiting_show($st=NULL,$option=""){
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
				 $config['base_url'] = site_url('capaian_visiting/capaian_visiting_show');
				 $config['first_url'] = site_url('capaian_visiting/capaian_visiting_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->capaian_visiting_model->show_data_capaian_visiting($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['capaian_visiting']=$this->capaian_visiting_model->show_data_capaian_visiting($option,$start,$config['per_page'])->result();
				$this->load->view('capaian_visiting/capaian_visiting_show',$data);
			}

			function capaian_visiting_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$this->load->view('capaian_visiting/capaian_visiting_search',$data);
				}else{

				$numRows=$this->capaian_visiting_model->show_data_capaian_visiting($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['capaian_visiting']=$this->capaian_visiting_model->show_data_capaian_visiting($option)->result();
				$this->load->view('capaian_visiting/capaian_visiting_show',$data);
				}
			}

			function capaian_visiting_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$this->load->view('capaian_visiting/capaian_visiting_form',$data);
				}else{
					$data_in=array(
					'id_visit_scientist' => $in['cv_id_visit'],
					'id_penelitian' => $in['cv_id_penelitian'],
					'skala_kegiatan' => $in['cv_skala_kegiatan'],
					'nama_perguruan_tinggi' => $in['cv_nama_pt'],
					'lama_kegiatan' => $in['cv_lama_kagiatan'],
					'kegiatan_yg_dilakukan' => $in['cv_kegiatan']
					);
					$input_data=$this->capaian_visiting_model->input_capaian_visiting($data_in);
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


			function capaian_visiting_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['capaian_visiting']=$this->capaian_visiting_model->get_by_id_capaian_visiting($id)->row();
						$this->load->view('capaian_visiting/capaian_visiting_form',$data);
				}else{
					$data_in=array(
					'id_penelitian' => $in['cv_id_penelitian'],
					'skala_kegiatan' => $in['cv_skala_kegiatan'],
					'nama_perguruan_tinggi' => $in['cv_nama_pt'],
					'lama_kegiatan' => $in['cv_lama_kagiatan'],
					'kegiatan_yg_dilakukan' => $in['cv_kegiatan']
					);
					$update_data=$this->capaian_visiting_model->update_capaian_visiting($data_in,$in['cv_id_visit']);
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

			function capaian_visiting_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->capaian_visiting_model->delete_capaian_visiting($id);
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

			function capaian_visiting_actionAll($action=""){
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
					$hapus=$this->capaian_visiting_model->delete_capaian_visiting($idArray[$x]);
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
