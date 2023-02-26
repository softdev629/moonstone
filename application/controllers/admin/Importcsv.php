<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Importcsv extends CI_Controller {

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
        $memData = array();
        $data['page'] = 'Import';
        if (isset($this->session->userdata['is_admin_login'])) {          
            $formSubmit = $this->input->post('Submit');
            if($formSubmit == "Save"){
                // Form field validation rules

                $this->form_validation->set_rules('csv_file', 'CSV file', 'callback_file_check');

                // Validate submitted form data
                if($this->form_validation->run() == true){
                    $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                    
                    // If file uploaded
                    if(is_uploaded_file($_FILES['csv_file']['tmp_name'])){
                        $filepath=$_FILES['csv_file']['tmp_name'];
                        $size = filesize($filepath);
                        $csvFile = fopen($filepath, 'r');
                        $bytes = ftell($csvFile);
                        
                        if ($csvFile) {

                                // $dup_data = [
                                // 'status' => '2',
                                // ];
                                // $this->db->update('duplicate_private_plates', $dup_data);

                                $this->db->truncate('duplicate_private_plates');
                            
                                $fields = [];     
                                // Store CSV data in an array
                                $csvData = array();
                                $i = 0;
                                while(! feof($csvFile)){
                                    $number_data =  fgetcsv($csvFile);

                                    if (empty($number_data)){
                                        break;
                                    }

                                    //update data 
                                    
                                    if($number_data[0]!="" && $number_data[1]!=""){

                                            $rowCount++;
                                            $sel_plate_condi = "number = '" . $number_data[0] . "' and status!='3'";
                                            $plate_count_data = $this->select_model->get_cherished_plates($sel_plate_condi,"id,number,price,company_name");
                                            $apply_vat = '0';
                                            if(count($plate_count_data)=='0'){
                                                $created_date = date('Y-m-d H:i:s');
                                                $company_name = "";
                                                $company_id = "";                                                    
                                                if (isset($number_data[2])) {
                                                	  $company_name = trim($number_data[2]);
                                                	  $comp_condi = "name = '".$company_name."' and status ='1'";
                                                	  $comp_data = $this->select_model->get_company($comp_condi,'id');
                                                	  if(is_array($comp_data) && count($comp_data) > 0) {
                                                	  	$company_id = $comp_data[0]['id'];
                                                	  }
                                             	 }
                                             	 if (isset($number_data[3])) {
                                                	  if($number_data[3] == 'Y') {
                                                	  	$apply_vat = '1';
                                                	  }
                                             	 }
                                                $p_data = array(
                                                    'number' => $number_data[0],
                                                    'price' => $number_data[1],
                                                    'plate_id' => md5($number_data[0]),
                                                    'created_at' => $created_date,
																	  'company_name' => $company_name,
																	  'company_id' => $company_id,
                                                    'is_csv' => 1,
                                                    'status' => 1,
                                                    'private' => 1,
                                                    'apply_vat' => $apply_vat,
                                                );
                                                $tblName = "cherished_plates";
                                                $inser_id = $this->common->insert_record($tblName, $p_data); 
                                                // $csvData[]=$p_data;
                                                $insertCount++;
                            
                                            } else {
                                            	$company_name = "";
                                            	$company_id = "";
                                                if (isset($number_data[2])) {
                                                	  $company_name = $number_data[2];
                                                	  $comp_condi = "name = '".$company_name."' and status ='1'";
                                                	  $comp_data = $this->select_model->get_company($comp_condi,'id');
                                                	  if(is_array($comp_data) && count($comp_data) > 0) {
                                                	  	$company_id = $comp_data[0]['id'];
                                                	  }
                                             	 }
                                             	 if (isset($number_data[3])) {
                                                	  if($number_data[3] == 'Y') {
                                                	  	$apply_vat = '1';
                                                	  }
                                             	 }
                                            	$plateid = "";
                                            	if(is_array($plate_count_data) && count($plate_count_data) > 0) {
                                            		$plateid = $plate_count_data[0]['id'];
                                                    $plate_number = $plate_count_data[0]['number'];
                                                    $o_company_name = $plate_count_data[0]['company_name'];
                                                    $o_price = $plate_count_data[0]['price'];
                                            	}

                                                
                                            	$tblName = "cherished_plates";
                                            	if(intval($plateid) > 0)
                                                {
                                            		//$this->common->update_record("id", $plateid, $tblName, $p_data);
                                                    $p_data = array(
                                                        'original_plate_id' => $plateid,
                                                        'original_plates_number' => $plate_number,
                                                        'csv_plates_number' => $number_data[0],
                                                        'original_plates_number' => $plate_number,
                                                        'original_company_name' => $o_company_name,
                                                        'csv_company_name' => $company_name,
                                                        'original_price' => $o_price,
                                                        'csv_price' => $number_data[1],
                                                        'is_csv' => 1,
                                                        'status' => 1
                                                    );

                                                    $tblName = "duplicate_private_plates";
                                                    $inser_id = $this->common->insert_record($tblName, $p_data);
                                            	}                                                	
                                                $updateCount++;
                                            } 
                                        

                                    } else {
                                        $notAddCount++;
                                    }
                                    $i++;
                                }
                                // Close opened CSV file
                                fclose($csvFile);
                                // echo "<pre />";
                                // print_r($csvData);
                                // die();
                                $notAddCount = ($rowCount - ($insertCount + $updateCount));
                                $successMsg = 'Plates imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Duplicated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                                $this->session->set_flashdata('msg', $successMsg);
                                if($updateCount>0){
                                    redirect('/admin/duplicate_private_plate', 'refresh');
                                }
                        }
                    }else{
                        
                        $this->session->set_flashdata('error', 'Error on file upload, please try again.');
                    }
                }else{
                     $this->session->set_flashdata('error', 'Invalid file, please select only CSV file.');
                }
            }
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwImportCsv', $data);
            $this->load->view('admin/controls/vwFooter');
           
        } else {
            redirect('/admin/login', 'refresh');
        }
    }

    public function file_check(){
            $file_type = array('.csv');
            if(!empty($_FILES['csv_file']['name']))
            {
                $ext = strtolower(strrchr($_FILES['csv_file']['name'],"."));
                if(in_array($ext,$file_type))
                {
                    return true;
                }
                else
                {
                    $this->session->set_flashdata('error', 'Attachment allowed only csv');
                    $this->form_validation->set_message('error','Attachment allowed only csv');
                    return false;
                }
            }
            {
                $this->session->set_flashdata('error', 'CSV field is required');
               $this->form_validation->set_message('error','CSV field is required');
                    return false;
            }
    }
    public function escape_string($data){
        $result = array();
        foreach($data as $row){
            $result[] = str_replace('"', '', $row);
        }
        return $result;
    }   


}
