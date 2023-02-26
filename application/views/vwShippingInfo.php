<section class="slice-xs sct-color-2 border-bottom cart-head-container">
<div class="container">
    <div class="row cols-delimited">
        <div class="col-3">
            <div class="icon-block icon-block--style-1-v5 text-center active">
                <div class="block-icon mb-0">
                    <i class="icon-user"></i>
                </div>
                <div class="block-content d-none d-md-block">
                    <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. Shopping bag</h3>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="icon-block icon-block--style-1-v5 text-center">
                <div class="block-icon mb-0">
                    <i class="icon-finance-067"></i>
                </div>
                <div class="block-content d-none d-md-block">
                    <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. Customer info</h3>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="icon-block icon-block--style-1-v5 text-center">
                <div class="block-icon  mb-0">
                    <i class="icon-finance-018"></i>
                </div>
                <div class="block-content d-none d-md-block">
                    <h3 class="heading heading-sm strong-300 c-active text-capitalize">2. Shipping info</h3>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="icon-block icon-block--style-1-v5 text-center">
                <div class="block-icon c-gray-light mb-0">
                    <i class="icon-finance-059"></i>
                </div>
                <div class="block-content d-none d-md-block">
                    <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. Payment method</h3>
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
            <div style="width:94%">
                    <form class="form-default mt-4"  data-toggle="validator" role="form">
                        <h3 class="heading heading-3 strong-400 mb-4">Shipping information</h3>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">First name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Last name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Select your country</label>
                                            <select class="form-control custome-control" data-live-search="true">
                                                <option value="US">United States</option>
                                                <option value="CA">Canada</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">City</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Postal code</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">Phone</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center pt-2">
                            <div class="col-md-6">
                                <a href="<?php base_url(); ?>customerinformation" class="link link--style-3">
                                    <i class="ion-android-arrow-back"></i>
                                    Return to shop
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="<?php base_url(); ?>payment" class="btn btn-styled btn-base-1">Continue to payment</a>
                                
                            </div>
                        </div>
                    </form>
                </div>
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