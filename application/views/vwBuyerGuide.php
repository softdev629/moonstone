<div class="about-sec">
   <div class="container-fluid">
      <div class="row">
         <?php
                $this->load->view('controls/vwLeft');
         ?>
         <div class="col-md-9">
            <div class="tab-content wow fadeInUp" data-wow-duration="1s">
               <div class="tab-pane container active" id="faqs">
                  <h2><strong><?php echo $content->page_name; ?></strong></h2>
                  <?php echo $content->page_description; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
</div>