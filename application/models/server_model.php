<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Server_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getServer($array,$limit) {

        $this->db->select("t_hardware.*,ref_treeview.kantor,t_merk.nmmerk,t_os.nmos,t_kondisi.nmkondisi,t_antivirus.nmstatus");
        $this->db->from("t_hardware");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_hardware.unit");
        $this->db->join("t_merk","t_merk.id=t_hardware.merk");
        $this->db->join("t_os","t_os.id=t_hardware.os");
        $this->db->join("t_kondisi","t_kondisi.id=t_hardware.kondisi");
        $this->db->join("t_antivirus","t_antivirus.id=t_hardware.antivirus");
        $this->db->where($array);
        $this->db->order_by("date_created", "desc"); 
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getServerCount($array) {

        $this->db->select("*");
        $this->db->from("t_hardware");
        $this->db->where($array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }


    public function getServerLain($array,$limit) {

        $this->db->select("t_hardware.*,ref_treeview.kantor,t_merk.nmmerk,t_kondisi.nmkondisi");
        $this->db->from("t_hardware");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_hardware.unit");
        $this->db->join("t_merk","t_merk.id=t_hardware.merk");
        $this->db->join("t_kondisi","t_kondisi.id=t_hardware.kondisi");
        $this->db->where($array);
        $this->db->order_by("date_created", "desc"); 
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getServerFilter($array,$limit) {

        $query ="SELECT `t_hardware`.*, `ref_treeview`.`kantor`, `t_merk`.`nmmerk`, `t_os`.`nmos`, `t_kondisi`.`nmkondisi`, `t_antivirus`.`nmstatus` 
            FROM (`t_hardware`) JOIN `ref_treeview` ON `ref_treeview`.`unit2`=`t_hardware`.`unit` JOIN `t_merk` ON `t_merk`.`id`=`t_hardware`.`merk` JOIN `t_os` 
            ON `t_os`.`id`=`t_hardware`.`os` JOIN `t_kondisi` ON `t_kondisi`.`id`=`t_hardware`.`kondisi` JOIN `t_antivirus` 
            ON `t_antivirus`.`id`=`t_hardware`.`antivirus` 
            WHERE '$array' ORDER BY `date_created` desc";

        print_r($query);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }




    public function getServer2($array,$limit) {

        $this->db->select("t_hardware.*,ref_treeview.kantor,t_merk.nmmerk,t_kondisi.nmkondisi");
        $this->db->from("t_hardware");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_hardware.unit");
        $this->db->join("t_merk","t_merk.id=t_hardware.merk");
        $this->db->join("t_kondisi","t_kondisi.id=t_hardware.kondisi");
        $this->db->where($array);
        $this->db->order_by("date_created", "desc"); 
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getServer3($array,$limit) {

        $this->db->select("t_hardware.*,ref_treeview.kantor,t_merk.nmmerk,t_kondisi.nmkondisi,t_printer.nmprinter");
        $this->db->from("t_hardware");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_hardware.unit");
        $this->db->join("t_merk","t_merk.id=t_hardware.merk");
        $this->db->join("t_kondisi","t_kondisi.id=t_hardware.kondisi");
        $this->db->join("t_printer","t_printer.id=t_hardware.printer");
        $this->db->where($array);
        $this->db->order_by("date_created", "desc"); 
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getServerById($array) {

        $this->db->select("t_hardware.*,ref_treeview.kantor,t_merk.nmmerk,t_os.nmos,t_kondisi.nmkondisi,t_antivirus.nmstatus");
        $this->db->from("t_hardware");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_hardware.unit");
        $this->db->join("t_merk","t_merk.id=t_hardware.merk");
        $this->db->join("t_os","t_os.id=t_hardware.os");
        $this->db->join("t_kondisi","t_kondisi.id=t_hardware.kondisi");
        $this->db->join("t_antivirus","t_antivirus.id=t_hardware.antivirus");
        $this->db->where($array);
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getServerById2($array) {

        $this->db->select("t_hardware.*,ref_treeview.kantor,t_merk.nmmerk,t_kondisi.nmkondisi");
        $this->db->from("t_hardware");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_hardware.unit");
        $this->db->join("t_merk","t_merk.id=t_hardware.merk");
        $this->db->join("t_kondisi","t_kondisi.id=t_hardware.kondisi");
        $this->db->where($array);
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getServerById3($array) {

        $this->db->select("t_hardware.*,ref_treeview.kantor,t_merk.nmmerk,t_kondisi.nmkondisi,t_printer.nmprinter");
        $this->db->from("t_hardware");
        $this->db->join("ref_treeview","ref_treeview.unit2=t_hardware.unit");
        $this->db->join("t_merk","t_merk.id=t_hardware.merk");
        $this->db->join("t_kondisi","t_kondisi.id=t_hardware.kondisi");
        $this->db->join("t_printer","t_printer.id=t_hardware.printer");
        $this->db->where($array);
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function server_insert($data) {

        // Query to insert data in database
        $this->db->insert('t_hardware', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function server_update($data,$id) {

        // Query to insert data in database
        $this->db->where('id',$id);
        $this->db->update('t_hardware', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function getServerAll($array) {

        $this->db->select("t_jenis.nmjenis jenis,t_kondisi.nmkondisi kondisi,count(*) jml");
        $this->db->from("t_hardware");
        $this->db->join("t_kondisi","t_kondisi.id=t_hardware.kondisi");
        $this->db->join("t_jenis","t_jenis.id=t_hardware.jenis");
        $this->db->where($array);
        $this->db->group_by("t_jenis.nmjenis,t_kondisi.nmkondisi"); 
        // $this->db->limit($limit);
        // $query = $this->db->get_where('t_hardware',$array);
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}