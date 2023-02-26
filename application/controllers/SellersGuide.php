<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SellersGuide extends CI_Controller {

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
        $this->load->model('Faqs_model','faqs');
        $this->load->helper('string');
    }

    public function index() {
			
    		$data = array();
            $data['page'] = 'Sellers Guide';
            $data['currentPage']='10';
            $data['content']=$this->content->get_static_page_by_id(3);
            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwSellersGuide',$data);
            $this->load->view('controls/vwFooter',$data);
		
    }
}

