<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moonstone | Admin</title>
        <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/admin/css/custom.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">

            <div class="account-bg">
                <div class="card-box m-b-0">
                    <div class="text-xs-center m-t-20">
                        <a href="<?php echo base_url(); ?>admin" class="logo">
                            <img src="<?php echo base_url(); ?>assets/admin/images/logo-black.svg" alt="logo">
                        </a>
                    </div>
                    <div class="m-t-30 m-b-20">
                        <?php  if(isset($error) && $error !='') { ?>
                          <div class="alert alert-danger">
                            <p>
                              <?php echo $error?>
                            </p>
                          </div>
                        <?php } ?>
                        <?php  if(isset($success) && $success !='') { ?>
                          <div class="alert alert-success">
                            <p>
                              <?php echo $success?>
                            </p>
                          </div>
                        <?php } ?>
                        <?php echo validation_errors(); ?>
                        <form class="form-horizontal m-t-20 da-home-form" action="<?php echo base_url(); ?>admin/reset-password/<?php echo $token; ?>" method="post">

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" id="password" name="password" type="password" required="" placeholder="New password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input name="conf_password" id="conf_password" class="form-control" type="password" required="" placeholder="Confirm password">
                                </div>
                            </div>
                            <div class="form-group text-center m-t-30">
                                <div class="col-xs-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Submit</button>
                                </div>
                            </div>

                            <div class="form-group m-t-30 m-b-0">
                                <div class="col-sm-12 text-xs-center">
                                    <a href="<?php echo base_url(); ?>admin" class="text-muted"><i class="fa fa-sign-in m-r-5"></i> Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end card-box-->

        </div>
        <!-- end wrapper page -->
        <script>
            var resizefunc = [];
        </script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/tether.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/waves.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/additional-methods.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/common.js"></script>
    </body>
</html>