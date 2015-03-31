<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Jaringan_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getJaringan($array,$limit) {

        $this->db->select("t_hajar.*,ref_treeview.kantor,t_merk.nmmerk,t_kondisi.nmkondisi");
        $this->db->from("t_hajar");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_hajar.unit");
        $this->db->join("t_merk","t_merk.id=t_hajar.merk");
        $this->db->join("t_kondisi","t_kondisi.id=t_hajar.kondisi");
        $this->db->where($array);
        $this->db->order_by("date_created", "desc"); 
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }


    public function getJaringanCount($array,$limit) {

        $this->db->select("*");
        $this->db->from("t_hajar");
        $this->db->where($array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function getJaringanFilter($array,$limit) {

        $query =$this->db->query("SELECT `t_hajar`.*, `ref_treeview`.`kantor`, `t_merk`.`nmmerk`, `t_kondisi`.`nmkondisi` 
            FROM (`t_hajar`) JOIN `ref_treeview` ON `ref_treeview`.`unit2`=`t_hajar`.`unit` JOIN `t_merk` 
            ON `t_merk`.`id`=`t_hajar`.`merk` JOIN `t_kondisi` ON `t_kondisi`.`id`=`t_hajar`.`kondisi`
            WHERE '$array' ORDER BY `date_created` desc");

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getJaringanById($array) {

        $this->db->select("t_hajar.*,ref_treeview.kantor,t_merk.nmmerk,t_kondisi.nmkondisi");
        $this->db->from("t_hajar");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_hajar.unit");
        $this->db->join("t_merk","t_merk.id=t_hajar.merk");
        $this->db->join("t_kondisi","t_kondisi.id=t_hajar.kondisi");
        $this->db->where($array);
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function jaringan_insert($data) {

        // Query to insert data in database
        $this->db->insert('t_hajar', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function jaringan_update($data,$id) {

        // Query to insert data in database
        $this->db->where('id',$id);
        $this->db->update('t_hajar', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }


    public function getJaringanAll($array) {

        $this->db->select("t_jenis.nmjenis jenis,t_kondisi.nmkondisi kondisi,count(*) jml");
        $this->db->from("t_hajar");
        $this->db->join("t_kondisi","t_kondisi.id=t_hajar.kondisi");
        $this->db->join("t_jenis","t_jenis.id=t_hajar.jenis");
        $this->db->where($array);
        $this->db->group_by("t_jenis.nmjenis,t_kondisi.nmkondisi"); 
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }


}