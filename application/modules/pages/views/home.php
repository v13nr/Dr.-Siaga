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
	
	<!-- REVOLUTION STYLE SHEETS -->
	<link href="<?=base_url('application/views/templates/default/rev-slider-files/css/settings.css');?>" rel="stylesheet">
    
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
		<div id="rev_slider_72_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="doctor_slider_1" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
			<div id="rev_slider_72_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
				<ul>
					<!-- SLIDE  -->
					<li data-index="rs-188" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?=base_url('application/views/templates/default/rev-slider-files/assets/100x50_b9dee-42512210_ml.jpg');?>" data-delay="5150" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="<?=base_url('application/views/templates/default/rev-slider-files/assets/b9dee-42512210_ml.jpg');?>" alt="" data-bgposition="center center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="110" data-rotatestart="0" data-rotateend="0" data-blurstart="0" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->

						<!-- LAYER NR. 1 -->
						<div class="tp-caption   tp-resizeme" id="slide-188-layer-1" data-x="111" data-y="259" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":510,"speed":800,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3260","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 60px; line-height: 22px; font-weight: 700; color: #3f4177;font-family:Poppins;text-transform:uppercase;background-color:rgba(0, 122, 255, 0);">Provide </div>

						<!-- LAYER NR. 2 -->
						<div class="tp-caption   tp-resizeme" id="slide-188-layer-2" data-x="114" data-y="325" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1170,"speed":800,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"+2730","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 56px; line-height: 22px; font-weight: 700; color: #3f4177;font-family:Poppins;text-transform:uppercase;">Excellent Patient Experiences</div>
					</li>
					<!-- SLIDE  -->
					<li data-index="rs-189" data-transition="crossfade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?=base_url('application/views/templates/default/rev-slider-files/assets/100x50_4e36b-42512211_ml.jpg');?>" data-delay="5150" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src=<?=base_url('application/views/templates/default/rev-slider-files/assets/4e36b-42512211_ml.jpg');?>"" alt="" data-bgposition="center center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="110" data-rotatestart="0" data-rotateend="0" data-blurstart="0" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->

						<!-- LAYER NR. 3 -->
						<div class="tp-caption   tp-resizeme" id="slide-189-layer-1" data-x="161" data-y="center" data-voffset="-31" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":520,"speed":800,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"+3160","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 60px; line-height: 22px; font-weight: 700; color: #3f4177;font-family:Poppins;text-transform:uppercase;">Attract new patients </div>

						<!-- LAYER NR. 4 -->
						<div class="tp-caption   tp-resizeme" id="slide-189-layer-2" data-x="165" data-y="318" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1080,"speed":800,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"+2800","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 52px; line-height: 22px; font-weight: 700; color: #3f4177;font-family:Poppins;text-transform:uppercase;">and retain current patients</div>
					</li>
					<!-- SLIDE  -->
					<li data-index="rs-190" data-transition="crossfade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?=base_url('application/views/templates/default/rev-slider-files/assets/100x50_364e0-37885311_ml.jpg');?>" data-delay="5150" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="<?=base_url('application/views/templates/default/rev-slider-files/assets/364e0-37885311_ml.jpg');?>" alt="" data-bgposition="center center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="110" data-rotatestart="0" data-rotateend="0" data-blurstart="0" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->

						<!-- LAYER NR. 5 -->
						<div class="tp-caption   tp-resizeme" id="slide-190-layer-1" data-x="84" data-y="384" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":500,"speed":800,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"+3260","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 90px; line-height: 22px; font-weight: 700; color: #3f4177;font-family:Poppins;text-transform:uppercase;">Feel Good </div>

						<!-- LAYER NR. 6 -->
						<div class="tp-caption   tp-resizeme" id="slide-190-layer-2" data-x="79" data-y="454" data-width="['auto']" data-height="['auto']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":960,"speed":800,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"+2930","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 52px; line-height: 22px; font-weight: 700; color: #3f4177;font-family:Poppins;text-transform:uppercase;">and Happy! </div>
					</li>
				</ul>
				<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
			</div>
		</div>
		<!-- /REVOLUTION SLIDER -->

		<div class="container margin_120_95">
			<div class="main_title">
				<h2>Patient <strong>Relationship</strong> Management</h2>
				<p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie. Sed ad debet scaevola, ne mel.</p>
			</div>
			<div class="row add_bottom_30">
				<div class="col-lg-4">
					<div class="box_feat" id="icon_1">
						<span></span>
						<h3>Find a Doctor</h3>
						<p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="box_feat" id="icon_2">
						<span></span>
						<h3>View profile</h3>
						<p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="box_feat" id="icon_3">
						<h3>Book a visit</h3>
						<p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
					</div>
				</div>
			</div>
			<!-- /row -->
			<p class="text-center"><a href="list.html" class="btn_1 medium">Find Doctor</a></p>

		</div>
		<!-- /container -->

		<div class="bg_color_1">
			<div class="container margin_120_95">
				<div class="main_title">
					<h2>Most Viewed doctors</h2>
					<p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri.</p>
				</div>
				<div id="reccomended" class="owl-carousel owl-theme">
					<div class="item">
						<a href="detail-page.html">
							<div class="views"><i class="icon-eye-7"></i>140</div>
							<div class="title">
								<h4>Dr. Julia Holmes<em>Pediatrician - Cardiologist</em></h4>
							</div><img src="" alt="">
						</a>
					</div>
					<div class="item">
						<a href="detail-page.html">
							<div class="views"><i class="icon-eye-7"></i>120</div>
							<div class="title">
								<h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
							</div><img src="" alt="">
						</a>
					</div>
					<div class="item">
						<a href="detail-page.html">
							<div class="views"><i class="icon-eye-7"></i>115</div>
							<div class="title">
								<h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
							</div><img src="" alt="">
						</a>
					</div>
					<div class="item">
						<a href="detail-page.html">
							<div class="views"><i class="icon-eye-7"></i>98</div>
							<div class="title">
								<h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
							</div><img src="" alt="">
						</a>
					</div>
					<div class="item">
						<a href="detail-page.html">
							<div class="views"><i class="icon-eye-7"></i>98</div>
							<div class="title">
								<h4>Dr. Julia Holmes<em>Pediatrician</em></h4>
							</div><img src="" alt="">
						</a>
					</div>
				</div>
				<!-- /carousel -->
			</div>
			<!-- /container -->
		</div>
		<!-- /white_bg -->

		<div class="container margin_120_95">
			<div class="main_title">
				<h2>Find your doctor or clinic</h2>
				<p>Nec graeci sadipscing disputationi ne, mea ea nonumes percipitur. Nonumy ponderum oporteat cu mel, pro movet cetero at.</p>
			</div>
			<div class="row justify-content-center">
				<div class="col-xl-4 col-lg-5 col-md-6">
					<div class="list_home">
						<div class="list_title">
							<i class="icon_pin_alt"></i>
							<h3>Search by City or Zone</h3>
						</div>
						<ul>
							<li><a href="#0"><strong>23</strong>Albany</a></li>
							<li><a href="#0"><strong>23</strong>Albuquerque</a></li>
							<li><a href="#0"><strong>23</strong>Atlanta</a></li>
							<li><a href="#0"><strong>23</strong>Baltimore</a></li>
							<li><a href="#0"><strong>23</strong>Baton Rouge</a></li>
							<li><a href="#0"><strong>23</strong>Birmingham</a></li>
							<li><a href="#0"><strong>23</strong>Boston</a></li>
							<li><a href="#0"><strong>23</strong>Buffalo</a></li>
							<li><a href="#0"><strong>23</strong>Charleston</a></li>
							<li><a href="#0">More...</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xl-4 col-lg-5 col-md-6">
					<div class="list_home">
						<div class="list_title">
							<i class="icon_archive_alt"></i>
							<h3>Search by type</h3>
						</div>
						<ul>
							<li><a href="#0"><strong>23</strong>Allergist</a></li>
							<li><a href="#0"><strong>23</strong>Cardiologist</a></li>
							<li><a href="#0"><strong>23</strong>Chiropractor</a></li>
							<li><a href="#0"><strong>23</strong>Dentist</a></li>
							<li><a href="#0"><strong>23</strong>Dermatologist</a></li>
							<li><a href="#0"><strong>23</strong>Gastroenterologist</a></li>
							<li><a href="#0"><strong>23</strong>Ophthalmologist</a></li>
							<li><a href="#0"><strong>23</strong>Optometrist</a></li>
							<li><a href="#0"><strong>23</strong>Pediatrician</a></li>
							<li><a href="#0">More....</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->

		<div id="app_section">
			<div class="container">
				<div class="row justify-content-around">
					<div class="col-md-5">
						<p><img src="img/app_img.svg" alt="" class="img-fluid" width="500" height="433"></p>
					</div>
					<div class="col-md-6">
						<small>Application</small>
						<h3>Download <strong>Findoctor App</strong> Now!</h3>
						<p class="lead">Tota omittantur necessitatibus mei ei. Quo paulo perfecto eu, errem percipit ponderum no eos. Has eu mazim sensibus. Ad nonumes dissentiunt qui, ei menandri electram eos. Nam iisque consequuntur cu.</p>
						<div class="app_buttons wow" data-wow-offset="100">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.1 85.9" style="enable-background:new 0 0 43.1 85.9;" xml:space="preserve">
							<path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow" d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1" />
							<path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-1" d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58" />
							<path stroke-linecap="round" stroke-linejoin="round" class="draw-arrow tail-2" d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9" />
						</svg>
							<a href="#0" class="fadeIn"><img src="img/apple_app.png" alt="" width="150" height="50" data-retina="true"></a>
							<a href="#0" class="fadeIn"><img src="img/google_play_app.png" alt="" width="150" height="50" data-retina="true"></a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /app_section -->
	</main>
	<!-- /main content -->
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
						<li><a href="<?=base_url('pages/contact');?>">Contact Us</a></li>
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
	<script src="<?=base_url('application/views/templates/default/js/tables_func.js');?>"></script>
	
	<!-- REVOLUTION SLIDER SCRIPTS -->
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/jquery.themepunch.tools.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/jquery.themepunch.revolution.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/extensions/revolution.extension.actions.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/extensions/revolution.extension.carousel.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/extensions/revolution.extension.kenburn.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/extensions/revolution.extension.layeranimation.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/extensions/revolution.extension.migration.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/extensions/revolution.extension.navigation.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/extensions/revolution.extension.parallax.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/extensions/revolution.extension.slideanims.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('application/views/templates/default/rev-slider-files/js/extensions/revolution.extension.video.min.js');?>"></script>
	<script type="text/javascript">
			var tpj=jQuery;
			var revapi72;
			tpj(document).ready(function() {
				if(tpj("#rev_slider_72_1").revolution == undefined){
					revslider_showDoubleJqueryError("#rev_slider_72_1");
				}else{
					revapi72 = tpj("#rev_slider_72_1").show().revolution({
						sliderType:"standard",
						jsFileLocation:"rev-slider-files/js/",
						sliderLayout:"auto",
						dottedOverlay:"none",
						delay:9000,
						navigation: {
							keyboardNavigation:"off",
							keyboard_direction: "horizontal",
							mouseScrollNavigation:"off",
                             mouseScrollReverse:"default",
							onHoverStop:"off",
							touch:{
								touchenabled:"on",
								touchOnDesktop:"off",
								swipe_threshold: 75,
								swipe_min_touches: 1,
								swipe_direction: "horizontal",
								drag_block_vertical: false
							}
							,
							arrows: {
								style:"gyges",
								enable:true,
								hide_onmobile:true,
								hide_under:560,
								hide_onleave:true,
								hide_delay:200,
								hide_delay_mobile:1200,
								tmp:'',
								left: {
									h_align:"left",
									v_align:"center",
									h_offset:20,
                                    v_offset:0
								},
								right: {
									h_align:"right",
									v_align:"center",
									h_offset:20,
                                    v_offset:0
								}
							}
						},
						visibilityLevels:[1240,1024,778,480],
						gridwidth:1240,
						gridheight:600,
						lazyType:"none",
						shadow:0,
						spinner:"spinner0",
						stopLoop:"off",
						stopAfterLoops:-1,
						stopAtSlide:-1,
						shuffle:"off",
						autoHeight:"off",
						disableProgressBar:"on",
						hideThumbsOnMobile:"off",
						hideSliderAtLimit:0,
						hideCaptionAtLimit:0,
						hideAllCaptionAtLilmit:0,
						debugMode:false,
						fallbacks: {
							simplifyAll:"off",
							nextSlideOnWindowFocus:"off",
							disableFocusListener:false,
						}
					});
				}
			});	/*ready*/
	</script>

</body>
</html>