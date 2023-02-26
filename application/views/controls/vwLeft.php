<?php
$this->load->model('Faqs_model','faqs');
$faqs_list=$this->faqs->get_faqs_list();
?>
<div class="col-md-3">
   <div class="l-search wow fadeInUp" data-wow-duration="1s">
      <form>
         <span class="search-icon"><img src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>images/search-icon.svg"></span>
         <input type="text" id="faqSearch" class="form-control" placeholder="Search"> 
         <a class="srh-btn"><i class="ti-search"></i></a>
         <ul class="search-dropdown" style="display: none;">
          <?php
            foreach ($faqs_list as $key => $faq_value) {
            ?>
               <li><a href="<?php echo base_url().'faqs/'.$faq_value->id ?>"><?php echo $faq_value->question; ?></a></li>
           <?php } ?>
         </ul>
      </form>
   </div>
   <ul class="nav nav-tabs wow fadeInUp" data-wow-duration="1s">
      <li class="nav-item">
         <a class="nav-link <?php if($page=="Faqs"){ ?> active <?php } ?>" href="<?php echo base_url(); ?>faqs">FAQs</a>
      </li>
      <li class="nav-item">
         <a class="nav-link <?php if($page=="Buyer Guide"){ ?> active <?php } ?>" href="<?php echo base_url(); ?>buyer-guide">Buyer's Guide</a>
      </li>
      <li class="nav-item">
         <a class="nav-link <?php if($page=="Sellers Guide"){ ?> active <?php } ?>" href="<?php echo base_url(); ?>sellers-guide">Seller's Guide</a>
      </li>
      <li class="nav-item">
         <a class="nav-link <?php if($page=="DVLA Information"){ ?> active <?php } ?>" href="<?php echo base_url(); ?>dvla-information">DVLA Information</a>
      </li>
      <!-- <li class="nav-item">
         <a class="nav-link <?php if($page=="About New Register"){ ?> active <?php } ?>" href="<?php echo base_url(); ?>about-new-register">About New Reg</a>
      </li> -->
      <li class="nav-item">
         <a class="nav-link <?php if($page=="About Us"){ ?> active <?php } ?>" href="<?php echo base_url(); ?>about-us">About Us</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="<?php echo base_url(); ?>contactus">Contact Us</a>
      </li>
   </ul>
</div>