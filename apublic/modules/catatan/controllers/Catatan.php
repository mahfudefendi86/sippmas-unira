<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Catatan extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper(array('url','global_function','format_tanggal'));
					$this->load->model(array('catatan_model','penelitian/penelitian_model'));
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
					$data['title']="Catatan Harian";
   				 	$this->template->mainview('catatan/catatan_index',$data);
				}else{
					redirect('penelitian');
				}
			}

			function catatan_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				/* cek Data Penelitian terlebih dahulu */
				if($in['id_penelitian']!=NULL || $in['id_penelitian']!=""){
					$p=$this->penelitian_model->show_data_penelitian(" WHERE A.id_penelitian='".$in['id_penelitian']."' AND A.status_pengajuan='DISETUJUI' LIMIT 1");
					if($p->num_rows()>0){
		   				$option.=" WHERE A.id_penelitian='".$in['id_penelitian']."' ";
					}else{
						/* jika tidak dtemukan id_penelitian yang di maksud maka muncul informasi berikut */
						echo '<script>alert("Maaf...Data tidak valid!!\nSistem tidak menemukan data anda...\nSilahkan hubungi administrator...");
							setTimeout(function direc(){
								window.history.back(-1);
							},200);
						</script>';
						return false;
						exit();
					}
				}
				if($in['cari']!=NULL || $in['cari']!=""){
					($option=="")?$option.=" WHERE ":$option.=" AND ";
					$option.=" ( B.judul_penelitian LIKE '%".$in['cari']."%'  OR A.uraian LIKE '%".$in['cari']."%' ) ";
				}
				if($in['bulan']!=NULL || $in['bulan']!=""){
					($option=="")?$option.=" WHERE ":$option.=" AND ";
					$option.=" MONTH(A.tgl)='".$in['bulan']."' ";
				}
				if($in['tahun']!=NULL || $in['tahun']!=""){
					($option=="")?$option.=" WHERE ":$option.=" AND ";
					$option.=" YEAR(A.tgl)='".$in['tahun']."' ";
				}
				 $option.=$filt;
				 $option.=" ORDER BY A.tgl DESC ";
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('catatan/catatan_show');
				 $config['first_url'] = site_url('catatan/catatan_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->catatan_model->show_data_catatan($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				 $data['catatan']=$this->catatan_model->show_data_catatan($option,$start,$config['per_page'])->result();
				$this->load->view('catatan/catatan_show',$data);
			}

			function catatan_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data=array();
					$data['id_penelitian']=$this->catatan_model->lookup_pr_penelitian()->result();
					$this->load->view('catatan/catatan_search',$data);
				}else{

					if($in['ctn_id_penelitian']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.id_penelitian LIKE '%".$in['ctn_id_penelitian']."%' ";
					}
					if($in['ctn_tanggal']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.tgl LIKE '%".$in['ctn_tanggal']."%' ";
					}
					if($in['ctn_uarain_kegiatan']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.uraian LIKE '%".$in['ctn_uarain_kegiatan']."%' ";
					}
				$numRows=$this->catatan_model->show_data_catatan($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['catatan']=$this->catatan_model->show_data_catatan($option)->result();
				$this->load->view('catatan/catatan_show',$data);
				}
			}

			function catatan_add($id=""){
				$in=$this->input->post(null,true);
				if(!$in && $id!=""){
					$data['id_penelitian']=$id;
					$this->load->view('catatan/catatan_form',$data);
				}else{
					$data_in=array(
					'id_catatan' => random_id(),
					'id_penelitian' => $in['ctn_id_penelitian'],
					'tgl' => $in['ctn_tanggal'],
					'uraian' => $in['ctn_uarain_kegiatan'],
					'persentase' => $in['ctn_persentase_kegiatan']
					);
					$input_data=$this->catatan_model->input_catatan($data_in);
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


			function catatan_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
						$data['id_penelitian']=$this->catatan_model->lookup_pr_penelitian()->result();
						$data['catatan']=$this->catatan_model->get_by_id_catatan($id)->row();
						$this->load->view('catatan/catatan_form',$data);
				}else{
					$data_in=array(
					'id_penelitian' => $in['ctn_id_penelitian'],
					'tgl' => $in['ctn_tanggal'],
					'uraian' => $in['ctn_uarain_kegiatan'],
					'persentase' => $in['ctn_persentase_kegiatan']
					);
					$update_data=$this->catatan_model->update_catatan($data_in,$in['ctn_id_catatan']);
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

			function catatan_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->catatan_model->delete_catatan($id);
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

			function catatan_actionAll($action=""){
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
					$hapus=$this->catatan_model->delete_catatan($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil dihapus...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

}
