<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Merk_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getMerk($sess_array) {

        $query = $this->db->get_where('t_merk',$sess_array);

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAllMerk() {

        $query = $this->db->get('t_merk');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }public function Merk_insert($data) {

        // Query to insert data in database
        $this->db->insert('t_merk', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function merk_update($data,$id) {

        // Query to insert data in database
        $this->db->where('id',$id);
        $this->db->update('t_merk', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
	
	
}