<div class="about-sec">
  <div class="container-fluid">
    <div class="section-header">
      <h3>Reset password</h3>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <?php if ($this->session->flashdata('error')) { ?>
          <div class="alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p><?php echo $this->session->flashdata('error'); ?></p>
          </div>
        <?php } ?>
        <?php if ($this->session->flashdata('success')) { ?>
          <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p><?php echo $this->session->flashdata('success'); ?></p>
          </div>
        <?php } ?>
        <form class="form-default  m-t-20" action="<?php echo base_url(); ?>reset-password/<?php echo $token; ?>" method="post">
          <div class="form-group ">
            <div class="col-xs-12">
              <input class="form-control" type="password" name="password" id="password" required="" value="" placeholder="New password">
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-12">
              <input class="form-control" type="password" name="conf_password" id="conf_password" value="" required="" placeholder="Confirm password">
            </div>
          </div>
          <div class="form-group text-center m-t-30">
            <div class="col-xs-12">
              <input type="submit" name="submit" class="btn btn-styled btn-base-1" value="Submit">
            </div>
          </div>
        </form>
      </div>
    </div>
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
</script>
<?php if ($this->session->flashdata('success')) { ?>
  <script type="text/javascript">
  $(document).ready(function () {
    setTimeout(function() {
      window.location.href = "<?php echo base_url(); ?>";
    }, 3500);
  });
</script>
<?php } ?>