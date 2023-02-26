
   <form class="form-default  m-t-20" action="<?php echo base_url(); ?>poa-check" id="poa-form">
   
   
   <div class="row">
   
    <input type="hidden" name="plate_modal_id" id="plate_modal_id" value="<?php echo $plate_id; ?>">
    <input type="hidden" name="plate_number" id="plate_number" value="<?php echo $plates_number; ?>">
	
	
      <div class="col-md-12 mb-3">
              <input class="form-control" type="text" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $first_name; ?>">
      </div>
	  
      
          <div class="col-md-12 mb-3">
              <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>">
          </div>
	  
      <div class="col-md-12 mb-3">
        <?php
        $email_read_only="";
        if($email!=""){
        $email_read_only="readonly";
        }
        ?>
          
              <input class="form-control" type="email" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" <?php echo $email_read_only; ?>>
          
      </div>
	  
      <div class="col-md-12 mb-3">
              <input class="form-control" type="text" name="mobile_number" id="mobile_number" placeholder="Mobile">
          
      </div>

      
          <div class="col-md-12 mb-3">
              <select name="poa_type" id="poa_type" class="form-control">
                <option value="">Select Type</option>
                <option value="Offer">Offer</option>
                <option value="Enquiring">Enquiring</option>
              </select>
        </div>
      
	  
      
          <div class="col-md-12 mb-3">
              <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message"></textarea>                      
          </div>
      
	  
	  </div>
	  
      <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
              <input type="submit" style="border-radius:0;" name="submit" id="poa_submit" class="btn btn-styled black-btn" value="POA Submit">
			  <button type="button" style="border-radius:0;" class="btn btn-styled black-brd-btn"><a style="text-decoration: none; color: #000;" href="javascript:void(0);" data-dismiss="modal" aria-label="Close">Cancel</a></button>
          </div>
      </div>
	  
	  
   </form>



