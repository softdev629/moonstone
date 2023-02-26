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
                     <a href="<?php echo base_url(); ?>admin/email-settings/edit/<?php echo $content_page->id;?>" style="float:right;"><i class="fa fa-backward" aria-hidden="true"></i>Back</a>
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
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/email-settings/edit/<?php echo $content_page->id;?>" enctype="multipart/form-data">
                           <div class="row">
                              
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="enquiries_mail">Enquiries Mail<span class="required">*</span></label>
                                       <input type="email" id="enquiries_mail" name="enquiries_mail" class="form-control" value="<?php if(isset($_POST["enquiries_mail"])){ echo $_POST["enquiries_mail"];}else{ echo $content_page->enquiries_mail;}?>">
                                 </fieldset>

                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="contact_mail">Contact Mail<span class="required">*</span></label>
                                       <input type="email" id="contact_mail" name="contact_mail" class="form-control" value="<?php if(isset($_POST["contact_mail"])){ echo $_POST["contact_mail"];}else{ echo $content_page->contact_mail;}?>">                                       
                                 </fieldset>
                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="buy_mail">Buy mail<span class="required">*</span></label>
                                       <input type="email" id="buy_mail" name="buy_mail" class="form-control" value="<?php if(isset($_POST["buy_mail"])){ echo $_POST["buy_mail"];}else{ echo $content_page->buy_mail;}?>">                                       
                                 </fieldset>
                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="offer_mail">Offer Mail<span class="required">*</span></label>
                                       <input type="email" id="offer_mail" name="offer_mail" class="form-control" value="<?php if(isset($_POST["offer_mail"])){ echo $_POST["offer_mail"];}else{ echo $content_page->offer_mail;}?>">
                                       
                                 </fieldset>
                              </div>

                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="enquire_mail">Sell Register Mail<span class="required">*</span></label>
                                       <input type="email" id="enquire_mail" name="enquire_mail" class="form-control" value="<?php if(isset($_POST["enquire_mail"])){ echo $_POST["enquire_mail"];}else{ echo $content_page->enquire_mail;}?>">                                       
                                 </fieldset>
                              </div>

                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="favourites_mail">Favourites Mail<span class="required">*</span></label>
                                       <input type="email" id="favourites_mail" name="favourites_mail" class="form-control" value="<?php if(isset($_POST["favourites_mail"])){ echo $_POST["favourites_mail"];}else{ echo $content_page->favourites_mail;}?>">
                                      
                                 </fieldset>
                              </div>

                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                 <fieldset class="form-group">
                                       <label for="order_success_mail">Order Success Mail<span class="required">*</span></label>
                                       <input type="email" id="order_success_mail" name="order_success_mail" class="form-control" value="<?php if(isset($_POST["order_success_mail"])){ echo $_POST["order_success_mail"];}else{ echo $content_page->order_success_mail;}?>">
                                      
                                 </fieldset>
                              </div>

                              
                           </div>

                            <button type="submit" name="Submit" value="Update" id="Submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo base_url(); ?>admin/email-settings/edit/<?php echo $content_page->id;?>" class="btn btn-primary">Cancel</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
