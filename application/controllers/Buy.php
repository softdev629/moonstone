<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buy extends CI_Controller {

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
        $this->load->model('Category_model', 'category_model');
        $this->load->model('Search_model','search_modal');
        $this->load->model('FeaturedPlates_model', 'featured_plates_model');
        $this->load->model('Buy_page_content_model','buy_page_content');
        $this->load->model('Buy_model','buy_modal');
        $this->load->model('StaticPages_model','content');
        $this->load->helper('string');
    }

    public function index() {
			
    		$data = array();
            $data['page'] = 'Moonstone';
            $data['currentPage']='2';
            $data['featured_plates'] = $this->select_model->get_featured_plates();
            $data['categories'] = $this->category_model->get_category();
            $data['content_page'] = $this->buy_page_content->get_buy_page_content_by_id(1);
            $data['is_login'] = !empty($this->session->userdata('user_id')) ? 'in_logged' : 'out_logged';
            if($this->session->userdata('user_id')) {
              $condi = "user_id = ". $this->session->userdata('user_id') ."";
              $data['featured_list'] = $this->select_model->get_favourite_list($condi);

              $condi_rec = "user_id = ". $this->session->userdata('user_id') ."";
              $recommended = $this->select_model->get_recommended_number_plates($condi_rec, '', '', 'create_date desc');
              $recommended_plates = array();
              if(is_array($recommended) && count($recommended) > 0) {
                $recommended_data = array();
                foreach ($recommended as $key => $value) {
                  $recommended_data['numbers_data'] = $this->search_modal->get_cherished_plates_by_search($value['string']);
                  $recommended_data['prefix_numbers_data'] = $this->search_modal->get_prefix_plates_by_search($value['string']);
                  $recommended_data['new_numbers_data'] = $this->search_modal->get_new_plates_by_search($value['string']);
                  if(count($recommended_data) > 0) {
                    break;
                  }
                }
                $recommended_data = array_filter($recommended_data);                
                foreach ($recommended_data as $key => $value) {
                  $recommended_plates = array_merge($recommended_plates, $value);
                }                
              }
              $data['recommended_number_plates'] = $recommended_plates;

            }
             //           $condi = "private = '1'";
            //            $condi = "private = '1'";
            $condi=array(
            'private' =>1,
            'status' =>1,
            'company_id' => '20'
            );

            $data['cherished_plates_list'] = $this->select_model->get_cherished_plates($condi);

            $fields = "id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username";
            $token = $this->config->item('instagram_token');
            $limit = 8;
            $json_feed_url="https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
            $json_feed = @file_get_contents($json_feed_url);
            $contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);
            if(isset($contents["data"]) && $contents["data"]){
                $data['instagramposts']=$contents["data"];
            }
            $this->load->view('controls/vwBuyHeader',$data);
            $this->load->view('vwBuy',$data);
            $this->load->view('controls/vwBuyFooter',$data);
		
    }

    public function get_filter_featured_plates()
    {
        $featured_plates=$this->featured_plates_model->get_featured_plates_by_category_id($this->input->get_post('id'));
        $data['featured_plates']=$featured_plates;
        $html=$this->load->view('vwFeaturedPlatesList', $data);
        return $html;
    }

    public function add_number_plates_cart()
    {
        echo $this->buy_modal->product_cart_add($this->input->get_post('product_id'),1,$this->input->get_post('plate_type'));
        
    }
}

