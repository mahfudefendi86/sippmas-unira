<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Anggaran extends Member_Control {

		   public function __construct()
		   {
				parent::__construct();
				$this->load->helper(array('url','global_function','format_tanggal'));
				$this->load->model(array('anggaran_model'));
				active_link("master");
		   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Anggaran";
				 $data['s']=$s;
				 $data['op_search']=array("A.tahun_anggaran"=>"Tahun Anggaran");
				 $this->template->mainview('anggaran/anggaran_index',$data);
			}
			function anggaran_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.tahun_anggaran LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('anggaran/anggaran_show');
				 $config['first_url'] = site_url('anggaran/anggaran_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->anggaran_model->show_data_anggaran($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['anggaran']=$this->anggaran_model->show_data_anggaran($option,$start,$config['per_page'])->result();
				$this->load->view('anggaran/anggaran_show',$data);
			}

			function anggaran_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$this->load->view('anggaran/anggaran_search',$data);
				}else{

					if($in['agr_tahun_anggaran']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.tahun_anggaran LIKE '%".$in['agr_tahun_anggaran']."%' ";
					}
				$numRows=$this->anggaran_model->show_data_anggaran($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['anggaran']=$this->anggaran_model->show_data_anggaran($option)->result();
				$this->load->view('anggaran/anggaran_show',$data);
				}
			}

			function anggaran_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$this->load->view('anggaran/anggaran_form',$data);
				}else{
					$data_in=array(
					'id_anggaran' => random_id(),
					'tahun_anggaran' => $in['agr_tahun_anggaran'],
					'jumlah' => $in['agr_jumlah_anggaran'],
					'tgl_awal_proposal' => $in['agr_tgl_mulai_proposal'],
					'tgl_akhir_proposal' => $in['agr_tgl_akhir_proposal'],
					'tgl_awal_laporan' => $in['agr_tgl_mulai_laporan'],
					'tgl_akhir_laporan' => $in['agr_tgl_akhir_laporan'],
					'status'=>$in['status']
					);
					$input_data=$this->anggaran_model->input_anggaran($data_in);
					if($input_data){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil disimpan...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal disimpan...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}


			function anggaran_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['anggaran']=$this->anggaran_model->get_by_id_anggaran($id)->row();
						$this->load->view('anggaran/anggaran_form',$data);
				}else{
					$data_in=array(
					'tahun_anggaran' => $in['agr_tahun_anggaran'],
					'jumlah' => $in['agr_jumlah_anggaran'],
					'tgl_awal_proposal' => $in['agr_tgl_mulai_proposal'],
					'tgl_akhir_proposal' => $in['agr_tgl_akhir_proposal'],
					'tgl_awal_laporan' => $in['agr_tgl_mulai_laporan'],
					'tgl_akhir_laporan' => $in['agr_tgl_akhir_laporan'],
					'status'=>$in['status']
					);
					$update_data=$this->anggaran_model->update_anggaran($data_in,$in['agr_di_anggaran']);
					if($update_data){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil diupdate...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal diupdate...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			function anggaran_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->anggaran_model->delete_anggaran($id);
					if($hapus){
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

			function anggaran_actionAll($action=""){
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
					$hapus=$this->anggaran_model->delete_anggaran($idArray[$x]);
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
