<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Search_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("Common_function_model", "common");
    }
    function get_cherished_plates_by_search(
        $search,
        $type = "",
        $addition_search = ""
    ) {
    	$this->session->set_userdata('private_plate_ids', "");
    	  $plate_id_arr = array();
        $search_data = [];
        $number_count = 0;
        $limit = "1";
        $exact_filter_data = [];

        $trim_search = str_replace(" ", "", trim($search));
        $exact_cherished_query =
            "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` 
                                  WHERE `status` = 1 
                                  AND REPLACE(`number`, ' ', '') = '" .
            $trim_search .
            "'
                                  ORDER BY `id` LIMIT " .
            $limit .
            "";
        $exact_query_wtp = $this->db->query($exact_cherished_query);
        $exact_number_data = $exact_query_wtp->result_array();
        if (is_array($exact_number_data) && count($exact_number_data) > 0) {
            foreach ($exact_number_data as $ekey => $enumber_value) {
                if ($number_count < $limit) {
                	  $plate_id_arr[] = $enumber_value["id"];
                    $filter_number["number"] = $enumber_value["number"];
                    $filter_number["id"] = $enumber_value["id"];
                    $filter_number["price"] = $enumber_value["price"];
                    $filter_number["plate_id"] = $enumber_value["plate_id"];
                    $filter_number["plate_type"] = 1;
                    $filter_number["apply_poa"] = $enumber_value["apply_poa"];
                    if (!isset($exact_filter_data[$enumber_value["number"]])) {
                        $exact_filter_data[
                            $enumber_value["number"]
                        ] = $filter_number;
                        $number_count++;
                    }
                }
            }

            $this->session->set_userdata('search_type', 'cherished');
        }

        $search_word = $this->getPossibleWord($search);
        $number_data = [];
        /*
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
        */
        $j = 1;
        foreach ($search_word as $key => $value) {
            if ($j == 1) {
                $like_q = "`number` LIKE '%" . $value . "%' ESCAPE '!'";
            } else {
                $like_q .= " OR `number` LIKE '%" . $value . "%' ESCAPE '!'";
            }
            $j++;
        }
        $limit = "12";
        if (!empty($type)) {
            $limit = "48";
        }

        if ($addition_search == 1) {
            $cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'A%' OR number LIKE 'B%' OR number LIKE 'C%' OR number LIKE 'D%')  ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 2) {
            $cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'E%' OR number LIKE 'F%' OR number LIKE 'G%' OR number LIKE 'H%')  ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 3) {
            $cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'I%' OR number LIKE 'J%' OR number LIKE 'K%' OR number LIKE 'L%')  ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 4) {
            $cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'M%' OR number LIKE 'N%' OR number LIKE 'O%' OR number LIKE 'P%')  ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 5) {
            $cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'Q%' OR number LIKE 'R%' OR number LIKE 'S%' OR number LIKE 'T%')  ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 6) {
            $cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'U%' OR number LIKE 'V%' OR number LIKE 'W%' OR number LIKE 'X%')  ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 7) {
            $cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'Y%' OR number LIKE 'Z%')  ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search != "") {
            $cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE '" .
                $addition_search .
                "%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } else {
            $cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`, `apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "";
        }

        $query_wtp = $this->db->query($cherished_query);
        $number_data = $query_wtp->result_array();

        $filter_data = [];
        $private_filter_data = [];
        $final_data = [];
        $number_count = 0;

        // Private
        /*
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
        */

        // Private
        $i = 1;
        foreach ($search_word as $key => $value) {
            if ($i == 1) {
                $like_q_tp = "`number` LIKE '%" . $value . "%' ESCAPE '!'";
            } else {
                $like_q_tp .= " OR `number` LIKE '%" . $value . "%' ESCAPE '!'";
            }
            $i++;
        }
        $limit_wp = "12";
        if (!empty($type)) {
            $limit_wp = "48";
        }
        $cherished_query_wp =
            "SELECT `id`, `number`, `plate_id`, `price`, `private`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
            $like_q_tp .
            ") ORDER BY `id` LIMIT " .
            $limit_wp .
            "";
        $query_wp = $this->db->query($cherished_query_wp);
        $private_number_data = $query_wp->result_array();

        //echo $this->db->last_query();exit;
        if (is_array($private_number_data) && count($private_number_data) > 0) {
            foreach ($private_number_data as $nkey => $number_value) {
                if ($number_count < $limit_wp) {
                    if (strlen($number_value["number"]) == "9") {
                        $pos = strpos($number_value["number"], " ");
                        if ($pos == "2") {
                            $number = substr_replace(
                                $number_value["number"],
                                "",
                                2,
                                1
                            );
                            $filter_number["number"] = $number;
                        } else {
                            $filter_number["number"] = $number_value["number"];
                        }
                    } else {
                        $filter_number["number"] = $number_value["number"];
                    }
                    $filter_number["id"] = $number_value["id"];

                    $filter_number["price"] = $number_value["price"];
                    $filter_number["plate_id"] = $number_value["plate_id"];
                    $filter_number["private"] = $number_value["private"];
                    $filter_number["plate_type"] = 1;
                    $filter_number["apply_poa"] = $number_value["apply_poa"];
                    $plate_id_arr[] = $number_value["id"]; 
                    if (!isset($private_filter_data[$number_value["number"]])) {
                        $private_filter_data[
                            $number_value["number"]
                        ] = $filter_number;
                        $number_count++;
                    }
                }
            }
        }

        if (count($private_filter_data) < $limit_wp) {
            $number_count = count($private_filter_data);
            if (is_array($number_data) && count($number_data) > 0) {
                foreach ($number_data as $nkey => $number_value) {
                    if ($number_count < $limit) {
                        if (strlen($number_value["number"]) == "9") {
                            $pos = strpos($number_value["number"], " ");
                            if ($pos == "2") {
                                $number = substr_replace(
                                    $number_value["number"],
                                    "",
                                    2,
                                    1
                                );
                                $filter_number["number"] = $number;
                            } else {
                                $filter_number["number"] =
                                    $number_value["number"];
                            }
                        } else {
                            $filter_number["number"] = $number_value["number"];
                        }
                        $filter_number["id"] = $number_value["id"];
                        $plate_id_arr[] = $number_value["id"];
                        $filter_number["price"] = $number_value["price"];
                        $filter_number["plate_id"] = $number_value["plate_id"];
                        $filter_number["plate_type"] = 1;
                        $filter_number["apply_poa"] = $number_value["apply_poa"];
                        if (!isset($filter_data[$number_value["number"]])) {
                            $filter_data[
                                $number_value["number"]
                            ] = $filter_number;
                            $number_count++;
                        }
                    }
                }
            }
        }

        $final_data = array_merge(
            $exact_filter_data,
            $private_filter_data,
            $filter_data
        );
        ////           echo "<pre>";
        ////           print_r($number_data); die();
        //        $filter_data=array();
        //        $number_count=0;
        //        if($search!=""){
        //          $search_array=$this->common->get_search_array($search);
        ////           echo "<pre>";
        ////           print_r($search_array); die();
        //          foreach ($search_array as $key => $search_val) {
        //            $resetLoop = true;
        //            foreach ($number_data as $nkey => $number_value){
        //
        //                  if(strpos($number_value['number'],strtoupper($search_val))!== FALSE && $number_count<12 && $resetLoop){
        //                    $filter_number['number']=$number_value['number'];
        //                    $filter_number['price']=$number_value['price'];
        //                    $filter_number['plate_id']=$number_value['plate_id'];
        //                    $filter_number['plate_type']=1;
        //                    if(!isset($filter_data[$number_value['number']])){
        //                        $filter_data[$number_value['number']]=$filter_number;
        //                      $number_count++;
        //                      $resetLoop=false;
        //                    }
        //
        //                  }elseif(strpos($number_value['number'],strtoupper($search_val))!== FALSE){
        //                      if($type!=''){
        //                      $filter_number['number']=$number_value['number'];
        //                      $filter_number['price']=$number_value['price'];
        //                      $filter_number['plate_id']=$number_value['plate_id'];
        //                      $filter_number['plate_type']=1;
        //                      if(!isset($filter_data[$number_value['number']])){
        //                      $filter_data[$number_value['number']]=$filter_number;
        //                    }
        //                      }
        //                  }
        //
        //              }
        //          }
        //
        //          if($number_count<12){
        //
        //            while (strlen($search)>0) {
        //
        //              $resetLoop = true;
        //              foreach ($number_data as $nkey => $number_value){
        //                    if(strpos($number_value['number'],strtoupper($search))!== FALSE && $number_count<12 && $resetLoop){
        //                      $filter_number['number']=$number_value['number'];
        //                      $filter_number['price']=$number_value['price'];
        //                      $filter_number['plate_id']=$number_value['plate_id'];
        //                      $filter_number['plate_type']=1;
        //                      if(!isset($filter_data[$number_value['number']])){
        //                        $filter_data[$number_value['number']]=$filter_number;
        //                        $number_count++;
        //                        //$resetLoop=false;
        //                      }
        //                    }elseif(strpos($number_value['number'],strtoupper($search))!== FALSE){
        //                        if($type!=''){
        //                        $filter_number['number']=$number_value['number'];
        //                        $filter_number['price']=$number_value['price'];
        //                        $filter_number['plate_id']=$number_value['plate_id'];
        //                        $filter_number['plate_type']=1;
        //                          if(!isset($filter_data[$number_value['number']])){
        //                            $filter_data[$number_value['number']]=$filter_number;
        //                        }
        //                        }
        //                    }
        //                }
        //                $search=substr_replace($search ,"", -1);
        //            }
        //
        //          }
        //
        //        }else{
        //            foreach ($number_data as $nkey => $number_value) {
        //                if($number_count<99){
        //                  $filter_number['number']=$number_value['number'];
        //                  $filter_number['price']=$number_value['price'];
        //                  $filter_number['plate_id']=$number_value['plate_id'];
        //                  $filter_number['plate_type']=1;
        //                  if(!isset($filter_data[$number_value['number']])){
        //                    $filter_data[$number_value['number']]=$filter_number;
        //                    $number_count++;
        //                  }
        //                }
        //            }
        //        }
        $plate_id_str = "";
        if(is_array($plate_id_arr) && count($plate_id_arr) > 0) {
        	$plate_id_str = implode(",",$plate_id_arr);
        }
        $this->session->set_userdata('private_plate_ids', $plate_id_str);
        return $final_data;
    }

    function getPossibleWord($search)
    {
        $return = [];
        $result = explode(" ", $search);
        $ret = [];
        $res = "";
        foreach ($result as $key => $value) {
            $ret = $this->common->get_search_array($value);
            if (is_array($ret) && count($ret) > 0) {
                foreach ($ret as $k => $v) {
                    $res .= $this->getPossibleString($v) . ",";
                }
            }
        }
        $res = trim($res, ",");
        if (!empty($res)) {
            $return = explode(",", $res);
            $return = array_unique($return);
        }
        return $return;
    }
    function getPossibleString($search)
    {
        $result = [];
        $res = "";
        $search = str_replace(" ", "", $search);
        if ($search) {
            if (strlen($search) == 1) {
                $result[] = $search;
            } elseif (strlen($search) == 2) {
                $result[] = $search;
            } elseif (strlen($search) == 3) {
                $result[] = $search;
                //          $result[] = substr($search,0,2);
                //          $result[] = substr($search,1,2);
            } elseif (strlen($search) == 4) {
                $result[] = substr($search, 0, 3);
                $result[] = substr($search, 1, 3);
                //          $result[] = substr($search,2,2);
                //          $result[] = substr($search,0,2);
            } elseif (strlen($search) == 5) {
                $result[] = substr($search, 0, 3);
                $result[] = substr($search, 2, 3);
                $result[] = substr($search, 1, 3);
                //          $result[] = substr($search,2,2);
                //          $result[] = substr($search,0,2);
            } elseif (strlen($search) == 6) {
                $result[] = substr($search, 0, 3);
                $result[] = substr($search, 2, 3);
                $result[] = substr($search, 3, 3);
                $result[] = substr($search, 1, 3);
                //          $result[] = substr($search,2,2);
                //          $result[] = substr($search,0,2);
            } elseif (strlen($search) == 7) {
                $result[] = substr($search, 0, 3);
                $result[] = substr($search, 4, 3);
                $result[] = substr($search, 3, 3);
                $result[] = substr($search, 1, 3);
                //          $result[] = substr($search,2,2);
                //          $result[] = substr($search,0,2);
            } elseif (strlen($search) == 8) {
                $result[] = substr($search, 0, 3);
                $result[] = substr($search, 4, 3);
                $result[] = substr($search, 3, 3);
                $result[] = substr($search, 5, 3);
                $result[] = substr($search, 1, 3);
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
        $res = implode(",", $result);
        return $res;
    }

    function get_prefix_plates_by_search(
        $search,
        $type = "",
        $addition_search = ""
    ) {
    	  $plate_id_arr = array();
        $number_data = [];
        $number_count = 0;
        $limit = "1";
        $exact_filter_data = [];

        $trim_search = str_replace(" ", "", trim($search));
        $search_length=strlen($trim_search);

        if($search_length==5 || $search_length==6 || $search_length==7){

          if($search_length==5){
             $search_prefix=substr($trim_search, 0, 1);
             $search_number=substr($trim_search, 1, 1);;
             $search_latter=substr($trim_search, -3);
          }else if($search_length==6){
             $search_prefix=substr($trim_search, 0, 1);
             $search_number=substr($trim_search, 1, 2);;
             $search_latter=substr($trim_search, -3);
          }else if($search_length==7){
             $search_prefix=substr($trim_search, 0, 1);
             $search_number=substr($trim_search, 1, 3);;
             $search_latter=substr($trim_search, -3);
          }


          $exact_prefix_query =
            "SELECT `id`,`numbers`,`prefix`,`letters`,`plate_id`, `price` 
                                  FROM `prefix_plates` 
                                  WHERE `status` = '1'
                                  AND `prefix` = '".$search_prefix ."'
                                  AND `numbers` = '".$search_number ."'
                                  AND `letters` = '".$search_latter ."'
                                  LIMIT 1";
            $exact_query_wtp = $this->db->query($exact_prefix_query);
            $exact_number_data = $exact_query_wtp->result_array();
            if (is_array($exact_number_data) && count($exact_number_data) > 0) {
                foreach ($exact_number_data as $ekey => $enumber_value) {
                    
                        $p_number=$enumber_value["prefix"].''.$enumber_value["numbers"].' '.$enumber_value["letters"];
                        $filter_number["number"] = $p_number;
                        $filter_number["id"] = $enumber_value["id"];
                        $plate_id_arr[] = $enumber_value["id"];
                        $filter_number["price"] = $enumber_value["price"];
                        $filter_number["plate_id"] = $enumber_value["plate_id"];
                        $filter_number["plate_type"] = 2;
                        if (!isset($exact_filter_data[$p_number])) {
                            $exact_filter_data[$p_number] = $filter_number;
                            $number_count++;
                        }

                }
                $this->session->set_userdata('search_type', 'prefix');
            }


        }

        
        $search_word = $this->getPossibleWord($search);
        
        $j = 1;
        foreach ($search_word as $key => $value) {
            if ($j == 1) {
                $like_q = "`letters` LIKE '%" . $value . "%'";
            } else {
                $like_q .= " OR `letters` LIKE '%" . $value . "%'";
            }
            $j++;
        }
        $limit = "12";
        if (!empty($type)) {
            $limit = "48";
        }

        if ($addition_search == 1) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'A%' OR prefix LIKE 'B%' OR prefix LIKE 'C%' OR prefix LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 2) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'E%' OR prefix LIKE 'F%' OR prefix LIKE 'G%' OR prefix LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 3) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'I%' OR prefix LIKE 'J%' OR prefix LIKE 'K%' OR prefix LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 4) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'M%' OR prefix LIKE 'N%' OR prefix LIKE 'O%' OR prefix LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 5) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Q%' OR prefix LIKE 'R%' OR prefix LIKE 'S%' OR prefix LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 6) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'U%' OR prefix LIKE 'V%' OR prefix LIKE 'W%' OR prefix LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 7) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Y%' OR prefix LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search != "") {
            //$prefix_query = "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (".$like_q.") AND (prefix LIKE '".$addition_search."%' OR letters LIKE '".$addition_search."%') ORDER BY `id` LIMIT ".$limit."";
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE '" .
                $addition_search .
                "%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } else {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "";
        }
        $query = $this->db->query($prefix_query);
        $number_data = $query->result_array();
        $filter_data = [];
        $number_count = 0;
        if (is_array($number_data) && count($number_data) > 0) {
            foreach ($number_data as $nkey => $number_value) {
                $number_value["numbers"] =
                    $number_value["prefix"] .
                    $number_value["numbers"] .
                    " " .
                    $number_value["letters"];
                if ($number_count < $limit) {
                    if (strlen($number_value["numbers"]) == "9") {
                        $pos = strpos($number_value["numbers"], " ");
                        if ($pos == "2") {
                            $number = substr_replace(
                                $number_value["numbers"],
                                "",
                                2,
                                1
                            );
                            $filter_number["number"] = $number;
                        } else {
                            $filter_number["number"] = $number_value["numbers"];
                        }
                    } else {
                        $filter_number["number"] = $number_value["numbers"];
                    }
                    $filter_number["id"] = $number_value["id"];
						  $plate_id_arr[] = $number_value["id"];
                    $filter_number["price"] = $number_value["price"];
                    $filter_number["plate_id"] = $number_value["plate_id"];
                    $filter_number["plate_type"] = 2;
                    if (!isset($filter_data[$number_value["numbers"]])) {
                        $filter_data[$number_value["numbers"]] = $filter_number;
                        $number_count++;
                    }
                }
            }
        }
        $final_data = array_merge($exact_filter_data, $filter_data);
        $plate_id_str = "";
        if(is_array($plate_id_arr) && count($plate_id_arr) > 0) {
        	$plate_id_str = implode(",",$plate_id_arr);
        }
        $this->session->set_userdata('prefix_plate_ids', $plate_id_str);
        //        if($search!=""){
        //          $search_array=$this->common->get_search_array($search);
        //          // echo "<pre>";
        //          // print_r($search_array); die();
        //          foreach ($search_array as $key => $search_val) {
        //            $resetLoop = true;
        //            foreach ($number_data as $nkey => $number_value){
        //
        //                  if(strpos($number_value['number'],strtoupper($search_val))!== FALSE && $number_count<12 && $resetLoop){
        //                    $filter_number['number']=$number_value['number'];
        //                    $filter_number['price']=$number_value['price'];
        //                    $filter_number['plate_id']=$number_value['plate_id'];
        //                    $filter_number['plate_type']=2;
        //                    if(!isset($filter_data[$number_value['number']])){
        //                        $filter_data[$number_value['number']]=$filter_number;
        //                      $number_count++;
        //                      $resetLoop=false;
        //                    }
        //
        //                  }elseif(strpos($number_value['number'],strtoupper($search_val))!== FALSE){
        //                      if($type!=''){
        //                      $filter_number['number']=$number_value['number'];
        //                      $filter_number['price']=$number_value['price'];
        //                      $filter_number['plate_id']=$number_value['plate_id'];
        //                      $filter_number['plate_type']=2;
        //                      if(!isset($filter_data[$number_value['number']])){
        //                      $filter_data[$number_value['number']]=$filter_number;
        //                    }
        //                      }
        //                  }
        //
        //              }
        //          }
        //
        //          if($number_count<12){
        //            while (strlen($search)>0) {
        //              $resetLoop = true;
        //              foreach ($number_data as $nkey => $number_value){
        //                    if(strpos($number_value['number'],strtoupper($search))!== FALSE && $number_count<12 && $resetLoop){
        //                      $filter_number['number']=$number_value['number'];
        //                      $filter_number['price']=$number_value['price'];
        //                      $filter_number['plate_id']=$number_value['plate_id'];
        //                      $filter_number['plate_type']=2;
        //                      if(!isset($filter_data[$number_value['number']])){
        //                        $filter_data[$number_value['number']]=$filter_number;
        //                        $number_count++;
        //                        //$resetLoop=false;
        //                      }
        //                    }elseif(strpos($number_value['number'],strtoupper($search))!== FALSE){
        //                        if($type!=''){
        //                        $filter_number['number']=$number_value['number'];
        //                        $filter_number['price']=$number_value['price'];
        //                        $filter_number['plate_id']=$number_value['plate_id'];
        //                        $filter_number['plate_type']=2;
        //                          if(!isset($filter_data[$number_value['number']])){
        //                            $filter_data[$number_value['number']]=$filter_number;
        //                        }
        //                        }
        //                    }
        //                }
        //                $search=substr_replace($search ,"", -1);
        //            }
        //          }
        //
        //        }else{
        //            foreach ($number_data as $nkey => $number_value) {
        //                if($number_count<99){
        //                  $filter_number['number']=$number_value['number'];
        //                  $filter_number['price']=$number_value['price'];
        //                  $filter_number['plate_id']=$number_value['plate_id'];
        //                  $filter_number['plate_type']=2;
        //                  if(!isset($filter_data[$number_value['number']])){
        //                    $filter_data[$number_value['number']]=$filter_number;
        //                    $number_count++;
        //                  }
        //                }
        //            }
        //        }
        return $final_data;
    }

    function get_new_plates_by_search(
        $search,
        $type = "",
        $addition_search = ""
    ) {
        $plate_id_arr = array();    		
        $number_data = [];
        $number_count = 0;
        $limit = "1";
        $exact_filter_data = [];

        $trim_search = str_replace(" ", "", trim($search));

        $search_length=strlen($trim_search);

        if($search_length==6 || $search_length==7 || $search_length==8){

          if($search_length==6){
             $search_prefix=substr($trim_search, 0, 2);
             $search_number=substr($trim_search, 2, 1);;
             $search_latter=substr($trim_search, -3);
          }else if($search_length==7){
             $search_prefix=substr($trim_search, 0, 2);
             $search_number=substr($trim_search, 2, 2);;
             $search_latter=substr($trim_search, -3);
          }else if($search_length==8){
             $search_prefix=substr($trim_search, 0, 2);
             $search_number=substr($trim_search, 2, 3);
             $search_latter=substr($trim_search, -3);
          }


          $exact_new_query =
          "SELECT `id`,`numbers`,`prefix`,`letters`,`plate_id`, `price` 
                                FROM `new_plates` 
                                WHERE `status` = '1'
                                AND `prefix` = '".$search_prefix ."'
                                AND `numbers` = '".$search_number ."'
                                AND `letters` = '".$search_latter ."'
                                LIMIT 1";

          $exact_query_wtp = $this->db->query($exact_new_query);
          $exact_number_data = $exact_query_wtp->result_array();
          if (is_array($exact_number_data) && count($exact_number_data) > 0) {
            foreach ($exact_number_data as $ekey => $enumber_value) {
                
                    $p_number=$enumber_value["prefix"].''.$enumber_value["numbers"].' '.$enumber_value["letters"];
                    $filter_number["number"] = $p_number;
                    $filter_number["id"] = $enumber_value["id"];
						  $plate_id_arr[] = $enumber_value["id"];
                    $filter_number["price"] = $enumber_value["price"];
                    $filter_number["plate_id"] = $enumber_value["plate_id"];
                    $filter_number["plate_type"] = 3;
                    if (!isset($exact_filter_data[$p_number])) {
                        $exact_filter_data[$p_number] = $filter_number;
                        $number_count++;
                    }
            }
            $this->session->set_userdata('search_type', 'new_plates');
          }

        }

        
        
        $search_word = $this->getPossibleWord($search);

        /*
        $this->db->select('id,prefix,numbers,letters,plate_id,price');
        $this->db->from('new_plates');
        $this->db->where('status',1);
        $j = 1;
        $this->db->group_start();
        foreach ($search_word as $key => $value) {
          if($j == 1) {
            $this->db->like('letters',$value);
          }
          $this->db->or_like('letters', $value);
          $j++;
        }
        $this->db->group_end();
        $this->db->order_by("id");
        $query=$this->db->get();
        $number_data=$query->result_array();
        */
        $limit = "12";
        if (!empty($type)) {
            $limit = "48";
        }
        $j = 1;
        foreach ($search_word as $key => $value) {
            if ($j == 1) {
                // $like_q = "`letters` LIKE '%".$value."%' ESCAPE '!'";
                $like_q = "`letters` LIKE '%" . $value . "%'";
            } else {
                // $like_q .= " OR `letters` LIKE '%".$value."%' ESCAPE '!'";
                $like_q .= " OR `letters` LIKE '%" . $value . "%'";
            }
            $j++;
        }
        if ($addition_search == 1) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'A%' OR prefix LIKE 'B%' OR prefix LIKE 'C%' OR prefix LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 2) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'E%' OR prefix LIKE 'F%' OR prefix LIKE 'G%' OR prefix LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 3) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'I%' OR prefix LIKE 'J%' OR prefix LIKE 'K%' OR prefix LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 4) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'M%' OR prefix LIKE 'N%' OR prefix LIKE 'O%' OR prefix LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 5) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Q%' OR prefix LIKE 'R%' OR prefix LIKE 'S%' OR prefix LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 6) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'U%' OR prefix LIKE 'V%' OR prefix LIKE 'W%' OR prefix LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search == 7) {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Y%' OR prefix LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "";
        } elseif ($addition_search != "") {
            //$prefix_query = "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (".$like_q.") AND (prefix LIKE '".$addition_search."%' OR letters LIKE '".$addition_search."%') ORDER BY `id` LIMIT ".$limit."";
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE '" .
                $addition_search .
                "%' ) ORDER BY `id` LIMIT " .
                $limit .
                "";
        } else {
            $prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "";
        }

        $query = $this->db->query($prefix_query);
        $number_data = $query->result_array();
        //echo $this->db->last_query(); exit;
        $filter_data = [];
        $number_count = 0;
        if (is_array($number_data) && count($number_data) > 0) {
            foreach ($number_data as $nkey => $number_value) {
                if (strlen($number_value["numbers"]) == 1) {
                    $number_value["numbers"] = "0" . $number_value["numbers"];
                }
                $number_value["numbers"] =
                    $number_value["prefix"] .
                    $number_value["numbers"] .
                    " " .
                    $number_value["letters"];
                if ($number_count < $limit) {
                    if (strlen($number_value["numbers"]) == "9") {
                        $pos = strpos($number_value["numbers"], " ");
                        if ($pos == "2") {
                            $number = substr_replace(
                                $number_value["numbers"],
                                "",
                                2,
                                1
                            );
                            $filter_number["number"] = $number;
                        } else {
                            $filter_number["number"] = $number_value["numbers"];
                        }
                    } else {
                        $filter_number["number"] = $number_value["numbers"];
                    }
                    $filter_number["id"] = $number_value["id"];
                    $plate_id_arr[] = $number_value["id"];
                    $filter_number["price"] = $number_value["price"];
                    $filter_number["plate_id"] = $number_value["plate_id"];
                    $filter_number["plate_type"] = 3;
                    if (!isset($filter_data[$number_value["numbers"]])) {
                        $filter_data[$number_value["numbers"]] = $filter_number;
                        $number_count++;
                    }
                }
            }
        }
        $final_data = array_merge($exact_filter_data, $filter_data);
        $plate_id_str = "";
        if(is_array($plate_id_arr) && count($plate_id_arr) > 0) {
        	$plate_id_str = implode(",",$plate_id_arr);
        }
        
        $this->session->set_userdata('current_plate_ids', $plate_id_str);
        //        if($search!=""){
        //          $search_array=$this->common->get_search_array($search);
        //          // echo "<pre>";
        //          // print_r($search_array); die();
        //          foreach ($search_array as $key => $search_val) {
        //            $resetLoop = true;
        //            foreach ($number_data as $nkey => $number_value){
        //
        //                  if(strpos($number_value['number'],strtoupper($search_val))!== FALSE && $number_count<12 && $resetLoop){
        //                    $filter_number['number']=$number_value['number'];
        //                    $filter_number['price']=$number_value['price'];
        //                    $filter_number['plate_id']=$number_value['plate_id'];
        //                    $filter_number['plate_type']=3;
        //                    if(!isset($filter_data[$number_value['number']])){
        //                        $filter_data[$number_value['number']]=$filter_number;
        //                      $number_count++;
        //                      $resetLoop=false;
        //                    }
        //
        //                  }elseif(strpos($number_value['number'],strtoupper($search_val))!== FALSE){
        //                      if($type!=''){
        //                      $filter_number['number']=$number_value['number'];
        //                      $filter_number['price']=$number_value['price'];
        //                      $filter_number['plate_id']=$number_value['plate_id'];
        //                      $filter_number['plate_type']=3;
        //                      if(!isset($filter_data[$number_value['number']])){
        //                      $filter_data[$number_value['number']]=$filter_number;
        //                    }
        //                      }
        //                  }
        //
        //              }
        //          }
        //
        //          if($number_count<12){
        //            while (strlen($search)>0) {
        //              $resetLoop = true;
        //              foreach ($number_data as $nkey => $number_value){
        //                    if(strpos($number_value['number'],strtoupper($search))!== FALSE && $number_count<12 && $resetLoop){
        //                      $filter_number['number']=$number_value['number'];
        //                      $filter_number['price']=$number_value['price'];
        //                      $filter_number['plate_id']=$number_value['plate_id'];
        //                      $filter_number['plate_type']=3;
        //                      if(!isset($filter_data[$number_value['number']])){
        //                        $filter_data[$number_value['number']]=$filter_number;
        //                        $number_count++;
        //                        //$resetLoop=false;
        //                      }
        //                    }elseif(strpos($number_value['number'],strtoupper($search))!== FALSE){
        //                        if($type!=''){
        //                        $filter_number['number']=$number_value['number'];
        //                        $filter_number['price']=$number_value['price'];
        //                        $filter_number['plate_id']=$number_value['plate_id'];
        //                        $filter_number['plate_type']=3;
        //                          if(!isset($filter_data[$number_value['number']])){
        //                            $filter_data[$number_value['number']]=$filter_number;
        //                        }
        //                        }
        //                    }
        //                }
        //                $search=substr_replace($search ,"", -1);
        //            }
        //          }
        //
        //        }else{
        //            foreach ($number_data as $nkey => $number_value) {
        //                if($number_count<99){
        //                  $filter_number['number']=$number_value['number'];
        //                  $filter_number['price']=$number_value['price'];
        //                  $filter_number['plate_id']=$number_value['plate_id'];
        //                  $filter_number['plate_type']=3;
        //                  if(!isset($filter_data[$number_value['number']])){
        //                    $filter_data[$number_value['number']]=$filter_number;
        //                    $number_count++;
        //                  }
        //                }
        //            }
        //        }
        return $final_data;
    }

    function get_plates_by_details($plate_id, $plate_type)
    {
         
        $number_data = [];
        if ($plate_type == 1) {
            $this->db->select("id,number,plate_id,price,apply_poa");
            $this->db->from("cherished_plates");
            $this->db->where("id", $plate_id);
            $this->db->where("status", 1);
            $this->db->order_by("id");
            $query = $this->db->get();
            $data_array = $query->result_array();
        } elseif ($plate_type == 2) {
            $this->db->select("id,prefix,numbers,letters,plate_id,price");
            $this->db->from("prefix_plates");
            $this->db->where("id", $plate_id);
            $this->db->where("status", 1);
            $this->db->order_by("id");
            $query = $this->db->get();
            $data_array = $query->result_array();
        } elseif ($plate_type == 3) {
            $this->db->select("id,prefix,numbers,letters,plate_id,price");
            $this->db->from("new_plates");
            $this->db->where("id", $plate_id);
            $this->db->where("status", 1);
            $this->db->order_by("id");
            $query = $this->db->get();
            $data_array = $query->result_array();
        }
        foreach ($data_array as $key => $data_array_value) {
            if ($plate_id == $data_array_value["id"]) {
                if ($plate_type == 1) {
                    $numbers["number"] = $data_array_value["number"];
                    $numbers["apply_poa"] = $data_array_value["apply_poa"];
                } else {
                    $numbers["number"] =
                        $data_array_value["prefix"] .
                        $data_array_value["numbers"] .
                        " " .
                        $data_array_value["letters"];
                }
                $numbers["price"] = $data_array_value["price"];
                $numbers["plate_id"] = $data_array_value["id"];
                $numbers["plate_type"] = $plate_type;
                $number_data = $numbers;
            }
        }
        return $number_data;
    }

    function get_prefix_plates_by_loadmore(
        $search,
        $limit,
        $offset,
        $addition_search = ""
    ) {

		  $new_plate_id_arr = array();    		
		  $plate_id_arr = array();    	  
    	  $pp_id = $this->session->get_userdata('prefix_plate_ids');
    	  $plate_id_str = $pp_id['prefix_plate_ids'];
    	  if($plate_id_str != "") {
    	  	$plate_id_arr = explode(",",$plate_id_str);
    	  }	
        $number_data = [];
        $number_count = 0;
        $limit = "1";
        $exact_filter_data = [];

        $trim_search = str_replace(" ", "", trim($search));
        $search_length=strlen($trim_search);
        $exact_number="";
        if(($search_length==5 || $search_length==6 || $search_length==7) && $offset==48){
          
          if($search_length==5){
             $search_prefix=substr($trim_search, 0, 1);
             $search_number=substr($trim_search, 1, 1);;
             $search_latter=substr($trim_search, -3);
          }else if($search_length==6){
             $search_prefix=substr($trim_search, 0, 1);
             $search_number=substr($trim_search, 1, 2);;
             $search_latter=substr($trim_search, -3);
          }else if($search_length==7){
             $search_prefix=substr($trim_search, 0, 1);
             $search_number=substr($trim_search, 1, 3);;
             $search_latter=substr($trim_search, -3);
          }

			if(count($plate_id_arr) > 0) {
$exact_prefix_query =
            "SELECT `id`,`numbers`,`prefix`,`letters`,`plate_id`, `price` 
                                  FROM `prefix_plates` 
                                  WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = '1'
                                  AND `prefix` = '".$search_prefix ."'
                                  AND `numbers` = '".$search_number ."'
                                  AND `letters` = '".$search_latter ."'
                                  LIMIT 1";
			} else {
$exact_prefix_query =
            "SELECT `id`,`numbers`,`prefix`,`letters`,`plate_id`, `price` 
                                  FROM `prefix_plates` 
                                  WHERE `status` = '1'
                                  AND `prefix` = '".$search_prefix ."'
                                  AND `numbers` = '".$search_number ."'
                                  AND `letters` = '".$search_latter ."'
                                  LIMIT 1";
			}
          
            $exact_query_wtp = $this->db->query($exact_prefix_query);
            $exact_number_data = $exact_query_wtp->result_array();
            if (is_array($exact_number_data) && count($exact_number_data) > 0) {
                foreach ($exact_number_data as $ekey => $enumber_value) {
                        $p_number=$enumber_value["prefix"].''.$enumber_value["numbers"].' '.$enumber_value["letters"];
                        $exact_number=$p_number;
                        $filter_number["number"] = $p_number;
                        $filter_number["id"] = $enumber_value["id"];
                        $new_plate_id_arr[] = $enumber_value["id"];
                        $filter_number["price"] = $enumber_value["price"];
                        $filter_number["plate_id"] = $enumber_value["plate_id"];
                        $filter_number["plate_type"] = 2;
                        if (!isset($exact_filter_data[$p_number])) {
                            $exact_filter_data[$p_number] = $filter_number;
                            $number_count++;
                        }
                }
            }
        }

        $search_word = $this->getPossibleWord($search);
        $j = 1;
        foreach ($search_word as $key => $value) {
            if ($j == 1) {
                $like_q = "`letters` LIKE '%" . $value . "%'";
            } else {
                $like_q .= " OR `letters` LIKE '%" . $value . "%'";
            }
            $j++;
        }

        if ($addition_search == 1) {
        	if(count($plate_id_arr) > 0) {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'A%' OR prefix LIKE 'B%' OR prefix LIKE 'C%' OR prefix LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			} else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'A%' OR prefix LIKE 'B%' OR prefix LIKE 'C%' OR prefix LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			}
            
        } elseif ($addition_search == 2) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'E%' OR prefix LIKE 'F%' OR prefix LIKE 'G%' OR prefix LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			} else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'E%' OR prefix LIKE 'F%' OR prefix LIKE 'G%' OR prefix LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			}
            
        } elseif ($addition_search == 3) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'I%' OR prefix LIKE 'J%' OR prefix LIKE 'K%' OR prefix LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			} else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'I%' OR prefix LIKE 'J%' OR prefix LIKE 'K%' OR prefix LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			}
            
        } elseif ($addition_search == 4) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'M%' OR prefix LIKE 'N%' OR prefix LIKE 'O%' OR prefix LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			} else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'M%' OR prefix LIKE 'N%' OR prefix LIKE 'O%' OR prefix LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			}
            
        } elseif ($addition_search == 5) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Q%' OR prefix LIKE 'R%' OR prefix LIKE 'S%' OR prefix LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			} else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Q%' OR prefix LIKE 'R%' OR prefix LIKE 'S%' OR prefix LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			}
            
        } elseif ($addition_search == 6) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'U%' OR prefix LIKE 'V%' OR prefix LIKE 'W%' OR prefix LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			} else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'U%' OR prefix LIKE 'V%' OR prefix LIKE 'W%' OR prefix LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			}
            
        } elseif ($addition_search == 7) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Y%' OR prefix LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			} else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Y%' OR prefix LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "";
			}
            
        } elseif ($addition_search != "") {
            //$prefix_query = "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (".$like_q.") AND (prefix LIKE '".$addition_search."%' OR letters LIKE '".$addition_search."%') ORDER BY `id` LIMIT ".$limit.",".$offset."";
            if(count($plate_id_arr) > 0) {
            	$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE '" .
                $addition_search .
                "%' ) ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			} else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE '" .
                $addition_search .
                "%' ) ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			}
            
        } else {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			} else {
				$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `prefix_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			}
            
        }

        $query = $this->db->query($prefix_query);
        $number_data = $query->result_array();
        $filter_data = [];
        if (is_array($number_data) && count($number_data) > 0) {
            foreach ($number_data as $nkey => $number_value) {
                $number_value["numbers"] =
                    $number_value["prefix"] .
                    $number_value["numbers"] .
                    " " .
                    $number_value["letters"];
                if (strlen($number_value["numbers"]) == "9") {
                    $pos = strpos($number_value["numbers"], " ");
                    if ($pos == "2") {
                        $number = substr_replace(
                            $number_value["numbers"],
                            "",
                            2,
                            1
                        );
                        $filter_number["number"] = $number;
                    } else {
                        $filter_number["number"] = $number_value["numbers"];
                    }
                } else {
                    $filter_number["number"] = $number_value["numbers"];
                }

                $p_number=$number_value["prefix"].''.$number_value["numbers"].' '.$number_value["letters"];
                $filter_number["id"] = $number_value["id"];
                $new_plate_id_arr[] = $number_value["id"];
                $filter_number["price"] = $number_value["price"];
                $filter_number["plate_id"] = $number_value["plate_id"];
                $filter_number["plate_type"] = 2;
                if (!isset($filter_data[$p_number]) && $exact_number!=$p_number) {
                    $filter_data[$p_number] = $filter_number;
                }
            }
        }
        // $final_data = array_merge($exact_filter_data, $filter_data);
        $new_id_str = "";
		$new_id_array = array_merge($plate_id_arr,$new_plate_id_arr);
		if(is_array($new_id_array) && count($new_id_array) > 0) {
			array_unique($new_id_array);
			$new_id_str = implode(",",$new_id_array);
		}
		
		$this->session->set_userdata('private_plate_ids', $new_id_str);
        $final_data = $filter_data;
        return $final_data;
    }

    function get_new_plates_by_loadmore(
        $search,
        $limit,
        $offset,
        $addition_search = ""
    ) {
    	  $new_plate_id_arr = array();    		
		  $plate_id_arr = array();    	  
    	  $pp_id = $this->session->get_userdata('current_plate_ids');
    	  $plate_id_str = $pp_id['current_plate_ids'];
    	  if($plate_id_str != "") {
    	  	$plate_id_arr = explode(",",$plate_id_str);
    	  }
        $number_data = [];
        $number_count = 0;
        $limit = "1";
        $exact_filter_data = [];

        $trim_search = str_replace(" ", "", trim($search));
        $search_length=strlen($trim_search);
        $exact_number="";
        if(($search_length==6 || $search_length==7 || $search_length==8) && $offset==48){

          if($search_length==6){
             $search_prefix=substr($trim_search, 0, 2);
             $search_number=substr($trim_search, 2, 1);;
             $search_latter=substr($trim_search, -3);
          }else if($search_length==7){
             $search_prefix=substr($trim_search, 0, 2);
             $search_number=substr($trim_search, 2, 2);;
             $search_latter=substr($trim_search, -3);
          }else if($search_length==8){
             $search_prefix=substr($trim_search, 0, 2);
             $search_number=substr($trim_search, 2, 3);
             $search_latter=substr($trim_search, -3);
          }

			 if(count($plate_id_arr) > 0) {
			 	$exact_new_query =
          "SELECT `id`,`numbers`,`prefix`,`letters`,`plate_id`, `price` 
                                FROM `new_plates` 
                                WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = '1'
                                AND `prefix` = '".$search_prefix ."'
                                AND `numbers` = '".$search_number ."'
                                AND `letters` = '".$search_latter ."'
                                LIMIT 1";
			 } else {
$exact_new_query =
          "SELECT `id`,`numbers`,`prefix`,`letters`,`plate_id`, `price` 
                                FROM `new_plates` 
                                WHERE `status` = '1'
                                AND `prefix` = '".$search_prefix ."'
                                AND `numbers` = '".$search_number ."'
                                AND `letters` = '".$search_latter ."'
                                LIMIT 1";
			 }
          

          $exact_query_wtp = $this->db->query($exact_new_query);
          $exact_number_data = $exact_query_wtp->result_array();
          
          if (is_array($exact_number_data) && count($exact_number_data) > 0) {
            foreach ($exact_number_data as $ekey => $enumber_value) {
                $p_number=$enumber_value["prefix"].''.$enumber_value["numbers"].' '.$enumber_value["letters"];
                $exact_number=$p_number;
                $filter_number["number"] = $p_number;
                $filter_number["id"] = $enumber_value["id"];
					 $new_plate_id_arr[] = $enumber_value["id"];
                $filter_number["price"] = $enumber_value["price"];
                $filter_number["plate_id"] = $enumber_value["plate_id"];
                $filter_number["plate_type"] = 3;
                if (!isset($exact_filter_data[$p_number])) {
                    $exact_filter_data[$p_number] = $filter_number;
                    $number_count++;
                }
            }
          }

        }

        $search_word = $this->getPossibleWord($search);
        $j = 1;
        foreach ($search_word as $key => $value) {
            if ($j == 1) {
                $like_q = "`letters` LIKE '%" . $value . "%' ESCAPE '!'";
            } else {
                $like_q .= " OR `letters` LIKE '%" . $value . "%' ESCAPE '!'";
            }
            $j++;
        }

        if ($addition_search == 1) {
        	if(count($plate_id_arr) > 0) {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'A%' OR prefix LIKE 'B%' OR prefix LIKE 'C%' OR prefix LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 } else {
			 	$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'A%' OR prefix LIKE 'B%' OR prefix LIKE 'C%' OR prefix LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 }
            
        } elseif ($addition_search == 2) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'E%' OR prefix LIKE 'F%' OR prefix LIKE 'G%' OR prefix LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 } else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'E%' OR prefix LIKE 'F%' OR prefix LIKE 'G%' OR prefix LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";			 	
			 }
            
        } elseif ($addition_search == 3) {
        	if(count($plate_id_arr) > 0) {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'I%' OR prefix LIKE 'J%' OR prefix LIKE 'K%' OR prefix LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 } else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'I%' OR prefix LIKE 'J%' OR prefix LIKE 'K%' OR prefix LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 }
            
        } elseif ($addition_search == 4) {
        	if(count($plate_id_arr) > 0) {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'M%' OR prefix LIKE 'N%' OR prefix LIKE 'O%' OR prefix LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 } else {
			 	$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'M%' OR prefix LIKE 'N%' OR prefix LIKE 'O%' OR prefix LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 }
            
        } elseif ($addition_search == 5) {
        	if(count($plate_id_arr) > 0) {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Q%' OR prefix LIKE 'R%' OR prefix LIKE 'S%' OR prefix LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 } else {
			 	$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Q%' OR prefix LIKE 'R%' OR prefix LIKE 'S%' OR prefix LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 }
            
        } elseif ($addition_search == 6) {
if(count($plate_id_arr) > 0) {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'U%' OR prefix LIKE 'V%' OR prefix LIKE 'W%' OR prefix LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 } else {
			 	$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'U%' OR prefix LIKE 'V%' OR prefix LIKE 'W%' OR prefix LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 }
            
        } elseif ($addition_search == 7) {
if(count($plate_id_arr) > 0) {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Y%' OR prefix LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 } else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE 'Y%' OR prefix LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 }
            
        } elseif ($addition_search != "") {
if(count($plate_id_arr) > 0) {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE '" .
                $addition_search .
                "%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 } else {
			 	$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (prefix LIKE '" .
                $addition_search .
                "%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 }
            
        } else {
        	if(count($plate_id_arr) > 0) {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 } else {
$prefix_query =
                "SELECT `id`, `prefix`, `numbers`, `letters`, `plate_id`, `price` FROM `new_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
			 }
            
        }
        $query = $this->db->query($prefix_query);
        $number_data = $query->result_array();
        $filter_data = [];
        if (is_array($number_data) && count($number_data) > 0) {
            foreach ($number_data as $nkey => $number_value) {
                if (strlen($number_value["numbers"]) == 1) {
                    $number_value["numbers"] = "0" . $number_value["numbers"];
                }
                $number_value["numbers"] =
                    $number_value["prefix"] .
                    " " .
                    $number_value["numbers"] .
                    " " .
                    $number_value["letters"];
                if (strlen($number_value["numbers"]) == "9") {
                    $pos = strpos($number_value["numbers"], " ");
                    if ($pos == "2") {
                        $number = substr_replace(
                            $number_value["numbers"],
                            "",
                            2,
                            1
                        );
                        $filter_number["number"] = $number;
                    } else {
                        $filter_number["number"] = $number_value["numbers"];
                    }
                } else {
                    $filter_number["number"] = $number_value["numbers"];
                }
                $p_number=$number_value["prefix"].''.$number_value["numbers"].' '.$number_value["letters"];
                $filter_number["id"] = $number_value["id"];
                $new_plate_id_arr[] = $number_value["id"];
                $filter_number["price"] = $number_value["price"];
                $filter_number["plate_id"] = $number_value["plate_id"];
                $filter_number["plate_type"] = 3;
                if (!isset($filter_data[$p_number]) && $exact_number!=$p_number) {
                    $filter_data[$p_number] = $filter_number;
                }
            }
        }
        $new_id_str = "";
		$new_id_array = array_merge($plate_id_arr,$new_plate_id_arr);
		if(is_array($new_id_array) && count($new_id_array) > 0) {
			array_unique($new_id_array);
			$new_id_str = implode(",",$new_id_array);
		}
		
		$this->session->set_userdata('current_plate_ids', $new_id_str);
		//echo $new_id_str;exit;
        // $final_data = array_merge($exact_filter_data, $filter_data);
        $final_data = $filter_data;
        return $final_data;
    }

    function get_cherished_plates_by_loadmore(
        $search,
        $limit,
        $offset,
        $addition_search = ""
    ) {
        $new_plate_id_arr = array();    		
		  $plate_id_arr = array();    	  
    	  $pp_id = $this->session->get_userdata('private_plate_ids');
    	  $plate_id_str = $pp_id['private_plate_ids'];
    	  if($plate_id_str != "") {
    	  	$plate_id_arr = explode(",",$plate_id_str);
    	  }	
        $search_data = [];
        $number_count = 0;
        $limit = "12";
        $exact_filter_data = [];
        if (!empty($type)) {
            $limit = "48";
        }
        $trim_search = str_replace(" ", "", trim($search));
        $exact_number="";
        if(count($plate_id_arr) > 0) {
        	$exact_cherished_query =  "SELECT `id`, `number`, `plate_id`, `price`,`apply_poa` FROM `cherished_plates`  WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND REPLACE(`number`, ' ', '') = '" . $trim_search ."' ORDER BY `id` LIMIT " . $limit ."";
        } else {
        	$exact_cherished_query =  "SELECT `id`, `number`, `plate_id`, `price`,`apply_poa` FROM `cherished_plates`  WHERE `status` = 1 AND REPLACE(`number`, ' ', '') = '" . $trim_search ."' ORDER BY `id` LIMIT " . $limit ."";
        }
        
        $exact_query_wtp = $this->db->query($exact_cherished_query);
        $exact_number_data = $exact_query_wtp->result_array();
        if ((is_array($exact_number_data) && count($exact_number_data) > 0)) {
            foreach ($exact_number_data as $ekey => $enumber_value) {
                if ($number_count < $limit) {
                    if (strlen($enumber_value["number"]) == "9") {
                        $pos = strpos($enumber_value["number"], " ");
                        if ($pos == "2") {
                            $number = substr_replace(
                                $enumber_value["number"],
                                "",
                                2,
                                1
                            );
                            $filter_number["number"] = $number;
                        } else {
                            $filter_number["number"] = $enumber_value["number"];
                        }
                    } else {
                        $filter_number["number"] = $enumber_value["number"];
                    }

                    $exact_number=$enumber_value["number"];
                    $filter_number["id"] = $enumber_value["id"];
                    $new_plate_id_arr[] = $enumber_value["id"];
                    $filter_number["price"] = $enumber_value["price"];
                    $filter_number["plate_id"] = $enumber_value["plate_id"];
                    $filter_number["apply_poa"] = $enumber_value["apply_poa"];
                    $filter_number["plate_type"] = 1;
                    if (!isset($exact_filter_data[$enumber_value["number"]])) {
                        $exact_filter_data[
                            $enumber_value["number"]
                        ] = $filter_number;
                        $number_count++;
                    }
                }
            }
        }

        $search_word = $this->getPossibleWord($search);
        $number_data = [];

        $j = 1;
        foreach ($search_word as $key => $value) {
            if ($j == 1) {
                $like_q = "`number` LIKE '%" . $value . "%' ESCAPE '!'";
            } else {
                $like_q .= " OR `number` LIKE '%" . $value . "%' ESCAPE '!'";
            }
            $j++;
        }

        if ($addition_search == 1) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'A%' OR number LIKE 'B%' OR number LIKE 'C%' OR number LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'A%' OR number LIKE 'B%' OR number LIKE 'C%' OR number LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 2) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'E%' OR number LIKE 'F%' OR number LIKE 'G%' OR number LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'E%' OR number LIKE 'F%' OR number LIKE 'G%' OR number LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 3) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'I%' OR number LIKE 'J%' OR number LIKE 'K%' OR number LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'I%' OR number LIKE 'J%' OR number LIKE 'K%' OR number LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 4) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'M%' OR number LIKE 'N%' OR number LIKE 'O%' OR number LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'M%' OR number LIKE 'N%' OR number LIKE 'O%' OR number LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 5) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'Q%' OR number LIKE 'R%' OR number LIKE 'S%' OR number LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'Q%' OR number LIKE 'R%' OR number LIKE 'S%' OR number LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 6) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'U%' OR number LIKE 'V%' OR number LIKE 'W%' OR number LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'U%' OR number LIKE 'V%' OR number LIKE 'W%' OR number LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 7) {
        	if(count($plate_id_arr) > 0) {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'Y%' OR number LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$prefix_query =
                "SELECT `id`, `number`, `plate_id`,`price`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE 'Y%' OR number LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search != "") {
		if(count($plate_id_arr) > 0) {
			$cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE '" .
                $addition_search .
                "%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") AND (number LIKE '" .
                $addition_search .
                "%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } else {
        	if(count($plate_id_arr) > 0) {
        		$cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND (" .
                $like_q .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$cherished_query =
                "SELECT `id`, `number`, `plate_id`, `price`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND (" .
                $like_q .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        }
        $query_wtp = $this->db->query($cherished_query);
        $number_data = $query_wtp->result_array();

        $filter_data = [];
        $private_filter_data = [];
        $final_data = [];

        // Private
        $i = 1;
        foreach ($search_word as $key => $value) {
            if ($i == 1) {
                $like_q_tp = "`number` LIKE '%" . $value . "%' ESCAPE '!'";
            } else {
                $like_q_tp .= " OR `number` LIKE '%" . $value . "%' ESCAPE '!'";
            }
            $i++;
        }

        if ($addition_search == 1) {
        	if(count($plate_id_arr) > 0) {
$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'A%' OR number LIKE 'B%' OR number LIKE 'C%' OR number LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'A%' OR number LIKE 'B%' OR number LIKE 'C%' OR number LIKE 'D%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 2) {
        	if(count($plate_id_arr) > 0) {
        		$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'E%' OR number LIKE 'F%' OR number LIKE 'G%' OR number LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'E%' OR number LIKE 'F%' OR number LIKE 'G%' OR number LIKE 'H%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 3) {
        	if(count($plate_id_arr) > 0) {
        		$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'I%' OR number LIKE 'J%' OR number LIKE 'K%' OR number LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'I%' OR number LIKE 'J%' OR number LIKE 'K%' OR number LIKE 'L%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 4) {
if(count($plate_id_arr) > 0) {
	$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'M%' OR number LIKE 'N%' OR number LIKE 'O%' OR number LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'M%' OR number LIKE 'N%' OR number LIKE 'O%' OR number LIKE 'P%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 5) {
        	if(count($plate_id_arr) > 0) {
        		$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'Q%' OR number LIKE 'R%' OR number LIKE 'S%' OR number LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'Q%' OR number LIKE 'R%' OR number LIKE 'S%' OR number LIKE 'T%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 6) {
if(count($plate_id_arr) > 0) {
	$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'U%' OR number LIKE 'V%' OR number LIKE 'W%' OR number LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'U%' OR number LIKE 'V%' OR number LIKE 'W%' OR number LIKE 'X%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search == 7) {
        	if(count($plate_id_arr) > 0) {
$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'Y%' OR number LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`,`price`,`private`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE 'Y%' OR number LIKE 'Z%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } elseif ($addition_search != "") {
        	if(count($plate_id_arr) > 0) {
        		$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`, `price`,`private`,`apply_poa`  FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE '" .
                $addition_search .
                "%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`, `price`,`private`,`apply_poa`  FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") AND (number LIKE '" .
                $addition_search .
                "%') ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        } else {
        	if(count($plate_id_arr) > 0) {
        		$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`, `price`, `private`,`apply_poa` FROM `cherished_plates` WHERE `id` not in ('" . implode("','", $plate_id_arr) . "') and `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	} else {
        		$cherished_query_wp =
                "SELECT `id`, `number`, `plate_id`, `price`, `private`,`apply_poa` FROM `cherished_plates` WHERE `status` = 1 AND `private` = 1 AND (" .
                $like_q_tp .
                ") ORDER BY `id` LIMIT " .
                $limit .
                "," .
                $offset .
                "";
        	}
            
        }
        $query_wp = $this->db->query($cherished_query_wp);
        $private_number_data = $query_wp->result_array();

        if (is_array($private_number_data) && count($private_number_data) > 0) {
            foreach ($private_number_data as $nkey => $number_value) {
                if (strlen($number_value["number"]) == "9") {
                    $pos = strpos($number_value["number"], " ");
                    if ($pos == "2") {
                        $number = substr_replace(
                            $number_value["number"],
                            "",
                            2,
                            1
                        );
                        $filter_number["number"] = $number;
                    } else {
                        $filter_number["number"] = $number_value["number"];
                    }
                } else {
                    $filter_number["number"] = $number_value["number"];
                }
                $filter_number["id"] = $number_value["id"];
					 $new_plate_id_arr[] = $number_value["id"];
                $filter_number["price"] = $number_value["price"];
                $filter_number["plate_id"] = $number_value["plate_id"];
                $filter_number["private"] = $number_value["private"];
                $filter_number["apply_poa"] = $number_value["apply_poa"];
                $filter_number["plate_type"] = 1;
                if (!isset($private_filter_data[$number_value["number"]]) && $exact_number!=$number_value["number"]) {
                    $private_filter_data[
                        $number_value["number"]
                    ] = $filter_number;
                }
            }
        }

        if (is_array($number_data) && count($number_data) > 0) {
            foreach ($number_data as $nkey => $number_value) {
                if (strlen($number_value["number"]) == "9") {
                    $pos = strpos($number_value["number"], " ");
                    if ($pos == "2") {
                        $number = substr_replace(
                            $number_value["number"],
                            "",
                            2,
                            1
                        );
                        $filter_number["number"] = $number;
                    } else {
                        $filter_number["number"] = $number_value["number"];
                    }
                } else {
                    $filter_number["number"] = $number_value["number"];
                }
                $filter_number["id"] = $number_value["id"];
					 $new_plate_id_arr[] = $number_value["id"];
                $filter_number["price"] = $number_value["price"];
                $filter_number["plate_id"] = $number_value["plate_id"];
                $filter_number["apply_poa"] = $number_value["apply_poa"];
                $filter_number["plate_type"] = 1;
                if (!isset($filter_data[$number_value["number"]]) && $exact_number!=$number_value["number"]) {
                    $filter_data[$number_value["number"]] = $filter_number;
                }
            }
        }
	
		$new_id_str = "";
		$new_id_array = array_merge($plate_id_arr,$new_plate_id_arr);
		if(is_array($new_id_array) && count($new_id_array) > 0) {
			array_unique($new_id_array);
			$new_id_str = implode(",",$new_id_array);
		}
		
		$this->session->set_userdata('private_plate_ids', $new_id_str);
        $final_data = array_merge(
            $private_filter_data,
            $filter_data
        );
        return $final_data;
    }
}
