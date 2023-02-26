<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FeaturedPlates_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_featured_plates_by_id($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('featured_plates');
        return $result->row();
    }

    function get_featured_plates_by_category_id($category_id){  
    
        $this->db->select('*');
        $this->db->from('featured_plates');
        $this->db->where('category_id',$category_id);
        $this->db->where('status',1);
        $this->db->order_by("id");
        $query=$this->db->get();
        $categories=$query->result();
        return $categories;
    }
}
