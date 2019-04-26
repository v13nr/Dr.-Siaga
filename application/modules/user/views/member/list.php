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
$this->load->helper('waktu');
?>
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Example DataTables Card-->
		  <div class="card mb-3">
			<div class="card-header">
			  <i class="fa fa-table"></i> <?=$subtitle;?></div>
			<div class="card-body">
				<form name="formcrud" method="POST" action="<?=base_url('user/add');?>" class="form-horizontal" role="form">
					<div class="row" style="padding-bottom:20px">
						<div class="col-md-3">					
						<button class="btn btn-success" value="login" type="submit" name="action" id="add">Add</button>                            
						
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
							  <th>No</th>
							  <th><input class="check-all" type="checkbox"></th>
							  <th>Fullname</th>
							  <th>Tgl register</th>
							  <th>Last Login</th>
							  <th>Email</th>
							  <th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
							  <th>No</th>
							  <th><input class="check-all" type="checkbox"></th>
							  <th>Fullname</th>
							  <th>Tgl register</th>
							  <th>Last Login</th>
							  <th>Email</th>
							  <th>Action</th>
							</tr>
						  </tfoot>
						  <tbody>
						  <?php
						  $i=0;
						  foreach($results as $res){
						  ?>
							<tr>
								<td scope="row"><?=$page+$i+1;?></td>
								<td><input type="checkbox" id="box" name="id[]" value="<?=$res->user_id;?>"></td>
								<td><?=$res->name;?></td>
								<td><?=waktu($res->tgl_register,'eng','indo','-','-','Y');?></td>
								<td><?=waktu($res->last_login,'eng','indo','-','-','Y');?></td>
								<td><?=$res->email;?></td>
								<td><button data-toggle="modal" data-target="#myModal"  class="btn btn-danger" value="delete" type="button" name="action" id="delete">Delete</button></td>
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