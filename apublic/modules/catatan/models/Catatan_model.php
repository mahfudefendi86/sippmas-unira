<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Catatan_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_catatan($data_array){
			$input=$this->db->insert('pr_penelitian_catatan', $data_array);
			return $input;
		}

		function update_catatan($data_array,$id){
			$this->db->where('id_catatan',$id);
			$update=$this->db->update('pr_penelitian_catatan', $data_array);
			return $update;
		}

		function get_by_id_catatan($id){
			$this->db->select('*')->from('pr_penelitian_catatan');
			$this->db->where('id_catatan',$id);
			return  $this->db->get();
		}

		function show_data_catatan($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.judul_penelitian as judul_penelitian_lookup,
				  (select count(id_berkas) FROM pr_penelitian_berkas WHERE identifikasi_id=A.id_catatan AND id_penelitian=A.id_penelitian AND identifikasi_berkas='catatan') as jumlah_berkas
				  FROM pr_penelitian_catatan A
				  LEFT JOIN pr_penelitian B ON A.id_penelitian=B.id_penelitian ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_pr_penelitian(){ return $this->db->get("pr_penelitian"); }

		function delete_catatan($id){
			$tabelku="pr_penelitian_catatan";
			$this->db->where('id_catatan',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pr_penelitian_catatan');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}
