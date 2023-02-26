<?php
    $base_url=base_url();
?>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<?php 
if(is_array($packages) && count($packages) > 0){
?>
<script src="<?php echo $base_url; ?>assets/js/grid.js"></script>
<?php } ?>
<div class="content-page">
   <div class="content">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title-box">
                  <h4 class="page-title"><?php echo $page?></h4>
                  <div class="add-page">
                     <a href="<?php echo base_url(); ?>admin/package/add"><i class="fa fa-plus" aria-hidden="true"></i></a>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
               <div class="card-box">
                  <div class="table-rep-plugin">
                     <div class="table-wrapper">
                        <div class="table-responsive" data-pattern="priority-columns">
                           <table id="gridTable" class="table table-striped table-bordered datatable m-b-0">
                              <thead>
                                 <tr>
                                    <th width="10%">Sr No.</th>
                                    <th width="15%">Name</th>
                                    <th width="15%">Price</th>
                                    <th width="20%">Sort Description</th>
                                    <th width="30%">Description</th>
                                    <th width="10%">Status</th>
                                 </tr>
                            
                                <tbody>
                                       <?php 
                                       $sr_count=0;
                                       if(is_array($packages) && count($packages) > 0) {
                                       foreach ($packages as $vals) { $sr_count++;

                                        ?>
                                       <tr>
                                           <td><?php echo $sr_count;?></td>
                                           <td><a href="<?php echo base_url(); ?>admin/package/edit/<?php echo $vals['id'];?>"><?php echo $vals['name'];?></a></td>
                                           <td><?php echo $vals['price'];?></td>
                                           <td><?php echo $vals['sort_desc'];?></td>
                                           <td><?php echo $vals['desc'];?></td>
                                           <td>
                                                <?php
                                                if($vals['status']==1)
                                                {
                                                ?>
                                                   <span class='label label-success'>Active</span>
                                                <?php
                                                }
                                                else if($vals['status']==2)
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
                                           <td colspan="5">No data found</td>
                                       </tr>
                                       <?php }?>
                                </tbody>
                              </thead>
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