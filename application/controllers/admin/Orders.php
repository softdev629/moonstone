<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders extends CI_Controller {

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
        $this->load->helper('string');
    }

    public function index() {
			
		$data = array();
        $data['page'] = 'Orders';
        if (isset($this->session->userdata['is_admin_login'])) {
            $condition = "";
            $join_arr[0]['table_name']="user";
            $join_arr[0]['cond']="user.user_id = order.user_id";
            $join_arr[0]['type']="left";
            $join_arr[1]['table_name']="order_item";
            $join_arr[1]['cond']="order_item.order_id = order.order_id";
            $join_arr[1]['type']="left";
            $field = "";
            $data['order_list'] = $this->select_model->get_order_list($condition,$field,$join_arr);
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManageOrder',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);
            
         } else {
             redirect('/admin/login', 'refresh');
        }
		
    }
     public function change_order_status(){
        $status=1;
        $msg="Ok";
        $val=$this->input->get('val');
        $id=$this->input->get('id');
        $data = array('status' => $val);
        $tblName = "order";
        $this->common->update_record("order_id", $id, $tblName, $data);

        $order_details = $this->select_model->get_myorder_detials($order_id);
        $user_email=$order_details->email;
        if($val==2){
                //send processing email
                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                //$this->email->from("support@moonstoneplates.com",$this->input->get('email'));
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                $to_list = array($email_settings->contact_mail, $this->input->get('email'));
                $this->email->to($user_email);

                $data = array(
                 'first_name'=> $order_details->name,
                 'last_name' => $order_details->lastname,
                 'order_number' => $order_details->order_id,
                 'plate_number' => $order_details->plates_number,
                );
                $body = $this->load->view('email_template/processed',$data,TRUE);
                $this->email->subject('Order has been processing');
                $this->email->message($body);
                $this->email->send();

                //add notification
                    $name=$this->input->get('firstname')." ".$this->input->get('lastname');
                    $ndata['user_id']=$order_details->user_id;
                    $ndata['title']="Order has been processing (".$id.").";
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

        }else if($val==3){
            //send dispatched email
            $this->load->config('email');
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $from = $this->config->item('smtp_user');
            $this->email->from($from);
            $to_list = array($email_settings->contact_mail, $this->input->get('email'));
            $this->email->to($user_email);

            $data = array(
                 'first_name'=> $order_details->name,
                 'last_name' => $order_details->lastname,
                 'order_number' => $order_details->order_id,
                 'plate_number' => $order_details->plates_number,
                );
            $body = $this->load->view('email_template/dispatched',$data,TRUE);
            $this->email->subject('Order has been dispatched');
            $this->email->message($body);
            $this->email->send();

            //add notification
            $name=$this->input->get('firstname')." ".$this->input->get('lastname');
            $ndata['user_id']=$order_details->user_id;
            $ndata['title']="Order has been dispatched (".$id.").";
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
        echo $status;
    }
}

