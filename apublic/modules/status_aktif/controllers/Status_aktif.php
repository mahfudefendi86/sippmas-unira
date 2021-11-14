<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Status_aktif extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper(array('url','global_function','format_tanggal'));
					$this->load->model(array('status_aktif_model','peneliti/peneliti_model'));
			   }

			function index($s=0){
				return $this->show($s);
			}

			function show($s=0){
				active_link("Konfigurasi");
				 $data['title']="Daftar Status Non Aktif Author";
				 $data['s']=$s;
				 $data['op_search']=array("B.nama"=>"Nama Author");
				 $this->template->mainview('status_aktif/status_aktif_index',$data);
			}
			function status_aktif_show($st=NULL,$option=""){
				$in=$this->input->post(null,true);
				$row=10;$sort="";$filt="";
				if($st==NULL){$start=0;}else{$start=$st;};
				$row=($in['row']!=NULL || $in['row']!="")? $in['row']:$row;
				if($in['cari']!=NULL || $in['cari']!=""){
					if($in['filter']!=NULL || $in['filter']!=""){
						$filt.=" WHERE ".$in['filter']." LIKE '%".$in['cari']."%' ";
					}else{
						$option.=" WHERE ( B.nama LIKE '%".$in['cari']."%' ) ";
					}
				}
				 $option.=$filt;
				 $option.=" ORDER BY A.tanggal_nonaktif DESC ";
				///pengaturan pagination
				 $this->load->library('pagination');
				 $config['base_url'] = site_url('status_aktif/status_aktif_show');
				 $config['first_url'] = site_url('status_aktif/status_aktif_show/0');
				 $config['uri_segment'] = 3;///Untuk menentukan jumlah record yang tampil
				 $config['per_page'] = $row;
				 $config['total_rows'] = $this->status_aktif_model->show_data_status_aktif($option)->num_rows();
				 //inisialisasi config
				 $this->pagination->initialize($config);
				 $data['links'] = $this->pagination->create_links();
				 $data['start']=$start;
				 $data['end']=$start+$config['per_page'];
				 $data['total_rows']=$config['total_rows'];
				$data['status_aktif']=$this->status_aktif_model->show_data_status_aktif($option,$start,$config['per_page'])->result();
				$this->load->view('status_aktif/status_aktif_show',$data);
			}

			function status_aktif_search($start=0,$option=""){
				$in=$this->input->post(null,true);
				if(!$in){
					$data='';
					$data['id_peneliti']=$this->peneliti_model->show_data_peneliti(" ORDER BY A.nama ASC ")->result();
					$this->load->view('status_aktif/status_aktif_search',$data);
				}else{

					if($in['sa_nama_author']!=""){
							($option=="")? $option.=" WHERE " : $option.=" AND " ;
							$option.=" A.id_peneliti LIKE '%".$in['sa_nama_author']."%' ";
					}
				$numRows=$this->status_aktif_model->show_data_status_aktif($option)->num_rows();
				$data['links'] = "Pencarian berhasil menemukan ".$numRows;
				$data['start']=0;
			    $data['end']=$numRows;
			    $data['total_rows']=$numRows;
				$data['status_aktif']=$this->status_aktif_model->show_data_status_aktif($option)->result();
				$this->load->view('status_aktif/status_aktif_show',$data);
				}
			}

			function status_aktif_add(){
				$in=$this->input->post(null,true);
				if(!$in){
					$data['title']="This Your Title";
					//$data['id_peneliti']=$this->status_aktif_model->lookup_tbl_peneliti()->result();
					$data['id_peneliti']=$this->peneliti_model->show_data_peneliti(" ORDER BY A.nama ASC ")->result();
					$this->load->view('status_aktif/status_aktif_form',$data);
				}else{
					$data_in=array(
					'id_status_author' => random_id(),
					'id_peneliti' => $in['sa_nama_author'],
					'alasan_nonaktif' => $in['sa_alasan_nonaktif'],
					'tanggal_nonaktif' => $in['sa_tanggal_non_aktif']
					);
					$input_data=$this->status_aktif_model->input_status_aktif($data_in);
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

			function status_aktif_upd($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['title']="This Your Title";
					$data['id_peneliti']=$this->status_aktif_model->lookup_tbl_peneliti()->result();
						$data['status_aktif']=$this->status_aktif_model->get_by_id_status_aktif($id)->row();
						$this->load->view('status_aktif/status_aktif_form',$data);
				}else{
					$data_in=array(
					'id_peneliti' => $in['sa_nama_author'],
					'alasan_nonaktif' => $in['sa_alasan_nonaktif'],
					'tanggal_nonaktif' => $in['sa_tanggal_non_aktif']
					);
					$update_data=$this->status_aktif_model->update_status_aktif($data_in,$in['sa_id_status']);
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

			function status_aktif_kembali($id=null){
				$in=$this->input->post(null,true);
				if(!$in){
						$data['id_peneliti']=$this->status_aktif_model->lookup_tbl_peneliti()->result();
						$data['status_aktif']=$this->status_aktif_model->get_by_id_status_aktif($id)->row();
						$this->load->view('status_aktif/status_aktif_kembali',$data);
				}else{
					if($in['sa_tanggal_aktif']=="Y"){
						$data_in=array(
						'tanggal_aktif_kembali' =>  date('Y-m-d'),
						'aktif_kembali' =>$in['sa_tanggal_aktif']
						);
					}else{
						$data_in=array(
						'tanggal_aktif_kembali' => NULL,
						'aktif_kembali' =>$in['sa_tanggal_aktif']
						);
					}

					$update_data=$this->status_aktif_model->update_status_aktif($data_in,$in['sa_id_status']);
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

			function status_aktif_dlt($id=''){
				$in=$this->input->post(null,true);
				if(!$in && $id!=''){
					$hapus=$this->status_aktif_model->delete_status_aktif($id);
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

			function status_aktif_actionAll($action=""){
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
					$hapus=$this->status_aktif_model->delete_status_aktif($idArray[$x]);
					if($hapus) $cMsg++;
				}
				$notif='<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Data berhasil di HAPUS...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				echo json_encode(array('msg'=>$notif,'status'=>'OK'));
			}else{
				return false;
			}
		}

		/* info untuk non aktif */
		function info_status($status="",$id_user=""){
			if($status!="" && $id_user!=""){
				/* cek id */
				if($status=="nonaktif"){
					$op=" WHERE A.id_peneliti='".$id_user."'  AND A.aktif_kembali='N' ";
				}else if($status=="aktif"){
					$op=" WHERE A.id_peneliti='".$id_user."'  AND A.aktif_kembali='Y' ";
				}else{
					$op=" WHERE A.aktif_kembali='-' ";
				}
				$s=$this->status_aktif_model->show_data_status_aktif($op);
				if($s->num_rows()>0){
					$data['status']=$s->row();
					$this->template->mainview("status_aktif/info_status",$data);
				}
			}
		}

}
