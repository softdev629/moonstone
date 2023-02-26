<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification extends CI_Controller {

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
        $data['page'] = 'Notifications';
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['notification_list'] = $this->select_model->get_notifications();
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManageNotification',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);            
         } else {
             redirect('/admin/login', 'refresh');
        }
		
    }

    public function update_is_active(){
        $status=1;
        $msg="Ok";
        $val=$this->input->get('val');
        $id=$this->input->get('id');
        $data = array('is_read' => $val);
        $tblName = "notification";
        $this->common->update_record("id", $id, $tblName, $data);
        echo $status;
    }
}

