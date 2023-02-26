<?php
    $base_url=base_url();
?>
<script src="<?php echo $base_url; ?>assets/js/add_article.js"></script>
<div class="content-page">
   <div class="content">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <?php
                $this->load->view('admin/controls/vwMessage');
               ?>
               <div class="page-title-box">
                  <h4 class="page-title"><?php echo$page;?></h4>
                  <div class="add-page">
                     <a href="<?php echo base_url(); ?>admin/faqs" style="float:right;"><i class="fa fa-backward" aria-hidden="true"></i>Back</a>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
               <!-- Display status message -->
             <?php if(!empty($success_msg)){ ?>
             <div class="col-xs-12">
                 <div class="alert alert-success"><?php echo $success_msg; ?></div>
             </div>
          <?php } ?>
             <?php if(!empty($error_msg)){ ?>
             <div class="col-xs-12">
                 <div class="alert alert-danger"><?php echo $error_msg; ?></div>
             </div>
             <?php } ?>
            <div class="card-box">
                  <div class="table-rep-plugin">
                     <div class="">
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/importcsv" enctype="multipart/form-data">
                           <div class="row">
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="name">CSV File<span class="required">*</span></label>
                                       <input type="file" name="csv_file" class="form-control" required="" id="csv_file" />
                                    </fieldset>
                              </div>
                           </div>

                            <button type="submit" name="Submit" value="Save" id="Submit" class="btn btn-primary">Save</button>
                            <a href="<?php echo base_url(); ?>admin/" class="btn btn-primary">Cancel</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
