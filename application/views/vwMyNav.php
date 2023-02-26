<div class="order-l-menu">
 <nav class="o-navbar" role="navigation">
 <?php
    $this->load->helper('common_helper');
    $sell_count=get_sell_count();
 ?>  
       <div class="menu-container js_nav-item">
       </div>
       <input type="checkbox" name="toggle" id="toggle"/>
       <label for="navbar-toggle"></label>
       <div class="menu-mobile">
           <div class="collapse navbar-collapse nav-collapse ">
               <div class="menu-container">
                   <ul class="nav navbar-nav container-right ">
                       <li class="js_nav-item nav-item">
                         <a class="nav-item-child" href="<?php echo base_url(); ?>my-orders">My Orders <span class="arrow arrow-right"></span></a>
                       </li>
                       
                       <li class="js_nav-item nav-item">
                         <a class="nav-item-child" href="<?php echo base_url(); ?>sell/history">Sell History <span class="arrow arrow-right"></span></a>
                       </li>
                       <li class="js_nav-item nav-item">
                         <a class="nav-item-child" href="<?php echo base_url(); ?>my-favorite">My Favorites <span class="arrow arrow-right"></span></a>
                       </li>
                       <li class="js_nav-item nav-item">
                         <a class="nav-item-child" href="<?php echo base_url(); ?>logout">Logout<span class="arrow arrow-right"></span></a>
                       </li>
                       
                   </ul>
               </div>
           </div>
      </div>
   
</nav>
</div>