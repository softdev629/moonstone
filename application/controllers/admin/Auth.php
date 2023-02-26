<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('select_model');
        $this->load->model('update_model');
        $this->load->model('Common_function_model','common');
        $this->load->helper('string');
        $this->load->library('encryption');
    }

    public function index() {
        if ($this->session->userdata('is_admin_login')) {
            redirect('admin/dashboard');
        } else {
        $this->load->view('admin/vwLogin');
        }
    }

    public function login() {
        if ($this->session->userdata('is_admin_login')) {
            redirect('admin/dashboard');
        } else {
        $this->load->view('admin/vwLogin');
        }
    }

    // Check for user login process
    public function user_login_process() {

        if ($this->session->userdata('is_admin_login')) {
            redirect('admin/dashboard');
        } else {
            $this->form_validation->set_rules('username', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            
            if ($this->form_validation->run() == FALSE){
                $this->load->view('admin/vwLogin');
            }else{
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                
                $condi = "email='".$username."' and password='".md5($password)."'";
                $user_data = $this->select_model->get_admin($condi);
                if (is_array($user_data) && count($user_data) > 0) {
                    $session_data = array(
                        'username' => $user_data[0]['username'],
                        'email' => $user_data[0]['email'],
                        'first_name' => $user_data[0]['firstname'],
                        'last_name' => $user_data[0]['lastname'],
                        'user_type' => $user_data[0]['user_type'],
                        'user_id' => $user_data[0]['id'],
                        'user_ip' => $_SERVER['REMOTE_ADDR'],
                    );
                    //set last login date
                    $data = array(
                        'last_login' => date('Y-m-d H:i:s'),
                        'ip_address' => $_SERVER['REMOTE_ADDR'],
                    );
                    $update_condi = 'id = "'.$user_data[0]['id'].'"';
                    $this->update_model->update_admin($data, $update_condi);
                    // Add user data in session
                    $this->session->set_userdata('is_admin_login', $session_data);
                    redirect('admin/dashboard');
                } else {
                   $err['error'] = 'Sorry! Invalid username or password.';
                   $this->load->view('admin/vwLogin', $err);
                }
            }
        }
    }

    public function forget_password() {
        $this->load->view('forget_password');
    }

    public function send_mail() {
        $from_email = "your@example.com";
        $to_email = $this->input->post('email');
        $condi = "email = '".$to_email."'";
        $result = $this->select_model->get_admin($condi);
        if ($result) {
            $user_email = $result[0]['email'];
            $user_pass = $result[0]['password'];
            if ((!strcmp($to_email, $user_email))) {
                //Load email library
                $this->load->library('email');

                $this->email->from($from_email, 'Your Name');
                $this->email->to($to_email);
                $this->email->subject('Password');
                $txt = "Your password is $user_pass .";
                $this->email->message($txt);

                //Send mail
                if ($this->email->send()) {
                    $this->session->set_flashdata("email_sent", "Email sent successfully.");
                } else {

                    $this->session->set_flashdata("email_sent", "If that email exists you will receive an email shortly");
                }
            } else {

                $this->session->set_flashdata("email_sent", "If that email exists you will receive an email shortly");
            }
        } else {

            $this->session->set_flashdata("email_sent", "If that email exists you will receive an email shortly");
        }
        redirect("forget_password");
    }

    public function logout() {
        $this->session->unset_userdata('is_admin_login'); 
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('admin/login', 'refresh');
    }

    public function forgot_password_action() {
   

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if ($this->form_validation->run() ==FALSE) {
      $this->load->view('admin/vwForgotPassword');
    }
    else {
      $username = $this->input->post('email');
      $condi = "email='" . $username . "'";
      $user_data = $this->select_model->get_admin($condi);
      if (is_array($user_data)&&count($user_data)>0) {        
        $this->load->config('email');
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $mail_message='Dear '.$user_data[0]['firstname'].','. "<br>";
        $reset_link = base_url() . 'admin/reset-password/' . base64_encode($username);
        $mail_message.='Thanks for contacting regarding to forgot password,<br><br> Please rest your password by below link <br><br>'.$reset_link.'</b>'."\r\n";
        $mail_message.='<br><br><br>Please Update your password.';
        $mail_message.='<br><br><br>Thanks & Regards';
        $mail_message.='<br>Moonstone plates';
        $this->email->set_mailtype("html");
        $from = $this->config->item('smtp_user');
        $this->email->from($from);
        $this->email->to($username);
        $this->email->subject('Reset password link');
        $this->email->message($mail_message);
        if ($this->email->send()) {
            $err['success'] = 'Reset password link send to your email id.';
        } else {
           $err['error'] = "We can't send reset password link to user. Please contect site administrator.";
        }

      }
      else {
        $err['error'] = 'Sorry! Invalid username.';
      }
      $this->load->view('admin/vwForgotPassword', $err);
    }    
    
  }

  public function reset_password($id = '') {
    $condi = "email='" . base64_decode($id) . "'";
    $user_data = $this->select_model->get_admin($condi);
    if (is_array($user_data)&&count($user_data)>0) {
      $data = array();
      $data['token'] = $id;
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->set_rules('conf_password', 'Confirm password', 'required');
      if($this->form_validation->run() == FALSE){
        $this->load->view('admin/vwResetPassword', $data);
      } else {
        //Create Data Array
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('conf_password');
        if($password == $confirm_password) {
          $update_array = array(
            'password' => md5($password),
          );
          $condi = "email='" . base64_decode($id) . "' and id = '" . $user_data[0]['id'] . "'";
          $this->update_model->update_admin($update_array, $condi);
          $data['success'] = 'Password reset successfully. Please go login page for admin login.';
          $this->load->view('admin/vwResetPassword', $data);
        }
        else {
          $data['error'] = 'Sorry! Confirm password not match.';
          $this->load->view('admin/vwResetPassword', $data);
        }
      }

    }
    else {
      redirect('/admin', 'refresh');
    }
  }

  public function forgot_password() {
        $this->load->view('admin/vwForgotPassword');
    }

}
