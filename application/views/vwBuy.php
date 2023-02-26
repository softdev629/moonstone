<?php
    $base_url=base_url();
?>
<script src="<?php echo $base_url; ?>assets/js/featured_plates_filter.js?v=123"></script>
<script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/product-details.js?v=123" type="text/javascript"></script>
<script src="<?php echo HTTP_ASSETS_PATH_CLIENT?>js/number_plates.js?v=123" type="text/javascript"></script>
<div class="container-fluid darkbg">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="row">
         <div class="col-md-12 col-12 align-self-center">
         <?php if($this->session->flashdata('payment_success')){ ?>
           <div class="alert alert-success" role="alert">
               <?php echo $this->session->flashdata('payment_success'); ?>
             </div>
         <?php } ?>
            <div class="h-top-title buy-right-m">
               <h3> <strong>GET STARTED FROM £330!</strong></h3>
               <p>Private registrations are a great way to personalise your vehicle, whether you want your plate to feature your initials, name, occupation or even hide the age of the vehicle, it's your choice. </P>
               <p>Unlike many of our competitors, the price you see is the price you pay for a ‘Moonstone’ plate. No hidden extra’s we have even included the VAT and assignment fee’s. We believe in being totally upfront with our customers, providing them with the best deal right from the start.</p> 
               
               <form class="app-search" action="<?php echo $base_url?>reg" method="get" class="search" role="search">
                  <span class="search-icon"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/search-icon.svg"></span>
                  <input type="text" name="search" id="search" maxlength="8" style="text-transform: uppercase;" class="form-control" placeholder="Search" oninput="myFunction()"> 
                  <button style="display: none;" type="submit" class="srh-btn"><i class="ti-search"></i></button>
               </form>
            </div>
         </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Start Page Content -->
      <!-- ============================================================== -->
      <!-- Row -->
      <div class="row">
         <!-- Column -->
         <div class="col-sm-12">
            <div class="car-slider buy-right-m">
               <div class="car-name">
                  <span data-target="#carouselExampleFade" data-slide-to="0" class="active"> BMW </span> |
                  <span data-target="#carouselExampleFade" data-slide-to="1">Porsche Panamera</span> |
                  <span data-target="#carouselExampleFade" data-slide-to="2">Mini Cooper</span> |
                  <span data-target="#carouselExampleFade" data-slide-to="3">Tesla</span>
               </div>
               <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                  <div class="carousel-inner">
                     <div class="carousel-item active slide1">
                        <span class="num-p-1" id="demo"></span>
                        <img class="s-web" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/banner.jpg">
                        <img class="s-mob" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/banner-m.jpg">
                     </div>
					 
					 <div class="carousel-item slide3">
                        <span class="num-p-1" id="demo1"></span>
                        <img class="s-web" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/banner27092021-1.jpg">
                        <img class="s-mob" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/banner27092021-1-m.jpg">
                     </div>
					 
                    
					 
					 
                     <div class="carousel-item slide4">
                        <span class="num-p-1" id="demo2"></span>
                        <img class="s-web" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/banner4.jpg">
                        <img class="s-mob" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/banner4-m.jpg">
                     </div>
                     <div class="carousel-item slide5">
                        <span class="num-p-1" id="demo3"></span>
                        <img class="s-web" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/banner5.jpg">
                        <img class="s-mob" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/banner5-m.jpg">
                     </div>
					 
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                  </a>
               </div>
            </div>
         </div>
         <!-- Column -->
      </div>
      <!-- Row -->
      <!-- ============================================================== -->
      <!-- End PAge Content -->
      <!-- ============================================================== -->
   </div>
   <!-- ============================================================== -->
   <!-- End Container fluid  -->
   <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
  <?php if($is_login == 'in_logged'): ?>
<!-- Sidebar scroll-->
   <div class="scroll-sidebar">
      <!-- Sidebar navigation-->      
      <div class="number-plates right-title">
         <h3>
            <span>Featured</span>
            Plates
         </h3>
        <?php 

if(is_array($cherished_plates_list) && count($cherished_plates_list) > 0) : ?>
          <div class="r-number-plates">
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                 <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                      <div class="r-num-plates-sec">
                        <?php foreach($cherished_plates_list as $key => $val): ?>
                           <div class="r-num-plate-box-inn featured_buy_pop_up" data-number="<?php echo $val['number']; ?>" data-price="<?php echo $val['price']; ?>" data-id="<?php echo $val['id']; ?>">
                              <?php echo $val['number']; ?>
                           </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                 </div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="r-number-plates">
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                 <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                    </div>
                 </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <div class="recommended right-title">
         <h3>
            <span>Recommended</span>
            Plates
         </h3>
         <div class="r-number-plates">
            <div class="panel-group" id="accordion">
               <div class="panel panel-default">
                  <div id="collapseOne" class="panel-collapse collapse in">
                     <div class="panel-body">
                       <?php if(is_array($recommended_number_plates) && count($recommended_number_plates) > 0) : ?>
                        <div class="r-num-plates-sec">
                          <?php foreach($recommended_number_plates as $key => $val): ?>    
                         	  <a href="/reg?search=<?php echo $val['number']; ?>">
                              <div class="r-num-plate-box-inn" >
                                <?php echo $val['number']; ?>
                             </div>
                            </a>                          
                          <?php endforeach; ?>
                        </div>
                       <?php else: ?>
                          <div class="r-number-plates">
                            <div class="panel-group" id="accordion">
                              <div class="panel panel-default">
                                 <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                    </div>
                                 </div>
                              </div>
                            </div>
                          </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<!-- End Sidebar navigation -->
<!-- End Sidebar scroll-->
<?php else: ?>
<div class="scroll-sidebar">
      <!-- Sidebar navigation-->
    <div class="recommended right-title">
       <h3>
          <span>Featured</span>
           Plates
       </h3>
       <div class="r-number-plates">
          <div class="panel-group" id="an_accordion">
             <div class="panel panel-default">
                <div id="collapseOne" class="panel-collapse collapse in">
                   <div class="panel-body">
				   <div class="r-num-plates-sec">
                     <?php if(is_array($cherished_plates_list) && count($cherished_plates_list) > 0) : ?>
                      <?php $i = 1; foreach($cherished_plates_list as $key => $val): ?>
                        
						
						 <div class="r-num-plate-box-inn featured_buy_pop_up" data-number="<?php echo $val['number']; ?>" data-price="<?php echo $val['price']; ?>" data-id="<?php echo $val['id']; ?>"><?php echo $val['number']; ?></div>
						
						
                      <?php $i++; endforeach; ?>
                     <?php else: ?>
                        <div class="r-number-plates">
                          <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                               <div id="collapseOne" class="panel-collapse collapse in">
                                  <div class="panel-body">
                                  </div>
                               </div>
                            </div>
                          </div>
                        </div>
                      <?php endif; ?>
					  </div>

                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
  </div>  
  <?php endif;?>
</aside>
</div>
<div class="bottom-section pt-0">
<div class="container">
<div class="row wow fadeInUp" data-wow-duration="1s">
   <div class="col-md-12">
      <h2><span>About</span> Private plates</h2>
   </div>
</div>
<div class="row">
   <div class="col-md-4 col-sm-12 r-line wow fadeInUp" data-wow-duration="2s">
      <div class="bottom-inn-sec-icon">
         <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/car-icon.png"/>
      </div>
      <div class="bottom-inn-sec">
         <?php echo $content_page->left_box_content; ?>
      </div>
   </div>
   <div class="col-md-4 col-sm-12 r-line wow fadeInUp" data-wow-duration="2s">
      <div class="bottom-inn-sec-icon"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/car-icon.png"/></div>
      <div class="bottom-inn-sec">
         <?php echo $content_page->center_box_content; ?>
      </div>
   </div>
   <div class="col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="2s">
      <div class="bottom-inn-sec-icon"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/car-icon.png"/></div>
      <div class="bottom-inn-sec">
         <?php echo $content_page->right_box_content; ?>
      </div>
   </div>
</div>
</div>
</div>
<div class="bottom-in-slider">
<!--	
<div class="container-fluid">
<div class="row">
   <div class="col-md-12">
      <h2 class="insta-post-main-title">TRENDING PLATES</h2>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="slider-top-field">
         <div class="slider-top-field-inner">
            <?php
            foreach ($categories as $fkey => $category_value) {
            ?>
            <a href="javascript:void(0);" onclick="return filter_featured_plates(<?php echo $fkey; ?>)"><?php echo $category_value ?></a> |
            <?php } ?>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div id="carouselExampleFade2" class="carousel slide carousel-fade" data-ride="carouse2">
         <div class="carousel-inner" id="add_featured_plates">
               <?php
                  $count = 1;
                  foreach ($featured_plates as $fkey => $featured_value) {
                  ?>
                  <?php
                  if ($count%4 == 1)
                   {  if($count==1){
                        echo '<div class="carousel-item active slide1"><div class="row">';
                      }else{
                        echo '<div class="carousel-item slide'.$count.'"><div class="row">';
                      }
                   }
                  ?>
                  <div class="col-md-3">
                     <div class="insta-post-sec">
                        <div class="insta-post-thumb"><img src="<?php echo $base_url; ?>\assets\uploads\featured_plates\<?php echo $featured_value['images_path']; ?>"/></div>
                        <div class="insta-post-thumb-bottom">
                           <div class="insta-post-thumb-bottom-left">
                              <div class="insta-title">
                                 <div class="insta-title-text"><?php echo $featured_value['name']; ?></div>
                                 <div class="insta-title-smalltext">@ jordanroddy | <span>2 mins ago</span></div>
                              </div>
                           </div>
                           <div class="insta-post-thumb-bottom-right">
                              <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/insta-icon.png"/>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
                  if ($count%4 == 0)
                   {
                       echo "</div></div>";
                   }
                  ?>
                  <?php  $count++; } ?>
                  <?php 
                  if ($count%4 != 1){?> 
                     </div></div>
                  <?php } ?>  
         </div>
      </div>   
   </div>
   --->
         <!-- <a class="carousel-control-prev" href="#carouselExampleFade2" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselExampleFade2" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
         </a> -->
      </div>
   </div>
</div>
</div>
</div>
<div class="bottom-feed-section">
<?php 
if(isset($instagramposts) && $instagramposts){
?>
<div class="container-fluid">
<div class="row wow fadeInDown" data-wow-duration="1s">
   <div class="col-md-12">
      <h2 class="insta-post-main-title">Instagram posts</h2>
   </div>
</div>
<div class="row i-tile">
      <?php
         function time_elapsed_string($datetime, $full = false) {
            $now = new DateTime;
            $ago = new DateTime($datetime);
            $diff = $now->diff($ago);
        
            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;
        
            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }
        
            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        }
         foreach($instagramposts as $post){
            $username = isset($post["username"]) ? $post["username"] : "";
            $caption = isset($post["caption"]) ? $post["caption"] : "";
            $media_url = isset($post["media_url"]) ? $post["media_url"] : "";
            $permalink = isset($post["permalink"]) ? $post["permalink"] : "";
            $media_type = isset($post["media_type"]) ? $post["media_type"] : "";
            $timestamp = isset($post["timestamp"]) ? $post["timestamp"] : "";
            $ago =  time_elapsed_string($timestamp);
            ?>
            <div class="col-md-3 col-sm-12 wow fadeInRight" data-wow-delay="0.1s">
               <div class="insta-post-sec">
                  <div class="insta-post-thumb">
                     <?php 
                        if($media_type=="VIDEO")
                        { 
                           echo "<video controls style='width:100%; display: block !important;'>
                           <source src='{$media_url}' type='video/mp4'>
                           Your browser does not support the video tag.
                           </video>";
                        }
                        else
                        {
                           echo "<img src='{$media_url}'/>";
                        }
                     ?>
                  </div>
                  <div class="insta-post-thumb-bottom">
                     <div class="insta-post-thumb-bottom-left">
                        <div class="insta-id">
                           <div class="insta-id-inn">MT</div>
                        </div>
                        <div class="insta-title">
                           <div class="insta-title-text"><?php echo $username?></div>
                           <div class="insta-title-smalltext">@ <?php echo $username ?> | <span><?php echo $ago?></span></div>
                        </div>
                     </div>
                     <div class="insta-post-thumb-bottom-right"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/insta-icon.png"/></div>
                  </div>
               </div>
            </div>
            <?php
         }

      ?>
</div>
<?php } ?>
</div>
</div>
<!--
<div class="container-fluid">
<div class="row wow fadeInDown" data-wow-duration="1s">
   <div class="col-md-12">
      <h2 class="insta-post-main-title">Instagram posts</h2>
   </div>
</div>
<div class="row i-tile">
   <div class="col-md-3 col-sm-12 wow fadeInRight" data-wow-delay="0.1s">
      <div class="insta-post-sec">
         <div class="insta-post-thumb"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/t1.jpg"/></div>
         <div class="insta-post-thumb-bottom">
            <div class="insta-post-thumb-bottom-left">
               <div class="insta-id">
                  <div class="insta-id-inn">MT</div>
               </div>
               <div class="insta-title">
                  <div class="insta-title-text">Jordan Roddy</div>
                  <div class="insta-title-smalltext">@ jordanroddy | <span>2 mins ago</span></div>
               </div>
            </div>
            <div class="insta-post-thumb-bottom-right"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/insta-icon.png"/></div>
         </div>
      </div>
   </div>
   <div class="col-md-3 col-sm-12 wow fadeInRight" data-wow-delay="0.2s">
      <div class="insta-post-sec">
         <div class="insta-post-thumb"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/t2.jpg"/></div>
         <div class="insta-post-thumb-bottom">
            <div class="insta-post-thumb-bottom-left">
               <div class="insta-id">
                  <div class="insta-id-inn">MT</div>
               </div>
               <div class="insta-title">
                  <div class="insta-title-text">Jordan Roddy</div>
                  <div class="insta-title-smalltext">@ jordanroddy | <span>2 mins ago</span></div>
               </div>
            </div>
            <div class="insta-post-thumb-bottom-right"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/insta-icon.png"/></div>
         </div>
      </div>
   </div>
   <div class="col-md-3 col-sm-12 wow fadeInRight" data-wow-delay="0.3s">
      <div class="insta-post-sec">
         <div class="insta-post-thumb"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/t3.jpg"/></div>
         <div class="insta-post-thumb-bottom">
            <div class="insta-post-thumb-bottom-left">
               <div class="insta-id">
                  <div class="insta-id-inn">MT</div>
               </div>
               <div class="insta-title">
                  <div class="insta-title-text">Jordan Roddy</div>
                  <div class="insta-title-smalltext">@ jordanroddy | <span>2 mins ago</span></div>
               </div>
            </div>
            <div class="insta-post-thumb-bottom-right"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/insta-icon.png"/></div>
         </div>
      </div>
   </div>
   <div class="col-md-3 col-sm-12 wow fadeInRight" data-wow-delay="0.4s">
      <div class="insta-post-sec">
         <div class="insta-post-thumb"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/t4.jpg"/></div>
         <div class="insta-post-thumb-bottom">
            <div class="insta-post-thumb-bottom-left">
               <div class="insta-id">
                  <div class="insta-id-inn">MT</div>
               </div>
               <div class="insta-title">
                  <div class="insta-title-text">Jordan Roddy</div>
                  <div class="insta-title-smalltext">@ jordanroddy | <span>2 mins ago</span></div>
               </div>
            </div>
            <div class="insta-post-thumb-bottom-right"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/insta-icon.png"/></div>
         </div>
      </div>
   </div>
</div>
<div class="row i-tile">
   <div class="col-md-3 col-sm-12 wow fadeInRight" data-wow-delay="0.5s">
      <div class="insta-post-sec">
         <div class="insta-post-thumb"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/fp5.png"/></div>
         <div class="insta-post-thumb-bottom">
            <div class="insta-post-thumb-bottom-left">
               <div class="insta-id">
                  <div class="insta-id-inn">MT</div>
               </div>
               <div class="insta-title">
                  <div class="insta-title-text">Jordan Roddy</div>
                  <div class="insta-title-smalltext">@ jordanroddy | <span>2 mins ago</span></div>
               </div>
            </div>
            <div class="insta-post-thumb-bottom-right"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/insta-icon.png"/></div>
         </div>
      </div>
   </div>
   <div class="col-md-3 col-sm-12 wow fadeInRight" data-wow-delay="0.6s">
      <div class="insta-post-sec">
         <div class="insta-post-thumb"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/fp6.png"/></div>
         <div class="insta-post-thumb-bottom">
            <div class="insta-post-thumb-bottom-left">
               <div class="insta-id">
                  <div class="insta-id-inn">MT</div>
               </div>
               <div class="insta-title">
                  <div class="insta-title-text">Jordan Roddy</div>
                  <div class="insta-title-smalltext">@ jordanroddy | <span>2 mins ago</span></div>
               </div>
            </div>
            <div class="insta-post-thumb-bottom-right"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/insta-icon.png"/></div>
         </div>
      </div>
   </div>
   <div class="col-md-3 col-sm-12 wow fadeInRight" data-wow-delay="0.7s">
      <div class="insta-post-sec">
         <div class="insta-post-thumb"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/fp7.png"/></div>
         <div class="insta-post-thumb-bottom">
            <div class="insta-post-thumb-bottom-left">
               <div class="insta-id">
                  <div class="insta-id-inn">MT</div>
               </div>
               <div class="insta-title">
                  <div class="insta-title-text">Jordan Roddy</div>
                  <div class="insta-title-smalltext">@ jordanroddy | <span>2 mins ago</span></div>
               </div>
            </div>
            <div class="insta-post-thumb-bottom-right"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/insta-icon.png"/></div>
         </div>
      </div>
   </div>
   <div class="col-md-3 col-sm-12 wow fadeInRight" data-wow-delay="0.8s">
      <div class="insta-post-sec">
         <div class="insta-post-thumb"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/fp8.png"/></div>
         <div class="insta-post-thumb-bottom">
            <div class="insta-post-thumb-bottom-left">
               <div class="insta-id">
                  <div class="insta-id-inn">MT</div>
               </div>
               <div class="insta-title">
                  <div class="insta-title-text">Jordan Roddy</div>
                  <div class="insta-title-smalltext">@ jordanroddy | <span>2 mins ago</span></div>
               </div>
            </div>
            <div class="insta-post-thumb-bottom-right"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/insta-icon.png"/></div>
         </div>
      </div>
   </div>
</div>
</div>
-->