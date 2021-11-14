<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Berita_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_berita($data_array){
			$input=$this->db->insert('pub_berita', $data_array);
			return $input;
		}

		function update_berita($data_array,$id){
			$this->db->where('id_berita',$id);
			$update=$this->db->update('pub_berita', $data_array);
			return $update;
		}

		function get_by_id_berita($id){
			$sql="SELECT A.*,B.kategori,B.warna,B.ikon,C.nama as nama_user FROM pub_berita A
				  LEFT JOIN pub_berita_kategori B ON A.id_kategori=B.id_kategori
				  LEFT JOIN _m_usr_login C ON A.userid=C.userid
				  WHERE A.id_berita='".$id."' ";
			return $this->db->query($sql);
		}

		function show_data_berita($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.kategori,B.warna,B.ikon,C.nama as nama_user FROM pub_berita A
				  LEFT JOIN pub_berita_kategori B ON A.id_kategori=B.id_kategori
				  LEFT JOIN _m_usr_login C ON A.userid=C.userid ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_pub_berita_kategori(){ return $this->db->get("pub_berita_kategori"); }

		function delete_berita($id){
			$tabelku="pub_berita";
			$this->db->where('id_berita',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pub_berita');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}
