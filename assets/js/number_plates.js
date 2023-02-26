$( document ).ready(function() {
// $(".num-plate-view").click(function(){
//   $("#md-plate-number").html('');
//   $("#md-plate-price").html('');
//   var plate_id=$(this).attr("data-id");
//   var plates_number=$("#nm_"+plate_id).val();
//   var plates_price=$("#charge_"+plate_id).val();
//   $("#plate_modal_id").val(plate_id);
//   $("#price_modal_id").val(plates_price);
//   $("#md-plate-number").html(plates_number);
//   $("#md-plate-price").html('£'+plates_price);
//   $("#numberModal").modal('show');
// });

$(document).on("click",".num-plate-view, .buy_pop_up",function(){
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
                    {   
                        //console.log(result);
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

$(document).on("click",".featured_buy_pop_up",function(){
            var plate_id=$(this).attr("data-id");
            var plates_number=$(this).attr("data-number");
            var plates_price=$(this).attr("data-price");
            var plates_type='1';
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
                    {   
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

$(document).on("click","#send_poa",function(){
            var plate_id=$("#plate_modal_id").val();
            var plates_price=$("#price_modal_id").val();
            var plates_number=$("#plate_number").val();
            var base_url=$("#base_url").val();
            var ajaxUrl = 'number-plate/show_poa_modal';
            
            $.ajax({
                type: "GET",
                url: ajaxUrl,
                data: {plate_id: plate_id,plates_number:plates_number,plates_price:plates_price},
                async: true,
                dataType: "json",
                success: function (result)
                {
                    if (result.status == 1)
                    {   
                        $('#numberModal').modal('hide');
                        $("#poaModal .body_content").html(result.modal_html);
                        $("#poaModal").modal();
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

$(document).on("click","#favourite_number",function(){
            var plate_id=$("#plate_modal_id").val();
            var plates_price=$("#price_modal_id").val();
            var plates_number=$("#plate_number").val();
            var is_number_favourite=$("#is_number_favourite").val();
            var plate_type=$("#plate_type").val();
            
            var ajaxUrl = 'number-plate/favourite';
            
            $.ajax({
                type: "GET",
                url: ajaxUrl,
                data: {plate_id: plate_id,plates_number:plates_number,plates_price:plates_price,is_number_favourite:is_number_favourite,plate_type:plate_type},
                async: true,
                dataType: "json",
                success: function (result)
                {
                    // $('#AjaxLoaderDiv').fadeOut(100);
                    if (result.status == 1)
                    {  
                       if(result.is_number_favourite==1){
                        $("#favourite_number").addClass("is_favorite");
                        $("#is_number_favourite").val(0);
                        $.bootstrapGrowl("Favourite successfully", {type: 'success', delay: 4000});
                       }else{
                        $("#favourite_number").removeClass("is_favorite");
                        $("#is_number_favourite").val(1);
                        $.bootstrapGrowl("UnFavourite successfully", {type: 'success', delay: 4000});
                       }                         
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
$(document).on("click","#enquiry_plates",function(){
  var plate_id=$("#plate_modal_id").val();
  var plates_price=$("#price_modal_id").val();
  var plates_number=$("#plate_number").val();
  $("#enquiry_plate_id").val(plate_id);
  $("#enquiry_plate_number").val(plates_number);
  $("#enquire_subject").val("Enquire For "+plates_number);
  $("#enquire_number").html(plates_number);
  $("#numberModal").modal('hide');
  $("#offerModal").modal('hide');
  $("#enquireModal").modal('show');
});
$(document).on("click","#offer_plates",function(){
  var plate_id=$("#plate_modal_id").val();
  var plates_price=$("#price_modal_id").val();
  var plates_number=$("#plate_number").val();
  $("#offer_plate_id").val(plate_id);
  $("#offer_plate_number").val(plates_number);
  $("#offer_subject").val("Make an offer on "+plates_number);
  $("#offer_number").html(plates_number);
  $("#numberModal").modal('hide');
  $("#enquireModal").modal('hide');
  $("#offerModal").modal('show');
});

$(".buy_pop_up").click(function(){
  $("#md-plate-number").html('');
  $("#md-plate-price").html('');
  var plate_id=$(this).attr("data-id");
  var plates_number=$("#nm_"+plate_id).val();
  var plates_price=$("#charge_"+plate_id).val();
  $("#plate_modal_id").val(plate_id);
  $("#price_modal_id").val(plates_price);
  $("#md-plate-number").html(plates_number);
  $("#md-plate-price").html('£'+plates_price);
  $("#numberModal").modal('show');
});

$('#enquiry-form').submit(function () {
  var form = $("#enquiry-form");
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
$('#offer-form').submit(function () {
  var form = $("#offer-form");
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

// $('#poa-form').submit(function () {
$(document).on("submit","#poa-form",function(){
            var form = $("#poa-form");
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




