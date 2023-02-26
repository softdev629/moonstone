<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Favourite extends CI_Controller {

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
        $data['page'] = 'Favourite';
        if (isset($this->session->userdata['is_admin_login'])) {
            $condition = "favourite.is_number_favourite='1'";
            $join_arr[0]['table_name']="user";
            $join_arr[0]['cond']="user.user_id = favourite.user_id";
            $join_arr[0]['type']="left";
            $field = "";
            $data['favourite_list'] = $this->select_model->get_favorite($condition,$field,$join_arr);
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManageFavorite',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);
            
         } else {
             redirect('/admin/login', 'refresh');
        }
		
    }

    public function plates_inquiries() {
            
        $data = array();
        $data['page'] = 'Plate Inquiries';
        if (isset($this->session->userdata['is_admin_login'])) {
            $condition = "type=2";
            $join_arr[0]['table_name']="user";
            $join_arr[0]['cond']="user.user_id = plate_enquiry.user_id";
            $join_arr[0]['type']="left";
            $field = "";
            $data['inquiries_list'] = $this->select_model->get_plate_offers_inquiries($condition,$field,$join_arr);
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManagePlateInquiries',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);
            
         } else {
             redirect('/admin/login', 'refresh');
        }
        
    }
}

