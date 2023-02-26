<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<?php 
if(is_array($order_list) && count($order_list) > 0) {
?>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/grid.js"></script>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/order.js"></script>
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
                                             <th width="10%">Order No.</th>
                                             <th width="20%">Name</th>
                                             <th width="25%">Email</th>
                                             <th width="15%">Number Plates</th>
                                             <th width="10%">Amount</th>
                                             <th width="10%">Date</th>
                                             <th width="10%">Status</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                         <?php 
                                         $sr_count=0;
                                         if(is_array($order_list) && count($order_list) > 0) {
                                         foreach ($order_list as $vals) { 
                                         $sr_count++;
                                         ?>
                                         <tr>
                                             <td><?php echo $vals['order_id'];?></td>
                                             <td><?php echo $vals['name'];?></td>
                                             <td><?php echo $vals['email'];?></td>
                                             <td><?php echo $vals['plates_number'];?></td>
                                             <td><?php echo $vals['total_price'];?></td>
                                             <td><?php echo date("d M Y",strtotime($vals['order_date']));?></td>
                                             <td>
                                                <?php
                                                if($vals['status']==1)
                                                {
                                                ?>
                                                   <a href="javascript:void()" onclick="update_order_status('2','<?php echo $vals['order_id']; ?>')"><span class='label label-danger'>Completed</span></a>
                                                <?php
                                                }
                                                else if($vals['status']==2)
                                                {
                                                ?>
                                                  <a href="javascript:void()" onclick="update_order_status('3','<?php echo $vals['order_id']; ?>')"><span class='label label-warning'>Processing</span></a>
                                                <?php
                                                }else if($vals['status']==3)
                                                {
                                                ?>
                                                  <a href="javascript:void()"><span class='label label-success'>Dispatched</span></a>
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