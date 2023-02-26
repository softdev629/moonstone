<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_settings_by_id($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('settings');
        return $result->row();
    }
    

}
