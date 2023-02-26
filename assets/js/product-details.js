add_cart_button_count=1;
function addcart()
{
	
	// if(add_cart_button_count==1)
	// {
			var product_id=$("#plate_modal_id").val();
			var price_modal_id=$("#price_modal_id").val();
			var plate_type=$("#plate_type").val();
			var qty=1;
			var hid_base_url=$("#base_url").val();
			var dataString = 'product_id='+ product_id+'&qty='+qty+'&price_modal_id='+price_modal_id+'&plate_type='+plate_type;
			$.ajax
			({
				type: "POST",
				url: hid_base_url+"buy/add_number_plates_cart",
				data: dataString,
				cache: false,
				success: function(result)
				{
					if(result=="1")
					{
						//$("#txtimg").empty();
						//jQuery("#txtimg").append(result);
						//$('#numberModal').modal('hide');
						// $('#cart-popup').modal('show');
						var base_url=$("#base_url").val();
						window.location.replace(base_url+"cart");
						
					}else{
						$.bootstrapGrowl("This number plate is already registered can you please an alternative.", {type: 'danger', delay: 4000});
					}

				},
				error: function() {
					
				},
			});	
	// }
	//add_cart_button_count++;
}
$(document).ready(function() {
    var text_max = 20;
    $('#limit-box-count').html(text_max + ' characters left');

    $('#msgc').keyup(function() {
        var text_length = $('#msgc').val().length;
        var text_remaining = text_max - text_length;
			
        $('#limit-box-count').html(text_remaining + ' characters left');
		
    });
});