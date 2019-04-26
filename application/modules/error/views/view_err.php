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
		<!-- Example DataTables Card-->
		<div class="card mb-3">
			<div class="card-body">
				<h1>Warning !</h1>
				<h2><span class="label label-warning"><?=$this->session->flashdata('msg');?></span></h2>
				<img src="<?=base_url('images/suntik-dokter.gif');?>" width="500" class="img-responsive">
			</div>
			<div class="card-footer small text-muted">Page rendered in <strong>{elapsed_time}</strong> seconds</div>
	    </div>
	    <!-- /tables-->
	</div>
</div>