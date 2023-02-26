<!DOCTYPE html>

<html lang="en">
<head>
	<base href="./">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Moonstone Plates</title>

	<!-- Icons-->
	<link href="/assets/vendors/coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
	<link href="/assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
	<link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="/assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
	<!-- Main styles for this application-->
	<link href="/css/custom.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">

	<link href="/assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
	<link href="/assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />


</head>
<body class="app flex-row align-items-center login-body">
<div class="container">



	<div class="row content">
		<div class="col-md-4 col-sm-12">
			<h2>Moonstone Plates<span class="badge badge-primary"></span></h3>
				<h2 class="display-2 white"></h2>


					<p class="text-muted white">We are currently undergoing maintenance.
						We will be back soon.
						 </p>

					<div class="row">

					</div>

		</div>
		<div class="col-md-8 text-right">

		<img src="https://www.moonstoneplates.com/assets/images/logo.svg" class="image_login" width="350">
		</div>


	</div>
</div>
<div class="rotated-block"></div>

</div>

<script src="/assets/vendors/jquery/js/jquery.min.js"></script>
<script src="/assets/vendors/popper.js/js/popper.min.js"></script>
<script src="/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/vendors/pace-progress/js/pace.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
<script src="/assets/vendors/coreui/coreui-pro/js/coreui.min.js"></script>
<script src="/assets/vendors/toastr/js/toastr.js"></script>
<script src="/assets/js/main.js"></script>
<script src="/assets/js/login.js?<?php echo uniqid(); ?>"></script>

<script>
	$('#ui-view').ajaxLoad();
	$(document).ajaxComplete(function () {
		Pace.restart()
	});
</script>
</body>
</html>
