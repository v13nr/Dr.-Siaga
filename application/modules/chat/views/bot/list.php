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
				<form name="formcrud" method="POST" action="<?=base_url('faskes/poli/add');?>" class="form-horizontal" role="form">
					<div class="row" style="padding-bottom:20px">
					<?php 
					if($paket[0]->max_jmlh_bot != count($results)){
					?>
						<div class="col-md-3">					
							<button class="btn btn-success" value="login" type="submit" name="action" id="add">Add</button>
						</div>
					<?php
					}
					?>					
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Bot</th>
								<th>Customer</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Bot</th>
								<th>Customer</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						  </tfoot>
						  <tbody>
						  <?php
						  $i=0;
						  foreach($results as $res){
						  ?>
							<tr>
								<td><?=$page+$i+1;?></td>
								<td><input type="checkbox" id="box" name="bot_id[]" value="<?=$res->bot_id;?>"></td>
								<td><a href="<?=base_url('chat/bot/edit/'.$res->bot_id);?>"><?=$res->nama_bot;?></a></td>
								<td><?=$res->nama_customer;?></td>
								<td><?php if($res->status=='L'){ echo "Live"; } else { echo "Offline"; } ?></td>
								<td>
								<?php 
								if($paket[0]->max_jmlh_bot != count($results)){
								?>
								<button data-toggle="modal" data-target="#myModal"  class="btn btn-danger" value="delete" type="button" name="action" id="delete">Delete</button>
								<?php
								}
								?>
								</td>
							</tr>
						  <?php
							$i++;
						  }
						  ?>
						  </tbody>
						</table>
					</div>
				</form>
			</div>
			<div class="card-footer small text-muted">Page rendered in <strong>{elapsed_time}</strong> seconds</div>
	    </div>
	    <!-- /tables-->
	</div>
</div>