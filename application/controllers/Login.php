<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $this->load->model('Newsletter_subscription_model','newslatter');
        $this->load->model('Home_page_content_model','home_page_content');
        $this->load->model('StaticPages_model','content');
        $this->load->helper('string');
    }

    public function user_login() {

  		if ($this->session->userdata('is_client_login')) 
  		{
  		    $status = 0;
  		    $msg="Already login please refresh the page.";
  		    echo json_encode(['status' => $status, 'msg' => $msg]);
  		} 
  		else 
  		{
  			$status = 0;
  			$msg = "The credentials you have entered are invalid.";
  			$formSubmit = $this->input->post('submit');
  			
      		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      		$this->form_validation->set_rules('password', 'Password', 'required');

      		if ($this->form_validation->run() == FALSE){
  	            $errors = validation_errors();
  	            $status = 0;
  				      $msg = $errors;
  	      }else{

  	        	  $username = $this->input->post('email');
              	$password = $this->input->post('password');
              	$condi = "email='".$username."' and password='".md5($password)."'";
              	$user_data = $this->select_model->get_users($condi);
              	if (is_array($user_data) && count($user_data) > 0) {
              		  $user_id=$user_data[0]['user_id'];
  		              $login_data['user_id']=$user_data[0]['user_id'];
  		              $login_data['name']=$user_data[0]['name'];
  		              $login_data['email']=$user_data[0]['email'];
  		              $login_data['address']=$user_data[0]['address'];
  		              $login_data['country']=$user_data[0]['country'];
  		              $login_data['city']=$user_data[0]['city'];
  		              $login_data['zip']=$user_data[0]['zip'];
  		              $login_data['phone_number']=$user_data[0]['phone_number'];
  		              $login_data['is_client_login']=1;
  		              $this->session->set_userdata('client_login', $login_data);
  		              $this->session->set_userdata('is_client_login',1);
  		              $this->session->set_userdata('user_id',$user_id);
                    $this->session->set_userdata('first_name',$user_data[0]['name']);
                    $this->session->set_userdata('last_name',$user_data[0]['lastname']);
                    $this->session->set_userdata('email',$user_data[0]['email']);
  		              $status = 1;
  					        $msg = "Login successfully";

                    //add notification
                    // $data['user_id']=$user_id;
                    // $data['title']="User (".$user_data[0]['name'].") login successfully.";
                    // $data['is_read']=0;
                    // $this->common->add_notification_record($data);

                    // $this->load->config('email');
                    // $this->load->library('email');
                    // $this->email->set_newline("\r\n");
                    // $mail_message='Dear Sir,'. "<br>";
                    // $mail_message.="".$data['title']."</b>"."\r\n";
                    // $mail_message.="<br><br><br>Thanks & Regards";
                    // $mail_message.="<br>Moonstone plates";
                    // $this->email->set_mailtype("html");
                    // $from = $this->config->item('smtp_user');
                    // $this->email->from($from);
                    // $this->email->to("notifications@moonstoneplates.com");
                    // $this->email->subject($data['title']);
                    // $this->email->message($mail_message);
                    // $this->email->send();
                    //end notification
              	}

  	        }
  			    echo json_encode(['status' => $status, 'msg' => $msg]);
  		}
  	}

  	public function logout() {

          $this->session->unset_userdata('is_client_login'); 
          $this->session->unset_userdata('client_login');
          $this->session->unset_userdata('user_id');
          $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
          $this->output->set_header("Pragma: no-cache");

          redirect('buy', 'refresh');
      }

      public function forgot_password() {
      $status = 0;
      $msg = "The credentials you have entered are invalid.";
      $formSubmit = $this->input->post('submit');

      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

      if ($this->form_validation->run() ==FALSE) {

        $errors = validation_errors();
        $status = 0;
        $msg = $errors;
      }
      else {
        $username = $this->input->post('email');
        $condi = "email='" . $username . "'";
        $user_data = $this->select_model->get_users($condi);
        if (is_array($user_data)&&count($user_data)>0) {        
          $this->load->config('email');
          $this->load->library('email');
          $this->email->set_newline("\r\n");
          $reset_link = base_url() . 'reset-password/' . base64_encode($username);

          $mail_message='Dear '.$user_data[0]['name'].','. "<br>";
          $mail_message.="Thanks for contacting regarding to reset your password,<br><br> Please reset your password with the link below. <br><br>".$reset_link."</b>"."\r\n";
          $mail_message.="<br><br><br>Thanks & Regards";
          $mail_message.="<br>Moonstone plates";
          $mail_message.="<br><br><br>If this Wasn't you ? Please get in contact with us <a href='mailto:info@moonstoneplates.com'>info@moonstoneplates.com</a>";
          $this->email->set_mailtype("html");
          $from = $this->config->item('smtp_user');
          $this->email->from($from);
          $this->email->to($username);
          $this->email->subject('Reset password link');
          $this->email->message($mail_message);
          if ($this->email->send()) {

              //add notification
                $ndata['user_id']=$user_data[0]['user_id'];
                $ndata['title']="User (".$user_data[0]['name'].") password reset request created.";
                $ndata['is_read']=0;
                $this->common->add_notification_record($ndata);

                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $mail_message='Dear Sir,'. "<br>";
                $mail_message.="".$ndata['title']."</b>"."\r\n";
                $mail_message.="<br><br><br>Thanks & Regards";
                $mail_message.="<br>Moonstone plates";
                $this->email->set_mailtype("html");
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                $this->email->to("notifications@moonstoneplates.com");
                $this->email->subject($ndata['title']);
                $this->email->message($mail_message);
                $this->email->send();
              //end notification

              $status = 1;
              $msg = 'Reset password link send to your email id.';
          } else {
             $status = 0;
             $msg = "We can't send reset password link to user. Please contect site administrator.";
          }

        }
      }
      echo json_encode(['status' => $status, 'msg' => $msg]);
    }

  public function reset_password($id = '') {
    $username = $this->input->post('email');
    $condi = "email='" . base64_decode($id) . "'";
    $user_data = $this->select_model->get_users($condi);
    if (is_array($user_data)&&count($user_data)>0) {
      $data = array();
      $data['page'] = 'Moonstone';
      $data['currentPage']='4';
      $data['token'] = $id;
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->set_rules('conf_password', 'Confirm password', 'required');
      if($this->form_validation->run() == FALSE){

      } else {
        //Create Data Array
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('conf_password');
        if($password == $confirm_password) {
          $update_array = array(
            'password' => md5($password),
          );
          $condi = "email='" . base64_decode($id) . "' and user_id = '" . $user_data[0]['user_id'] . "'";
          $this->update_model->update_user($update_array, $condi);

          //add notification
            $ndata['user_id']=$user_data[0]['user_id'];
            $ndata['title']="User (".$user_data[0]['name'].") password reset successfully.";
            $ndata['is_read']=0;
            $this->common->add_notification_record($ndata);

            $this->load->config('email');
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $mail_message='Dear Sir,'. "<br>";
            $mail_message.="".$ndata['title']."</b>"."\r\n";
            $mail_message.="<br><br><br>Thanks & Regards";
            $mail_message.="<br>Moonstone plates";
            $this->email->set_mailtype("html");
            $from = $this->config->item('smtp_user');
            $this->email->from($from);
            $this->email->to("notifications@moonstoneplates.com");
            $this->email->subject($ndata['title']);
            $this->email->message($mail_message);
            $this->email->send();
          //end notification

          //Create Message
          $this->session->set_flashdata('success', 'Password reset successfully');
          redirect('reset-password/' . $id, 'refresh');
        }
        else {
          $this->session->set_flashdata('error', 'Confirm password not match');
          redirect('reset-password/' . $id, 'refresh');
        }
      }
      $this->load->view('controls/vwHeader',$data);
      $this->load->view('vwResetPassword',$data);
      $this->load->view('controls/vwFooter',$data);
    }
    else {
      redirect('/', 'refresh');
    }
  }

    public function user_register() {
      $status = 0;
      $msg = "The credentials you have entered are invalid.";
      $formSubmit = $this->input->post('submit');

      $this->form_validation->set_rules('name', 'name', 'required');
      $this->form_validation->set_rules('lastname', 'lastname', 'required');
      $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
      $this->form_validation->set_rules('address', 'address', 'required');
      $this->form_validation->set_rules('country', 'country', 'required');
      $this->form_validation->set_rules('city', 'city', 'required');
      $this->form_validation->set_rules('zip', 'zip', 'required');
      $this->form_validation->set_rules('email', 'email', 'required|valid_email');
      $this->form_validation->set_rules('password', 'password', 'required');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

      if ($this->form_validation->run()==FALSE) {
        $errors = validation_errors();
        $status = 0;
        $msg = $errors;
      }
      else 
      {
        if($this->input->post('password') != $this->input->post('confirm_password')) {
          $status = 0;
          $msg = "Password and confirm password not matched.";
        }
        else {
          $username = $this->input->post('email');
          $condi = "email='" . $username . "'";
          $user_data = $this->select_model->get_users($condi);
          if (is_array($user_data)&&count($user_data)>0) {
             $status = 0;
             $msg = "Email address already exist. Please try with different email.";
          }
          else {    
            $full_name=$this->input->post('name')." ".$this->input->post('lastname');
            $data = array(
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'phone_number' => $this->input->post('phone_number'),
                'address' => $this->input->post('address'),
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'zip' => $this->input->post('zip'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'is_active' => '1',
                'create_date' => date('Y-m-d'),
            );
            $tblName = "user";
            $inser_id = $this->common->insert_record($tblName, $data);
            if ($inser_id) {
                $status = 1;
                $msg = 'User has been added successfully.';

                //add notification
                  $ndata['user_id']=$inser_id;
                  $ndata['title']="New User (".$full_name.") created.";
                  $ndata['is_read']=0;
                  $this->common->add_notification_record($ndata);

                  $this->load->config('email');
                  $this->load->library('email');
                  $this->email->set_newline("\r\n");
                  $mail_message='Dear Sir,'. "<br>";
                  $mail_message.="".$ndata['title']."</b>"."\r\n";
                  $mail_message.="<br><br><br>Thanks & Regards";
                  $mail_message.="<br>Moonstone plates";
                  $this->email->set_mailtype("html");
                  $from = $this->config->item('smtp_user');
                  $this->email->from($from);
                  $this->email->to("notifications@moonstoneplates.com");
                  $this->email->subject($ndata['title']);
                  $this->email->message($mail_message);
                  $this->email->send();
                //end notification

            } else {
               $status = 0;
               $msg = "The credentials you have entered are invalid.";
            }

          }
        }
      }
      echo json_encode(['status' => $status, 'msg' => $msg]);
  }
}

