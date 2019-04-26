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
	
	<div id="breadcrumb">
		<div class="container">
			<ul>
				<li><a href="<?=base_url();?>">Home</a></li>
				<li><?=$title;?></li>
			</ul>
		</div>
	</div>
	<!-- /breadcrumb -->
	<div class="margin_60_35">
		<div class="container">
			<div class="main_title">
				<h1><?=$subtitle;?></h1>
				<p>Version with monthly/year switcher</p>
			</div>
		</div>
		
		<div class="pricing-container cd-has-margins">
		<div class="pricing-switcher">
			<p class="fieldset">
				<input type="radio" name="duration-2" value="monthly" id="monthly-2" checked>
				<label for="monthly-2">Monthly</label>
				<input type="radio" name="duration-2" value="yearly" id="yearly-2">
				<label for="yearly-2">Yearly</label>
				<span class="switch"></span>
			</p>
		</div>
		<!--/pricing-switcher -->
		<ul class="pricing-list bounce-invert">
			<li>
				<ul class="pricing-wrapper">
					<li data-type="monthly" class="is-visible">
						<header class="pricing-header">
							<h2>Personal</h2>

							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">FREE</span>
								<!--<span class="price-duration">bln</span>-->
							</div>
						</header>
						<!-- /pricing-header -->
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Appoitment</li>
								<li><em> </em>https://m.me/doktersiaga</li>
								<li><em>FACEBOOK PAGE FITUR  </em></li>
								<li><em></em>Posting  </li>
								<li><em></em>Inbox  </li>
								<li><em>DOKTERSIAGA COMMUNITY  </em></li>
								<li><em></em>Blog</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em>OTHERS  </em></li>
								<li><em></em>Admin Dashboard </li>
								<li><em>1</em> Poli</li>
								<li><em>1</em> Dokter</li>
								<li><em>-</em> </li>
								<li><em>1</em> Faskes</li>
								<li><em></em> Sharing Bot Messanger</li>
								<li><em></em> </li>
							</ul>
						</div>
						<!-- /pricing-body -->
						<footer class="pricing-footer">
							<h2>PREMIUM</h2>
							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">100 K</span>
								<span class="price-duration">bln</span>
							</div>
						</footer>
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em> </em>-</li>								
								<li><em> </em>Layanan Unggulan</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em>Private</em> Bot Messenger</li>
								<li><em></em>https://m.me/namafaskes</li>
								<li><em> </em>-</li>
								<li><em></em>Fitur yang terdapat di free edition</li>
								<li><em></em>Statistik</li>
								<li><em>Limited</em> Support</li>			
							</ul>	
						</div>
						<footer class="pricing-footer">
							<a class="select-plan" href="<?=base_url('user/account/customer_form_register/100/bulanan');?>">Coba Gratis</a>
						</footer>
					</li>
					<li data-type="yearly" class="is-hidden">
						<header class="pricing-header">
							<h2>Personal</h2>

							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">FREE</span>
								<!--<span class="price-duration">bln</span>-->
							</div>
						</header>
						<!-- /pricing-header -->
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Appoitment</li>
								<li><em> </em>https://m.me/doktersiaga</li>
								<li><em>FACEBOOK PAGE FITUR  </em></li>
								<li><em></em>Posting  </li>
								<li><em></em>Inbox  </li>
								<li><em>DOKTERSIAGA COMMUNITY  </em></li>
								<li><em></em>Blog</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em>OTHERS  </em></li>
								<li><em></em>Admin Dashboard </li>
								<li><em>1</em> Poli</li>
								<li><em>1</em> Dokter</li>
								<li><em>-</em> </li>
								<li><em>1</em> Faskes</li>
								<li><em></em> Sharing Bot Messanger</li>
								<li><em></em> </li>
							</ul>
						</div>
						<!-- /pricing-body -->
						<footer class="pricing-footer">
							<h2>PREMIUM</h2>
							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">1,14 jt</span>
								<span class="price-duration">thn</span>
							</div>
						</footer>
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em> </em>-</li>								
								<li><em> </em>Layanan Unggulan</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em> </em>-</li>
								<li><em>Private</em> Bot Messenger</li>
								<li><em></em>https://m.me/namafaskes</li>
								<li><em> </em>-</li>
								<li><em></em>Fitur yang terdapat di free edition</li>
								<li><em></em>Statistik</li>
								<li><em>Limited</em> Support</li>		
							</ul>	
						</div>
						<footer class="pricing-footer">
							<a class="select-plan" href="<?=base_url('user/account/customer_form_register/100/tahunan');?>">Coba Gratis</a>
						</footer>
					</li>
				</ul>
				<!-- /pricing-wrapper -->
			</li>
			<li>
				<ul class="pricing-wrapper">
					<li data-type="monthly" class="is-visible">
						<header class="pricing-header">
							<h2>Professional</h2>
							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">FREE</span>
								<!--<span class="price-duration">bln</span>-->
							</div>
						</header>
						<!-- /pricing-header -->
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Appoitment</li>
								<li><em> </em>https://m.me/doktersiaga</li>
								<li><em>FACEBOOK PAGE FITUR  </em></li>
								<li><em></em>Posting  </li>
								<li><em></em>Inbox  </li>
								<li><em>DOKTERSIAGA COMMUNITY  </em></li>
								<li><em></em>Blog</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Promo</li>
								<li><em> </em>MCU</li>
								<li><em>OTHERS  </em></li>
								<li><em></em>Admin Dashboard </li>
								<li><em>3</em> Poli</li>
								<li><em>3</em> Dokter</li>
								<li><em>4</em> User</li>
								<li><em>1</em> Faskes</li>
								<li><em></em> Sharing Bot Messanger</li>
								<li><em></em></li>
							</ul>
						</div>
						<!-- /pricing-body -->
						<footer class="pricing-footer">
							<h2>PREMIUM</h2>
							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">350 rb</span>
								<span class="price-duration">bln</span>
							</div>
						</footer>
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em>Layanan 24 Jam</li>
								<li><em> </em>Layanan Unggulan</li>
								<li><em> </em>Promo</li>
								<li><em> </em>MCU</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em></em> Dokter Spesialis</li>
								<li><em> </em>Appoitment</li>
								<li><em></em>-</li>
								<li><em></em>-</li>
								<li><em>Private</em> Bot Messenger</li>
								<li><em></em>https://m.me/namafaskes</li>
								<li><em></em>-</li>
								<li><em></em>Fitur yang terdapat di free edition</li>
								<li><em></em>Statistik</li>
								<li><em>Limited</em> Support</li>			
							</ul>	
						</div>
						<footer class="pricing-footer">
							<a class="select-plan" href="<?=base_url('user/account/customer_form_register/101/bulanan');?>">Coba Gratis</a>
						</footer>
					</li>
					<li data-type="yearly" class="is-hidden">
						<header class="pricing-header">
							<h2>Professional</h2>

							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">FREE</span>
								<!--<span class="price-duration">bln</span>-->
							</div>
						</header>
						<!-- /pricing-header -->
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Appoitment</li>
								<li><em> </em>https://m.me/doktersiaga</li>
								<li><em>FACEBOOK PAGE FITUR  </em></li>
								<li><em></em>Posting  </li>
								<li><em></em>Inbox  </li>
								<li><em>DOKTERSIAGA COMMUNITY  </em></li>
								<li><em></em>Blog</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Promo</li>
								<li><em> </em>MCU</li>
								<li><em>OTHERS  </em></li>
								<li><em></em>Admin Dashboard </li>
								<li><em>3</em> Poli</li>
								<li><em>3</em> Dokter</li>
								<li><em>4</em> User</li>
								<li><em>1</em> Faskes</li>
								<li><em></em> Sharing Bot Messanger</li>
								<li><em></em></li>
							</ul>
						</div>
						<!-- /pricing-body -->
						<footer class="pricing-footer">
							<h2>PREMIUM</h2>
							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">3,99 jt</span>
								<span class="price-duration">thn</span>
							</div>
						</footer>
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em>Layanan 24 Jam</li>
								<li><em> </em>Layanan Unggulan</li>
								<li><em> </em>Promo</li>
								<li><em> </em>MCU</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em></em> Dokter Spesialis</li>
								<li><em> </em>Appoitment</li>
								<li><em></em>-</li>
								<li><em></em>-</li>
								<li><em>Private</em> Bot Messenger</li>
								<li><em></em>https://m.me/namafaskes</li>
								<li><em></em>-</li>
								<li><em></em>Fitur yang terdapat di free edition</li>
								<li><em></em>Statistik</li>
								<li><em>Limited</em> Support</li>				
							</ul>	
						</div>
						<footer class="pricing-footer">
							<a class="select-plan" href="<?=base_url('user/account/customer_form_register/101/tahunan');?>">Coba Gratis</a>
						</footer>
					</li>
				</ul>
				<!-- /cd-pricing-wrapper -->
			</li>
			<li>
				<ul class="pricing-wrapper">
					<li data-type="monthly" class="is-visible">
						<header class="pricing-header">
							<h2>Business</h2>
							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">FREE</span>
								<!--<span class="price-duration">bln</span>-->
							</div>
						</header>
						<!-- /pricing-header -->
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Appoitment</li>
								<li><em> </em>https://m.me/doktersiaga</li>
								<li><em>FACEBOOK PAGE FITUR  </em></li>
								<li><em></em>Posting  </li>
								<li><em></em>Inbox  </li>
								<li><em>DOKTERSIAGA COMMUNITY  </em></li>
								<li><em></em>Blog</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Promo</li>
								<li><em> </em>MCU</li>
								<li><em>OTHERS  </em></li>
								<li><em></em>Admin Dashboard </li>
								<li><em>10</em> Poli</li>
								<li><em>10</em> Dokter</li>
								<li><em>12</em> User</li>
								<li><em>1</em> Faskes</li>
								<li><em></em> Sharing Bot Messanger</li>
								<li><em></em></li>
							</ul>
						</div>
						<!-- /pricing-body -->
						<footer class="pricing-footer">
							<h2>PREMIUM</h2>
							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">3,1 jt</span>
								<span class="price-duration">bln</span>
							</div>
						</footer>
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em>Layanan 24 Jam</li>
								<li><em> </em>Layanan Unggulan</li>
								<li><em> </em>Promo</li>
								<li><em> </em>MCU</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em></em> Dokter Spesialis</li>
								<li><em> </em>Appoitment</li>
								<li><em> </em>Rawat Inap </li>
								<li><em> </em>Pesan Kamar</li>
								<li><em>Private</em> Bot Messenger</li>
								<li><em></em>https://m.me/namafaskes</li>
								<li><em></em> API</li>
								<li><em></em>Fitur yang terdapat di free edition</li>
								<li><em></em>Statistik</li>
								<li><em>Exclusive</em> Support</li>			
							</ul>	
						</div>
						<footer class="pricing-footer">
							<a class="select-plan" href="<?=base_url('user/account/customer_form_register/102/bulanan');?>">Coba Gratis</a>
						</footer>
					</li>
					<li data-type="yearly" class="is-hidden">
						<header class="pricing-header">
							<h2>Business</h2>

							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">FREE</span>
								<!--<span class="price-duration">bln</span>-->
							</div>
						</header>
						<!-- /pricing-header -->
						<!-- /pricing-header -->
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Appoitment</li>
								<li><em> </em>https://m.me/doktersiaga</li>
								<li><em>FACEBOOK PAGE FITUR  </em></li>
								<li><em></em>Posting  </li>
								<li><em></em>Inbox  </li>
								<li><em>DOKTERSIAGA COMMUNITY  </em></li>
								<li><em></em>Blog</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em> </em>Promo</li>
								<li><em> </em>MCU</li>
								<li><em>OTHERS  </em></li>
								<li><em></em>Admin Dashboard </li>
								<li><em>10</em> Poli</li>
								<li><em>10</em> Dokter</li>
								<li><em>12</em> User</li>
								<li><em>1</em> Faskes</li>
								<li><em></em> Sharing Bot Messanger</li>
								<li><em></em></li>
							</ul>
						</div>
						<!-- /pricing-body -->
						<footer class="pricing-footer">
							<h2>PREMIUM</h2>
							<div class="price">
								<!--<span class="currency">IDR</span>-->
								<span class="price-value">35.34 jt</span>
								<span class="price-duration">thn</span>
							</div>
						</footer>
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><em>MESSENGER BOT FITUR</em> </li>
								<li><em></em>Layanan 24 Jam</li>
								<li><em> </em>Layanan Unggulan</li>
								<li><em> </em>Promo</li>
								<li><em> </em>MCU</li>
								<li><em></em> Jadwal Dokter</li>
								<li><em></em> Dokter Spesialis</li>
								<li><em> </em>Appoitment</li>
								<li><em> </em>Rawat Inap </li>
								<li><em> </em>Pesan Kamar</li>
								<li><em>Private</em> Bot Messenger</li>
								<li><em></em>https://m.me/namafaskes</li>
								<li><em></em> API</li>
								<li><em></em>Fitur yang terdapat di free edition</li>
								<li><em></em>Statistik</li>
								<li><em>Exclusive</em> Support</li>			
							</ul>	
						</div>
						<footer class="pricing-footer">
							<a class="select-plan" href="<?=base_url('user/account/customer_form_register/102/tahunan');?>">Coba Gratis</a>
						</footer>
					</li>
				</ul>
				<!-- /pricing-wrapper -->
			</li>
		</ul>
		<!-- /pricing-list -->
		<div class="container">
			<div class="main_title">
				<p>Bagi Rumah Sakit yang membutuhkan integrasi antar cabangnya ataupun customize, dapat menghubungi kami melalui email info@doktersiaga.com</p> 
			</div>
		</div>
	</div>
	<!-- /pricing-container -->	
	</div>
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

</body>
</html>