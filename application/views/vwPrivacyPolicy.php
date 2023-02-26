<?php
$cookie_name = "anyname";
$cookie_value = "anycontent";
if (isset($_COOKIE[$cookie_name]) && !empty($_COOKIE[$cookie_name])) {
    $my_cookie = '1';
}
else {
    $my_cookie = '0';
}
$currPage = array('10', '11');
?>
<div class="about-sec">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="tab-content wow fadeInUp" data-wow-duration="1s">
               <div class="tab-pane container active" id="faqs">
                  <h1><?php echo $content->page_name; ?></h1>
                  <?php echo $content->page_description; ?>
                  <?php if($my_cookie == '0' && in_array($currentPage, $currPage)):  ?>
                  <br /><br />   
                  <button type="button" class="br-brd-btn" id="req_btn"><a href="<?php echo base_url() ?>" style="color:#000000!important;" onClick="SetOurCookie('anyname','anycontent','-1')">Accept</a></button>
                  <button type="button" class="br-brd-btn" id="req_btn"><a href="<?php echo base_url(); ?>" style="color:#000000!important;">Reject</a></button>
                  <script>
                   function SetOurCookie(c_name,value,expiredays)
                       {
                           var exdate=new Date()
                           exdate.setDate(exdate.getDate()+expiredays)
                           document.cookie=c_name+ "=" +escape(value)+
                           ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
                        window.location.href="'<?php echo base_url() ?>'";
                       }
                   </script>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>