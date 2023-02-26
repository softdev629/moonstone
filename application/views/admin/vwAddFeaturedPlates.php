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
                     <a href="<?php echo base_url(); ?>admin/featured-plates" style="float:right;"><i class="fa fa-backward" aria-hidden="true"></i>Back</a>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
            <div class="card-box">
                  <div class="table-rep-plugin">
                     <div class="">
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/featured-plates/add" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="name">Category<span class="required">*</span></label>
                                       <select required class="form-control" name="category_id" id="category_id" data-msg-required="Please select category.">
                                          <option value="">Select Category</option>
                                        <?php      
                                         foreach($categories as $nkey => $category_val)
                                         {
                                           echo '<option value='.$nkey.'>'.$category_val.'</option>';
                                         }
                                         ?>
                                       </select>
                                    </fieldset>
                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="name">Name<span class="required">*</span></label>
                                       <input type="text" name="name" class="form-control" id="name"
                                          placeholder="Enter Name" required="">
                                    </fieldset>
                              </div>
                              
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                    
                                    <fieldset class="form-group">
                                       <label for="plate_images">Image<span class="required">*</span></label>
                                       <input type="file" name="plate_images" class="form-control" id="plate_images" required>
                                    </fieldset>
                                    
                                    
                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                    
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
                            <a href="<?php echo base_url(); ?>admin/featured-plates" class="btn btn-primary">Cancel</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
