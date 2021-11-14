<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Skema extends Member_Control {

		   public function __construct()
		   {
				parent::__construct();
				$this->load->helper(array('url','global_function'));
				$this->load->model(array('skema_model'));
				active_link("master");
		   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Skema";
				 $data['s']=$s;
				 $data['op_search']=array("A.jenis_skema"=>"Jenis Skema", "A.nama_skema"=>"Nama Skema");
				 $this->template->mainview('skema/skema_index',$data);
			}
			function skema_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.jenis_skema LIKE '%".$in['cari']."%'  OR A.nama_skema LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				 $option.=" ORDER BY A.nama_skema ASC ";
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('skema/skema_show');
				 $config['first_url'] = site_url('skema/skema_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->skema_model->show_data_skema($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['skema']=$this->skema_model->show_data_skema($option,$start,$config['per_page'])->result();
				$this->load->view('skema/skema_show',$data);
			}

			function skema_select(){
				$in=$this->input->post(null,true);
				$jenis_usulan=$in['filter'];
				$d=$this->skema_model->show_data_skema(" WHERE A.jenis_skema='".$jenis_usulan."' ORDER BY A.nama_skema");
				if($d->num_rows()>0){
					$data=$d->result();
					echo json_encode(array("status"=>"200","data"=>$data));
				}else{
					echo json_encode(array("status"=>"400","data"=>NULL));
				}
			}

			function skema_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data='';
					$this->load->view('skema/skema_search',$data);
				}else{
					if($in['skm_jenis_skema']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.jenis_skema LIKE '%".$in['skm_jenis_skema']."%' ";
					}
					if($in['skm_nama_skema']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.nama_skema LIKE '%".$in['skm_nama_skema']."%' ";
					}
				$numRows=$this->skema_model->show_data_skema($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['skema']=$this->skema_model->show_data_skema($option)->result();
				$this->load->view('skema/skema_show',$data);
				}
			}

			function skema_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$this->load->view('skema/skema_form',$data);
				}else{
					$data_in=array(
					'id_skema' => random_id(),
					'jenis_skema' => $in['skm_jenis_skema'],
					'nama_skema' => $in['skm_nama_skema']
					);
					$input_data=$this->skema_model->input_skema($data_in);
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

			function skema_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['skema']=$this->skema_model->get_by_id_skema($id)->row();
						$this->load->view('skema/skema_form',$data);
				}else{
					$data_in=array(
					'jenis_skema' => $in['skm_jenis_skema'],
					'nama_skema' => $in['skm_nama_skema']
					);
					$update_data=$this->skema_model->update_skema($data_in,$in['skm_id_skema']);
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

			function skema_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->skema_model->delete_skema($id);
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

			function skema_actionAll($action=""){
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
					$hapus=$this->skema_model->delete_skema($idArray[$x]);
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
