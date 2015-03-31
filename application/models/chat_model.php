<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Chat_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getChat($sess_array) {


        $this->db->select('*');
        $this->db->from('t_chat');
        $this->db->where($sess_array);
        $this->db->order_by('date_created','desc');
        $query =$this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function cekChat($sess_array) {


        $query =$this->db->get_where('t_chat',$sess_array);

        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllChat() {

        $query = $this->db->get('t_chat');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function Chat_insert($data) {

        // Query to insert data in database
        $this->db->insert('t_chat', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function Chat_update($data,$id) {

        // Query to insert data in database
        $this->db->where('id',$id);
        $this->db->update('t_chat', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    //select lower(if(kdkppn='000',concat('kanwil',kdkanwil),concat('kppn',kdkppn))) username,md5(if(kdkppn='000',kdkanwil,kdkppn)) password from ref_treeview;
}