<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Peserta_kkn_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_peserta_kkn($data_array){
			$input=$this->db->insert('kkn_peserta_registrasi', $data_array);
			return $input;
		}

		function update_peserta_kkn($data_array,$id){
			$this->db->where('id_peserta',$id);
			$update=$this->db->update('kkn_peserta_registrasi', $data_array);
			return $update;
		}

		function get_by_id_peserta_kkn($id){
			$this->db->select('*')->from('kkn_peserta_registrasi');
			$this->db->where('id_peserta',$id);
			return  $this->db->get();
		}

		function show_data_peserta_kkn($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.nama_fakultas as nama_fakultas, C.nama_prodi as nama_prodi 
				FROM kkn_peserta_registrasi A 
				LEFT JOIN tbl_fakultas B ON A.id_fakultas=B.id_fakultas
				LEFT JOIN tbl_prodi C ON A.id_prodi=C.id_prodi ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_tbl_fakultas(){
						return $this->db->get("tbl_fakultas");
					}
		function lookup_tbl_prodi(){
						return $this->db->get("tbl_prodi");
					}

		function delete_peserta_kkn($id){
			$tabelku="kkn_peserta_registrasi";
			 if(is_array($id)){
				 $this->db->where_in('id_peserta',$id);
			 }else{
				$this->db->where('id_peserta',$id);
			}
				return $this->db->delete($tabelku);
		}
}