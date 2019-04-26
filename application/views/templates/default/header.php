 <?php

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Template			: 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$group_id 	= $this->session->userdata('group_id');

if($group_id=='11890083'){
	$dashboard = 'superadmin';
} else if($group_id=='11890091'){
	$dashboard = 'admin';
}
?> 
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="#"><img src="<?=base_url('application/views/templates/default/img/logo.png');?>" data-retina="true" alt="" width="163" height="36"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="mainMenu">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="">
          <a class="nav-link" href="<?=base_url('dashboard/'.$dashboard);?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Bot" data-parent="#mainMenu">
            <i class="fa fa-fw fa-retweet"></i>
            <span class="nav-link-text"> Bot</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Bot">
			<li>
              <a href="<?=base_url('messenger/bot');?>">Bot</a>
            </li>
			<li>
              <a href="<?=base_url('messenger/botcontent');?>">Bot Content</a>
            </li>									
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Facebook" data-parent="#mainMenu">
            <i class="fa fa-fw fa-facebook"></i>
            <span class="nav-link-text"> Facebook</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Facebook">
            <li>
              <a href="<?=base_url('facebook/fanpage');?>">Fan Page</a>
            </li>
            <li>
              <a href="<?=base_url('facebook/inbox');?>">Inbox</a>
            </li>			
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Blog" data-parent="#mainMenu">
            <i class="fa fa-fw fa-bars"></i>
            <span class="nav-link-text"> Blog</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Blog">
            <li>
              <a href="<?=base_url('blog');?>">Blog</a>
            </li>
          </ul>
        </li>
		<!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="">
          <a class="nav-link" href="bookings.html">
            <i class="fa fa-fw fa-calendar-check-o"></i>
            <span class="nav-link-text">Bookings <span class="badge badge-pill badge-primary">6 New</span></span>
          </a>
        </li>-->
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="">
          <a class="nav-link" href="<?=base_url('faskes/jadwal');?>">
            <i class="fa fa-fw fa-plus-circle"></i>
            <span class="nav-link-text">Jadwal Dokter</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Infofaskes" data-parent="#mainMenu">
            <i class="fa fa-fw fa-h-square"></i>
            <span class="nav-link-text">Info Faskes</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Infofaskes">
			<li>
              <a href="<?=base_url('faskes/dokterpoli');?>">Dokter</a>
            </li>	
			<li>
              <a href="<?=base_url('faskes/layanan');?>">Layanan</a>
            </li>	
			<li>
              <a href="<?=base_url('faskes/fasilitas');?>">Fasilitas</a>
            </li>	
			<li>
              <a href="<?=base_url('faskes/poli');?>">Poliklinik</a>
            </li>				
			<li>
              <a href="<?=base_url('customer/customerfaskes');?>">Faskes</a>
            </li>		
          </ul>
        </li>
	<?php
	// only super admin can access 
	if($group_id=='11890083'){
	?>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#mainMenu">
            <i class="fa fa-fw fa-gear"></i>
            <span class="nav-link-text">Super Admin</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="<?=base_url('faskes');?>">Faskes</a>
            </li>
			<li>
              <a href="tables.html">Poli</a>
            </li>
			<li>
              <a href="tables.html">Dokter</a>
            </li>
			<li>
              <a href="tables.html">Layanan</a>
            </li>			
			<li>
              <a href="tables.html">Tempat Praktek</a>
            </li>
			<li>
              <a href="tables.html">Jadwal Praktek</a>
            </li>		
			<li>
              <a href="tables.html">Last Update</a>
            </li>
			<li>
              <a href="<?=base_url('customer');?>">Customer</a>
            </li>
			<li>
              <a href="<?=base_url('finance/payment');?>">Payment</a>
            </li>
			<li>
              <a href="<?=base_url('finance/invoice');?>">Invoice</a>
            </li>	
			<li>
              <a href="<?=base_url('paket/customerpaket');?>">Customer Paket</a>
            </li>			
			<li>
              <a href="<?=base_url('user/customeruser');?>">Customer User</a>
            </li>	
			<li>
              <a href="<?=base_url('paket');?>">Paket</a>
            </li>
			<li>
              <a href="<?=base_url('user');?>">User</a>
            </li>	
			<li>
              <a href="<?=base_url('hakakses');?>">Hak Akses</a>
            </li>
			<li>
              <a href="<?=base_url('grouprule');?>">Rule Group</a>
            </li>	
			<li>
              <a href="<?=base_url('rule');?>">Rule</a>
            </li>			
          </ul>
        </li>
	<?php
	}
	?>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle mr-lg-4" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-fw fa-user-circle" style="font-size:24px"></i>
				<span class="d-lg-4">Account</span>
			</a>
			<div class="dropdown-menu" aria-labelledby="alertsDropdown">
				<a class="dropdown-item" href="<?=base_url('user/profile');?>">Profile</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?=base_url('customer/team');?>">Team</a>
				<a class="dropdown-item" href="<?=base_url('customer/customerprofile');?>">Perusahaan</a>
				<a class="dropdown-item" href="<?=base_url('user/billing');?>">Billing</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Logout</a>
			</div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /Navigation-->
