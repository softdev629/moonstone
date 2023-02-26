<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Common_function_model','common');
    }
    function get_cherished_plates_by_search($search,$type='')
    {
      $search_data = array();
      $search_word = $this->getPossibleWord($search);
     // $search_data = $this->getPossibleString($search);


        $number_data=[];
        $this->db->select('id,number,plate_id,price');
        $this->db->from('cherished_plates');
        $this->db->where('status',1);
        $j = 1;
        $this->db->group_start();
        foreach ($search_word as $key => $value) {
          if($j == 1) {
            $this->db->like('number',$value);
          }
          $this->db->or_like('number', $value);
          $j++;
        }
        $this->db->group_end();
        $this->db->order_by("id");
        $query=$this->db->get();
        $number_data=$query->result_array();
        //echo $this->db->last_query();exit;

        $filter_data=array();
        $private_filter_data=array();
        $final_data=array();
        $number_count=0;

        // Private
        $private_number_data = [];
        $wr_con = array('status' => 1, 'private' => '1');
        $this->db->select('id,number,plate_id,price,private');
        $this->db->from('cherished_plates');
        $this->db->where($wr_con);
        $i = 1;
        $this->db->group_start();
        foreach ($search_word as $key => $value) {
          if($i == 1) {
            $this->db->like('number',$value);
          }
          $this->db->or_like('number', $value);
          $i++;
        }
        $this->db->group_end();
        $this->db->order_by("id");
        $private_query=$this->db->get();
        $private_number_data=$private_query->result_array();
        //echo $this->db->last_query();exit;
        if(is_array($private_number_data) && count($private_number_data) > 0) {
          foreach ($private_number_data as $nkey => $number_value) {
              if($number_count < 12){
                if(strlen($number_value['number']) == '9') {
                  $pos = strpos($number_value['number']," ");
                  if($pos == '2') {
                    $number = substr_replace($number_value['number'], "", 2, 1);
                    $filter_number['number']=$number;
                  }
                  else {
                    $filter_number['number']=$number_value['number'];
                  }
                }
                else {
                  $filter_number['number']=$number_value['number'];
                }
                $filter_number['price']=$number_value['price'];
                $filter_number['plate_id']=$number_value['plate_id'];
                $filter_number['private']=$number_value['private'];
                $filter_number['plate_type']=1;
                if(!isset($private_filter_data[$number_value['number']])){
                  $private_filter_data[$number_value['number']]=$filter_number;
                  $number_count++;
                }
              }
          }
        }
        
        if(count($private_filter_data) < 12) {
          $number_count = count($private_filter_data);
          if(is_array($number_data) && count($number_data) > 0) {
            foreach ($number_data as $nkey => $number_value) {
                if($number_count < 12){
                  if(strlen($number_value['number']) == '9') {
                    $pos = strpos($number_value['number']," ");
                    if($pos == '2') {
                      $number = substr_replace($number_value['number'], "", 2, 1);
                      $filter_number['number']=$number;
                    }
                    else {
                      $filter_number['number']=$number_value['number'];
                    }
                  }
                  else {
                    $filter_number['number']=$number_value['number'];
                  }
                  $filter_number['price']=$number_value['price'];
                  $filter_number['plate_id']=$number_value['plate_id'];
                  $filter_number['plate_type']=1;
                  if(!isset($filter_data[$number_value['number']])){
                    $filter_data[$number_value['number']]=$filter_number;
                    $number_count++;
                  }
                }
            }
          }
        }

        $final_data = array_merge($private_filter_data, $filter_data);
        ////        	 echo "<pre>";
////        	 print_r($number_data); die();
//        $filter_data=array();
//        $number_count=0;
//        if($search!=""){
//        	$search_array=$this->common->get_search_array($search);
////        	 echo "<pre>";
////        	 print_r($search_array); die();
//        	foreach ($search_array as $key => $search_val) {
//        		$resetLoop = true;
//        		foreach ($number_data as $nkey => $number_value){
//
//	                if(strpos($number_value['number'],strtoupper($search_val))!== FALSE && $number_count<12 && $resetLoop){
//	                  $filter_number['number']=$number_value['number'];
//	                  $filter_number['price']=$number_value['price'];
//	                  $filter_number['plate_id']=$number_value['plate_id'];
//	                  $filter_number['plate_type']=1;
//	                  if(!isset($filter_data[$number_value['number']])){
//	                  	  $filter_data[$number_value['number']]=$filter_number;
//		                  $number_count++;
//		                  $resetLoop=false;
//	                  }
//
//	                }elseif(strpos($number_value['number'],strtoupper($search_val))!== FALSE){
//	                    if($type!=''){
//	                    $filter_number['number']=$number_value['number'];
//	                    $filter_number['price']=$number_value['price'];
//	                    $filter_number['plate_id']=$number_value['plate_id'];
//	                    $filter_number['plate_type']=1;
//	                    if(!isset($filter_data[$number_value['number']])){
//	                    $filter_data[$number_value['number']]=$filter_number;
//	                	}
//	                    }
//	                }
//
//            	}
//        	}
//
//        	if($number_count<12){
//
//        		while (strlen($search)>0) {
//
//	        		$resetLoop = true;
//	        		foreach ($number_data as $nkey => $number_value){
//		                if(strpos($number_value['number'],strtoupper($search))!== FALSE && $number_count<12 && $resetLoop){
//		                  $filter_number['number']=$number_value['number'];
//		                  $filter_number['price']=$number_value['price'];
//		                  $filter_number['plate_id']=$number_value['plate_id'];
//		                  $filter_number['plate_type']=1;
//		                  if(!isset($filter_data[$number_value['number']])){
//			                  $filter_data[$number_value['number']]=$filter_number;
//			                  $number_count++;
//			                  //$resetLoop=false;
//		              	  }
//		                }elseif(strpos($number_value['number'],strtoupper($search))!== FALSE){
//		                    if($type!=''){
//		                    $filter_number['number']=$number_value['number'];
//		                    $filter_number['price']=$number_value['price'];
//		                    $filter_number['plate_id']=$number_value['plate_id'];
//		                    $filter_number['plate_type']=1;
//			                    if(!isset($filter_data[$number_value['number']])){
//			                    	$filter_data[$number_value['number']]=$filter_number;
//			                	}
//		                    }
//		                }
//	            	}
//	            	$search=substr_replace($search ,"", -1);
//        		}
//
//        	}
//
//        }else{
//            foreach ($number_data as $nkey => $number_value) {
//                if($number_count<99){
//                  $filter_number['number']=$number_value['number'];
//                  $filter_number['price']=$number_value['price'];
//                  $filter_number['plate_id']=$number_value['plate_id'];
//                  $filter_number['plate_type']=1;
//                  if(!isset($filter_data[$number_value['number']])){
//	                  $filter_data[$number_value['number']]=$filter_number;
//	                  $number_count++;
//              	  }
//                }
//            }
//        }

        return $final_data;
    }

    function getPossibleWord($search) {
      $return = array();
      $result = explode(' ', $search);
      $ret = array();
      $res = '';
      foreach ($result as $key => $value) {
        $ret = $this->common->get_search_array($value);
        if(is_array($ret) && count($ret) > 0) {
          foreach ($ret as $k => $v) {
            $res .= $this->getPossibleString($v) . ',';
          }
        }
      }
      $res = trim($res, ',');
      if(!empty($res)) {
       $return = explode(',', $res);
       $return = array_unique($return);
      }
      return $return;

    }
    function getPossibleString($search) {
      $result = array();
      $res = '';
      $search = str_replace(' ', '', $search);
      if($search) {
        if(strlen($search) == 1) {
          $result[] = $search;
        }
        else if(strlen($search) == 2) {
          $result[] = $search;
        }
        else if(strlen($search) == 3) {
          $result[] = $search;
//          $result[] = substr($search,0,2);
//          $result[] = substr($search,1,2);
        }
        else if(strlen($search) == 4) {
          $result[] = substr($search,0,3);
          $result[] = substr($search,1,3);
//          $result[] = substr($search,2,2);
//          $result[] = substr($search,0,2);
        }
        else if(strlen($search) == 5) {
          $result[] = substr($search,0,3);
          $result[] = substr($search,2,3);
          $result[] = substr($search,1,3);
//          $result[] = substr($search,2,2);
//          $result[] = substr($search,0,2);
        }
        else if(strlen($search) == 6) {
          $result[] = substr($search,0,3);
          $result[] = substr($search,2,3);
          $result[] = substr($search,3,3);
          $result[] = substr($search,1,3);
//          $result[] = substr($search,2,2);
//          $result[] = substr($search,0,2);
        }
        else if(strlen($search) == 7) {
          $result[] = substr($search,0,3);
          $result[] = substr($search,4,3);
          $result[] = substr($search,3,3);
          $result[] = substr($search,1,3);
//          $result[] = substr($search,2,2);
//          $result[] = substr($search,0,2);
        }
        else if(strlen($search) == 8) {
          $result[] = substr($search,0,3);
          $result[] = substr($search,4,3);
          $result[] = substr($search,3,3);
          $result[] = substr($search,5,3);
          $result[] = substr($search,1,3);
//          $result[] = substr($search,2,2);
//          $result[] = substr($search,0,2);
        }
//        $str = '';
//        if (preg_match('/\s/', $search)) {
//            $string = explode(' ', $search);
//            echo "<pre>";
//         print_r($string); die();
//
//        }

      }
      $res = implode(',', $result);
      return $res;
    }

    function get_prefix_plates_by_search($search,$type='')
    {

        $number_data=[];
        $search_word = $this->getPossibleWord($search);
        $this->db->select('id,number,plate_id,price');
        $this->db->from('prefix_plates');
        foreach ($search_word as $key => $value) {
          $this->db->or_like('number', $value);
        }
        $this->db->where('status',1);
        $this->db->order_by("id");
        $query=$this->db->get();
        $number_data=$query->result_array();
        $filter_data=array();
        $number_count=0;
        if(is_array($number_data) && count($number_data) > 0) {
          foreach ($number_data as $nkey => $number_value) {
              if($number_count < 12){
                if(strlen($number_value['number']) == '9') {
                  $pos = strpos($number_value['number']," ");
                  if($pos == '2') {
                    $number = substr_replace($number_value['number'], "", 2, 1);
                    $filter_number['number']=$number;
                  }
                  else {
                    $filter_number['number']=$number_value['number'];
                  }
                }
                else {
                  $filter_number['number']=$number_value['number'];
                }
                $filter_number['price']=$number_value['price'];
                $filter_number['plate_id']=$number_value['plate_id'];
                $filter_number['plate_type']=2;
                if(!isset($filter_data[$number_value['number']])){
                  $filter_data[$number_value['number']]=$filter_number;
                  $number_count++;
                }
              }
          }
        }

//        if($search!=""){
//        	$search_array=$this->common->get_search_array($search);
//        	// echo "<pre>";
//        	// print_r($search_array); die();
//        	foreach ($search_array as $key => $search_val) {
//        		$resetLoop = true;
//        		foreach ($number_data as $nkey => $number_value){
//
//	                if(strpos($number_value['number'],strtoupper($search_val))!== FALSE && $number_count<12 && $resetLoop){
//	                  $filter_number['number']=$number_value['number'];
//	                  $filter_number['price']=$number_value['price'];
//	                  $filter_number['plate_id']=$number_value['plate_id'];
//	                  $filter_number['plate_type']=2;
//	                  if(!isset($filter_data[$number_value['number']])){
//	                  	  $filter_data[$number_value['number']]=$filter_number;
//		                  $number_count++;
//		                  $resetLoop=false;
//	                  }
//
//	                }elseif(strpos($number_value['number'],strtoupper($search_val))!== FALSE){
//	                    if($type!=''){
//	                    $filter_number['number']=$number_value['number'];
//	                    $filter_number['price']=$number_value['price'];
//	                    $filter_number['plate_id']=$number_value['plate_id'];
//	                    $filter_number['plate_type']=2;
//	                    if(!isset($filter_data[$number_value['number']])){
//	                    $filter_data[$number_value['number']]=$filter_number;
//	                	}
//	                    }
//	                }
//
//            	}
//        	}
//
//        	if($number_count<12){
//        		while (strlen($search)>0) {
//	        		$resetLoop = true;
//	        		foreach ($number_data as $nkey => $number_value){
//		                if(strpos($number_value['number'],strtoupper($search))!== FALSE && $number_count<12 && $resetLoop){
//		                  $filter_number['number']=$number_value['number'];
//		                  $filter_number['price']=$number_value['price'];
//		                  $filter_number['plate_id']=$number_value['plate_id'];
//		                  $filter_number['plate_type']=2;
//		                  if(!isset($filter_data[$number_value['number']])){
//			                  $filter_data[$number_value['number']]=$filter_number;
//			                  $number_count++;
//			                  //$resetLoop=false;
//		              	  }
//		                }elseif(strpos($number_value['number'],strtoupper($search))!== FALSE){
//		                    if($type!=''){
//		                    $filter_number['number']=$number_value['number'];
//		                    $filter_number['price']=$number_value['price'];
//		                    $filter_number['plate_id']=$number_value['plate_id'];
//		                    $filter_number['plate_type']=2;
//			                    if(!isset($filter_data[$number_value['number']])){
//			                    	$filter_data[$number_value['number']]=$filter_number;
//			                	}
//		                    }
//		                }
//	            	}
//	            	$search=substr_replace($search ,"", -1);
//        		}
//        	}
//
//        }else{
//            foreach ($number_data as $nkey => $number_value) {
//                if($number_count<99){
//                  $filter_number['number']=$number_value['number'];
//                  $filter_number['price']=$number_value['price'];
//                  $filter_number['plate_id']=$number_value['plate_id'];
//                  $filter_number['plate_type']=2;
//                  if(!isset($filter_data[$number_value['number']])){
//	                  $filter_data[$number_value['number']]=$filter_number;
//	                  $number_count++;
//              	  }
//                }
//            }
//        }
        return $filter_data;
    }

    function get_new_plates_by_search($search,$type='')
    {
        $search_word = $this->getPossibleWord($search);
        $number_data=[];
        $this->db->select('id,number,plate_id,price');
        $this->db->from('new_plates');
        foreach ($search_word as $key => $value) {
          $this->db->or_like('number', $value);
        }
        $this->db->where('status',1);
        $this->db->order_by("id");
        $query=$this->db->get();
        $number_data=$query->result_array();

        $filter_data=array();
        $number_count=0;
        if(is_array($number_data) && count($number_data) > 0) {
          foreach ($number_data as $nkey => $number_value) {
                if($number_count<12){
                  if(strlen($number_value['number']) == '9') {
                    $pos = strpos($number_value['number']," ");
                    if($pos == '2') {
                      $number = substr_replace($number_value['number'], "", 2, 1);
                      $filter_number['number']=$number;
                    }
                    else {
                      $filter_number['number']=$number_value['number'];
                    }
                  }
                  else {
                    $filter_number['number']=$number_value['number'];
                  }
                  $filter_number['price']=$number_value['price'];
                  $filter_number['plate_id']=$number_value['plate_id'];
                  $filter_number['plate_type']=3;
                  if(!isset($filter_data[$number_value['number']])){
	                  $filter_data[$number_value['number']]=$filter_number;
	                  $number_count++;
              	  }
                }
            }
        }
//        if($search!=""){
//        	$search_array=$this->common->get_search_array($search);
//        	// echo "<pre>";
//        	// print_r($search_array); die();
//        	foreach ($search_array as $key => $search_val) {
//        		$resetLoop = true;
//        		foreach ($number_data as $nkey => $number_value){
//
//	                if(strpos($number_value['number'],strtoupper($search_val))!== FALSE && $number_count<12 && $resetLoop){
//	                  $filter_number['number']=$number_value['number'];
//	                  $filter_number['price']=$number_value['price'];
//	                  $filter_number['plate_id']=$number_value['plate_id'];
//	                  $filter_number['plate_type']=3;
//	                  if(!isset($filter_data[$number_value['number']])){
//	                  	  $filter_data[$number_value['number']]=$filter_number;
//		                  $number_count++;
//		                  $resetLoop=false;
//	                  }
//
//	                }elseif(strpos($number_value['number'],strtoupper($search_val))!== FALSE){
//	                    if($type!=''){
//	                    $filter_number['number']=$number_value['number'];
//	                    $filter_number['price']=$number_value['price'];
//	                    $filter_number['plate_id']=$number_value['plate_id'];
//	                    $filter_number['plate_type']=3;
//	                    if(!isset($filter_data[$number_value['number']])){
//	                    $filter_data[$number_value['number']]=$filter_number;
//	                	}
//	                    }
//	                }
//
//            	}
//        	}
//
//        	if($number_count<12){
//        		while (strlen($search)>0) {
//	        		$resetLoop = true;
//	        		foreach ($number_data as $nkey => $number_value){
//		                if(strpos($number_value['number'],strtoupper($search))!== FALSE && $number_count<12 && $resetLoop){
//		                  $filter_number['number']=$number_value['number'];
//		                  $filter_number['price']=$number_value['price'];
//		                  $filter_number['plate_id']=$number_value['plate_id'];
//		                  $filter_number['plate_type']=3;
//		                  if(!isset($filter_data[$number_value['number']])){
//			                  $filter_data[$number_value['number']]=$filter_number;
//			                  $number_count++;
//			                  //$resetLoop=false;
//		              	  }
//		                }elseif(strpos($number_value['number'],strtoupper($search))!== FALSE){
//		                    if($type!=''){
//		                    $filter_number['number']=$number_value['number'];
//		                    $filter_number['price']=$number_value['price'];
//		                    $filter_number['plate_id']=$number_value['plate_id'];
//		                    $filter_number['plate_type']=3;
//			                    if(!isset($filter_data[$number_value['number']])){
//			                    	$filter_data[$number_value['number']]=$filter_number;
//			                	}
//		                    }
//		                }
//	            	}
//	            	$search=substr_replace($search ,"", -1);
//        		}
//        	}
//
//        }else{
//            foreach ($number_data as $nkey => $number_value) {
//                if($number_count<99){
//                  $filter_number['number']=$number_value['number'];
//                  $filter_number['price']=$number_value['price'];
//                  $filter_number['plate_id']=$number_value['plate_id'];
//                  $filter_number['plate_type']=3;
//                  if(!isset($filter_data[$number_value['number']])){
//	                  $filter_data[$number_value['number']]=$filter_number;
//	                  $number_count++;
//              	  }
//                }
//            }
//        }
        return $filter_data;
    }

    function get_plates_by_details($plate_id,$plate_type)
    {
        $number_data=[];
        if($plate_type==1){
            $this->db->select('id,number,plate_id,price');
            $this->db->from('cherished_plates');
            $this->db->where('plate_id',$plate_id);
            $this->db->where('status',1);
            $this->db->order_by("id");
            $query=$this->db->get();
            $data_array=$query->result_array();
        }elseif($plate_type==2){
            $this->db->select('id,number,plate_id,price');
            $this->db->from('prefix_plates');
            $this->db->where('plate_id',$plate_id);
            $this->db->where('status',1);
            $this->db->order_by("id");
            $query=$this->db->get();
            $data_array=$query->result_array();
        }elseif($plate_type==3){
            $this->db->select('id,number,plate_id,price');
            $this->db->from('new_plates');
            $this->db->where('plate_id',$plate_id);
            $this->db->where('status',1);
            $this->db->order_by("id");
            $query=$this->db->get();
            $data_array=$query->result_array();
        }
        foreach ($data_array as $key => $data_array_value) {
            if($plate_id==$data_array_value['plate_id']){
                $numbers['number']=$data_array_value['number'];
                $numbers['price']=$data_array_value['price'];
                $numbers['plate_id']=$data_array_value['plate_id'];
                $numbers['plate_type']=$plate_type;
                $number_data=$numbers;
            }
        }
        return $number_data;
    }

}
