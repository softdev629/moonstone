<style type="text/css">
  .facebook-feed-user-root-container {
    display: none;
}
</style>
<?php
$about_content=$this->content->get_static_page_by_id(7);
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
<?php if($my_cookie == '0' && !in_array($currentPage, $currPage)):  ?>
<div class="alert alert-warning alert-dismissible fade show cookiepop" role="alert">
  <h5 class="modal-title">Cookies Policy</h5>
  <p>At Moonstone Plates, we want to ensure that your visit to our site is smooth, reliable and as useful to you as possible. To help us do this, we use cookies.</p>
  <button type="button" class="close cbtn" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <div class="btn-sec">
  <a href="" onClick="SetCookie('anyname','anycontent','-1')"><button type="submit" class="brd-btn">Accept</button></a>
  <a href="<?php echo base_url() . 'cookies-policy' ; ?>"><button type="submit" class="brd-btn">View Cookie Policy</button></a>
  <a href="<?php echo base_url() . 'web-policy' ; ?>"><button type="submit" class="brd-btn">View Privacy Policy</button></a>
  </div>
</div>
<script>
    function SetCookie(c_name,value,expiredays)
    {
        var exdate=new Date()
        exdate.setDate(exdate.getDate()+expiredays)
        document.cookie=c_name+ "=" +escape(value)+
        ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
        location.reload()
    }
</script>

<?php endif; ?>
<style>
.error{width:100%; text-align: left; color: red;}
</style>


<footer id="site_footer">

<div class="container-fluid wrapper">
   <div class="row">
   <div class="col-xs-12 col-md-6 center-xs start-md mb-1 mb-sm-0">

      <ul class="footer-logos">
         <li><img src="<?php echo HTTP_ASSETS_PATH_CLIENT;?>img/rmi.png" /></li>
      </ul>

   </div>
   <div class="col-xs-12 col-md-6 center-xs end-md">

      <ul>
         <li>Terms & Conditions</li>
         <li>Privacy Policy</li>
      </ul>

      <p>Copyright© 2020 moonstoneplate. All rights reserved.</p>

   </div>
   </div>
</div>

</footer>


</div>

</div>


<nav id="mmenu_nav">
  <div class="nav-wrapper">
    <a id="mmenu_close" href="#menu">
      <i class="fa-regular fa-xmark"></i>
    </a>
    <div class="nav-wrapper-inner">
      <h4>Menu</h4>
      <ul>
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url(); ?>buy">Buy</a></li>
        <li><a href="<?php echo base_url(); ?>sell">Sell</a></li>
        <li><a href="<?php echo base_url(); ?>help-services">Help & Services</a></li>
        <li><a href="<?php echo base_url(); ?>blog">Blog</a></li>
        <li><a href="<?php echo base_url(); ?>contactus">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="newsletter_pop" class="typography fb-popup" style="display:none; width:90%; max-width: 600px;">
  <div class="newsletter-wrapper">



    <form id="FormNewslatter" class="newslatter" name="FormNewslatter" action="#" method="POST" onsubmit="return chkNewslatter()">

      <div class="row">

        <div class="col-xs-12">
          <h2 class="mt-0 mb-3">Subscribe to our Newsletter</h2>
        </div>

        <div class="col-xs-12">

          <div class="ffield">
            <label for="texytEmail">Email Address</label>
            <input name="texytEmail" id="texytEmail" type="text" placeholder="Your email address" onfocus="clearText(this.id,'','Please enter your email','form-control focus'); clearText(this.id,'','Please enter your valid email','form-control focus');" onblur="FillText(this.id,'','form-control');duplicate_email(this.value);"/>
          </div>

        </div>


      </div>

      <button id="btn-submit" class="submit-button" type="submit">Subscribe</button>

    </form>

  </div>
</div>

<div id="login_pop" class="typography fb-popup" style="display:none; width:90%; max-width: 600px;">

  <div class="login-wrapper">

    <form action="<?php echo base_url(); ?>login-check" id="login-form" method="post">

      <div class="row">

        <div class="col-xs-12">

          <h2 class="mt-0 mb-3">Login</h2>

        </div>

        <div class="col-xs-12">

          <div class="ffield">
            <label for="username">Email Address</label>
            <input id="email" type="text" placeholder="Email address" name="email" />
          </div>

        </div>

        <div class="col-xs-12">

          <div class="ffield">
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Password" name="password" />
          </div>

        </div>


      </div>

      <p>Don't have an account? <a href="#registerModal" id="add_sign_up_modal" data-fancybox>Sign up here.</a></p>

      <button class="submit-button" type="submit">Login</button>

    </form>

  </div>
</div>

<div id="registerModal" class="typography fb-popup" style="display:none; width:90%; max-width: 600px;">

  <div class="login-wrapper">

    <form action="<?php echo base_url(); ?>user-register" id="register-form" method="post">

      <div class="row">

        <div class="col-xs-12">

          <h2 class="mt-0 mb-3">SignUp</h2>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="name">FIRST NAME</label>
            <input id="name" type="text" placeholder="First name" name="name" />
          </div>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="lastname">LAST NAME</label>
            <input id="lastname" type="text" placeholder="Last name" name="lastname" />
          </div>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="phone_number">PHONE NUMBER</label>
            <input id="phone_number" type="text" placeholder="Phone number" name="phone_number" />
          </div>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="address">ADDRESS</label>
            <input id="address" type="text" placeholder="Address" name="address" />
          </div>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="country">COUNTRY</label>
            <input id="country" type="text" placeholder="United Kingdom" name="country" value="United Kingdom"/>
          </div>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="city">CITY</label>
            <input id="city" type="text" placeholder="City" name="city"/>
          </div>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="zip">POSTAL CODE</label>
            <input id="zip" type="text" placeholder="Postal code" name="zip"/>
          </div>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="email">EMAIL</label>
            <input id="email" type="email" placeholder="Email" name="email"/>
          </div>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="password">PASSWORD</label>
            <input id="password" type="password" placeholder="Password" name="password" />
          </div>

        </div>

        <div class="col-xs-6">

          <div class="ffield">
            <label for="confirm_password">CONFIRM PASSWORD</label>
            <input id="confirm_password" type="password" placeholder="Confirm password" name="confirm_password" />
          </div>

        </div>


      </div>

      <button class="submit-button" type="submit">Submit</button>

    </form>

  </div>
</div>

<!-- <div class="modal register" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
  
  <div class="modal-header">
        <h5 class="modal-title" style="color: black; margin-top: 0; ">Sign Up</h5>
    
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     
      </div>
    
    
      <div class="modal-body">
       
        <div class="text-center m-t-20 m-b-20">
            <a href="index.html" class="logo">
                <img src="http://development.moonstoneplates.com/assets/images/logo-black.svg" alt="logo">
            </a>
        </div>
    
    <h2 class="l-title m-b-30"><strong>Signup</strong></h2>
    
        <div class="m-b-20">
              <form class="form-default" action="<?php echo base_url(); ?>user-register" id="register-form">
                  <div class="row">
                      <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="name" id="name" required="" placeholder="Name">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="lastname" id="lastname" required="" placeholder="Last name">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="phone_number" id="phone_number" required="" placeholder="Phone number">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="address" id="address" required="" placeholder="Address">
                      </div>
            <div class="col-md-6 mb-3">
                              <select class="form-control custome-control" name="country" id="country" required="">
                                  <option value="GB">United Kingdom</option>
                              </select>
                      </div>
            <div class="col-md-6 mb-3 ">
                          <input class="form-control" type="text" name="city" id="city" required="" placeholder="City">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="text" name="zip" id="zip" required="" placeholder="Postal code">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="email" name="email" id="email" required="" placeholder="Email">
                      </div>
            <div class="col-md-6 mb-3">
                          <input class="form-control" type="password" name="password" id="password" required="" placeholder="Password">
                      </div>
             <div class="col-md-6 mb-3">
                          <input class="form-control" type="password" name="confirm_password" id="confirm_password" required="" placeholder="Confirm password">
                      </div>
                  </div>
                   <div class="col-md-12 mb-3">
                        <input class="form-check-input" type="checkbox" id="is_marketing_enable" name="is_marketing_enable" value="2">
                        <label class="form-check-label" for="is_marketing_enable"><p>If you do not want to receive marketing emails & updates, please tick the opt out box.</p></label>

                   </div>
                
                  <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
              
                          <input type="submit" style="border-radius:0;" name="submit" class="btn btn-styled black-btn" value="Submit">
              
              <button type="button" style="border-radius:0;" class="btn btn-styled black-brd-btn"><a style="text-decoration: none; color: #000;" href="javascript:void(0);" data-dismiss="modal" aria-label="Close">Close</a></button>
                      </div>
                  </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div> -->

<script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/mmenu/mmenu.js" type="text/javascript"></script>
<script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/fancybox/jquery.fancybox.min.js" type="text/javascript"></script>
<script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/fsvs-slider/js/bundle.js" type="text/javascript"></script>
<script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>assets/slick/slick.js" type="text/javascript"></script>
<script src="<?php echo HTTP_ASSETS_PATH_CLIENT; ?>js/scripts.js" type="text/javascript"></script>

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
    url: "https://reviewforest.org/moonstoneplates",
    language: "en",
    name: "Moonstone Plates Ltd",
    types: "['floating']",
    position: "bottom-left"
  });
</script>

<script type="text/javascript">
$( document ).ready(function() {
    $(".forgot-pass, .user-register").click(function() {
        $('#loginModal').modal('hide');
    });
    $('#login-form').submit(function () {
            var form = $("#login-form");
            if (form.valid())
            {
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    async: true,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: true,
                    enctype: 'multipart/form-data',
                    success: function (result)
                    { console.log('status',result['status']);
                        if (result.status == 1)
                        {
                            $.bootstrapGrowl(result.msg, {type: 'success', delay: 4000});
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                        else
                        {
                            $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                        }
                    },
                    error: function (error)
                    {
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        $.bootstrapGrowl("Internal server error !", {type: 'danger', delay: 4000});
                    }
                });
            }
            return false;
    });

    // Login
    $('#register-form').submit(function () {
            var form = $("#register-form");
            if (form.valid())
            {
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    async: true,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: true,
                    enctype: 'multipart/form-data',
                    success: function (result)
                    { console.log('status',result['status']);
                        if (result.status == 1)
                        {
                            $.bootstrapGrowl(result.msg, {type: 'success', delay: 4000});
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                        else
                        {
                            $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                        }
                    },
                    error: function (error)
                    {
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        $.bootstrapGrowl("Internal server error !", {type: 'danger', delay: 4000});
                    }
                });
            }
            return false;
    });

    $('#forgot-form').submit(function () {
            var form = $("#forgot-form");
            if (form.valid())
            {
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    async: true,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: true,
                    enctype: 'multipart/form-data',
                    success: function (result)
                    { console.log('status',result['status']);
                        if (result.status == 1)
                        {
                            $.bootstrapGrowl(result.msg, {type: 'success', delay: 4000});
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                        else
                        {
                            $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                        }
                    },
                    error: function (error)
                    {
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        $.bootstrapGrowl("Internal server error !", {type: 'danger', delay: 4000});
                    }
                });
            }
            return false;
    });
});
$('#faqSearch').focus(function() {
    //var div = $('.search-dropdown').fadeIn('fast');
    $(document).bind('focusin.search-dropdown click.search-dropdown',function(e) {
        if ($(e.target).closest('.search-dropdown, #faqSearch').length) return;
        $(document).unbind('.search-dropdown');
        $('.search-dropdown').fadeOut('fast');
    });
});

$("#faqSearch").on("keyup", function() {
    //$('.insurer_list strong').hide();
    var div = $('.search-dropdown').fadeIn('fast');
    var value = $(this).val().toLowerCase();
    if(value==""){
        $('.search-dropdown').fadeOut('fast');
    }
    $(".search-dropdown li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});
</script>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v8.0&appId=3479740382070509&autoLogAppEvents=1" nonce="XHStlzOu"></script>

</body>