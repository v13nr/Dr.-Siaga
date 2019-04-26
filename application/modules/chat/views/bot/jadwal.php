<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Template			: 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//print_r($results); exit;

?>

<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
			  <a href="<?=base_url('/pages/dashboard');?>">Dashboard</a>
			</li>
			<li class="breadcrumb-item active"><?=$title;?></li>
		</ol>
		<!-- Example DataTables Card-->
		<div class="card mb-3">
			<div class="card-header">
				<i class="fa fa-table"></i> <?=$subtitle;?>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="box_general padding_bottom">
							<div class="header_box version_2">
								<h2>Menu</h2>
							</div>
							<div class="form-group">
								<label>Welcome Message</label>
							</div>
							<div class="form-group">
								<label>Dokter Kami</label>
							</div>
							<div class="form-group">
								<label>Jadwal Dokter</label>
							</div>
							<div class="form-group">
								<label>Layanan</label>
							</div>
							<div class="form-group">	
								<label>Fasilitas</label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box_general padding_bottom">
							<div class="header_box version_2">
								<h2>Jadwal</h2>
							</div>
							<div class="form-group">
								<textarea class="form-control" name="welcome_message" id="welcome_message" disabled>Jadwal dokter kami adalah</textarea>
							</div>
							<p><a href="#0" class="btn_1 medium">Edit</a></p>
						</div>
					</div>
				</div>
				<!-- /row-->
			</div>
			<div class="card-footer small text-muted">Page rendered in <strong>{elapsed_time}</strong> seconds</div>
	    </div>
	    <!-- /tables-->
	</div>
</div>