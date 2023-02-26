// JavaScript Document
function chkNewslatter(frmInstant){
    var formclear = true;
    var email_address = trim(document.getElementById("textEmail").value);
    if(email_address=="" || email_address=="Email" || email_address=="Please enter your email"){
        document.getElementById("textEmail").className = "input_error form-control";
        document.getElementById("textEmail").value = "Please enter your email";
        formclear = false;
    }
    else if(validateEmail(email_address)==null){
        document.getElementById("textEmail").className = "input_error form-control";
        document.getElementById("textEmail").value = "Please enter your valid email";
    		formclear = false;
    }else{
        var base_url = trim(document.getElementById("base_url").value);
        var email = trim(document.getElementById("textEmail").value);
        $.ajax({
            
            type: "POST",
            url: base_url+"home/duplicate_email_validation",
            data: {email:email},
            success: function(result) {
                
                if(result==1)
                {
                    
                 $("#btn-submit").attr("disabled", "disabled");
                 document.getElementById("lbl_user_email").innerHTML = "Email address already registered";
                 formclear = false;
                }
                else
                {
                    $("#btn-submit").removeAttr("disabled");
                    document.getElementById("lbl_user_email").innerHTML = "";
                    formclear = true;
                }
            }
        });
    }
    
    if(formclear==false){
        return false;
    }
    else{
		
        var xmlhttp;
        if (window.XMLHttpRequest){
     			xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
        }
        else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
        }
		

        $(".newslatter-process").delay(10).fadeTo("slow",0.7);
		$("#FormNewslatter").delay(10).fadeTo("slow",0.1);
		var base_url=document.getElementById("base_url").value;
	
        var sendUrl = base_url+"home/sendnewslatter?email="+email_address;
		//alert(sendUrl);
        xmlhttp.open("GET",sendUrl);
        xmlhttp.send(null);
        xmlhttp.onreadystatechange=function(){
		//alert(xmlhttp.responseText);
              if (xmlhttp.readyState==4 && xmlhttp.status==200){
                  if(xmlhttp.responseText=="success"){
                     $(function() {
                           //$('.quote-contact-form').fadeOut('normal');
                           $('#newslatter-msgquot').delay(1000).fadeIn('normal', function() {
											
                             $(this).delay(1000).fadeOut();
							 
                             $(".newslatter-process").delay(1000).fadeOut("normal");
						 
                             $("#FormNewslatter").delay(1000).fadeTo("slow",1);
							 
                         
                           });
                     });
                    ResetNewslatter(); 
                  }
              }
        }
        return false;
    }
    return false;
}
function ResetNewslatter()
{
     document.getElementById("textEmail").value = "";
     $("#textEmail").attr('class',"form-control");		 
}
function duplicate_email(email)
{
	if(email!="Email" && email!=""){
	 var base_url = trim(document.getElementById("base_url").value);

				$.ajax({
					
					type: "POST",
					url: base_url+"home/duplicate_email_validation",
					data: {email:email},
					success: function(result) {
						
						if(result==1)
						{
							
						 $("#btn-submit").attr("disabled", "disabled");
						 document.getElementById("lbl_user_email").innerHTML = "Email address already registered";
							
						}
						else
						{
							$("#btn-submit").removeAttr("disabled");
							document.getElementById("lbl_user_email").innerHTML = "";
						}
					},
					async:true
				});
	}
}	