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
                     <a href="<?php echo base_url(); ?>admin/users/plate_list" style="float:right;"><i class="fa fa-backward" aria-hidden="true" style="margin-right: 4px;"></i>Back</a>
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
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/users/add_plate" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="name">Company<span class="required">*</span></label>
                                       <select required class="form-control" name="company_id" id="company_id" data-msg-required="Please select company.">
                                          <option value="">Select Company</option>
                                        <?php      
                                         foreach($company_list as $ckey => $company_val)
                                         {
                                           echo '<option value='.$ckey.'>'.$company_val.'</option>';
                                         }
                                         ?>
                                       </select>
                                    </fieldset>
                              </div>
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                                    <fieldset class="form-group">
                                       <label for="name">Number<span class="required">*</span></label>
                                       <input type="text" name="number" class="form-control" id="number"placeholder="Number" required="">
                                    </fieldset>
                              </div>
                              <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
                                    <fieldset class="form-group">
                                       <label for="lastname">Price<span class="required">*</span></label>
                                       <input type="text" name="price" class="form-control" id="price"placeholder="Price" required="">
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

                              <div class="col-lg-4 col-sm-4 col-xs-4 col-md-4 col-xl-4">
                                    
                                    <fieldset class="form-group">
                                       <label class="apply_vat1">Apply VAT<span class="required">*</span></label>
                                       <div class="">
                                          <div class="radio">
                                             <input type="radio" name="apply_vat" id="apply_vat1" value="1">
                                             <label for="apply_vat1" >
                                             Yes
                                             </label>
                                          </div>
                                          <div class="radio">
                                             <input type="radio" name="apply_vat" id="apply_vat2" value="0" checked >
                                             <label for="apply_vat2">
                                             No
                                             </label>
                                          </div>
                                          
                                       </div>
                                    </fieldset>
                              </div>

                              <div class="col-lg-4 col-sm-4 col-xs-4 col-md-4 col-xl-4">
                                    <?php
                                          $apply_poa_yes="";
                                          $apply_poa_no="checked";
                                    ?>
                                    <fieldset class="form-group">
                                       <label class="apply_poa1">Apply POA<span class="required">*</span></label>
                                       <div class="">
                                          <div class="radio">
                                             <input type="radio" name="apply_poa" id="apply_poa1" value="1" <?php echo $apply_poa_yes;?>>
                                             <label for="apply_poa1" >
                                             Yes
                                             </label>
                                          </div>
                                          <div class="radio">
                                             <input type="radio" name="apply_poa" id="apply_poa2" value="0" <?php echo $apply_poa_no;?>>
                                             <label for="apply_poa2">
                                             No
                                             </label>
                                          </div>
                                          
                                       </div>
                                    </fieldset>
                              </div>

                           </div>

                            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-primary">Save</button>
                            <a href="<?php echo base_url(); ?>admin/users/plate_list" class="btn btn-primary">Cancel</a>
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