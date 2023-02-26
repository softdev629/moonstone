<!DOCTYPE html>
<html class="fsvs" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv='cache-control' content='no-cache'>
      <meta http-equiv='expires' content='0'>
      <meta http-equiv='pragma' content='no-cache'>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Tell the browser to be responsive to screen width -->
      <?php if(isset($currentPage) && $currentPage == 20){ ?>
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta property="og:locale" content="en_US" />
         <meta property="og:type" content="article" />
         <meta property="og:title" content="Moonstone" />
         <meta property="og:description" content="<?php print $description; ?>" />
         <meta property="og:url" content="<?php echo base_url(); ?>/number-plate/social-share/<?php echo $plate_id . '/' . $search . '/' . $plate_type ; ?>" />
         <meta property="og:site_name" content="Moonstone" />
         <meta property="og:image" content="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/modal-thumb.jpg" />
         <meta property="og:image:width" content="574" />
         <meta property="og:image:height" content="339" />
         <meta name="twitter:site" content="@Moonstone" />
         <meta name="twitter:card" content="summary_large_image" />
         <meta name="twitter:url" content="<?php echo base_url(); ?>/number-plate/social-share/<?php echo $plate_id . '/' . $search . '/' . $plate_type ; ?>" />
         <meta name="twitter:title" content="Moonstone" />
         <meta name="twitter:image" content="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/modal-thumb.jpg" />
         <meta name="twitter:description" content="<?php print $description; ?>" />
      <?php } else { ?>  
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="description" content="">
         <meta name="author" content="Surya" >
      <?php } ?>
      <!-- Favicon icon -->
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/favicon.png">
      <title>Moonstone</title>
           
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>css/framework.min.css" rel="stylesheet">   
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>css/styles.min.css" rel="stylesheet">   
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/fontawesome/css/all.min.css" rel="stylesheet">   
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/fontawesome/css/v4-shims.css" rel="stylesheet">   
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/fsvs-slider/css/style.css" rel="stylesheet">   
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/slick/slick.css" rel="stylesheet">   
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/slick/slick-theme.css" rel="stylesheet">   
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/mmenu/mmenu.css" rel="stylesheet">   
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/fancybox/jquery.fancybox.min.css" rel="stylesheet">   

      <!-- Bootstrap tether Core JavaScript -->
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/jquery.min.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/custom.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/newsletter_subscribe.js" type="text/javascript"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
      <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

      <script type="text/javascript">
      $(document).ready(function() {

         function SetCookieNoreload(c_name,value,expiredays)
          {
              var exdate=new Date();
              exdate.setDate(exdate.getDate()+expiredays)
              document.cookie=c_name+ "=" +escape(value)+
              ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
          }
           
          $('#add_sign_up_modal').click(function(){
            SetCookieNoreload('register_modal','1','-1');
            //  $('#advertiseModal').modal('hide');
             $('#registerModal').modal('show');
          });
          $('#not_modal').click(function(){
            SetCookieNoreload('register_modal','1','-1');
            //  $('#advertiseModal').modal('hide');
          });
      });
     </script>
     
     <?php 
      $cookie_name = "register_modal";
      if (isset($_COOKIE[$cookie_name]) && !empty($_COOKIE[$cookie_name])) {
          $my_modal_cookie = '1';
      }
      else {
          $my_modal_cookie = '0';
      }
      // $my_modal_cookie = '0';
      // print_r($my_modal_cookie);
      // die();
     if (!$this->session->userdata('is_client_login') && $my_modal_cookie=='0'){
     ?>
     
   <?php } ?>
   
   </head>

   <body>

   <input type="hidden" name="base_url" id="base_url" value="<?=base_url();?>">

  <header id="site_header">

    <div class="container-fluid">

      <div class="row middle-xs">

        <div class="col-xs-4 hide-for-md-up">
          <ul class="site-buttons">
            <li class="icn-only">
              <a id="mmenu_toggle" href="#menu">
                <i class="fa-solid fa-solid fa-bars"></i>
              </a>
            </li>
          </ul>
        </div>

        <div class="col-xs-4 col-md-3 center-xs start-md">
          <a href="index.html">
            <img class="site-logo" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>img/site-logo.png" alt="Moonstone Plates Logo">
          </a>
        </div>

        <div class="col-xs-4 col-md-6 center-xs hide-for-sm-down">
          <ul class="site-menu">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo base_url(); ?>buy">Buy</a></li>
            <li><a href="<?php echo base_url(); ?>sell">Sell</a></li>
            <li><a href="<?php echo base_url(); ?>help-services">Help & Services</a></li>
            <li><a href="<?php echo base_url(); ?>blog">Blog</a></li>
            <li><a href="<?php echo base_url(); ?>contactus">Contact</a></li>
          </ul>
        </div>

        <div class="col-xs-4 col-md-3 end-xs">
          <ul class="site-buttons">
            <li class="hide-for-xs-only mr-2">
              <a href="#newsletter_pop" data-fancybox>
                <span class="hide-for-xs-only">SUBCRIBE</span>
                <span class="hide-for-sm-up">
                  <i class="fa-light fa-envelope"></i>
                </span>
              </a>
            </li>
            <li>
              <a href="#login_pop" data-fancybox>
                <span class="hide-for-xs-only">Login</span>
                <span class="hide-for-sm-up">
                  <i class="fa-light fa-user"></i>
                </span>
              </a>
            </li>
          </ul>
        </div>

      </div>

    </div>

  </header>

