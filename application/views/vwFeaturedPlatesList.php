<?php
    $base_url=base_url();

?>
<?php
if(count($featured_plates)>0){
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
      <div class="insta-post-thumb"><img src="<?php echo $base_url; ?>\assets\uploads\featured_plates\<?php echo $featured_value->images_path; ?>"/></div>
      <div class="insta-post-thumb-bottom">
         <div class="insta-post-thumb-bottom-left">
            <div class="insta-title">
               <div class="insta-title-text"><?php echo $featured_value->name; ?></div>
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
<?php } 
}
?>  