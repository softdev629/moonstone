hid_base_url=$("#base_url").val();
function ContinueShopping()
{
	window.location=hid_base_url+'buy';
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

	 return false;
}

function deleteFunction(id)
{
	$.ajax({
	 type: "GET",
	 url: hid_base_url +"cart/delete_cart", 
	 data: {id: id},
	 success: function(data){
	 		var dataObj = jQuery.parseJSON(data);
		   // console.log('cart_data',dataObj.cart_data);
		   // console.log('count_cart',dataObj.count_cart);
	       //document.getElementById("display").innerHTML = dataObj.cart_data;
	       var base_url=$("#base_url").val();
		   window.location.replace(base_url+"buy");
		   
	       $("#display").html(dataObj.cart_data);
		   update_summary(id);
		   if(dataObj.count_cart==0){
		   	$("#checkout-btn").hide();
		   }
		   
	  },
	 error: function (error) {
     alert('Internal server error !')               
     }
	});
	return false;
}



function ClearCart() 
{

        if (window.XMLHttpRequest)
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else 
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() 
		{
		      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			  {
				
                document.getElementById("display").innerHTML = xmlhttp.responseText;
				 $("#cartnumber,#cartnumber_mobile").load(hid_base_url+"cart/count_cart_val/");
				 
            }
        }
        xmlhttp.open("GET",hid_base_url+"cart/clear_cart/",true);
        xmlhttp.send();
	
   
}
function Zero_not_enter(id)
{
	
	var textcontrol = parseInt(document.getElementById("txtitems"+id).value);
	
		if ( textcontrol== 0 || isNaN(textcontrol))
		{	
				document.getElementById("txtitems"+id).focus();
				jQuery('#Submit').addClass('btn-default_disable');
				jQuery("#Submit").removeAttr("type");
				jQuery('#Submit').attr('type', 'button');
			
			return false;
		}
		else
		{   
		
			jQuery('#Submit').removeClass('btn-default_disable');
			jQuery("#Submit").attr("type","submit");
		
			return true;
		}
	
}
function update_items(id)
{
	//alert("id="+id);
	var qty=parseInt(document.getElementById("txtitems"+id).value);
	if(!isNaN(qty))
	{
		if(qty!=0)
		{

			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
				
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					
					document.getElementById("display").innerHTML = xmlhttp.responseText;
					update_summary(id);
					document.getElementById("txtitems"+id).value += "";
					document.getElementById("txtitems"+id).focus();
					 
				}
			}
		xmlhttp.open("GET",hid_base_url+"cart/update_cart?id="+id+"&qty="+qty,true);
		xmlhttp.send();
		}
	}

}

function update_summary(id)
{
	
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
			
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("card_display").innerHTML = xmlhttp.responseText;
				
			}
		}
		xmlhttp.open("GET",hid_base_url+"cart/update_summary_cart?id="+id,true);
		xmlhttp.send();
		

}