<?php
    $base_url=base_url();
?>
<!-- <script type="text/javascript">
$(document).ready(function() {
   var base_url=$("#base_url").val()+'admin/get_cron_items';
   var indexLastColumn = $("#gridTable").find('tr')[0].cells.length-1;
    $('#gridTable').DataTable({
        "ajax": {
            url : base_url,
            type : 'GET'
        },
        "order":[[indexLastColumn,'desc']]   
    });
});
</script> -->
<script type="text/javascript">
$(document).ready(function() {
   <?php  if (empty($soringCol)) { 
      $soringCol='';
   } ?>
   var base_url=$("#base_url").val()+'admin/get_cron_items';
   var indexLastColumn = $("#gridTable").find('tr')[0].cells.length-1;
   var indexLastColumn = 0;
    var privateDatatable = $('#gridTable').DataTable({
         "processing": true,
         "serverSide": true,
         "pageLength": 10,
         "ajax": {
           'type': 'GET',
           'url': base_url
         },
         "order":[[indexLastColumn,'desc']],
         // "method":'POST'
         // "aoColumnDefs": [{ "bSortable": true, "aTargets": [0]}] ,
         "aLengthMenu": [[10, 25, 50, 100, -1], ["10", "25", "50", "100", "All"]],
         "language": {
                  "processing": "<div></div><div></div><div></div><div></div><div></div>"
               },
    });
});
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<div class="content-page">
   <div class="content">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title-box">
                  <h4 class="page-title"><?php echo $page?></h4>
                  <div class="add-page hide">
                     
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
               <div class="card-box">
                  <div class="table-rep-plugin">
                     <div class="table-wrapper">
                        <div class="table-responsive" data-pattern="priority-columns">
                           <table id="gridTable" class="table table-striped table-bordered datatable m-b-0">
                              <thead>
                                 <tr>
                                    <th width="20%">Plate Number</th>
                                    <th width="20%">Cron Type</th>
                                    <th width="20%">Plate Type</th>
                                    <th width="20%">Plate Id</th>
                                    <th width="20%">Date</th>
                                 </tr>
                                <tbody>
                                </tbody>
                              </thead>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- container -->
   </div>
   <!-- content -->
</div>