<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buy_page_content_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_buy_page_content_by_id($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('buy_page_content');
        return $result->row();
    }
    

}
