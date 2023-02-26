<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search_modelbkup extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_cherished_plates_by_search($search,$type='')
    {   
        $file_name="number_plates.json";
        $file = './assets/number_json/Cherished'.DIRECTORY_SEPARATOR."".$file_name;
        
        $data = file_get_contents($file);
        $data_array=json_decode($data,1);
        $number_data=[];
        foreach ($data_array as $key => $data_array_value) {
            $numbers['number']=$data_array_value['letters'].' '.$data_array_value['numbers'];
            $numbers['price']=$data_array_value['price'];
            $numbers['plate_id']=md5($data_array_value['letters'].' '.$data_array_value['numbers']);
            $number_data[]=$numbers;
        }
        $filter_data=array();
        $number_count=0;
        if($search!=""){
            while (strlen($search)>0) {
            foreach ($number_data as $nkey => $number_value) {
                if(strpos($number_value['number'],strtoupper($search))!== FALSE && $number_count<12){
                  $filter_number['number']=$number_value['number'];
                  $filter_number['price']=$number_value['price'];
                  $filter_number['plate_id']=$number_value['plate_id'];
                  $filter_number['plate_type']=1;
                  $filter_number['plate_file']=$file_name;
                  $filter_data[]=$filter_number;
                  $number_count++;
                }elseif(strpos($number_value['number'],strtoupper($search))!== FALSE){
                    if($type!=''){
                    $filter_number['number']=$number_value['number'];
                    $filter_number['price']=$number_value['price'];
                    $filter_number['plate_id']=$number_value['plate_id'];
                    $filter_number['plate_type']=1;
                    $filter_number['plate_file']=$file_name;
                    $filter_data[]=$filter_number;
                    }
                }
                
            }
            $search=substr_replace($search ,"", -1);
            }
        }else{
            foreach ($number_data as $nkey => $number_value) {
                if($number_count<99){
                  $filter_number['number']=$number_value['number'];
                  $filter_number['price']=$number_value['price'];
                  $filter_number['plate_id']=$number_value['plate_id'];
                  $filter_number['plate_type']=1;
                  $filter_number['plate_file']=$file_name;
                  $filter_data[]=$filter_number;
                  $number_count++;
                }
            }
        }
        return $filter_data;
    }

    function get_prefix_plates_by_search($search,$type='')
    {   

        if($search!=""){
            
            $filter_data=array();
            $number_count=0;
            $file_count=1;
            for ($x = 1; $x <= 15; $x++) {
                  if($number_count>99){
                    continue;
                  }
                  $file_name = "prefix_plates_".$x.".json";
                  $source_file = './assets/number_json/Prefix'.DIRECTORY_SEPARATOR."".$file_name;
                  
                  $data = file_get_contents($source_file);
                  $number_data=json_decode($data,1);
                  // $number_data=[];
                  // foreach ($data_array as $key => $data_array_value) {
                  //     $numbers['number']=$data_array_value['letters'].' '.$data_array_value['numbers'];
                  //     $numbers['price']=$data_array_value['price'];
                  //     $numbers['plate_id']=md5($data_array_value['letters'].' '.$data_array_value['numbers']);
                  //     $number_data[]=$numbers;
                  // }

                  while (strlen($search)>0) {
                      
                      foreach ($number_data as $nkey => $number_value) {
                          $plate_number=$number_value['letters'].' '.$number_value['numbers'];
                          $plate_id=md5($plate_number);
                          if(strpos($plate_number,strtoupper($search))!== FALSE && $number_count<12){
                            $filter_number['number']=$plate_number;
                            $filter_number['price']=$number_value['price'];
                            $filter_number['plate_id']=$plate_id;
                            $filter_number['plate_type']=2;
                            $filter_number['plate_file']=$file_name;
                            $filter_data[]=$filter_number;
                            $number_count++;
                          }elseif(strpos($plate_number,strtoupper($search))!== FALSE){
                              if($type!=''){
                              $filter_number['number']=$plate_number;
                              $filter_number['price']=$number_value['price'];
                              $filter_number['plate_id']=$plate_id;
                              $filter_number['plate_type']=2;
                              $filter_number['plate_file']=$file_name;
                              $filter_data[]=$filter_number;
                              $number_count++;
                              }
                          }
                              
                      }
                      $search=substr_replace($search ,"", -1);
                  }
                  
            }
        }else{

            $number_count=0;
            $file_count=1;
            for ($x = 1; $x <= 15; $x++) {
                  if($number_count>99){
                    continue;
                  }
                  $file_name = "prefix_plates_".$x.".json";
                  $source_file = './assets/number_json/Prefix'.DIRECTORY_SEPARATOR."".$file_name;
                  
                  $data = file_get_contents($source_file);
                  $number_data=json_decode($data,1);
                  // $number_data=[];
                  // foreach ($data_array as $key => $data_array_value) {
                  //     $numbers['number']=$data_array_value['letters'].' '.$data_array_value['numbers'];
                  //     $numbers['price']=$data_array_value['price'];
                  //     $numbers['plate_id']=md5($data_array_value['letters'].' '.$data_array_value['numbers']);
                  //     $number_data[]=$numbers;
                  // }
                  foreach ($number_data as $nkey => $number_value) {
                    $plate_number=$number_value['letters'].' '.$number_value['numbers'];
                    $plate_id=md5($plate_number);
                      if($number_count<99){
                        $filter_number['number']=$plate_number;
                        $filter_number['price']=$number_value['price'];
                        $filter_number['plate_id']=$plate_id;
                        $filter_number['plate_type']=2;
                        $filter_number['plate_file']=$file_name;
                        $filter_data[]=$filter_number;
                      }
                      $number_count++;
                  }
            }
        }
        return $filter_data;
    }

    function get_new_plates_by_search($search,$type='')
    {   

        if($search!=""){
            
            $filter_data=array();
            $number_count=0;
            $file_count=1;
            for ($x = 1; $x <= 15; $x++) {
                  if($number_count>99){
                    continue;
                  }
                  $file_name = "prefix_plates_".$x.".json";
                  $source_file = './assets/number_json/New'.DIRECTORY_SEPARATOR."".$file_name;
                  
                  $data = file_get_contents($source_file);
                  $number_data=json_decode($data,1);
                  // $number_data=[];
                  // foreach ($data_array as $key => $data_array_value) {
                  //     $numbers['number']=$data_array_value['letters'].' '.$data_array_value['numbers'];
                  //     $numbers['price']=$data_array_value['price'];
                  //     $numbers['plate_id']=md5($data_array_value['letters'].' '.$data_array_value['numbers']);
                  //     $number_data[]=$numbers;
                  // }

                  while (strlen($search)>0) {
                      
                      foreach ($number_data as $nkey => $number_value) {
                          $plate_number=$number_value['letters'].' '.$number_value['numbers'];
                          $plate_id=md5($plate_number);
                          if(strpos($plate_number,strtoupper($search))!== FALSE && $number_count<12){
                            $filter_number['number']=$plate_number;
                            $filter_number['price']=$number_value['price'];
                            $filter_number['plate_id']=$plate_id;
                            $filter_number['plate_type']=2;
                            $filter_number['plate_file']=$file_name;
                            $filter_data[]=$filter_number;
                            $number_count++;
                          }elseif(strpos($plate_number,strtoupper($search))!== FALSE){
                              if($type!=''){
                              $filter_number['number']=$plate_number;
                              $filter_number['price']=$number_value['price'];
                              $filter_number['plate_id']=$plate_id;
                              $filter_number['plate_type']=2;
                              $filter_number['plate_file']=$file_name;
                              $filter_data[]=$filter_number;
                              $number_count++;
                              }
                          }
                              
                      }
                      $search=substr_replace($search ,"", -1);
                  }
                  
            }
        }else{

            $number_count=0;
            $file_count=1;
            for ($x = 1; $x <= 15; $x++) {
                  if($number_count>99){
                    continue;
                  }
                  $file_name = "prefix_plates_".$x.".json";
                  $source_file = './assets/number_json/New'.DIRECTORY_SEPARATOR."".$file_name;
                  
                  $data = file_get_contents($source_file);
                  $number_data=json_decode($data,1);
                  //$number_data=[];
                  // foreach ($data_array as $key => $data_array_value) {
                  //     $numbers['number']=$data_array_value['letters'].' '.$data_array_value['numbers'];
                  //     $numbers['price']=$data_array_value['price'];
                  //     $numbers['plate_id']=md5($data_array_value['letters'].' '.$data_array_value['numbers']);
                  //     $number_data[]=$numbers;
                  // }
                  foreach ($number_data as $nkey => $number_value) {
                      $plate_number=$number_value['letters'].' '.$number_value['numbers'];
                      $plate_id=md5($plate_number);
                      if($number_count<99){
                        $filter_number['number']=$plate_number;
                        $filter_number['price']=$number_value['price'];
                        $filter_number['plate_id']=$plate_id;
                        $filter_number['plate_type']=2;
                        $filter_number['plate_file']=$file_name;
                        $filter_data[]=$filter_number;
                      }
                      $number_count++;
                  }
            }
        }
        return $filter_data;
    }

    function get_plates_by_details($plate_id)
    {
        $file_name="number_plates.json";
        $file = './assets/number_json/Cherished'.DIRECTORY_SEPARATOR."".$file_name;
        
        $data = file_get_contents($file);
        $data_array=json_decode($data,1);
        $number_data=[];
        foreach ($data_array as $key => $data_array_value) {
            if($plate_id==md5($data_array_value['letters'].' '.$data_array_value['numbers'])){
                $numbers['number']=$data_array_value['letters'].' '.$data_array_value['numbers'];
                $numbers['price']=$data_array_value['price'];
                $numbers['plate_id']=md5($data_array_value['letters'].' '.$data_array_value['numbers']);
                $number_data=$numbers;
            }
        }
        return $number_data;
    }

}
