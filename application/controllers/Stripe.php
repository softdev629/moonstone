<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class Stripe extends CI_Controller {
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->library("session");
       $this->load->helper('url');
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index()
    {
        $this->load->view('stripePayment/index');
    }
        
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function payment()
    {
      require_once('application/libraries/stripe-php/init.php');
     
      $stripeSecret = 'sk_test_izFjcAmxlxZWElKP3GuItAsx007yEjDMLC';
 
      \Stripe\Stripe::setApiKey($stripeSecret);
      
        $stripe = \Stripe\Charge::create ([
                "amount" => $this->input->post('amount'),
                "currency" => "usd",
                "source" => $this->input->post('tokenId'),
                "description" => "This is from http://development.moonstoneplates.com/"
        ]);
             
       // after successfull payment, you can store payment related information into your database
              
        $data = array('success' => true, 'data'=> $stripe);
 
        echo json_encode($data);
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');
    
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
     
        \Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $this->input->post('stripeToken'),
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
            
        $this->session->set_flashdata('success', 'Payment made successfully.');
             
        redirect('/Stripe', 'refresh');
    }
}