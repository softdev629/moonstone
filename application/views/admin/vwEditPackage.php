<?php
    $base_url=base_url();
?>
<div class="content-page">
   <div class="content">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title-box">
                  <h4 class="page-title">Edit <?php echo $page;?></h4>
                  <div class="add-page">
                     <a href="<?php echo base_url(); ?>admin/package" style="float:right;"><i class="fa fa-backward" aria-hidden="true"></i>Back</a>
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
                        <form class="da-home-form form-horizontal" method="post" action="<?php echo base_url(); ?>admin/package/edit/<?php echo $package->id;?>" enctype="multipart/form-data">
                           <div class="row">
                              
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="name">Name<span class="required">*</span></label>
                                       <input type="text" name="name" class="form-control" id="name"
                                          placeholder="Enter Name" required="" value="<?php if(isset($_POST["name"])){ echo $_POST["name"];}else{ echo $package->name;}?>">
                                    </fieldset>
                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="price">Price<span class="required">*</span></label>
                                       <input type="text" name="price" class="form-control" id="price"
                                          placeholder="Enter Price" required="" value="<?php if(isset($_POST["price"])){ echo $_POST["price"];}else{ echo $package->price;}?>">
                                    </fieldset>
                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="sort_desc">Sort Description<span class="required">*</span></label>
                                       <input type="text" name="sort_desc" class="form-control" id="sort_desc"
                                          placeholder="Enter Sort Description" required="" value="<?php if(isset($_POST["sort_desc"])){ echo $_POST["sort_desc"];}else{ echo $package->sort_desc;}?>">
                                    </fieldset>
                              </div>

                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                    <fieldset class="form-group">
                                       <label for="desc">Description<span class="required">*</span></label>
                                       <textarea name="desc" class="form-control" id="desc"
                                          placeholder="Enter Description" required=""><?php if(isset($_POST["desc"])){ echo $_POST["desc"];}else{ echo $package->desc;}?></textarea>
                                    </fieldset>
                              </div>
                              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                    <?php
                                          $active="checked";
                                          $inactive="";
                                          if($package->status==2){
                                             $inactive="checked";
                                             $active="";
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

                            <button type="submit" name="Submit" value="Update" id="Submit" class="btn btn-primary">Save</button>
                            <a href="<?php echo base_url(); ?>admin/package" class="btn btn-primary">Cancel</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
