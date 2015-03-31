<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Bmn_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getBmn() {

        $this->db->select("tdata_bmn_now.*,tref_kondisi.*,tref_kat_brg.*");
        $this->db->from("tdata_bmn_now");
        $this->db->join('tref_kondisi','tdata_bmn_now.kondisi_akhir=tref_kondisi.kd_kondisi');
         $this->db->join('tref_kat_brg','tdata_bmn_now.kd_kat_brg=tref_kat_brg.kd_kat_brg');
        //$this->db->where($array);
        //$this->db->order_by("date_created", "desc"); 
         $this->db->limit(25);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}