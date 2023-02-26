<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DuplicatePrivatePlate extends CI_Controller {

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
        $this->load->model('Faqs_model','faqs');
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
        $data['page'] = 'Duplicate Private Plates';

        if (isset($this->session->userdata['is_admin_login'])) {
            $condi = "status='1'";
            $data['plates'] = $this->select_model->getDuplicatePrivatePlate($condi);
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwManageDuplicatePrivatePlates', $data);
            $this->load->view('admin/controls/vwFooter');
            ;
        } else {
            $this->load->view('login');
        }
    }
    public function private_plates_bulk() { //this is use for redirect form in add section start

        if (isset($this->session->userdata['is_admin_login'])) {
                $formAction = $this->input->post('action');
                if ($formAction == "update") {
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                        
                            $duplicateRecord=$this->select_model->get_duplicate_plate_by_original_id($plate_id);

                            $company_id=0;
                            if (isset($duplicateRecord->csv_company_name)) {
                                  $company_name = $duplicateRecord->csv_company_name;
                                  $comp_condi = "name = '".$company_name."'";
                                  $comp_data = $this->select_model->get_company($comp_condi);
                                  if(is_array($comp_data) && count($comp_data) > 0) {
                                    $company_id = $comp_data[0]['id'];
                                  }
                             }
                            $original_data = array(
                            'price' => $duplicateRecord->csv_price,
                            'company_id' => $company_id,
                            'company_name' => $duplicateRecord->csv_company_name,
                            'private' => 1
                            );
                            $tblName = "cherished_plates";
                            $this->common->update_record("id", $plate_id, $tblName, $original_data);

                            

                            $dup_data = array(
                            'status' => 2
                            );
                            $tblName = "duplicate_private_plates";
                            $this->common->update_record("original_plate_id", $plate_id, $tblName, $dup_data);
                        }
                        
                        
                        
                        $this->session->set_flashdata('msg', 'Plates has been updated successfully.');
                        
                        echo "success"; die();
                }
                if ($formAction == "delete") {
                    
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                        
                            $duplicateRecord=$this->select_model->get_duplicate_plate_by_original_id($plate_id);

                            $dup_data = array(
                            'status' => 2
                            );
                            $tblName = "duplicate_private_plates";
                            $this->common->update_record("original_plate_id", $plate_id, $tblName, $dup_data);
                        }
                        
                        $this->session->set_flashdata('msg', 'Plates has been deleted successfully.');
                        
                        echo "success"; die();
                }

            
        } else {
            $this->load->view('login');
        }
    }
}
