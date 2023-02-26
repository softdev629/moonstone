<?php
    $base_url=base_url();
?>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/ckeditor.js"></script>
<div class="content-page">
   <div class="content">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title-box">
                  <h4 class="page-title">Edit <?php echo$page;?></h4>
                  <div class="add-page">
                     <a href="<?php echo base_url(); ?>admin/home-content/edit/<?php echo $content_page->id;?>" style="float:right;"><i class="fa fa-backward" aria-hidden="true"></i>Back</a>
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
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/home-content/edit/<?php echo $content_page->id;?>" enctype="multipart/form-data">
                           <div class="row">
                              
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="special_content">Special Content<span class="required">*</span></label>
                                       <textarea name="special_content" class="form-control" id="special_content"
                                          rows="3" required><?php if(isset($_POST["special_content"])){ echo $_POST["special_content"];}else{ echo $content_page->special_content;}?></textarea>
                                 </fieldset>

                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="discount_content">Discount Content<span class="required">*</span></label>
                                       <textarea name="discount_content" class="form-control" id="discount_content"
                                          rows="3" required><?php if(isset($_POST["discount_content"])){ echo $_POST["discount_content"];}else{ echo $content_page->discount_content;}?></textarea>
                                 </fieldset>
                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="star_content">Star Content<span class="required">*</span></label>
                                       <textarea name="star_content" class="form-control" id="star_content"
                                          rows="3" required><?php if(isset($_POST["star_content"])){ echo $_POST["star_content"];}else{ echo $content_page->star_content;}?></textarea>
                                 </fieldset>
                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="left_box_content">Left Box Content<span class="required">*</span></label>
                                       <textarea name="left_box_content" class="form-control" id="left_box_content"
                                          rows="3" required><?php if(isset($_POST["left_box_content"])){ echo $_POST["left_box_content"];}else{ echo $content_page->left_box_content;}?></textarea>
                                 </fieldset>
                              </div>

                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="page_description">Center Box Content<span class="required">*</span></label>
                                       <textarea name="center_box_content" class="form-control" id="center_box_content"
                                          rows="3" required><?php if(isset($_POST["center_box_content"])){ echo $_POST["center_box_content"];}else{ echo $content_page->center_box_content;}?></textarea>
                                 </fieldset>
                              </div>

                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="page_description">Right Box Content<span class="required">*</span></label>
                                       <textarea name="right_box_content" class="form-control" id="right_box_content"
                                          rows="3" required><?php if(isset($_POST["right_box_content"])){ echo $_POST["right_box_content"];}else{ echo $content_page->right_box_content;}?></textarea>
                                 </fieldset>
                              </div>

                              
                           </div>

                            <button type="submit" name="Submit" value="Update" id="Submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo base_url(); ?>admin/home-content/edit/<?php echo $content_page->id;?>" class="btn btn-primary">Cancel</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
