<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
        $data['page'] = 'Dashboard';
        //if (isset($this->session->userdata['logged_in'])) {
            // User count
            $user_field = 'count(*) as user_count';            
            $data['user_count'] = $this->select_model->get_users('', $user_field);
            // Newsletter subscription
            $news_field = 'count(*) as news_count';            
            $data['newsletter_count'] = $this->select_model->get_newsletter_subscription('', $news_field);
            // Orders count
            $order_field = 'count(*) as order_count';            
            $data['order_count'] = $this->select_model->get_order_list('', $order_field);
            // Inquiries count
            $inquiries_field = 'count(*) as inquiries_count';            
            $data['inquiries_count'] = $this->select_model->get_inquiries('', $inquiries_field);
            // Get plates offer count
            $condition = "type=1";
            $join_arr[0]['table_name']="user";
            $join_arr[0]['cond']="user.user_id = plate_enquiry.user_id";
            $join_arr[0]['type']="left";
            $plates_field = "count(*) as plates_count";
            $data['plates_count'] = $this->select_model->get_plate_offers_inquiries($condition,$plates_field,$join_arr);
            // Favourite plates count
            $favourite_field = 'count(*) as favourite_count'; 
            $data['favourite_count'] = $this->select_model->get_favourite_list('', $favourite_field);
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwDashboard',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);
            
        // } else {
        //     $this->load->view('forgot_password');
        // }
		
    }
}

