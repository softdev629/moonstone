<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders extends CI_Controller {

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
        {   $client_login=$this->session->userdata('client_login');
            $data = array();
            $data['page'] = 'Order';
            $data['currentPage']='8';
            $data['content']=$this->content->get_static_page_by_id($data['currentPage']);
            $condition = "order.user_id='".$client_login['user_id']."'";
            $join_arr[0]['table_name']="user";
            $join_arr[0]['cond']="user.user_id = order.user_id";
            $join_arr[0]['type']="left";
            $join_arr[1]['table_name']="order_item";
            $join_arr[1]['cond']="order_item.order_id = order.order_id";
            $join_arr[1]['type']="left";
            $field = "";
            $data['order_list'] = $this->select_model->get_order_list($condition,$field,$join_arr);
            $data['client_login'] = $client_login;

            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwOrderList',$data);
            $this->load->view('controls/vwFooter',$data);
        }else{
            redirect('buy','refresh');
        }
    }

    public function order_details(){
        $status=1;
        $msg="Ok";
        $order_id=$this->input->get('order_id');
        $data['order_details'] = $this->select_model->get_myorder_detials($order_id);
        $modal_html=$this->load->view('vwOrderModal', $data, TRUE);
        echo json_encode(['status' => $status, 'msg' => $msg,'data'=>$data,'modal_html'=>$modal_html]);
    }

   
}

