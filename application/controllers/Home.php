<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $this->load->model('Newsletter_subscription_model','newslatter');
        $this->load->model('Home_page_content_model','home_page_content');
        $this->load->model('StaticPages_model','content');
        $this->load->helper('string');
    }

    public function index() {
			
		$data = array();
        $data['page'] = 'Moonstone';
        $data['currentPage']='1';
        $data['content_page'] = $this->home_page_content->get_home_page_content_by_id(1);

        $fields = "id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username,name";
        $token = $this->config->item('instagram_token');

        $limit = 8;

        $json_feed_url="https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
        $json_feed = @file_get_contents($json_feed_url);
        $contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);
        if(isset($contents["data"]) && $contents["data"]){
            $data['instagramposts']=$contents["data"];
        }

        $this->load->view('controls/vwHeader',$data);
        $this->load->view('vwHome',$data);
        $this->load->view('controls/vwFooter',$data);
    }

    public function sendnewslatter()
    {
        if($this->input->get('email')!="")
        {
                $tblName = "newsletter_subscription";
                $data = array(
                'email' => $this->input->get('email'),
                'create_date' => date('Y-m-d'),
                'is_active'=>'1',
                'ip_address' => $this->input->ip_address()
            
                );
                $this->common->insert_record($tblName,$data);

                // add notification

                    $user_id = !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
                    $ndata['user_id']=$user_id;
                    $ndata['title']="Newsletter subscription successfully (".$this->input->get('email').").";
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
                //     end notification

                echo"success"; 
                
        }
        
    }
    public function duplicate_email_validation()
    {
        $email=$this->input->get_post('email');
        echo $this->newslatter->duplicate_email($email);
    }

    public function search_number_plates($filter_text)
    {
        $file = './assets'.DIRECTORY_SEPARATOR."number_plates.json";
        
        $data = file_get_contents($file);
        $data_array=json_decode($data,1);
        $number_data=[];
        foreach ($data_array as $key => $data_array_value) {
            $number_data[]=$data_array_value['letters'].' '.$data_array_value['numbers'];
        }
        echo "<pre>";
        // print_r($number_data); die();
        $filter_data=array();
        // $filter_text="69869";
        $number_count=0;
        while (strlen($filter_text)>0) {
            foreach ($number_data as $nkey => $number_value) {
                if(strpos($number_value,$filter_text)!== FALSE && $number_count<100){
                  $filter_data[]=$number_value;
                  $number_count++;
                }
            }
            $filter_text=substr_replace($filter_text ,"", -1);
        }
        print_r($filter_data);

    }

public function insta($api_url){


    $connection_c = curl_init(); // initializing
    curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
    curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
    curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
    $json_return = curl_exec( $connection_c ); // connect and get json data
    curl_close( $connection_c ); // close connection
    return json_decode( $json_return ); // decode and return


}

public function test(){


$return = $this->insta("https://graph.instagram.com/me/media?fields=id,caption&access_token=xyz");

}


}

