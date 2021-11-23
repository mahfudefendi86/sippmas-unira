<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Main_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function list_produk_card($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM view_produk A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function get_produk($id){
			$sql="SELECT A.* FROM view_produk A WHERE A.id_produk='".$id."' ";
			return $this->db->query($sql);
		}

		function getkatlevel($lv,$idkat=""){
			if($idkat!=""){
				$sql="SELECT A.* FROM m_kategori A WHERE A.order='".$lv."' AND A.order_turunan='".$idkat."' ";
			}else{
				$sql="SELECT A.* FROM m_kategori A WHERE A.order='".$lv."' ";
			}
			return $this->db->query($sql);
		}

		function get_kategori($id){
			$sql="SELECT A.* FROM m_kategori A WHERE A.id_kategori='".$id."' ";
			return $this->db->query($sql);
		}

		function get_proses(){
			$sql="SELECT A.* FROM m_proses A ";
			return $this->db->query($sql);
		}

}
