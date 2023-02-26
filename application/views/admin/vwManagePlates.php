<?php
    $base_url=base_url();
?>
<style type="text/css">
.select-option {
    width: 85%;
    display: inline-block;
}
.select-action {
    display: inline-block;
    float: right;
}
.select-action .btn {
    padding: 6px 18px!important;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
   <?php  if (empty($soringCol)) { 
      $soringCol='';
   } ?>
   var base_url=$("#base_url").val()+'admin/get_private_plates';
   // var indexLastColumn = $("#gridTable").find('tr')[0].cells.length-1;
   var indexLastColumn = 0;
    var privateDatatable = $('#gridTable').DataTable({
         "processing": true,
         "serverSide": true,
         "pageLength": 10,
         "ajax": {
           'type': 'GET',
           'url': base_url,
           'data':function(data) {
               data.company_id = $('#company_id').val();
            },
         },
         "aaSorting": [ [1,'desc'] ],
          "aoColumnDefs": [
              { 
                "bSortable": false, 
                "aTargets": [ 0 ] // <-- gets last column and turns off sorting
               } 
           ],
         // "method":'POST'
         // "aoColumnDefs": [{ "bSortable": true, "aTargets": [0]}] ,
         "aLengthMenu": [[10, 25, 50, 100, 200, 300, -1], ["10", "25", "50", "100", "200", "300", "All"]],
         "language": {
                  "processing": "<div></div><div></div><div></div><div></div><div></div>"
               },
    });


    $('#company_id').change(function () {
 
        privateDatatable.ajax.reload();
 
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
                          <div class="add-page" style="float:right;">
                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#companyModal" title="import /overwrite with the new one">Delete all company plates</button>
                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changecompanyModal" title="allows to select multiple plates and change their company tag">Change company tag selected</button>
                           </div>
                          <div class="add-page">
                             <a href="<?php echo base_url(); ?>admin/users/add_plate" style="margin-left: 6px;font-size: 17px;"><i class="fa fa-plus" aria-hidden="true"></i></a>
                          </div>
                          <div class="clearfix"></div>
                       </div>
                    </div>
                 </div>
                  <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                    <?php if ($this->session->flashdata('success')) { ?>
                      <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p><?php echo $this->session->flashdata('success'); ?></p>
                      </div>
                    <?php } ?>
                    </div>
                     <div class="col-md-3">
                           <fieldset class="form-group">
                              <!-- <label for="name">Company</label> -->
                              <select required class="form-control" name="company_id" id="company_id">
                                 <option value="">All Companies</option>
                               <?php      
                                foreach($company_list as $ckey => $company_name)
                                {
                                   //if($ckey=='20')
                                   //{
                                    //  $company_select="selected";
                                   //}
                                   //else
                                   //{
                                      $company_select='';
                                   //}
                                    echo '<option value='.$ckey.' '.$company_select.'>'.$company_name.'</option>';
                                }
                                ?>
                              </select>
                           </fieldset>

                     </div>
                     <div class="col-md-4" style="float:right">

                     </div>
                     <div class="col-md-5" style="float:right">
                        <div class="select-option">
                           <fieldset class="form-group">
                                 <select required class="form-control" name="action_option_id" id="action_option_id">
                                    <option value="">Select Option</option>
                                    <option value="active">Active selected</option>
                                    <option value="inactive">Inactive selected</option>
                                    <option value="delete">Delete selected</option>
                                    <option value="vat">VAT selected</option>
                                    <option value="no_vat">No VAT selected</option>
                                    <option value="poa">POA Selected</option>
                                    <option value="no_poa">No POA selected</option>
                                 </select>
                           </fieldset>
                        </div>
                        <div class="select-action">
                           <button type="button" class="btn btn-primary" onclick="actionPlates()" title="Keep existing plates and skip from import">Submit</button>
                        </div>
                     </div>
                     <div class="col-xs-12 col-lg-12 col-xl-12">

                        <div class="card-box">
                           <div class="table-rep-plugin">
                              <div class="table-wrapper">
                                 <div class="table-responsive" data-pattern="priority-columns">
                                    
                                    <table class="table table-striped table-bordered m-b-0" id="gridTable">
                                       <thead>
                                          <tr>
                                             <th width="8%" style="text-align: center;">
                                                <input type="checkbox" id="ckbCheckAll" />
                                             </th>
                                             <th width="10%">Sr No.</th>
                                             <th width="25%">Number Plate</th>
                                             <th width="30%">Company</th>
                                             <th width="20%">Price</th>
                                             <th width="15%">Status</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       </tbody>
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
<!-- Modal -->
<div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="companyModalLabel">Select Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                    
                     <div class="col-md-12">
                           <fieldset class="form-group">
                              <!-- <label for="name">Company</label> -->
                              <select required class="form-control" id="delete_company_id">
                                 <!-- <option value="">All Companies</option> -->
                               <?php      
                                foreach($company_list as $ckey => $company_name)
                                {
                                   if($ckey=='20')
                                   {
                                      $company_select="selected";
                                   }
                                   else
                                   {
                                      $company_select='';
                                   }
                                    echo '<option value='.$ckey.' '.$company_select.'>'.$company_name.'</option>';
                                }
                                ?>
                              </select>
                           </fieldset>
                     </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="companyPlatesDelete();">Delete plates</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="changecompanyModal" tabindex="-1" role="dialog" aria-labelledby="changecompanyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changecompanyModalLabel">Select Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                    
                     <div class="col-md-12">
                           <fieldset class="form-group">
                              <!-- <label for="name">Company</label> -->
                              <select required class="form-control" id="new_company_id">
                                 <option value="">Select Company</option>
                               <?php      
                                foreach($company_list as $ckey => $company_name)
                                {
                                   if($ckey=='20')
                                   {
                                      $company_select="selected";
                                   }
                                   else
                                   {
                                      $company_select='';
                                   }
                                    echo '<option value='.$ckey.' '.$company_select.'>'.$company_name.'</option>';
                                }
                                ?>
                              </select>
                           </fieldset>
                     </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="companyTagChange();">Update Plates</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    setTimeout(function() {
      $(".alert-success").hide();
      $(".alert-success p").text('');
      $(".alert-danger").hide();
      $(".alert-danger p").text('');      
    }, 3500);
  });

  function actionPlates() {
            var private_plates = [];
            $.each($("input[name='plate_ids']:checked"), function(){
                private_plates.push($(this).val());
            });
            var plate_ids=private_plates.join(",");
            var action_option_id=$("#action_option_id").val();
            if(action_option_id!="" && plate_ids!=""){
               $.ajax({
                  type: "POST",
                  url:"<?php echo site_url('admin/private_bulk_opration')?>",
                  data: {plate_ids:plate_ids,action:action_option_id},
                  success: function(result) {
                     if(result == 'success'){
                       location.reload();
                     }
                  },
                  async:false
               });
            }else{
               alert("Please select one option and submit.");
            }
   }
  
   function companyPlatesDelete() {
            
            var company_id=$("#delete_company_id").val();;
            $.ajax({
               type: "POST",
               url:"<?php echo site_url('admin/private_bulk_opration')?>",
               data: {company_id:company_id,action:"delete_by_company"},
               success: function(result){
                  if(result == 'success'){
                    location.reload();
                  }
               },
               async:false
            });
   }

   function companyTagChange() {
            
            var company_id=$("#new_company_id").val();

            var private_plates = [];
            $.each($("input[name='plate_ids']:checked"), function(){
                private_plates.push($(this).val());
            });
            var plate_ids=private_plates.join(",");

            $.ajax({
               type: "POST",
               url:"<?php echo site_url('admin/private_bulk_opration')?>",
               data: {company_id:company_id,plate_ids:plate_ids,action:"changed_company"},
               success: function(result){
                  if(result == 'success'){
                    location.reload();
                  }
               },
               async:false
            });
   }
</script>