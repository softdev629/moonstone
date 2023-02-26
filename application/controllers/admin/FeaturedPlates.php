<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FeaturedPlates extends CI_Controller {

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
        $this->load->model('FeaturedPlates_model', 'featured_plates_model');
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
        $data['page'] = 'Featured Plates';
        if (isset($this->session->userdata['is_admin_login']))
        {
            $data['featured_plates'] = $this->select_model->get_featured_plates();
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwManageFeaturedPlates', $data);
            $this->load->view('admin/controls/vwFooter');
            
        } else {
            redirect('/admin/login', 'refresh');
        }
    }
    public function add() { //this is use for redirect form in add section start

        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Featured Plates';
            $data['gridTable'] = false;
            $data['ckeditor'] = true;

            $this->form_validation->set_rules('category_id', 'category', 'required');
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');

            $formSubmit = $this->input->post('Submit');

            if ($formSubmit == "Save") {

                if ($this->form_validation->run() === TRUE) {
                    
                    $data['error'] = "";
                    if (!empty($_FILES['plate_images']['name'])) {
                        $tmp = $_FILES['plate_images']['name'];
                        $ext = explode('.', $tmp);
                        $extension = strtolower($ext[1]);

                        $today = date('mdyHis');
                        $img_name = $today . '.' . $extension;
                    }

                    if (!empty($_FILES['plate_images']['name'])) {
                        $pathMain = './assets/uploads/featured_plates/';
                            if (!is_dir($pathMain))
                                mkdir($pathMain, 0755);

                        $configImage['upload_path'] = $pathMain;
                        $configImage['max_size'] = '10240';
                        $configImage['allowed_types'] = 'gif|jpg|jpeg|png';
                        $configImage['file_name'] = $img_name;

                        $this->load->library('upload', $configImage);
                        $this->upload->initialize($configImage);
                        if (!$this->upload->do_upload('plate_images')) {
                           $data['error']="Image not upload"; 
                        } else {
                            $this->load->library('image_lib');
                            $this->image_lib->clear();
                
                        }
                    }
                    if($data['error']==""){
                        $data = array(
                        'category_id' => $this->input->post('category_id'),
                        'name' => $this->input->post('name'),
                        'images_path' => $img_name,
                        'status' => $this->input->post('status')
                        );
                        $tblName = "featured_plates";

                        $inser_id = $this->common->insert_record($tblName, $data);

                        $this->session->set_flashdata('msg', 'Featured Plates has been added successfully.');
                        redirect('admin/featured-plates/edit/'.$inser_id, 'refresh');

                    }else{

                        $this->session->set_flashdata('error', $data['error']);
                        redirect('admin/featured-plates', 'refresh');
                    }

                    
                }
            }
            $data['categories'] = $this->category_model->get_category();
            $this->load->view('admin/controls/vwHeader');
            $this->load->view('admin/controls/vwLeft', $data);
            $this->load->view('admin/vwAddFeaturedPlates', $data);
            $this->load->view('admin/controls/vwFooter');
            $this->load->view('admin/controls/vwFooterJavascript', $data);
        } else {
            $this->load->view('login');
        }
    }

    public function edit($id = '') { //this is use for edit records start
        //print_r($id); die();
        if (isset($this->session->userdata['is_admin_login'])) {
            $data['page'] = 'Featured Plates';
            $data['ckeditor'] = true;
            $data['gridTable'] = false;
            if ($id != '') {
                $data['featured_plates'] = $this->featured_plates_model->get_featured_plates_by_id($id);
                $this->form_validation->set_rules('category_id', 'category', 'required');
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('status', 'status', 'required');

                $formSubmit = $this->input->post('Submit');
                if ($formSubmit == "Update") {
                    if ($this->form_validation->run() === TRUE) {

                        $data['error'] = "";
                        $img_name=$data['featured_plates']->images_path;
                        if (!empty($_FILES['plate_images']['name'])) {
                            $tmp = $_FILES['plate_images']['name'];
                            $ext = explode('.', $tmp);
                            $extension = strtolower($ext[1]);

                            $today = date('mdyHis');
                            $img_name = $today . '.' . $extension;
                        }

                        if (!empty($_FILES['plate_images']['name'])) {
                            $pathMain = './assets/uploads/featured_plates/';
                                if (!is_dir($pathMain))
                                    mkdir($pathMain, 0755);

                            $configImage['upload_path'] = $pathMain;
                            $configImage['max_size'] = '10240';
                            $configImage['allowed_types'] = 'gif|jpg|jpeg|png';
                            $configImage['file_name'] = $img_name;

                            $this->load->library('upload', $configImage);
                            $this->upload->initialize($configImage);
                            if (!$this->upload->do_upload('plate_images')) {
                               $data['error']="Image not upload"; 
                            } else {
                                $this->load->library('image_lib');
                                $this->image_lib->clear();
                    
                            }
                        }
                        
                        $data = array(
                        'category_id' => $this->input->post('category_id'),
                        'name' => $this->input->post('name'),
                        'images_path' => $img_name,
                        'status' => $this->input->post('status')
                        );
                        $tblName = "featured_plates";
                        $this->common->update_record("id", $id, $tblName, $data);
                        
                        $this->session->set_flashdata('msg', 'Featured Plates has been updated successfully.');
                        
                        redirect('admin/featured-plates/edit/'.$id, 'refresh');
                    }
                }
                
                $data['categories'] = $this->category_model->get_category();
                $this->load->view('admin/controls/vwHeader');
                $this->load->view('admin/controls/vwLeft', $data);
                $this->load->view('admin/vwEditFeaturedPlates', $data);
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
