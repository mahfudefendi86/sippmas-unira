<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wilayah extends Member_Control {

			   public function __construct()
			   {
					parent::__construct();
					$this->load->helper('url');
					$this->load->model(array('wilayah_model'));
			   }

			function index($s=0){
				redirect(base_url());
			}


			function getprovinsi(){
				$p=$this->wilayah_model->show_data_provinsi();
				if($p->num_rows()>0){
					$provinsi=$p->result();
					$data['status']="200";
					$data['message']="SUCCESS";
					$data['provinsi']=$provinsi;
				}else{
					$provinsi=array("id"=>"","name"=>"");
					$data['status']="404";
					$data['message']="ERROR";
					$data['provinsi']=$provinsi;
				}

				echo json_encode($data);
			}

			function getkotakab($id_prov=""){
				if($id_prov!=""){
					$option=" WHERE A.province_id='".$id_prov."' ORDER BY A.name ASC ";
				}else{
					$option=" ORDER BY A.name ASC  ";
				}
				$p=$this->wilayah_model->show_data_kotakab($option);
				if($p->num_rows()>0){
					$kota_kabupaten=$p->result();
					$data['status']="200";
					$data['message']="SUCCESS";
					$data['kotakab']=$kota_kabupaten;
				}else{
					$kota_kabupaten=array("id"=>"","province_id"=>"","name"=>"");
					$data['status']="404";
					$data['message']="ERROR";
					$data['kotakab']=$kota_kabupaten;
				}
				echo json_encode($data);
			}

			function getkecamatan($id_kotakab=""){
				if($id_kotakab!=""){
					$option=" WHERE A.regency_id='".$id_kotakab."' ORDER BY A.name ASC ";
				}else{
					$option=" ORDER BY A.name ASC ";
				}
				$p=$this->wilayah_model->show_data_kecamatan($option);
				if($p->num_rows()>0){
					$kecamatan=$p->result();
					$data['status']="200";
					$data['message']="SUCCESS";
					$data['kecamatan']=$kecamatan;
				}else{
					$kecamatan=array("id"=>"","regency_id"=>"","name"=>"");
					$data['status']="404";
					$data['message']="ERROR";
					$data['kecamatan']=$kecamatan;
				}
				echo json_encode($data);
			}

			function getdesa($id_kecamatan=""){
				if($id_kecamatan!=""){
					$option=" WHERE A.district_id='".$id_kecamatan."' ORDER BY A.name ASC ";
				}else{
					$option="";
				}
				$p=$this->wilayah_model->show_data_desa($option);
				if($p->num_rows()>0){
					$desa=$p->result();
					$data['status']="200";
					$data['message']="SUCCESS";
					$data['desa']=$desa;
				}else{
					$desa=array("id"=>"","district_id"=>"","name"=>"");
					$data['status']="404";
					$data['message']="ERROR";
					$data['desa']=$desa;
				}
				echo json_encode($data);
			}
}
