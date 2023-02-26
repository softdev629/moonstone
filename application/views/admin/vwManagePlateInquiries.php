<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<?php 
if(is_array($inquiries_list) && count($inquiries_list) > 0) {
?>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/grid.js"></script>
<?php } ?>
<div class="content-page">
            <div class="content">
               <div class="container">
                  <div class="row">
                     <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="card-box">
                           <div class="table-rep-plugin">
                              <div class="table-wrapper">
                                 <h4 class="header-title m-t-0 m-b-30"><?php echo $page;?></h4>
                                 <div class="table-responsive" data-pattern="priority-columns">
                                    <table class="table table-striped table-bordered m-b-0" id="gridTable">
                                       <thead>
                                          <tr>
                                             <th>Sr No.</th>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Number Plates</th>
                                             <th>Message</th>
                                             <th>Date</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                         <?php 
                                         $sr_count=0;
                                         if(is_array($inquiries_list) && count($inquiries_list) > 0) {
                                         foreach ($inquiries_list as $vals) { 
                                         $sr_count++;
                                         ?>
                                         <tr>
                                             <td><?php echo $sr_count;?></td>
                                             <td><?php echo $vals['name'];?></td>
                                             <td><?php echo $vals['email'];?></td>
                                             <td><?php echo $vals['plates_number'];?></td>
                                             <td><?php echo $vals['message'];?></td>
                                             <td><?php echo date("d M Y",strtotime($vals['created_at']));?></td>
                                         </tr>
                                         <?php }} else {?>
                                         <tr>
                                             <td colspan="5">No data found</td>
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