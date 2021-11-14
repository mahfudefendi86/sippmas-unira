<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Penelitian_model extends CI_Model {

		function __construct()
		{
			parent::__construct();
		}

		function input_penelitian($data_array){
			$input=$this->db->insert('pr_penelitian', $data_array);
			return $input;
		}

		function update_penelitian($data_array,$id){
			$this->db->where('id_penelitian',$id);
			$update=$this->db->update('pr_penelitian', $data_array);
			return $update;
		}

		function get_by_id_penelitian($id){
			$sql="SELECT A.*,B.nama as nama_lookup,	B.foto_thumb,B.nidn, C.tahun_anggaran as tahun_anggaran_lookup,	D.nama_skema as nama_skema_lookup,
			  	(select count(id_catatan) from pr_penelitian_catatan WHERE id_penelitian=A.id_penelitian) as jumlah_catatan,
			  	(select max(persentase) from pr_penelitian_catatan WHERE id_penelitian=A.id_penelitian) as progres,
				(SELECT concat(nama,' / NIDN. ',nidn) FROM tbl_reviewer WHERE tbl_reviewer.id_user=A.reviewer1) as nama_reviewer1,
				(SELECT concat(nama,' / NIDN. ',nidn) FROM tbl_reviewer WHERE tbl_reviewer.id_user=A.reviewer2) as nama_reviewer2
			  	FROM pr_penelitian A
			  	LEFT JOIN tbl_peneliti B ON A.id_ketua=B.id_user
			  	LEFT JOIN tbl_thn_anggaran C ON A.id_anggaran=C.id_anggaran
			  	LEFT JOIN tbl_skema D ON A.id_skema=D.id_skema
				WHERE A.id_penelitian='".$id."' ";
			return $this->db->query($sql);
		}

		function show_data_penelitian($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.id_penelitian,A.judul_penelitian,A.status_pengajuan,A.dana_disetujui,A.jenis_usulan,A.sk_persetujuan,
				B.nama as nama_lookup, B.foto_thumb, B.nidn,
				C.tahun_anggaran as tahun_anggaran_lookup,
				D.nama_skema as nama_skema_lookup,
			  	(select count(id_catatan) from pr_penelitian_catatan WHERE id_penelitian=A.id_penelitian) as jumlah_catatan,
			  	(select max(persentase) from pr_penelitian_catatan WHERE id_penelitian=A.id_penelitian) as progres,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='kemajuan' LIMIT 1) as file_kemajuan,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='akhir' LIMIT 1) as file_akhir,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='tgjb' LIMIT 1) as file_tgjb,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='artikel' LIMIT 1) as file_artikel,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='borang' LIMIT 1) as file_borang,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='poster' LIMIT 1) as file_poster,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='profil' LIMIT 1) as file_profil
			  	FROM pr_penelitian A
			  	LEFT JOIN tbl_peneliti B ON A.id_ketua=B.id_user
			  	LEFT JOIN tbl_thn_anggaran C ON A.id_anggaran=C.id_anggaran
			  	LEFT JOIN tbl_skema D ON A.id_skema=D.id_skema ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function show_data_penelitian_nilai($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.id_penelitian,A.judul_penelitian,A.status_pengajuan,A.dana_disetujui,,A.sk_persetujuan,
				B.nama as nama_lookup,
				C.tahun_anggaran as tahun_anggaran_lookup,
				D.nama_skema as nama_skema_lookup,
			  	(select count(id_catatan) from pr_penelitian_catatan WHERE id_penelitian=A.id_penelitian) as jumlah_catatan,
			  	(select max(persentase) from pr_penelitian_catatan WHERE id_penelitian=A.id_penelitian) as progres,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='kemajuan' LIMIT 1) as file_kemajuan,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='akhir' LIMIT 1) as file_akhir,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='tgjb' LIMIT 1) as file_tgjb,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='artikel' LIMIT 1) as file_artikel,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='borang' LIMIT 1) as file_borang,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='poster' LIMIT 1) as file_poster,
				(select count(id_penelitian) from pr_penelitian_berkas WHERE id_penelitian=A.id_penelitian AND identifikasi_berkas='profil' LIMIT 1) as file_profil
			  	FROM pr_penelitian A
			  	LEFT JOIN tbl_peneliti B ON A.id_ketua=B.id_user
			  	LEFT JOIN tbl_thn_anggaran C ON A.id_anggaran=C.id_anggaran
			  	LEFT JOIN tbl_skema D ON A.id_skema=D.id_skema ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function show_data_ploting($option=NULL,$start=NULL,$limit=NULL){
			$sql="SELECT A.id_penelitian,A.judul_penelitian, A.reviewer1 as nm_reviewer1, A.reviewer2 as nm_reviewer2, A.jenis_usulan,A.status_pengajuan,A.sk_persetujuan,
				B.nama as nama_lookup,
				C.tahun_anggaran as tahun_anggaran_lookup,
				D.nama_skema as nama_skema_lookup,
				(select nidn from tbl_reviewer WHERE id_user=A.reviewer1) as nidn1,
				(select nama from tbl_reviewer WHERE id_user=A.reviewer1) as reviewer1,
				(select nidn from tbl_reviewer WHERE id_user=A.reviewer2) as nidn2,
				(select nama from tbl_reviewer WHERE id_user=A.reviewer2) as reviewer2
			  	FROM pr_penelitian A
			  	LEFT JOIN tbl_peneliti B ON A.id_ketua=B.id_user
			  	LEFT JOIN tbl_thn_anggaran C ON A.id_anggaran=C.id_anggaran
			  	LEFT JOIN tbl_skema D ON A.id_skema=D.id_skema ";
			if($option!=NULL){
				 $sql.=$option;
			 }
			 if($start!=NULL && $limit!=NULL){
				 $sql.=" LIMIT ".$start.",".$limit ;
			 }
			return $this->db->query($sql);
		}

		function lookup_tbl_peneliti(){ return $this->db->get("tbl_peneliti"); }
		function lookup_tbl_thn_anggaran(){ return $this->db->get("tbl_thn_anggaran"); }
		function lookup_tbl_skema(){ return $this->db->get("tbl_skema"); }

		function delete_penelitian($id){
			$tabelku="pr_penelitian";
			$this->db->where('id_penelitian',$id);
			return $this->db->delete($tabelku);
		}

		function cek_data($field,$id){
			$this->db->select('*')->from('pr_penelitian');
			$this->db->where($field,$id);
			return  $this->db->get();
		}

		function get_nama_peneliti($id){
			$sql="SELECT A.id_penelitian,A.judul_penelitian,A.dana_disetujui,B.nama,B.alamat,C.name as desa,D.name as kecamatan,E.name as kotakab
				FROM pr_penelitian A
				LEFT JOIN tbl_peneliti B ON A.id_ketua=B.id_user
				LEFT JOIN _m_desa C ON B.desa=C.id
				LEFT JOIN _m_kecamatan D ON B.kecamatan=D.id
				LEFT JOIN _m_kotakab E ON B.kota_kab=E.id
				WHERE A.id_penelitian='".$id."'
				LIMIT 1 ";
			return $this->db->query($sql);
		}

		function get_format_tgjb($id){
			$sql=" SELECT * FROM pr_penelitian_tgng_jawab A WHERE A.id_penelitian='".$id."' LIMIT 1 ";
			return $this->db->query($sql);
		}

		function riawayat_ketua($id){
			$sql="SELECT A.id_penelitian,A.judul_penelitian,B.tahun_anggaran,C.nama_skema,A.status_pengajuan,A.dana_usulan,A.dana_disetujui,A.jenis_usulan
				FROM pr_penelitian A
				LEFT JOIN tbl_thn_anggaran B ON A.id_anggaran=B.id_anggaran
				LEFT JOIN tbl_skema C ON A.id_skema=C.id_skema
				WHERE A.id_ketua='".$id."' ";
			return $this->db->query($sql);
		}

		function riawayat_anggota($id){
			$sql="SELECT D.id_penelitian,D.judul_penelitian,B.tahun_anggaran,C.nama_skema,D.status_pengajuan,D.dana_usulan,D.dana_disetujui,D.jenis_usulan
				FROM pr_penelitian_personil A
				LEFT JOIN pr_penelitian D ON A.id_penelitian=D.id_penelitian
				LEFT JOIN tbl_thn_anggaran B ON D.id_anggaran=B.id_anggaran
				LEFT JOIN tbl_skema C ON D.id_skema=C.id_skema
				WHERE A.id_user='".$id."' ";
			return $this->db->query($sql);
		}
}
