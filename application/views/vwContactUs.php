<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/contact-us.js" type="text/javascript"></script>
<div class="page typography py-5 page-bg-image ms-contact-bg">

    <div class="container-fluid wrapper">

      <h2 class="text-uppercase text-center mb-2">Contact Us</h2>

      <p class="text-center mb-4">For general enquiries or for more information. Please contact us using the form below.</p>

      <div class="quotation-form-container p-3">

         <form id="GetContact" class="app-search mb-10 contact-form" name="GetContact" action="#" method="POST" onsubmit="return chkContactUs()" autocomplete="off">

          <div class="row">

            <div class="col-xs-12 col-md-6">

              <div class="ffield">
                <label for="first_name">First Name *<label>
                <input id="FirstName" type="text" autocomplete="given-name" placeholder="Enter your first name" name="FirstName" onfocus="clearText(this.id,'','Please enter your name','form-control focus');" onblur="FillText(this.id,'','form-control');" required />
              </div>

            </div>

            <div class="col-xs-12 col-md-6">

              <div class="ffield">
                <label for="last_name">Last Name *</label>
                <input id="LastName" type="text" autocomplete="family-name" placeholder="Enter your last name" name="LastName" onfocus="clearText(this.id,'','Please enter your name','form-control focus');" onblur="FillText(this.id,'','form-control');" required />
              </div>

            </div>

            <div class="col-xs-12 col-md-6">

              <div class="ffield">
                <label for="phone_number">Contact Number *</label>
                <input id="EnquiryPhoneNumber" type="text" autocomplete="Contact Number" placeholder="Enter your phone number" name="EnquiryPhoneNumber" onfocus="clearText(this.id,'','Please enter your email','form-control focus'); clearText(this.id,'','Please enter your valid email','form-control focus');" onblur="FillText(this.id,'','form-control');" required />
              </div>

            </div>

            <div class="col-xs-12 col-md-6">

              <div class="ffield">
                <label for="email_address">Email *</label>
                <input id="EnquiryEmail" type="text" autocomplete="email" placeholder="Enter your email address" name="EnquiryEmail" onfocus="clearText(this.id,'','Please enter your email','form-control focus'); clearText(this.id,'','Please enter your valid email','form-control focus');" onblur="FillText(this.id,'','form-control');" required />
              </div>

            </div>

            <div class="col-xs-12">

              <div class="ffield">

                <textarea type="text" placeholder="Your enquiry..." name="EnquiryMessage" id="EnquiryMessage" onfocus="clearText(this.id,'','Please enter your message','form-control focus');" onblur="FillText(this.id,'','form-control');" /></textarea>
              </div>

            </div>

            <!--div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">

                        <div class="ffield registration">
                          <label for="registration">Your registration *</label>
                          <input id="registration" type="text" placeholder="ENTR REG" name="registration" required />
                        </div>

                      </div-->



          </div>

          <button class="submit-button" type="submit">Submit</button>

        </form>

      </div>

    </div>

  </div>