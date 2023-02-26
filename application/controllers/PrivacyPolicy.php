<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PrivacyPolicy extends CI_Controller {

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
    }

    public function index() {

            $data = array();
            $data['page'] = 'Privacy Policy';
            $data['currentPage']='9';
            $data['content']=$this->content->get_static_page_by_id($data['currentPage']);

            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwPrivacyPolicy',$data);
            $this->load->view('controls/vwFooter',$data);

    }

    public function WebPolicy() {

            $data = array();
            $data['page'] = 'Web Policy';
            $data['currentPage']='10';
            $data['content']=$this->content->get_static_page_by_id(10);

            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwPrivacyPolicy',$data);
            $this->load->view('controls/vwFooter',$data);

    }

    public function CookiesPolicy() {

            $data = array();
            $data['page'] = 'Cookies Policy';
            $data['currentPage']='11';
            $data['content']=$this->content->get_static_page_by_id(11);

            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwPrivacyPolicy',$data);
            $this->load->view('controls/vwFooter',$data);

    }
}

