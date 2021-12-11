<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Tempat_kkn_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_tempat_kkn($data_array){
			$input=$this->db->insert('kkn_m_tempat', $data_array);
			return $input;
		}

		function update_tempat_kkn($data_array,$id){
			$this->db->where('id_tempat',$id);
			$update=$this->db->update('kkn_m_tempat', $data_array);
			return $update;
		}

		function get_by_id_tempat_kkn($id){
			$this->db->select('*')->from('kkn_m_tempat');
			$this->db->where('id_tempat',$id);
			return  $this->db->get();
		}

		function show_data_tempat_kkn($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,C.nama_kkn as nama_kkn_lookup FROM kkn_m_tempat A 
				  LEFT JOIN kkn_m_tahun C ON A.id_thn_kkn=C.id_thn_kkn ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_kkn_m_tahun(){
						return $this->db->get("kkn_m_tahun");
					}

		function delete_tempat_kkn($id){
			$tabelku="kkn_m_tempat";
			$this->db->where('id_tempat',$id);
			return $this->db->delete($tabelku);
		}
}