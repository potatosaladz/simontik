<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Tiket_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

	public function getTiket($array,$limit) {

        $this->db->select("t_tiket.*,t_status.nmstatus,ref_treeview.kantor,t_jenis.nmjenis");
        $this->db->from("t_tiket");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_tiket.unit");
        $this->db->join("t_jenis","t_jenis.id=t_tiket.jenis");
        $this->db->join("t_status","t_status.id=t_tiket.status");
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


    public function getTiketCount($array,$limit) {

        $this->db->select("*");
        $this->db->from("t_tiket");
        $this->db->where($array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function getTiketById($array) {

        $this->db->select("*");
        $this->db->from("t_tiket");
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

    public function tiket_insert($data) {

        // Query to insert data in database
        $this->db->insert('t_tiket', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function tiket_update($data,$id) {

        // Query to insert data in database
        $this->db->where('id',$id);
        $this->db->update('t_tiket', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
}