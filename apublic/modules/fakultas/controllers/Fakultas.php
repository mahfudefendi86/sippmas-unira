<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fakultas extends Member_Control {

		   public function __construct()
		   {
				parent::__construct();
				$this->load->helper(array('url','global_function'));
				$this->load->model(array('fakultas_model'));
				active_link("master");
		   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Fakultas";
				 $data['s']=$s;
				 $data['op_search']=array("A.nama_fakultas"=>"Nama Fakultas");
				 $this->template->mainview('fakultas/fakultas_index',$data);
			}
			function fakultas_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.nama_fakultas LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('fakultas/fakultas_show');
				 $config['first_url'] = site_url('fakultas/fakultas_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->fakultas_model->show_data_fakultas($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['fakultas']=$this->fakultas_model->show_data_fakultas($option,$start,$config['per_page'])->result();
				$this->load->view('fakultas/fakultas_show',$data);
			}

			function fakultas_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$this->load->view('fakultas/fakultas_search',$data);
				}else{

					if($in['fk_nama_fakultas']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.nama_fakultas LIKE '%".$in['fk_nama_fakultas']."%' ";
					}
				$numRows=$this->fakultas_model->show_data_fakultas($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['fakultas']=$this->fakultas_model->show_data_fakultas($option)->result();
				$this->load->view('fakultas/fakultas_show',$data);
				}
			}

			function fakultas_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$this->load->view('fakultas/fakultas_form',$data);
				}else{
					$data_in=array(
					'id_fakultas' => random_id(),
					'nama_fakultas' => $in['fk_nama_fakultas']
					);
					$input_data=$this->fakultas_model->input_fakultas($data_in);
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


			function fakultas_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['fakultas']=$this->fakultas_model->get_by_id_fakultas($id)->row();
						$this->load->view('fakultas/fakultas_form',$data);
				}else{
					$data_in=array(
					'nama_fakultas' => $in['fk_nama_fakultas']
					);
					$update_data=$this->fakultas_model->update_fakultas($data_in,$in['fk_']);
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

			function fakultas_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->fakultas_model->delete_fakultas($id);
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

			function fakultas_actionAll($action=""){
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
					$hapus=$this->fakultas_model->delete_fakultas($idArray[$x]);
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
