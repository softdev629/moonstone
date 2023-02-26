<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

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
        $this->load->model('Category_model', 'category_model');
        $this->load->model('Package_model', 'package_model');
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
        $data['page'] = 'Package';
        if (isset($this->session->userdata['is_admin_login']))
        {
            $data['packages'] = $this->select_model->get_package();
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwManagePackage', $data);
            $this->load->view('admin/controls/vwFooter');
            
        } else {
            $this->load->view('login');
        }
    }
    public function add() { //this is use for redirect form in add section start

        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Package';
            $data['gridTable'] = false;
            $data['ckeditor'] = true;

            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('price', 'price', 'required');
            $this->form_validation->set_rules('sort_desc', 'sort_desc', 'required');
            //$this->form_validation->set_rules('desc', 'desc', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');

            $formSubmit = $this->input->post('Submit');
            
            if ($formSubmit == "Save") {

                if ($this->form_validation->run() === TRUE) {
                        $data = array(
                            'name' => $this->input->post('name'),
                            'price' => $this->input->post('price'),
                            'sort_desc' => $this->input->post('sort_desc'),
                            'desc' => $this->input->post('desc'),
                            'status' => $this->input->post('status')
                        );
                        

                        $tblName = "package";

                        $inser_id = $this->common->insert_record($tblName, $data);

                        $this->session->set_flashdata('msg', 'Package has been added successfully.');
                        redirect('admin/package/edit/'.$inser_id, 'refresh');
                    
                }
            }
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwAddPackage', $data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript', $data);
        } else {
            $this->load->view('login');
        }
    }

    public function edit($id = '') { //this is use for edit records start
        //print_r($id); die();
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Package';
            $data['ckeditor'] = true;
            $data['gridTable'] = false;
            if ($id != '') {
                $data['package'] = $this->package_model->get_package_by_id($id);
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('price', 'price', 'required');
                $this->form_validation->set_rules('sort_desc', 'sort_desc', 'required');
                $this->form_validation->set_rules('desc', 'desc', 'required');
                $this->form_validation->set_rules('status', 'status', 'required');
                $formSubmit = $this->input->post('Submit');
                // print_r($formSubmit);
                //         die();

                if ($formSubmit == "Update")
                {
                    if ($this->form_validation->run() === TRUE)
                    {
                        $data['error'] = "";
                        $data = array(
                            'name' => $this->input->post('name'),
                            'price' => $this->input->post('price'),
                            'sort_desc' => $this->input->post('sort_desc'),
                            'desc' => $this->input->post('desc'),
                            'status' => $this->input->post('status')
                        );
                        
                        $tblName = "package";
                        $this->common->update_record("id", $id, $tblName, $data);
                        $this->session->set_flashdata('msg', 'Package has been updated successfully.');
                        redirect('admin/package/edit/'.$id, 'refresh');
                    }
                }
                
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwEditPackage', $data);
                $this->load->view('admin/controls/vwFooter');
                $this->load->view('admin/controls/vwFooterJavascript', $data);
            } else {
                redirect('admin/featured-plates');
            }
        } else {
             redirect('admin');
        }
    }



//this is use for edit records end
}
