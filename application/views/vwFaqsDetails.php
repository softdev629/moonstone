<div class="about-sec">
    <div class="container-fluid">
       <div class="row">
          <?php
                $this->load->view('controls/vwLeft',$page);
          ?>
          <div class="col-md-9">
            <div class="accordion" id="accordionExample">
            
               <div class="card">
                      <div class="card-header" id="heading<?php echo $faqs_list->id; ?>">
                        <h2 class="mb-0">
                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $faqs_list->id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $faqs_list->id; ?>">
                            <?php echo $faqs_list->question; ?>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse<?php echo $faqs_list->id; ?>" class="collapse show" aria-labelledby="heading<?php echo $faqs_list->id; ?>" data-parent="#accordionExample">
                        <div class="card-body">
                          <?php echo $faqs_list->answer; ?>
                        </div>
                      </div>
               </div>
            
            </div>
         </div>
       </div>
    </div>
</div>
</div>
</div>
</div>
