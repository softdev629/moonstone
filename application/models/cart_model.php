<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function get_cart_by_id($id)
	{
		$this->db->where('cart_id',$id);
		$result = $this->db->get('cart');
		return $result->row();
	}

	function get_cart_list(){
		
		$guest_id= $this->session->userdata('guest');
		$user_id= $this->session->userdata('user_id');
		$where = "((user_id = '".$user_id."' AND user_id!='' ) OR (guest_id = '".$guest_id."' AND guest_id!='' ))";
		$this->db->select('cart.plates_id as plate_id,cart.plates_number as number,cart.product_price as price,(cart.product_price) as qtyprice,(cart.product_price*cart.items) as qtytotalprice,cart.*');
		$this->db->where($where);
		$result = $this->db->get('cart');
//echo $this->db->last_query();
		//print_r($result->result_array());exit();
		return $result->result_array();
		
	} 
	function get_cart_totle_items(){
		
		$guest_id= $this->session->userdata('guest');
		$user_id= $this->session->userdata('user_id');
		$where = "((user_id = '".$user_id."' AND user_id!='' ) OR (guest_id = '".$guest_id."' AND guest_id!='' ))";
		$this->db->select('cart.plates_id as plate_id,cart.plates_number as number,cart.product_price as price,(cart.product_price) as qtyprice,(cart.product_price*cart.items) as qtytotalprice,cart.*');
		$this->db->where($where);
		$result = $this->db->get('cart');
		$reseult_array=$result->result_array();
		$total_qty=0;
		if($reseult_array){
			foreach($reseult_array as $rkey => $reseult_value) {
				$total_qty=$total_qty+$reseult_value['items'];
			}
		}
		return $total_qty;
	} 
	function get_cart_by_user_id(){
		
		$user_id= $this->session->userdata('user_id');
		$where = "(user_id = '".$user_id."' AND status='cart' )";
		$this->db->select('product.product_id as product_id,product.product_name as product_name,product.product_code as product_code,product.url_path as url_path,(cart.product_price) as qtyprice,(cart.product_price*cart.items) as qtytotalprice,cart.*');
		$this->db->where($where);
		$this->db->join('product', 'product.product_id = cart.product_id', 'inner');
		$result = $this->db->get('cart');
		//print_r($result->result_array());exit();
		return $result->result_array();
		
	} 
	function cart_user_id_update(){
		$guest_id= $this->session->userdata('guest');
		$user_id= $this->session->userdata('user_id');
		
		if($guest_id!="")
		{
		$data=array('user_id'=>$user_id);
		$this->db->where('guest_id', $guest_id);
		$this->db->update('cart', $data);
		}
		}
	function get_cart_detail($id){
		
		$this->load->model('cart_model','cart');
		$this->load->model('Common_function_model','common');
		
		$product_id=$this->cart->get_cart_list($id);
		
	}
	function get_cart_delete($id){
	
			  
			  $this->db->where('cart_id', $id);
			  $this->db->delete('cart');
			  $count_cart= get_cart_count();
			  $this->load->model('cart_model','cart');
			$this->load->model('Common_function_model','common');
			$cart_details=$this->cart->get_cart_list($id);
			//print_r($cart_details);exit();
			 
			$data="";
		 	if($count_cart > 0){
			 
				$data="";
				$data.= '<table class="table-cart border-bottom" width="94%">
				<thead>
				<tr>
				<th class="product-name">Number Plates</th>
				<th class="product-price d-none d-lg-table-cell">Price</th>
				<th class="product-quanity d-none d-md-table-cell">Quantity</th>
				<th class="product-total">Total</th>
				<th class="product-remove"></th>
				</tr>
				</thead>
				<tbody>';
								
				$gm=0;
	            foreach($cart_details as $cart_view_val) 
	            {
	            	$data.='<tr class="cart-item">
					<td class="product-name">
					<span class="pr-4">'.$cart_view_val['number'].'</span>
					</td>
					<td class="product-price d-none d-lg-table-cell">
					<span class="pr-4">£'.$cart_view_val['qtyprice'].'</span>
					</td>
					<td class="product-quantity d-none d-md-table-cell">
					<div class="input-group input-group--style-2 pr-4" style="width: 75px;">
					<input type="text" name="quantity[]" class="form-control input-number form-quntity-cart" value='.$cart_view_val['items'].' maxlength="2" size="2" min="1" max="10" id="txtitems'.$cart_view_val["cart_id"].'" onkeyup="return  Zero_not_enter('.$cart_view_val["cart_id"].'), update_items('.$cart_view_val["cart_id"].');" onkeypress="return numericOnly(this);">
					</div>
					</td>
					<td class="product-total">
					      <span>£'.$cart_view_val['qtytotalprice'].'</span>
					  </td>
					  <td class="product-remove">
					      <a href="javascript:void(0);" onclick="return deleteFunction('.$cart_view_val['cart_id'].');" class="text-right pl-4">
					          <i class="fa fa-trash"></i>
					      </a>
					  </td>
					</tr>';

	            }	
				$data.= '</tbody></table>';	 
			}
			else 
			{
				$data.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
	              <tr>
	                <td >&nbsp;</td>
	              </tr>
	              <tr>
	                <td  align="center">Your shopping cart is empty!</td>
	              </tr>
	              <tr>
	                <td >&nbsp;</td>
	              </tr>
	              <tr>
	                <td align="center" ><a href="/buy" class="btn btn-styled btn-base-1">Continue Shopping</a></td>
	              </tr>
	            </table>
				';
			} 
		return $data;		
	}
	function get_clear_cart_logout($user_id){
		
		$where = "(user_id = '".$user_id."')";
		$this->db->where($where);
		$this->db->delete('cart');
	}
	function get_clear_cart(){
		
		$guest_id= $this->session->userdata('guest');
		$user_id= $this->session->userdata('user_id');
		$where = "((user_id = '".$user_id."' AND user_id!='' ) OR (guest_id = '".$guest_id."' AND guest_id!='' ))";
		$this->db->where($where);
		$this->db->delete('cart');
	
		return ' <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td  align="center">Your shopping cart is empty!</td>
              </tr>
              <tr>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td align="center" ><input type="submit" name="submitempty" class="btn-default" value="Continue Shopping"  onClick="ContinueShopping();"></td>
              </tr>
            </table>';
		
	}
	function get_update_cart($id,$qty){
		
			$data=array('items'=>$qty);
			$this->db->where('cart_id', $id);
			$this->db->update('cart', $data);
		
			$this->load->model('cart_model','cart');
			$this->load->model('Common_function_model','common');
			$updated_cart=$this->cart->get_cart_list();
			$cart_update="";
			$cart_update.= '<table class="table-cart border-bottom" width="94%">
			<thead>
			<tr>
			<th class="product-name">Number Plates</th>
			<th class="product-price d-none d-lg-table-cell">Price</th>
			<th class="product-quanity d-none d-md-table-cell">Quantity</th>
			<th class="product-total">Total</th>
			<th class="product-remove"></th>
			</tr>
			</thead>
			<tbody>';
						
			$gm=0;
            foreach($updated_cart as $cart_view_val) 
            {
			
			
				$cart_update.='<tr class="cart-item">
				<td class="product-name">
				<span class="pr-4">'.$cart_view_val['number'].'</span>
				</td>
				<td class="product-price d-none d-lg-table-cell">
				<span class="pr-4">£'.$cart_view_val['qtyprice'].'</span>
				</td><td class="product-quantity d-none d-md-table-cell">
				<div class="input-group input-group--style-2 pr-4" style="width: 75px;">
				<input type="text" name="quantity[]" class="form-control input-number form-quntity-cart" value='.$cart_view_val['items'].' maxlength="2" size="2" min="1" max="10" id="txtitems'.$cart_view_val["cart_id"].'" onkeyup="return  Zero_not_enter('.$cart_view_val["cart_id"].'), update_items('.$cart_view_val["cart_id"].');" onkeypress="return numericOnly(this);">
				</div>
				</td>
				<td class="product-total">
				      <span>£'.$cart_view_val['qtytotalprice'].'</span>
				  </td>
				  <td class="product-remove">
				      <a href="javascript:void(0);" return deleteFunction('.$cart_view_val['cart_id'].'); class="text-right pl-4">
				          <i class="fa fa-trash"></i>
				      </a>
				  </td>
				</tr>';	  
			}
			$cart_update.= '</tbody></table>';
			return $cart_update;
	}
	function get_cart_summary($id){
		
			$dvla_price=80;
			$shipping_price=40;
			$tex_percentage=20;
			$this->load->model('cart_model','cart');
			$updated_cart=$this->cart->get_cart_list();
			$gm=0;
            $gm=$total_qty=$qtytotalprice=$qtyprice=0;
            $cart_details="";
            $cart_update="";
            if(count($updated_cart)>0){
            	foreach($updated_cart as $cart_view_val) 
	            {
					$total_qty=$total_qty+$cart_view_val['items'];
					$qtytotalprice=$qtytotalprice+$cart_view_val['qtytotalprice'];
	                $qtyprice=$qtyprice+$cart_view_val['qtyprice'];
					$cart_details.='<tr class="cart_item">
					<td class="product-name">
					'.$cart_view_val['number'].'
					<strong class="product-quantity">× '.$cart_view_val['items'].'</strong>
					</td>
					<td class="product-total text-right">
					<span>£'.$cart_view_val['qtytotalprice'].'</span>
					</td>
					</tr>';
				}
				$totalprice=$qtytotalprice+$dvla_price+$shipping_price;
				$tax=($totalprice*$tex_percentage)/100;
				$totalprice=$totalprice+$tax;
				$cart_update.= '<div class="card-title">
				<div class="row align-items-center">
				<div class="col-lg-6">
				<h3 class="heading heading-3 strong-400 mb-0">
				<span>Summary</span>
				</h3>
				</div>
				<div class="col-lg-6 text-right">
				<span class="badge badge-md badge-pill bg-blue">'.$total_qty.' items</span>
				</div>
				</div>
				</div><div class="card-body">
				<table class="table-cart table-cart-review" width="100%">
				<thead>
				<tr>
				<th class="product-name">Number Plates</th>
				<th class="product-total text-right">Total</th>
				</tr>
				</thead>
				<tbody>';
				$cart_update.=$cart_details;
				$cart_update.='</tbody><tfoot>
				<tr class="cart-subtotal no-border">
				<th>Subtotal</th>
				<td class="text-right">
				<span class="strong-600">£'.$qtytotalprice.'</span>
				</td>
				</tr>
				<tr class="cart-subtotal no-border">
				<th>DVLA FEE</th>
				<td class="text-right">
				<span class="strong-600">£'.$dvla_price.'</span>
				</td>
				</tr>
				<tr class="cart-subtotal no-border">
				<th>SHIPPING Charge</th>
				<td class="text-right">
				<span class="strong-600">£'.$shipping_price.'</span>
				</td>
				</tr>
				<tr class="cart-subtotal no-border">
				<th>Taxes</th>
				<td class="text-right">
				<span class="strong-600">£'.$tax.'</span>
				</td>
				</tr>
				<tr class="cart-total">
				<th><span class="strong-600">Total</span></th>
				<td class="text-right">
				<strong><span>£'.$totalprice.'</span></strong>
				</td>
				</tr>
				</tfoot></table></div>';
            }
            
			return $cart_update;
	}
}
?>