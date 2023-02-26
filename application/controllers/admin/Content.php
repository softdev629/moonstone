<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends CI_Controller {

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
        $this->load->model('StaticPages_model','static_pages');
        $this->load->helper('string');
    }

    public function index() {
			
		$data = array();
        $data['page'] = 'Content';
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['content_list'] = $this->select_model->content();
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManageContent',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);
            
         } else {
             redirect('/admin/login', 'refresh');
        }
		
    }

    public function edit($id = '') { //this is use for edit records start
        //print_r($id); die();
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Content';
            $data['ckeditor'] = true;
            $data['gridTable'] = false;
            if ($id != '') {
                $this->form_validation->set_rules('page_name', 'page name', 'required');
                //$this->form_validation->set_rules('page_description', 'page_description', 'required');
                //$this->form_validation->set_rules('status', 'status', 'required');


                $formSubmit = $this->input->post('Submit');
                if ($formSubmit == "Update") {
                    if ($this->form_validation->run() === TRUE) {
                        
                        $data = array(
                            'page_name' => $this->input->post('page_name'),
                            'page_description' => $this->input->post('page_description'),
                            'is_page_description' => 1,
                        );
                        $tblName = "content";
                        $this->common->update_record("content_id", $id, $tblName, $data);
                        
                        $this->session->set_flashdata('msg', 'Content has been updated successfully.');
                        
                        redirect('/admin/content/edit/'.$id, 'refresh');
                    }
                }
                $data['content_page'] = $this->static_pages->get_static_page_by_id($id);
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwEditContent', $data);
                $this->load->view('admin/controls/vwFooter');
                $this->load->view('admin/controls/vwFooterJavascript', $data);
            } else {
                redirect('static-pages');
            }
        } else {
            
        }
    }

}

