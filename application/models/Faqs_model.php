<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_faq_by_id($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('faqs');
        return $result->row();
    }

    function get_faqs_list(){  
    
        $this->db->select('id,question,answer');
        $this->db->from('faqs');
        $this->db->where('status',1);
        $this->db->order_by("id");
        $query=$this->db->get();
        $categories=$query->result();
        return $categories;
    }

}
