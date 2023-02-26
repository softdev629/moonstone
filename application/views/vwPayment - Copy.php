
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
            <div class="col-lg-8">
                <form role="form" action="<?php echo base_url() ?>/payment/payment_init" method="post" class="form-default require-validation" data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>" id="payment-form">
                    <h3 class="heading heading-3 strong-400 mb-4">Payment method</h3>

                    <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card-errors"></div>
                            </div>
                          </div>
                          
                            <div class="row">
                                <div class="col-lg-8">
                                <p class="c-gray-light mt-2">
                                Safe money transfer using your bank account. We support Mastercard, Visa, Maestro and Skrill.
                                </p>
                                </div>
                                <div class="col-lg-4 text-lg-right">
                                  <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/mastercard.png" class="mr-2" width="40">
                                  <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/visa.png" class="mr-2" width="40">
                                  <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/skrill.png" width="40">
                                </div>
                                <!-- <div class="col-lg-12">
                                   <div id="card-element"></div>
                                </div> -->
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Card number</label>
                                    <div id="card-number-element" class="field"></div>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Expiry date</label>
                                        <div id="card-expiry-element" class="field"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">CVV code</label>
                                            <div id="card-cvc-element" class="field"></div>
                                        
                                    </div>
                                </div>
                            </div>
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
                            <button type="submit" class="btn btn-styled btn-base-1">Complete order</button>
                        </div>
                    </div>
                </form>
                
            </div>

            <div class="col-lg-4 ml-lg-auto">
                <?php
                $data['total_qty']=$totle_items;
                $this->load->view('vwCartSummary',$data);
                ?>
            </div>
        </div>
    </div>
</section>
<script src="http://checkout.stripe.com/checkout.js"></script>
<script src="http://js.stripe.com/v3/"></script>
<script type="text/javascript">
  //var stripe = Stripe('pk_test_NnFkzcCGatx9R3JrAkDNHcDT00uUCNA58Q');
  var stripe = Stripe("<?php echo $this->config->item('stripe_key'); ?>");
  var elements = stripe.elements();
  var style = {
              base: {
                iconColor: '#fff',
                color: '#FFF',
                lineHeight: '30px',
                fontWeight: 300,
                fontFamily: '"Rubik", sans-serif',
                fontSize: '16px',
                '::placeholder': {
                  color: '#79797c',
                },
              },
            };
  var cardNumberElement = elements.create('cardNumber', {
        showIcon: true,
        style: style
      });
  cardNumberElement.mount('#card-number-element');

  var cardExpiryElement = elements.create('cardExpiry', {
  style: style
  });
  cardExpiryElement.mount('#card-expiry-element');

  var cardCvcElement = elements.create('cardCvc', {
    style: style
  });
  cardCvcElement.mount('#card-cvc-element');

  // Validate input of the card elements
  var resultContainer = document.getElementById('card-errors');
  cardNumberElement.addEventListener('change', function(event) {
      console.log('event.error',event);
      if (event.error) {
          resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
      } else {
          resultContainer.innerHTML = '';
      }
  });
  // Get payment form element
  var form = document.getElementById('payment-form');
  // Create a token when the form is submitted.
  form.addEventListener('submit', function(e) {
      e.preventDefault();
      createToken();
  });
  function createToken() {
    stripe.createToken(cardNumberElement).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
    });
  }
  // Callback to handle the response from stripe
  function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);
    
      // Submit the form
      form.submit();
  }
</script>
