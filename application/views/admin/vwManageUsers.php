<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<?php 
if(is_array($users_list) && count($users_list) > 0) {
?>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/grid.js"></script>
<?php } ?>
<div class="content-page">
            <div class="content">
               <div class="container">
                  <div class="row">
                    <div class="col-xs-12">
                       <div class="page-title-box">
                          <h4 class="page-title"><?php echo $page?></h4>
                          <div class="add-page">
                             <a href="<?php echo base_url(); ?>admin/user/add" style="margin-left: 6px;font-size: 17px;"><i class="fa fa-plus" aria-hidden="true"></i></a>
                          </div>
                          <div class="clearfix"></div>
                       </div>
                    </div>
                 </div>
                  <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                    <?php if ($this->session->flashdata('success')) { ?>
                      <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p><?php echo $this->session->flashdata('success'); ?></p>
                      </div>
                    <?php } ?>
                    </div>
                     <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="card-box">
                           <div class="table-rep-plugin">
                              <div class="table-wrapper">
                                 <div class="table-responsive" data-pattern="priority-columns">
                                    <table class="table table-striped table-bordered m-b-0" id="gridTable">
                                       <thead>
                                          <tr>
                                             <th>Sr No.</th>
                                             <th>First Name</th>
                                             <th>Last Name</th>
                                             <th>Contact Number</th>
                                             <th>Email</th>
                                             <th>Receive Marketing Emails</th>
                                             <th>Status</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                         <?php 
                                         $sr_count=0;
                                         if(is_array($users_list) && count($users_list) > 0) {
                                         foreach ($users_list as $vals) { 
                                         $sr_count++;
                                         ?>
                                         <tr>
                                             <td><?php echo $sr_count;?></td>
                                             <td>
                                              <a href="<?php echo base_url(); ?>admin/user/edit/<?php echo $vals['user_id'];?>"><?php echo $vals['name'];?></a></td>
                                             <td><?php echo $vals['lastname'];?></td>
                                             <td><?php echo $vals['phone_number'];?></td>
                                             <td><?php echo $vals['email'];?></td>
                                             <td>
                                                <?php
                                                if($vals['is_marketing_enable']==1)
                                                {
                                                ?>
                                                   <span class='label label-success'>Yes</span>
                                                <?php
                                                }
                                                else if($vals['is_marketing_enable']==2)
                                                {
                                                ?>
                                                  <span class='label label-danger'>No</span>
                                                <?php
                                                }
                                                ?>
                                              </td>
                                             <td>
                                                <?php
                                                if($vals['is_active']==1)
                                                {
                                                ?>
                                                   <span class='label label-success'>Active</span>
                                                <?php
                                                }
                                                else if($vals['is_active']==2)
                                                {
                                                ?>
                                                  <span class='label label-danger'>Inactive</span>
                                                <?php
                                                }
                                                ?>
                                              </td>                                             
                                         </tr>
                                         <?php }} else {?>
                                         <tr>
                                             <td colspan="7">No data found</td>
                                         </tr>
                                         <?php }?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- container -->
            </div>
            <!-- content -->
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