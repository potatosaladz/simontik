<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Pic_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getPic($sess_array) {

        $query = $this->db->get_where('t_pic',$sess_array);

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllPic() {

        $this->db->select("t_pic.*,ref_treeview.kantor");
        $this->db->from("t_pic");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_pic.unit");
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function Pic_insert($data) {

        // Query to insert data in database
        $this->db->insert('t_pic', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function Pic_update($data,$id) {

        // Query to insert data in database
        $this->db->where('id',$id);
        $this->db->update('t_pic', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
}