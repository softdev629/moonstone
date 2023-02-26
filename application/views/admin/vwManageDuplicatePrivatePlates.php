<?php
    $base_url=base_url();
?>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<?php 
if(is_array($plates) && count($plates) > 0) {
?>
<script type="text/javascript">
$(document).ready(function () {
   $('#gridTable').DataTable({
       "paging": true,
       'lengthMenu': [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
       "aaSorting": [ [1,'desc'] ],
       "aoColumnDefs": [
           { 
             "bSortable": false, 
             "aTargets": [ 0 ] // <-- gets last column and turns off sorting
            } 
        ]
    });
});
$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll").prop("checked",false);
        }
    });
});
</script>
<?php } ?>

<div class="content-page">
   <div class="content">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title-box">
                  <h4 class="page-title"><?php echo $page?></h4>
                  <div class="add-page" style="float:right;">
                    <button type="button" class="btn btn-primary" onclick="updatePlates()" title="import /overwrite with the new one">Replace</button>
                    <button type="button" class="btn btn-primary" onclick="deletePlates()" title="Keep existing plates and skip from import">Keep</button>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
            
            <?php if ($this->session->flashdata('msg')) { ?>
              <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p><?php echo $this->session->flashdata('msg'); ?></p>
              </div>
            <?php } ?>
            </div>
            <div class="col-xs-12 col-lg-12 col-xl-12">
               <div class="card-box">
                  <div class="table-rep-plugin">
                     <div class="table-wrapper">
                        <div class="table-responsive" data-pattern="priority-columns">
                           <table id="gridTable" class="table table-striped table-bordered datatable m-b-0">
                              <thead>
                                 <tr>
                                    <th width="8%" style="text-align: center;">
                                       <input type="checkbox" id="ckbCheckAll" />
                                    </th>
                                    <th width="15%">CSV Plate Number</th>
                                    <th width="15%">DB Plate Number</th>
                                    <th width="13%">CSV Company</th>
                                    <th width="13%">DB Company</th>
                                    <th width="10%">CSV Price</th>
                                    <th width="10%">DB Price</th>
                                 </tr>
                                <tbody>
                                       <?php 
                                       $sr_count=0;
                                       if(is_array($plates) && count($plates) > 0) {
                                       foreach ($plates as $vals) { $sr_count++;?>
                                       <tr>
                                           <td style="text-align:center" data-orderable="false">
                                             <input type="checkbox" class="checkBoxClass" name="plate_ids" value="<?php echo $vals['original_plate_id'];?>">
                                           </td>
                                           <td><?php echo $vals['csv_plates_number'];?></td>
                                           <td><?php echo $vals['original_plates_number'];?></td>
                                           <td><?php echo $vals['csv_company_name'];?></td>
                                           <td><?php echo $vals['original_company_name'];?></td>
                                           <td><?php echo $vals['csv_price'];?></td>
                                           <td><?php echo $vals['original_price'];?></td>
                                       </tr>
                                       <?php }} else {?>
                                       <tr>
                                           <td colspan="7">No data found</td>
                                       </tr>
                                       <?php }?>
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
<script type="text/javascript">
   function updatePlates() {
            var private_plates = [];
            $.each($("input[name='plate_ids']:checked"), function(){
                private_plates.push($(this).val());
            });
            var plate_ids=private_plates.join(",");
            $.ajax({
               type: "POST",
               url:"<?php echo site_url('admin/private_plates_bulk')?>",
               data: {plate_ids:plate_ids,action:"update"},
               success: function(result) {
                  if(result == 'success'){
                    location.reload();
                  }
               },
               async:false
            });
   }

   function deletePlates() {
            var private_plates = [];
            $.each($("input[name='plate_ids']:checked"), function(){
                private_plates.push($(this).val());
            });
            var plate_ids=private_plates.join(",");
            $.ajax({
               type: "POST",
               url:"<?php echo site_url('admin/private_plates_bulk')?>",
               data: {plate_ids:plate_ids,action:"delete"},
               success: function(result){
                  if(result == 'success'){
                    location.reload();
                  }
               },
               async:false
            });
   }

</script>