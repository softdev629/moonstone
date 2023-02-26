<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buy_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_plates_detail_by_url($id)
    {
        $this->db->select('number_plates.*');
        $this->db->where('id',$id);
        $result = $this->db->get('number_plates');
        return $result->row();
    }
    function product_cart_add($product_id,$qty,$plate_type)
    {   
    
        $this->load->model('Buy_model','buy_modal');
        $this->load->model('Search_model','search_modal');
        $this->load->model('Common_function_model','common');
        $product_detail=$this->search_modal->get_plates_by_details($product_id,$plate_type);
        if($product_detail){
            $tblName='cart';
             if($this->session->userdata('guest')== FALSE && $this->session->userdata('guest')==""){
                $this->session->set_userdata('guest', $this->common->random_string(8)); 
             }
             if($this->session->userdata('user_id')) {
                $this->session->userdata('user_id');
             }
             $guest_id= $this->session->userdata('guest');
             $user_id= $this->session->userdata('user_id');
             $where = "((user_id = '".$user_id."' AND user_id!='' ) OR (guest_id = '".$guest_id."' AND guest_id!='' ))";
             $this->db->where($where);
             $this->db->delete('cart');

            if($qty>0)
            {
                $qty;
            }
            else
            {
                $qty = 1;
            }
         
        
        
        $this->db->select('cart.*');
        $this->db->where('product_id',$product_id);
        $this->db->where('guest_id',$this->session->userdata('guest'));
        $result = $this->db->get('cart');
        $result_row=$result->row();
        
        if(is_array($result_row) && count($result_row)>0){
            $qty=$result_row->items;
            $qty=$qty+1;
        }

        $total_price=($qty)*($product_detail['price']);
        $data = array(
            'product_id' => $product_detail['plate_id'],
            'plates_id' => $product_detail['plate_id'],
            'plate_type' => $product_detail['plate_type'],
            'plates_number' => $product_detail['number'],
            'guest_id' =>$this->session->userdata('guest'),
            'user_id' =>$this->session->userdata('user_id'),
            'product_price' => $product_detail['price'],
            'total_price'=>$total_price,
            'items' =>$qty,
            'status' => 'cart',
            'create_date'=>date('Y-m-d')
            );
        if(is_array($result_row) && count($result_row)>0){
            $this->db->where('guest_id', $this->session->userdata('guest'));
            $this->db->where('product_id', $product_detail['plate_id']);
            $this->db->update('cart', $data);
        }else{
            $query = $this->db->insert($tblName, $data);
            $insert_id = $this->db->insert_id(); 
        }
        
        echo "1";
        }else{
           echo "1";
           //echo "This number plates aleredy register can you try refresh adn check."; 
        }     
        
    }
    

}
