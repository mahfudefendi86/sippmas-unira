<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Berita extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper(array('url','format_tanggal','global_function'));
					$this->load->model(array('berita_model'));
					active_link("berita");
			   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				 $data['title']="Daftar Berita";
				 $data['s']=$s;
				 $data['op_search']=array("A.id_kategori"=>"Kategori Berita", "A.tanggal"=>"Tanggal", "A.judul"=>"Judul", "A.status"=>"Status");
				 $this->template->mainview('berita/berita_index',$data);
			}
			function berita_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( A.id_kategori LIKE '%".$in['cari']."%'  OR A.tanggal LIKE '%".$in['cari']."%'  OR A.judul LIKE '%".$in['cari']."%'  OR A.status LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				 $option.=" ORDER BY A.tanggal,A.jam DESC ";
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('berita/berita_show');
				 $config['first_url'] = site_url('berita/berita_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->berita_model->show_data_berita($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['berita']=$this->berita_model->show_data_berita($option,$start,$config['per_page'])->result();
				$this->load->view('berita/berita_show',$data);
			}

			function berita_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$data['id_kategori']=$this->berita_model->lookup_pub_berita_kategori()->result();
					$this->load->view('berita/berita_search',$data);
				}else{

					if($in['brt_kategori_berita']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.id_kategori LIKE '%".$in['brt_kategori_berita']."%' ";
					}
					if($in['brt_tanggal']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.tanggal LIKE '%".$in['brt_tanggal']."%' ";
					}
					if($in['brt_judul']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.judul LIKE '%".$in['brt_judul']."%' ";
					}
					if($in['brt_status']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.status LIKE '%".$in['brt_status']."%' ";
					}
				$numRows=$this->berita_model->show_data_berita($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['berita']=$this->berita_model->show_data_berita($option)->result();
				$this->load->view('berita/berita_show',$data);
				}
			}

			function berita_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="Tambah Berita/Artikel";
					$data['id_kategori']=$this->berita_model->lookup_pub_berita_kategori()->result();
					$this->template->mainview('berita/berita_form',$data);
				}else{
					$data_in=array(
					'id_berita' => random_id(),
					'id_kategori' => $_POST['brt_kategori_berita'],
					'tanggal' => date('Y-m-d'),
					'jam' => date('H:i:s'),
					'judul' => $_POST['brt_judul'],
					'isi_berita' => $_POST['brt_isi_berita'],
					'status' => $_POST['brt_status'],
					'userid' => $this->session->userdata('id_user')
					);
					$input_data=$this->berita_model->input_berita($data_in);
					if($input_data){
						redirect('berita/info/valid');
					}else{
						redirect('berita/info/invalid');
					}
				}
			}


			function berita_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="Edit Berita";
						$data['id_kategori']=$this->berita_model->lookup_pub_berita_kategori()->result();
						$data['berita']=$this->berita_model->get_by_id_berita($id)->row();
						$this->template->mainview('berita/berita_form',$data);
				}else{
					$data_in=array(
					'id_kategori' => $_POST['brt_kategori_berita'],
					'tanggal' => date('Y-m-d'),
					'jam' => date('H:i:s'),
					'judul' => $_POST['brt_judul'],
					'isi_berita' => $_POST['brt_isi_berita'],
					'status' => $_POST['brt_status'],
					'userid' => $this->session->userdata('id_user')
					);
					$update_data=$this->berita_model->update_berita($data_in,$in['brt_id_berita']);
					if($update_data){
						redirect('berita/info/valid');
					}else{
						redirect('berita/info/invalid');
					}
				}
			}

			public function detail($id="",$judul=""){
				$data=array();
				if($id!=""){
					$b=$this->berita_model->get_by_id_berita($id);
					if($b->num_rows()>0){
						$data['berita']=$b->row();
						$this->template->mainview('berita/detail_berita',$data);
					}else{
						redirect('berita/info/invalid');
					}
				}else{
					redirect('berita/info/invalid');
				}
			}


			function info($o=""){
				$data=array();
				if($o!=""){
					if($o=="valid"){
						$data['notif']='<div class="alert alert-success " ><h2><i class="fa fa-info-circle"></i> Berita berhasil disimpan...</h2>
						<br/><a class="btn btn-success btn-sm" href="'.site_url('berita').'" title="Kembali ke Daftar Penelitian"><i class="fa fa-chevron-left"></i> Kembali ke Daftar Berita</a>
						</div>';
					}else
					if($o=="invalid"){
						$data['notif']='<div class="alert alert-danger" ><h2><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Berita gagal disimpan...</h2>
						<br/><a class="btn btn-success  btn-sm" href="'.site_url('berita').'" title="Kembali ke Daftar Penelitian"><i class="fa fa-chevron-left"></i> Kembali ke Daftar Berita</a>
						</div>';
					}
					$this->template->mainview('berita/info',$data);
				}
			}

			function berita_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->berita_model->delete_berita($id);
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

			function berita_actionAll($action=""){
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
					$hapus=$this->berita_model->delete_berita($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di HAPUS...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

		/* get link berita*/
		function getlink($s=0){
			$data['title']="Dapatkan Link Berita";
			$data['s']=$s;
			$data['op_search']=array("A.id_kategori"=>"Kategori Berita", "A.tanggal"=>"Tanggal", "A.judul"=>"Judul", "A.status"=>"Status");
			$this->template->clear('berita/getlink_index',$data);
		}

		function getlink_show($st=NULL,$option=""){
			$in=$this->input->post(null,true);
			$row=10;$sort="";$filt="";
			if($st==NULL){$start=0;}else{$start=$st;};
			$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
			if($in['cari']!=NULL || $in['cari']!=""){
				if($in['filter']!=NULL || $in['filter']!=""){
					$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
				}else{
					$option.=" WHERE ( A.id_kategori LIKE '%".$in['cari']."%'  OR A.tanggal LIKE '%".$in['cari']."%'  OR A.judul LIKE '%".$in['cari']."%'  OR A.status LIKE '%".$in['cari']."%' ) ";
				}
			}
			 $option.=$filt;
			 $option.=" ORDER BY A.tanggal,A.jam DESC ";
			///pengaturan pagination
			 $this->load->library('pagination');
			 $config['base_url'] = site_url('berita/getlink_show');
			 $config['first_url'] = site_url('berita/getlink_show/0');
			 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
			 $config['per_page'] = $row;
			 $config['total_rows'] = $this->berita_model->show_data_berita($option)->num_rows();
			 //inisialisasi config
			 $this->pagination->initialize($config);
			 $data['links'] = $this->pagination->create_links();
			 $data['start']=$start;
			 $data['end']=$start+$config['per_page'];
			 $data['total_rows']=$config['total_rows'];
			$data['berita']=$this->berita_model->show_data_berita($option,$start,$config['per_page'])->result();
			$this->load->view('berita/berita_show_link',$data);
		}
}
