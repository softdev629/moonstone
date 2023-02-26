<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
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
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT;?>css/dark-theme.css" rel="stylesheet">
      <!-- Bootstrap Core CSS -->
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT;?>css/bootstrap.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700|Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>css/simple_social_share.css">
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT;?>css/style.css" rel="stylesheet">
      <link href="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>css/custom.css" rel="stylesheet">
      <link rel='stylesheet' href='https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css'>
      <link rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/jquery.fancybox.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/jquery.fancybox-buttons.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="<?=HTTP_ASSETS_PATH_CLIENT?>css/jquery.fancybox-thumbs.css" type="text/css" media="screen" />

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_CLIENT;?>css/jquery.mCustomScrollbar.css">
      <!-- Bootstrap tether Core JavaScript -->
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/jquery.min.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>plugins/bootstrap/js/tether.min.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>plugins/bootstrap/js/bootstrap.min.js"></script>
      <!-- slimscrollbar scrollbar JavaScript -->
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/jquery.slimscroll.js"></script>
      <!--Wave Effects -->
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/waves.js"></script>
      <!--stickey kit -->
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
      <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>js/simple_social_share.js"></script>
      <!--Custom JavaScript -->
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/custom.js"></script>
      <script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/newsletter_subscribe.js" type="text/javascript"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="<?=HTTP_ASSETS_PATH_CLIENT?>js/jquery.fancybox.js" type="text/javascript"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN;?>js/jquery.validate.min.js" type="text/javascript"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN;?>js/additional-methods.min.js"></script>
      <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>js/jquery.bootstrap-growl.min.js"></script>
      <script type="text/javascript" src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>js/simple_social_share.js"></script>
      <script>
         (function($){
            $(window).on("load",function(){
               
               $("#myModal .modal-body").mCustomScrollbar({
                  setHeight:300,
                  theme:"minimal-dark"
               });
               
               $("#accordion .panel-body").mCustomScrollbar({
                  setHeight:380,
                  theme:"dark-3"
               });

               $("#an_accordion .panel-body").mCustomScrollbar({
                  setHeight:855,
                  theme:"dark-3"
               });
               
               $("#myTab .tab-pane").mCustomScrollbar({
                  setHeight:240,
                  theme:"inset-2-dark"
               });
               
               $('.carousel').carousel('pause');
               
            });
         })(jQuery);
      </script>
      <script>
   function myFunction() {
     var x = document.getElementById("search").value;
     document.getElementById("demo").innerHTML = "" + x;
     var x = document.getElementById("search").value;
     document.getElementById("demo1").innerHTML = "" + x;
     var x = document.getElementById("search").value;
     document.getElementById("demo2").innerHTML = "" + x;
     var x = document.getElementById("search").value;
     document.getElementById("demo3").innerHTML = "" + x;
     
   }
   
</script> 
      <script  src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/animation.js"></script>
<script>
        (function(w, d, s, o, f, js, fjs) {
            w["Targetbox-Trees-Widget"] = o;
            w[o] = w[o] || function() {
              (w[o].q = w[o].q || []).push(arguments);
            };
            (js = d.createElement(s)), (fjs = d.getElementsByTagName(s)[0]);
            js.id = o;
            js.src = f;
            js.async = 1;
            fjs.parentNode.insertBefore(js, fjs);
        })(window, document, "script", "mw", "https://widget-v1.reviewforest.org/scripts.js");
        mw("amount", {
          id: "60ddaa5de77cac8c1052fc21",
          location: "60ddaa5e6e86b7ddedbecdf6",
          name: "Moonstone Plates Ltd",
          url: "https://reviewforest.org/moonstoneplates",
          language: "en",
          types: "['floating']",
          position: "bottom-left"
        });
</script>
<?php 
      $cookie_name = "register_modal";
      $cookie_value = "1";
      if (isset($_COOKIE[$cookie_name]) && !empty($_COOKIE[$cookie_name])) {
          $my_modal_cookie = '1';
      }
      else {
          $my_modal_cookie = '0';
      }

     if (!$this->session->userdata('is_client_login') && $my_modal_cookie=='0'){
     ?>
     <script type="text/javascript">
      $(document).ready(function() {

         function SetCookieNoreload(c_name,value,expiredays)
          {
              var exdate=new Date();
              exdate.setDate(exdate.getDate()+expiredays)
              document.cookie=c_name+ "=" +escape(value)+
              ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
          }
           setTimeout(function () {
               $('#advertiseModal').modal('show');
           }, 15000);

          $('#add_sign_up_modal').click(function(){
            SetCookieNoreload('register_modal','1','-1');
             $('#advertiseModal').modal('hide');
             $('#registerModal').modal('show');
          });
          $('#add_login_modal').click(function(){
            SetCookieNoreload('register_modal','1','-1');
             $('#advertiseModal').modal('hide');
             $('#loginModal').modal('show');
          });
          $('#all_login_modal').click(function(){
            SetCookieNoreload('register_modal','1','-1');
             $('#advertiseModal').modal('hide');
             $('#loginModal').modal('show');
          });
          $('#not_modal').click(function(){
            SetCookieNoreload('register_modal','1','-1');
             $('#advertiseModal').modal('hide');
          });
      });
     </script>
   <?php } ?>
   <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-218087533-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-218087533-1');
</script>

   </head>
   <body class="fix-header fix-sidebar card-no-border darktheme <?php echo $is_login; ?>">
      <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
      <!-- ============================================================== -->
      <!-- Preloader - style you can find in spinners.css -->
      <!-- ============================================================== -->
      <div class="preloader">
         <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
         </svg>
      </div>
      <!-- ============================================================== -->
      <!-- Main wrapper - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <div id="main-wrapper" style="height:auto;background: #0e0e0e !important;">
      <div class="page-wrapper mr-0">
      <header class="topbar">
         <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
               <a class="navbar-brand" href="<?php echo base_url(); ?>">
                  <!-- Logo text -->
                  <span>
                     <!-- dark Logo text -->
                     <img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>images/logo-white.svg" alt="homepage" class="dark-logo" />
                  </span>
               </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- <div class="navmenu" id="myTopnav">
               <a href="#">buy</a>
               <a href="#">sell</a>
               <a href="#">help & services</a>
               <a href="#">classic & vintage</a>
               <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                  <i class="fa fa-bars"></i>
                 </a>
               </div> -->
            <div class="mainMenu">
               <label for="toggleMenu" class="menuTitle" onclick=""></label>
               <input type="checkbox" id="toggleMenu" />
               <ul>
                  <li><a href="<?php echo base_url(); ?>buy">buy</a></li>
                  <li class="black">|</li>
                  <li><a href="<?php echo base_url(); ?>sell">sell</a></li>
                  <li class="black">|</li>
                  <li><a href="<?php echo base_url(); ?>help-services">help & services</a></li>
                  <li class="black">|</li>
                  <li><a href="<?php echo base_url(); ?>contactus">Contact Us</a></li>
				  <?php if($this->session->userdata('is_client_login')) { 
                     $client_login=$this->session->userdata('client_login');
                  ?>
                  <li class="contactus"><a href="<?php echo base_url(); ?>my-orders"><?php echo $client_login['name'] ?></a></li>
                  <?php }else{ ?>
                  <li class="contactus"><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
                  <?php } ?>
               </ul>
            </div>
         </nav>
      </header>
