<?php
    $base_url=base_url();
?>

<div class="order-bg">
      <div class="row">
          <div class="col-md-3 pr-0 white-bg min-height-400">
            <?php
                $data['client_login']=$client_login;
                $this->load->view('vwMyNav.php',$data);
            ?>
          </div>
		      <div class="col-md-9 pl-0">
                <div class="order-r-title"><h4 class="page-title">Sell History</h4></div>
          			<div class="order-r-data-sec">
            			<div class="order-r-data-sec-inn">
                        <div class="table-rep-plugin">
                           <div class="table-wrapper">
                              <div class="table-responsive" data-pattern="priority-columns">
                                  <table id="gridTable" class="table table-striped table-bordered datatable m-b-0">
                                     <thead>
                                        <tr>
                                           <th width="8%">Sr No.</th>
                                           <th width="15%">Name</th>
                                           <th width="20%">Email</th>
                                           <th width="15%">Phone</th>
                                           <th width="15%">Number Plate</th>
                                           <th width="15%">Notes</th>
                                           <th width="12%">Date</th>
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
                                             <td>
                                              <?php echo $sr_count;?>
                                              <input type="hidden" name="id" value="<?php echo $vals['id'];?>"> 
                                             </td>
                                             <td><?php echo $vals['first_name'];?> <?php echo $vals['last_name'];?></td>
                                             <td><?php echo $vals['email'];?></td>
                                             <td>£<?php echo $vals['telephone_number'];?></td>
                                             <td><?php echo $vals['numberplate'];?></td>
                                             <td><?php echo $vals['note'];?></td>
                                             <td><?php echo date("d M Y",strtotime($vals['created_at']));?></td>
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
</div>
</div>
</div>
</div>