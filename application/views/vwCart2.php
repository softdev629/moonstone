<script src="<?php echo HTTP_ASSETS_PATH_CLIENT?>js/cart.js" type="text/javascript"></script>
<div id="middlewrapper">
  <div id="content-wrapper">
    <div class="wrapper">
      <div id="content">
        <div id="product-details">
          <div class="bluehead">
            <h2>
              <?php echo $content->page_title;?>
            </h2>
          </div>
                 <?php if($this->session->flashdata('msg')){ ?>
                  <br class="clear">
                  <center style="color: green; font-size: 15px;">
                    <?php echo $this->session->flashdata('msg'); ?>
                  </center>
                  <br class="clear">
                  <? }
				  ?>

          <div id="display" class="textcenter text">
            <?
		 $count_cart_value =get_cart_count();
	  if($count_cart_value>0)
	  {
	  ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td><table cellpadding="5" cellspacing="5" border="1" class="OrderForm" width="100%">
                      <tbody>
                        <tr>
                          <th width="45%" height="25" align="left" style="padding-left:10px;">Product Name</th>
                          <th width="13%" style="text-align:right">Unit Price</th>
                          <th width="14%" style="text-align:center;">Qty</th>
                          <th width="15%" style="text-align:right">Subtotal</th>
                          <th width="13%" style="text-align:center;">Remove</th>
                        </tr>
                        
                        <?
						
						$gm=0;
            foreach($cart_view as $cart_view_val) 
            { ?>
                       <tr>
                          <td class="TextCenter">
            
                            <?                  
				  if($cart_view_val["product_image"]!="")
				  {
				  ?>
                            <img class="FloatLeft" src="<?php echo base_url().$cart_view_val["product_image"]?>"/>
                            <?
				  }
				  else
				  {
					  ?>
                            <img class="FloatLeft" src="<?php echo base_url()?>assets/frontend/images/no_image_icon.jpg" style="max-height:80px; max-width:110px;"/>
                            <?
				  }
				  ?>
                            <span style="float:left; margin-left:20px;"> <a class="link-hover" href="<?php echo base_url()?>products/<?php echo $cart_view_val['url_path']?>">
                            <?php echo $cart_view_val['product_name']?><br/>
                            </a></span><br/><br/>
                            
                          <span style="float:left; margin-left:20px;">
                          Collection Time: <?php echo date('d M Y H:i',strtotime($cart_view_val['collection_time']))?></span><br/><br/><?
						if($cart_view_val['message_on_cake']!="")
						{ ?>
							<span style="float:left; margin-left:20px;"><?php echo  'Message "'.$cart_view_val['message_on_cake'].'"<br/>';?></span>
					<?	}
						?>
                          </td>
                          <td align="right" valign="middle"><?php echo CURRENCY?>
                  <?php echo number_format($cart_view_val['qtyprice'],2);?>   </td>
                          
                          <td style="text-align:center;" valign="middle"><input type="text" class="form-control form-quntity-cart" value="<?php echo $cart_view_val["items"];?>" maxlength="2" size="2" name="txtitems<?php echo $cart_view_val["cart_id"];?>" id="txtitems<?php echo $cart_view_val["cart_id"];?>" onkeyup="return  Zero_not_enter(<?php echo $cart_view_val['cart_id']?>), update_items(<?php echo $cart_view_val["cart_id"]?>);" onkeypress="return numericOnly(this);"></td>
                          
                          <td align="right" valign="middle"><?php echo CURRENCY?> <?php echo number_format($cart_view_val['qtytotalprice'],2);?>
                          <? $gm=$gm+$cart_view_val["qtytotalprice"]; ?></td>
                          
                          <td align="center" valign="middle"><a name="removeItem136" style="cursor:pointer;" id="removeItem136"><img src="<?php echo base_url()?>assets/frontend/images/cart_delete.bmp" onclick="return deleteFunction(<?php echo $cart_view_val["cart_id"];?>);">
                            <input type="hidden" value="<?php echo $cart_view_val["cart_id"];?>" name="hid_del_id" id="hid_del_id<?php echo $cart_view_val["cart_id"];?>">
                            
                            </a></td>
                        </tr> 
                         <? 
						 	
						 } ?>
                        <tr>
                          <td align="right" colspan="3" class="CartTableFooter"> Total Price&nbsp; </td>
                          <td align="right" class="CartTableFooter"><?php echo CURRENCY?> <? echo number_format($gm,2); ?></td>
                          <td align="right" class="CartTableFooter">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <br>
                   
                    
                    <form name="frmcheckout" id="frmcheckout" method="post" action="<?php echo base_url(); ?>cart/cart_checkout">
                      <input type="button" value="Clear Cart" class="btn-default" name="removecart" id="removecart" onclick="return ClearCart();">
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="button" value="Continue Shopping" class="btn-default" name="continueshopping" id="continueshopping" onclick="ContinueShopping();">
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="submit" name="Submit" id="Submit"  class="btn-default" value="Checkout">
                    </form></td>
                </tr>
              </tbody>				
            </table>
            
            <?
	  }
	  else
	  {
		?>
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
                <td align="center" ><input type="submit" name="submitempty" class="btn-default" value="Continue Shopping"  onClick="ContinueShopping();"></td>
              </tr>
            </table>
            <?
	}
	?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
