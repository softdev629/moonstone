<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>images/favicon.ico" type="image/x-icon">
      <title>Moonstone</title>
      <link href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/style.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>css/custom.css" rel="stylesheet" type="text/css" />
      <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
      <script>
      var resizefunc = [];
      </script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.min.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/tether.min.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/bootstrap.min.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/waves.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/switchery.min.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.waypoints.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.counterup.min.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.core.js"></script>
      <!-- <script src="<?php //echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.app.js?v123"></script> -->
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/jquery.validate.min.js" type="text/javascript"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/additional-methods.min.js"></script>
      <script src="//cdn.ckeditor.com/4.5.2/full/ckeditor.js"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
      <script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>js/common.js"></script>
	  <style>
		.notification-icon{float:right!important;}
		.notification-icon a{line-height:70px!important; font-size: 24px; position: relative;}
		.notification-count{position: absolute; z-index: 1; top: -6px; right: -4px; border-radius: 2px; background: #fff; font-size: 12px; line-height: 12px; padding-top: 2px; padding-bottom: 2px; text-align: center; padding-left: 4px;padding-right: 4px;}
		.notification-disabled{color: #868686;}
	  </style>
   </head>
<body class="fixed-left">
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<div id="wrapper">
<div class="topbar">
 <div class="topbar-left">
    <a href="<?php echo base_url(); ?>admin" class="logo">
    <span class="icon-c-logo"><img src="<?php echo base_url(); ?>assets/admin/images/logo-icon.svg" alt="logo"></span>
    <span class="logo-text"><img src="<?php echo base_url(); ?>assets/admin/images/logo-black.svg" alt="logo"></span>
    </a>
 </div>
 <nav class="navbar navbar-custom">
    <ul class="nav navbar-nav">
       <li class="nav-item">
          <button class="button-menu-mobile open-left waves-light waves-effect">
          <i class="zmdi zmdi-menu"></i>
          </button>
       </li>
       <li class="nav-item hidden-mobile">
          <form role="search" class="app-search">
             <input type="text" placeholder="Search..." class="form-control">
             <a href=""><i class="fa fa-search"></i></a>
          </form>
       </li>
       <?php
         $this->load->helper('common_helper');
        $count_notification=get_notification_count();

      ?>
      <?php
      if($count_notification>0){
      ?>
      <li class="nav-item notification-icon">
          <a href="<?php echo base_url(); ?>admin/notification" title="Unread">
          <?php
         if($count_notification>10){
         ?>
		    <span class="notification-count">10+</span>
         <?php }else{ ?>
         <span class="notification-count"><?php echo $count_notification;?></span>
         <?php } ?>
          <i class="zmdi zmdi zmdi-notifications zmd-fw"></i>
          </a>
       </li>
      <?php
      }else{
      ?>
       <li class="nav-item notification-icon">
          <a class="notification-disabled" href="<?php echo base_url(); ?>admin/notification" title="All">
          <i class="zmdi zmdi-notifications-none zmd-fw"></i>
          </a>
       </li>
    <?php } ?>
    </ul>
 </nav>
</div>