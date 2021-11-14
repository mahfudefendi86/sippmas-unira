<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bidang_ilmu extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper('url');
					$this->load->model(array('bidang_ilmu_model'));
			   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Bidang Ilmu";
				 $data['s']=$s;
				 $data['op_search']=array("B.nama_bidang"=>"Bidang Keahlian", "A.bidang_ilmu"=>"Bidang Ilmu");
				 $this->template->mainview('bidang_ilmu/bidang_ilmu_index',$data);
			}
			function bidang_ilmu_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE (B.nama_bidang LIKE '%".$in['cari']."%'  OR A.bidang_ilmu LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('bidang_ilmu/bidang_ilmu_show');
				 $config['first_url'] = site_url('bidang_ilmu/bidang_ilmu_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->bidang_ilmu_model->show_data_bidang_ilmu($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['bidang_ilmu']=$this->bidang_ilmu_model->show_data_bidang_ilmu($option,$start,$config['per_page'])->result();
				$this->load->view('bidang_ilmu/bidang_ilmu_show',$data);
			}

			function bidang_ilmu_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$data['id_bidangkeahlian']=$this->bidang_ilmu_model->lookup_tbl_bidang_keahlian()->result();
					$this->load->view('bidang_ilmu/bidang_ilmu_search',$data);
				}else{

					if($in['bi_']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.id_bidangkeahlian LIKE '%".$in['bi_']."%' ";
					}
					if($in['bi_bidang_ilmu']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.bidang_ilmu LIKE '%".$in['bi_bidang_ilmu']."%' ";
					}
				$numRows=$this->bidang_ilmu_model->show_data_bidang_ilmu($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['bidang_ilmu']=$this->bidang_ilmu_model->show_data_bidang_ilmu($option)->result();
				$this->load->view('bidang_ilmu/bidang_ilmu_show',$data);
				}
			}

			function bidang_ilmu_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$data['id_bidangkeahlian']=$this->bidang_ilmu_model->lookup_tbl_bidang_keahlian()->result();
					$this->load->view('bidang_ilmu/bidang_ilmu_form',$data);
				}else{
					$data_in=array(
					'id_bidangilmu' => $in['bi_id_bidangilmu'],
					'id_bidangkeahlian' => $in['bi_'],
					'bidang_ilmu' => $in['bi_bidang_ilmu']
					);
					$input_data=$this->bidang_ilmu_model->input_bidang_ilmu($data_in);
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


			function bidang_ilmu_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
					$data['id_bidangkeahlian']=$this->bidang_ilmu_model->lookup_tbl_bidang_keahlian()->result();
						$data['bidang_ilmu']=$this->bidang_ilmu_model->get_by_id_bidang_ilmu($id)->row();
						$this->load->view('bidang_ilmu/bidang_ilmu_form',$data);
				}else{
					$data_in=array(
					'id_bidangkeahlian' => $in['bi_'],
					'bidang_ilmu' => $in['bi_bidang_ilmu']
					);
					$update_data=$this->bidang_ilmu_model->update_bidang_ilmu($data_in,$in['bi_id_bidangilmu']);
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

			function bidang_ilmu_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->bidang_ilmu_model->delete_bidang_ilmu($id);
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

			function bidang_ilmu_actionAll($action=""){
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
					$hapus=$this->bidang_ilmu_model->delete_bidang_ilmu($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

		function select_ilmu(){
			$in=$this->input->post(null,true);
			$bi=$this->bidang_ilmu_model->show_data_bidang_ilmu(" WHERE A.id_bidangkeahlian='".$in['id']."' ");
			if($bi->num_rows()>0){
				$d['data']=$bi->result();
				$d['status']="200";
			}else{
				$d['data']=$bi->result();
				$d['status']="401";
			}
			echo json_encode($d);
		}

}
