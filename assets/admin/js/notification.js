function update_is_active(val,id)
{
    if (confirm("Are you sure?")) {
        var base_url=$("#base_url").val();
        jQuery.ajax({
                url:base_url+"admin/update_is_active",
                type: "GET",
                data:{ val : val, id : id },
                success:function(result){
                    if(val==1){
                     $('#is_active'+id+'').removeClass('zmdi-email').addClass('zmdi-email-open');
                    }
                    if(val==0){
                     $('#is_active'+id+'').removeClass('zmdi-email-open').addClass('zmdi-email');
                    }
                    window.location.reload();
                },
        });
    }
    return false;
}