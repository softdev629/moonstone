<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StaticPages_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_static_page_by_id($id)
    {
        $this->db->where('content_id',$id);
        $result = $this->db->get('content');
        return $result->row();
    }
    

}
