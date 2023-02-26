<?php
   $base_url=base_url();
   $abcd_drp=get_alphabetic();
   $platePrice=0;
?>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/product-details.js" type="text/javascript"></script>
<script src="<?php echo HTTP_ASSETS_PATH_CLIENT?>js/number_plates.js" type="text/javascript"></script>
<div class="search-sec">
	<div class="container-fluid">
		<form class="app-search" action="<?php echo $base_url?>reg" method="get" role="search">
			<span class="search-icon"><img src="https://www.moonstoneplates.com/assets/images/search-icon.svg"></span>
			<input type="text" name="search" id="search" maxlength="8" style="text-transform: uppercase;" class="form-control" value="<?php echo $search; ?>" placeholder="Search" oninput="myFunction()"> 
			<button style="display: none;" type="submit" class="srh-btn"><i class="ti-search"></i></button>
		</form>
	</div>
</div>
<?php  if($type != "") { ?>
<div class="alfa-search-sec">
	<div class="alfa-search-desk">
		<ul>
         <?php
                 
           foreach ($abcd_drp as $abcd_value) {
            $active_class="";
            if(strtolower($abcd_value)==strtolower($addition_search)){
               $active_class="active";
            }
           ?>
			<li class="<?php echo $active_class; ?>" onClick="additionalSearch('<?php echo $abcd_value; ?>');"><?php echo $abcd_value;?></li>
         <?php } ?>
		</ul>
	</div>
   <input type="hidden" name="addition_search" id="addition_search" value="<?php echo $addition_search; ?>">
	<div class="alfa-search-mob">
		<ul>
			<li <?php if($addition_search==1){ ?> class="active" <?php } ?> onClick="additionalSearch('1');">a-d</li>
         <li <?php if($addition_search==2){ ?> class="active" <?php } ?> onClick="additionalSearch('2');">e-h</li>
         <li <?php if($addition_search==3){ ?> class="active" <?php } ?> onClick="additionalSearch('3');">i-l</li>
         <li <?php if($addition_search==4){ ?> class="active" <?php } ?> onClick="additionalSearch('4');">m-p</li>
         <li <?php if($addition_search==5){ ?> class="active" <?php } ?> onClick="additionalSearch('5');">q-t</li>
         <li <?php if($addition_search==6){ ?> class="active" <?php } ?> onClick="additionalSearch('6');">u-x</li>
         <li <?php if($addition_search==7){ ?> class="active" <?php } ?> onClick="additionalSearch('7');">y-z</li>
		</ul>
	</div>
</div>
<?php } ?>

<div class="about-sec pt-2">
   <div class="container-fluid">
    <?php setlocale(LC_MONETARY, 'en_US'); ?>
    <?php
    if($search_type=='prefix'){
    ?>
      <?php if(count($numbers_data) > 0 || count($prefix_numbers_data) > 0 || count($new_numbers_data) > 0): ?>
         
        <?php if(($type=="" || $type=="prefix") && count($prefix_numbers_data) > 0){?>
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-title">Prefix <span class="yellow-text">plates</span>
               <?php 
               if($type==""){?>
               <a href="<?php echo base_url()?>reg?search=<?php echo $search;?>&type=prefix" class="view-more">View More Prefix</a>
               <?php }else{ ?>
                  
               <?php } ?>
               </div>
            </div>
         </div> 
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-sec">
                  <?php
                  foreach ($prefix_numbers_data as $pkey => $prefix_number_value) {
                  ?>
                  <?php// print_r($prefix_number_value);?>
                  <input type="hidden" id="charge_<?php echo $prefix_number_value['id'];?>" value="<?php echo $prefix_number_value['price'];?>">
                  <input type="hidden" id="nm_<?php echo $prefix_number_value['id'];?>" value="<?php echo $prefix_number_value['number'];?>">
                  <input type="hidden" id="type_<?php echo $prefix_number_value['id'];?>" value="<?php echo $prefix_number_value['plate_type'];?>">
                  <div class="num-plate-box">
                     <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $prefix_number_value['number'];?>" data-price="<?php echo $prefix_number_value['price'];?>" data-id="<?php echo $prefix_number_value['id'];?>"><?php echo $prefix_number_value['number'];?></div>
                     <div class="num-plate-box-bot-sec">
                        <div class="num-plate-price">
                        <?php
                            $is_vat_apply=1;
                            if($prefix_number_value['plate_type']=='1'){
                                $is_vat_apply=check_vat_apply($prefix_number_value['id']);
                            }

                           $plates_price=$prefix_number_value['price'];
                           $plate_type=$prefix_number_value['plate_type'];
                           $apply_poa= $prefix_number_value['apply_poa'] ?? 0;
                           $cartPriceobj=total_product_price($plate_type,$plates_price,$is_vat_apply);
                           $SubplatePrice=$cartPriceobj['SubplatePrice'];
                           $totalPrice=$cartPriceobj['totalPrice'];
                           $vat_cost=$cartPriceobj['vat_cost'];
                           if($apply_poa=='1'){
                              echo "POA";
                           }else{
                              echo '£' . number_format($totalPrice, '2');
                           } 
                         ?>                         
                        </div>
                        <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $prefix_number_value['number'];?>" data-price="<?php echo $totalPrice;?>" data-id="<?php echo $prefix_number_value['id'];?>">View plate</a>
                     </div>
                  </div>
                  <?php
                  }
                  ?>
                  <?php  if($type != "") { ?>
                  <div id="load_more_49"></div>
                  <button class="subscribe" type="button" onclick="loadmore()" value="loadmore" style="cursor: pointer;">Load More</button>
                  <input type="hidden" name="limit" id="limit" value="49"/>
                  <input type="hidden" name="offset" id="offset" value="96"/>
                  <input type="hidden" name="type" id="type" value="prefix"/>
                  <input type="hidden" name="search" id="search" value="<?php print isset($_GET['search']) ? $_GET['search'] : '' ; ?>"/>   
                  <?php } ?>           
               </div>
            </div>
         </div>
         <?php } ?>

         <?php if(($type=="" || $type=="cherished") && count($numbers_data) > 0){?>
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-title">Cherished <span class="yellow-text">plates</span>
               <?php 
               if($type==""){?>
               <a href="<?php echo base_url()?>reg?search=<?php echo $search;?>&type=cherished" class="view-more">View More Cherished</a>
               <?php }else{ ?>
                  
               <?php } ?>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-sec">
                  <?php
                  foreach ($numbers_data as $nkey => $number_value) {
                  ?>
                  <input type="hidden" id="charge_<?php echo $number_value['id'];?>" value="<?php echo $number_value['price'];?>">
                  <input type="hidden" id="nm_<?php echo $number_value['id'];?>" value="<?php echo $number_value['number'];?>">
                  <input type="hidden" id="type_<?php echo $number_value['id'];?>" value="<?php echo $number_value['plate_type'];?>">
                  <div class="num-plate-box">
                     <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $number_value['number'];?>" data-price="<?php echo $number_value['price'];?>" data-id="<?php echo $number_value['id'];?>"><?php echo $number_value['number'];?></div>
                     <div class="num-plate-box-bot-sec">
                        <div class="num-plate-price">
                         <?php
                              $platePrice=0;
                              $dvla_price=$this->config->item('dvla_price');
                              $is_vat_apply=1;
                              if($number_value['plate_type']=='1'){
                               $is_vat_apply=check_vat_apply($number_value['id']);
                              }
                              $platePrice=$number_value['price'];
                              $plate_type=$number_value['plate_type'];
                              $apply_poa= $number_value['apply_poa'] ?? 0;
                              
                              $cartPriceobj=total_product_price($plate_type,$platePrice,$is_vat_apply);
                              $SubplatePrice=$cartPriceobj['SubplatePrice'];
                              $totalPrice=$cartPriceobj['totalPrice'];
                              $vat_cost=$cartPriceobj['vat_cost'];
                              // print_r($apply_poa); die();
                               if($apply_poa=='1'){
                                 echo "POA";
                               }else{
                                    echo '£' . number_format($totalPrice, '2');
                               }
                         ?>                        
                         </div>

                        <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $number_value['number'];?>" data-price="<?php echo $totalPrice;?>" data-id="<?php echo $number_value['id'];?>">View plate</a>
                     </div>
                  </div>
                  <?php
                  }
                  ?>
                  <?php  if($type != "") { ?>
                  <div id="load_more_49"></div>
                  <button class="subscribe" type="button" onclick="loadmore()" value="loadmore" style="cursor: pointer;">Load More</button>
                  <input type="hidden" name="limit" id="limit" value="49"/>
                  <input type="hidden" name="offset" id="offset" value="96"/>
                  <input type="hidden" name="type" id="type" value="cherished"/>
                  <input type="hidden" name="search" id="search" value="<?php print isset($_GET['search']) ? $_GET['search'] : '' ; ?>"/>   
                  <?php } ?> 
               </div>
            </div>
         </div>
        <?php } ?>

         <?php if(($type=="" || $type=="new") && count($new_numbers_data) > 0){?>
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-title">Current style <span class="yellow-text">plates</span>
               <?php 
               if($type==""){?>
               <a href="<?php echo base_url()?>reg?search=<?php echo $search;?>&type=new" class="view-more">View More New</a>
               <?php }else{ ?>
                  
               <?php } ?>
               </div>
            </div>
         </div> 
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-sec">
                  <?php
                  foreach ($new_numbers_data as $pkey => $new_number_value) {
                  ?>
                  <input type="hidden" id="charge_<?php echo $new_number_value['id'];?>" value="<?php echo $new_number_value['price'];?>">
                  <input type="hidden" id="nm_<?php echo $new_number_value['id'];?>" value="<?php echo $new_number_value['number'];?>">
                  <input type="hidden" id="type_<?php echo $new_number_value['id'];?>" value="<?php echo $new_number_value['plate_type'];?>">
                  <div class="num-plate-box">
                     <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $new_number_value['number'];?>" data-price="<?php echo $new_number_value['price'];?>" data-id="<?php echo $new_number_value['id'];?>"><?php echo $new_number_value['number'];?></div>
                     <div class="num-plate-box-bot-sec">
                        <div class="num-plate-price">
                         
                         <?php
                           $platePrice=0;
                           $is_vat_apply=1;
                           if($new_number_value['plate_type']=='1'){
                            $is_vat_apply=check_vat_apply($new_number_value['id']);
                           }
                           $platePrice=$new_number_value['price'];
                           $plate_type=$new_number_value['plate_type'];
                           $apply_poa= $new_number_value['apply_poa'] ?? 0;
                           $cartPriceobj=total_product_price($plate_type,$platePrice,$is_vat_apply);
                           $SubplatePrice=$cartPriceobj['SubplatePrice'];
                           $totalPrice=$cartPriceobj['totalPrice'];
                           $vat_cost=$cartPriceobj['vat_cost'];
                           if($apply_poa=='1'){
                              echo "POA";
                           }else{
                              echo '£' . number_format($totalPrice, '2');
                           }
                         ?>                        
                         </div>
                        <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $new_number_value['number'];?>" data-price="<?php echo $totalPrice;?>" data-id="<?php echo $new_number_value['id'];?>">View plate</a>
                     </div>
                  </div>
                  <?php
                  }
                  ?>
                  <?php  if($type != "") { ?>
                  <div id="load_more_49"></div>
                  <button class="subscribe" type="button" onclick="loadmore()" value="loadmore" style="cursor: pointer;">Load More</button>
                  <input type="hidden" name="limit" id="limit" value="49"/>
                  <input type="hidden" name="offset" id="offset" value="96"/>
                  <input type="hidden" name="type" id="type" value="new"/>
                  <input type="hidden" name="search" id="search" value="<?php print isset($_GET['search']) ? $_GET['search'] : '' ; ?>"/>
                  <?php } ?>
               </div>
            </div>
         </div>
         <?php } ?>
         <?php else: ?>
           <div class="row">
            <div class="col-md-12">
               <div class="num-plate-title">No results found</div>
               <div>There are no number plate found matching your search.</div>
            </div>
           </div>
         <?php endif; ?>
   <?php
    }else if($search_type=='new_plates'){
   ?>

   <?php if(count($numbers_data) > 0 || count($prefix_numbers_data) > 0 || count($new_numbers_data) > 0): ?>

         <?php if(($type=="" || $type=="new") && count($new_numbers_data) > 0){?>
            <div class="row">
               <div class="col-md-12">
                  <div class="num-plate-title">Current style <span class="yellow-text">plates</span>
                  <?php 
                  if($type==""){?>
                  <a href="<?php echo base_url()?>reg?search=<?php echo $search;?>&type=new" class="view-more">View More New</a>
                  <?php }else{ ?>
                     
                  <?php } ?>
                  </div>
               </div>
            </div> 
            <div class="row">
               <div class="col-md-12">
                  <div class="num-plate-sec">
                     <?php
                     foreach ($new_numbers_data as $pkey => $new_number_value) {
                     ?>
                     <input type="hidden" id="charge_<?php echo $new_number_value['id'];?>" value="<?php echo $new_number_value['price'];?>">
                     <input type="hidden" id="nm_<?php echo $new_number_value['id'];?>" value="<?php echo $new_number_value['number'];?>">
                     <input type="hidden" id="type_<?php echo $new_number_value['id'];?>" value="<?php echo $new_number_value['plate_type'];?>">
                     <div class="num-plate-box">
                        <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $new_number_value['number'];?>" data-price="<?php echo $new_number_value['price'];?>" data-id="<?php echo $new_number_value['id'];?>"><?php echo $new_number_value['number'];?></div>
                        <div class="num-plate-box-bot-sec">
                           <div class="num-plate-price">
                            
                            <?php
                              $platePrice=0;
                              $is_vat_apply=1;
                              if($new_number_value['plate_type']=='1'){
                               $is_vat_apply=check_vat_apply($new_number_value['id']);
                              }
                              $platePrice=$new_number_value['price'];
                              $plate_type=$new_number_value['plate_type'];
                              $apply_poa= $new_number_value['apply_poa'] ?? 0;
                              $cartPriceobj=total_product_price($plate_type,$platePrice,$is_vat_apply);
                              $SubplatePrice=$cartPriceobj['SubplatePrice'];
                              $totalPrice=$cartPriceobj['totalPrice'];
                              $vat_cost=$cartPriceobj['vat_cost'];
                              if($apply_poa=='1'){
                                 echo "POA";
                              }else{
                                 echo '£' . number_format($totalPrice, '2');
                              }
                            ?>                        
                            </div>
                           <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $new_number_value['number'];?>" data-price="<?php echo $totalPrice;?>" data-id="<?php echo $new_number_value['id'];?>">View plate</a>
                        </div>
                     </div>
                     <?php
                     }
                     ?>
                     <?php  if($type != "") { ?>
                     <div id="load_more_49"></div>
                     <button class="subscribe" type="button" onclick="loadmore()" value="loadmore" style="cursor: pointer;">Load More</button>
                     <input type="hidden" name="limit" id="limit" value="49"/>
                     <input type="hidden" name="offset" id="offset" value="96"/>
                     <input type="hidden" name="type" id="type" value="new"/>
                     <input type="hidden" name="search" id="search" value="<?php print isset($_GET['search']) ? $_GET['search'] : '' ; ?>"/>
                     <?php } ?>
                  </div>
               </div>
            </div>
         <?php } ?>
         <?php if(($type=="" || $type=="cherished") && count($numbers_data) > 0){?>
            <div class="row">
               <div class="col-md-12">
                  <div class="num-plate-title">Cherished <span class="yellow-text">plates</span>
                  <?php 
                  if($type==""){?>
                  <a href="<?php echo base_url()?>reg?search=<?php echo $search;?>&type=cherished" class="view-more">View More Cherished</a>
                  <?php }else{ ?>
                     
                  <?php } ?>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="num-plate-sec">
                     <?php
                     foreach ($numbers_data as $nkey => $number_value) {
                     ?>
                     <input type="hidden" id="charge_<?php echo $number_value['id'];?>" value="<?php echo $number_value['price'];?>">
                     <input type="hidden" id="nm_<?php echo $number_value['id'];?>" value="<?php echo $number_value['number'];?>">
                     <input type="hidden" id="type_<?php echo $number_value['id'];?>" value="<?php echo $number_value['plate_type'];?>">
                     <div class="num-plate-box">
                        <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $number_value['number'];?>" data-price="<?php echo $number_value['price'];?>" data-id="<?php echo $number_value['id'];?>"><?php echo $number_value['number'];?></div>
                        <div class="num-plate-box-bot-sec">
                           <div class="num-plate-price">
                            <?php
                                 $platePrice=0;
                                 $is_vat_apply=1;
                                 if($number_value['plate_type']=='1'){
                                  $is_vat_apply=check_vat_apply($number_value['id']);
                                 }
                                 $platePrice=$number_value['price'];
                                 $plate_type=$number_value['plate_type'];
                                 $apply_poa= $number_value['apply_poa'] ?? 0;
                                 $cartPriceobj=total_product_price($plate_type,$platePrice,$is_vat_apply);
                                 $SubplatePrice=$cartPriceobj['SubplatePrice'];
                                 $totalPrice=$cartPriceobj['totalPrice'];
                                 $vat_cost=$cartPriceobj['vat_cost'];
                                 if($apply_poa=='1'){
                                    echo "POA";
                                 }else{
                                    echo '£' . number_format($totalPrice, '2');
                                 }
                            ?>                        
                            </div>
                           <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $number_value['number'];?>" data-price="<?php echo $totalPrice;?>" data-id="<?php echo $number_value['id'];?>">View plate</a>
                        </div>
                     </div>
                     <?php
                     }
                     ?>
                     <?php  if($type != "") { ?>
                     <div id="load_more_49"></div>
                     <button class="subscribe" type="button" onclick="loadmore()" value="loadmore" style="cursor: pointer;">Load More</button>
                     <input type="hidden" name="limit" id="limit" value="49"/>
                     <input type="hidden" name="offset" id="offset" value="96"/>
                     <input type="hidden" name="type" id="type" value="cherished"/>
                     <input type="hidden" name="search" id="search" value="<?php print isset($_GET['search']) ? $_GET['search'] : '' ; ?>"/>   
                     <?php } ?> 
                  </div>
               </div>
            </div>
         <?php } ?>
         <?php if(($type=="" || $type=="prefix") && count($prefix_numbers_data) > 0){?>
            <div class="row">
               <div class="col-md-12">
                  <div class="num-plate-title">Prefix <span class="yellow-text">plates</span>
                  <?php 
                  if($type==""){?>
                  <a href="<?php echo base_url()?>reg?search=<?php echo $search;?>&type=prefix" class="view-more">View More Prefix</a>
                  <?php }else{ ?>
                     
                  <?php } ?>
                  </div>
               </div>
            </div> 
            <div class="row">
               <div class="col-md-12">
                  <div class="num-plate-sec">
                     <?php
                     foreach ($prefix_numbers_data as $pkey => $prefix_number_value) {
                     ?>
                     <?php// print_r($prefix_number_value);?>
                     <input type="hidden" id="charge_<?php echo $prefix_number_value['id'];?>" value="<?php echo $prefix_number_value['price'];?>">
                     <input type="hidden" id="nm_<?php echo $prefix_number_value['id'];?>" value="<?php echo $prefix_number_value['number'];?>">
                     <input type="hidden" id="type_<?php echo $prefix_number_value['id'];?>" value="<?php echo $prefix_number_value['plate_type'];?>">
                     <div class="num-plate-box">
                        <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $prefix_number_value['number'];?>" data-price="<?php echo $prefix_number_value['price'];?>" data-id="<?php echo $prefix_number_value['id'];?>"><?php echo $prefix_number_value['number'];?></div>
                        <div class="num-plate-box-bot-sec">
                           <div class="num-plate-price">
                           <?php
                              $is_vat_apply=1;
                              if($prefix_number_value['plate_type']=='1'){
                                $is_vat_apply=check_vat_apply($prefix_number_value['id']);
                              }
                              $platePrice=$prefix_number_value['price'];
                              $plate_type=$prefix_number_value['plate_type'];
                              $apply_poa= $prefix_number_value['apply_poa'] ?? 0;
                              $cartPriceobj=total_product_price($plate_type,$platePrice,$is_vat_apply);
                              $SubplatePrice=$cartPriceobj['SubplatePrice'];
                              $totalPrice=$cartPriceobj['totalPrice'];
                              $vat_cost=$cartPriceobj['vat_cost'];
                              if($apply_poa=='1'){
                                 echo "POA";
                              }else{
                                 echo '£' . number_format($totalPrice, '2');
                              }
                            ?>                         
                           </div>
                           <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $prefix_number_value['number'];?>" data-price="<?php echo $totalPrice;?>" data-id="<?php echo $prefix_number_value['id'];?>">View plate</a>
                        </div>
                     </div>
                     <?php
                     }
                     ?>
                     <?php  if($type != "") { ?>
                     <div id="load_more_49"></div>
                     <button class="subscribe" type="button" onclick="loadmore()" value="loadmore" style="cursor: pointer;">Load More</button>
                     <input type="hidden" name="limit" id="limit" value="49"/>
                     <input type="hidden" name="offset" id="offset" value="96"/>
                     <input type="hidden" name="type" id="type" value="prefix"/>
                     <input type="hidden" name="search" id="search" value="<?php print isset($_GET['search']) ? $_GET['search'] : '' ; ?>"/>   
                     <?php } ?>           
                  </div>
               </div>
            </div>
         <?php } ?>
         <?php else: ?>
           <div class="row">
               <div class="col-md-12">
                  <div class="num-plate-title">No results found</div>
                  <div>There are no number plate found matching your search.</div>
               </div>
           </div>
         <?php endif; ?>
   <?php
    }else{
    ?>
       <?php if(count($numbers_data) > 0 || count($prefix_numbers_data) > 0 || count($new_numbers_data) > 0): ?>
         <?php if(($type=="" || $type=="cherished") && count($numbers_data) > 0){?>
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-title">Cherished <span class="yellow-text">plates</span>
               <?php 
               if($type==""){?>
               <a href="<?php echo base_url()?>reg?search=<?php echo $search;?>&type=cherished" class="view-more">View More Cherished</a>
               <?php }else{ ?>
                  
               <?php } ?>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-sec">
                  <?php
                  foreach ($numbers_data as $nkey => $number_value) {
                  ?>
                  <input type="hidden" id="charge_<?php echo $number_value['id'];?>" value="<?php echo $number_value['price'];?>">
                  <input type="hidden" id="nm_<?php echo $number_value['id'];?>" value="<?php echo $number_value['number'];?>">
                  <input type="hidden" id="type_<?php echo $number_value['id'];?>" value="<?php echo $number_value['plate_type'];?>">
                  <div class="num-plate-box">
                     <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $number_value['number'];?>" data-price="<?php echo $number_value['price'];?>" data-id="<?php echo $number_value['id'];?>"><?php echo $number_value['number'];?></div>
                     <div class="num-plate-box-bot-sec">
                        <div class="num-plate-price">
                         <?php
                              $platePrice=0;
                              $is_vat_apply=1;
                              if($number_value['plate_type']=='1'){
                               $is_vat_apply=check_vat_apply($number_value['id']);
                              }
                              $platePrice=$number_value['price'];
                              $plate_type=$number_value['plate_type'];
                              $apply_poa= $number_value['apply_poa'] ?? 0;
                              $cartPriceobj=total_product_price($plate_type,$platePrice,$is_vat_apply);
                              $SubplatePrice=$cartPriceobj['SubplatePrice'];
                              $totalPrice=$cartPriceobj['totalPrice'];
                              $vat_cost=$cartPriceobj['vat_cost'];
                              if($apply_poa=='1'){
                              echo "POA";
                              }else{
                              echo '£' . number_format($totalPrice, '2');
                              }
                         ?>                        
                         </div>
                        <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $number_value['number'];?>" data-price="<?php echo $totalPrice;?>" data-id="<?php echo $number_value['id'];?>">View plate</a>
                     </div>
                  </div>
                  <?php
                  }
                  ?>
                  <?php  if($type != "") { ?>
                  <div id="load_more_49"></div>
                  <button class="subscribe" type="button" onclick="loadmore()" value="loadmore" style="cursor: pointer;">Load More</button>
                  <input type="hidden" name="limit" id="limit" value="49"/>
                  <input type="hidden" name="offset" id="offset" value="96"/>
                  <input type="hidden" name="type" id="type" value="cherished"/>
                  <input type="hidden" name="search" id="search" value="<?php print isset($_GET['search']) ? $_GET['search'] : '' ; ?>"/>   
                  <?php } ?> 
               </div>
            </div>
         </div>
        <?php } ?>
        <?php if(($type=="" || $type=="prefix") && count($prefix_numbers_data) > 0){?>
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-title">Prefix <span class="yellow-text">plates</span>
               <?php 
               if($type==""){?>
               <a href="<?php echo base_url()?>reg?search=<?php echo $search;?>&type=prefix" class="view-more">View More Prefix</a>
               <?php }else{ ?>
                  
               <?php } ?>
               </div>
            </div>
         </div> 
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-sec">
                  <?php
                  foreach ($prefix_numbers_data as $pkey => $prefix_number_value) {
                  ?>
                  <?php// print_r($prefix_number_value);?>
                  <input type="hidden" id="charge_<?php echo $prefix_number_value['id'];?>" value="<?php echo $prefix_number_value['price'];?>">
                  <input type="hidden" id="nm_<?php echo $prefix_number_value['id'];?>" value="<?php echo $prefix_number_value['number'];?>">
                  <input type="hidden" id="type_<?php echo $prefix_number_value['id'];?>" value="<?php echo $prefix_number_value['plate_type'];?>">
                  <div class="num-plate-box">
                     <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $prefix_number_value['number'];?>" data-price="<?php echo $prefix_number_value['price'];?>" data-id="<?php echo $prefix_number_value['id'];?>"><?php echo $prefix_number_value['number'];?></div>
                     <div class="num-plate-box-bot-sec">
                        <div class="num-plate-price">
                        <?php
                            $is_vat_apply=1;
                            if($prefix_number_value['plate_type']=='1'){
                                $is_vat_apply=check_vat_apply($prefix_number_value['id']);
                            }
                           
                           $platePrice=$prefix_number_value['price'];
                           $plate_type=$prefix_number_value['plate_type'];
                           $apply_poa= $prefix_number_value['apply_poa'] ?? 0;
                           $cartPriceobj=total_product_price($plate_type,$platePrice,$is_vat_apply);
                           $SubplatePrice=$cartPriceobj['SubplatePrice'];
                           $totalPrice=$cartPriceobj['totalPrice'];
                           $vat_cost=$cartPriceobj['vat_cost'];
                           if($apply_poa=='1'){
                              echo "POA";
                           }else{
                              echo '£' . number_format($totalPrice, '2');
                           }
                         ?>                         
                        </div>
                        <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $prefix_number_value['number'];?>" data-price="<?php echo $totalPrice;?>" data-id="<?php echo $prefix_number_value['id'];?>">View plate</a>
                     </div>
                  </div>
                  <?php
                  }
                  ?>
                  <?php  if($type != "") { ?>
                  <div id="load_more_49"></div>
                  <button class="subscribe" type="button" onclick="loadmore()" value="loadmore" style="cursor: pointer;">Load More</button>
                  <input type="hidden" name="limit" id="limit" value="49"/>
                  <input type="hidden" name="offset" id="offset" value="96"/>
                  <input type="hidden" name="type" id="type" value="prefix"/>
                  <input type="hidden" name="search" id="search" value="<?php print isset($_GET['search']) ? $_GET['search'] : '' ; ?>"/>   
                  <?php } ?>           
               </div>
            </div>
         </div>
         <?php } ?>

         <?php if(($type=="" || $type=="new") && count($new_numbers_data) > 0){?>
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-title">Current style <span class="yellow-text">plates</span>
               <?php 
               if($type==""){?>
               <a href="<?php echo base_url()?>reg?search=<?php echo $search;?>&type=new" class="view-more">View More New</a>
               <?php }else{ ?>
                  
               <?php } ?>
               </div>
            </div>
         </div> 
         <div class="row">
            <div class="col-md-12">
               <div class="num-plate-sec">
                  <?php
                  foreach ($new_numbers_data as $pkey => $new_number_value) {
                  ?>
                  <input type="hidden" id="charge_<?php echo $new_number_value['id'];?>" value="<?php echo $new_number_value['price'];?>">
                  <input type="hidden" id="nm_<?php echo $new_number_value['id'];?>" value="<?php echo $new_number_value['number'];?>">
                  <input type="hidden" id="type_<?php echo $new_number_value['id'];?>" value="<?php echo $new_number_value['plate_type'];?>">
                  <div class="num-plate-box">
                     <div class="num-plate-box-inn buy_pop_up" data-number="<?php echo $new_number_value['number'];?>" data-price="<?php echo $new_number_value['price'];?>" data-id="<?php echo $new_number_value['id'];?>"><?php echo $new_number_value['number'];?></div>
                     <div class="num-plate-box-bot-sec">
                        <div class="num-plate-price">
                         
                         <?php
                           $platePrice=0;
                           $is_vat_apply=1;
                           if($new_number_value['plate_type']=='1'){
                            $is_vat_apply=check_vat_apply($new_number_value['id']);
                           }
                           $platePrice=$new_number_value['price'];
                           $plate_type=$new_number_value['plate_type'];
                           $apply_poa= $new_number_value['apply_poa'] ?? 0;
                           $cartPriceobj=total_product_price($plate_type,$platePrice,$is_vat_apply);
                           $SubplatePrice=$cartPriceobj['SubplatePrice'];
                           $totalPrice=$cartPriceobj['totalPrice'];
                           $vat_cost=$cartPriceobj['vat_cost'];

                           if($apply_poa=='1'){
                           echo "POA";
                           }else{
                           echo '£' . number_format($totalPrice, '2');
                           }
                         ?>                        
                         </div>
                        <a href="javascript:void(0)" class="num-plate-view" data-number="<?php echo $new_number_value['number'];?>" data-price="<?php echo $totalPrice;?>" data-id="<?php echo $new_number_value['id'];?>">View plate</a>
                     </div>
                  </div>
                  <?php
                  }
                  ?>
                  <?php  if($type != "") { ?>
                  <div id="load_more_49"></div>
                  <button class="subscribe" type="button" onclick="loadmore()" value="loadmore" style="cursor: pointer;">Load More</button>
                  <input type="hidden" name="limit" id="limit" value="49"/>
                  <input type="hidden" name="offset" id="offset" value="96"/>
                  <input type="hidden" name="type" id="type" value="new"/>
                  <input type="hidden" name="search" id="search" value="<?php print isset($_GET['search']) ? $_GET['search'] : '' ; ?>"/>
                  <?php } ?>
               </div>
            </div>
         </div>
         <?php } ?>
         <?php else: ?>
           <div class="row">
            <div class="col-md-12">
               <div class="num-plate-title">No results found</div>
               <div>There are no number plate found matching your search.</div>
            </div>
           </div>
         <?php endif; ?>
    <?php
    }

    ?>


    
      
   </div>
</div>
</div>
</div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" style="display:none;">
  Cookies Policy
</button>

<!-- Modal -->
<div style="display:none;" class="modal fade bd-example-modal-lg" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cookies Policy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-md-12">
			
				
				
				<div class="cockies-collapse">
				
<p>
					At Moonstone Plates, we want to ensure that your visit to our site is smooth, reliable and as useful to you as possible. To help us do this, we use cookies.
				</p>				
					<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed cockies-collapse-arrow" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          What are cookies?
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <p>
			Cookies are small bits of information that are placed on your computer or mobile device when you visit almost any website. Cookies do not recognise you personally and are not harmful to your computer or mobile device. They are used by websites you visit in order to improve your experience on the website.
		</p>
		<p>
		Cookies are small bits of information that are placed on your computer or mobile device when you visit almost any website. Cookies do not recognise you personally and are not harmful to your computer or mobile device. They are used by websites you visit in order to improve your experience on the website.
		</p>
		<p>
		For instance, we use cookies on our site to allow you to login without having to type your login name each time. Other cookies help us to understand what did and didn’t interest you about our website so we can provide you with features that are more relevant and useful to you next time you visit. We and some of our partners also use cookies on our site to measure the effectiveness of advertising on our site and how visitors use our site.
		</p>
		<p>
		As well as setting some cookies ourselves - "first party cookies", we also work with some partners to help give you access to even more great features on our site. These partners set "third party cookies" which enable their features to be provided on or through our website (such as advertising or videos). Third party cookies do not recognise you personally but can recognise your computer when it visits Moonstone Plates and other websites. This helps to ensure you get the best experience possible when visiting these sites.
		</p>
		<p>
		Some cookies, called "session cookies", stay on your computer only while your website browser is open and are deleted automatically once you close your browser. Other cookies, called "persistent cookies", remain on your computer or mobile device after your browser is closed. This enables websites to recognise your computer when you later re-open your browser to give you as smooth a browsing experience as possible.
		</p>
	  </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed cockies-collapse-arrow" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          What types of cookies do we use?
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
	  <p>
		<strong>Essential cookies</strong>
		</p>
        <p>
		These cookies help you to move around our site and use all its essential features. Without these cookies, our website would not work properly and you would not be able to use features such as the shopping basket or the secure customer account pages.
		</p>
		<p>
		<strong>Performance and analytics cookies</strong>
		</p>
        <p>
		At Moonstone Plates, we want to make your experience on our website as smooth and as enjoyable as possible. Performance and analytics cookies help us understand how our website is being used and how we can improve your experience on it. These cookies cannot identify you personally; rather they provide us with anonymous information to help us understand which parts of our website interest our visitors and if they experience any errors. We use these cookies to test different designs and features for our website and we also use them to help us monitor how our visitors reach our sites and how effective our advertising is.
		</p>
		<p>
		<strong>Functionality cookies</strong>
		</p>
        <p>
		We use functionality cookies to save your settings on our website such as your language preference and booking information you’ve previously used when buying a private plate from us. We also use functionality cookies to remember things such as the last registration plate you searched for so you can easily find it the next time you visit. Some functionality cookies are essential if you want to view videos and maps on our site. We also use "Flash cookies" for some of our animated content and to remember some of your preferences such as your volume settings.
		</p>
		<p>
		<strong>Advertising cookies</strong>
		</p>
        <p>
		Advertising cookies help ensure that the advertisements you see on our website are as relevant to you as possible. For example, some advertising cookies help select advertisements that are based on your interests. Others help prevent the same advertisement from continuously reappearing for you. Some of our partners may also use cookies or web beacons (a single-pixel image file) so that you see more relevant advertisements when visiting other websites. The information collected by these cookies and web beacons does not enable us or these third parties to identify your name, contact details or other personally identifying details unless you choose to provide these details.
		</p>
		<p>
		<strong>Social networking cookies</strong>
		</p>
        <p>
		We also want to make it as easy as possible for you to share content from Moonstone Plates with your friends through your favourite social networks. Social networking cookies, which are usually set by the social networking provider, enable such sharing to be smooth and seamless.
		</p>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed cockies-collapse-arrow" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          How can you manage your cookies?
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <p>You can set or amend your web browser controls to delete or disable cookies. If you choose to disable cookies on your computer or mobile device however, your access to some functionality and areas of our website may be degraded or restricted.&nbsp;<a href="http://www.allaboutcookies.org/">www.allaboutcookies.org</a>&nbsp;provides good simple instructions on how to manage cookies on the different types of web browsers. <a href="http://www.adobe.com/eeurope/special/products/flashplayer/articles/lso/">http://www.adobe.com/eeurope/special/products/flashplayer/articles/lso/</a>&nbsp;also has a good summary of how to manage Flash cookies.</p>
		<p>Most advertising networks offer you a way to opt out of advertising cookies.&nbsp;<a href="http://www.aboutads.info/choices/">www.aboutads.info/choices/</a>&nbsp;and&nbsp;<a href="http://www.youronlinechoices.com/">www.youronlinechoices.com</a>&nbsp;have useful information on how to do this.</p>
		<p><strong>Where can I get further information?</strong></p>
		<p>If you have any questions about our use of cookies or other technologies, please email us at <a href="mailto:info@moonstoneplates.com">info@moonstoneplates.com</a>&nbsp; and we’ll do our best to help.</p>
		<p><strong>Cookie settings</strong></p>
		<p><strong>Strictly necessary &amp; functional cookies</strong></p>
		<p>These cookies cannot be disabled.</p>
		<p><strong>Advertising &amp; marketing cookies</strong></p>
		<p>By opting in to our cookie policy, you agree to our use of cookies to display personalised ads and share information about your use of our site with our advertising and analytics partners.</p>
		<p>If you choose to opt out, please also remember to clear any current cookies or site data from your browser otherwise you may still see targeted ads based on cookies that have been set in the past. You can find out how to do this here:&nbsp;<a href="http://www.allaboutcookies.org/manage-cookies">www.allaboutcookies.org/manage-cookies</a>.</p>
		<p><strong>We value your privacy</strong></p>
		<p>Moonstone Plates uses cookies and similar technologies to analyse traffic, personalise content and ads, and provide social media features.</p>
		<p>Accept</p>
		<p><u>Learn more and adjust settings</u></p>
	  </div>
    </div>
  </div>
</div>
				
				</div>
				
			</div>
		</div>
      </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-styled btn-base-1" data-dismiss="modal">Accept</button>
        <button type="button" class="btn btn-styled btn-base-1">Reject</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function loadmore() {
    var offse = $('#limit').val();
    $.ajax({
        url:'number-plate/loadmore',
        data:{
          offset :$('#offset').val(),
          limit :$('#limit').val(),
          search : $('#search').val(),
          type : $('#type').val(),
          addition_search : $('#addition_search').val()
        },
        type:'POST',
        dataType: 'json', 
        success :function(responce){
            $('#load_more_' + offse).html(responce.view);
            $('#offset').val(responce.offset);
            $('#limit').val(responce.limit);
        }
    })
  }
  function updateQueryStringParameter(uri, key, value) {
     var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
     
     var separator = uri.indexOf('?') !== -1 ? "&" : "?";
     if (uri.match(re)) {
       return uri.replace(re, '$1' + key + "=" + value + '$2');
     }
     else {
       return uri + separator + key + "=" + value;
     }
   }

   function additionalSearch(addition_search){
         $("#addition_search").val(addition_search);
         var oldURL = window.location.href;
         var new_url=updateQueryStringParameter(oldURL,'addition_search',addition_search);
         window.location.href=new_url;
   }
</script>