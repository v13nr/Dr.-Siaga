<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Template			: 
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
	
	<!-- SPECIFIC CSS -->
	<link href="<?=base_url('application/views/templates/default/css/tables.css');?>" rel="stylesheet">
    
	<!-- YOUR CUSTOM CSS -->
	<link href="<?=base_url('application/views/templates/default/css/custom.css');?>" rel="stylesheet">
	
	<!-- Modernizr -->
	<script src="<?=base_url('application/views/templates/default/js/modernizr_tables.js');?>"></script>
	
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
					<div id="logo_home">
						<h1><a href="<?=base_url();?>" title="Doktersiaga">Doktersiaga</a></h1>
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
										<a href="#0">Automatic Customer Services</a>
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
		<div id="map_contact"></div>
		<!-- /map -->
		
		<div class="container margin_60_35">
			<div class="row">
				<aside class="col-lg-3 col-md-4">
					<div id="contact_info">
						<h3>Contacts info</h3>
						<p>
							11 Fifth Ave - New York, US<br> + 61 (2) 8093 3400<br>
							<a href="#">info@domain.com</a>
						</p>
						<h4>Get directions</h4>
						<form action="http://maps.google.com/maps" method="get" target="_blank">
							<div class="form-group">
								<input type="text" name="saddr" placeholder="Enter your location" class="form-control styled">
								<input type="hidden" name="daddr" value="New York, NY 11430">
								<!-- Write here your end point -->
							</div>
							<input type="submit" value="Get directions" class="btn_1 add_bottom_45">
						</form>
						<ul>
							<li><strong>Administration</strong>
								<a href="tel://003823932342">0038 23932342</a><br><a href="tel://003823932342">admin@findoctor.com</a><br>
								<small>Monday to Friday 9am - 7pm</small>
							</li>
							<li><strong>General questions</strong>
								<a href="tel://003823932342">0038 23932342</a><br><a href="tel://003823932342">questions@findoctor.com</a><br>
								<p><small>Monday to Friday 9am - 7pm</small></p>
							</li>
						</ul>
					</div>
				</aside>
				<!--/aside -->
				<div class=" col-lg-8 col-md-8 ml-auto">
					<div class="box_general">
						<h3>Contact us</h3>
						<p>
							Mussum ipsum cacilds, vidis litro abertis.
						</p>
						<div>
							<div id="message-contact"></div>
							<form method="post" action="https://doktersiaga.com/pages/contact/send_mail_contact">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" id="name_contact" name="name_contact" placeholder="Name">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" id="lastname_contact" name="lastname_contact" placeholder="Last name">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="email" id="email_contact" name="email_contact" class="form-control" placeholder="Email">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="text" id="phone_contact" name="phone_contact" class="form-control" placeholder="Mobile/Whatsapp number">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<textarea rows="5" id="message_contact" name="message_contact" class="form-control" style="height:100px;" placeholder="Hello world!"></textarea>
										</div>
									</div>
								</div>
								<input type="submit" value="Submit" class="btn_1 add_top_20">
							</form>
						</div>
						<!-- /col -->
					</div>
				</div>
				<!-- /col -->
			</div>
			<!-- End row -->
		</div>
		<!-- /container -->
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
	
	<!-- SPECIFIC SCRIPTS -->
	<script src="<?=base_url('application/views/templates/default/assets/validate.js');?>"></script>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="<?=base_url('application/views/templates/default/js/mapmarker.jquery.js');?>"></script>
	<script src="<?=base_url('application/views/templates/default/js/mapmarker_contacts_func.js');?>"></script>

</body>
</html>