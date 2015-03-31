<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Status_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getStatus($sess_array) {

        $query = $this->db->get_where('t_status',$sess_array);

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllStatus() {

        $query = $this->db->get('t_status');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}