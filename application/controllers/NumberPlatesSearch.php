<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class NumberPlatesSearch extends CI_Controller {

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
        $this->load->model('Search_model','search_modal');
        $this->load->model('StaticPages_model','content');
        $this->load->model('Favourite_model','favourite');
        $this->load->helper('string');
        $this->load->model('Email_settings_model','email_settings');
        $this->load->helper('common_helper');
        set_time_limit(0);
        ini_set('memory_limit', '20000M');
    }

    public function index() {
    		$data = array();
            $data['page'] = 'Moonstone';
            $data['currentPage']='2';
            $search=$this->input->get('search');
            $type=$this->input->get('type');
            $addition_search=$this->input->get('addition_search');
            if($search==''){
                redirect('buy');
            }
            $this->session->set_userdata('search_type', $search);
            if(!empty($search) && !empty($this->session->userdata('user_id'))) {
              $condi = "user_id = ". $this->session->userdata('user_id') ." AND string = '". $search ."'";
              $recommended_number_plates = $this->select_model->get_recommended_number_plates($condi);
              if(count($recommended_number_plates) == 0) {
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'string' => $search
                );
                $tblName = "recommended_number_plates";
                $this->common->insert_record($tblName, $data);
              }
            }
            $data['numbers_data'] = $this->search_modal->get_cherished_plates_by_search($search,$type,$addition_search);
            // print_r($data['numbers_data']);
            // die();
            $data['prefix_numbers_data'] = $this->search_modal->get_prefix_plates_by_search($search,$type,$addition_search);
            $data['new_numbers_data'] = $this->search_modal->get_new_plates_by_search($search,$type,$addition_search);

            $data['search_type'] = $this->session->userdata('search_type');

            $this->session->unset_userdata('search_type'); 
            
            $data['search'] = $search;
            $data['type'] = $type;
            $data['addition_search'] = $addition_search;
            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwNumberPlatesSearch',$data);
            $this->load->view('controls/vwFooter',$data);
    }

    public function loadmore(){
      $limit = $this->input->post('limit');
      $offset = $this->input->post('offset');
      $search = $this->input->post('search');
      $type = $this->input->post('type');
      $addition_search = $this->input->post('addition_search');

      $data['offset'] = $offset + 48;
      $data['limit'] = $limit + 48;
      if($type == 'prefix') {
        $plate_type=2;
        $result = $this->search_modal->get_prefix_plates_by_loadmore($search, $limit, $offset,$addition_search);
      }
      elseif ($type == 'new') {
        $plate_type=3;
        $result = $this->search_modal->get_new_plates_by_loadmore($search, $limit, $offset,$addition_search);
      }
      elseif ($type == 'cherished') {
        $plate_type=1;
        $result = $this->search_modal->get_cherished_plates_by_loadmore($search, $limit, $offset,$addition_search);
      }      
      if(is_array($result) && count($result) > 0) {
        
        $view = '<div id="load_more_'.$data['limit'].'">';
        foreach ($result as $key => $value) {

            $dvla_price = $this->config->item('dvla_price');
            $tex_percentage=$this->config->item('tex_percentage');
            $is_vat_apply=1;
            if($value['plate_type']=='1'){
                $is_vat_apply=check_vat_apply($value['id']);
            }
            $tax=0;
            if($is_vat_apply==1){
                $tax=floatval(($value['price']*$tex_percentage)/100);
            }
            $plates_price=$value['price'];
            $plate_type=$value['plate_type'];
            $platePriceobj=total_product_price($plate_type,$plates_price,$is_vat_apply);
            $SubplatePrice=$platePriceobj['SubplatePrice'];
            $totalprice=$platePriceobj['totalPrice'];
            $tax=$platePriceobj['vat_cost'];
            $apply_poa= $value['apply_poa'] ?? 0;
            $view .= '
                    <input type="hidden" id="charge_'.$value['id'].'" value="'.$value['price'].'">
                    <input type="hidden" id="nm_'.$value['id'].'" value="'.$value['number'].'">
                    <input type="hidden" id="type_'.$value['id'].'" value="'.$value['plate_type'].'">
                    <div class="num-plate-box">
                  <div class="num-plate-box-inn buy_pop_up" data-number="'.$value['number'].'" data-price="'.$value['price'].'" data-id="'.$value['id'].'">'.$value['number'].'</div>
                  <div class="num-plate-box-bot-sec">
                     <div class="num-plate-price">';
                if($apply_poa=='1'){
                 $view .='POA';
                }else{
                    $view .='£'.number_format($totalprice, '2').'';
                }                 
            $view .='</div>
                     <a href="javascript:void(0)" class="num-plate-view" data-number="'.$value['number'].'" data-price="'.$totalprice.'" data-id="'.$value['id'].'">View plate</a>
                  </div>
               </div>';
      
        }
        $view .= '</div>';
      }
      $data['view'] = $view;
      echo json_encode($data);
    }


    public function cherished_plates() {
            $data = array();
            $data['page'] = 'Moonstone';
            $data['currentPage']='2';
            $filter_text=$this->input->get('search');
            $data['numbers_data'] = $this->search_modal->get_plates_by_search($filter_text);
            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwNumberPlatesSearch',$data);
            $this->load->view('controls/vwFooter',$data);
    }

    public function show_modal(){
        $status=1;
        $msg="Ok";
        $data['plate_id']=$this->input->get('plate_id');
        $data['plates_number']=$this->input->get('plates_number');
        $data['plates_price']=$this->input->get('plates_price');
        $data['plate_type']=$this->input->get('plates_type');
        $data['is_number_favourite']=$this->favourite->check_favourite_number($data['plate_id']);
        $condi=array(
            'id' =>$data['plate_id']
            );
        $plates_details = $this->search_modal->get_plates_by_details($data['plate_id'],$data['plate_type']);
        $data['plates_details'] = $plates_details ?? 0;
        $modal_html=$this->load->view('vwNumberModal', $data, TRUE);
        echo json_encode(['status' => $status, 'msg' => $msg,'data'=>$data,'modal_html'=>$modal_html]);
    }
    public function show_poa_modal(){
        $status=1;
        $msg="Ok";
        $data['plate_id']=$this->input->get('plate_id');
        $data['plates_number']=$this->input->get('plates_number');
        $data['plates_price']=$this->input->get('plates_price');
        $data['plate_type']=$this->input->get('plates_type');
        $data['is_number_favourite']=$this->favourite->check_favourite_number($data['plate_id']);
        $data['first_name'] = $this->session->userdata('first_name') ?? '';
        $data['last_name'] = $this->session->userdata('last_name') ?? '';
        $data['email'] = $this->session->userdata('email') ?? '';
        
        $modal_html=$this->load->view('vwPOAModal', $data, TRUE);
        echo json_encode(['status' => $status, 'msg' => $msg,'data'=>$data,'modal_html'=>$modal_html]);
    }
     public function favourite(){
        $status=1;
        $msg="Ok";
        $data['plate_id']=$this->input->get('plate_id');
        $data['plates_number']=$this->input->get('plates_number');
        $data['plates_price']=$this->input->get('plates_price');
        $data['is_number_favourite']=$this->input->get('is_number_favourite');
        $data['plate_type']=$this->input->get('plate_type');
        $is_number_favourite = $this->favourite->favourite_number($data);
            $user_id=$this->session->userdata('user_id');
            $first_name=$this->session->userdata('first_name');
            $last_name=$this->session->userdata('last_name');
            $name=$first_name." ".$last_name;

            $title=$name." has removed pleate (".$data['plates_number'].") from favorite.";
            if($is_number_favourite==1){
                $title=$name." has added pleate (".$data['plates_number'].") in favorite.";
            }
            //add notification
                $ndata['user_id']=$user_id;
                $ndata['title']=$title;
                $ndata['is_read']=0;
                $this->common->add_notification_record($ndata);

                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $mail_message='Dear Sir,'. "<br>";
                $mail_message.="".$ndata['title']."</b>"."\r\n";
                $mail_message.="<br><br><br>Thanks & Regards";
                $mail_message.="<br>Moonstone plates";
                $this->email->set_mailtype("html");
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                $this->email->to("notifications@moonstoneplates.com");
                $this->email->subject($ndata['title']);
                $this->email->message($mail_message);
                $this->email->send();
              //end notification

        echo json_encode(['status' => $status, 'msg' => $msg,'data'=>$data,'is_number_favourite'=>$data['is_number_favourite']]);
    }
    public function offer_check(){
        
            $status = 0;
            $msg = "Something went wrong.";
            $formSubmit = $this->input->post('submit');
            
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('offer_message', 'Message', 'required');

            if ($this->form_validation->run() == FALSE){

                $errors = validation_errors();
                $status = 0;
                $msg = $errors;

            }else{

                $subject = $this->input->post('subject');
                $offer_message = strip_tags($this->input->post('offer_message'));
                $offer_plate_id = $this->input->post('offer_plate_id');
                $offer_plate_number = $this->input->post('offer_plate_number');
                $user_id = !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
                
                $data = array(
                    'user_id' => $user_id,
                    'plates_id' => $offer_plate_id,
                    'plates_number' => $offer_plate_number,
                    'message' => $offer_message,
                    'type' => 1
                );
                $tblName = "plate_enquiry";

                $inser_id = $this->common->insert_record($tblName, $data);
                $status = 1;
                $email_settings = $this->email_settings->get_email_settings_content_by_id('1'); 
                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                $this->email->to($email_settings->offer_mail);

                $body = 'Hi Admin, <br> A new offer received.';
                $this->email->subject('Moonstoneplates offer received');
                $this->email->message($body);
                $this->email->send();
                $msg = "Send message successfully.";

                //add notification
                $ndata['user_id']=$user_id;
                $ndata['title']="New offer received for this plate (".$offer_plate_number.").";
                $ndata['is_read']=0;
                $this->common->add_notification_record($ndata);

                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $mail_message='Dear Sir,'. "<br>";
                $mail_message.="".$ndata['title']."</b>"."\r\n";
                $mail_message.="<br><br><br>Thanks & Regards";
                $mail_message.="<br>Moonstone plates";
                $this->email->set_mailtype("html");
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                $this->email->to("notifications@moonstoneplates.com");
                $this->email->subject($ndata['title']);
                $this->email->message($mail_message);
                $this->email->send();
              //end notification

                

            }
            echo json_encode(['status' => $status, 'msg' => $msg]);
        
    }
    public function poa_check(){
        
            $status = 0;
            $msg = "Something went wrong.";
            $formSubmit = $this->input->post('submit');
            
            $this->form_validation->set_rules('first_name', 'first name', 'required');
            $this->form_validation->set_rules('last_name', 'last name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('mobile_number', 'mobile number', 'required');
            $this->form_validation->set_rules('poa_type', 'poa type', 'required');
            $this->form_validation->set_rules('message', 'message', 'required');

            if ($this->form_validation->run() == FALSE){

                $errors = validation_errors();
                $status = 0;
                $msg = $errors;

            }else{

                $plate_id = $this->input->post('plate_modal_id');
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email = $this->input->post('email');
                $mobile_number = $this->input->post('mobile_number');
                $poa_type = $this->input->post('poa_type');
                $message = $this->input->post('message');
                $user_id = !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
                $name=$first_name." ".$last_name;
                $data = array(
                    'plate_id' => $plate_id,
                    'user_id' => $user_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'mobile_number' => $mobile_number,
                    'poa_type' => $poa_type,
                    'message' => $message
                );
                $tblName = "poa_enquiry";

                $inser_id = $this->common->insert_record($tblName, $data);
                $status = 1;
                $msg = "Send POA enquiry message successfully.";

                //add notification
                $ndata['user_id']=$user_id;
                $ndata['title']="POA enquiry (".$name.") message received.";
                $ndata['is_read']=0;
                $this->common->add_notification_record($ndata);

                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $mail_message='Dear Sir,'. "<br>";
                $mail_message.="".$ndata['title']."</b>"."\r\n";
                $mail_message.="<br><br><br>Thanks & Regards";
                $mail_message.="<br>Moonstone plates";
                $this->email->set_mailtype("html");
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                $this->email->to("notifications@moonstoneplates.com");
                $this->email->subject($ndata['title']);
                $this->email->message($mail_message);
                $this->email->send();
              //end notification
            }
            echo json_encode(['status' => $status, 'msg' => $msg]);
        
    }
    public function enquiry_check(){
        
            $status = 0;
            $msg = "Something went wrong.";
            $formSubmit = $this->input->post('submit');
            
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('enquire_message', 'Message', 'required');

            if ($this->form_validation->run() == FALSE){

                $errors = validation_errors();
                $status = 0;
                $msg = $errors;

            }else{

                $subject = $this->input->post('subject');
                $enquire_message = $this->input->post('enquire_message');
                $enquiry_plate_id = $this->input->post('enquiry_plate_id');
                $enquiry_plate_number = $this->input->post('enquiry_plate_number');
                $user_id = !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
                
                $data = array(
                    'user_id' => $user_id,
                    'plates_id' => $enquiry_plate_id,
                    'plates_number' => $enquiry_plate_number,
                    'message' => $enquire_message,
                    'type' => 2
                );
                $tblName = "plate_enquiry";

                $inser_id = $this->common->insert_record($tblName, $data);
                $status = 1;
                $email_settings = $this->email_settings->get_email_settings_content_by_id('1'); 
                $this->load->config('email');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $from = $this->config->item('smtp_user');
                $this->email->from($from);
                $this->email->to($email_settings->enquiries_mail);

                $body = 'Hi Admin, <br> A new enquiry received.';
                $this->email->subject('Moonstoneplates enquiry received');
                $this->email->message($body);
                $this->email->send();
                $msg = "Send message successfully.";

                 //add notification
                    $ndata['user_id']=$user_id;
                    $ndata['title']="New enquiry received for this plate (".$enquiry_plate_number.").";
                    $ndata['is_read']=0;
                    $this->common->add_notification_record($ndata);

                    $this->load->config('email');
                    $this->load->library('email');
                    $this->email->set_newline("\r\n");
                    $mail_message='Dear Sir,'. "<br>";
                    $mail_message.="".$ndata['title']."</b>"."\r\n";
                    $mail_message.="<br><br><br>Thanks & Regards";
                    $mail_message.="<br>Moonstone plates";
                    $this->email->set_mailtype("html");
                    $from = $this->config->item('smtp_user');
                    $this->email->from($from);
                    $this->email->to("notifications@moonstoneplates.com");
                    $this->email->subject($ndata['title']);
                    $this->email->message($mail_message);
                    $this->email->send();
                  //end notification
                

            }
            echo json_encode(['status' => $status, 'msg' => $msg]);
        
    }
    
    public function social_share() {
            $data = array();
            $data['page'] = 'Social Share';
            $data['currentPage']='20';
            $plate_id =  $this->uri->segment(3);
            $search =  $this->uri->segment(4);
            $plate_type =  $this->uri->segment(5);
            $social_share = $this->search_modal->get_plates_by_details($plate_id, $plate_type);
            if(isset($_GET['fbclid']) && !empty($_GET['fbclid'])) {
                redirect('/reg?search=' . $search);
            }
            $share_dvla_price = $this->config->item('dvla_price');
            $share_totalprice = $social_share['price'] + $share_dvla_price;
            $data['description'] = 'Number plate for selected model is: ' . $social_share['number'] . ' and price for this ride is: £' . number_format($share_totalprice, '2');
            $data['title'] = 'Moonstone'; 
            $data['plate_type'] = $plate_type; 
            $data['plate_id'] = $plate_id; 
            $data['search'] = $search; 
            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwSocialShare',$data);
            $this->load->view('controls/vwFooter',$data);
    }
}

