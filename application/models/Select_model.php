<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Select_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->helper('url');
    }

    function get_banner($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('banner')->result_array();
        //echo $this->db->last_query();//exit;
        return $data;
    }

    function get_favorite($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $this->db->group_by(array("favourite.user_id", "favourite.plates_number"));
        $data = $this->db->get('favourite')->result_array();
        //echo $this->db->last_query();//exit;
        return $data;
    }

    function get_newsletter_subscription($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('newsletter_subscription')->result_array();
        //echo $this->db->last_query();exit;
        return $data;
    }

    function get_inquiries($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('inquiries')->result_array();
        //echo $this->db->last_query();//exit;
        return $data;
    }

    function get_notifications($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('notification')->result_array();
        //echo $this->db->last_query();//exit;
        return $data;
    }

    function user_login_log($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('user_login_log')->result_array();
        //echo $this->db->last_query();//exit;
        return $data;
    }

    function content($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        $this->db->where("is_active in ('0','1')");
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('content')->result_array();
        //echo $this->db->last_query();//exit;
        return $data;
    }

    function get_faqs($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }

        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('faqs')->result_array();
        // echo $this->db->last_query();exit;
        return $data;
    }

    function get_featured_plates($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }

        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('featured_plates')->result_array();
        // echo $this->db->last_query();exit;
        return $data;
    }

    function get_admin($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('admin')->result_array();
        //echo $this->db->last_query();//exit;
        return $data;
    }

    function get_users($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('user')->result_array();
        //echo $this->db->last_query();//exit;
        return $data;
    }

    function get_package($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }

        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('package')->result_array();
        // echo $this->db->last_query();exit;
        return $data;
    }
    
    function get_package_inquiries($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('package_inquiry')->result_array();
        return $data;
    }

    function get_seller_register($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('seller_register')->result_array();
        return $data;
    }

    function get_plate_offers_inquiries($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('plate_enquiry')->result_array();
        //echo $this->db->last_query();//exit;
        return $data;
    }

    function get_poa_inquiries($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('poa_enquiry')->result_array();
        return $data;
    }

    function get_order_list($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('order')->result_array();
        return $data;
    }

    function get_myorder_detials($order_id) {

        $this->db->select("*", false);
        $this->db->where("order.order_id='".$order_id."'");
        $this->db->join("user", "user.user_id = order.user_id", "left");
        $this->db->join("order_item","order_item.order_id = order.order_id","left");
        $data = $this->db->get('order')->row();
        return $data;
    }

    function get_favourite_list($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('favourite')->result_array();
        return $data;
    }
    
    function get_recommended_number_plates($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('recommended_number_plates')->result_array();
        return $data;
    }
    function get_cherished_plates($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('cherished_plates')->result_array();
        return $data;
    }

    function get_private_plates($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('cherished_plates')->result();
        return $data;
    }

    function get_faqs_category($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }

        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('faqs_category')->result_array();
        // echo $this->db->last_query();exit;
        return $data;
    }
    
    function get_company($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }

        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('company')->result_array();
        // echo $this->db->last_query();exit;
        return $data;
    }

    function get_total_private_palate($company_id) {

        $condition = "cherished_plates.private = '1' and cherished_plates.status != '3'";
        if($company_id>0){
            $condition = "cherished_plates.private = '1' and cherished_plates.status != '3' and company.id='".$company_id."'";
        }
        if ($condition != "") {
            $this->db->where($condition);
        }
        $join_arr[0] = array('table_name' =>"company", 'cond' => "cherished_plates.company_id = company.id", 'type' => "left");
        $this->db->select("cherished_plates.*,company.name");
        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        $query =$this->db->get("cherished_plates");
        return $query->num_rows();
    }


    function get_total_cron_data() {

        $query =$this->db->get("daily_cron_update");
        return $query->num_rows();
    }

    function getDuplicatePrivatePlate($condition = "", $field = "", $join_arr = array(), $orderby = "", $limit = "") {

        if ($field == "") {
            $field = "*";
        }
        $this->db->select($field, false);
        if ($condition != "") {
            $this->db->where($condition);
        }

        if (is_array($join_arr) && count($join_arr) > 0) {
            foreach ($join_arr as $key => $val) {
                $this->db->join($val['table_name'], $val['cond'], $val['type']);
            }
        }
        if ($orderby != "") {
            $this->db->order_by($orderby);
        }
        if ($limit != "") {
            list($offset, $limit) = @explode(",", $limit);
            $this->db->limit($offset, $limit);
        }
        $data = $this->db->get('duplicate_private_plates')->result_array();
        return $data;
    }

    function get_duplicate_plate_by_original_id($id)
    {
        $this->db->where('original_plate_id',$id);
        $result = $this->db->get('duplicate_private_plates');
        return $result->row();
    }
    
}
