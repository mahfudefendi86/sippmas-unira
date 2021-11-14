<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Member_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function cek($el,$val){
			$sql="SELECT * FROM ta_app_customer WHERE ".$el."='".$val."' ";
			return $this->db->query($sql);
		}

		function get_customer($id){
			$sql="SELECT * FROM ta_app_customer WHERE id_customer='".$id."' ";
			return $this->db->query($sql);
		}

		function get_option($option){
			$sql="SELECT * FROM ta_app_options WHERE option_name='".$option."' ";
			return $this->db->query($sql);
		}

		function get_option_by_group($option){
			$sql="SELECT * FROM ta_app_options WHERE option_group='".$option."' ";
			return $this->db->query($sql);
		}

		function input_customer($data_array){
			$input=$this->db->insert('ta_app_customer', $data_array);
			return $input;
		}

		function update_customer($data_array,$id){
			$this->db->where('id_customer',$id);
			$update=$this->db->update('ta_app_customer', $data_array);
			return $update;
		}

		function input_customer_user($data_array){
			$input=$this->db->insert('ta_app_user', $data_array);
			return $input;
		}

		function input_customer_pref($data_array){
			$input=$this->db->insert('ta_app_customer_pref', $data_array);
			return $input;
		}

		function input_tiketbox_setclient($data_array){
			$input=$this->db->insert('ta_app_tiketbox_set_client', $data_array);
			return $input;
		}

		/* loading data Provinsi */
		function load_provinsi(){
			$sql="SELECT * FROM _m_provinces ORDER BY name ASC ";
			$d=$this->db->query($sql);
			return $d;
		}

		/* loading data Kota/Kabupaten */
		function load_regencies($option=NULL){
			$in=$this->input->post(null,true);
			$sql="SELECT * FROM _m_regencies ";
			if($option!=NULL){
				$sql.=$option;
			}
			$sql.=" ORDER BY name ASC ";
			return $this->db->query($sql);
		}

		/* get Max ID Customer */
		function get_id(){
			$sql="SELECT max(id_customer) as id FROM ta_app_customer ";
			$d=$this->db->query($sql);
			return $d;
		}

		/******************************************************/
		function show_data_member($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.name as name_kota,C.name as name_provinsi FROM ta_app_customer A
				  LEFT JOIN _m_regencies B ON A.kota=B.id
				  LEFT JOIN _m_provinces C ON A.provinsi=C.id ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		/* Show Tiketbox */
		function show_data_tiketbox($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.name as name_kota,C.name as name_provinsi FROM ta_app_customer A
				  LEFT JOIN _m_regencies B ON A.kota=B.id
				  LEFT JOIN _m_provinces C ON A.provinsi=C.id
					LEFT JOIN ta_app_tiketbox_set_client D ON A.id_customer=D.id_customer ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		/* Show Tiketbox */
		function show_tiketbox_by_event($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.*,B.name as name_kota,C.name as name_provinsi FROM ta_app_customer A
				  LEFT JOIN _m_regencies B ON A.kota=B.id
				  LEFT JOIN _m_provinces C ON A.provinsi=C.id
					LEFT JOIN ta_app_tiketbox_set_event D ON A.id_customer=D.id_customer ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function dele_member($id){
			/* Menghapus semua data tabel berdasarkan id_customer */
			$tabelku="ta_app_customer";
			$this->db->where('id_customer',$id);
			return $this->db->delete($tabelku);
		}
		function dele_member_user($id){
			/* Menghapus semua data tabel berdasarkan id_customer */
			$tabelku="ta_app_user";
			$this->db->where('id_customer',$id);
			return $this->db->delete($tabelku);
		}
		function dele_member_cust_pref($id){
			/* Menghapus semua data tabel berdasarkan id_customer */
			$tabelku="ta_app_customer_pref";
			$this->db->where('id_customer',$id);
			return $this->db->delete($tabelku);
		}

		/* Menghapus Data Tiketbox Bersarkana id_customer dan Client [pada] tabel ta_app_tiketbox_set_client */
		function hapus_tiketbox_client($id_customer,$client_id){
			$tabelku="ta_app_tiketbox_set_client";
			$this->db->where('id_customer',$id_customer);
			$this->db->where('client_id',$client_id);
			return $this->db->delete($tabelku);
		}

		/* Menghapus Data Tiketbox Bersarkana id_customer dan Client [pada] tabel ta_app_tiketbox_set_event */
		function hapus_tiketbox_event($id_customer,$client_id){
			$tabelku="ta_app_tiketbox_set_event";
			$this->db->where('id_customer',$id_customer);
			$this->db->where('client_id',$client_id);
			return $this->db->delete($tabelku);
		}


}
