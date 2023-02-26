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
                     <a href="<?php echo base_url(); ?>admin/settings/edit/1" style="float:right;"><i class="fa fa-backward" aria-hidden="true"></i>Back</a>
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
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/settings/edit/<?php echo $content_page->id;?>" enctype="multipart/form-data">
                           <div class="row">
                              
                              
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="mark_up">Mark up<span class="required">*</span></label>
                                       <input type="number" name="mark_up" class="form-control" id="mark_up"
                                          rows="3"   value="<?php if(isset($_POST["mark_up"])){ echo $_POST["mark_up"];}else{ echo $content_page->mark_up;}?>" /> 
                                 </fieldset>
                              </div>
                    
                           </div>

                            <button type="submit" name="Submit" value="Update" id="Submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo base_url(); ?>admin/settings/edit/<?php echo $content_page->id;?>" class="btn btn-primary">Cancel</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
