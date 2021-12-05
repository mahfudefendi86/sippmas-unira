<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Tahun_ajaran_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_tahun_ajaran($data_array){
			$input=$this->db->insert('kkn_m_tahun', $data_array);
			return $input;
		}

		function update_tahun_ajaran($data_array,$id){
			$this->db->where('id_thn_kkn',$id);
			$update=$this->db->update('kkn_m_tahun', $data_array);
			return $update;
		}

		function get_by_id_tahun_ajaran($id){
			$this->db->select('*')->from('kkn_m_tahun');
			$this->db->where('id_thn_kkn',$id);
			return  $this->db->get();
		}

		function show_data_tahun_ajaran($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM kkn_m_tahun A  ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_tahun_ajaran($id){
			$tabelku="kkn_m_tahun";
			$this->db->where('id_thn_kkn',$id);
			return $this->db->delete($tabelku);
		}
}