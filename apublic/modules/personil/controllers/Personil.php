<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Personil extends Member_Control {

		   public function __construct()
		   {
				parent::__construct();
				$this->load->helper(array('url'));
				$this->load->model(array('personil_model','peneliti/peneliti_model','penelitian/penelitian_model','fakultas/fakultas_model','prodi/prodi_model'));
				active_link("penelitian");
		   }

			function index($s=0){
				redirect('penelitian');
			}

			function show($id=""){
				if($id!="" || $id!=NULL){
					/* cek penelitian */
					$p=$this->penelitian_model->show_data_penelitian(" WHERE A.id_penelitian='".$id."' LIMIT 1");
					if($p->num_rows()>0){
		   				$data['penelitian']=$p->row();
					}
					$data['title']="Daftar Personil";
					$data['op_search']=array("A.jenis_personil"=>"Jenis Personil", "A.nama_personil"=>"Nama");
					$this->template->mainview('personil/personil_index',$data);
				}else{
					redirect('penelitian');
				}
			}
			function personil_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				/* Menampilkan sesuai Penelitian yg dipilih */
				if($in['id_penelitian']!=NULL || $in['id_penelitian']!=""){
					($option=="")?$option.=" WHERE ":$option.=" AND ";
					$option.=" A.id_penelitian='".$in['id_penelitian']."' ";
				}
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.id_penelitian LIKE '%".$in['cari']."%'  OR A.jenis_personil LIKE '%".$in['cari']."%'  OR A.nama_personil LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('personil/personil_show');
				 $config['first_url'] = site_url('personil/personil_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->personil_model->show_data_personil($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['personil']=$this->personil_model->show_data_personil($option,$start,$config['per_page'])->result();
				$this->load->view('personil/personil_show',$data);
			}

			function personil_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$this->load->view('personil/personil_search',$data);
				}else{

					if($in['psn_id_penelitian']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.id_penelitian LIKE '%".$in['psn_id_penelitian']."%' ";
					}
					if($in['psn_jenis_personil']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.jenis_personil LIKE '%".$in['psn_jenis_personil']."%' ";
					}
					if($in['psn_nama']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.nama_personil LIKE '%".$in['psn_nama']."%' ";
					}
				$numRows=$this->personil_model->show_data_personil($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['personil']=$this->personil_model->show_data_personil($option)->result();
				$this->load->view('personil/personil_show',$data);
				}
			}

			function personil_add($id=""){
				$in=$this->input->post(null,true);
				if(!$in && $id!=""){
					$data['penelitian']=$this->penelitian_model->show_data_penelitian(" WHERE A.id_penelitian='".$id."' LIMIT 1")->row();
					$data['id_user']=$this->personil_model->lookup_tbl_peneliti()->result();
					$data['fakultas']=$this->fakultas_model->show_data_fakultas()->result();
					$this->load->view('personil/personil_form',$data);
				}else{
					if($in['psn_jenis_personil']=="DOSEN" &&  ($in['psn_pilih_dosen']!=NULL || $in['psn_pilih_dosen']!="") ){
						$peneliti=$this->peneliti_model->get_by_id_peneliti($in['psn_pilih_dosen'])->row();
						$data_in=array(
						'id_penelitian' => $in['psn_id_penelitian'],
						'jenis_personil' => $in['psn_jenis_personil'],
						'id_user' => $in['psn_pilih_dosen'],
						'nama_personil' => $peneliti->nama,
						'nim_nidn' => $peneliti->nidn,
						'fakultas'=>$peneliti->fakultas,
						'program_studi' => $peneliti->prodi
						);
					}else{
						$data_in=array(
						'id_penelitian' => $in['psn_id_penelitian'],
						'jenis_personil' => $in['psn_jenis_personil'],
						'nama_personil' => $in['psn_nama'],
						'nim_nidn' => $in['psn_nim'],
						'fakultas'=>$in['pnl_fakultas'],
						'program_studi' => $in['psn_program_studi']
						);
					}
					$input_data=$this->personil_model->input_personil($data_in);
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


			function personil_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$p=$this->personil_model->get_by_id_personil($id)->row();
						$data['penelitian']=$this->penelitian_model->show_data_penelitian(" WHERE A.id_penelitian='".$p->id_penelitian."' LIMIT 1")->row();
						$data['id_user']=$this->personil_model->lookup_tbl_peneliti()->result();
						$data['fakultas']=$this->fakultas_model->show_data_fakultas()->result();
						$data['program_studi']=$this->prodi_model->show_data_prodi(" WHERE A.id_fakultas='".$p->fakultas."' ")->result();
						$data['personil']=$p;
						$this->load->view('personil/personil_form',$data);
				}else{
					$data_in=array(
					'id_penelitian' => $in['psn_id_penelitian'],
					'jenis_personil' => $in['psn_jenis_personil'],
					'id_user' => $in['psn_pilih_dosen'],
					'nama_personil' => $in['psn_nama'],
					'nim_nidn' => $in['psn_nim'],
					'fakultas'=>$in['pnl_fakultas'],
					'program_studi' => $in['psn_program_studi']
					);
					$update_data=$this->personil_model->update_personil($data_in,$in['psn_id_personil']);
					if($update_data){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di-update...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal di-update...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			function personil_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->personil_model->delete_personil($id);
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

			function personil_actionAll($action=""){
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
					$hapus=$this->personil_model->delete_personil($idArray[$x]);
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
