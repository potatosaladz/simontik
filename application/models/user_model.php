<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class User_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getUser($sess_array) {


        $query =$this->db->get_where('t_user',$sess_array);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function cekUser($sess_array) {


        $query =$this->db->get_where('t_user',$sess_array);

        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function cekUserPass($sess_array) {


        $query =$this->db->get_where('t_user',$sess_array);

        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllUser() {

        $query = $this->db->get('t_user');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function User_insert($data) {

        // Query to insert data in database
        $this->db->insert('t_user', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function User_update($data,$id) {

        // Query to insert data in database
        $this->db->where('id',$id);
        $this->db->update('t_user', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    //select lower(if(kdkppn='000',concat('kanwil',kdkanwil),concat('kppn',kdkppn))) username,md5(if(kdkppn='000',kdkanwil,kdkppn)) password from ref_treeview;
}