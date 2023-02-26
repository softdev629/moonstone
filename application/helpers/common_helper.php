<?php

if(!function_exists('get_cart_count')){
	
	function get_cart_count()
	{	$CI=& get_instance();
		$user_id=$CI->session->userdata('user_id');
		$guest_id = $CI->session->userdata('guest');
		$where = "((user_id = '".$user_id."' AND user_id!='' ) OR (guest_id = '".$guest_id."' AND guest_id!='' ))";
		$CI->db->where($where);
		$result = $CI->db->count_all_results('cart');
		return $result;
	}
	
}

if(!function_exists('get_notification_count')){
	
	function get_notification_count()
	{	$CI=& get_instance();
		$where = "is_read = '0'";
		$CI->db->where($where);
		$result = $CI->db->count_all_results('notification');
		return $result;
	}
	
}

if(!function_exists('check_vat_apply')){
	
	function check_vat_apply($plate_id="")
	{	$CI=& get_instance();
		$CI->db->where('id',$plate_id);
		$CI->db->where('apply_vat','1');
		$result = $CI->db->count_all_results('cherished_plates');
		$is_vat=0;
		if($result>0){
			$is_vat=1;
		}
		return $is_vat;
	}
	
}
if(!function_exists('get_sell_count')){
	
	function get_sell_count()
	{	$CI=& get_instance();
		$user_id=$CI->session->userdata('user_id');
		$where = "user_id = '".$user_id."'";
		$CI->db->where($where);
		$result = $CI->db->count_all_results('seller_register');
		return $result;
	}
	
}
if(!function_exists('get_alphabetic')){
	
	function get_alphabetic()
	{	
		$abcd_array=[];
		$abcd_array['A']="A";
		$abcd_array['B']="B";
		$abcd_array['C']="C";
		$abcd_array['D']="D";
		$abcd_array['E']="E";
		$abcd_array['F']="F";
		$abcd_array['G']="G";
		$abcd_array['H']="H";
		$abcd_array['I']="I";
		$abcd_array['J']="J";
		$abcd_array['K']="K";
		$abcd_array['L']="L";
		$abcd_array['M']="M";
		$abcd_array['N']="N";
		$abcd_array['O']="O";
		$abcd_array['P']="P";
		$abcd_array['Q']="Q";
		$abcd_array['R']="R";
		$abcd_array['S']="S";
		$abcd_array['T']="T";
		$abcd_array['U']="U";
		$abcd_array['V']="V";
		$abcd_array['W']="W";
		$abcd_array['X']="X";
		$abcd_array['Y']="Y";
		$abcd_array['Z']="Z";
		return $abcd_array;
	}
	
}

if(!function_exists('total_product_price')){
	
	function total_product_price($platetype,$qtytotalprice,$is_vat_apply)
	{	
		$CI=& get_instance();
		$CI->db->where('id','1');
    	$query=$CI->db->get('settings');
		$tex_percentage=$query->result()[0]->mark_up ?? $CI->config->item('tex_percentage');
        $dvla_price=$CI->config->item('dvla_price');
		
		$platePrice=$qtytotalprice;
        $SubplatePrice=$platePrice;
		if($platetype!='1'){

		    $tex_val=($tex_percentage/100)+1;
		    $newPlatePrice=($qtytotalprice-$dvla_price)/1.2;
		    $newPlatePrice=$newPlatePrice*$tex_val;
		    $vat_cost=$newPlatePrice*0.2;
		    $totalPrice=round($newPlatePrice,2)+round($vat_cost,2)+round($dvla_price,2);
		    $SubplatePrice=$newPlatePrice;

		}else{
		    $vat_cost= 0;
		    if($is_vat_apply==1){
		        $vat_cost=$platePrice*0.20;
		    }
		    $SubplatePrice=$platePrice;
		    $totalPrice=$platePrice+$dvla_price+$vat_cost;
		}

		$tPrice['totalPrice'] = $totalPrice;
		$tPrice['SubplatePrice'] = $SubplatePrice;
		$tPrice['vat_cost'] = $vat_cost;
		return $tPrice;

	}
	
}


if(!function_exists('get_mark_up')){
	
	function get_mark_up()
	{	
		$CI=& get_instance();
		$CI->db->where('id','1');
    	$query=$CI->db->get('settings');
		return $query->result()[0]->mark_up;
	}
	
}

if(!function_exists('get_dvla_price')){
	
	function get_dvla_price()
	{	
		$CI=& get_instance();
		$CI->db->where('id','1');
    	$query=$CI->db->get('settings');
		$tex_percentage=$query->result()[0]->mark_up ?? $CI->config->item('tex_percentage');
        $dvla_price=$CI->config->item('dvla_price');
		return $dvla_price;
	}
	
}
?>