<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

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
        $data['page'] = 'User Management';
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['users_list'] = $this->select_model->get_users();
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManageUsers',$data);
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

            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('lastname', 'lastname', 'required');
            $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');

            $formSubmit = $this->input->post('Submit');

            if ($formSubmit == "Save") {

                if ($this->form_validation->run() === TRUE) {                    
                    $data['error'] = "";
                    if($data['error']==""){
                        $condi = "email='".$this->input->post('email')."'";
                        $user_data = $this->select_model->get_users($condi);
                        if (is_array($user_data) && count($user_data) > 0) {
                            $this->session->set_flashdata('error', 'Email address already exist. Please try with different email');
                            redirect('admin/user/add', 'refresh');
                        }
                        else {
                            $data = array(
                                'email' => $this->input->post('email'),
                                'password' => md5($this->input->post('password')),
                                'name' => $this->input->post('name'),
                                'lastname' => $this->input->post('lastname'),
                                'phone_number' => $this->input->post('phone_number'),
                                'is_active' => $this->input->post('status'),
                                'create_date' => date('Y-m-d'),
                            );
                            $tblName = "user";

                            $inser_id = $this->common->insert_record($tblName, $data);

                            $this->session->set_flashdata('msg', 'User has been added successfully.');
                            redirect('admin/users', 'refresh');
                        }                        

                    }else{

                        $this->session->set_flashdata('error', $data['error']);
                        redirect('admin/users', 'refresh');
                    }                    
                }
            }            
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwAddUser', $data);
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
                $condi = "user_id='".$id."'";
                $user_data = $this->select_model->get_users($condi);
                $data['user_data'] = $this->select_model->get_users($condi);
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('lastname', 'lastname', 'required');
                $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
                $this->form_validation->set_rules('email', 'email', 'required|valid_email');
                $this->form_validation->set_rules('status', 'status', 'required');

                $formSubmit = $this->input->post('Submit');
                if ($formSubmit == "Update") {
                    if ($this->form_validation->run() === TRUE) {

                        $data['error'] = "";        
                        if($data['user_data'][0]['email'] !=  $this->input->post('email')) {
                            $condi = "email='".$this->input->post('email')."'";
                            $exist = $this->select_model->get_users($condi);
                            if (is_array($exist) && count($exist) > 0) {
                                $this->session->set_flashdata('error', 'Email address already exist. Please try with different email');
                                redirect('admin/user/edit/' . $id, 'refresh');
                            }
                        }
                        $data = array(
                            'email' => $this->input->post('email'),
                            'name' => $this->input->post('name'),
                            'lastname' => $this->input->post('lastname'),
                            'phone_number' => $this->input->post('phone_number'),
                            'is_active' => $this->input->post('status'),
                        );
                        $tblName = "user";
                        $this->common->update_record("user_id", $id, $tblName, $data);
                        
                        $this->session->set_flashdata('success', 'User has been updated successfully.');
                        
                        redirect('admin/user/edit/'.$id, 'refresh');
                    }
                }
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwEditUser', $data);
                $this->load->view('admin/controls/vwFooter');
                $this->load->view('admin/controls/vwFooterJavascript', $data);
            } else {
                redirect('admin/users', 'refresh');
            }
        } else {
             redirect('admin');
        }
    }
    
    public function plate_list() {
            
        $data = array();
        $data['page'] = 'Private Plates';
        if (isset($this->session->userdata['is_admin_login'])) {

            $data['currentPage']='10';

            $data['company_list']=$this->common->get_company_list();
            $data['soringCol']='"order": [[ 1, "asc" ]],'; 
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManagePlates',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);
            
         } else {
             redirect('/admin/login', 'refresh');
        }
        
    }

    public function get_private_plates()
   {
   	
	  $postData = $this->input->get();
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $columnIndex = $postData['order'][0]['column']; // Column index
      $columnName = $postData['columns'][$columnIndex]['data']; // Column name
      $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
      $company_id = intval($this->input->get("company_id"));
      $searchValue = $postData['search']['value']; // Search value
      $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (company.name like '%" . $searchValue . "%'  OR cherished_plates.number like '%" . $searchValue . "%' or  cherished_plates.price like '%" . $searchValue . "%'  )";
        }
      
      // $start = $draw*10;
      // if($draw==1){
      //   $start = 0;
      // }
        $length = intval($this->input->get("length"));
        $condition = "cherished_plates.private = '1' and cherished_plates.status != '3'";
        if($company_id>0){
            $condition = "cherished_plates.private = '1' and cherished_plates.status != '3' and company.id='".$company_id."'";
        }
        
        $join_arr[0] = array('table_name' =>"company", 'cond' => "cherished_plates.company_id = company.id", 'type' => "left");
        $this->db->select("cherished_plates.*,company.name");
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($condition != "") {
            $this->db->where($condition);
        }
        if ($searchValue != '') {
				$this->db->where($searchQuery);
        }
            
        if($columnName=='2') {
        	$columnName = 'company.name';
        } else if($columnName=='1') {
        	$columnName = 'cherished_plates.number';
        	} else if($columnName=='3') {
        	$columnName = 'cherished_plates.price';
        }
        $this->db->order_by($columnName, $columnSortOrder);
        if($length != -1){
            $this->db->limit($length, $start);
        }
        $query = $this->db->get("cherished_plates");
	

      $data = [];
      $sr_no=1;
      foreach($query->result() as $r) {

            if($r->status==1)
            {
               $status_html="<span class='label label-success'>Active</span>";
            }
            else if($r->status==2)
            {
              $status_html="<span class='label label-danger'>Inactive</span>";
            }
            $base_url=base_url();
            $link_html="<a href='".$base_url."admin/users/edit_plate/".$r->id."'>".$r->number."</a>";
            $checkbox_html="<input type='checkbox' class='checkBoxClass' name='plate_ids' value=".$r->id.">";

           $data[] = array(
                $checkbox_html,
                $sr_no,
                $link_html,
                $r->name,
                $r->price,
                $status_html
           );
           $sr_no++;
      }
      $result = array(
                "draw" => $draw,
                 "recordsTotal" => $this->select_model->get_total_private_palate($company_id),
                 "recordsFiltered" => $this->select_model->get_total_private_palate($company_id),
                 "data" => $data
            );
      echo json_encode($result);
      exit();
   }

   public function private_bulk_opration() { //this is use for redirect form in add section start

        if (isset($this->session->userdata['is_admin_login'])) {
                $formAction = $this->input->post('action');
                if ($formAction == "active") {
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                        
                            
                            $original_data = array(
                            'status' => 1
                            );
                            $tblName = "cherished_plates";
                            $this->common->update_record("id", $plate_id, $tblName, $original_data);
                        }
                        $this->session->set_flashdata('msg', 'Plates has been activate successfully.');
                        echo "success"; die();
                }
                if ($formAction == "inactive") {
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                        
                            $original_data = array(
                                'status' => 2
                            );
                            $tblName = "cherished_plates";
                            $this->common->update_record("id", $plate_id, $tblName, $original_data);
                        }
                        $this->session->set_flashdata('msg', 'Plates has been inactivate successfully.');
                        echo "success"; die();
                }
                if ($formAction == "delete") {
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                            $original_data = array(
                                'status' => 3
                            );
                            $tblName = "cherished_plates";
                            $this->common->update_record("id", $plate_id, $tblName, $original_data);
                        }
                        $this->session->set_flashdata('msg', 'Plates has been deleted successfully.');
                        echo "success"; die();
                }

                if ($formAction == "vat") {
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                            $original_data = array(
                                'apply_vat' => 1
                            );
                            $tblName = "cherished_plates";
                            $this->common->update_record("id", $plate_id, $tblName, $original_data);
                        }
                        $this->session->set_flashdata('msg', 'Selected Plates has been VAT applied successfully.');
                        echo "success"; die();
                }

                if ($formAction == "no_vat") {
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                            $original_data = array(
                                'apply_vat' => 0
                            );
                            $tblName = "cherished_plates";
                            $this->common->update_record("id", $plate_id, $tblName, $original_data);
                        }
                        $this->session->set_flashdata('msg', 'Selected Plates has been remove VAT successfully.');
                        echo "success"; die();
                }

                if ($formAction == "poa") {
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                            $original_data = array(
                                'apply_poa' => 1
                            );
                            $tblName = "cherished_plates";
                            $this->common->update_record("id", $plate_id, $tblName, $original_data);
                        }
                        $this->session->set_flashdata('msg', 'Selected Plates has been POA applied successfully.');
                        echo "success"; die();
                }

                if ($formAction == "no_poa") {
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                            $original_data = array(
                                'apply_poa' => 0
                            );
                            $tblName = "cherished_plates";
                            $this->common->update_record("id", $plate_id, $tblName, $original_data);
                        }
                        $this->session->set_flashdata('msg', 'Selected Plates has remove POA applied successfully.');
                        echo "success"; die();
                }

                if($formAction=="delete_by_company"){
                    $company_id = $this->input->post('company_id');
                    $original_data = array(
                        'status' => 3
                    );
                    $tblName = "cherished_plates";
                    $this->common->update_record("company_id", $company_id, $tblName, $original_data);
                    echo "success"; die();
                }

                if($formAction=="changed_company"){
                        $company_id = $this->input->post('company_id');
                        $plate_ids = $this->input->post('plate_ids');
                        $plates_ary=explode(",", $plate_ids);
                        foreach ($plates_ary as $key => $plate_id) {
                            $original_data = array(
                                'company_id' => $company_id
                            );
                            $tblName = "cherished_plates";
                            $this->common->update_record("id", $plate_id, $tblName, $original_data);
                        }
                        $this->session->set_flashdata('msg', 'Selected Plates has been changed company successfully.');
                        echo "success"; die();
                }
            
        } else {
            $this->load->view('login');
        }
    }
    
    public function add_plate() { //this is use for redirect form in add section start

        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Private Plate';
            $data['gridTable'] = false;
            $data['ckeditor'] = true;

            $this->form_validation->set_rules('company_id', 'company', 'required');
            $this->form_validation->set_rules('number', 'number', 'required');
            $this->form_validation->set_rules('price', 'price', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('apply_vat', 'apply_vat', 'required');
            $this->form_validation->set_rules('apply_poa', 'apply_poa', 'required');
            $formSubmit = $this->input->post('Submit');

            if ($formSubmit == "Save") {

                if ($this->form_validation->run() === TRUE) {                    
                    $data['error'] = "";
                    if($data['error']==""){
                        $condi = "number='".$this->input->post('number')."' and status ='1'";
                        $user_data = $this->select_model->get_cherished_plates($condi);
                        if (is_array($user_data) && count($user_data) > 0) {
                            $this->session->set_flashdata('error', 'Number already exist. Please try with different Number');
                            redirect('admin/users/add_plate', 'refresh');
                        }
                        else {
                            $plate_id = random_string('alnum', 32);
                            $data = array(
                                'company_id' => $this->input->post('company_id'),
                                'number' => $this->input->post('number'),
                                'price' => $this->input->post('price'),
                                'plate_id' => $plate_id,
                                'status' => $this->input->post('status'),
                                'apply_vat' => $this->input->post('apply_vat'),
                                'apply_poa' => $this->input->post('apply_poa'),
                                'private' => "1",
                                'created_at' => date('Y-m-d H:i:s'),
                            );
                            $tblName = "cherished_plates";

                            $inser_id = $this->common->insert_record($tblName, $data);

                            $this->session->set_flashdata('msg', 'Number has been added successfully.');
                            redirect('admin/users/plate_list', 'refresh');
                        }                        

                    }else{

                        $this->session->set_flashdata('error', $data['error']);
                        redirect('admin/users/plate_list', 'refresh');
                    }                    
                }
            } 

            $data['company_list']=$this->common->get_company_list();           
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwAddPlates', $data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript', $data);
        } else {
            $this->load->view('login');
        }
    }

    public function edit_plate($id = '') { //this is use for edit records start
        //print_r($id); die();
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Private Plate';
            $data['ckeditor'] = true;
            $data['gridTable'] = false;
            if ($id != '') {
                $condi = "id='".$id."'";
                $user_data = $this->select_model->get_cherished_plates($condi);
                $data['user_data'] = $this->select_model->get_cherished_plates($condi);
                $this->form_validation->set_rules('company_id', 'company', 'required');
                $this->form_validation->set_rules('number', 'number', 'required');
                $this->form_validation->set_rules('price', 'price', 'required');
                $this->form_validation->set_rules('status', 'status', 'required');
                $this->form_validation->set_rules('apply_vat', 'apply_vat', 'required');
                $this->form_validation->set_rules('apply_poa', 'apply_poa', 'required');

                $formSubmit = $this->input->post('Submit');
                if ($formSubmit == "Update") {
                    if ($this->form_validation->run() === TRUE) {

                        $data['error'] = "";        
                        $data = array(
                            'company_id' => $this->input->post('company_id'),
                            'number' => $this->input->post('number'),
                            'price' => $this->input->post('price'),
                            'status' => $this->input->post('status'),
                            'apply_vat' => $this->input->post('apply_vat'),
                            'apply_poa' => $this->input->post('apply_poa')
                        );
                        $tblName = "cherished_plates";
                        $this->common->update_record("id", $id, $tblName, $data);
                        
                        $this->session->set_flashdata('success', 'Plate has been updated successfully.');
                        
                        redirect('admin/users/edit_plate/'.$id, 'refresh');
                    }
                }
                $data['company_list']=$this->common->get_company_list();    
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwEditPlates', $data);
                $this->load->view('admin/controls/vwFooter');
                $this->load->view('admin/controls/vwFooterJavascript', $data);
            } else {
                redirect('admin/users/plate_list', 'refresh');
            }
        } else {
             redirect('admin');
        }
    }
    
    public function company_list() {
            
        $data = array();
        $data['page'] = 'Company';
        if (isset($this->session->userdata['is_admin_login'])) {
                $condi = "status = '1'";
            $data['users_list'] = $this->select_model->get_company($condi);
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft',$data);
            $this->load->view('admin/vwManageCompany',$data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript',$data);
            
         } else {
             redirect('/admin/login', 'refresh');
        }
        
    }
    
    public function add_company() { //this is use for redirect form in add section start

        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Company';
            $data['gridTable'] = false;
            $data['ckeditor'] = true;

            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $formSubmit = $this->input->post('Submit');

            if ($formSubmit == "Save") {

                if ($this->form_validation->run() === TRUE) {                    
                    $data['error'] = "";
                    if($data['error']==""){
                        $condi = "name='".$this->input->post('name')."' and status ='1'";
                        $user_data = $this->select_model->get_company($condi);
                        if (is_array($user_data) && count($user_data) > 0) {
                            $this->session->set_flashdata('error', 'Company already exist. Please try with different name');
                            redirect('admin/users/add_company', 'refresh');
                        }
                        else {
                            $data = array(
                                'name' => $this->input->post('name'),
                                'status' => $this->input->post('status'),
                                'created_at' => date('Y-m-d H:i:s'),
                            );
                            $tblName = "company";

                            $inser_id = $this->common->insert_record($tblName, $data);

                            $this->session->set_flashdata('msg', 'Company has been added successfully.');
                            redirect('admin/users/company_list', 'refresh');
                        }                        

                    }else{

                        $this->session->set_flashdata('error', $data['error']);
                        redirect('admin/users/company_list', 'refresh');
                    }                    
                }
            }            
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwAddCompany', $data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript', $data);
        } else {
            $this->load->view('login');
        }
    }

    public function edit_company($id = '') { //this is use for edit records start
        //print_r($id); die();
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Company';
            $data['ckeditor'] = true;
            $data['gridTable'] = false;
            if ($id != '') {
                $condi = "id='".$id."'";
                $user_data = $this->select_model->get_company($condi);
                $data['user_data'] = $this->select_model->get_company($condi);
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('status', 'status', 'required');
                $formSubmit = $this->input->post('Submit');
                if ($formSubmit == "Update") {
                    if ($this->form_validation->run() === TRUE) {

                        $data['error'] = "";        
                        $data = array(
                            'name' => $this->input->post('name'),
                            'status' => $this->input->post('status'),
                        );
                        $tblName = "company";
                        $this->common->update_record("id", $id, $tblName, $data);
                        
                        $this->session->set_flashdata('success', 'Company has been updated successfully.');
                        
                        redirect('admin/users/edit_company/'.$id, 'refresh');
                    }
                }
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwEditCompany', $data);
                $this->load->view('admin/controls/vwFooter');
                $this->load->view('admin/controls/vwFooterJavascript', $data);
            } else {
                redirect('admin/users/company_list', 'refresh');
            }
        } else {
             redirect('admin');
        }
    }
}

