<?php if($this->session->flashdata('msg')){ ?>
<div class="alert alert-success">  <p> <?php echo $this->session->flashdata('msg'); ?></p> </div>
<?php }
?>
<?php if($this->session->flashdata('error')){ ?>
<div class="alert alert-danger">  <p> <?php echo $this->session->flashdata('error'); ?></p> </div>
<?php
}
?>
<?php if(isset($error) && $error!=""){ ?>
<div class="alert alert-danger">  <p> <?php echo $error; ?></p> </div>
<?php }?>
