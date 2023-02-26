
valid_file_register_message="Please upload valid file. pdf / png / jpg / jpeg.";
valid_file_register_accept='.pdf|.PDF|.jpg|.png|.JPG|.PNG|.JPEG|.jpeg';
valid_file_message="Please upload valid file. gif / jpeg / jpg / png.";
valid_file_accept='.gif|.GIF|.jpg|.png|.JPG|.PNG|.JPEG|.jpeg';
valid_file_course_pdf_message="Please upload valid file. pdf.";
valid_file_accept_course_pdf='.pdf|.PDF';
valid_file_import_message="Please upload valid file. xls / xlsx.";
valid_file_accept_import='sheet|ms-excel';
valid_latitude_message='Please enter valid latitude.';
valid_longitude_message='Please enter valid longitude.';


	$(document).ready(function(e) {
							   
	// Validation
			$(".form-default").validate({
				rules: {
					txtconfirmpassword: {
						required: true, 
						minlength: 5, 
						equalTo: '#txtnewpassword'
					},
					txtoldpassword: {
						required: true, 
						minlength: 5, 
						equalTo: '#hdoldpassword'
					},
					banner_image: {
						accept:valid_file_accept
					},
					store_latitude:{
						 number: true
					},
					store_longitude:{
						 number: true
					},
					background_image:{
						accept:valid_file_accept
					},
					inner_images: {
						accept:valid_file_accept
					},
					main_image_path:{
						accept:valid_file_accept
					},
					catalogue_image_path1: {
						accept:valid_file_accept
					},
					catalogue_image_path2:{
						accept:valid_file_accept
					},
					catalogue_image_path3:{
						accept:valid_file_accept
					},
					catalogue_image_path4:{
						accept:valid_file_accept
					},
					catalogue_image_path5:{
						accept:valid_file_accept
					},
					catalogue_image_path6:{
						accept:valid_file_accept
					},
					catalogue_image_path7:{
						accept:valid_file_accept
					},
					catalogue_image_path8:{
						accept:valid_file_accept
					},
					catalogue_image_path9:{
						accept:valid_file_accept
					},
					catalogue_image_path10:{
						accept:valid_file_accept
					},
					catalogue_image_path11:{
						accept:valid_file_accept
					},
					catalogue_image_path12:{
						accept:valid_file_accept
					},
					catalogue_image_path13:{
						accept:valid_file_accept
					},
					catalogue_image_path14:{
						accept:valid_file_accept
					},
					catalogue_image_path15:{
						accept:valid_file_accept
					},
					catalogue_image_path16:{
						accept:valid_file_accept
					},
					catalogue_image_path17:{
						accept:valid_file_accept
					},
					catalogue_image_path18:{
						accept:valid_file_accept
					},
					catalogue_image_path19:{
						accept:valid_file_accept
					},
					catalogue_image_path20:{
						accept:valid_file_accept
					},
					collection_image: {
						accept:valid_file_accept
					},
					collection_image1: {
						accept:valid_file_accept
					},
					collection_image2:{
						accept:valid_file_accept
					},
					collection_image3:{
						accept:valid_file_accept
					},
					collection_image4:{
						accept:valid_file_accept
					},
					collection_image5:{
						accept:valid_file_accept
					},
					collection_image6:{
						accept:valid_file_accept
					},
					collection_image7:{
						accept:valid_file_accept
					},
					collection_image8:{
						accept:valid_file_accept
					},
					collection_image9:{
						accept:valid_file_accept
					},
					collection_image10:{
						accept:valid_file_accept
					},
					collection_image11:{
						accept:valid_file_accept
					},
					collection_image12:{
						accept:valid_file_accept
					},
					collection_image13:{
						accept:valid_file_accept
					},
					collection_image14:{
						accept:valid_file_accept
					},
					collection_image15:{
						accept:valid_file_accept
					},
					collection_image16:{
						accept:valid_file_accept
					},
					collection_image17:{
						accept:valid_file_accept
					},
					collection_image18:{
						accept:valid_file_accept
					},
					collection_image19:{
						accept:valid_file_accept
					},
					collection_image20:{
						accept:valid_file_accept
					},
					gallery_image:{
						accept:valid_file_accept
					},
					gallery_image1:{
						accept:valid_file_accept
					},
					gallery_image2:{
						accept:valid_file_accept
					},
					gallery_image3:{
						accept:valid_file_accept
					},
					gallery_image4:{
						accept:valid_file_accept
					},
					gallery_image5:{
						accept:valid_file_accept
					},
					gallery_image6:{
						accept:valid_file_accept
					},
					gallery_image7:{
						accept:valid_file_accept
					},
					gallery_image8:{
						accept:valid_file_accept
					},
					gallery_image9:{
						accept:valid_file_accept
					},
					gallery_image10:{
						accept:valid_file_accept
					},
					gallery_image11:{
						accept:valid_file_accept
					},
					gallery_image12:{
						accept:valid_file_accept
					},
					gallery_image13:{
						accept:valid_file_accept
					},
					gallery_image14:{
						accept:valid_file_accept
					},
					gallery_image15:{
						accept:valid_file_accept
					},
					gallery_image16:{
						accept:valid_file_accept
					},
					gallery_image17:{
						accept:valid_file_accept
					},
					gallery_image18:{
						accept:valid_file_accept
					},
					gallery_image19:{
						accept:valid_file_accept
					},
					gallery_image20:{
						accept:valid_file_accept
					},
					image_file1:{
						accept:valid_file_accept
					},
					social_media_image:{
						accept:valid_file_accept	
					}
				
				}
				, 
				 messages: {
		banner_image: {
			accept:valid_file_message
		},
		store_latitude: {
			number:valid_latitude_message
		},
		store_longitude: {
			number:valid_longitude_message
		},
		inner_images: {
			accept:valid_file_message
		},
		background_image:{
			accept:valid_file_message
		},
		main_image_path:{
			accept:valid_file_message
		},
		catalogue_image_path1: {
			accept:valid_file_message
		},
		catalogue_image_path2:{
			accept:valid_file_message
		},
		catalogue_image_path3:{
			accept:valid_file_message
		},
		catalogue_image_path4:{
			accept:valid_file_message
		},
		catalogue_image_path5:{
			accept:valid_file_message
		},
		catalogue_image_path6:{
			accept:valid_file_message
		},
		catalogue_image_path7:{
			accept:valid_file_message
		},
		catalogue_image_path8:{
			accept:valid_file_message
		},
		catalogue_image_path9:{
			accept:valid_file_message
		},
		catalogue_image_path10:{
			accept:valid_file_message
		},
		catalogue_image_path11:{
			accept:valid_file_message
		},
		catalogue_image_path12:{
			accept:valid_file_message
		},
		catalogue_image_path13:{
			accept:valid_file_message
		},
		catalogue_image_path14:{
			accept:valid_file_message
		},
		catalogue_image_path15:{
			accept:valid_file_message
		},
		catalogue_image_path16:{
			accept:valid_file_message
		},
		catalogue_image_path17:{
			accept:valid_file_message
		},
		catalogue_image_path18:{
			accept:valid_file_message
		},
		catalogue_image_path19:{
			accept:valid_file_message
		},
		catalogue_image_path20:{
			accept:valid_file_message
		},
		collection_image: {
			accept:valid_file_message
		},
		collection_image1: {
			accept:valid_file_message
		},
		collection_image2:{
			accept:valid_file_message
		},
		collection_image3:{
			accept:valid_file_message
		},
		collection_image4:{
			accept:valid_file_message
		},
		collection_image5:{
			accept:valid_file_message
		},
		collection_image6:{
			accept:valid_file_message
		},
		collection_image7:{
			accept:valid_file_message
		},
		collection_image8:{
			accept:valid_file_message
		},
		collection_image9:{
			accept:valid_file_message
		},
		collection_image10:{
			accept:valid_file_message
		},
		collection_image11:{
			accept:valid_file_message
		},
		collection_image12:{
			accept:valid_file_message
		},
		collection_image13:{
			accept:valid_file_message
		},
		collection_image14:{
			accept:valid_file_message
		},
		collection_image15:{
			accept:valid_file_message
		},
		collection_image16:{
			accept:valid_file_message
		},
		collection_image17:{
			accept:valid_file_message
		},
		collection_image18:{
			accept:valid_file_message
		},
		collection_image19:{
			accept:valid_file_message
		},
		collection_image20:{
			accept:valid_file_message
		},
		profile_path: {
			accept:valid_file_message
		},
		gallery_image:{
			accept:valid_file_message
		},
		gallery_image1:{
			accept:valid_file_message
		},
		gallery_image2:{
			accept:valid_file_message
		},
		gallery_image3:{
			accept:valid_file_message
		},
		gallery_image4:{
			accept:valid_file_message
		},
		gallery_image5:{
			accept:valid_file_message
		},
		gallery_image6:{
			accept:valid_file_message
		},
		gallery_image7:{
			accept:valid_file_message
		},
		gallery_image8:{
			accept:valid_file_message
		},
		gallery_image9:{
			accept:valid_file_message
		},
		gallery_image10:{
			accept:valid_file_message
		},
		gallery_image11:{
			accept:valid_file_message
		},
		gallery_image12:{
			accept:valid_file_message
		},
		gallery_image13:{
			accept:valid_file_message
		},
		gallery_image14:{
			accept:valid_file_message
		},
		gallery_image15:{
			accept:valid_file_message
		},
		gallery_image16:{
			accept:valid_file_message
		},
		gallery_image17:{
			accept:valid_file_message
		},
		gallery_image18:{
			accept:valid_file_message
		},
		gallery_image19:{
			accept:valid_file_message
		},
		gallery_image20:{
			accept:valid_file_message
		},
		social_media_image:{
			accept:valid_file_message
		},
        txtoldpassword: {
            equalTo: "Please enter correct old password."
        }, txtconfirmpassword: {
            equalTo: "Password and confirm password should be same."
        }
		
    }
			});
			
		
	});


function galleryType(thisval)
{
	if(thisval=="2")
	{	 
		jQuery(".Video").show();
		jQuery(".Image").hide();
		jQuery(".Caption").hide();
	}
	else
	{
		jQuery(".Image").show();
		jQuery(".Video").hide();
		jQuery(".Caption").show();
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

function validate() {
$("#mobileValidation").hide();
var mobile = document.getElementById("store_telephone").value;
var pattern = /^[\s()+]*([0-9][\s()+]*){6,20}$/;
if (pattern.test(mobile)) {
	 $("#Submit").removeAttr('disabled');
return true;
}
else
{
	if(mobile!="")
	{
		$("#Submit").attr('disabled','disabled');
		$("#mobileValidation").show();
		return false;
	}
} 
}

var activeShowingLoadingPanel =0;
function StartLoading() {
	if(activeShowingLoadingPanel==0){
    $("#loadingPanel").show();
	}
	activeShowingLoadingPanel++;
}

function StopLoading() {
		activeShowingLoadingPanel--;
		if(activeShowingLoadingPanel==0){
		    $("#loadingPanel").hide();
		}
}


 

