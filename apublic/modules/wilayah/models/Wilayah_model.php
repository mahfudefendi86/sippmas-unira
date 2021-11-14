<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Wilayah_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

/* Ambil data Provinsi */
		function get_by_id_provinsi($id){
			$this->db->select('*')->from('_m_provinsi');
			$this->db->where('id',$id);
			return  $this->db->get();
		}

		function show_data_provinsi($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM _m_provinsi A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

/* Ambil data kota kabupaten */
		function get_by_id_kotakab($id){
			$this->db->select('*')->from('_m_kotakab');
			$this->db->where('id',$id);
			return  $this->db->get();
		}

		function show_data_kotakab($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM _m_kotakab A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

/* Ambil data kota kecamatan */
		function get_by_id_kecamatan($id){
			$this->db->select('*')->from('_m_kecamatan');
			$this->db->where('id',$id);
			return  $this->db->get();
		}

		function show_data_kecamatan($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM _m_kecamatan A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}
/* Ambil data kota desa */
		function get_by_id_desa($id){
			$this->db->select('*')->from('_m_desa');
			$this->db->where('id',$id);
			return  $this->db->get();
		}

		function show_data_desa($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.* FROM _m_desa A ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}


}
