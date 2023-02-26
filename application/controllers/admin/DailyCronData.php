<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DailyCronData extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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
			
        $data = array();
        $data['page'] = 'Daily Cron Data';
        $data['currentPage']='10';
        $this->load->view('admin/controls/vwHeader');
        $this->load->view('admin/controls/vwLeft', $data);
        $this->load->view('admin/vwManageDailyCronData', $data);
        $this->load->view('admin/controls/vwFooter');
    }

    public function get_cron_items()
   {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));
      // $this->db->order_by("id", "desc");
      if($length != -1){
            $this->db->limit($length, $start);
      }
      $query = $this->db->get("daily_cron_update");
      $data = [];
      foreach($query->result() as $r) {
           $data[] = array(
                $r->plate_number,
                $r->type,
                $r->plate_type,
                $r->plate_id,
                $r->cron_date
           );
      }
      $total_count=$this->select_model->get_total_cron_data();
      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $total_count,
                 "recordsFiltered" => $total_count,
                 "data" => $data
            );
      echo json_encode($result);
      exit();
   }
}

