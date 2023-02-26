<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sell extends CI_Controller {

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
        $this->load->helper('string');
        $this->load->model('Package_model', 'package_model');
        $this->load->model('Email_settings_model','email_settings');
    }

    public function index() {
			
		$data = array();
        $data['page'] = 'Moonstone';
        $data['currentPage']='3';
        $data['packages']=$this->package_model->get_package_list();
        $data['first_name'] = $this->session->userdata('first_name') ?? '';
        $data['last_name'] = $this->session->userdata('last_name') ?? '';
        $data['email'] = $this->session->userdata('email') ?? '';
        $this->load->view('controls/vwHeader',$data);
        $this->load->view('vwSell',$data);
        $this->load->view('controls/vwFooter',$data);
		
    }

    public function sell_new() {
            
        $data = array();
        $data['page'] = 'Moonstone';
        $data['currentPage']='3';

        $this->load->view('controls/vwHeader',$data);
        $this->load->view('vwSell',$data);
        $this->load->view('controls/vwFooter',$data);
        
    }

    public function sell_register() {
        if($this->input->get('firstname')!="")
        {
                $username = $this->input->get('email');
                $condi = "email='" . $username . "'";
                $user_data = $this->select_model->get_users($condi);

                if (is_array($user_data)&&count($user_data)>0) {
                    $user_id=$user_data[0]['user_id'];
                }else{
                    $data = array(
                    'name' => $this->input->get('firstname'),
                    'lastname' => $this->input->get('lastname'),
                    'phone_number' => $this->input->get('phone_number'),
                    'email' => $this->input->get('email'),
                    'is_active' => '1',
                    'create_date' => date('Y-m-d'),
                    );
                    $tblName = "user";
                    $user_id = $this->common->insert_record($tblName, $data);

                      $this->load->config('email');
                      $this->load->library('email');
                      $this->email->set_newline("\r\n");
                      $reset_link = base_url() . 'reset-password/' . base64_encode($username);

                      $mail_message='Dear '.$user_data[0]['name'].','. "<br>";
                      $mail_message.="Thanks for contacting regarding to seller account please set your password,<br><br> Please set your password with the link below. <br><br>".$reset_link."</b>"."\r\n";
                      $mail_message.="<br><br><br>Thanks & Regards";
                      $mail_message.="<br>Moonstone plates";
                      $mail_message.="<br><br><br>If this Wasn't you ? Please get in contact with us <a href='mailto:info@moonstoneplates.com'>info@moonstoneplates.com</a>";
                      $this->email->set_mailtype("html");
                      $from = $this->config->item('smtp_user');
                      $this->email->from($from);
                      $this->email->to($username);
                      $this->email->subject('Seller account set password link');
                      $this->email->message($mail_message);
                }
                
                $tblName = "seller_register";
                $data = array(
                'user_id' => $user_id,
                'first_name' => $this->input->get('firstname'),
                'last_name' => $this->input->get('lastname'),
                'email' => $this->input->get('email'),
                'telephone_number' => $this->input->get('phone_number'),
                'numberplate' => $this->input->get('numberplate'),
                'note' => !empty($this->input->get('note')) ? $this->input->get('note') : ''
                );
                $this->common->insert_record($tblName,$data);
                $email_settings = $this->email_settings->get_email_settings_content_by_id('1'); 
                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                $to_list = array($email_settings->enquire_mail, $this->input->get('email'));
                $this->email->to($to_list);
        
                $data = array(
                 'first_name'=> $this->input->get('firstname'),
                 'last_name' => $this->input->get('lastname'),
                 'phone'=> $this->input->get('phone_number'),
                 'email' => $this->input->get('email'),
                 'message' => $this->input->get('message'),
                 'numberplate' => $this->input->get('numberplate'),
                 'note' => !empty($this->input->get('note')) ? $this->input->get('note') : ''
                );
                $body = $this->load->view('email_template/contactus_email',$data,TRUE);
                $this->email->subject('Moonstoneplates registration received');
                $this->email->message($body);
                $this->email->send();

                //add notification
                    $user_id = !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
                    $ndata['user_id']=$user_id;
                    $ndata['title']="New sell request received for this plate (".$this->input->get('numberplate').").";
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

                echo"success";
                
        }
    }

    public function history() {
        if ($this->session->userdata('is_client_login'))
        {   $client_login=$this->session->userdata('client_login');
            $data = array();
            $data['page'] = 'Sell History';
            $data['currentPage']='12';
            $data['content']=$this->content->get_static_page_by_id($data['currentPage']);
            $condition = "seller_register.user_id='".$client_login['user_id']."'";
            $join_arr[0]['table_name']="user";
            $join_arr[0]['cond']="user.user_id = seller_register.user_id";
            $join_arr[0]['type']="left";
            $field = "";
            $data['order_list'] = $this->select_model->get_seller_register($condition,$field,$join_arr);
            $data['client_login'] = $client_login;

            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwSellList',$data);
            $this->load->view('controls/vwFooter',$data);
        }else{
            redirect('buy','refresh');
        }
    }

    public function package_enquiry_check(){
        
            $status = 0;
            $msg = "Something went wrong.";
            $formSubmit = $this->input->post('submit');
            
            $this->form_validation->set_rules('package_id', 'Package', 'required');
            $this->form_validation->set_rules('promotion_number', 'Number', 'required');
            $this->form_validation->set_rules('promotion_name', 'Name', 'required');
            $this->form_validation->set_rules('promotion_email', 'Email', 'required');
            $this->form_validation->set_rules('promotion_contact_number', 'Contact Number', 'required');
            //$this->form_validation->set_rules('promotion_message', 'Message', 'required');

            if ($this->form_validation->run() == FALSE){

                $errors = validation_errors();
                $status = 0;
                $msg = $errors;

            }else{

                $package_id = $this->input->post('package_id');
                $promotion_number = $this->input->post('promotion_number');
                $promotion_name = $this->input->post('promotion_name');
                $promotion_email = $this->input->post('promotion_email');
                $promotion_contact_number = $this->input->post('promotion_contact_number');
                //$promotion_message = $this->input->post('promotion_message');
                $user_id= 0;
                $promotion_message="";
                $data = array(
                    'package_id' => $package_id,
                    'promotion_number' => $promotion_number,
                    'promotion_name' => $promotion_name,
                    'promotion_email' => $promotion_email,
                    'promotion_contact_number' => $promotion_contact_number,
                    'promotion_message' => $promotion_message
                );
                $tblName = "package_inquiry";

                $inser_id = $this->common->insert_record($tblName, $data);
                $email_settings = $this->email_settings->get_email_settings_content_by_id('1');
                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                //$this->email->from("support@moonstoneplates.com",$this->input->get('email'));
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                //$to_list = array($email_settings->enquiries_mail, $promotion_email);
                $this->email->to($email_settings->enquiries_mail);
        
                $data = array(
                 'package_id'=> $this->input->get('package_id'),
                 'promotion_name'=> $this->input->get('promotion_name'),
                 'promotion_number'=> $this->input->get('promotion_number'),
                 'phone'=> $this->input->get('promotion_contact_number'),
                 'email' => $this->input->get('promotion_email'),
                 'message' => $this->input->get('promotion_message'),
                );
                $body = 'Hi Admin, <br> A new package enquiry received.';
                $this->email->subject('Moonstone package enquiry received');
                $this->email->message($body);
                $this->email->send();
                $status = 1;
                $msg = "Send message successfully.";

                //add notification
                    $user_id = !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
                    $ndata['user_id']=$user_id;
                    $ndata['title']="New package enquiry received (".$this->input->get('promotion_number').").";
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
                
            }
            echo json_encode(['status' => $status, 'msg' => $msg]);
        
    }
}

