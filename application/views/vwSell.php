<style>
.s-t-r-title, .s-t-r-con{color:#ffffff;}
.tab2 {
  display: none;
}
</style>

<div id="fsvs-body" class="typography">

    <div class="msslide ms-sell-slide1-bg ms-slide">

      <div class="ms-slide-main set-wrapper px-6 px-md-0">

        <h1 class="text-center text-uppercase h2 mb-2">Sell your plates</h1>

        <p class="text-center mb-3">When Moonstone values your private Number plate we look at a number of key elements to determine a fair price.</p>

        <div class="text-center">

          <a href="<?php echo base_url(); ?>sell#secondPage" class="button">Request Quotation</a>

        </div>

      </div>

      <div class="ms-slide-footer">

        <div class="container-fluid wrapper">

          <div class="responsive text-center">

            <div>
              <div class="px-2">
                <h3>WE BUY DIRECT</h3>
                <p>We buy dateless registration for our stock.</p>
              </div>
            </div>

            <div>
              <div class="px-2">
                <h3>QUICK AND SIMPLE</h3>
                <p>We have an easy process in place, which allows you to have no hassle when it comes to selling your private registration with us.</p>
              </div>
            </div>

            <div>
              <div class="px-2">
                <h3>GREAT VALUE</h3>
                <p>Our extensive knowledge means you’ll always get a fair price.</p>
              </div>
            </div>

          </div>

        </div>

      </div>

    </div>
    <div class="msslide ms-sell-slide2-bg ms-slide" id="secondPage">

      <div class="ms-slide-main set-wrapper px-6">



        <h2 class="text-uppercase text-center">Request your quotation</h2>

        <p class="text-center mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
          commodo consequat.</p>

        <!--div class="text-center mb-3 hide-for-md-up"><a href="sell-form.html" class="button">Request Quotation</a></div-->

        <div class="quotation-form-container">
          <!-- <div id="sell-msgquot">Your details have been sent successfully</div> -->
          <form id="quotation" class="py-3 px-2" action="javascript:void(0);" method="POST" onsubmit="return chkSellRegister()" autocomplete="off">

            <div class="container-fluid wrapper">

              <!-- <div class="row"> -->

               <div class="row tab1">
                <div class="col-xs-12 col-md-6">

                  <div class="ffield">
                    <label for="first_name">First Name *<label>
                        <input id="FirstName" type="text" autocomplete="given-name" onfocus="clearText(this.id,'','Please enter your first name','form-control focus');" onblur="FillText(this.id,'','form-control');" placeholder="Enter your first name" name="FirstName" required />
                  </div>

                </div>

                <div class="col-xs-12 col-md-6">

                  <div class="ffield">
                    <label for="last_name">Last Name *</label>
                    <input id="LastName" type="text" autocomplete="family-name" onfocus="clearText(this.id,'','Please enter your last name','form-control focus');" onblur="FillText(this.id,'','form-control');" placeholder="Enter your last name" name="LastName" required />
                  </div>

                </div>
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">

                  <div class="ffield registration pt-2">
                    <label for="registration">Your registration *</label>
                    <input id="Numberplate" type="text" onfocus="clearText(this.id,'','Please enter your registeration','form-control focus');" onblur="FillText(this.id,'','form-control');" placeholder="ENTER REG" name="Numberplate" required />
                  </div>

                </div>
               </div>
               
               <div class="row tab2">
                  <div class="col-xs-12 col-md-6">

                     <div class="ffield">
                     <label for="marketing_source">Where did you hear about us?</label>
                     <input id="marketing_source" type="text" placeholder="Where did you hear about us?" name="last-name" />
                     </div>

                  </div>

                  <div class="col-xs-12 col-md-6">

                     <div class="ffield">
                     <label for="phone_number">Phone Number *</label>
                     <input id="EnquiryPhoneNumber" type="text" autocomplete="tel" placeholder="Enter your phone number" name="EnquiryPhoneNumber" required />
                     </div>

                  </div>

                  <div class="col-xs-12 col-md-6">

                     <div class="ffield">
                     <label for="email_address">Email *</label>
                     <input id="EnquiryEmail" type="text" autocomplete="email" placeholder="Enter your email address" name="EnquiryEmail" required />
                     </div>

                  </div>

                  <div class="col-xs-12 col-md-6">
                     <div class="ffield">
                     <label for="notes">Notes</label>
                     <input id="Addnote" type="text" placeholder="Any additional notes" name="Addnote" />
                     </div>
                  </div>

               </div>

              <!-- </div> -->

              <button class="submit-button" type="button" id="nextBtn" onclick="nextPrev()">Next</button>

            </div>

          </form>

        </div>

      </div>



    </div>
    <div class="msslide ms-sell-slide3-bg ms-slide">

      <div class="ms-slide-main set-wrapper px-6">

        <h2 class="text-uppercase text-center mb-1">We look forward to partnering with you</h2>

        <p class="text-center mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
          commodo consequat.</p>

      </div>

<script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/fullpage.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/tab.js"></script>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/sell-page.js?ver=11111" type="text/javascript"></script>
<script type="text/javascript">
    var myFullpage = new fullpage('#fullpage', {
        anchors: ['firstPage', 'secondPage', '3rdPage'],
        sectionsColor: ['#ffffff', '#000000', '#ffffff'],
        navigation: true,
        navigationPosition: 'right',
        navigationTooltips: ['First page', 'Second page', 'Third and last page'],
        responsiveWidth: 900,
        afterResponsive: function(isResponsive){

        }

    });
</script>