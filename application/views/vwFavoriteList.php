<?php
    $base_url=base_url();
?>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/product-details.js" type="text/javascript"></script>
<script src="<?php echo HTTP_ASSETS_PATH_CLIENT?>js/number_plates.js" type="text/javascript"></script>
<div class="order-bg">
   <div class="row">
      <div class="col-md-3 pr-0 white-bg min-height-400">
         <?php
                $data['client_login']=$client_login;
                $this->load->view('vwMyNav.php',$data);
         ?>
      </div>
      <div class="col-md-9 pl-0">
         <div class="order-r-title">
            <h4 class="page-title">My Favorite Plates</h4>
         </div>
         <div class="order-r-data-sec">
            <div class="order-r-data-sec-inn">
               <div class="row">
                  <div class="col-md-12">
                     <div class="num-plate-sec favorite">
                        <?php 
                        $sr_count=0;
                        if(is_array($favorite_list) && count($favorite_list) > 0) {
                        foreach ($favorite_list as $vals) { 
                        $sr_count++;
                        $plate_price="";
                        if($vals['cherished_price']!="") {
                           $plate_price=$vals['cherished_price'];
                        }else if($vals['prefix_price']!=""){ 
                           $plate_price=$vals['prefix_price'];
                        }else if($vals['new_plates_price']!=""){
                           $plate_price=$vals['new_plates_price'];
                        }
                        ?>
                        <input type="hidden" id="charge_<?php echo $vals['plate_id'];?>" value="<?php echo $plate_price;?>">
                        <input type="hidden" id="nm_<?php echo $vals['plate_id'];?>" value="<?php echo $vals['plates_number'];?>">
                        <input type="hidden" id="type_<?php echo $vals['plate_id'];?>" value="<?php echo $vals['plate_type'];?>">
                        <div class="num-plate-box">
                           <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $vals['plates_number'];?>" data-price="<?php echo $plate_price;?>" data-id="<?php echo $vals['plate_id'];?>"><?php echo $vals['plates_number'];?></div>
                           <div class="num-plate-box-bot-sec">
                           <div class="num-plate-price">£<?php echo $plate_price;?></div>
                           <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $vals['plates_number'];?>" data-price="<?php echo $plate_price;?>" data-id="<?php echo $vals['plate_id'];?>">View plate</a>
                           </div>
                        </div>
                        <?php }} else {?>
                        <h2>No data found</h2>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>