$(document).ready(function () {
   $('#gridTable').DataTable({
                "paging": true,
                "aaSorting": [ [0,'desc'] ],
                "aoColumnDefs": [
                    { 
                      "bSortable": false, 
                      "aTargets": [ -1 ] // <-- gets last column and turns off sorting
                     } 
                 ]
    });
});