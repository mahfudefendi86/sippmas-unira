<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
	  {
	   parent::__construct();
	   $this->load->helper(array('url','format_tanggal'));
	   $this->load->model(array('main_model','berita/berita_model','kategori/kategori_model','peneliti/peneliti_model','reviewer/reviewer_model','slideshow/slideshow_model'));
	  }

	public function index()
	{
		$data['title']="SIPPMas (Sistem Informasi Penelitian Dan Pengabdian Masyarakat)";
		$ops=" WHERE A.status='Publish' ";
		$data['slideshow']=$this->slideshow_model->show_data_slideshow($ops)->result();
		$this->template->index('main/content_index',$data);

	}

	function dashboard(){
		if($this->session->userdata('id_user')){
			$data['title']="Dashboard";
			$u=NULL;
			if($this->session->userdata('akses')=="PENELITI"){
				$u=$this->peneliti_model->get_by_id_peneliti($this->session->userdata('id_user'))->row();
			}else if($this->session->userdata('akses')=="REVIEWER"){
				$u=$this->reviewer_model->get_by_id_reviewer($this->session->userdata('id_user'))->row();
			}
			$sql_berita="SELECT count(*) as jumlah FROM pub_berita ";
			$data['num_berita']=$this->db->query($sql_berita)->row();

			$sql_penelitian="SELECT count(*) as jumlah FROM pr_penelitian ";
			$data['num_usulan']=$this->db->query($sql_penelitian)->row();

			$sql_aut="SELECT count(*) as jumlah FROM tbl_peneliti ";
			$data['num_peneliti']=$this->db->query($sql_aut)->row();

			$sql_aut="SELECT count(*) as jumlah FROM pub_berita_kategori ";
			$data['num_kategori']=$this->db->query($sql_aut)->row();

			$data['user']=$u;
			$this->template->mainview('main/content',$data);
		}else{
			redirect("main/index/");
		}
	}

	public function berita($st=NULL,$option=""){
			 $in=$this->input->post(null,true);
			 if(!$in){ redirect('main');};
			 $row=5;$sort="";$filt="";
			 $option.=" WHERE A.status='PUBLISH' ";
			 if($st==NULL){$start=0;}else{$start=$st;};
			 if($in['cari']!=NULL || $in['cari']!=""){
				 ($option=="")?$option.=" WHERE ": $option.=" AND ";
				  $option.=" (  A.judul LIKE '%".$in['cari']."%' ) ";
			 }
			 $option.=$filt;
			 $option.=" ORDER BY A.tanggal,A.jam DESC ";
			 ///pengaturan pagination
			  $this->load->library('pagination');
			  $config['base_url'] = site_url('main/berita');
			  $config['first_url'] = site_url('main/berita/0');
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
			  $this->load->view('main/content_berita',$data);
		}

		public function link($id="")
		{
			$data[]=NULL;
			if($id!=""){
				/*ambil data link*/
				$sql="SELECT * FROM pub_berita_kategori WHERE id_kategori='".$id."' ";
				$d=$this->db->query($sql);
				if($d->num_rows()>0){
					$data_link=$d->row();
					$data['title']=$data_link->kategori;
				}
			}else{
				$data['title']="Berita";
			}
			$data['link']=$id;
			$this->template->display('main/content_link',$data);
		}

		public function link_show($st=NULL,$option=""){
				 $in=$this->input->post(null,true);
				 if(!$in){ redirect('main');};
				 $row=5;$sort="";$filt="";
				 $option.=" WHERE A.status='PUBLISH' ";
				 if($st==NULL){$start=0;}else{$start=$st;};
				 if($in['link']!=NULL || $in['link']!=""){
					 ($option=="")?$option.=" WHERE ": $option.=" AND ";
					  $option.=" A.id_kategori='".$in['link']."' ";
				 }
				 if($in['cari']!=NULL || $in['cari']!=""){
					 ($option=="")?$option.=" WHERE ": $option.=" AND ";
					  $option.=" (  A.judul LIKE '%".$in['cari']."%' ) ";
				 }
				 $option.=$filt;
				 $option.=" ORDER BY A.tanggal,A.jam DESC ";
				 ///pengaturan pagination
				  $this->load->library('pagination');
				  $config['base_url'] = site_url('main/link_show');
				  $config['first_url'] = site_url('main/link_show/0');
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
				  $this->load->view('main/content_berita',$data);
			}
	/**
	 *  Detail berita
	 *
	 */

	public function detail($id="",$judul=""){
		$data[]=NULL;
		if($id!=""){
			$b=$this->berita_model->get_by_id_berita($id);
			if($b->num_rows()>0){
				$data['berita']=$b->row();
				$data['title']=$data['berita']->judul;
				$this->template->display('main/detail_berita',$data);
			}else{
				redirect('main/info/invalid');
			}
		}else{
			redirect('main/info/invalid');
		}
	}

	function info($o=""){
		$data[]=NULL;
		$data['title']="Informasi";
		if($o!=""){
			if($o=="valid"){
				$data['notif']='<div class="alert alert-success " ><h2><i class="fa fa-info-circle"></i> Berita berhasil disimpan...</h2>
				<br/><a class="btn btn-success btn-sm" href="'.site_url('main').'" title="Kembali ke Daftar Penelitian"><i class="fa fa-chevron-left"></i> Kembali ke Daftar Berita</a>
				</div>';
			}else
			if($o=="invalid"){
				$data['notif']='<div class="alert alert-danger" ><h2><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Berita tidak ditemukan...</h2>
				<br/><a class="btn btn-success  btn-sm" href="'.site_url('main').'" title="Kembali ke Beranda"><i class="fa fa-chevron-left"></i> Kembali ke Beranda</a>
				</div>';
			}
			$this->template->display('main/info',$data);
		}
	}

/*******************************************************
 *            PENDAFTARAN PESERTA KKN
 ******************************************************/
	function  registrasi_kkn(){
		$data['title']="Registrasi Peserta Kuliah Kerja Nyata (KKN)";
		$this->template->display('main/kkn_reg',$data);
	}


}
