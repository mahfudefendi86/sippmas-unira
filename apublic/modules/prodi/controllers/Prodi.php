<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Prodi extends Member_Control {

		   public function __construct()
		   {
				parent::__construct();
				$this->load->helper(array('url','global_function'));
				$this->load->model(array('prodi_model'));
				active_link("master");
		   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Prodi";
				 $data['s']=$s;
				 $data['op_search']=array("A.nama_prodi"=>"Program Studi","B.nama_fakultas"=>"Fakultas");
				 $this->template->mainview('prodi/prodi_index',$data);
			}
			function prodi_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( B.nama_fakultas LIKE '%".$in['cari']."%' OR A.nama_prodi LIKE '%".$in['cari']."%') ";
					}
				}
				 $option.=$filt;
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('prodi/prodi_show');
				 $config['first_url'] = site_url('prodi/prodi_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->prodi_model->show_data_prodi($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['prodi']=$this->prodi_model->show_data_prodi($option,$start,$config['per_page'])->result();
				$this->load->view('prodi/prodi_show',$data);
			}

			function prodi_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$data['id_fakultas']=$this->prodi_model->lookup_tbl_fakultas()->result();
					$this->load->view('prodi/prodi_search',$data);
				}else{

					if($in['pr_pilih_fakultas']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.id_fakultas LIKE '%".$in['pr_pilih_fakultas']."%' ";
					}
				$numRows=$this->prodi_model->show_data_prodi($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['prodi']=$this->prodi_model->show_data_prodi($option)->result();
				$this->load->view('prodi/prodi_show',$data);
				}
			}

			function prodi_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$data['id_fakultas']=$this->prodi_model->lookup_tbl_fakultas()->result();
					$this->load->view('prodi/prodi_form',$data);
				}else{
					$data_in=array(
					'id_prodi' => random_id(),
					'id_fakultas' => $in['pr_pilih_fakultas'],
					'nama_prodi' => $in['pr_nama_program_studi']
					);
					$input_data=$this->prodi_model->input_prodi($data_in);
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


			function prodi_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
					$data['id_fakultas']=$this->prodi_model->lookup_tbl_fakultas()->result();
						$data['prodi']=$this->prodi_model->get_by_id_prodi($id)->row();
						$this->load->view('prodi/prodi_form',$data);
				}else{
					$data_in=array(
					'id_fakultas' => $in['pr_pilih_fakultas'],
					'nama_prodi' => $in['pr_nama_program_studi']
					);
					$update_data=$this->prodi_model->update_prodi($data_in,$in['pr_']);
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

			function prodi_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->prodi_model->delete_prodi($id);
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

			function prodi_actionAll($action=""){
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
					$hapus=$this->prodi_model->delete_prodi($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

	/**** SELECT PRODI BY FAKULTAS *****/
	function select_prodi(){
		$in=$this->input->post(null,true);
		if($in){
			$data=array();
			$option=" WHERE A.id_fakultas='".$in['idfak']."' ";
			$p=$this->prodi_model->show_data_prodi($option);
			if($p->num_rows()>0){
				$prodi=$p->result();
				if($prodi){
					$data['status']="200";
					$data['data']=$prodi;
					$data['msg']="Data berhasil ditemukan";
				}
			}else{
				$data['status']="401";
				$data['data']="";
				$data['msg']="Data Tidak ditemukan";
			}
			echo json_encode($data);
		}
	}

}
