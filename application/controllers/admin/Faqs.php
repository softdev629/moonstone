<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('cookie');
        $this->load->helper('string');
        $this->load->helper('download');
        $this->load->model('select_model');
        $this->load->library('session');
        $this->load->model('Common_function_model', 'common');
        $this->load->model('Faqs_model', 'faqs');
        //$this->init();
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $data = array();
        $data['page'] = 'FAQs';
        if (isset($this->session->userdata['is_admin_login'])) {
            $fields = "faqs.id as id , faqs.question AS question, faqs.answer AS answer, faqs.status AS status, faqs.created_at AS created_at, faqs_category.name AS name";
            $join_arr = array(
              array(
                'table_name' => 'faqs_category',
                'cond' => 'faqs.category_id = faqs_category.id',
                'type' => 'left',
              )
            );
            $data['faqs'] = $this->select_model->get_faqs('', $fields, $join_arr, 'status desc');
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwManageFaqs', $data);
            $this->load->view('admin/controls/vwFooter');
            ;
        } else {
            $this->load->view('login');
        }
    }
    public function add() { //this is use for redirect form in add section start

        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'FAQs';
            $data['gridTable'] = false;
            $data['ckeditor'] = true;

            $this->form_validation->set_rules('question', 'question', 'required');
            $this->form_validation->set_rules('answer', 'answer', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('category', 'category', 'required');

            $formSubmit = $this->input->post('Submit');

            if ($formSubmit == "Save") {

                if ($this->form_validation->run() === TRUE) {
                    

                    $data = array(
                        'question' => $this->input->post('question'),
                        'answer' => $this->input->post('answer'),
                        'status' => $this->input->post('status'),
                        'category_id' => $this->input->post('category'),
                    );
                    $tblName = "faqs";

                    $inser_id = $this->common->insert_record($tblName, $data);

                    $this->session->set_flashdata('msg', 'FAQs has been added successfully.');
                    redirect('admin/faqs/edit/'.$inser_id, 'refresh');
                }
            }
            $data['faqs_category'] = $this->select_model->get_faqs_category();
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwAddFaq', $data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript', $data);
        } else {
            $this->load->view('login');
        }
    }

    public function edit($id = '') { //this is use for edit records start
        //print_r($id); die();
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'FAQs';
            $data['ckeditor'] = true;
            $data['gridTable'] = false;
            if ($id != '') {
                $this->form_validation->set_rules('question', 'question', 'required');
                $this->form_validation->set_rules('answer', 'answer', 'required');
                $this->form_validation->set_rules('status', 'status', 'required');
                $this->form_validation->set_rules('category', 'category', 'required');

                $formSubmit = $this->input->post('Submit');
                if ($formSubmit == "Update") {
                    if ($this->form_validation->run() === TRUE) {
                        
                        $data = array(
                            'question' => $this->input->post('question'),
                            'answer' => $this->input->post('answer'),
                            'status' => $this->input->post('status'),
                            'category_id' => $this->input->post('category')
                        );
                        $tblName = "faqs";
                        $this->common->update_record("id", $id, $tblName, $data);
                        
                        $this->session->set_flashdata('msg', 'Faqs has been updated successfully.');
                        
                        redirect('admin/faqs/edit/'.$id, 'refresh');
                    }
                }
                $data['faqs'] = $this->faqs->get_faq_by_id($id);
                $data['faqs_category'] = $this->select_model->get_faqs_category();
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwEditfaq', $data);
                $this->load->view('admin/controls/vwFooter');
                $this->load->view('admin/controls/vwFooterJavascript', $data);
            } else {
                redirect('faqs');
            }
        } else {
            
        }
    }



//this is use for edit records end
}
