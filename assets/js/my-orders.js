$( document ).ready(function() {

$(document).on("click","#gridTable tbody tr",function(){
            var id = $(this).find("td:first").find('input[name="order_id"]').val();
            
            var ajaxUrl = 'order/'+id;
            
            $.ajax({
                type: "GET",
                url: ajaxUrl,
                data: {order_id: id},
                async: true,
                dataType: "json",
                success: function (result)
                {
                    if (result.status == 1)
                    {
                        $("#orderDetailsModal .modal-body").html(result.modal_html);
                        $("#orderDetailsModal").modal();                      
                    }
                    else
                    {
                        $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                    }
                },
                error: function (error) {
                    $('#AjaxLoaderDiv').fadeOut(100);
                    $.bootstrapGrowl("Internal server error !", {type: 'danger', delay: 4000});
                }
            });
        });
$(document).on("click",".num-plate-view",function(){
            var plate_id=$(this).attr("data-id");
            var plates_number=$("#nm_"+plate_id).val();
            var plates_price=$("#charge_"+plate_id).val();
            var plates_type=$("#type_"+plate_id).val();
            var base_url=$("#base_url").val();
            
            var ajaxUrl = 'number-plate/show_modal';
            
            $.ajax({
                type: "GET",
                url: ajaxUrl,
                data: {plate_id: plate_id,plates_number:plates_number,plates_price:plates_price,plates_type:plates_type},
                async: true,
                dataType: "json",
                // contentType: false,
                // processData: false,
                // cache: true,
                success: function (result)
                {
                    // $('#AjaxLoaderDiv').fadeOut(100);
                    if (result.status == 1)
                    {   console.log(result);
                        $("#numberModal .modal-body").html(result.modal_html);
                        $( document ).ready(function() {
                           $(".shareThis").simpleSocialShare(
                            {sites: "", url: base_url+"buy", 
                            title: "Moonstoneplates", 
                            description: "Number Plates : "+plates_number, 
                            image: base_url+"assets/images/modal-thumb.jpg", 
                            shareType: "button", triggerButtonActiveState: false, 
                            buttonSide: "left", orientation: "horizontal"});
                        });
                        $("#numberModal").modal();
                                       
                    }
                    else
                    {
                        $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                    }
                },
                error: function (error) {
                    //$('#AjaxLoaderDiv').fadeOut(100);
                    $.bootstrapGrowl("Internal server error !", {type: 'danger', delay: 4000});
                }
            });

});





});




