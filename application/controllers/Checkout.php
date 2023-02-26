<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Checkout extends CI_Controller {

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
        $data['page'] = 'Checkout';
        $data['currentPage']='7';
        $data['content']=$this->content->get_static_page_by_id($data['currentPage']);
        
        $formSubmit = $this->input->post('submit');



       if($formSubmit=="Continue to payment")
        {     

            $recaptcha = $_POST['g-recaptcha-response'];
            $res = $this->reCaptcha($recaptcha);  
            if(!$res['success']){
                redirect('customerinformation','refresh');
            }
            $session_data['name']=$this->input->post('name');
            $session_data['email']=$this->input->post('email');
            $session_data['address']=$this->input->post('address');
            $session_data['country']=$this->input->post('country');
            $session_data['city']=$this->input->post('city');
            $session_data['zip']=$this->input->post('zip');
            $session_data['phone_number']=$this->input->post('phone_number');
            
            $this->session->set_userdata('purchase_details', $session_data);
    
            redirect('payment','refresh');
                
        }else {
            redirect('customerinformation','refresh');
        }
    }

    public function reCaptcha($recaptcha){
      $secret = "6LelX5McAAAAAGu97cPoTQMxwmGI6OzOru7QsuzU";
      $ip = $_SERVER['REMOTE_ADDR'];

      $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
      $url = "https://www.google.com/recaptcha/api/siteverify";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
      $data = curl_exec($ch);
      curl_close($ch);

      return json_decode($data, true);
    }
}

