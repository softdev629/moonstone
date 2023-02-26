<?php
    $base_url=base_url();
?>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/my-orders.js" type="text/javascript"></script>
<div class="order-bg">
      <div class="row">
          <div class="col-md-3 pr-0 white-bg min-height-400">
            <?php
                $data['client_login']=$client_login;
                $this->load->view('vwMyNav.php',$data);
            ?>
          </div>
		      <div class="col-md-9 pl-0">
                <div class="order-r-title"><h4 class="page-title">My Order</h4></div>
          			<div class="order-r-data-sec">
            			<div class="order-r-data-sec-inn">
                        <div class="table-rep-plugin">
                           <div class="table-wrapper">
                              <div class="table-responsive" data-pattern="priority-columns">
                                  <table id="gridTable" class="table table-striped table-bordered datatable m-b-0">
                                     <thead>
                                        <tr>
                                           <th width="15%">Order Number.</th>
                                           <th width="15%">Name</th>
                                           <th width="25%">Email</th>
                                           <th width="15%">Number Plate</th>
                                           <th width="15%">Price</th>
                                           <th width="15%">Date</th>
                                        </tr>
                                     </thead>
                                     <tbody class="clickable-row">
                                        <?php 
                                         $sr_count=0;
                                         if(is_array($order_list) && count($order_list) > 0) {
                                         foreach ($order_list as $vals) { 
                                         $sr_count++;
                                         ?>
                                         <tr>
                                             <td>
                                              <?php echo $vals['order_id'];?>
                                              <input type="hidden" name="order_id" value="<?php echo $vals['order_id'];?>"> 
                                             </td>
                                             <td><?php echo $vals['name'];?></td>
                                             <td><?php echo $vals['email'];?></td>
                                             <td><?php echo $vals['plates_number'];?></td>
                                             <td>£<?php echo $vals['total_price'];?></td>
                                             <td><?php echo date("d M Y",strtotime($vals['order_date']));?></td>
                                         </tr>
                                         <?php }} else {?>
                                         <tr>
                                             <td colspan="6">No data found</td>
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
</div>
</div>
</div>
</div>