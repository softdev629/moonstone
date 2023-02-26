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
                     <a href="<?php echo base_url(); ?>admin/content" style="float:right;"><i class="fa fa-backward" aria-hidden="true"></i>Back</a>
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
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/content/edit/<?php echo $content_page->content_id;?>" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="page_name">Page Name<span class="required">*</span></label>
                                       <input type="text" name="page_name" class="form-control" id="page_name"
                                          placeholder="Enter Name" required="" value="<?php if(isset($_POST["page_name"])){ echo $_POST["page_name"];}else{ echo $content_page->page_name;}?>">
                                    </fieldset>
                              </div>
                              
                              
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="page_description">Description<span class="required">*</span></label>
                                       <textarea name="page_description" class="form-control" id="page_description"
                                          rows="3" required><?php if(isset($_POST["page_description"])){ echo $_POST["page_description"];}else{ echo $content_page->page_description;}?></textarea>
                                 </fieldset>

                              </div>

                              
                           </div>

                            <button type="submit" name="Submit" value="Update" id="Submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo base_url(); ?>admin/content" class="btn btn-primary">Cancel</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
