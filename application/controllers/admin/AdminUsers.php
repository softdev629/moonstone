<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminUsers extends CI_Controller {

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
        $data['page'] = 'Admin User Management';
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['users_list'] = $this->select_model->get_admin();
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManageAdminUsers',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);
            
         } else {
             redirect('/admin/login', 'refresh');
        }
		
    }

    public function add() { //this is use for redirect form in add section start

        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'User';
            $data['gridTable'] = false;
            $data['ckeditor'] = true;

            $this->form_validation->set_rules('firstname', 'firstname', 'required');
            $this->form_validation->set_rules('lastname', 'lastname', 'required');
            $this->form_validation->set_rules('username', 'username', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('user_type', 'user_type', 'required');

            $formSubmit = $this->input->post('Submit');

            if ($formSubmit == "Save") {

                if ($this->form_validation->run() === TRUE) {                    
                    $data['error'] = "";
                    if($data['error']==""){
                        $condi = "email='".$this->input->post('email')."'";
                        $user_data = $this->select_model->get_admin($condi);
                        if (is_array($user_data) && count($user_data) > 0) {
                            $this->session->set_flashdata('error', 'Email address already exist. Please try with different email');
                            redirect('admin/adminuser/add', 'refresh');
                        }
                        else {
                            $data = array(
                                'email' => $this->input->post('email'),
                                'password' => md5($this->input->post('password')),
                                'firstname' => $this->input->post('firstname'),
                                'lastname' => $this->input->post('lastname'),
                                'username' => $this->input->post('username'),
                                'status' => $this->input->post('status'),
                                'user_type' => $this->input->post('user_type'),
                            );
                            $tblName = "admin";

                            $inser_id = $this->common->insert_record($tblName, $data);

                            $this->session->set_flashdata('msg', 'User has been added successfully.');
                            redirect('admin/adminusers', 'refresh');
                        }                        

                    }else{

                        $this->session->set_flashdata('error', $data['error']);
                        redirect('admin/adminusers', 'refresh');
                    }                    
                }
            }            
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwAddAdminUser', $data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript', $data);
        } else {
            $this->load->view('login');
        }
    }

    public function edit($id = '') { //this is use for edit records start
        //print_r($id); die();
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'User';
            $data['ckeditor'] = true;
            $data['gridTable'] = false;
            if ($id != '') {
                $condi = "id='".$id."'";
                $data['user_data'] = $this->select_model->get_admin($condi);
                $this->form_validation->set_rules('firstname', 'firstname', 'required');
                $this->form_validation->set_rules('lastname', 'lastname', 'required');
                $this->form_validation->set_rules('username', 'username', 'required');
                $this->form_validation->set_rules('email', 'email', 'required|valid_email');
                $this->form_validation->set_rules('status', 'status', 'required');
                $this->form_validation->set_rules('user_type', 'user_type', 'required');

                $formSubmit = $this->input->post('Submit');
                if ($formSubmit == "Update") {
                    if ($this->form_validation->run() === TRUE) {

                        $data['error'] = "";      
                        if($data['user_data'][0]['email'] !=  $this->input->post('email')) {
                            $condi = "email='".$this->input->post('email')."'";
                            $exist = $this->select_model->get_admin($condi);
                            if (is_array($exist) && count($exist) > 0) {
                                $this->session->set_flashdata('error', 'Email address already exist. Please try with different email');
                                redirect('admin/adminuser/edit/' . $id, 'refresh');
                            }
                        }
                        $data = array(
                            'email' => $this->input->post('email'),
                            'firstname' => $this->input->post('firstname'),
                            'lastname' => $this->input->post('lastname'),
                            'username' => $this->input->post('username'),
                            'status' => $this->input->post('status'),
                            'user_type' => $this->input->post('user_type'),
                        );
                        $tblName = "admin";
                        $this->common->update_record("id", $id, $tblName, $data);
                        
                        $this->session->set_flashdata('success', 'User has been updated successfully.');
                        
                        redirect('admin/adminuser/edit/'.$id, 'refresh');
                    }
                }
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwEditAdminUser', $data);
                $this->load->view('admin/controls/vwFooter');
                $this->load->view('admin/controls/vwFooterJavascript', $data);
            } else {
                redirect('admin/adminusers', 'refresh');
            }
        } else {
             redirect('admin');
        }
    }
}

