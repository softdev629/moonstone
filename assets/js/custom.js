
$(function() {
    "use strict";
    $(function() {
        $(".preloader").fadeOut();
    });
    

	
	// ============================================================== 
    // This is for the top header part and sidebar part
    // ==============================================================  
    var set = function() {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        var topOffset = 70;
        if (width < 500) {
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
            $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
            $(".sidebartoggler i").addClass("ti-menu");
        } else {
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
            $(".sidebartoggler i").removeClass("ti-menu");
        }

        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $(".page-wrapper").css("min-height", (height) + "px");
        }

    };
    $(window).ready(set);
    $(window).on("resize", set);
	
	
	
	// ============================================================== 
    // Auto select left navbar
    // ============================================================== 
    $(function() {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function() {
            return this.href == url;
        }).addClass('active').parent().addClass('active');
        while (true) {
            if (element.is('li')) {
                element = element.parent().addClass('in').parent().addClass('active');
            } else {
                break;
            }
        }
    });

    // ============================================================== 
    // Sidebarmenu
    // ============================================================== 
    // $(function() {
        // $('#sidebarnav').metisMenu();
    // });
    // ============================================================== 
    // Slimscrollbars
    // ============================================================== 
    $('.scroll-sidebar').slimScroll({
        position: 'left',
        size: "5px",
        height: '100%',
        color: '#dcdcdc'
    });

    // ============================================================== 
    // Resize all elements
    // ============================================================== 
    $("body").trigger("resize");	
});

function trim(str) 
{    
        if (str != null) 
        {        
            var i;        
            for (i=0; i<str.length; i++) 
            {           
                if (str.charAt(i)!=" ") 
                {               
                    str=str.substring(i,str.length);                 
                    break;            
                }        
            }            
            for (i=str.length-1; i>=0; i--)
            {            
                if (str.charAt(i)!=" ") 
                {                
                    str=str.substring(0,i+1);                
                    break;            
                }         
            }                 
            if (str.charAt(0)==" ") 
            {            
                return "";         
            } 
            else 
            {            
                return str;         
            }    
        }
}

function clearText(id,value,value2,class_name){
    if(jQuery("#"+id).val() == value || jQuery("#"+id).val() == value2){
            jQuery("#"+id).val("");
            jQuery("#"+id).attr('class',class_name);
    }
}
function FillText(id,value,class_name){
    if(jQuery("#"+id).val() == ""){
        jQuery("#"+id).val(value);
        jQuery("#"+id).attr('class',class_name);
    }
}
/* Update is_sold_out in vendor product*/

function Zero_not_enter(elementRef)
{
    

    
    var textcontrol = parseInt(document.getElementById("qtytextbox").value);
    
    hid_product_id=$("#hid_product_id").val();

    if ( textcontrol == 0 || isNaN(textcontrol))
    {
        document.getElementById("qtytextbox").focus();
            
            
            jQuery('#add_cart_detail').addClass('btn-default_disable');
            
            jQuery("#add_cart_detail").removeAttr("onclick");
            
        
        return false;
    }
    else 
    {
        var message =jQuery("#msgc").val();
            var count = message.length;
        if(($( "input[name='msgc']" ).is( ":text" )==true) && count>=1)
        {
            
            
    
            if($('input[name=msgconfirm]:checked').val() && count>=1)
            {
                jQuery('#add_cart_detail').removeClass('btn-default_disable');
            
                jQuery('#add_cart_detail').attr('onclick','addcart("'+hid_product_id+'")');
            }
            
        }
        else
        {
            jQuery('#add_cart_detail').removeClass('btn-default_disable');
            
            jQuery('#add_cart_detail').attr('onclick','addcart("'+hid_product_id+'")');
        }
        


        return true;
    }
}
function numericOnly(elementRef)
{
    
    var keyCodeEntered = (event.which) ? event.which : (window.event.keyCode) ? window.event.keyCode : -1;
    
    var number = elementRef.value.split('.');

    if (number.length == 2 && number[1].length > 1)
    {
        return false;
    }
     if ( (keyCodeEntered >= 48) && (keyCodeEntered <= 57) )
     {
        return true;
     }
     
     // '.' decimal point...
     else if ( keyCodeEntered == 46 )
     {
          // Allow only 1 decimal point ('.')...
          if( (elementRef.value) && (elementRef.value.indexOf('.') >= 0) )
          {
            return false;
          }
          else
          {
           return true;
          }
     }

     return false;
}

var activeShowingLoadingPanel =0;
function StartLoading() {
    if(activeShowingLoadingPanel==0){
    jQuery("#loadingPanel").show();
    }
    activeShowingLoadingPanel++;
}

function StopLoading() {
        activeShowingLoadingPanel--;
        if(activeShowingLoadingPanel==0){
            jQuery("#loadingPanel").hide();
        }
}
function validateEmail(email){
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    return email.match(re)
}
$(document).on('click', '.search-icon', function(event) { 
    event.preventDefault(); 
    $(".srh-btn").click(); 
});