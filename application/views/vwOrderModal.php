<div class="">
   <div class="row">
      <div class="col-md-6">

         <table class="table table-striped flip-content">
               <tbody>
                  
                  <tr>
                      <td width="40%" class="text-left">
                          <b>Name : </b>
                      </td>
                      <td width="60%" class="text-left">
                          <?php echo $order_details->name; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>Email : </b>
                      </td>
                      <td width="60%" class="text-left">
                          <?php echo $order_details->email; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>Phone : </b>
                      </td>
                      <td width="60%" class="text-left">
                          <?php echo $order_details->phone_number; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>Address : </b>
                      </td>
                      <td width="60%" class="text-left">
                          <?php echo $order_details->address; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>City : </b>
                      </td>
                      <td width="60%" class="text-left">
                          <?php echo $order_details->city; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>Country : </b>
                      </td>
                      <td width="60%" class="text-left">
                          <?php echo $order_details->country; ?>              
                      </td>
                  </tr>
                  
               </tbody>
         </table>
      </div>
      <div class="col-md-6">
         <table class="table table-striped flip-content">
               <tbody>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>Order No : </b>
                      </td>
                      <td width="60%" class="text-left">
                          <?php echo $order_details->order_id; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>Number Plate : </b>
                      </td>
                      <td width="60%" class="text-left">
                          <?php echo $order_details->plates_number; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="50%" class="text-left">
                          <b>Shiping Charge : </b>
                      </td>
                      <td width="50%" class="text-left">
                          £<?php echo $order_details->shiping_charge; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>DVLA Charge : </b>
                      </td>
                      <td width="60%" class="text-left">
                          £<?php echo $order_details->dvla_charge; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>Tax Price : </b>
                      </td>
                      <td width="60%" class="text-left">
                          £<?php echo $order_details->tax_price; ?>              
                      </td>
                  </tr>
                  <tr>
                      <td width="40%" class="text-left">
                          <b>Total : </b>
                      </td>
                      <td width="60%" class="text-left">
                          £<?php echo $order_details->total_price; ?>              
                      </td>
                  </tr>
               </tbody>
         </table>
      </div>
   </div>
</div>
