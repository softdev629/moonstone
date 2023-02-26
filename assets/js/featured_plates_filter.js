function filter_featured_plates(id)
{
   var base_url=$("#base_url").val();
   if(id > 0)
   {
      var dataString = 'id='+ id;
         $.ajax
         ({
            type: "POST",
            url: base_url+"buy/get_filter_featured_plates",
            data: dataString,
            cache: false,
            success: function(html)
            {
               $("#add_featured_plates").html(html);
            } 
         });
   }
   else
   {
      //$("#add_featured_plates").html('');
   }  
}