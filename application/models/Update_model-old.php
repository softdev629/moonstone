<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Update_Model extends CI_Model {

    public function __construct() {
        
    }

    public function update_users($data, $condition) {
        $this->db->set($data);
        $this->db->where($condition);
        return $this->db->update("users", $data);
    }
    
    public function update_user_login_log($data, $condition) {
        $this->db->set($data);
        $this->db->where($condition);
        return $this->db->update("user_login_log", $data);
    }
    
    public function update_admin($data, $condition) {
        $this->db->set($data);
        $this->db->where($condition);
        return $this->db->update("admin", $data);
    }

    public function update_user($data, $condition) {
        $this->db->set($data);
        $this->db->where($condition);
        return $this->db->update("user", $data);
    }
    
    public function update_cherished_plates($data, $condition) {
        $this->db->set($data);
        $this->db->where($condition);
        return $this->db->update("cherished_plates", $data);
    }
//cp removed $cron_tbl_id on 2302222
 	public function update_new_plate_status($data, $prefix, $numbers, $letters) {
        
        $array = array('prefix' => $prefix, 'numbers' => $numbers, 'letters' => $letters);
	    $this->db->where($array);
        $fetch_qry = $this->db->get('new_plates');
        $result=$fetch_qry->row();
        $plate_id=$result->id ?? 0;
        if($plate_id>0){

            $this->db->set($data);
            $array = array('prefix' => $prefix, 'numbers' => $numbers, 'letters' => $letters);
            $this->db->where($array);
            $this->db->update("new_plates", $data);

            $cron_array = array('id' => $cron_tbl_id);
            $cron_data = array(
                    'plate_id' => $plate_id,
                    'plate_type' =>"new_plates"
                );
            $tblName="daily_cron_update";
            $this->db->where($cron_array);
            $this->db->update($tblName, $cron_data);
        }
        return $plate_id;
    }

//cp removed $cron_tbl_id on 2302222


 	public function update_new_prefix_status($data, $prefix, $numbers, $letters) {
        
        $array = array('prefix' => $prefix, 'numbers' => $numbers, 'letters' => $letters);
        $this->db->where($array);
        $fetch_qry = $this->db->get('prefix_plates');
        $result=$fetch_qry->row();
        $plate_id=$result->id ?? 0;
        if($plate_id>0){

            $this->db->set($data);
            $array = array('prefix' => $prefix, 'numbers' => $numbers, 'letters' => $letters);
            $this->db->where($array);
            $this->db->update("prefix_plates", $data);

            $cron_array = array('id' => $cron_tbl_id);
            $cron_data = array(
                    'plate_id' => $plate_id,
                    'plate_type' =>"prefix_plates"
                );
            $tblName="daily_cron_update";
            $this->db->where($cron_array);
            $this->db->update($tblName, $cron_data);
        }
        return $plate_id;

    }


}
