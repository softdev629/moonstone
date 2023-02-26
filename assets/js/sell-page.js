$( document ).ready(function() {
    $('#package-inquiry-form').submit(function () {
      var form = $("#package-inquiry-form");
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
              { 
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
    function chkSellRegister(frmInstant){
        var formclear = true;
        var firstname = trim(document.getElementById("FirstName").value);
        if(firstname=="" || firstname=="Please enter your first name"){
            document.getElementById("FirstName").className = "input_error form-control";
            document.getElementById("FirstName").value = "Please enter your first name";
            errinstant=true;
            formclear = false;
        }

        var lastname = trim(document.getElementById("LastName").value);
        if(lastname=="" || lastname=="Please enter your last name"){
            document.getElementById("LastName").className = "input_error form-control";
            document.getElementById("LastName").value = "Please enter your last name";
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

        var numberplate = trim(document.getElementById("Numberplate").value);
        if(numberplate=="" || numberplate=="Please enter your registration here"){
            document.getElementById("Numberplate").className = "input_error form-control";
            document.getElementById("Numberplate").value = "Please enter your registration here";
            errinstant=true;
            formclear = false;
        }

        var addnote = trim(document.getElementById("Addnote").value);
    	
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
    		

            $(".sell-process").delay(10).fadeTo("slow",0.7);
            $("#GetSell").delay(10).fadeTo("slow",0.1);
    		var base_url=document.getElementById("base_url").value;
            var sendUrl = base_url+"sell/sell_register?firstname="+firstname+"&lastname="+lastname+"&phone_number="+encodeURIComponent(phone_number)+"&email="+email_address+"&numberplate="+numberplate+"&note="+addnote;
    		//alert(sendUrl);
            xmlhttp.open("GET",sendUrl);
            xmlhttp.send(null);
            xmlhttp.onreadystatechange=function(){
                  if (xmlhttp.readyState==4 && xmlhttp.status==200){
                      if(xmlhttp.responseText=="success"){
                         $(function()
                         {
                          
                           $('#sell-msgquot').delay(100).fadeIn('normal', function() {
                                            
                             $(this).delay(1000).fadeOut();
                             
                             $(".sell-process").delay(10).fadeOut("normal");
                         
                             $("#GetSell").delay(1000).fadeTo("slow",1);
                            
                           });
                        });
                         ResetContact();
                      }
                  }else{
                        $('#sell-msgquot').delay(100).fadeIn('normal', function() {
                                            
                             $(this).delay(1000).fadeOut();
                             
                             $(".sell-process").delay(10).fadeOut("normal");
                         
                             $("#GetSell").delay(1000).fadeTo("slow",1);
                            
                           });
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
        document.getElementById("Numberplate").value = "";
        document.getElementById("Addnote").value = "";



        $("#FirstName").attr('class',"form-control");
        $("#LastName").attr('class',"form-control");
        $("#EnquiryEmail").attr('class',"form-control");
        $("#EnquiryPhoneNumber").attr('class',"form-control");
        $("#Numberplate").attr('class',"form-control");
        $("#Addnote").attr('class',"form-control");
    					 
    }

    $(document).on("click",".planbg-box",function(){
      var package_id=$(this).attr("data-id");
      //alert(package_id);
      $("#package_id").val(package_id);
      $("#packageModal").modal('show');
    });

