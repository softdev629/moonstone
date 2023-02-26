<div class="about-sec">
    <div class="container-fluid">
       <div class="row">
          <?php
                $this->load->view('controls/vwLeft',$page);
          ?>
          <div class="col-md-9">
            <div class="accordion" id="accordionExample">
            <?php
            foreach ($faqs_list as $key => $faq_value) {
            ?>
            <h2 class="secondary-heading mt-4 mb-4">
              <?php echo $key; ?>
            </h2>
            <?php
            foreach ($faq_value as $k => $faq_v) {
            ?>
               <div class="card">
                      <div class="card-header" id="heading<?php echo $k; ?>">
                        <h2 class="mb-0">
                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $k; ?>" aria-expanded="true" aria-controls="collapse<?php echo $k; ?>">
                            <?php echo $faq_v['question']; ?>
                          </button>
                        </h2>
                      </div>
                      <div id="collapse<?php echo $k; ?>" class="collapse" aria-labelledby="heading<?php echo $k; ?>" data-parent="#accordionExample">
                        <div class="card-body">
                          <?php echo $faq_v['answer']; ?>
                        </div>
                      </div>
               </div>
            <?php
            }
            ?>   
            <?php
            }
            ?>
            </div>
         </div>
       </div>
    </div>
</div>
</div>
</div>
</div>
