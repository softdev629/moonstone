<section class="slice-xs sct-color-2 border-bottom cart-head-container">
    <div class="container">
        <div class="row cols-delimited">
            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center">
                    <div class="block-icon mb-0">
                        <i class="icon-user"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. Order details</h3>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center active">
                    <div class="block-icon mb-0">
                        <i class="icon-finance-067"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-active text-capitalize">2. Purchaser Details</h3>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center">
                    <div class="block-icon  mb-0">
                        <i class="icon-finance-018"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. Confirm And Pay</h3>
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

                <div style="width:100%">
                    <form  name="frmcheckout" class="form-default" method="post"  action="<?php echo base_url(); ?>checkout" enctype="multipart/form-data">
                        <h3 class="heading heading-3 strong-400 mb-4">Purchaser Details</h3>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Full name</label>
                                            <input type="text" name="name" id="name" class="form-control" required="" value="<?php if(isset($client_details["name"])){ echo $client_details["name"];}?>">
                                        </div>
                                    </div>
                                    <?php if($is_client_login==1){ ?>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" disabled="" name="email" id="email" class="form-control" required="" value="<?php echo $client_details['email'] ?>">
                                        </div>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" required="">
                                        </div>
                                        </div>
                                    <?php } ?>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <input type="text" name="address" id="address" class="form-control" required="" value="<?php if(isset($client_details["address"])){ echo $client_details["address"];}?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Select your country</label>
                                            <select class="form-control custome-control" name="country" id="country" required="">
                                                <option value="GB">United Kingdom</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">City</label>
                                            <input type="text" name="city" id="city" class="form-control" required="" value="<?php if(isset($client_details["city"])){ echo $client_details["city"];}?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Postal code</label>
                                            <input type="text" name="zip" id="zip" class="form-control" required="" value="<?php if(isset($client_details["zip"])){ echo $client_details["zip"];}?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Phone</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" required="" value="<?php if(isset($client_details["phone_number"])){ echo $client_details["phone_number"];}?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center pt-2">
                            <div class="col-md-6">
                                <a href="<?php base_url(); ?>cart" class="link link--style-3">
                                    <i class="ion-android-arrow-back"></i>
                                    Return to shop
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <input name="submit" type="submit" class="btn btn-styled btn-base-1" id="Submit" value="Continue to payment" />
                            </div>
                        </div>
                    </form>
                </div>


            </div>

            
        </div>
    </div>
</section>