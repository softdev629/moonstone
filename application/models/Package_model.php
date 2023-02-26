<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Package_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_package_by_id($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('package');
        return $result->row();
    }

    function get_package_list()
    {
        $this->db->select('*');
        $this->db->from('package');
        $this->db->where('status',1);
        $this->db->order_by("id");
        $query=$this->db->get();
        $package=$query->result();
        return $package;
    }
}
