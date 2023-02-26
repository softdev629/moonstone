<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_users_by_email($email)
    {
        $this->db->where('email',$email);
        $result = $this->db->get('user');
        return $result->row();
    }

    function add_order($tblName,$data){
        $query = $this->db->insert($tblName, $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

}
