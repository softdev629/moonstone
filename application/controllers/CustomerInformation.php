<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CustomerInformation extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('select_model');
        $this->load->model('update_model');
        $this->load->model('Common_function_model','common');
        $this->load->model('StaticPages_model','content');
        $this->load->model('Cart_model','cart');
        $this->load->helper('string');
        $this->load->helper('common_helper');
    }

    public function index() {

            $data = array();
            $data['page'] = 'Customer Information';
            $data['currentPage']='7';
            $data['content']=$this->content->get_static_page_by_id($data['currentPage']);
            $data['cart_view']=$this->cart->get_cart_list();
            $data['totle_items']=$this->cart->get_cart_totle_items();
            $data['is_client_login']=$this->session->userdata('is_client_login');
            $data['client_details']=array();
            if($this->session->userdata('is_client_login')) { 
            $data['client_details']=$this->session->userdata('client_login');
            }
            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwCustomerInformation',$data);
            $this->load->view('controls/vwFooter',$data);

		
    }
}

