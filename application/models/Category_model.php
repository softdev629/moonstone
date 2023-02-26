<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_category_by_id($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('category');
        return $result->row();
    }

    function get_category(){  
    
        $this->db->select('id,category_name');
        $this->db->from('category');
        $this->db->where('status',1);
        $this->db->order_by("id");
        $query=$this->db->get();
        
        $categories=array();
    
        foreach ($query->result() as $category) 
        {
            $categories[$category->id] = $category->category_name;
        }
         return $categories;
    }

    

}
