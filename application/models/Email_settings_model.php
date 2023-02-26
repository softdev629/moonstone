<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email_settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_email_settings_content_by_id($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('email_settings');
        return $result->row();
    }
    

}
