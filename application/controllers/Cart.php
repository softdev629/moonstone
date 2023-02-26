<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->helper('common_helper');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('select_model');
        $this->load->model('update_model');
        $this->load->model('Common_function_model','common');
        $this->load->model('StaticPages_model','content');
        $this->load->model('Cart_model','cart');
        $this->load->helper('string');
    }

    public function index() {

            $data = array();
            $data['page'] = 'Cart';
            $data['currentPage']='7';
            $data['content']=$this->content->get_static_page_by_id($data['currentPage']);
            $data['cart_view']=$this->cart->get_cart_list();
            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwCart',$data);
            $this->load->view('controls/vwFooter',$data);

		
    }
    public function update_cart(){
        
        echo $this->cart->get_update_cart($this->input->get_post('id'),$this->input->get_post('qty'));
        
    }
    public function update_summary_cart(){
        
        echo $this->cart->get_cart_summary($this->input->get_post('id'));
        
    }
    public function delete_cart(){
     $cart_data=$this->cart->get_cart_delete($this->input->get_post('id'));
     $count_cart= get_cart_count();
     $data['cart_data']=$cart_data;
     $data['count_cart']=$count_cart;
     echo json_encode($data);
    }
}

