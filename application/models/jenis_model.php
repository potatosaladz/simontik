<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Jenis_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getJenis($sess_array) {

        $this->db->select('*');
        $this->db->where($sess_array);
        $query = $this->db->get('t_jenis');

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAllJenis() {

        $query = $this->db->get('t_jenis');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}