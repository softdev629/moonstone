<div class="content-page">
   <div class="content">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title-box">
                  <h4 class="page-title">Dashboard </h4>
                  <div class="clearfix">
                     <div class="refresh-icon" style="text-align:right;padding-right: 10px;font-size: 25px;">
                        <a href="<?php echo base_url(); ?>admin/dashboard" title="Refresh Dashboard"><i class="icon-refresh pull-xs-right text-muted"></i></a>

                     </div>
                  </div>

               </div>
            </div>
         </div>
         <!-- end row -->
         <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/users" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-user pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-success">
                     <?php
                     echo $this->common->CountByTable("user","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Registered Users</h3>                  
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/featured-plates" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-success">
                     <?php
                        echo $this->common->CountByTable("featured_plates","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Featured Plates</h3>                 
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/package" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-success">
                     <?php
                        echo $this->common->CountByTable("package","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Packages</h3>                 
               </div>
               </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/package-inquiries" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-danger">
                     <?php
                     echo $this->common->CountByTable("package_inquiry","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Package Inquiries</h3>                  
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/faqs" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-danger">
                     <?php
                     echo $this->common->CountByTable("faqs","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">FAQs</h3>                  
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/sell-register" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-user pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-danger">
                     <?php
                     echo $this->common->CountByTable("seller_register","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Sell Register</h3>                  
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/orders" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-warning">
                     <?php
                     echo $this->common->CountByTable("order","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Orders</h3>
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/inquiries" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-warning">
                     <?php
                        echo $this->common->CountByTable("inquiries","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Enquiries</h3>                 
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/plate-offers" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-warning">
                     <?php
                        $where = "where type=1";
                        echo $this->common->CountByTable("plate_enquiry",$where);
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Plate Offers</h3>                                 
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/plates-inquiries" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-success">
                     <?php
                        $where = "where type=2";
                        echo $this->common->CountByTable("plate_enquiry",$where);
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Plate Inquiries</h3>                                 
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/newslettersubscription" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-success">
                     <?php
                        echo $this->common->CountByTable("newsletter_subscription","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Newsletter Subscriber</h3>
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/favourite" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-success">
                     <?php
                        $where = "where is_number_favourite='1'";
                        echo $this->common->CountByTable("favourite",$where);
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Favourite Plates</h3>
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/users/plate_list" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-danger">
                     <?php
                        $where = "where private = '1' and status != '3'";
                        echo $this->common->CountByTable("cherished_plates",$where);
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">Private Plates</h3>                 
               </div>
               </a>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
               <a href="<?php echo base_url(); ?>admin/poa-inquiries" style="color:#2b3d51;">
               <div class="card-box tilebox-one">
                  <i class="icon-layers pull-xs-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">
                     <span class="label label-danger">
                     <?php
                        echo $this->common->CountByTable("poa_enquiry","");
                     ?>
                     </span>
                  </h6>
                  <h3 class="m-b-20">POA Inquiries</h3>                 
               </div>
               </a>
            </div>
            
            
            
            
         </div>
         <div class="row">
            
            
            
            
         </div>
      </div>
   </div>
</div>