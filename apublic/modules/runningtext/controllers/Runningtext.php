<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Runningtext extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper(array('url','format_tanggal'));
					$this->load->model(array('runningtext_model'));
					active_link("berita");
			   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Running Text";
				 $data['s']=$s;
				 $data['op_search']=array("A.text_to_run"=>"Text Informasi", "A.status_run"=>"Status");
				 $this->template->mainview('runningtext/runningtext_index',$data);
			}
			function runningtext_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.text_to_run LIKE '%".$in['cari']."%'  OR A.status_run LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('runningtext/runningtext_show');
				 $config['first_url'] = site_url('runningtext/runningtext_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->runningtext_model->show_data_runningtext($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['runningtext']=$this->runningtext_model->show_data_runningtext($option,$start,$config['per_page'])->result();
				$this->load->view('runningtext/runningtext_show',$data);
			}

			function runningtext_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data='';
					$this->load->view('runningtext/runningtext_search',$data);
				}else{

					if($in['rt_']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.text_to_run LIKE '%".$in['rt_']."%' ";
					}
					if($in['rt_']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.status_run LIKE '%".$in['rt_']."%' ";
					}
				$numRows=$this->runningtext_model->show_data_runningtext($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['runningtext']=$this->runningtext_model->show_data_runningtext($option)->result();
				$this->load->view('runningtext/runningtext_show',$data);
				}
			}

			function runningtext_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$this->load->view('runningtext/runningtext_form',$data);
				}else{
					$data_in=array(
					'id_running' => $in['rt_id_running'],
					'start_date' => $in['rt_mulai'],
					'end_date' => $in['rt_sampai'],
					'text_to_run' => $in['rt_informasi'],
					'icon_run' => $in['kg_ikon'],
					'color_teks'=>$in['kg_warana'],
					'status_run' => $in['rt_status']
					);
					$input_data=$this->runningtext_model->input_runningtext($data_in);
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

			function runningtext_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['runningtext']=$this->runningtext_model->get_by_id_runningtext($id)->row();
						$this->load->view('runningtext/runningtext_form',$data);
				}else{
					$data_in=array(
					'start_date' => $in['rt_mulai'],
					'end_date' => $in['rt_sampai'],
					'text_to_run' => $in['rt_informasi'],
					'icon_run' => $in['kg_ikon'],
					'color_teks'=>$in['kg_warana'],
					'status_run' => $in['rt_status']
					);
					$update_data=$this->runningtext_model->update_runningtext($data_in,$in['rt_id_running']);
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

			function update_status($id="",$st=""){
				if($id!="" && $st!=""){
					$data_in=array(
					'status_run' => $st
					);
					$update_data=$this->runningtext_model->update_runningtext($data_in,$id);
					if($update_data){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Status berhasil diupdate...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Status gagal update...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}else{
					$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Parameter tidak lengkap...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
					echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
				}
			}


			function runningtext_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->runningtext_model->delete_runningtext($id);
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

			function runningtext_actionAll($action=""){
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
					$hapus=$this->runningtext_model->delete_runningtext($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di HAPUS...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

}
