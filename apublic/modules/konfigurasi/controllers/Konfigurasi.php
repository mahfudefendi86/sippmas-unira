<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Konfigurasi extends Member_Control {

	   public function __construct()
	   {
			parent::__construct();
			$this->load->helper(array('url','format_tanggal','global_function'));
			$this->load->model(array('konfigurasi_model'));
			active_link("Konfigurasi");
	   }

		function index($s=0){
			return $this->show($s);
		}

		function cek_level(){
			if($this->session->userdata('akses')=="SUA"){
				return true;
			}else{
				redirect('konfigurasi');
			}
		}

		function show($s=0){
			 $data['title']="Daftar Konfigurasi";
			 $data['s']=$s;
			 $data['op_search']=array();
			 $this->template->mainview('konfigurasi/konfigurasi_index',$data);
		}
		function konfigurasi_show($st=NULL,$option=""){
			$in=$this->input->post(null,true);
			$row=10;$sort="";$filt="";
			if($st==NULL){$start=0;}else{$start=$st;};
			$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
			if($in['cari']!=NULL || $in['cari']!=""){
				$option.=" WHERE (A.nama_konfig ) LIKE '%".$in['cari']."%' ";
			}
			 $option.=$filt;
			///pengaturan pagination
			 $this->load->library('pagination');
			 $config['base_url'] = site_url('konfigurasi/konfigurasi_show');
			 $config['first_url'] = site_url('konfigurasi/konfigurasi_show/0');
			 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
			 $config['per_page'] = $row;
			 $config['total_rows'] = $this->konfigurasi_model->show_data_konfigurasi($option)->num_rows();
			 //inisialisasi config
			 $this->pagination->initialize($config);
			 $data['links'] = $this->pagination->create_links();
			 $data['start']=$start;
			 $data['end']=$start+$config['per_page'];
			 $data['total_rows']=$config['total_rows'];
			$data['konfigurasi']=$this->konfigurasi_model->show_data_konfigurasi($option,$start,$config['per_page'])->result();
			$this->load->view('konfigurasi/konfigurasi_show',$data);
		}

		function konfigurasi_add(){
			//$this->cek_level();
			$in=$this->input->post(null,true);
			if(!$in){
				$data['title']="Konfigurasi Pengajuan Penelitian/Pengabdian";
				$this->template->mainview('konfigurasi/konfigurasi_form',$data);
			}else{
				$data_in=array(
				'id_konf' => $in['kn_id_konf'],
				'nama_konfig'=>$in['kn_konfig'],
				'tgl_mulai' => $in['kn_mulai_tanggal'],
				'tgl_akhir' => $in['kn_sampai_tanggal'],
				'keterangan' => $in['kn_']
				);
				$input_data=$this->konfigurasi_model->input_konfigurasi($data_in);
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

		function konfigurasi_upd($id=null){
			$in=$this->input->post(null,true);
			if(!$in){
					$data['title']="Edit Konfigurasi";
					$data['konfigurasi']=$this->konfigurasi_model->get_by_id_konfigurasi($id)->row();
					$this->template->mainview('konfigurasi/konfigurasi_form',$data);
			}else{
				$data_in=array(
				'nama_konfig'=>$in['kn_konfig'],
				'tgl_mulai' => $in['kn_mulai_tanggal'],
				'tgl_akhir' => $in['kn_sampai_tanggal'],
				'keterangan' => $in['kn_']
				);
				$update_data=$this->konfigurasi_model->update_konfigurasi($data_in,$in['kn_id_konf']);
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

		function konfigurasi_dlt($id=''){
			$this->cek_level();
			$in=$this->input->post(null,true);
			if(!$in && $id!=''){
				$hapus=$this->konfigurasi_model->delete_konfigurasi($id);
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

}
