<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faqs extends CI_Controller {

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
        $data['page'] = 'Faqs';
        $data['currentPage']='10';
        //$data['faqs_list']=$this->faqs->get_faqs_list();
        $condi = "faqs.category_id != '' and faqs.status = 1";
        $fields = "faqs.id as id , faqs.question AS question, faqs.answer AS answer, faqs.status AS status, faqs.created_at AS created_at, faqs_category.name AS name";
        $join_arr = array(
          array(
            'table_name' => 'faqs_category',
            'cond' => 'faqs.category_id = faqs_category.id',
            'type' => 'left',
          )
        );
        $faqs = $this->select_model->get_faqs($condi, $fields, $join_arr, 'status desc');
        if(is_array($faqs) && count($faqs) > 0) {
            $faqs_list = array();
            foreach($faqs as $k => $v) {
                $faqs_list[$v['name']][$k] = $v;
            }
        }
        $data['faqs_list']= $faqs_list;
        $this->load->view('controls/vwHeader',$data);
        $this->load->view('vwFaqs',$data);
        $this->load->view('controls/vwFooter',$data);
		
    }

    public function faq_details($id) {

        $data = array();
        $data['page'] = 'Faqs';
        $data['currentPage']='10';
        $data['faqs_list']=$this->faqs->get_faq_by_id($id);
        $this->load->view('controls/vwHeader',$data);
        $this->load->view('vwFaqsDetails',$data);
        $this->load->view('controls/vwFooter',$data);
    }
    
}

