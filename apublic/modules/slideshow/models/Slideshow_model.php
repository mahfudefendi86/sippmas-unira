<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Slideshow_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_slideshow($data_array){
			$input=$this->db->insert('pub_slideshow', $data_array);
			return $input;
		}

		function update_slideshow($data_array,$id){
			$this->db->where('id_slideshow',$id);
			$update=$this->db->update('pub_slideshow', $data_array);
			return $update;
		}

		function get_by_id_slideshow($id){
			$this->db->select('*')->from('pub_slideshow');
			$this->db->where('id_slideshow',$id);
			return  $this->db->get();
		}

		function show_data_slideshow($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.nama FROM pub_slideshow A LEFT JOIN _m_usr_login B ON A.userid=B.userid ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


		function delete_slideshow($id){
			$tabelku="pub_slideshow";
			$this->db->where('id_slideshow',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pub_slideshow');
			$this->db->where($field,$id);
			return  $this->db->get();
		}
}
