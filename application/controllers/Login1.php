<?php

session_start(); //we need to start session in order to access it through CI
defined('BASEPATH') OR exit('No direct script access allowed');
Class Login extends CI_Controller {

public function __construct() {
parent::__construct();
	$this->load->helper('form');
	$this->load->library('form_validation');
	$this->load->library('session');
	$this->load->library('encrypt');
	$this->load->model('Login_model','login');
	$this->load->model('Cart_model','cart');
	$this->load->helper('common_helper');
	$this->load->model('Common_function_model','common');
	$this->load->model('Contents_model','content');
	}

// Show login page




public function email() {

	$this->load->library('email');

	$this->email->from('info@moonstoneplates.com', 'Dan Hill');
	$this->email->to('charlie.pyper84@gmail.om', 'Sarah Millward');
//	$this->email->cc('another@another-example.com');
	//$this->email->bcc('them@their-example.com');

	$this->email->subject('RE: Just thinking');
	$this->email->message('Love you x');

	$this->email->send();

}


// Check for user login process
public function user_login() {

if ($this->session->userdata('is_client_login')) 
{
            redirect('myaccount');
} 
else 
{
		$data['page'] ='Login';
		$data['currentPage']='9';
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		
			 
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Login")
			{
						$this->input->post('email');
						$data['client_user']=$this->login->login_user_active($this->input->post('email'));
						//print_r($data['client_user']->password);exit();
						$user_count=count($data['client_user']);
						
						
						if ($user_count>=1 && ($this->encrypt->decode($data['client_user']->password)==$this->input->post('password'))) 
						 {
							 $this->cart->get_clear_cart_logout($data['client_user']->user_id);
							
							$guest_id= $this->session->userdata('guest');
							$this->session->set_userdata(array(
								'user_id' => $data['client_user']->user_id,
								'user_name' => $data['client_user']->name,
								'user_lastname' => $data['client_user']->lastname,
								'user_email' => $data['client_user']->email,
								'is_client_login' => true
								)
							);
						 		$this->cart->cart_user_id_update();
								if(!empty($_GET["ReturnUrl"]))
								{
									if(!empty($_GET['method']))
									{
										 redirect(''.$_GET['ReturnUrl'].'/'.$_GET['method'].'/'.$_GET['id'].'','refresh');
									}
									else
									{
										redirect(''.$_GET['ReturnUrl'].'','refresh');
									}
								}
								else
								{
									 redirect('myaccount','refresh');
								}
								
							
						 } 
						 else
						 {
					 		$this->session->set_flashdata('error', 'Invalid email address or password.');
						 	redirect('login','refresh');
							
						 }
						
			} 
			else
			{
				
						$this->load->view('controls/vwHeader',$data);
						$this->load->view('vwLogin');
						$this->load->view('controls/vwFooter',$data);
			}

}
}


// Logout from admin page
public function logout() {

// Removing session data
		$this->cart->get_clear_cart_logout($this->session->userdata('user_id'));
	 	$this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_lastname');
        $this->session->unset_userdata('user_email');
		$this->session->unset_userdata('is_client_login');   
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
		$data['message_display'] = 'Successfully Logout';
		
		redirect('login','refresh');
	}

}

?>