<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reviewer extends Member_Control {

		   public function __construct()
		   {
				parent::__construct();
				$this->load->helper(array('url','global_function','format_tanggal'));
				$this->load->model(array('reviewer_model','fakultas/fakultas_model','wilayah/wilayah_model','prodi/prodi_model','keahlian/keahlian_model','bidang_ilmu/bidang_ilmu_model'));

		  }

		  function cek_user(){
			$lv=$this->session->userdata('akses');
			if($lv==="SUA" || $lv==="ADM"){
				return true;
			}else{
				redirect("main/dashboard");
			}
		  }

			function index($s=0){
				$this->cek_user();
				active_link("master");
				return $this->show($s);
			}

			function daftar(){
				$this->cek_user();
				active_link("reviewer");
				redirect("reviewer/show");
			}

			function show($s=0){
				$this->cek_user();
				$data['title']="Daftar Reviewer";
				$data['s']=$s;
				$data['op_search']=array("A.nama"=>"Nama Lengkap", "A.nidn"=>"NIDN","E.nama_fakultas"=>"Fakultas","F.nama_prodi"=>"Program Studi");
				$this->template->mainview('reviewer/reviewer_index',$data);
			}
			function reviewer_show($st=NULL,$option=""){
				$this->cek_user();
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.nama LIKE '%".$in['cari']."%'  OR A.nidn LIKE '%".$in['cari']."%'  OR E.nama_fakultas LIKE '%".$in['cari']."%'  OR F.nama_prodi LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				 $option.=" ORDER BY A.nama ASC ";
				///pengaturan pagination
				$this->load->library('pagination');
				$config['base_url'] = site_url('reviewer/reviewer_show');
				$config['first_url'] = site_url('reviewer/reviewer_show/0');
				$config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				$config['per_page'] = $row;
				$config['total_rows'] = $this->reviewer_model->show_data_reviewer($option)->num_rows();
				 //inisialisasi config
				$this->pagination->initialize($config);
				$data['links'] = $this->pagination->create_links();
				$data['start']=$start;
				$data['end']=$start+$config['per_page'];
				$data['total_rows']=$config['total_rows'];
				$data['reviewer']=$this->reviewer_model->show_data_reviewer($option,$start,$config['per_page'])->result();
				$this->load->view('reviewer/reviewer_show',$data);
			}

			function reviewer_search($start=0,$option=""){
				$this->cek_user();
				$in=$this->input->post(null,true);
				if(!$in){
					$data['fakultas']=$this->fakultas_model->show_data_fakultas()->result();
					$this->load->view('reviewer/reviewer_search',$data);
				}else{

					if($in['pnl_nama_lengkap']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.nama LIKE '%".$in['pnl_nama_lengkap']."%' ";
					}
					if($in['pnl_nidn']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.nidn LIKE '%".$in['pnl_nidn']."%' ";
					}
					if($in['pnl_fakultas']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.fakultas LIKE '%".$in['pnl_fakultas']."%' ";
					}
					if($in['pnl_program_studi']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.prodi LIKE '%".$in['pnl_program_studi']."%' ";
					}
					if($in['pnl_alamat']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.alamat LIKE '%".$in['pnl_alamat']."%' ";
					}
					if($in['pnl_email']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.email LIKE '%".$in['pnl_email']."%' ";
					}
				$numRows=$this->reviewer_model->show_data_reviewer($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['reviewer']=$this->reviewer_model->show_data_reviewer($option)->result();
				$this->load->view('reviewer/reviewer_show',$data);
				}
			}

			function reviewer_add(){
				$this->cek_user();
				$in=$this->input->post(null,true);
				if(!$in){
					$data['keahlian']=$this->keahlian_model->show_data_keahlian()->result();
					$data['fakultas']=$this->fakultas_model->show_data_fakultas()->result();
					$data['kota_kab']=$this->wilayah_model->show_data_kotakab(" WHERE A.province_id IN('31','32','33','34','35','51') ORDER BY A.name ASC ")->result();
					$this->load->view('reviewer/reviewer_form',$data);
				}else{
					$data_in=array(
						'id_user' => random_id(),
						'nama' => $in['pnl_nama_lengkap'],
						'nidn' => $in['pnl_nidn'],
						'alamat' => $in['pnl_alamat'],
						'desa' => $in['pnl_desa'],
						'kecamatan' => $in['pnl_kecamatan'],
						'kota_kab' => $in['pnl_kota'],
						'email' => $in['pnl_email'],
						'no_hp' => $in['pnl_nomer_hp'],
						'tempat_lahir' => $in['pnl_tempat_lahir'],
						'tgl_lahir' => $in['pnl_tanggal_lahir'],
						'fakultas' => $in['pnl_fakultas'],
						'prodi' => $in['pnl_program_studi'],
						'bidang_keahlian' => $in['pnl_bidang_keahlian'],
						'bidang_ilmu' => $in['pnl_bidang_ilmu'],
						'created_date'=>date('Y-m-d H:i:s')
					);
					$input_data=$this->reviewer_model->input_reviewer($data_in);
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

			function reviewer_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
					$this->cek_user();
					$peneliti=$this->reviewer_model->get_by_id_reviewer($id)->row();
					$data['desa']=$this->wilayah_model->show_data_desa(" WHERE A.district_id='".$peneliti->kecamatan."' ")->result();
					$data['kecamatan']=$this->wilayah_model->show_data_kecamatan(" WHERE A.regency_id='".$peneliti->kota_kab."' ")->result();
					$data['kota_kab']=$this->wilayah_model->show_data_kotakab(" WHERE A.province_id IN('31','32','33','34','35','51') ORDER BY A.name ASC ")->result();
					$data['fakultas']=$this->fakultas_model->show_data_fakultas()->result();
					$data['prodi']=$this->prodi_model->show_data_prodi()->result();
					$data['keahlian']=$this->keahlian_model->show_data_keahlian()->result();
					$data['keilmuan']=$this->bidang_ilmu_model->show_data_bidang_ilmu(" WHERE A.id_bidangkeahlian='".$peneliti->bidang_keahlian."' ")->result();
					$data['reviewer']=$peneliti;
					$this->load->view('reviewer/reviewer_form',$data);
				}else{
					$data_in=array(
					'nama' => $in['pnl_nama_lengkap'],
					'nidn' => $in['pnl_nidn'],
					'alamat' => $in['pnl_alamat'],
					'desa' => $in['pnl_desa'],
					'kecamatan' => $in['pnl_kecamatan'],
					'kota_kab' => $in['pnl_kota'],
					'email' => $in['pnl_email'],
					'no_hp' => $in['pnl_nomer_hp'],
					'tempat_lahir' => $in['pnl_tempat_lahir'],
					'tgl_lahir' => $in['pnl_tanggal_lahir'],
					'fakultas' => $in['pnl_fakultas'],
					'prodi' => $in['pnl_program_studi'],
					'bidang_keahlian' => $in['pnl_bidang_keahlian'],
					'bidang_ilmu' => $in['pnl_bidang_ilmu'],
					'updated_date'=>date('Y-m-d H:i:s')
					);
					$update_data=$this->reviewer_model->update_reviewer($data_in,$in['pnl_id_user']);
					if($update_data){
						$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di-update...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'OK'));
					}else{
						$notif='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Data GAGAL di-update...
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
				}
			}

			function reviewer_dlt($id=''){
				$this->cek_user();
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->reviewer_model->delete_reviewer($id);
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

			function reviewer_actionAll($action=""){
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
					$hapus=$this->reviewer_model->delete_reviewer($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

		/* UPLOAD FOTO */
			function foto($id=""){
				if($id!=""){
					$reviewer=$this->reviewer_model->get_by_id_reviewer($id);
					if($reviewer->num_rows()>0){
						$data['reviewer']=$reviewer->row();
						$this->template->mainview('reviewer/upload_foto',$data);
					}else{
						$this->template->mainview('reviewer/reviewer_info');
					}
				}else{
					redirect('reviewer');
				}
			}

			/************ SIMPAN FOTO ***********/
			function save_foto(){
					$in=$this->input->post(null,true);
					$path_dir_file='file_uploaded/foto_reviewer/';
					if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}

					//upload gambar
					$config['upload_path'] = $path_dir_file;
					$config['file_name'] = $in['id_user'];
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '1000';
					$config['overwrite']=TRUE;

					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload())
					{
						$notif='<div class="h3 alert alert-danger" onclick="$(this).fadeOut(300);"><i class="fa fa-warning"></i> <strong>Foto Gagal di Upload!!</strong><br/>*) Pastikan anda telah memilih foto...!<br/>*) Kapasitas Foto maksimal adalah 1000Kb (1Mb)...!</div>';
							echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}
					else
					{
						$data=$this->upload->data();
						$url= $config['upload_path'].$data['file_name'];
						/* buat thumbanil */
						$this->resizeImage($config['upload_path'],$data['file_name']);
						$url_thumb=$path_dir_file."thumbnail/".$data['raw_name']."_thumb".$data['file_ext'];
						$data_in=array(
							'foto' =>$url,
							'foto_thumb'=>$url_thumb
							);
						$update_data=$this->reviewer_model->update_reviewer($data_in,$in['id_user']);
						if($update_data){
							$notif='<div class="h3 alert alert-success" onclick="$(this).fadeOut(300);"><i class="fa fa-check-circle"></i> Data berhasil di-update...</div>';
							echo json_encode(array('msg'=>$notif,'status'=>'OK','img'=>$url));
						}else{
							$notif='<div class="h3 alert alert-danger" onclick="$(this).fadeOut(300);"><i class="fa fa-warning"></i> <strong>MAAF!</strong> Data gagal disimpan...</div>';
							echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
						}
					}
			}

			/**
			* Manage uploadImage
			*
			* @return Response
			*/
			public function resizeImage($path,$filename)
			{
				$source_path = $path.$filename;
				$target_path = $path.'thumbnail/';
				if(!file_exists($target_path)){mkdir($target_path,0777,true);}
				$config_manip = array(
					'image_library' => 'gd2',
					'source_image' => $source_path,
					'new_image' => $target_path,
					'maintain_ratio' => TRUE,
					'create_thumb' => TRUE,
					'thumb_marker' => '_thumb',
					'width' => 300,
					'height' => 300
				);
				$this->load->library('image_lib', $config_manip);
				$this->image_lib->initialize($config_manip);
				if (!$this->image_lib->resize()) {
					echo $this->image_lib->display_errors();
				}
				$this->image_lib->clear();
				return true;
			}

			/**
			* Remove File Uploaded
			*
			* @return Response
			*/
			function foto_upload_remove(){
				$in=$this->input->post(null,true);
				$subject=$this->reviewer_model->get_by_id_reviewer($in['id'])->row();
				/* Hapus Gambar Utama */
				if(file_exists($subject->foto)) unlink($subject->foto);
				/* Hapus Gambar Thumbnail */
				if(file_exists($subject->foto_thumb)) unlink($subject->foto_thumb);
				$data_in=array(
				'foto' =>NULL, 'foto_thumb'=>NULL
				);
				$url=base_url().'asset/images/no-image.png';
				$update_data=$this->reviewer_model->update_reviewer($data_in,$in['id']);
				if($update_data){
					$notif='<div class="h3  alert alert-success" onclick="$(this).fadeOut(300);"><i class="fa fa-check-circle"></i> Foto berhasil dihapus...</div>';
					echo json_encode(array('msg'=>$notif,'status'=>'OK','img'=>$url));
				}else{
					$notif='<div class="h3  alert alert-danger" onclick="$(this).fadeOut(300);"><i class="fa fa-check-circle"></i> <strong>MAAF!</strong> Data gagal dihapus...</div>';
					echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
				}
			}

	function reviewer_profil_show(){
		if($this->session->userdata("akses")=="REVIEWER"){
			$id=$this->session->userdata("id_user");
			if($id!="" || $id!=NULL){
				$data['title']="Profil Reviewer";
				$r=$this->reviewer_model->get_by_id_reviewer($id);
				if($r->num_rows() > 0){
					$p=$r->row();
					$data['reviewer']=$p;
				}
				$this->template->mainview("reviewer/profil_reviewer",$data);
			}
		}
	}

	/*** UPDATE DATA REVIEWER ***/
	function reviewer_profil($id=""){
		if($id!=""){
			$data['title']="Update profil reviewer";
			$peneliti=$this->reviewer_model->get_by_id_reviewer($id);
			if($peneliti->num_rows() > 0){
				$data['desa']=$this->wilayah_model->show_data_desa(" WHERE A.district_id='".$peneliti->kecamatan."' ")->result();
				$data['kecamatan']=$this->wilayah_model->show_data_kecamatan(" WHERE A.regency_id='".$peneliti->kota_kab."' ")->result();
				$data['kota_kab']=$this->wilayah_model->show_data_kotakab(" WHERE A.province_id IN('31','32','33','34','35','51') ORDER BY A.name ASC ")->result();
				$data['fakultas']=$this->fakultas_model->show_data_fakultas()->result();
				$data['prodi']=$this->prodi_model->show_data_prodi()->result();
				$data['keahlian']=$this->keahlian_model->show_data_keahlian()->result();
				$data['keilmuan']=$this->bidang_ilmu_model->show_data_bidang_ilmu(" WHERE A.id_bidangkeahlian='".$peneliti->bidang_keahlian."' ")->result();
				$data['reviewer']=$peneliti->row();
				$this->template->mainview('reviewer/reviewer_form',$data);
			}else{
				$this->template->mainview('reviewer/reviewer_info');
			}
		}
	}


}
