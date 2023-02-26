<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
		    $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->helper('common_helper');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('select_model');
        $this->load->model('update_model');
        $this->load->model('Common_function_model','common');
        $this->load->model('StaticPages_model','content');
        $this->load->model('Cart_model','cart');
        $this->load->model('Users_model','users');
        $this->load->model('Email_settings_model','email_settings');
        $this->load->helper('string');
    }

    public function index() {

            require_once('application/libraries/stripe-php/init.php');
          
            $stripeSecret = $this->config->item('stripe_secret');

            \Stripe\Stripe::setApiKey($stripeSecret);

            

            $cart_list=$this->cart->get_cart_list();
            $tax=$total_qty=$qtytotalprice=$qtyprice=0;
            $dvla_price=get_dvla_price();
            $shipping_price=$this->config->item('shipping_price');
            $tex_percentage=$this->config->item('tex_percentage');
            $stripe_currency=$this->config->item('stripe_currency');
            $number_plates_details=array();
            $p_num = '';
            foreach($cart_list as $cart_val) 
            {     

                  $is_vat_apply=1;
                  if($cart_val['plate_type']=='1'){
                      $is_vat_apply=check_vat_apply($cart_val['plates_id']);
                  }
                  $product_details=total_product_price($cart_val['plate_type'],$cart_val['product_price'],$is_vat_apply);

                  $total_qty=$total_qty+$cart_val['items'];
                  $qtytotalprice=$qtytotalprice+$product_details['totalPrice'];
                  $qtyprice=$qtyprice+$product_details['SubplatePrice'];
                  $totalprice=$qtytotalprice;
                  $tax=$product_details['vat_cost'];
                  $plates_details['plates_number']=$cart_val['plates_number'];
                  $plates_details['items']=$cart_val['items'];
                  $number_plates_details[]=$plates_details;
                  $p_num = $cart_val['plates_number'];


            }
            $total_amount=round($totalprice);
            $sub_total_price=round($qtyprice);
           // $total_amount=1;
            $purchase_details=$this->session->userdata('purchase_details');
            
            $client_login=$this->session->userdata('client_login');
            $is_client_login=$this->session->userdata('is_client_login');
            if($is_client_login==1){
              $email=$client_login['email'];
            }else{
             $email=$purchase_details['email'];
            }
            $name=$purchase_details['name'];
            $address=$purchase_details['address'];
            $country=$purchase_details['country'];
            $city=$purchase_details['city'];
            $zip=$purchase_details['zip'];
            $phone_number=$purchase_details['phone_number'];
            if($total_amount>0)
            {
                // $paymentIntent = \Stripe\PaymentIntent::create([
                //                   'amount' => 1099,
                //                   'currency' => 'usd',
                //                   'payment_method_types' => ['card'],
                //                 ]);
                $intent = \Stripe\PaymentIntent::create([
                  // Verify your integration in this guide by including this parameter
                  'metadata' => ['integration_check' => 'accept_a_payment'],
                  "amount" => $total_amount*100,                      
                  "currency" => $stripe_currency,
                  'payment_method_types' => ['card'],
                  // "email" => $email,
                  //"description" => json_encode($number_plates_details),
                  "description" => 'Number Plates - ' . $p_num,
                  'shipping' => [
                      'name' => $name,
                      'address' => [
                        'line1' => $address,
                        'postal_code' => $zip,
                        'city' => $city,
                        'country' => $country,
                      ],
                    ],
                ]);

                $this->session->set_userdata('payment_intent_id', $intent->id);
            }
            else{
                redirect('buy','refresh');
            }
            $data = array();
            $data['page'] = 'Checkout';
            $data['currentPage']='7';
            $data['content']=$this->content->get_static_page_by_id($data['currentPage']);
            $data['cart_view']=$this->cart->get_cart_list();
            $data['totle_items']=$this->cart->get_cart_totle_items();
            $count_cart= get_cart_count();
            if($count_cart==0){
                redirect('buy','refresh');
            }
            
            $data['client_secret']=$intent->client_secret;

            $this->load->view('controls/vwHeader',$data);
            $this->load->view('vwPayment',$data);
            $this->load->view('controls/vwFooter',$data);

		
    }

    public function payment_init()
    {
      require_once('application/libraries/stripe-php/init.php');
     
      $stripeSecret = $this->config->item('stripe_secret');
      $guest_id= $this->session->userdata('guest');
      $user_id= $this->session->userdata('user_id');

      $cart_list=$this->cart->get_cart_list();
      $tax=$total_qty=$qtytotalprice=$qtyprice=0;
      $dvla_price=get_dvla_price();
      $shipping_price=$this->config->item('shipping_price');
      $tex_percentage=$this->config->item('tex_percentage');
      $stripe_currency=$this->config->item('stripe_currency');
      $number_plates_details=array();
      $p_num = '';
      foreach($cart_list as $cart_val) 
      {     
            $is_vat_apply=1;
            if($cart_view_val['plate_type']=='1'){
                $is_vat_apply=check_vat_apply($cart_view_val['plates_id']);
            }
            $product_details=total_product_price($cart_view_val['plate_type'],$cart_view_val['product_price'],$is_vat_apply);

            $total_qty=$total_qty+$cart_val['items'];
            $qtytotalprice=$qtytotalprice+$product_details['totalPrice'];
            $qtyprice=$qtyprice+$product_details['SubplatePrice'];
            $totalprice=$qtytotalprice;
            $tax=$product_details['vat_cost'];
            $plates_details['plates_number']=$cart_val['plates_number'];
            $plates_details['items']=$cart_val['items'];
            $number_plates_details[]=$plates_details;
            $p_num = $cart_val['plates_number'];


      }
      $total_amount=round($totalprice);
      $sub_total_price=round($qtyprice);
      $purchase_details=$this->session->userdata('purchase_details');
      $client_login=$this->session->userdata('client_login');
      $is_client_login=$this->session->userdata('is_client_login');
      if($is_client_login==1){
      $email=$client_login['email'];
      }else{
      $email=$purchase_details['email'];
      }
      $name=$purchase_details['name'];
      $address=$purchase_details['address'];
      $country=$purchase_details['country'];
      $city=$purchase_details['city'];
      $zip=$purchase_details['zip'];
      $phone_number=$purchase_details['phone_number'];
        if($total_amount>0){
            try {

              \Stripe\Stripe::setApiKey($stripeSecret);
              $stripe = \Stripe\Charge::create ([
                      "amount" => $total_amount*100,                      
                      "currency" => $stripe_currency,
                      // "email" => $email,
                      "source" => $this->input->post('stripeToken'),
                      //"description" => json_encode($number_plates_details),
                      "description" => 'Number Plates - ' . $p_num,
                      'shipping' => [
                      'name' => $name,
                      'address' => [
                        'line1' => $address,
                        'postal_code' => $zip,
                        'city' => $city,
                        'country' => $country,
                      ],
                    ],
              ]);
              
              $chargeJson = $stripe->jsonSerialize();

              $this->session->set_flashdata('payment_success', 'Order has been placed successfully!');

              $user_detials=$this->users->get_users_by_email($email);
              if(is_array($user_detials) && count($user_detials) == 0){
                  //login code
                  $tblName = "user";
                  $password=random_string('alnum',10);
                  $data = array(
                  'name' => $name,
                  'password' =>md5($password),
                  'email' => $email,
                  'phone_number' => $phone_number,
                  'address' => $address,
                  'city' => $city,
                  'country' => $country,
                  'zip' => $zip,
                  'is_active' => 1,
                  'create_date'=>date('Y-m-d')
                  );
                  $this->common->insert_record($tblName,$data);
                  $this->load->config('email');
                  $this->load->library('email');
                  $this->email->set_newline("\r\n");
                  $this->email->set_mailtype("html");
                  //$this->email->from("info@moonstoneplates.com");
                  $from = $this->config->item('smtp_user');
                  $this->email->from($from);
                  $this->email->to($email);
              
                  $data = array(
                   'name' => $name,
                   'email' => $email,
                   'phone_number' => $phone_number,
                   'address' => $address,
                   'create_date'=>date('Y-m-d')
                  );
                  $body = $this->load->view('email_template/register_email',$data,TRUE);
                  $this->email->subject('Registered successfully.');
                  $this->email->message($body);
                  $this->email->send();

              }else{
                 $tblName = "user";
                 $fieldName="user_id";
                 $user_id=$user_detials->user_id;
                  $login_data = array(
                  'name' => $name,
                  'email' => $email,
                  'phone_number' => $phone_number,
                  'address' => $address,
                  'city' => $city,
                  'country' => $country,
                  'zip' => $zip,
                  'is_active' => 1
                  );
                  $this->common->update_record($fieldName,$user_id,$tblName,$login_data);
              }

              

              $user_detials=$this->users->get_users_by_email($email);
              $user_id=$user_detials->user_id;
              $login_data['user_id']=$user_detials->user_id;
              $login_data['name']=$user_detials->name;
              $login_data['email']=$user_detials->email;
              $login_data['address']=$user_detials->address;
              $login_data['country']=$user_detials->country;
              $login_data['city']=$user_detials->city;
              $login_data['zip']=$user_detials->zip;
              $login_data['phone_number']=$user_detials->phone_number;
              $login_data['is_client_login']=1;
              $this->session->set_userdata('client_login', $login_data);
              $this->session->set_userdata('is_client_login',1);

              //add order data
              $orderTbl = "order";
              
              $orderData = array(
              'order_date'=>date("Y-m-d"),
              'user_id' =>$user_id,
              'user_name' =>$name,
              'status'=>1,
              'payment_status'=>1,
              'paymentmethod'=>"Stripe",
              'payment_currency'=>$stripe_currency,
              'sub_total_price'=>$sub_total_price,
              'tax_price'=>$tax,
              'shiping_charge'=>$shipping_price,
              'dvla_charge'=>$dvla_price,
              'total_price'=>$total_amount,
              'payment_detail' => json_encode($chargeJson)
              );
              
              $order_id=$this->users->add_order($orderTbl,$orderData);
              foreach($cart_list as $cart_val) 
              {     
                    $is_vat_apply=1;
                    if($cart_val['plate_type']=='1'){
                        $is_vat_apply=check_vat_apply($cart_val['plates_id']);
                    }
                    $product_details=total_product_price($cart_val['plate_type'],$cart_val["product_price"],$is_vat_apply);

                    $OrderItemData = array(
                      'order_id' =>$order_id,
                      'plates_id' =>$cart_val["plates_id"],
                      'seller_id' =>0,
                      'plates_number' =>$cart_val["plates_number"],
                      'product_price' =>$cart_val["product_price"],
                      'sub_total' =>$product_details['SubplatePrice'],
                      'qty' =>$cart_val["items"]
                       );
                    $OrderTblName="order_item";
                    $order_item_id=$this->users->add_order($OrderTblName,$OrderItemData);

                    $data=array('status'=>2);
                    $this->db->where('id', $cart_val["plates_id"]);
                    if($cart_val["plate_type"]==1){  
                    $this->db->update('cherished_plates', $data);
                    }else if($cart_val["plate_type"]==2){
                    $this->db->update('prefix_plates', $data);
                    }else if($cart_val["plate_type"]==3){
                    $this->db->update('new_plates', $data);  
                    }
              }

              // Send order success email to user
              $this->load->config('email');
              $this->load->library('email');
              $this->email->set_newline("\r\n");
              $this->email->set_mailtype("html");
              $from = $this->config->item('smtp_user');
              $this->email->from($from);
              $this->email->to($email);
              $this->email->bcc('darren.openshaw@xplore4.com','notifications@moonstoneplates.com');

              $data = array(
                 'first_name'=> $name,
                 'order_number' => $order_id,
                 'plate_number' => $p_num,
                );
              
              $body = $this->load->view('email_template/confirmation',$data,TRUE);
              $this->email->subject('Order confirmed successfully.');
              $this->email->message($body);
              $this->email->send();

              // Send order success email to admin
              $email_settings = $this->email_settings->get_email_settings_content_by_id('1');
              $this->load->config('email');
              $this->load->library('email');
              $this->email->set_newline("\r\n");
              $this->email->set_mailtype("html");
              $from = $this->config->item('smtp_user');
              $this->email->from($from);
              $this->email->to($email_settings->order_success_mail);
          
              $data = array(
                 'first_name'=> $name,
                 'order_number' => $order_id,
                 'plate_number' => $p_num,
                );
              $body = $this->load->view('email_template/confirmation',$data,TRUE);
              $this->email->subject('Order confirmed successfully.');
              $this->email->message($body);
              $this->email->send();
              

              $guest_id= $this->session->userdata('guest');
              $user_id= $this->session->userdata('user_id');
              $where = "((user_id = '".$user_id."' AND user_id!='' ) OR (guest_id = '".$guest_id."' AND guest_id!='' ))";
              $this->db->where($where);
              $this->db->delete('cart');



              redirect('buy','refresh');
               
            } catch(\Stripe\Exception\CardException $e) {
              // echo 'Status is:' . $e->getHttpStatus() . '\n';
              // echo 'Type is:' . $e->getError()->type . '\n';
              // echo 'Code is:' . $e->getError()->code . '\n';
              // // param is '' in this case
              // echo 'Param is:' . $e->getError()->param . '\n';
              // echo 'Message is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\RateLimitException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\InvalidRequestException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\AuthenticationException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\ApiConnectionException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\ApiErrorException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (Exception $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            }
        }else{
            redirect('buy','refresh');
        }
        
    }


    public function payment_success()
    {
      require_once('application/libraries/stripe-php/init.php');
     
      $stripeSecret = $this->config->item('stripe_secret');
      $guest_id= $this->session->userdata('guest');
      $user_id= $this->session->userdata('user_id');

      $cart_list=$this->cart->get_cart_list();
      $tax=$total_qty=$qtytotalprice=$qtyprice=0;
      $dvla_price=0;
      $shipping_price=$this->config->item('shipping_price');
      $tex_percentage=$this->config->item('tex_percentage');
      $stripe_currency=$this->config->item('stripe_currency');
      $number_plates_details=array();
      $p_num = '';
      foreach($cart_list as $cart_val) 
      {   

            $is_vat_apply=1;
            if($cart_val['plate_type']=='1'){
                $is_vat_apply=check_vat_apply($cart_val['plates_id']);
            }
            $product_details=total_product_price($cart_val['plate_type'],$cart_val['product_price'],$is_vat_apply);

            $total_qty=$total_qty+$cart_val['items'];
            $qtytotalprice=$qtytotalprice+$product_details['totalPrice'];
            $qtyprice=$qtyprice+$product_details['SubplatePrice'];
            $totalprice=$qtytotalprice;
            $tax=$product_details['vat_cost'];

            $plates_details['plates_number']=$cart_val['plates_number'];
            $plates_details['items']=$cart_val['items'];
            $number_plates_details[]=$plates_details;
            $p_num = $cart_val['plates_number'];
      }
      $total_amount=round($totalprice);
      $sub_total_price=round($qtyprice);
      //$total_amount=1;
      $purchase_details=$this->session->userdata('purchase_details');
      
      $client_login=$this->session->userdata('client_login');
      $is_client_login=$this->session->userdata('is_client_login');
      if($is_client_login==1){
        $email=$client_login['email'];
      }else{
        $email=$purchase_details['email'];
      }
      $name=$purchase_details['name'];
      $address=$purchase_details['address'];
      $country=$purchase_details['country'];
      $city=$purchase_details['city'];
      $zip=$purchase_details['zip'];
      $phone_number=$purchase_details['phone_number'];
        if($total_amount>0){
            try {

              \Stripe\Stripe::setApiKey($stripeSecret);

              $payment_intent_id=$this->session->userdata('payment_intent_id');
              
              $intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

              $intentJson = $intent->jsonSerialize();

              $this->session->set_flashdata('payment_success', 'Number Plates order placed has been successfully!!.');

              $user_detials=$this->users->get_users_by_email($email);
              
              //if(is_array($user_detials) && count($user_detials) == 0){
              if(!isset($user_detials)){
                  //login code
                  $tblName = "user";
                  $password=random_string('alnum',10);
                  $data = array(
                  'name' => $name,
                  'password' =>md5($password),
                  'email' => $email,
                  'phone_number' => $phone_number,
                  'address' => $address,
                  'city' => $city,
                  'country' => $country,
                  'zip' => $zip,
                  'is_active' => 1,
                  'create_date'=>date('Y-m-d')
                  );
                  $this->common->insert_record($tblName,$data);
                  $this->load->config('email');
                  $this->load->library('email');
                  $this->email->set_newline("\r\n");
                  $this->email->set_mailtype("html");
                  //$this->email->from("info@moonstoneplates.com");
                  $from = $this->config->item('smtp_user');
                  $this->email->from($from);
                  $this->email->to($email);
              
                  $data = array(
                   'name' => $name,
                   'email' => $email,
                   'phone_number' => $phone_number,
                   'address' => $address,
                   'create_date'=>date('Y-m-d')
                  );
                  $body = $this->load->view('email_template/register_email',$data,TRUE);
                  $this->email->subject('Registered successfully.');
                  $this->email->message($body);
                  $this->email->send();

                  //add notification
                  $ndata['user_id']=$inser_id;
                  $ndata['title']="New User (".$name.") created.";
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
                  $this->email->to($username);
                  $this->email->subject($ndata['title']);
                  $this->email->message($mail_message);
                  $this->email->send();
                  //end notification

              }else{
                 $tblName = "user";
                 $fieldName="user_id";
                 $user_id=$user_detials->user_id;
                  $login_data = array(
                  'name' => $name,
                  'email' => $email,
                  'phone_number' => $phone_number,
                  'address' => $address,
                  'city' => $city,
                  'country' => $country,
                  'zip' => $zip,
                  'is_active' => 1
                  );
                  $this->common->update_record($fieldName,$user_id,$tblName,$login_data);
              }

              // Send order success email to user
              $this->load->config('email');
              $this->load->library('email');
              $this->email->set_newline("\r\n");
              $this->email->set_mailtype("html");
              $from = $this->config->item('smtp_user');
              $this->email->from($from);
              $this->email->to($email);
              $this->email->bcc('darren.openshaw@xplore4.com','notifications@moonstoneplates.com');
          
              $data = array(
               'name' => $name,
               'email' => $email,
               'phone_number' => $phone_number,
               'address' => $address,
               'city' => $city,
               'country' => $country,
               'zip' => $zip,
               'order_date'=>date('d/m/Y'),
               'amount'=>number_format($total_amount, 2),
               'plate_number'=>$p_num
              );
              $body = $this->load->view('email_template/order_success',$data,TRUE);
              $this->email->subject('Order placed successfully.');
              $this->email->message($body);
              $this->email->send();

              // Send order success email to admin
              $email_settings = $this->email_settings->get_email_settings_content_by_id('1');
              $this->load->config('email');
              $this->load->library('email');
              $this->email->set_newline("\r\n");
              $this->email->set_mailtype("html");
              $from = $this->config->item('smtp_user');
              $this->email->from($from);
              $this->email->to($email_settings->order_success_mail);
          
              $data = array(
               'name' => $name,
               'email' => $email,
               'phone_number' => $phone_number,
               'address' => $address,
               'order_date'=>date('d/m/Y'),
               'amount'=>'£' . number_format($total_amount, 2),
               'plate_number'=>$p_num
              );
              $body = $this->load->view('email_template/order_success',$data,TRUE);
              $this->email->subject('Order placed successfully.');
              $this->email->message($body);
              $this->email->send();

              //add notification
              $user_id = !empty($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
                $ndata['user_id']=$user_id;
                $ndata['title']="New Order (".$p_num.") placed.";
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
              //end notification

              $user_detials=$this->users->get_users_by_email($email);
              $user_id=$user_detials->user_id;
              $login_data['user_id']=$user_detials->user_id;
              $login_data['name']=$user_detials->name;
              $login_data['email']=$user_detials->email;
              $login_data['address']=$user_detials->address;
              $login_data['country']=$user_detials->country;
              $login_data['city']=$user_detials->city;
              $login_data['zip']=$user_detials->zip;
              $login_data['phone_number']=$user_detials->phone_number;
              $login_data['is_client_login']=1;
              $this->session->set_userdata('client_login', $login_data);
              $this->session->set_userdata('is_client_login',1);

              //add order data
              $orderTbl = "order";
              
              $orderData = array(
              'order_date'=>date("Y-m-d"),
              'user_id' =>$user_id,
              'user_name' =>$name,
              'status'=>1,
              'payment_status'=>1,
              'paymentmethod'=>"Stripe",
              'payment_currency'=>$stripe_currency,
              'sub_total_price'=>$sub_total_price,
              'tax_price'=>$tax,
              'shiping_charge'=>$shipping_price,
              'dvla_charge'=>$dvla_price,
              'total_price'=>$total_amount,
              'payment_detail' => json_encode($intentJson)
              );
              
              $order_id=$this->users->add_order($orderTbl,$orderData);
              foreach($cart_list as $cart_val) 
              {     
                    $OrderItemData = array(
                      'order_id' =>$order_id,
                      'plates_id' =>$cart_val["plates_id"],
                      'seller_id' =>0,
                      'plates_number' =>$cart_val["plates_number"],
                      'product_price' =>$cart_val["product_price"],
                      'sub_total' =>$cart_val["total_price"],
                      'qty' =>$cart_val["items"]
                       );
                    $OrderTblName="order_item";
                    $order_item_id=$this->users->add_order($OrderTblName,$OrderItemData);

                    $data=array('status'=>2);
                    $this->db->where('id', $cart_val["plates_id"]);
                    if($cart_val["plate_type"]==1){  
                    $this->db->update('cherished_plates', $data);
                    }else if($cart_val["plate_type"]==2){
                    $this->db->update('prefix_plates', $data);
                    }else if($cart_val["plate_type"]==3){
                    $this->db->update('new_plates', $data);  
                    }
              }
              

              $guest_id= $this->session->userdata('guest');
              $user_id= $this->session->userdata('user_id');
              $where = "((user_id = '".$user_id."' AND user_id!='' ) OR (guest_id = '".$guest_id."' AND guest_id!='' ))";
              $this->db->where($where);
              $this->db->delete('cart');

              $this->session->unset_userdata('payment_intent_id');

              redirect('buy','refresh');
               
            } catch(\Stripe\Exception\CardException $e) {
              // echo 'Status is:' . $e->getHttpStatus() . '\n';
              // echo 'Type is:' . $e->getError()->type . '\n';
              // echo 'Code is:' . $e->getError()->code . '\n';
              // // param is '' in this case
              // echo 'Param is:' . $e->getError()->param . '\n';
              // echo 'Message is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\RateLimitException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\InvalidRequestException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\AuthenticationException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\ApiConnectionException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (\Stripe\Exception\ApiErrorException $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            } catch (Exception $e) {
              echo 'Error is:' . $e->getError()->message . '\n';
              $this->session->set_flashdata('payment_failed', $e->getError()->message);
              redirect('payment');
            }
        }else{
            redirect('buy','refresh');
        }
        
    }
}

