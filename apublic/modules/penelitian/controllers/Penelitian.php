<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penelitian extends Member_Control {

	   public function __construct()
	   {
			parent::__construct();
			$this->load->helper(array('url','global_function','format_tanggal'));
			$this->load->model(array('penelitian_model','skema/skema_model','anggaran/anggaran_model','konfigurasi/konfigurasi_model','personil/personil_model','proposal/proposal_model','keahlian/keahlian_model'));
	   }

		function index(){
			active_link("usulan");
			redirect('penelitian/show/');
		}

		function show($s=NULL,$ju=""){
			active_link("usulan");
			$s=strtoupper($s);
			$starray=array('DISETUJUI','DITOLAK','REVISI','PENGAJUAN','PRT');
			if ( ! in_array( $s, $starray ) ){
				$s=NULL;
			}
			 $data['title']="Daftar Pengajuan ".ucfirst(strtolower($s));
			 $data['status']=$s;
			 $data['jenis_usulan']=$ju;
			 $data['anggaran']=$this->anggaran_model->show_data_anggaran(" ORDER BY A.tahun_anggaran DESC ")->result();
			 $this->template->mainview('penelitian/penelitian_index',$data);
		}

		function penelitian_show($st=NULL,$option=""){
			$in=$this->input->post(null,true);
			$row=10;$sort="";$filt="";
			if($st==NULL){$start=0;}else{$start=$st;};
			$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
			if($this->session->userdata('akses')=="PENELITI"){
				($option=="")?$option.=" WHERE ":$option.=" AND ";
				$option.=" A.id_ketua='".$this->session->userdata('id_user')."' ";
			}
			if($in['cari']!=NULL || $in['cari']!=""){
				($option=="")?$option.=" WHERE ":$option.=" AND ";
				$option.=" ( B.nama LIKE '%".$in['cari']."%'  OR A.judul_penelitian LIKE '%".$in['cari']."%'  OR D.nama_skema LIKE '%".$in['cari']."%' ) ";
			}
			if($in['anggaran']!=NULL || $in['anggaran']!=""){
				($option=="")?$option.=" WHERE ":$option.=" AND ";
				$option.=" A.id_anggaran='".$in['anggaran']."' ";
			}
			if(isset($in['status']) && $in['status']!=""){
				($option=="")?$option.=" WHERE ":$option.=" AND ";
				if($in['status']=="PRT"){
					//Pengajuan, Rrevisi, Tolak
					$option.=" (A.status_pengajuan='PENGAJUAN' OR  A.status_pengajuan='DITOLAK' OR  A.status_pengajuan='REVISI') ";
				}else{
					$option.=" A.status_pengajuan='".$in['status']."' ";
				}
			}

		/* PILIH DATA YANG AKAN DITAMPILKAN */
			if(isset($in['link']) && ($in['link']!="" || $in['link']!=NULL) ){
				switch ($in['link']) {
					case 'ploting':
						$total_rows=$this->penelitian_model->show_data_ploting($option)->num_rows();
						$penelitian=$this->penelitian_model->show_data_ploting($option,$start,$row)->result();
						break;

					case 'nilai':
						if($this->session->userdata('akses')=="REVIEWER"){
						    ($option=="")?$option.=" WHERE ":$option.=" AND ";
							$idrev=$this->session->userdata('id_user'); //sesuia session id_user aktif
							$option.=" (reviewer1='".$idrev."' OR reviewer2='".$idrev."')";
						}
						$total_rows=$this->penelitian_model->show_data_penelitian($option)->num_rows();
						$penelitian=$this->penelitian_model->show_data_penelitian($option,$start,$row)->result();
						break;

					case 'hasil_nilai':
						$total_rows=$this->penelitian_model->show_data_ploting($option)->num_rows();
						$penelitian=$this->penelitian_model->show_data_ploting($option,$start,$row)->result();
						break;

					case 'hasil':
						if($this->session->userdata('akses')=="REVIEWER"){
							($option=="")?$option.=" WHERE ":$option.=" AND ";
							$idrev=$this->session->userdata('id_user'); //sesuia session id_user aktif
							$option.=" (reviewer1='".$idrev."' OR reviewer2='".$idrev."')";
						}
						$total_rows=$this->penelitian_model->show_data_penelitian($option)->num_rows();
						$penelitian=$this->penelitian_model->show_data_penelitian($option,$start,$row)->result();
						break;

					default:
						$total_rows=$this->penelitian_model->show_data_penelitian($option)->num_rows();
						$penelitian=$this->penelitian_model->show_data_penelitian($option,$start,$row)->result();
						break;
				}
			}else{
				$total_rows=$this->penelitian_model->show_data_penelitian($option)->num_rows();
				$penelitian=$this->penelitian_model->show_data_penelitian($option,$start,$row)->result();
			}
		// echo $option;
		 ///pengaturan pagination
		 //inisialisasi config
			 $this->load->library('pagination');
			 $config['base_url'] = site_url('penelitian/penelitian_show');
			 $config['first_url'] = site_url('penelitian/penelitian_show/0');
			 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
			 $config['per_page'] = $row;
			 $config['total_rows'] = $total_rows;
			 $this->pagination->initialize($config);
			 $data['links'] = $this->pagination->create_links();
			 $data['start']=$start;
			 $data['end']=$start+$row;
			 $data['total_rows']=$total_rows;
			 $data['penelitian']=$penelitian;
			$showlink="";
			if(isset($in['link']) && ($in['link']!="" || $in['link']!=NULL) ){
				$showlink=$this->select_link($in['link']);
			}else{
				$showlink="penelitian/penelitian_show";
			}
			$this->load->view($showlink,$data);
		}

	/* SELECT LINK DATA */
	function select_link($l=""){
		$links="";
		if($l!=""){
			switch ($l) {
				case 'disetujui':
					$links="penelitian/penelitian_show_disetujui";
					break;
				case 'catatan':
					$links="penelitian/penelitian_show_catatan";
					break;
				case 'kemajuan':
					$links="penelitian/penelitian_show_kemajuan";
					break;
				case 'akhir':
					$links="penelitian/penelitian_show_akhir";
					break;
				case 'ploting':
					$links="penelitian/penelitian_show_ploting";
					break;
				case 'tgjb':
					$links="penelitian/penelitian_show_tanggung_jwb_blj";
					break;
				case 'hasil':
					$links="penelitian/penelitian_show_hasil";
					break;
				case 'nilai':
					$links="penelitian/penelitian_show_nilai";
					break;
				case 'hasil_nilai':
					$links="penelitian/penelitian_show_nilai_hasil";
					break;
				default:
					$links="penelitian/penelitian_show";
					break;
			}
		}
		return $links;
	}

/* PLOTTING REVIWER */
		function ploting(){
			active_link("reviewer");
			$data['title']="Plotting Reviewer";
			$data['anggaran']=$this->anggaran_model->show_data_anggaran(" ORDER BY A.tahun_anggaran DESC ")->result();
			$this->template->mainview('penelitian/penelitian_index_ploting',$data);
		}
/* INPUT NILAI REVIWER */
		function nilairev(){
			active_link("reviewer");
			$data['title']="Input Nilai Review";
			$data['anggaran']=$this->anggaran_model->show_data_anggaran(" ORDER BY A.tahun_anggaran DESC ")->result();
			$this->template->mainview('penelitian/penelitian_index_nilai',$data);
		}
/* Hasil NILAI REVIWER */
		function hasilnilairev(){
			active_link("reviewer");
			$data['title']="Hasil Nilai Review";
			$data['anggaran']=$this->anggaran_model->show_data_anggaran(" ORDER BY A.tahun_anggaran DESC ")->result();
			$this->template->mainview('penelitian/penelitian_index_nilai_hasil',$data);
		}

			function penelitian_search($op=NULL){
				$in=$this->input->post(null,true);
				$option="";
				if(!$in){
					$data['status']=$op;
					$data['id_ketua']=$this->penelitian_model->lookup_tbl_peneliti()->result();
					$data['id_anggaran']=$this->penelitian_model->lookup_tbl_thn_anggaran()->result();
					$this->load->view('penelitian/penelitian_search',$data);
				}else{
					if($in['status_pengajuan']!=""){
						($option=="")? $option.=" WHERE " : $option.=" AND " ;
						if($in['status_pengajuan']=="DISETUJUI"){
							$option.=" A.status_pengajuan = 'DISETUJUI' ";
						}else{
							$option.=" A.status_pengajuan != 'DISETUJUI' ";
						}
					}
					if($in['pnl_pengusul']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" B.nama LIKE '%".$in['pnl_pengusul']."%' ";
					}
					if($in['pnl_tahun_anggaran']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" C.tahun_anggaran LIKE '%".$in['pnl_tahun_anggaran']."%' ";
					}
					if($in['pnl_jenis_usulan']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.jenis_usulan = '".$in['pnl_jenis_usulan']."' ";
					}
					if($in['pnl_skema_penelitian']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.id_skema = '".$in['pnl_skema_penelitian']."' ";
					}
				$numRows=$this->penelitian_model->show_data_penelitian($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['penelitian']=$this->penelitian_model->show_data_penelitian($option)->result();
				$this->load->view('penelitian/penelitian_show',$data);
				}
			}

			function penelitian_add(){
				active_link("usulan");
				$in=$this->input->post(null,true);
				if(!$in){
					/* cek sebelum Tambah, apakah ada konfigurasi tervbuka atau anggaran yg sedang dibuka */
					$kon=$this->konfigurasi_model->get_by_id_konfigurasi('11')->row();
					if($this->cek_tanggal($kon->tgl_mulai,$kon->tgl_akhir)==true){
						/* cek apakah author sedang kondisi non aktif atau tidak */
						$sn_sql="SELECT * FROM pr_penelitian_status_nonaktif WHERE id_peneliti='".$this->session->userdata('id_user')."' AND aktif_kembali='N' ";
						$sn=$this->db->query($sn_sql);
						if($sn->num_rows() > 0){
							$status_nonaktif=$sn->row();
							redirect ('status_aktif/info_status/nonaktif/'.$this->session->userdata('id_user'));
						}else{
							$data['title']="Tambah Usulan Judul Hibah Internal";
							$data['id_ketua']=$this->penelitian_model->lookup_tbl_peneliti()->result();
							$a=$this->anggaran_model->show_data_anggaran(" WHERE A.status='OPEN' ");
							if($a->num_rows()>0){
								$data['id_anggaran']=$a->result();
							}
							$data['keahlian']=$this->keahlian_model->show_data_keahlian()->result();
							//$data['id_skema']=$this->skema_model->show_data_skema(" WHERE A.jenis_skema='PENELITIAN' ")->result();
							$this->template->mainview('penelitian/penelitian_form',$data);
						}
					}else{
						$data['notif']='<h3 class="text-danger">Maaf, Anda masih belum bisa melakukan Pengajuan Proposal Penelitian dikarenakan :</h3>
						<ol>
						<li>Fitur ini belum dibuka oleh admin</li>
						<li>Batas waktu penggunaan fitur ini telah lewat</li>
						</ol>';
						$data['info']="PENELITIAN";
						$this->template->mainview('penelitian/penelitian_info',$data);
					}
				}else{
					$data_in=array(
					'id_penelitian' => random_id(),
					'id_ketua' => $_POST['pnl_pengusul'],
					'id_anggaran' => $_POST['pnl_tahun_anggaran'],
					'judul_penelitian' => $_POST['pnl_judul_penelitian'],
					'abstraksi' => $_POST['pnl_abstraksi'],
					'katakunci' => $_POST['pnl_kata_kunci'],
					'id_skema' => $_POST['pnl_skema_penelitian'],
					'bidang_fokus' => $_POST['pnl_bidang_fokus'],
					'rumpun_ilmu' => $_POST['pnl_rumpun_ilmu'],
					'bidang_ilmu' =>$_POST['pnl_bidang_ilmu'],
					'status_pengajuan' => $_POST['pnl_status_pengajuan'],
					'dana_usulan'=>$_POST['pnl_dana_usulan'],
					'userid'=>$this->session->userdata('id_user'),
					'jenis_usulan'=>$_POST['pnl_jenis_usulan'],
					);
					$input_data=$this->penelitian_model->input_penelitian($data_in);
					if($input_data){
						redirect("penelitian/info/VALID");
					}else{
						redirect("penelitian/info/INVALID");
					}
				}
			}

			function penelitian_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="Update Data Usulan ";
					$data['id_ketua']=$this->penelitian_model->lookup_tbl_peneliti()->result();
					$a=$this->anggaran_model->show_data_anggaran(" WHERE A.status='OPEN' ");
					if($a->num_rows()>0){
						$data['id_anggaran']=$a->result();
					}
					$data['keahlian']=$this->keahlian_model->show_data_keahlian()->result();
					$data['penelitian']=$this->penelitian_model->get_by_id_penelitian($id)->row();
					$data['id_skema']=$this->skema_model->show_data_skema(" WHERE A.jenis_skema='PENELITIAN' ")->result();
					$this->template->mainview('penelitian/penelitian_form',$data);
				}else{
					$data_in=array(
					'id_ketua' => $_POST['pnl_pengusul'],
					'id_anggaran' => $_POST['pnl_tahun_anggaran'],
					'judul_penelitian' => $_POST['pnl_judul_penelitian'],
					'abstraksi' => $_POST['pnl_abstraksi'],
					'katakunci' => $_POST['pnl_kata_kunci'],
					'id_skema' => $_POST['pnl_skema_penelitian'],
					'bidang_fokus' => $_POST['pnl_bidang_fokus'],
					'rumpun_ilmu' => $_POST['pnl_rumpun_ilmu'],
					'bidang_ilmu' =>$_POST['pnl_bidang_ilmu'],
					'status_pengajuan' => $_POST['pnl_status_pengajuan'],
					'dana_usulan'=>$_POST['pnl_dana_usulan'],
					'userid'=>$this->session->userdata('id_user'),
					'jenis_usulan'=>$_POST['pnl_jenis_usulan']
					);
					$update_data=$this->penelitian_model->update_penelitian($data_in,$in['pnl_id_penelitian']);
					if($update_data){
						redirect("penelitian/info/VALID");
					}else{
						redirect("penelitian/info/INVALID");
					}
				}
			}

			function penelitian_plot_reviewer($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="Plotting Reviewer Penelitian";
					$data['penelitian']=$this->penelitian_model->get_by_id_penelitian($id)->row();
					$data['reviewer']=$this->db->query("SELECT id_user,nama,nidn FROM tbl_reviewer")->result();
					$this->template->mainview('penelitian/penelitian_form_ploting',$data);
				}else{
					$data_in=array(
					'reviewer1'=>$in['reviewer1'],
					'reviewer2'=>$in['reviewer2']
					);
					$update_data=$this->penelitian_model->update_penelitian($data_in,$in['pnl_id_penelitian']);
					if($update_data){
						redirect("penelitian/info/VALID/ploting");
					}else{
						redirect("penelitian/info/INVALID/ploting");
					}
				}
			}

			function detail($id=null){
				if($id!=null || $id!=""){
					$data['title']="Detail Usulan Penelitian";
					$data['personil']=$this->personil_model->show_data_personil(" WHERE A.id_penelitian='".$id."' ")->result();
					$data['proposal']=$this->proposal_model->show_data_proposal(" WHERE A.id_penelitian='".$id."' ")->result();
					$data['penelitian']=$this->penelitian_model->get_by_id_penelitian($id)->row();
					$this->template->mainview('penelitian/penelitian_detail',$data);
				}else{
					redirect('penelitian');
				}
			}

			function cek_tanggal($t1,$t2){
				$d1=strtotime($t1);
				$d2=strtotime($t2);
				$now=strtotime("now");
				if($now > $d1 && $now < $d2){
					return true;
				}else{
					return false;
				}
			}

			function info($o="",$p=""){
				if($o!=""){
					if($o=="VALID"){
						$data['notif']='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><h2><i class="fa fa-info-circle"></i> Data berhasil disimpan...</h2>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<br/><a class="btn btn-success btn-sm" href="'.site_url('penelitian/'.$p).'" title="Kembali ke Daftar Penelitian"><i class="fa fa-chevron-left"></i> Kembali daftar judul penelitian</a>
						</div>';
					}else
					if($o=="INVALID"){
						$data['notif']='<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><h2><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal disimpan...</h2>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<br/><a class="btn btn-success  btn-sm" href="'.site_url('penelitian/'.$p).'" title="Kembali ke Daftar Penelitian"><i class="fa fa-chevron-left"></i> Kembali daftar judul penelitian</a>
						</div>';
					}
					$this->template->mainview('penelitian/info',$data);
				}
			}

			function penelitian_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->penelitian_model->delete_penelitian($id);
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

			function penelitian_actionAll($action=""){
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
					$hapus=$this->penelitian_model->delete_penelitian($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di HAPUS...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

/* CATATAN HARIAN SELECT */
		function catatan(){
			active_link("pelaksanaan");
			$data['title']="Catatan Harian";
			$data['anggaran']=$this->anggaran_model->show_data_anggaran(" ORDER BY A.tahun_anggaran DESC ")->result();
			$this->template->mainview('penelitian/penelitian_index_catatan',$data);
		}
/* LAporan Kemajuan SELECT */
		function kemajuan(){
			active_link("pelaksanaan");
			$data['title']="Unggah Laporan Kemajuan";
			$data['anggaran']=$this->anggaran_model->show_data_anggaran(" ORDER BY A.tahun_anggaran DESC ")->result();
			$this->template->mainview('penelitian/penelitian_index_kemajuan',$data);
		}
/* download Laporan Kemajuan */
		function unduh_kemajuan($id_penelitian){
			$sql="SELECT * FROM pr_penelitian_berkas WHERE id_penelitian='".$id_penelitian."' AND identifikasi_berkas='kemajuan' LIMIT 1 ";
			$p=$this->db->query($sql)->row();
			redirect("berkas/unduh/".$p->id_berkas);
		}
/* Laporan AKhir SELECT */
		function akhir(){
			active_link("pelaksanaan");
			$data['title']="Unggah Laporan Akhir";
			$data['anggaran']=$this->anggaran_model->show_data_anggaran(" ORDER BY A.tahun_anggaran DESC ")->result();
			$this->template->mainview('penelitian/penelitian_index_akhir',$data);
		}
/* download Laporan Akhir */
		function unduh_akhir($id_penelitian){
			$sql="SELECT * FROM pr_penelitian_berkas WHERE id_penelitian='".$id_penelitian."' AND identifikasi_berkas='akhir' LIMIT 1 ";
			$p=$this->db->query($sql)->row();
			redirect("berkas/unduh/".$p->id_berkas);
		}

/* Laporan Pertanggung Jawaban Belanja */
		function tanggung_jawab_belanja(){
			active_link("pelaksanaan");
			$data['title']="Unggah Tanggung Jawab Belanja";
			$data['anggaran']=$this->anggaran_model->show_data_anggaran(" ORDER BY A.tahun_anggaran DESC ")->result();
			$this->template->mainview('penelitian/penelitian_index_tanggung_jwb_blj',$data);
		}


/* download Laporan Akhir */
		function unduh_tgjb($id_penelitian){
			$sql="SELECT * FROM pr_penelitian_berkas WHERE id_penelitian='".$id_penelitian."' AND identifikasi_berkas='tgjb' LIMIT 1 ";
			$p=$this->db->query($sql)->row();
			redirect("berkas/unduh/".$p->id_berkas);
		}

/* Berkas Seminar Hasil */
		function seminar_hasil(){
			active_link("pelaksanaan");
			$data['title']="Unggah Dokumen Seminar Hasil";
			$data['anggaran']=$this->anggaran_model->show_data_anggaran()->result();
			$this->template->mainview('penelitian/penelitian_index_hasil',$data);
		}
/* download Laporan Akhir */
		function unduh_hasil($id_penelitian,$berkas=""){
			$b=array('artikel','borang','profil','poster');
			if($berkas!="" && in_array($berkas,$b)){
				$sql="SELECT * FROM pr_penelitian_berkas WHERE id_penelitian='".$id_penelitian."' AND identifikasi_berkas='".$berkas."' LIMIT 1 ";
				$p=$this->db->query($sql)->row();
				redirect("berkas/unduh/".$p->id_berkas);
			}
		}

/* Isi Capaian INDEX */
		function capaian($id=""){
			if($id!=""){
				$data['title']="Formulir Evaluasi Atas Capaian Luaran Kegiatan";
				/* cek penelitian */
				$p=$this->penelitian_model->cek_data('id_penelitian',$id);
				if($p->num_rows()>0){
					$data['penelitian']=$p->row();
					$this->template->mainview('penelitian/capaian_index',$data);
				}else{
					redirect('penelitian/seminar_hasil/');
				}
			}
		}
/* cetak HTML to PDF menggunakan mPDF Libarary*/
		function cetak_capaian($id=""){
			if($id!=""){
				$data['title']="Cetak Formulir Evaluasi Atas Capaian Luaran Kegiatan";
				/*buat folder berdasarkan id_event jika belum ada*/
				$path_dir_file=FCPATH.'file_download/capaian_kegiatan/';
				if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}

				/* cek penelitian */
				$p=$this->penelitian_model->get_by_id_penelitian($id);
				if($p->num_rows()>0){
					$data['penelitian']=$p->row();
					$filename=$id.'.pdf';
					$fullpath=$path_dir_file.'/'.$filename;
					/* ambil data capaian jurnal */
					$sqljurnal="SELECT * FROM pr_penelitian_capaian_jurnal WHERE id_penelitian='".$id."' ORDER BY id_jurnal ASC ";
					$data['jurnal']=$this->db->query($sqljurnal)->result();
					/* ambil data capaian buku */
					$sqlbuku="SELECT * FROM pr_penelitian_capaian_buku WHERE id_penelitian='".$id."' ORDER BY id_buku ASC";
					$data['buku']=$this->db->query($sqlbuku)->result();
					/* ambil data capaian semnar */
					$sqlseminar="SELECT * FROM pr_penelitian_capaian_seminar WHERE id_penelitian='".$id."' ORDER BY id_seminar ASC";
					$data['seminar']=$this->db->query($sqlseminar)->result();
					/* ambil data capaian lain */
					$sqllain="SELECT * FROM pr_penelitian_capaian_lain WHERE id_penelitian='".$id."' ORDER BY id_lain ASC";
					$data['lain']=$this->db->query($sqllain)->result();
					/* ambil rekap jumlah capaian yg di input melalui mysql view_jumlah_capaian */
					$jsql="SELECT * FROM view_jumlah_capaian WHERE id_penelitian='".$id."' LIMIT 1";
					$data['jumlah']=$this->db->query($jsql)->row();
					//if (file_exists($fullpath) == FALSE){
						ini_set('memory_limit','32M'); // boost the memory limit if it's low ;)
						$html = $this->load->view('penelitian/capaian_cetak_pdf', $data,true); // render the view into HTML
						$this->load->library('pdf');
						$pdf = $this->pdf->load();
						$pdf->SetTitle($data['title']);
						$pdf->SetAuthor('Mahfud Efendi');
						$pdf->SetCreator('SIPPMas Apps');
						$pdf->SetSubject('Formulir Capaian penelitian');
						$pdf->use_kwt = true; //Keep With Table
						//$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure ;)
						$pdf->AddPageByArray(array(
						    'orientation' => 'P',
						    'mgl' => '20',
						    'mgr' => '20',
						    'mgt' => '15',
						    'mgb' => '15',
						    'mgh' => '10',
						    'mgf' => '10',
						));
						$pdf->WriteHTML($html); // write the HTML into the PDF
						//$pdf->Output($fullpath, "I"); // Inline view browser
						$pdf->Output($filename, "D"); // Download File
					//}
				}
			}
		}

	/******** RIWAYAT KETUA *****/
	function riwayat_ketua(){
		active_link("riwayat");
		if($this->session->userdata('id_user')){
			$id=$this->session->userdata('id_user');
			$p=$this->penelitian_model->riawayat_ketua($id);
			$data['title']="Riwayat Menjadi Ketua";
			$data['status_riwayat']="Ketua";
			if($p->num_rows()>0){
				$data['penelitian']=$p->result();
				$data['total_rows']=$p->num_rows();
			}else{
				$data['total_rows']="0";
			}
			$this->template->mainview('penelitian/penelitian_riwayat',$data);
		}
	}

	/******** RIWAYAT KETUA *****/
	function riwayat_anggota(){
		active_link("riwayat");
		if($this->session->userdata('id_user')){
			$id=$this->session->userdata('id_user');
			$p=$this->penelitian_model->riawayat_anggota($id);
			$data['title']="Riwayat Menjadi Anggota";
			$data['status_riwayat']="Ketua";
			if($p->num_rows()>0){
				$data['penelitian']=$p->result();
				$data['total_rows']=$p->num_rows();
			}else{
				$data['total_rows']="0";
			}
			$this->template->mainview('penelitian/penelitian_riwayat',$data);
		}
	}

	/*********** UPLOAD SK PERSETUJUAN ********/
	function upload_sk($id="",$param="PRT"){
		$this->load->helper('file');
		if($id!=""){
			$data['title']="SK Persetujuan Hibah Internal";
			$data['param']=$param;
			$data['penelitian']=$this->penelitian_model->get_by_id_penelitian($id)->row();
			$this->template->mainview("penelitian/upload_sk",$data);
		}else{
			echo '<h2>Maaf, parameter kurang...</h2>';
		}
	}

	function save_upload_sk(){
		$in=$this->input->post(null,true);
		if($in){
			$path_dir_file='file_uploaded/laporan/'.$in['pnl_id_penelitian'].'/sk/';
			if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}
			//upload gambar
			$fn=$_FILES["userfile"]["name"];
			$config['upload_path'] = $path_dir_file;
			$config['file_name'] =date('ymdhis')."_".$fn;
			$config['allowed_types'] = 'pdf|jpg|jpeg|png';
			$config['max_size'] = '2100';
			$config['remove_spaces']=TRUE;

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload())
			{
				$notif='<div class="h3 alert alert-danger" onclick="$(this).fadeOut(300);"><i class="fa fa-warning"></i> <strong>File PDF Gagal di Upload!!</strong><br/>*) Pastikan anda telah memilih File...!<br/>*) Kapasitas File PDF maksimal adalah 2000Kb (2Mb)...!</div>';
					echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
			}else{
				$data=$this->upload->data();
				$url= $config['upload_path'].$data['file_name'];
				$data_in=array(
					'dana_disetujui' => $in['pnl_dana_disetujui'],
					'status_pengajuan' => $in['status_update'],
					'sk_persetujuan' => $url,
				);
				$update_data=$this->penelitian_model->update_penelitian($data_in,$in['pnl_id_penelitian']);
				if($update_data){
					$notif='<div class="h3 alert alert-success alert-dismissable" ><i class="fa fa-info-circle"></i> Data berhasil disimpan...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
					echo json_encode(array('msg'=>$notif,'status'=>'OK'));
				}else{
					$notif='<div class="h3 alert alert-danger alert-dismissable" ><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Data gagal disimpan...
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
					echo json_encode(array('msg'=>$notif,'status'=>'ERROR'));
				}
			}/* cek Upload */
		}
	}

	function unduh_file_sk($id=""){
		if($id!=""){
			$data=$this->penelitian_model->get_by_id_penelitian($id)->row();
			if(file_exists($data->sk_persetujuan)){
				forcedownload($data->sk_persetujuan);
			}
		}
	}

}
