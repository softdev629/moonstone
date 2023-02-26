
<section class="slice-xs sct-color-2 border-bottom cart-head-container">
    <div class="container">
        <div class="row cols-delimited">
            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center">
                    <div class="block-icon mb-0">
                        <i class="icon-user"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. Shopping bag</h3>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center">
                    <div class="block-icon mb-0">
                        <i class="icon-finance-067"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">2. Purchaser Details</h3>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center active">
                    <div class="block-icon  mb-0">
                        <i class="icon-finance-018"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light c-active text-capitalize">3. Confirm And Pay</h3>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</section>
<section class="slice sct-color-1 cart-mid-container">
    <div class="container">
	
	<div class="row cols-xs-space cols-sm-space cols-md-space">
		<div class="col-lg-5 ml-lg-auto mr-lg-auto">
                <?php
                $data['total_qty']=$totle_items;
                $this->load->view('vwCartSummary',$data);
                ?>
            </div>
	</div>
	
	<div class="clearfix"></div>
	
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-5 ml-lg-auto mr-lg-auto">
              <form action="<?php echo base_url() ?>payment_init" method="POST" id="payment-form">
                    <h3 class="heading heading-3 strong-400 mb-4">Payment method</h3>

                    <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="payment-errors"></div>
                              <?php if($this->session->flashdata('payment_failed')){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $this->session->flashdata('payment_failed'); ?>
                                  </div>
                              <?php } ?>
                            </div>
                          </div>
                          
                            <div class="row">
                                <div class="col-lg-12">
                                <p class="c-gray-light mt-2">
                                Safe money transfer using your bank account. We support Mastercard, Visa, Maestro and Skrill.
                                </p>
                                </div>
                                <div class="col-lg-12 text-lg-left mt-4">
                                  <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/mastercard.png" class="mr-2" width="40">
                                  <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/visa.png" class="mr-2" width="40">
                                  <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/skrill.png" width="40">
                                </div>
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                   <div id="card-element"></div>
                                </div>
                            </div>
                            <!--<div class="row mt-3">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Card number</label>
                                    <div class="input-group input-group--style-1">
                                        <input type="text" class="form-control input-mask" data-mask="0000 0000 0000 0000" placeholder="0000 0000 0000 0000" autocomplete="off" maxlength="16" id="card_number" name="card_number">
                                        <span class="input-group-addon">
                                            <i class="ion-card"></i>
                                        </span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Expiry month</label>
                                        <input type="text" class="form-control input-mask" data-mask="00/00" placeholder="MM" autocomplete="off" maxlength="2" name="exp_month" id="exp_month">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Expiry year</label>
                                        <input type="text" class="form-control input-mask" data-mask="00/00" placeholder="YY" autocomplete="off" maxlength="4" name="exp_year" id="exp_year">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">CVV code</label>
                                          <div class="input-group input-group--style-1">
                                              <input type="text" class="form-control input-mask" data-mask="000" autocomplete="off" maxlength="3" name="cvv" id="card_cvv">
                                              <span class="input-group-addon" data-toggle="popover" title="What is a CVV code?" data-content="It is a three digit code that can be found only on the back of your card. Be carefull so no one sees it.">
                                                  <i class="ion-help-circled"></i>
                                              </span>
                                          </div>
                                        
                                    </div>
                                </div>
                            </div>-->
                            <div class="row">
                                <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center pt-2">
                        <div class="col-lg-6">
                            <a href="<?php base_url(); ?>customerinformation" class="link link--style-3">
                                <i class="ion-android-arrow-back"></i>
                                Return to shop
                            </a>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button type="submit" class="btn btn-styled btn-base-1" id="payBtn">Complete order</button>
                        </div>
                    </div>
                </form>
                
            </div>

            
        </div>
    </div>
</section>
<style type="text/css">
#card-element {

border-radius: 4px 4px 0 0 ;

padding: 12px;

border: 1px solid rgba(50, 50, 93, 0.1);

height: 44px;

width: 100%;

background: white;

}
</style>
<!-- <script src="http://checkout.stripe.com/checkout.js"></script> -->
<script src="https://js.stripe.com/v3/"></script>
<!-- <script type="text/javascript" src="https://js.stripe.com/v2/"></script> --> 
<!-- jQuery is used only for this example; it isn't required to use Stripe -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->  
<script type="text/javascript">
var stripe = Stripe("<?php echo $this->config->item('stripe_key'); ?>");
var elements = stripe.elements();
var style = {
  base: {
    // color: "#32325d",
  }
};

var card = elements.create("card", { style: style });
card.mount("#card-element");

card.on('change', function(event) {
  var displayError = $(".payment-errors");
  if (event.error) {
    //displayError.textContent = event.error.message;
    $(".payment-errors").html('<div class="alert alert-danger">'+event.error.message+'</div>');
  } else {
    $(".payment-errors").html('');
  }
});


var form = document.getElementById('payment-form');

form.addEventListener('submit', function(ev) {
  ev.preventDefault();
  //disable the submit button to prevent repeated clicks
  $('#payBtn').attr("disabled", "disabled");
  stripe.confirmCardPayment('<?php echo $client_secret; ?>', {
    payment_method: {
      card: card,
    }
  }).then(function(result) {
    if (result.error) {
      // Show error to your customer (e.g., insufficient funds)
      //console.log(result.error.message);
      $('#payBtn').removeAttr("disabled");
      $(".payment-errors").html('<div class="alert alert-danger">'+result.error.message+'</div>');
    } else {
      // The payment has been processed!
      if (result.paymentIntent.status === 'succeeded') {
        // Show a success message to your customer
        // There's a risk of the customer closing the window before callback
        // execution. Set up a webhook or plugin to listen for the
        // payment_intent.succeeded event that handles any business critical
        // post-payment actions.
        //orderComplete(result.paymentIntent.id);
        window.location='<?php echo base_url() ?>payment/payment_success';
      }
    }
  });
});
</script>
<!--<script type="text/javascript">
  Stripe.setPublishableKey("<?php echo $this->config->item('stripe_key'); ?>");
  //callback to handle the response from stripe
  function stripeResponseHandler(status, response) {
      if (response.error) {
          //enable the submit button
          $('#payBtn').removeAttr("disabled");
          //display the errors on the form
          $(".payment-errors").html('<div class="alert alert-danger">'+response.error.message+'</div>');
          
      } else {
          var form$ = $("#payment-form");
          //get token id
          var token = response['id'];
          //insert the token into the form
          form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
          //submit form to the server
          form$.get(0).submit();
      }
  }
  $(document).ready(function() {
    //on form submit
    $("#payment-form").submit(function(event) {
        //disable the submit button to prevent repeated clicks
        $('#payBtn').attr("disabled", "disabled");
        //create single-use token to charge the user
        Stripe.createToken({
            number: $('#card_number').val(),
            cvc: $('#card_cvv').val(),
            exp_month: $('#exp_month').val(),
            exp_year: $('#exp_year').val()
        }, stripeResponseHandler);
        
        //submit from callback
        return false;
    });
});
</script>-->
