<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AboutNewRegister extends CI_Controller {

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
			
    		// $data = array();
      //       $data['page'] = 'About New Register';
      //       $data['currentPage']='5';

      //       $this->load->view('controls/vwHeader',$data);
      //       $this->load->view('vwAboutNewRegister',$data);
      //       $this->load->view('controls/vwFooter',$data);

            $data = array();
            $data['page'] = 'About New Register';
            $data['currentPage']='5';
            $data['content']=$this->content->get_static_page_by_id($data['currentPage']);

            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwAboutNewRegister',$data);
            $this->load->view('controls/vwFooter',$data);

		
    }
}

