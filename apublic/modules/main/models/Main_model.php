<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function select_fakultas()
    {
        $this->db->order_by('nama_fakultas', 'ASC');
        return $this->db->get('tbl_fakultas');
    }

    public function select_prodi($id_fakultas)
    {
        $this->db->order_by('nama_prodi', 'ASC');
        return $this->db->get_where('tbl_prodi', ['id_fakultas' => $id_fakultas]);
    }

    public function selectProvinsi()
    {
        $this->db->order_by('nama_prov', 'ASC');
        $query = $this->db->get('provinsi');
        return $query;
    }

    public function selectKota($id_prov)
    {
        $this->db->order_by('nama_kota', 'ASC');
        $query = $this->db->get_where('kota', array('id_prov' => $id_prov));
        return $query;
    }

    public function selectKecamatan($id_kota)
    {
        $this->db->order_by('nama_kec', 'ASC');
        $query = $this->db->get_where('kecamatan', array('id_kota' => $id_kota));
        return $query;
    }

    public function selectKelurahan($id_kec)
    {
        $this->db->order_by('nama_kel', 'ASC');
        $query = $this->db->get_where('kelurahan', array('id_kec' => $id_kec));
        return $query;
    }

    // function list_produk_card($option=NULL,$start=NULL,$limit=NULL){
    //     $sql="SELECT A.* FROM view_produk A ";
    //     if($option!=NULL){
    //          $sql.=$option;
    //      }
    //      if($start!=NULL && $limit!=NULL){
    //          $sql.=" LIMIT ".$start.",".$limit ;
    //      }
    //     return $this->db->query($sql);
    // }

    // function get_produk($id){
    //     $sql="SELECT A.* FROM view_produk A WHERE A.id_produk='".$id."' ";
    //     return $this->db->query($sql);
    // }

    // function getkatlevel($lv,$idkat=""){
    //     if($idkat!=""){
    //         $sql="SELECT A.* FROM m_kategori A WHERE A.order='".$lv."' AND A.order_turunan='".$idkat."' ";
    //     }else{
    //         $sql="SELECT A.* FROM m_kategori A WHERE A.order='".$lv."' ";
    //     }
    //     return $this->db->query($sql);
    // }

    // function get_kategori($id){
    //     $sql="SELECT A.* FROM m_kategori A WHERE A.id_kategori='".$id."' ";
    //     return $this->db->query($sql);
    // }

    // function get_proses(){
    //     $sql="SELECT A.* FROM m_proses A ";
    //     return $this->db->query($sql);
    // }

}
