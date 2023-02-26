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
                     <a href="<?php echo base_url(); ?>admin/users/company_list" style="float:right;"><i class="fa fa-backward" aria-hidden="true" style="margin-right: 4px;"></i>Back</a>
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
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/users/add_company" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="name">Company Name<span class="required">*</span></label>
                                       <input type="text" name="name" class="form-control" id="name" placeholder="Company Name" required="">
                                    </fieldset>
                              </div>
                              
                              <div class="col-lg-4 col-sm-4 col-xs-4 col-md-4 col-xl-4">
                                    
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

                           </div>

                            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-primary">Save</button>
                            <a href="<?php echo base_url(); ?>admin/users/company_list" class="btn btn-primary">Cancel</a>
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