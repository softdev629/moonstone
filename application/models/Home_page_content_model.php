<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_page_content_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_home_page_content_by_id($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('home_page_content');
        return $result->row();
    }
    

}
