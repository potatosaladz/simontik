<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Berita_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getBerita($sess_array) {


        $query =$this->db->get_where('t_berita',$sess_array);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function cekBerita($sess_array) {


        $query =$this->db->get_where('t_berita',$sess_array);

        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllBerita() {

        //$query = $this->db->get('t_berita');

        $this->db->from('t_berita');
        $this->db->where(array('hapus' => 0));
        $this->db->order_by("date_created", "desc");
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getBeritaUtama() {

        //$query = $this->db->get('t_berita');

        $this->db->from('t_berita');
        $this->db->where(array('hapus' => 0));
        $this->db->order_by("date_created", "desc");
                $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function Berita_insert($data) {

        // Query to insert data in database
        $this->db->insert('t_berita', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function Berita_update($data,$id) {

        // Query to insert data in database
        $this->db->where('id',$id);
        $this->db->update('t_berita', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    //select lower(if(kdkppn='000',concat('kanwil',kdkanwil),concat('kppn',kdkppn))) username,md5(if(kdkppn='000',kdkanwil,kdkppn)) password from ref_treeview;
}