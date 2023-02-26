<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Favorite extends CI_Controller {

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
        $this->load->model('StaticPages_model','content');
        $this->load->model('Faqs_model','faqs');
        $this->load->helper('string');
    }

    public function index() {
        if ($this->session->userdata('is_client_login'))
        { 
            $client_login=$this->session->userdata('client_login');
            $data = array();
            $data['page'] = 'Favorite';
            $data['currentPage']='8';
            $condition = "favourite.user_id='".$client_login['user_id']."' and favourite.is_number_favourite='1'";
            $join_arr[0]['table_name']="cherished_plates";
            $join_arr[0]['cond']="cherished_plates.plate_id = favourite.plate_id and favourite.plate_type=1";
            $join_arr[0]['type']="left";
            $join_arr[1]['table_name']="prefix_plates";
            $join_arr[1]['cond']="prefix_plates.plate_id = favourite.plate_id and favourite.plate_type=2";
            $join_arr[1]['type']="left";
            $join_arr[2]['table_name']="new_plates";
            $join_arr[2]['cond']="new_plates.plate_id = favourite.plate_id and favourite.plate_type=3";
            $join_arr[2]['type']="left";
            $field = "favourite.*,cherished_plates.price as cherished_price,prefix_plates.price as prefix_price,new_plates.price as new_plates_price";
            $data['favorite_list']=$this->select_model->get_favorite($condition,$field,$join_arr);
            $data['client_login'] = $client_login;
            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwFavoriteList',$data);
            $this->load->view('controls/vwFooter',$data);
		}else{
            redirect('buy','refresh');
        }
    }
}

