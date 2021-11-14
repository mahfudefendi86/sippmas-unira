<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Berkas extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper(array('url','format_tanggal','global_function'));
					$this->load->model(array('berkas_model','catatan/catatan_model','penelitian/penelitian_model'));
			   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Berkas";
				 $data['s']=$s;
				 $data['op_search']=array();
				 $this->template->mainview('berkas/berkas_index',$data);
			}
			function berkas_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE () ";
					}
				}
				 $option.=$filt;
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('berkas/berkas_show');
				 $config['first_url'] = site_url('berkas/berkas_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->berkas_model->show_data_berkas($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['berkas']=$this->berkas_model->show_data_berkas($option,$start,$config['per_page'])->result();
				$this->load->view('berkas/berkas_show',$data);
			}

			function berkas_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$this->load->view('berkas/berkas_search',$data);
				}else{

				$numRows=$this->berkas_model->show_data_berkas($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['berkas']=$this->berkas_model->show_data_berkas($option)->result();
				$this->load->view('berkas/berkas_show',$data);
				}
			}
/* Tambah berkas CATATAN */
			function berkas_add_catatan(){
				$in=$this->input->post(null,true);
				/* cek data catatan */
				$c=$this->catatan_model->get_by_id_catatan($in['id_catatan']);
				if($c->num_rows()>0){
					$data['catatan']=$c->row();
					$this->load->view('berkas/berkas_form_catatan',$data);
				}else{
					echo '<div class="alert alert-danger">Maaf data tidak ditemukan...</div>';
				}
			}
/* Tambah berkas LAPORAN KEMAJUAN */
			function berkas_add_kemajuan(){
				$in=$this->input->post(null,true);
				/* cek data catatan */
				$c=$this->penelitian_model->get_by_id_penelitian($in['id_penelitian']);
				if($c->num_rows()>0){
					$data['penelitian']=$c->row();
					$this->load->view('berkas/berkas_form_kemajuan',$data);
				}else{
					echo '<div class="alert alert-danger">Maaf data tidak ditemukan...</div>';
				}
			}
/* Tambah berkas LAPORAN AKHIR */
			function berkas_add_akhir(){
				$in=$this->input->post(null,true);
				/* cek data catatan */
				$c=$this->penelitian_model->get_by_id_penelitian($in['id_penelitian']);
				if($c->num_rows()>0){
					$data['penelitian']=$c->row();
					$this->load->view('berkas/berkas_form_akhir',$data);
				}else{
					echo '<div class="alert alert-danger">Maaf data tidak ditemukan...</div>';
				}
			}
/* Tambah berkas Tanggung Jawab Belanja */
			function berkas_add_tgjb(){
				$in=$this->input->post(null,true);
				/* cek data catatan */
				$c=$this->penelitian_model->get_by_id_penelitian($in['id_penelitian']);
				if($c->num_rows()>0){
					$data['penelitian']=$c->row();
					$this->load->view('berkas/berkas_form_tgjb',$data);
				}else{
					echo '<div class="alert alert-danger">Maaf data tidak ditemukan...</div>';
				}
			}
/* Tambah berkas Tanggung Jawab Belanja */
			function berkas_add_hasil(){
				$in=$this->input->post(null,true);
				/* cek data catatan */
				$c=$this->penelitian_model->get_by_id_penelitian($in['id_penelitian']);
				if($c->num_rows()>0){
					$data['penelitian']=$c->row();
					$this->load->view('berkas/berkas_form_hasil',$data);
				}else{
					echo '<div class="alert alert-danger">Maaf data tidak ditemukan...</div>';
				}
			}
/* SIMPAN BERKAS */
			function berkas_save(){
				$in=$this->input->post(null,true);
				if($in){
					$path_dir_file='file_uploaded/laporan/'.$in['id_penelitian'].'/'.$in['bks_identifikasi_berkas'].'/';
					if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}
					//upload gambar
					$fn=$_FILES["userfile"]["name"];
					$config['upload_path'] = $path_dir_file;
					$config['file_name'] =date('ymdhis')."_".$fn;
					$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|txt|jpg|jpeg|png';
					$config['max_size'] = '2100';
					$config['remove_spaces']=TRUE;

					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload())
					{
						$notif='<div class="h3 alert alert-danger" onclick="$(this).fadeOut(300);"><i class="fa fa-warning"></i> <strong>File PDF Gagal di Upload!!</strong><br/>*) Pastikan anda telah memilih File...!<br/>*) Kapasitas File PDF maksimal adalah 2000Kb (2Mb)...!</div>';
							echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
					}else{
						$data=$this->upload->data();

						/* cek COMAND INPUT dari form */
						$command=explode("|",$in['command']);
						if( in_array("DELETE", $command, true) ){
							$sql="SELECT * FROM pr_penelitian_berkas WHERE id_penelitian='".$in['id_penelitian']."' AND identifikasi_berkas='".$in['bks_identifikasi_berkas']."' LIMIT 1 ";
							$p=$this->db->query($sql);
							if($p->num_rows()>0){
								$pen=$p->row();
								/*hapus data*/
								$this->berkas_dlt($pen->id_berkas,"pass");
							}
						}

						$url= $config['upload_path'].$data['file_name'];
						$data_in=array(
							'id_berkas' => $in['bks_id_berkas'],
							'id_penelitian' => $in['id_penelitian'],
							'identifikasi_berkas' => $in['bks_identifikasi_berkas'],
							'identifikasi_id' => $in['bks_identifikasi_id_berkas'],
							'tanggal_upload' => date("Y-m-d H:i:s"),
							'file_url' => $url,
							'file_name'=>$fn,
							'file_type'=>$data['file_ext'],
							'is_image'=>$data['is_image'],
							'keterangan_berkas' => $in['bks_keterangan']
						);
						$input_data=$this->berkas_model->input_berkas($data_in);
						if($input_data){
							$notif='<div class="h3 alert alert-success alert-dismissable" ><i class="fa fa-info-circle"></i> Data berhasil disimpan...
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							echo json_encode(array('msg'=>$notif,'status'=>'OK'));
						}else{
							$notif='<div class="h3 alert alert-danger alert-dismissable" ><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal disimpan...
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
						}
					}
				}
			}

			function berkas_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					$this->load->view('berkas/berkas_form',$data);
				}else{
					$data_in=array(
					'id_berkas' => $in['bks_id_berkas'],
					'id_penelitian' => $in['bks_id_penelitian'],
					'identifikasi_berkas' => $in['bks_identifikasi_berkas'],
					'identifikasi_id' => $in['bks_identifikasi_id_berkas'],
					'tanggal_upload' => date("Y-m-d H:i:s"),
					'file_url' => $in['bks_userfile'],
					'keterangan_berkas' => $in['bks_keterangan']
					);
					$input_data=$this->berkas_model->input_berkas($data_in);
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


			function berkas_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['berkas']=$this->berkas_model->get_by_id_berkas($id)->row();
						$this->load->view('berkas/berkas_form',$data);
				}else{
					$data_in=array(
					'id_penelitian' => $in['bks_id_penelitian'],
					'identifikasi_berkas' => $in['bks_identifikasi_berkas'],
					'identifikasi_id' => $in['bks_identifikasi_id_berkas'],
					'tanggal_upload' => $in['bks_tanggal'],
					'file_url' => $in['bks_userfile'],
					'keterangan_berkas' => $in['bks_keterangan']
					);
					$update_data=$this->berkas_model->update_berkas($data_in,$in['bks_id_berkas']);
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

			function berkas_dlt($id='',$op=NULL){
				if($id!=''){
					$berkas=$this->berkas_model->get_by_id_berkas($id)->row();
					$hapus=$this->berkas_model->delete_berkas($id);
					if(file_exists($berkas->file_url)) unlink($berkas->file_url);//Hapus File berkas
					if($op=="pass"){
						return true;
					}else{
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

		/* untuk melihat berkas catatan */
		function lihat_berkas_catatan(){
			$in=$this->input->post(null,true);
			/* cek data catatan */
			$c=$this->catatan_model->get_by_id_catatan($in['id_catatan']);
			if($c->num_rows()>0){
				$catatan=$c->row();
				//$data['catatan']=$catatan;
				$option=" WHERE A.identifikasi_berkas='catatan' AND A.id_penelitian='".$catatan->id_penelitian."'  AND A.identifikasi_id='".$catatan->id_catatan."' ";
				$data['berkas']=$this->berkas_model->show_data_berkas($option)->result();
				$data['jumlah_berkas']=$this->berkas_model->show_data_berkas($option)->num_rows();
				$data['id_catatan']=$in['id_catatan'];
				$this->load->view('berkas/berkas_show_catatan',$data);
			}else{
				echo '<div class="alert alert-danger">Maaf data tidak ditemukan...</div>';
			}
		}

		/* Fungsi untuk download File */
		function unduh($id=""){
			if($id!=""){
				/* cek id_berkas */
				$b=$this->berkas_model->get_by_id_berkas($id);
				if($b->num_rows()>0){
					$berkas=$b->row();
					return forcedownload($berkas->file_url);
				}else{
					echo "Maaf, berkas tidak ditemukan....!!";
				}
			}
		}
}
