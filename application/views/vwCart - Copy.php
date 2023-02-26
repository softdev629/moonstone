<?php
    $base_url=base_url();
    $count_cart_value=get_cart_count();
?>
<script src="<?php echo HTTP_ASSETS_PATH_CLIENT?>js/cart.js" type="text/javascript"></script>
<section class="slice-xs sct-color-2 border-bottom cart-head-container">
<div class="container">
  <div class="row cols-delimited">
      <div class="col-4">
          <div class="icon-block icon-block--style-1-v5 text-center active">
              <div class="block-icon mb-0">
                  <i class="icon-user"></i>
              </div>
              <div class="block-content d-none d-md-block">
                  <h3 class="heading heading-sm strong-300 c-active text-capitalize">1. Order details</h3>
              </div>
          </div>
      </div>

      <div class="col-4">
          <div class="icon-block icon-block--style-1-v5 text-center">
              <div class="block-icon mb-0">
                  <i class="icon-finance-067"></i>
              </div>
              <div class="block-content d-none d-md-block">
                  <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">2. Purchaser details</h3>
              </div>
          </div>
      </div>

      <div class="col-4">
          <div class="icon-block icon-block--style-1-v5 text-center">
              <div class="block-icon  mb-0">
                  <i class="icon-finance-018"></i>
              </div>
              <div class="block-content d-none d-md-block">
                  <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. Confirm and Pay</h3>
              </div>
          </div>
      </div>
  </div>
</div>
</section>
<section class="slice sct-color-1 cart-mid-container">

  <div class="container">
      <div class="row cols-xs-space cols-sm-space cols-md-space">

        <?php
        if($count_cart_value>0)
        {
        ?>
        
          <div class="col-lg-8" style="display:none;">
              <form class="form-default" data-toggle="validator" role="form">
                  <div class="">
                      <div class="" id="display">
                          <table class="table-cart border-bottom" width="94%">
                              <thead>
                                  <tr>
                                      
                                      <th class="product-name">Number Plates</th>
                                      <th class="product-price d-none d-lg-table-cell">Price</th>
                                      <th class="product-quanity d-none d-md-table-cell">Quantity</th>
                                      <th class="product-total">Total</th>
                                      <th class="product-remove"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                $gm=$total_qty=0;
                                foreach($cart_view as $cart_view_val) 
                                { 
                                  $total_qty=$total_qty+$cart_view_val['items'];
                                ?>
                                  <tr class="cart-item">
                                     

                                      <td class="product-name">
                                          <span class="pr-4"><?php echo $cart_view_val['number'];?></span>
                                      </td>

                                      <td class="product-price d-none d-lg-table-cell">
                                          <span class="pr-4">$<?php echo $cart_view_val['qtyprice'];?></span>
                                      </td>

                                      <td class="product-quantity d-none d-md-table-cell">
                                          <div class="input-group input-group--style-2 pr-4" style="width: 75px;">
                                              
                                              <input type="text" name="quantity[1]" class="form-control input-number form-quntity-cart" value="<?php echo $cart_view_val['items'];?>" maxlength="2" size="2" min="1" max="10" id="txtitems<?php echo $cart_view_val["cart_id"];?>" onkeyup="return  Zero_not_enter(<?php echo $cart_view_val['cart_id']?>), update_items(<?php echo $cart_view_val["cart_id"]?>);" onkeypress="return numericOnly(this);">
                                              
                                          </div>
                                      </td>
                                      <td class="product-total">
                                          <span>$<?php echo $cart_view_val['qtytotalprice'];?></span>
                                      </td>
                                      <td class="product-remove">
                                          <a href="javascript:void(0);" onclick="return deleteFunction(<?php echo $cart_view_val['cart_id']?>);" class="text-right pl-4">
                                              <i class="fa fa-trash"></i>
                                          </a>
                                      </td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                          </table>
                      </div>
                  </div>

                  <div class="row align-items-center pt-5" id="no_cart">
                      <div class="col-6">
                          <!-- <a href="#" class="link link--style-3">
                              <i class="ion-android-arrow-back"></i>
                              Return to shop
                          </a> -->
                      </div>
                      <div class="col-6 text-right">
                          <a href="<?php base_url(); ?>customerinformation" id="checkout-btn"
                           class="btn btn-styled btn-base-1">
                              Proceed to checkout
                          </a>
                      </div>
                  </div>
              </form>
          </div>
			
			
          <div class="col-lg-4 ml-lg-auto mr-lg-auto cart">
          <?php
          $gm=$total_qty=0;
          foreach($cart_view as $cart_view_val) 
          { 
            $total_qty=$total_qty+$cart_view_val['items'];
          ?>
  			   <div class="num-plate-box-inn"><?php echo $cart_view_val['number'];?></div>

        <?php } ?>
  			     <div class="clearfix"></div>
			   
              <?php
                $data['total_qty']=$total_qty;
                $this->load->view('vwCartSummary',$data);
              ?>
      			  <div class="clearfix"></div>
      			  <a href="javascript:void(0);" class="buy"><i class="fa fa-shopping-bag mr-1"></i> Checkout </a>
			  
          </div>
        
        <?php }else{ ?>
          <div class="col-lg-4 ml-lg-auto mr-lg-auto">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                  <td align="center" ><a href="<?php echo $base_url; ?>buy" class="btn btn-styled btn-base-1">Continue Shopping</a></td>
                </tr>
          </table>
          </div>
        <?php } ?>
      </div>
  </div>
</section>