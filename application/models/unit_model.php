<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Unit_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getUnit($sess_array) {

        $query = $this->db->get_where('ref_treeview',$sess_array);

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getUnit2($sess_array) {

        $query = $this->db->get_where('ref_treeview',$sess_array);

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getUnit3($sess_array) {

        $query = $this->db->query("select a.id,a.unit2,a.kdkanwil,a.kdkppn,a.kantor,b.kantor nmkanwil from ref_treeview a left join ref_treeview b on substr(a.unit2,1,13)=b.unit2 where a.unit2=".$sess_array);
        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }


    public function getUnitAll() {

        $query = $this->db->get('ref_treeview');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }


    public function getAllKPPN(){

        // $condition=" length(unit2)=15";

        // $this->db->select('length(unit2)');
        // $this->db->from('ref_treeview');
        // $this->db->where($condition);
        $result=$this->db->query("SELECT * FROM ref_treeview where length(unit2)=15 order by kdkppn asc");

        if ($result->num_rows() >= 1) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getKppnByKanwil($unit){

        //$condition=" having substr(unit2,1,".strlen($unit).")='$unit'";

        // $this->db->select('*');
        // $this->db->from('ref_treeview a');
        // $this->db->where($condition);
        $result=$this->db->query("SELECT * FROM ref_treeview where substr(unit2,1,".strlen($unit).")='$unit' order by kdkanwil asc");

        if ($result->num_rows() >= 1) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function getEs2(){

        //$condition=" having substr(unit2,1,".strlen($unit).")='$unit'";

        // $this->db->select('*');
        // $this->db->from('ref_treeview a');
        // $this->db->where($condition);
        $result=$this->db->query("SELECT * FROM ref_treeview where length(unit2)=13");

        if ($result->num_rows() >= 1) {
            return $result->result_array();
        } else {
            return false;
        }
    }
    
}