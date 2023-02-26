<?php
    $base_url=base_url();
?>
<div class="content-page">
   <div class="content">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title-box">
                  <h4 class="page-title">Edit <?php echo$page;?></h4>
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
               <?php
                $this->load->view('admin/controls/vwMessage');
               ?>
                  <div class="table-rep-plugin">
                     <div class="">
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/featured-plates/edit/<?php echo $featured_plates->id;?>" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="name">Category<span class="required">*</span></label>
                                       <select required class="form-control" name="category_id" id="category_id" data-msg-required="Please select category.">
                                          <option value="">Select Category</option>
                                        <?php      
                                         foreach($categories as $nkey => $category_val)
                                         {
                                             $select_cat="";
                                             if($featured_plates->category_id==$nkey){
                                                $select_cat="selected";
                                             }
                                           echo '<option value='.$nkey.' '.$select_cat.'>'.$category_val.'</option>';
                                         }
                                         ?>
                                       </select>
                                    </fieldset>
                              </div>
                              
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="name">Name<span class="required">*</span></label>
                                       <input type="text" name="name" class="form-control" id="name"
                                          placeholder="Enter Name" required="" value="<?php if(isset($_POST["name"])){ echo $_POST["name"];}else{ echo $featured_plates->name;}?>">
                                    </fieldset>
                              </div>
                              
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                    
                                    <fieldset class="form-group">
                                       <label for="plate_images">Image<span class="required">*</span></label>
                                       <input type="file" name="plate_images" class="form-control" id="plate_images">
                                    </fieldset>
                                    <?php
                                    if($featured_plates->images_path!=""){
                                    ?>
                                       <div class="" >
                                       <img src="<?php echo $base_url; ?>\assets\uploads\featured_plates\<?php echo $featured_plates->images_path; ?>" style="width: 100px; margin-bottom: 10px;">
                                       </div>
                                    <?php
                                    }
                                    ?>
                                    
                              </div>
                              
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                    <?php
                                          $active="checked";
                                          $inactive="";
                                          $archive="";
                                          if($featured_plates->status==2){
                                             $inactive="checked";
                                             $active="";
                                             $archive="";
                                          }
                                          
                                    ?>
                                    <fieldset class="form-group">
                                       <label class="status1">Status<span class="required">*</span></label>
                                       <div class="">
                                          <div class="radio">
                                             <input type="radio" name="status" id="status1" value="1" <?php echo $active;?>>
                                             <label for="status1" >
                                             Active
                                             </label>
                                          </div>
                                          <div class="radio">
                                             <input type="radio" name="status" id="status2" value="2" <?php echo $inactive;?>>
                                             <label for="status2">
                                             Inactive
                                             </label>
                                          </div>
                                          
                                       </div>
                                    </fieldset>
                              </div>
                           </div>
                            <button type="submit" name="Submit" value="Update" id="Submit" class="btn btn-primary">Update</button>
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
