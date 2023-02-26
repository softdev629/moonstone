<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contactus extends CI_Controller {

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
        $this->load->model('Email_settings_model','email_settings');
        $this->load->helper('string');
    }

    public function index() {
			
		$data = array();
        $data['page'] = 'Moonstone';
        $data['currentPage']='6';
        
            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwContactUs',$data);
            $this->load->view('controls/vwFooter',$data);
		
    }

    public function sendmessage() {
        if($this->input->get('firstname')!="")
        {
                $email_settings = $this->email_settings->get_email_settings_content_by_id('1');                
                $tblName = "inquiries";
                $data = array(
                'first_name' => $this->input->get('firstname'),
                'last_name' => $this->input->get('lastname'),
                'email' => $this->input->get('email'),
                'telephone_number' => $this->input->get('phone_number'),
                'message' => $this->input->get('message'),
                'ip_address' => $this->input->ip_address()
                );
                $this->common->insert_record($tblName,$data);
                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                //$this->email->from("support@moonstoneplates.com",$this->input->get('email'));
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                $to_list = array($email_settings->contact_mail, $this->input->get('email'));
                $this->email->to($to_list);
                $this->email->bcc('darren.openshaw@xplore4.com','notifications@moonstoneplates.com');

                $data = array(
                 'first_name'=> $this->input->get('firstname'),
                 'last_name' => $this->input->get('lastname'),
                 'phone'=> $this->input->get('phone_number'),
                 'email' => $this->input->get('email'),
                 'message' => $this->input->get('message'),
                );
                $body = $this->load->view('email_template/contactus_email',$data,TRUE);
                $this->email->subject('Moonstoneplates Contact Enquiry received');
                $this->email->message($body);
                $this->email->send();

                //add notification
                    $name=$this->input->get('firstname')." ".$this->input->get('lastname');
                    $ndata['user_id']=0;
                    $ndata['title']="Contact enquiry received (".$name.").";
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
}

