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
			<div class="card-header">
			  <i class="fa fa-table"></i> Daftar Question & Answer</div>
			<div class="card-body">
				<form name="formcrud" method="POST" action="<?=base_url('customer/add');?>" class="form-horizontal" role="form">
					<div class="row" style="padding-bottom:20px">
						<div class="col-md-3">					
						<button class="btn btn-success" value="login" type="submit" name="action" id="add">Add</button>                            
						
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
							  <th>Kategori</th>
							  <th>Pertanyaan</th>
							  <th>Jawaban</th>
							  <th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
							  <th>Kategori</th>
							  <th>Pertanyaan</th>
							  <th>Jawaban</th>
							  <th>Action</th>
							</tr>
						  </tfoot>
						  <tbody>
						  <?php
						  foreach($results as $row){
						  ?>
							<tr>
							  <td><a href="<?=base_url('customer/edit/'.$row->id);?>"><?=$row->category;?></a></td>
							  <td><?=$row->question;?></td>
							  <td><?=$row->answer;?></td>
							  <td><button data-toggle="modal" data-target="#myModal"  class="btn btn-danger" value="delete" type="button" name="action" id="delete">Delete</button></td>
							</tr>
						  <?php
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