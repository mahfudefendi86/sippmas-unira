<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Konfigurasi_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_konfigurasi($data_array){
			$input=$this->db->insert('konf_pengajuan', $data_array);
			return $input;
		}

		function update_konfigurasi($data_array,$id){
			$this->db->where('id_konf',$id);
			$update=$this->db->update('konf_pengajuan', $data_array);
			return $update;
		}

		function get_by_id_konfigurasi($id){
			$this->db->select('*')->from('konf_pengajuan');
			$this->db->where('id_konf',$id);
			return  $this->db->get();
		}

		function show_data_konfigurasi($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM konf_pengajuan A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_konfigurasi($id){
			$tabelku="konf_pengajuan";
			$this->db->where('id_konf',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('konf_pengajuan');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}