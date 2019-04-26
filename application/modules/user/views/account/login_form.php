<?php 

/**
 *	Copyright (C)	: Kaio Piranti Lunak
 *	Developer		: Fatah Iskandar Akbar
 *  Email			: kaiosoftware@gmail.com
 *	Date			: Juni 2015
 *	Module version	: 1.0.0
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="<?=$keyword;?>">
	<meta name="description" content="<?=$desc;?>">
	<meta name="author" content="Doktersiaga">
	<title>Doktersiaga - <?=$title;?></title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="<?=base_url('application/views/templates/default/img/favicon.ico');?>" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="<?=base_url('application/views/templates/default/img/apple-touch-icon-57x57-precomposed.png');?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?=base_url('application/views/templates/default/img/apple-touch-icon-72x72-precomposed.png');?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?=base_url('application/views/templates/default/img/apple-touch-icon-114x114-precomposed.png');?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?=base_url('application/views/templates/default/img/apple-touch-icon-144x144-precomposed.png');?>">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
  
	<!-- BASE CSS -->
	<link href="<?=base_url('application/views/templates/default/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/views/templates/default/css/style.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/views/templates/default/css/menu.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/views/templates/default/css/vendors.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/views/templates/default/css/icon_fonts/css/all_icons_min.css');?>" rel="stylesheet">
	
</head>

<body>

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->
    
	<header class="header_sticky">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-6">
					<div id="logo">
						<a href="https://doktersiaga.id" title="Doktersiaga"><img src="<?=base_url('application/views/templates/default/img/logo.png');?>" data-retina="true" alt="" width="163" height="36"></a>
					</div>
				</div>
				<nav class="col-lg-9 col-6">
					<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
					<ul id="top_access">
						<li><a href="<?=base_url('user/account/login');?>" class="btn_1 small" style="color:white">Login</a></li>
					</ul>
					<div class="main-menu">
						<ul>
							<li class="submenu">
								<a href="https://doktersiaga.id">Home</a>
							</li>
							<li class="submenu">
								<a href="#0" class="show-submenu">Product<i class="icon-down-open-mini"></i></a>
								<ul>
									<li>
										<a href="#0">Hospital Bot</a>
									</li>
									<li>
										<a href="#0">Patient Relationship Management</a>
									</li>
									<li>
										<a href="#0">API Gateway</a>
									</li>									
								</ul>
							</li>
							<li class="submenu">
								<a href="#0" class="show-submenu">Solution<i class="icon-down-open-mini"></i></a>
								<ul>
                                    <li><a href="booking-page.html">Hospital</a></li>
                                    <li><a href="confirm.html">Goverment</a></li>
									<li><a href="confirm.html">Startup</a></li>
								</ul>
							</li>
							<li>
								<a href="<?=base_url('pages/price');?>">Price</a>
							</li>
							<li>
								<a href="#0">FAQ</a>
							</li>
							<li><a href="https://doktersiaga.com" target="_blank">Community</a></li>
						</ul>
					</div>
					<!-- /main-menu -->
				</nav>
			</div>
		</div>
		<!-- /container -->
	</header>
	<!-- /header -->
	
	<main>
		<div class="bg_color_2">
			<div class="container margin_60_35">
				<div id="login-2">
					<h1>Please login to Doktersiaga!</h1>
					<form method="POST" action="<?=site_url('auth/login');?>" role="form">
						<div class="box_form clearfix">
							<div class="box_login">
								<a href="#0" class="social_bt facebook">Login with Facebook</a>
								<a href="#0" class="social_bt google">Login with Google</a>
							</div>
							<div class="box_login last">
								<div class="form-group">
									<input type="email" name="data[email]"class="form-control" placeholder="Your email address">
									<?php echo form_error('login');?>
								</div>
								<div class="form-group">
									<input type="password" name="data[password]" class="form-control" placeholder="Your password" name="password" id="password">
									<?php echo form_error('password');?>      
									<a href="#0" class="forgot"><small>Forgot password?</small></a>
								</div>
								<div class="form-group">
									<input class="btn_1" type="submit" value="Login">
								</div>
							</div>
						</div>
						<input type="hidden" name="url" value="<?=$url;?>">
					</form>
					<p class="text-center link_bright">Do not have an account yet? <a href="<?=base_url('pages/price/');?>"><strong>Register now!</strong></a></p>
				</div>
				<!-- /login -->
			</div>
		</div>
	</main>
	<!-- /main -->
	
	<footer>
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-3 col-md-12">
					<p>
						<a href="index.html" title="Doktersiaga">
							<img src="<?=base_url('application/views/templates/default/img/logo.png');?>" data-retina="true" alt="" width="163" height="36" class="img-fluid">
						</a>
					</p>
				</div>
				<div class="col-lg-3 col-md-4">
					<h5>About</h5>
					<ul class="links">
						<li><a href="#0">About us</a></li>
						<li><a href="blog.html">Blog</a></li>
						<li><a href="#0">FAQ</a></li>
						<li><a href="login.html">Login</a></li>
						<li><a href="register.html">Register</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-4">
					<h5>Useful links</h5>
					<ul class="links">
						<li><a href="#0">Doctors</a></li>
						<li><a href="#0">Clinics</a></li>
						<li><a href="#0">Specialization</a></li>
						<li><a href="#0">Join as a Doctor</a></li>
						<li><a href="#0">Download App</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-4">
					<h5>Contact with Us</h5>
					<ul class="contacts">
						<li>PT Doktersiaga Teknologi Indonesia</li>
						<li><a href="tel://61280932400"><i class="icon_mobile"></i> + 62 812 1915 0929</a></li>
						<li><a href="mailto:info@doktersiaga.com"><i class="icon_mail_alt"></i> info@doktersiaga.com</a></li>
					</ul>
					<div class="follow_us">
						<h5>Follow us</h5>
						<ul>
							<li><a href="#0"><i class="social_facebook"></i></a></li>
							<li><a href="#0"><i class="social_twitter"></i></a></li>
							<li><a href="#0"><i class="social_linkedin"></i></a></li>
							<li><a href="#0"><i class="social_instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<!--/row-->
			<hr>
			<div class="row">
				<div class="col-md-8">
					<ul id="additional_links">
						<li><a href="#0">Terms and conditions</a></li>
						<li><a href="#0">Privacy</a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<div id="copy">© 2019 Doktersiaga</div>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
	<script src="<?=base_url('application/views/templates/default/js/jquery-2.2.4.min.js');?>"></script>
	<script src="<?=base_url('application/views/templates/default/js/common_scripts.min.js');?>"></script>
	<script src="<?=base_url('application/views/templates/default/js/functions.js');?>"></script>

</body>
</html>