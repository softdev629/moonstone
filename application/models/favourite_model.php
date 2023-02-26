<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favourite_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function favourite_number($data){
		$user_id= $this->session->userdata('user_id');
		$plate_id= isset($data['plate_id']) ? $data['plate_id'] : '';
		$is_number_favourite= isset($data['is_number_favourite']) ? $data['is_number_favourite'] : 0;
		$plates_number= isset($data['plates_number']) ? $data['plates_number'] : '';
		$plate_type= isset($data['plate_type']) ? $data['plate_type'] : '';
		$is_return=0;
		
		if($user_id!="" && $plate_id)
		{
	        
	        $tblName='favourite';
	         
	        $this->db->select('favourite.*');
	        $this->db->where('plate_id',$plate_id);
	        $this->db->where('user_id',$user_id);
	        $result = $this->db->get('favourite');
	        $result_row=$result->row();
	        if($is_number_favourite==0){
	            $this->db->where('id', $result_row->id);
				$this->db->delete('favourite');
	        }else{
		    	$data = array(
		            'user_id' => $user_id,
		            'plate_id' => $plate_id,
		            'plates_number' => $plates_number,
		            'is_number_favourite' =>$is_number_favourite,
		            'plate_type' =>$plate_type,
		            'created_at'=>date('Y-m-d H:i:s')
		        );
		        if(is_array($result_row) && count($result_row)>0){
		            $this->db->where('user_id', $user_id);
		            $this->db->where('plate_id', $plate_id);
		            $this->db->update('favourite', $data);
		        }else{
		            $query = $this->db->insert($tblName, $data);
		            $insert_id = $this->db->insert_id(); 
		        }
		        $is_return=1;
	        }
		}
	    return $is_return; 
	}

	function check_favourite_number($plate_id){
		$user_id= $this->session->userdata('user_id');
		$is_return=1;
		if($user_id!="" && $plate_id)
		{	  
	        $tblName='favourite';
	        $this->db->select('favourite.*');
	        $this->db->where('plate_id',$plate_id);
	        $this->db->where('user_id',$user_id);
	        $result = $this->db->get('favourite');
	        $result_row=$result->row();
	        if(is_array($result_row) && count($result_row)>0){
	        	$is_number_favourite=$result_row->is_number_favourite;
	            if($is_number_favourite==1){
	            	$is_return=0;
	            }
	        }
		}
	    return $is_return; 
	}
	
}
?>