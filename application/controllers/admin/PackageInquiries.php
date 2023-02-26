<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PackageInquiries extends CI_Controller {

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
        $data['page'] = 'Package Inquiries';
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['inquiries_list'] = $this->select_model->get_package_inquiries();
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManagePackageInquiries',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);
            
         } else {
             redirect('/admin/login', 'refresh');
        }
		
    }
}

