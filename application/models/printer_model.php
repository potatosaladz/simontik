<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Printer_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getPrinter($sess_array) {

        $query = $this->db->get_where('t_printer',$sess_array);

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllPrinter() {

        $query = $this->db->get('t_printer');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}