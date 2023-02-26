$(document).ready(function () {
   CKEDITOR.replace('page_description', {filebrowserUploadUrl: '<?php echo base_url(); ?>upload'});
    $("form").submit(function () {
        var messageLength = CKEDITOR.instances['page_description'].getData().replace(/<[^>]*>/gi, '').length;
        if (!messageLength) {
            if ($("#error_description").length != 0) {

                $("#error_description").show();
                return false;
            }
        }
    });

});