<?php
include '../config.php';

if (isset($_POST['submit'])) {
	$admin = new Admin();
	if ($admin->login($_POST['password'])) {
		$admin->startSession();
		header('Location: ./');
	}
}
?>
<!DOCTYPE html>
<html class="loading" lang="vi" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
	<title>Đăng nhập vào Trang quản trị của WibuTeam</title>
	<link rel="apple-touch-icon" href="./app-assets/images/favicon/apple-touch-icon-152x152.png" />
	<link rel="shortcut icon" type="image/x-icon" href="./app-assets/images/favicon/favicon-32x32.png" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<!-- BEGIN: VENDOR CSS-->
	<link rel="stylesheet" type="text/css" href="./app-assets/vendors/vendors.min.css" />
	<!-- END: VENDOR CSS-->
	<!-- BEGIN: Page Level CSS-->
	<link rel="stylesheet" type="text/css" href="./app-assets/css/themes/vertical-modern-menu-template/materialize.css" />
	<link rel="stylesheet" type="text/css" href="./app-assets/css/themes/vertical-modern-menu-template/style.css" />
	<link rel="stylesheet" type="text/css" href="./app-assets/css/pages/lock.css" />
	<!-- END: Page Level CSS-->
	<!-- BEGIN: Custom CSS-->
	<link rel="stylesheet" type="text/css" href="./app-assets/css/custom/custom.css" />
	<!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column forgot-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
	<div class="row">
		<div class="col s12">
			<div class="container">
				<div id="lock-screen" class="row">
					<div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 forgot-card bg-opacity-8">
						<form class="login-form" method="POST" action="">
							<div class="row">
								<div class="input-field col s12 center-align mt-10">
									<img class="z-depth-4 circle responsive-img" width="100" src="https://i.pinimg.com/originals/46/6e/70/466e70b66143c4cd013324676980f642.gif" alt="">
									<h5>Admin</h5>
								</div>
							</div>
							<div class="row margin">
								<div class="input-field col s12">
									<i class="material-icons prefix pt-2">lock_outline</i>
									<input id="password" type="password" name="password" />
									<label for="password">Mật khẩu</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<button type="submit" name="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Đăng nhập</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="content-overlay"></div>
		</div>
	</div>

	<!-- BEGIN VENDOR JS-->
	<script src="./app-assets/js/vendors.min.js"></script>
	<!-- BEGIN VENDOR JS-->
	<!-- BEGIN PAGE VENDOR JS-->
	<!-- END PAGE VENDOR JS-->
	<!-- BEGIN THEME  JS-->
	<script src="./app-assets/js/plugins.js"></script>
	<script src="./app-assets/js/search.js"></script>
	<script src="./app-assets/js/custom/custom-script.js"></script>
	<!-- END THEME  JS-->
	<!-- BEGIN PAGE LEVEL JS-->
	<!-- END PAGE LEVEL JS-->
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
</body>

</html>