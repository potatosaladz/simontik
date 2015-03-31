<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Petugas_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getPetugas($sess_array) {


        $this->db->select("t_petugas.*,nama,nip,t_pic.id id_pic");
        $this->db->from("t_petugas");
        $this->db->join("t_pic","t_petugas.pic=t_pic.id");
        $this->db->where($sess_array);

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAllPetugas() {

        $query = $this->db->get('t_petugas');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAllPetugasAssign($array) {

        $query = $this->db->get_where('t_petugas',$array);

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function Petugas_insert($data) {

        // Query to insert data in database
        $this->db->insert('t_petugas', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function Petugas_update($data,$id) {

        // Query to insert data in database
        $this->db->where('id',$id);
        $this->db->update('t_petugas', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
}