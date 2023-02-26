<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

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
        $this->load->model('Buy_page_content_model','buy_page_content');
        $this->load->model('Settings_model','settings');
        $this->load->helper('string');
    }

    public function edit($id='')
    {
        
          if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Settings';
            $data['ckeditor'] = true;
            $data['gridTable'] = false;
            if ($id != '') {
                
                $this->form_validation->set_rules('mark_up', 'Mark up', 'required');
        
                $formSubmit = $this->input->post('Submit');
                $id=1;
                if ($formSubmit == "Update") {
                    if ($this->form_validation->run() === TRUE) {
                        
                        $data = array(
                            'mark_up' => $this->input->post('mark_up'),
                        );
                        
                        $tblName = "settings";
                        $this->common->update_record("id", $id, $tblName, $data);
                        
                        $this->session->set_flashdata('msg', 'Settings has been updated successfully.');
                        
                        redirect('/admin/settings/edit/'.$id, 'refresh');
                    }
                    else{
                        $this->session->set_flashdata('msg', 'Fill all fields.');
                    }   
                }
                
                $data['content_page'] = $this->settings->get_settings_by_id($id);
               
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwSettings',$data);
                $this->load->view('admin/controls/vwFooter');
                $this->load->view('admin/controls/vwFooterJavascript', $data);
            } else {
               redirect('admin/settings/edit/1');
            }
        } else {
            
        }
    }
    
    
   

}

