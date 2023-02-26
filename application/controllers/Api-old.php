<?php
ini_set('max_execution_time', 0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {

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

public function test() {
    					$prefix='AA';
                        $numbers='02';
                        $letters='ANS';
                        $plate_number=$prefix." ".$numbers." ".$letters;

$data=array(
'status'=>2,
'date_updated'=>date("Y-m-d")
);
					   $this->update_model->update_new_plate_status($data, $prefix, $numbers, $letters);
					   $this->update_model->update_new_prefix_status($data, $prefix, $numbers, $letters);


}

    public function get_update_api() {
      $old_date=urlencode(date("Y-m-d", strtotime("-3 days")).' 00:00:00');
      $api_url="https://dvlaregistrations.dvla.gov.uk/api/updates?from=".$old_date."&format=string";
            //"https://dvlaregistrations.dvla.gov.uk/api/updates?from=2020-09-21%2000%3A00%3A00&format=string"
        $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_POSTFIELDS => "apikey=skgg8kg0ssw4wsskgso0o4wkcsgo4k80sc840wck",
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: f9230c7e-5a86-e5a1-d760-24ac7d1b6e2f",
                "x-api-key: skgg8kg0ssw4wsskgso0o4wkcsgo4k80sc840wck"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
              echo "cURL Error #:" . $err; 
              die();
            } else {

              $data_array=json_decode($response);
              //print_r($data_array); die();
              if($data_array){
                 foreach ($data_array as $data_key => $data_value) {

                        $prefix=$data_value->prefix;
                        $numbers=$data_value->numbers;
                        $letters=$data_value->letters;
$data=array(
'status'=>2,
'date_updated'=>date("Y-m-d")
);
					   $this->update_model->update_new_plate_status($data, $prefix, $numbers, $letters);
					   $this->update_model->update_new_prefix_status($data, $prefix, $numbers, $letters);

/**
                        $plate_number=$prefix." ".$numbers." ".$letters;
                        $plates_id=md5($plate_number);
//print($plates_id);
                        $type=$data_value->type;


                        if($type=='REMOVED'){

                            $data = array(
                            'status' => 2,
                            );
                            //if found so update in cherished_plates
                            $fieldName="plate_id";
                            $tblName="cherished_plates";
                            $id=$plates_id;
                            $where="plate_id";
                            $condition=$plates_id;
                            $field="id";
                            $cherished_plates_id=$this->common->GetValue($tblName,$field,$where,$condition);
                            if($cherished_plates_id>0){
                            $this->common->update_record($fieldName,$id,$tblName,$data);
                            }

                            //if found so update in prefix_plates
                            $fieldName="plate_id";
                            $tblName="prefix_plates_20201122_000003";
                            $id=$plates_id;
                            $prefix_plates_id=$this->common->GetValue($tblName,$field,$where,$condition);
                            if($prefix_plates_id>0){
                            $this->common->update_record($fieldName,$id,$tblName,$data);
                            }

                            //if found so update in prefix_plates
                            $fieldName="plate_id";
                            $tblName="new_plates_20201122_000003";
                            $id=$plates_id;
                            $new_plates_id=$this->common->GetValue($tblName,$field,$where,$condition);
                            if($new_plates_id>0){
                            $this->common->update_record($fieldName,$id,$tblName,$data);
                            }


                           
                            
                        }
                      */
                 }
              }
          
              echo "Plates data has been updated successfully.";
              die();
        }
    }
}

