// JavaScript Document

function chkContactUs(frmInstant){
    var formclear = true;
    var firstname = trim(document.getElementById("FirstName").value);
    if(firstname=="" || firstname=="Please enter your name"){
        document.getElementById("FirstName").className = "input_error form-control";
        document.getElementById("FirstName").value = "Please enter your name";
        errinstant=true;
        formclear = false;
    }

    var lastname = trim(document.getElementById("LastName").value);
    if(lastname=="" || lastname=="Please enter your name"){
        document.getElementById("LastName").className = "input_error form-control";
        document.getElementById("LastName").value = "Please enter your name";
        errinstant=true;
        formclear = false;
    }

    var email_address = trim(document.getElementById("EnquiryEmail").value);
    if(email_address=="" || email_address=="Please enter your email"){
        document.getElementById("EnquiryEmail").className = "input_error form-control";
        document.getElementById("EnquiryEmail").value = "Please enter your email";
        formclear = false;
    }
    else if(validateEmail(email_address)==null){
        document.getElementById("EnquiryEmail").className = "input_error form-control";
        document.getElementById("EnquiryEmail").value = "Please enter your valid email";
    		formclear = false;
    }
	var phone_number = trim(document.getElementById("EnquiryPhoneNumber").value);
	var	pattern = /^[\s()+]*([0-9][\s()+]*){6,20}$/;
	if(phone_number=="" || phone_number=="Please enter contact number"){
        document.getElementById("EnquiryPhoneNumber").className = "input_error form-control";
        document.getElementById("EnquiryPhoneNumber").value = "Please enter your contact number";
        errinstant=true;
        formclear = false;
    }
	else if(!pattern.test(phone_number) && phone_number!="Please enter your contact number")
	{
		document.getElementById("EnquiryPhoneNumber").className = "input_error form-control";
        document.getElementById("EnquiryPhoneNumber").value = "Please enter your valid contact number";
        formclear = false;
	}

    var message = trim(document.getElementById("EnquiryMessage").value);
    if(message=="" || message=="Please enter your message"){
        document.getElementById("EnquiryMessage").className = "input_error form-control";
        document.getElementById("EnquiryMessage").value = "Please enter your message";
        errinstant=true;
        formclear = false;
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
		

        $(".contact-us-process").delay(10).fadeTo("slow",0.7);
	
        $("#GetContact").delay(10).fadeTo("slow",0.1);
		    var base_url=document.getElementById("base_url").value;
var sendUrl = base_url+"contactus/sendmessage?firstname="+firstname+"&lastname="+lastname+"&phone_number="+encodeURIComponent(phone_number)+"&email="+email_address+"&message="+message;
		//alert(sendUrl);
       xmlhttp.open("GET",sendUrl);
        xmlhttp.send(null);
        xmlhttp.onreadystatechange=function(){
		//alert(xmlhttp.responseText);
              if (xmlhttp.readyState==4 && xmlhttp.status==200){
                  if(xmlhttp.responseText=="success"){
                     $(function() {
                          
                           $('#contact-us-msgquot').delay(100).fadeIn('normal', function() {
											
                             $(this).delay(1000).fadeOut();
							 
                             $(".contact-us-process").delay(10).fadeOut("normal");
						 
                             $("#GetContact").delay(1000).fadeTo("slow",1);
							 
                         
                           });
                     });
                   
                ResetContact();
					 
                  }
              }
        }
        return false;
    }
    return false;
}
function ResetContact()
{
    document.getElementById("FirstName").value = "";
    document.getElementById("LastName").value = "";
    document.getElementById("EnquiryEmail").value = "";
    document.getElementById("EnquiryPhoneNumber").value = "";
    document.getElementById("EnquiryMessage").value = "";



    $("#FirstName").attr('class',"form-control");
    $("#LastName").attr('class',"form-control");
    $("#EnquiryEmail").attr('class',"form-control");
    $("#EnquiryPhoneNumber").attr('class',"form-control");
					 
}

