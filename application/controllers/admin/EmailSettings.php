<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class EmailSettings extends CI_Controller {

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
        $this->load->model('Email_settings_model','email_settings');
        $this->load->helper('string');
    }

    public function edit($id = '') { //this is use for edit records start
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Email Settings';
            $data['ckeditor'] = true;
            $data['gridTable'] = false;
            if ($id != '') {
                $this->form_validation->set_rules('enquiries_mail', 'enquiries mail', 'required');
                $this->form_validation->set_rules('contact_mail', 'contact mail', 'required');
                $this->form_validation->set_rules('buy_mail', 'buy mail', 'required');
                $this->form_validation->set_rules('offer_mail', 'offer mail', 'required');
                $this->form_validation->set_rules('enquire_mail', 'enquire mail', 'required');
                $this->form_validation->set_rules('favourites_mail', 'favourites mail', 'required');
                $this->form_validation->set_rules('order_success_mail', 'order_success mail', 'required');
                
                $formSubmit = $this->input->post('Submit');
                $id=1;
                if ($formSubmit == "Update") {
                    if ($this->form_validation->run() === TRUE) {
                        
                        $data = array(
                            'enquiries_mail' => $this->input->post('enquiries_mail'),
                            'contact_mail' => $this->input->post('contact_mail'),
                            'buy_mail' => $this->input->post('buy_mail'),
                            'offer_mail' => $this->input->post('offer_mail'),
                            'enquire_mail' => $this->input->post('enquire_mail'),
                            'favourites_mail' => $this->input->post('favourites_mail'),
                            'order_success_mail' => $this->input->post('order_success_mail')
                        );
                        $tblName = "email_settings";
                        $this->common->update_record("id", $id, $tblName, $data);
                        
                        $this->session->set_flashdata('msg', 'Email Settings Content has been updated successfully.');
                        
                        redirect('/admin/email-settings/edit/'.$id, 'refresh');
                    }
                }
                
                $data['content_page'] = $this->email_settings->get_email_settings_content_by_id($id);
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwEditEmailSettings', $data);
                $this->load->view('admin/controls/vwFooter');
                $this->load->view('admin/controls/vwFooterJavascript', $data);
            } else {
                redirect('admin/email-settings/edit/1');
            }
        } else {
            
        }
    }

}

