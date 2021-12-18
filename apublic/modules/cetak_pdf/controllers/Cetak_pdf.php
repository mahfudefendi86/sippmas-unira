<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cetak_pdf extends Member_Control {

	   public function __construct()
	   {
			parent::__construct();
			$this->load->helper(array('url','global_function','format_tanggal'));
			$this->load->model(array('cetak_pdf_model','penelitian/penelitian_model','skema/skema_model','anggaran/anggaran_model','konfigurasi/konfigurasi_model','personil/personil_model','proposal/proposal_model','keahlian/keahlian_model'));
	   }

		function index(){
			return $this->show();
		}

		function format_tgjb($id=""){
			if($id!=""){
				$c=$this->penelitian_model->get_nama_peneliti($id);
				if($c->num_rows()>0){
					$data['penelitian']=$c->row();
					$f=$this->cetak_pdf_model->get_cetak($id,$this->session->userdata('id_user'),'tgjb');
					if($f->num_rows()>0){
						$data['conten']=$f->row();
					}
				}
				$data['title']="Cetak Format Tanggung Jawab Belanja";
				$this->template->a4_layout("cetak_pdf/penelitian_format_tgjb",$data);
			}else{
				redirect('penelitian/tanggung_jawab_belanja/');
			}
		}

		function save_tgjb(){
			$in=$this->input->post(null,true);
			/* cek penelitian */
			$c=$this->penelitian_model->get_nama_peneliti($in['id_penelitian']);
			if($c->num_rows()>0){
				$conten=array(
					"no_keputusan"=>$in['surat_keputusan'],
					"no_kontrak"=>$in['nomer_kontrak'],
					"nominal_dana"=>(($in['nominal_dana']==""||$in['nominal_dana']==NULL)?0:$in['nominal_dana']),
					"ket_honorarium"=>$in['ket_honorarium'],
					"nominal_honorarium"=>(($in['nominal_honorarium']==""||$in['nominal_honorarium']==NULL)?0:$in['nominal_honorarium']),
					"ket_peralatan_penunjang"=>$in['ket_peralatan_penunjang'],
					"nominal_peralatan_penunjang"=>(($in['nominal_peralatan_penunjang']==""||$in['nominal_peralatan_penunjang']==NULL)?0:$in['nominal_peralatan_penunjang']),
					"ket_bhp"=>$in['ket_bhp'],
					"nominal_bhp"=>(($in['nominal_bhp']==""||$in['nominal_bhp']==NULL)?0:$in['nominal_bhp']),
					"ket_perjalanan"=>$in['ket_perjalanan'],
					"nominal_perjalanan"=>(($in['nominal_perjalanan']==""||$in['nominal_perjalanan']==NULL)?0:$in['nominal_perjalanan']),
					"ket_lain_lain"=>$in['ket_lain_lain'],
					"nominal_lain_lain"=>(($in['nominal_lain_lain']==""||$in['nominal_lain_lain']==NULL)?0:$in['nominal_lain_lain']),
					"total_biaya"=>(($in['total_biaya']==""||$in['total_biaya']==NULL)?0:$in['total_biaya']),
					"tgl_pengesahan"=>$in['tgl_pengesahan'],
					"nik_nip"=>$in['nik_nip']
				);
				$tgjbjson=json_encode($conten);
				$cek=$this->cetak_pdf_model->get_cetak($in['id_penelitian'],$this->session->userdata('id_user'),'tgjb');
				if($cek->num_rows()>0){
					$format=$cek->row();
					/*update*/
					$datain=array(
						'id_penelitian'=>$in['id_penelitian'],
						'jenis_cetak'  =>"tgjb",
						'updated' => date('Y-m-d H:i:s'),
						'id_user' => $this->session->userdata('id_user'),
						'content' => $tgjbjson
					);
					$up=$this->cetak_pdf_model->update_cetak($datain,$in['id_ctk']);
				}else{
					/* INSERT */
					$datain=array(
						'id_penelitian'=>$in['id_penelitian'],
						'jenis_cetak'  =>"tgjb",
						'created' => date('Y-m-d H:i:s'),
						'updated' => date('Y-m-d H:i:s'),
						'id_user' => $this->session->userdata('id_user'),
						'content' => $tgjbjson
					);
					$up=$this->cetak_pdf_model->input_cetak($datain);
				}
				if($up)
				redirect("cetak_pdf/format_tgjb/".$in['id_penelitian']);
			}else{
				echo "Data tidak ditemukan";
			}
		}
/* Cetak PDF TGJB */
		function cetak_tgjb($id=""){
			if($id!=""){
				$p=$this->penelitian_model->get_nama_peneliti($id);
				if($p->num_rows()>0){
					$data['penelitian']=$p->row();
					$tgjb=$this->cetak_pdf_model->get_cetak($id,$this->session->userdata('id_user'),'tgjb');
					if($tgjb->num_rows()>0){
						$data['conten']=$tgjb->row();
					}
					$data['title']="Cetak Tanggung Jawab Belanja";
					/*buat folder berdasarkan id_event jika belum ada*/
				    $path_dir_file=FCPATH.'file_download/tanggung_jawab_belanja/';
				    if(!file_exists($path_dir_file)){mkdir($path_dir_file,0777,true);}

				    $filename=$data['penelitian']->id_penelitian.'.pdf';
				    $fullpath=$path_dir_file.'/'.$filename;

					ini_set('memory_limit','32M'); // boost the memory limit if it's low ;)
					$html = $this->load->view('cetak_pdf/penelitian_format_tgjb_pdf', $data,true); // render the view into HTML
					$this->load->library('mypdf');
					$pdf = $this->mypdf->load();
					$pdf->SetTitle($data['title']);
					$pdf->SetAuthor('Mahfud Efendi');
					$pdf->SetCreator('SIPPMas Apps');
					$pdf->SetSubject('Cetak Tanggung Jawab Belanja');
					$pdf->autoPageBreak = true;
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
					
					$nama_pdf=str_replace(array(',','.',' '),"_",$data['penelitian']->nama);
					// $pdf->Output($nama_pdf.".pdf", "D"); // Download File
					$pdf->Output($nama_pdf.".pdf", "I"); // Inline view browser

				}
			}else{
				redirect('penelitian/nilairev/');
			}
		}

}
