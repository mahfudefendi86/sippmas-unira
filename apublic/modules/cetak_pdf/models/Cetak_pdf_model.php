<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Cetak_pdf_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_cetak($data_array){
			$input=$this->db->insert('pr_penelitian_cetak_pdf', $data_array);
			return $input;
		}

		function update_cetak($data_array,$id){
			$this->db->where('id_ctk',$id);
			$update=$this->db->update('pr_penelitian_cetak_pdf', $data_array);
			return $update;
		}

		function get_cetak($id_penelitian,$id_user,$jc){
			$this->db->select('*')->from('pr_penelitian_cetak_pdf');
			$this->db->where('jenis_cetak',$jc);
			$this->db->where('id_penelitian',$id_penelitian);
			// $this->db->where('id_user',$id_user);
			return  $this->db->get();
		}
}
