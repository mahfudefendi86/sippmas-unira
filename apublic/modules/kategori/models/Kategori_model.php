<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Kategori_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_kategori($data_array){
			$input=$this->db->insert('pub_berita_kategori', $data_array);
			return $input;
		}

		function update_kategori($data_array,$id){
			$this->db->where('id_kategori',$id);
			$update=$this->db->update('pub_berita_kategori', $data_array);
			return $update;
		}

		function get_by_id_kategori($id){
			$this->db->select('*')->from('pub_berita_kategori');
			$this->db->where('id_kategori',$id);
			return  $this->db->get();
		}

		function show_data_kategori($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,(select count(id_berita) from pub_berita where id_kategori=A.id_kategori) as count_berita
			FROM pub_berita_kategori A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_kategori($id){
			$tabelku="pub_berita_kategori";
			$this->db->where('id_kategori',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pub_berita_kategori');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}
