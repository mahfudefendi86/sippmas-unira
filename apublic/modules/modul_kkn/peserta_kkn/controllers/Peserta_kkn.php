<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Peserta_kkn extends Member_Control {

	   public function __construct()
	   {
			parent::__construct();
			$this->load->helper(array('url'));
			$this->load->model(array('peserta_kkn_model'));
			active_link("master");
	   }

		function index($s=0){
			return $this->show($s);
		}

		function show($s=0){
			 $data['title']="Daftar Peserta KKN";
			 $data['s']=$s;
			 $data['op_search']=array();
			 $this->template->kknview('peserta_kkn/peserta_kkn_index',$data);
		}
		
		function peserta_kkn_show($st=NULL,$option=""){
			$in=$this->input->post(null,true);
			$row=10; $sort=""; $filt="";
			$start = ($st==NULL) ? 0 : $st;
			if(isset($in['row']) && ($in['row']!=NULL || $in['row']!="") ){
				$row=$in['row'];
			}

			/*** FILTER ORDER DATA ****/
			if(isset($in['sortby']) && $in['sortby']!=""){
				$sort_field=array("a"=>"A.nama_mhs" ,"b"=>"A.email" ,"c"=>"A.hp" ,"d"=>"A.nim" ,"e"=>"A.jenis_kelamin" ,"f"=>"A.tempat_lahir" ,"g"=>"A.tgl_lahir" ,"h"=>"A.alamat_domisili" ,"i"=>"A.desa" ,"j"=>"A.kecamatan" ,"k"=>"A.kotakab" ,"l"=>"A.id_fakultas" ,"m"=>"A.id_prodi" ,"n"=>"A.kesehatan" ,"o"=>"A.penyakit_diderita" ,"p"=>"A.keluarga" ,"q"=>"A.is_hamil" ,"r"=>"A.is_kerja" ,"s"=>"A.pekerjaan" ,"t"=>"A.status_pekerjaan" ,"u"=>"A.alamat_kerja" ,"v"=>"A.ukuran_jaket" ,"w"=>"A.berkas" );
				$option.=" ORDER BY ".$sort_field[$in['sortby']]." ".$in['sort'];
			}

			/**** pengaturan pagination ***/
			$this->load->library('pagination');
			$config['base_url'] = site_url('peserta_kkn/peserta_kkn_show');
			$config['first_url'] = site_url('peserta_kkn/peserta_kkn_show/0');
			$config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
			$config['per_page'] = $row;
			$config['total_rows'] = $this->peserta_kkn_model->show_data_peserta_kkn($option)->num_rows();

			/*** inisialisasi config pagination ***/
			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links();
			$data['start']=$start;
			$data['end']=$start+$config['per_page'];
			$data['total_rows']=$config['total_rows'];
			$data['peserta_kkn']=$this->peserta_kkn_model->show_data_peserta_kkn($option,$start,$config['per_page'])->result();
			$this->load->view('peserta_kkn/peserta_kkn_show',$data);
		}

		function peserta_kkn_add(){
			$in=$this->input->post(null,true);
			if(!$in){
				$data['title']="Tambah Peserta Kkn"; 
				$data['id_fakultas']=$this->peserta_kkn_model->lookup_tbl_fakultas()->result();
				$data['id_prodi']=$this->peserta_kkn_model->lookup_tbl_prodi()->result();
				$this->load->view('peserta_kkn/peserta_kkn_form',$data);
			}else{
				$data_in=array(
					'id_peserta' => $in['kknn_id_peserta'],
					'nama_mhs' => $in['kknn_nama_lengkap'],
					'email' => $in['kknn_email'],
					'hp' => $in['kknn_nomer_hp'],
					'nim' => $in['kknn_nim'],
					'jenis_kelamin' => $in['kknn_jenis_kelamin'],
					'tempat_lahir' => $in['kknn_tempat_lahir'],
					'tgl_lahir' => $in['kknn_tanggal_lahir'],
					'alamat_domisili' => $in['kknn_alamat_domisili'],
					'desa' => $in['kknn_desa'],
					'kecamatan' => $in['kknn_kecamatan'],
					'kotakab' => $in['kknn_kota'],
					'id_fakultas' => $in['kknn_fakultas'],
					'id_prodi' => $in['kknn_program_pendidikan'],
					'kesehatan' => $in['kknn_kondisi_kesehatan'],
					'penyakit_diderita' => $in['kknn_penyakit'],
					'keluarga' => $in['kknn_memiliki_istri'],
					'is_hamil' => $in['kknn_hamil'],
					'is_kerja' => $in['kknn_bekerja'],
					'pekerjaan' => $in['kknn_pekerjaan'],
					'status_pekerjaan' => $in['kknn_status_pekerjaan'],
					'alamat_kerja' => $in['kknn_alamat_kerja'],
					'ukuran_jaket' => $in['kknn_ukuran_jaket'],
					'berkas' => $in['kknn_upload']
					);
				$input_data=$this->peserta_kkn_model->input_peserta_kkn($data_in);
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


		function peserta_kkn_upd($id=null){
			$in=$this->input->post(null,true);
			if(!$in){
				$data['title']="Update Peserta Kkn"; 
				$data['id_fakultas']=$this->peserta_kkn_model->lookup_tbl_fakultas()->result();
				$data['id_prodi']=$this->peserta_kkn_model->lookup_tbl_prodi()->result();
				$data['peserta_kkn']=$this->peserta_kkn_model->get_by_id_peserta_kkn($id)->row();
				$this->load->view('peserta_kkn/peserta_kkn_form',$data);
			}else{
				$data_in=array(
					'nama_mhs' => $in['kknn_nama_lengkap'],
					'email' => $in['kknn_email'],
					'hp' => $in['kknn_nomer_hp'],
					'nim' => $in['kknn_nim'],
					'jenis_kelamin' => $in['kknn_jenis_kelamin'],
					'tempat_lahir' => $in['kknn_tempat_lahir'],
					'tgl_lahir' => $in['kknn_tanggal_lahir'],
					'alamat_domisili' => $in['kknn_alamat_domisili'],
					'desa' => $in['kknn_desa'],
					'kecamatan' => $in['kknn_kecamatan'],
					'kotakab' => $in['kknn_kota'],
					'id_fakultas' => $in['kknn_fakultas'],
					'id_prodi' => $in['kknn_program_pendidikan'],
					'kesehatan' => $in['kknn_kondisi_kesehatan'],
					'penyakit_diderita' => $in['kknn_penyakit'],
					'keluarga' => $in['kknn_memiliki_istri'],
					'is_hamil' => $in['kknn_hamil'],
					'is_kerja' => $in['kknn_bekerja'],
					'pekerjaan' => $in['kknn_pekerjaan'],
					'status_pekerjaan' => $in['kknn_status_pekerjaan'],
					'alamat_kerja' => $in['kknn_alamat_kerja'],
					'ukuran_jaket' => $in['kknn_ukuran_jaket'],
					'berkas' => $in['kknn_upload']
					);
				$update_data=$this->peserta_kkn_model->update_peserta_kkn($data_in,$in['kknn_id_peserta']);
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

		function peserta_kkn_dlt($id=''){
			$in=$this->input->post(null,true);
			if(!$in && $id!=''){
				$hapus=$this->peserta_kkn_model->delete_peserta_kkn($id);
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

		function peserta_kkn_actionAll($action=""){
			$cMsg=0;
			$in=$this->input->post(null,true);
			//change data sparated comma text to array
			$dataArray=explode(',',$in['dataArray']);
			//remove "no" dari array
			$idArray = array_diff($dataArray,array('on'));
			$cArray=count($idArray);
			$newIdArray=array();
			for($x=0;$x<$cArray;$x++){
				array_push($newIdArray,$idArray[$x]);
			}
			///jika action yang di klik adalah delete
			if($action=="delete"){
				$hapus=$this->peserta_kkn_model->delete_peserta_kkn($newIdArray);
				if($hapus) $cMsg++;
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

}