<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nilairev extends CI_Controller {

	   public function __construct()
	   {
			parent::__construct();
			$this->load->helper(array('url','format_tanggal'));
			$this->load->model(array('nilairev_model','penelitian/penelitian_model'));
	   }

	function index($s=0){
		// return $this->show($s);
		redirect('penelitian/nilairev/');
	}

	function show($s=0){
		redirect('penelitian/nilairev/');
		 // $data['title']="Daftar Nilairev";
		 // $data['s']=$s;
		 // $data['op_search']=array();
		 // $this->template->mainview('nilairev/nilairev_index',$data);
	}

	function input($id=""){
		if($id!=""){
			$p=$this->penelitian_model->get_by_id_penelitian($id);
			if($p->num_rows()>0){
				$data['penelitian']=$p->row();
				$nilai=$this->nilairev_model->get_nilairev($id,$this->session->userdata('id_user'));
				if($nilai->num_rows()>0){
					$data['format']=$nilai->row();
				}
				$data['title']="Input Nilai Hasil Review";
				$this->template->a4_layout('nilairev/format_nilai',$data);
			}
		}else{
			redirect('penelitian/nilairev/');
		}
	}

	function hasil_review($id="",$user=""){
		if($id!=""){
			$p=$this->penelitian_model->get_by_id_penelitian($id);
			if($p->num_rows()>0){
				$data['penelitian']=$p->row();
				if($user=="" && $this->session->userdata('akses')=="REVIEWER"){
					$id_user=$this->session->userdata('id_user');
				}else{
					$id_user=$user;
				}
				$nilai=$this->nilairev_model->get_nilairev($id,$id_user);
				if($nilai->num_rows()>0){
					$data['format']=$nilai->row();
				}
				$data['title']="Hasil Nilai Review";
				$this->template->a4_layout('nilairev/format_nilai_hasil',$data);
			}
		}else{
			redirect('penelitian/hasilnilairev/');
		}
	}

	function savecetak(){
		$in=$this->input->post(null,true);
		$conten=array(
			'hari' => $in['hari'],
			'tgl' => $in['tgl'],
			'bln' => $in['bulan'],
			'thn' => $in['tahun'],
			'nilai1' => $in['nilai1'],
			'nilai2' => $in['nilai2'],
			'nilai3' => $in['nilai3'],
			'nilai4' => $in['nilai4'],
			'nilai5' => $in['nilai5'],
			'total_nilai' =>$in['total_nilai'],
			'status_layak' => $in['status_layak'],
			'tgl_pengesahan' => ($in['tgl_pengesahan']==NULL || $in['tgl_pengesahan']==""?tgl_indo(date('Y-m-d')):$in['tgl_pengesahan']),
			'nik_nip' => $in['nik_nip'],
			'nama_reviewer'=>$in['nama_reviewer'],
			'id_reviewer'=>$in['id_reviewer'],
			'saran_reviewer' => $in['saran']
		);
		$contentjson=json_encode($conten);

		/* cek data sebelum simpan */
		$cek=$this->nilairev_model->get_nilairev($in['id_penelitian'],$this->session->userdata('id_user'));
		if($cek->num_rows()>0){
			/* UPDATE */
			$datain=array(
				'id_penelitian'=>$in['id_penelitian'],
				'jenis_cetak'  =>"nilai",
				'updated' => date('Y-m-d H:i:s'),
				'id_user' => $this->session->userdata('id_user'),
				'content' => $contentjson
			);
			$up=$this->nilairev_model->update_nilairev($datain,$in['id_ctk']);
		}else{
			/* INSERT */
			$datain=array(
				'id_penelitian'=>$in['id_penelitian'],
				'jenis_cetak'  =>"nilai",
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s'),
				'id_user' => $this->session->userdata('id_user'),
				'content' => $contentjson
			);
			$up=$this->nilairev_model->input_nilairev($datain);
		}
		if($up){
			echo '<script>alert("Nilai berhasil disimpan....");window.location="'.site_url('nilairev/input/'.$in['id_penelitian']).'"</script>';
			//redirect('nilairev/input/'.$in['id_penelitian']);
		}
	}

	function cetakpdf($id="",$user=""){
		if($id!=""){
			$p=$this->penelitian_model->get_by_id_penelitian($id);
			if($p->num_rows()>0){
				$data['penelitian']=$p->row();
				if($user=="" && $this->session->userdata('akses')=="REVIEWER"){
					$id_user=$this->session->userdata('id_user');
				}else{
					$id_user=$user;
				}
				$nilai=$this->nilairev_model->get_nilairev($id,$id_user);
				if($nilai->num_rows()>0){
					$data['format']=$nilai->row();
				}
				$data['title']="Cetak Nilai Hasil Review";
				/*buat folder berdasarkan id_event jika belum ada*/
				$path_dir_file=FCPATH.'file_download/nilai_rev/';
				if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}

				$filename=$data['penelitian']->id_penelitian.'.pdf';
				$fullpath=$path_dir_file.'/'.$filename;

				ini_set('memory_limit','32M'); // boost the memory limit if it's low ;)
				$html = $this->load->view('nilairev/cetak_nilai', $data,true); // render the view into HTML
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->SetTitle($data['title']);
				$pdf->SetAuthor('Mahfud Efendi');
				$pdf->SetCreator('SIPPMas Apps');
				$pdf->SetSubject('Cetak Nilai Hasil Review');
				$pdf->use_kwt = true; //Keep With Table
				//$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure ;)
				// $pdf->AddPageByArray(array(
				// 	'orientation' => 'P',
				// 	'mgl' => '20',
				// 	'mgr' => '20',
				// 	'mgt' => '15',
				// 	'mgb' => '15',
				// 	'mgh' => '10',
				// 	'mgf' => '10',
				// ));
				$pdf->WriteHTML($html); // write the HTML into the PDF
				$pdf->Output($fullpath, "I"); // Inline view browser
				//$pdf->Output($filename, "D"); // Download File

			}
		}else{
			redirect('penelitian/nilairev/');
		}
	}


}
