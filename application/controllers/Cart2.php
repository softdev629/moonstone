<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('Common_function_model','common');
		$this->load->model('Cart_model','cart');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['page'] ='Cart';
		$data['currentPage']='16';
		$data['cart_view']=$this->cart->get_cart_list();
		$this->load->view('controls/vwHeader',$data);
		$this->load->view('vwCart',$data);
		$this->load->view('controls/vwFooter',$data);
		
    }
	public function cart_checkout(){
		$formSubmit = $this->input->post('Submit');
		
		if($formSubmit=="Checkout")
		{
			echo $this->cart->cart_user_id_update();
			 if (!$this->session->userdata('is_client_login')) {
				redirect('login?ReturnUrl=checkout');
			}else {
				redirect('checkout');
			}
		}
	}									
	
	public function count_cart_val(){
		
		echo get_cart_count();
		
		}
	public function delete_cart(){
		
		 echo $this->cart->get_cart_delete($this->input->get_post('id'));
		 
		}
	public function clear_cart(){
		
		echo $this->cart->get_clear_cart();
		
		}
	public function update_cart(){
		
		echo $this->cart->get_update_cart($this->input->get_post('id'),$this->input->get_post('qty'));
		
		}
	
}

