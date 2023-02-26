<?php
    $base_url=base_url();
?>
<div class="content-page">
   <div class="content">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title-box">
                  <h4 class="page-title">Add <?php echo$page;?></h4>
                  <div class="add-page">
                     <a href="<?php echo base_url(); ?>admin/adminusers" style="float:right;"><i class="fa fa-backward" aria-hidden="true" style="margin-right: 4px;"></i>Back</a>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <div class="row">
          <div class="col-xs-12 col-lg-12 col-xl-12">
            <?php if ($this->session->flashdata('error')) { ?>
              <div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p><?php echo $this->session->flashdata('error'); ?></p>
              </div>
            <?php } ?>
            </div>
            <div class="col-xs-12 col-lg-12 col-xl-12">
            <div class="card-box">
                  <div class="table-rep-plugin">
                     <div class="">
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/adminuser/add" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                                    <fieldset class="form-group">
                                       <label for="firstname">First Name<span class="required">*</span></label>
                                       <input type="text" name="firstname" class="form-control" id="firstname"
                                          placeholder="Enter First Name" required="">
                                    </fieldset>
                              </div>
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                                    <fieldset class="form-group">
                                       <label for="lastname">Last Name<span class="required">*</span></label>
                                       <input type="text" name="lastname" class="form-control" id="lastname"
                                          placeholder="Enter Last Name" required="">
                                    </fieldset>
                              </div>
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                                    <fieldset class="form-group">
                                       <label for="email">Email<span class="required">*</span></label>
                                       <input type="email" name="email" class="form-control" id="email"
                                          placeholder="Enter email" required="">
                                    </fieldset>
                              </div>
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                                    <fieldset class="form-group">
                                       <label for="username">Username<span class="required">*</span></label>
                                       <input type="text" name="username" class="form-control" id="username"
                                          placeholder="Enter username" required="">
                                    </fieldset>
                              </div>
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                                    <fieldset class="form-group">
                                       <label for="password">Password<span class="required">*</span></label>
                                       <input type="password" name="password" class="form-control" id="password"
                                          placeholder="Enter password" required="">
                                    </fieldset>
                              </div>
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                                    
                                    <fieldset class="form-group">
                                       <label class="status1">Status<span class="required">*</span></label>
                                       <div class="">
                                          <div class="radio">
                                             <input type="radio" name="status" id="status1" value="1" checked>
                                             <label for="status1">
                                             Active
                                             </label>
                                          </div>
                                          <div class="radio">
                                             <input type="radio" name="status" id="status2" value="2">
                                             <label for="radio2">
                                             Inactive
                                             </label>
                                          </div>
                                       </div>
                                    </fieldset>
                              </div>
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                                    
                                    <fieldset class="form-group">
                                       <label class="status1">User type<span class="required">*</span></label>
                                       <div class="">
                                          <div class="radio">
                                             <input type="radio" name="user_type" id="type1" value="1" checked>
                                             <label for="type1">
                                             Super Admin
                                             </label>
                                          </div>
                                          <div class="radio">
                                             <input type="radio" name="user_type" id="type2" value="2">
                                             <label for="type2">
                                             Admin
                                             </label>
                                          </div>
                                       </div>
                                    </fieldset>
                              </div>

                           </div>

                            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-primary">Save</button>
                            <a href="<?php echo base_url(); ?>admin/adminusers" class="btn btn-primary">Cancel</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    setTimeout(function() {
      $(".alert-success").hide();
      $(".alert-success p").text('');
      $(".alert-danger").hide();
      $(".alert-danger p").text('');      
    }, 3500);
  });
</script>