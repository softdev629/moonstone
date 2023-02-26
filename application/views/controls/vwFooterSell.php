<?php
$about_content=$this->content->get_static_page_by_id(7);
?>
<div class="bottom-feed-section">
<div class="bottom-footer-section">
<footer class="footer text-center">
   <div class="footer-top">
      <div class="row">
         <div class="col-md-3 col-sm-12 wow fadeInUp foot-intro" data-wow-delay="0.2s">
            <div class="f-about">
               <div class="f-about-logo"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/logo-black.svg"></div>
               <div class="f-about-cont"><?php echo $this->common->GetshortString($about_content->page_description,209);?></div>
               <a href="<?php echo base_url(); ?>about-us">Readmore</a>
            </div>
         </div>
         <div class="col-md-3 col-sm-12 r-line wow fadeInUp" data-wow-delay="0.3s">
            <div class="f-about-links">
               <h2>About Us</h2>
               <ul>
                  <li><a href="<?php echo base_url(); ?>buy">Buy</a></li>
                  <li><a href="<?php echo base_url(); ?>sell">Sell</a></li>
                  <li><a href="<?php echo base_url(); ?>help-services">help & Services</a></li>
                  <li><a href="<?php echo base_url(); ?>contactus">Contact us</a></li>
               </ul>
               <div class="cnda-logo" style="margin-top: 65px;margin-left: -25px;">
                 <a href="http://www.cnda.co.uk/" target="_blank">
                  <img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/cnda-logo.gif">
                 </a>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-12 r-line wow fadeInUp" data-wow-delay="0.4s">
            <div class="f-about-links">
               <h2>recent posts</h2>
               <div class="f-post-sec">
                  <div class="f-post">
                     <div class="f-post-left"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/fp1.png"></div>
                     <div class="f-post-right">
                        <div class="f-post-right-con">A Week Long South American Adventures</div>
                        <div class="f-post-right-time-sec"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/time-icon.png"> June 26. 2020</div>
                     </div>
                  </div>
                  <div class="f-post">
                     <div class="f-post-left"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/fp2.png"></div>
                     <div class="f-post-right">
                        <div class="f-post-right-con">A Week Long South American Adventures</div>
                        <div class="f-post-right-time-sec"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/time-icon.png"> June 26. 2020</div>
                     </div>
                  </div>
                  <div class="f-post bb-none">
                     <div class="f-post-left"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/fp3.png"></div>
                     <div class="f-post-right">
                        <div class="f-post-right-con">A Week Long South American Adventures</div>
                        <div class="f-post-right-time-sec"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/time-icon.png"> June 26. 2020</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-12 wow fadeInUp" data-wow-delay="0.5s">
            <div class="follow-us-sec">
               <h2>Follow us</h2>
               <div class="follow-us-sec-con">Don’t forgot to keep in touch by following us via social media.</div>
               <div class="follow-social-sec">
                  <a href="https://www.linkedin.com/company/moonstone-plates-ltd"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/l-icon.jpg" target="_blank"></a>
                  <a href="https://www.facebook.com/moonstoneplates" target="_blank"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/f-icon.png"></a>
                  <a href="https://www.instagram.com/moonstoneplates/" target="_blank"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/i-icon.jpg"></a>
                  <a href="https://vm.tiktok.com/ZMRnrK6Vp/" target="_blank"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/tik-tok.png"></a>
                  <!-- <a href="https://www.instagram.com/moonstoneplates/" target="_blank"><img src="<?php //echo HTTP_ASSETS_PATH_CLIENT; ?>images/g-p-icon.png"></a> -->
               </div>
               <div class="follow-subscribe-sec">
                  <div class="follow-subscribe-sec-title">Subscribe to our newsletter</div>
                  <div class="newslatter-process">&nbsp;</div> 
                  <div id="newslatter-msgquot">You have successfully registered with us.</div>
                  <form id="FormNewslatter" class="newslatter" name="FormNewslatter" action="#" method="POST" onsubmit="return chkNewslatter()">
                     <input name="texytEmail" id="textEmail" placeholder="Enter your email address"  type="text" class="form-control" onfocus="clearText(this.id,'','Please enter your email','form-control focus'); clearText(this.id,'','Please enter your valid email','form-control focus');" onblur="FillText(this.id,'','form-control');duplicate_email(this.value);">
                     <span class="error" id="lbl_user_email"></span>
                     <button class="subscribe" id="btn-submit">Subscribe</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="footer-bottom">
      <div class="row">
         <div class="col-md-12">
            <div class="copyright">Copyright© 2020 moonstoneplate. All rights reserved. </div>
            <div class="footer-link">
              <a href="<?php echo base_url(); ?>terms-condition">Terms  & conditions</a>  |  <a href="<?php echo base_url(); ?>privacy-policy">privacy policy</a>
            </div>
         </div>
      </div>
   </div>
</footer>
</div>
</div>
<div class="modal bd-example-modal-lg" id="numberModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <script type="text/javascript">
    $( document ).ready(function() {
      $('.simpleSocialShareSitesContainer').hide();
    });
  </script>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cherished plates</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<div class="modal login" id="poaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="text-center m-t-20">
            <a href="javascript:void(0);" class="logo" >
                <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/logo-black.svg" alt="logo">
            </a>
        </div>
        <div class="body_content">
       </div>
      </div>
    </div>
  </div>
</div>

<div class="modal bd-example-modal-lg" id="enquireModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <script type="text/javascript">
    $( document ).ready(function() {
      $('.simpleSocialShareSitesContainer').hide();
    });
  </script>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enquire for <span id="enquire_number"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="m-b-20">
              <form class="form-default m-t-20" action="<?php echo base_url(); ?>enquiry-check" id="enquiry-form">
                <input type="hidden" name="enquiry_plate_id" id="enquiry_plate_id">
                <input type="hidden" name="enquiry_plate_number" id="enquiry_plate_number">
                  <div class="form-group ">
                      <div class="col-xs-12">
                          <input class="form-control" type="text" name="subject" id="enquire_subject" required="" placeholder="Subject">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-xs-12">
                          <textarea class="form-control" name="enquire_message" id="enquire_message" placeholder="Message"></textarea>
                      </div>
                  </div>
                  <div class="form-group text-center m-t-30">
                      <div class="col-xs-12">
                          <input type="submit" name="submit" class="btn btn-styled btn-base-1" value="Send">
                      </div>
                  </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal bd-example-modal-lg" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <script type="text/javascript">
    $( document ).ready(function() {
      $('.simpleSocialShareSitesContainer').hide();
    });
  </script>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Offer for <span id="offer_number"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="m-b-20">
              <form class="form-default  m-t-20" action="<?php echo base_url(); ?>offer-check" id="offer-form">
                 <input type="hidden" name="offer_plate_id" id="offer_plate_id">
                <input type="hidden" name="offer_plate_number" id="offer_plate_number">
                  <div class="form-group ">
                      <div class="col-xs-12">
                          <input class="form-control" type="text" name="subject" id="offer_subject" required="" placeholder="Subject">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-xs-12">
                          <textarea class="form-control" name="offer_message" id="offer_message" placeholder="Message" required="required"></textarea>
                      </div>
                  </div>
                  <div class="form-group text-center m-t-30">
                      <div class="col-xs-12">
                          <input type="submit" name="submit" class="btn btn-styled btn-base-1" value="Send">
                      </div>
                  </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal login" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <script type="text/javascript">
    $( document ).ready(function() {
      $('.simpleSocialShareSitesContainer').hide();
    });
  </script>
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
        <div class="text-center m-t-20">
            <a href="index.html" class="logo">
                <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/logo-black.svg" alt="logo">
            </a>
        </div>
        <div class="m-t-30 m-b-20">
              <form class="form-default  m-t-20" action="<?php echo base_url(); ?>login-check" id="login-form">
                  <div class="form-group ">
                      <div class="col-xs-12">
                          <input class="form-control" type="text" name="email" id="email" required="" placeholder="Email">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-xs-12">
                          <input class="form-control" type="password" name="password" id="password" required="" placeholder="Password">
                      </div>
                  </div>
                  <div class="form-group text-center">
                      <div class="col-xs-12 m-btn">
            <input type="submit" name="submit" class="btn btn-styled black-btn" value="Log In">
                        <a href="" data-toggle="modal" data-target="#registerModal" class="btn btn-styled black-brd-btn">Sign up</a>
                        <a class="btn btn-styled grey-btn" data-dismiss="modal" aria-label="Close">Close</a>
                      </div>
                  </div>
                  <div class="form-group m-t-30 m-b-0">
                      <div class="col-sm-12 text-center">
                          <a href="" data-toggle="modal" data-target="#forgotModal" class="forgot-pass"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                      </div>
                  </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal addvertise" id="advertiseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
        <div class="text-center m-t-20">
            <a href="index.html" class="logo">
                <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/logo-black.svg" alt="logo">
            </a>
        </div>
        <div class="m-t-30 m-b-20" style="padding-left: 20px; padding-right: 20px;">
              <h2 class="l-title">Welcome to <strong>Moonstone</strong></h2>
        <span class="l-sub-title">Sign up for a Moonstone Plates Account</span>
              <div class="form-group text-center m-t-30">
                  <div class="col-xs-12 m-btn">
          <a data-toggle="modal" id="add_login_modal" class="btn btn-styled black-btn">Log In</a>
                    <a data-toggle="modal" id="add_sign_up_modal" class="btn btn-styled black-brd-btn">Sign up</a>
                    <!--<a data-toggle="modal" id="all_login_modal" style="color: white;margin-bottom: 10px;" class="btn btn-styled btn-base-1">Already have one</a>-->
                    
                    
                    <a data-toggle="modal" id="not_modal" aria-label="Close" class="forgot-pass">Not Now</a>
                  </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal register" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
  
  <!-- <div class="modal-header">
        <h5 class="modal-title" style="color: black; margin-top: 0; ">Sign Up</h5>
    
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     
      </div>-->
    
    
      <div class="modal-body">
       
        <div class="text-center m-t-20 m-b-20">
            <a href="index.html" class="logo">
                <img src="http://development.moonstoneplates.com/assets/images/logo-black.svg" alt="logo">
            </a>
        </div>
    
    <h2 class="l-title m-b-30"><strong>Signup</strong></h2>
    
        <div class="m-b-20">
              <form class="form-default" action="<?php echo base_url(); ?>user-register" id="register-form">
                  <div class="row">
                      <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="name" id="name" required="" placeholder="Name">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="lastname" id="lastname" required="" placeholder="Last name">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="phone_number" id="phone_number" required="" placeholder="Phone number">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="address" id="address" required="" placeholder="Address">
                      </div>
            <div class="col-md-6 mb-3">
                              <select class="form-control custome-control" name="country" id="country" required="">
                                  <option value="GB">United Kingdom</option>
                              </select>
                      </div>
            <div class="col-md-6 mb-3 ">
                          <input class="form-control" type="text" name="city" id="city" required="" placeholder="City">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="zip" id="zip" required="" placeholder="Postal code">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="email" name="email" id="email" required="" placeholder="Email">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="password" name="password" id="password" required="" placeholder="Password">
                      </div>
             <div class="col-md-6 mb-3">
                          <input class="form-control" type="password" name="confirm_password" id="confirm_password" required="" placeholder="Confirm password">
                      </div>
                  </div>
                   <div class="col-md-12 mb-3">
                        <input class="form-check-input" type="checkbox" id="is_marketing_enable" name="is_marketing_enable" value="2">
                        <label class="form-check-label" for="is_marketing_enable"><p>If you do not want to receive marketing emails & updates, please tick the opt out box.</p></label>

                   </div>
                
                  <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
              
                          <input type="submit" style="border-radius:0;" name="submit" class="btn btn-styled black-btn" value="Submit">
              
              <button type="button" style="border-radius:0;" class="btn btn-styled black-brd-btn"><a style="text-decoration: none; color: #000;" href="javascript:void(0);" data-dismiss="modal" aria-label="Close">Close</a></button>
                      </div>
                  </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal login" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        
        <div class="text-center m-t-20">
            <a href="index.html" class="logo">
                <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/logo-black.svg" alt="logo">
            </a>
        </div>
        <div class="m-t-30 m-b-20">
              <form class="form-default  m-t-20" action="<?php echo base_url(); ?>forgot-password" id="forgot-form">
                  <div class="form-group ">
                      <div class="col-xs-12">
                          <input class="form-control" type="text" name="email" id="email" required="" placeholder="Email">
                      </div>
                  </div>
                  <div class="form-group text-center m-t-20">
                      <div class="col-xs-12 m-btn">
                          <input type="submit" name="submit" class="btn btn-styled black-btn" value="Submit">
              <a class="btn btn-styled grey-btn" data-dismiss="modal" aria-label="Close">Close</a>
                      </div>
                  </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="cart-popup" tabindex="-1" role="dialog" aria-labelledby="CartModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Proceed to Checkout</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
         <div id="txtimg"></div>
         </div>
          <div class="modal-footer" id="add_cart_button">
            <a href="<?=base_url()?>buy" class="btn btn-styled btn-base-1">
               Continue Shopping
            </a>
           <a href="<?=base_url()?>cart" class="btn btn-styled btn-base-1">
            Continue To Checkout
           </a>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
    $('#login-form').submit(function () {
            var form = $("#login-form");
            if (form.valid())
            {
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    async: true,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: true,
                    enctype: 'multipart/form-data',
                    success: function (result)
                    { console.log('status',result['status']);
                        if (result.status == 1)
                        {
                            $.bootstrapGrowl(result.msg, {type: 'success', delay: 4000});
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                        else
                        {
                            $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                        }
                    },
                    error: function (error)
                    {
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        $.bootstrapGrowl("Internal server error !", {type: 'danger', delay: 4000});
                    }
                });
            }
            return false;
    });
});
$('#faqSearch').focus(function() {
    //var div = $('.search-dropdown').fadeIn('fast');
    $(document).bind('focusin.search-dropdown click.search-dropdown',function(e) {
        if ($(e.target).closest('.search-dropdown, #faqSearch').length) return;
        $(document).unbind('.search-dropdown');
        $('.search-dropdown').fadeOut('fast');
    });
});

$("#faqSearch").on("keyup", function() {
    //$('.insurer_list strong').hide();
    var div = $('.search-dropdown').fadeIn('fast');
    var value = $(this).val().toLowerCase();
    if(value==""){
        $('.search-dropdown').fadeOut('fast');
    }
    $(".search-dropdown li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});
</script>
</body>
</html>
