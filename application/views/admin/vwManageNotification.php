<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<?php
if(is_array($notification_list) && count($notification_list) > 0) {
?>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/grid.js"></script>
<?php } ?>
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/notification.js?v=69869"></script> 
<div class="content-page">
            <div class="content">
               <div class="container">
                  <!-- <div class="row">
                     <div class="col-xs-12">
                        <div class="page-title-box">
                           <h4 class="page-title">Buy</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div> -->
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
                                             <th>Title</th>
                                             <th>Is Read</th>
                                             <th>Date</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                         <?php 
                                         $sr_count=0;
                                         if(is_array($notification_list) && count($notification_list) > 0) {
                                         foreach ($notification_list as $vals) { 
                                         $sr_count++;
                                         ?>
                                         <tr>
                                             <td><?php echo $sr_count;?></td>
                                             <td>
                                                <?php echo $vals['title'];?>
                                             </td>
                                             <td style="text-align: center;">
                                                <?php
                                                if($vals['is_read']==1){
                                                ?>
                                                <a href="javascript:void(0);" onclick="update_is_active('0','<?php echo $vals['id']; ?>')" style="color: #868686;"><i class="zmdi zmdi-email-open" aria-hidden="true"></i></a>
                                                <?php }else{ ?>
                                                <a href="javascript:void(0);" onclick="update_is_active('1','<?php echo $vals['id']; ?>')"><i id="is_active<?php echo $vals['id']; ?>" class="zmdi zmdi-email" aria-hidden="true"></i></a>
                                                <?php } ?>
                                             </td>
                                             <td><?php echo date("d M Y H:i:s",strtotime($vals['created_at']));?></td>
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