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
				<i class="fa fa-table"></i> <?=$subtitle;?>
			</div>
			<div class="card-body">
				<form name="formcrud" method="POST" action="<?=base_url('faskes/poli/add');?>" class="form-horizontal" role="form">
					<div class="row" style="padding-bottom:20px">				
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Judul</th>
								<th>Bot</th>
								<th>Customer</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Judul</th>
								<th>Bot</th>
								<th>Customer</th>
							</tr>
						  </tfoot>
						  <tbody>
						  <?php
						  if(count($results) > 0){
							for($i=0; $i < count($results); $i++){
						  ?>
							<tr>
								<td><?=$page+$i+1;?></td>
								<td><input type="checkbox" id="box" name="bot_id[]" value="<?=$results[$i]['bot_id'];?>"></td>
								<td><a href="<?=base_url('messenger/botcontent/edit/'.$results[$i]['content_id']);?>"><?=$results[$i]['block_name'];?></a></td>
								<td><?=$results[$i]['nama_bot'];?></td>
								<td><?=$results[$i]['nama_customer'];?></td>
							</tr>
						  <?php
							}
						  } else {
						  ?>
						  <tr>
							<td colspan="5" align="center">Tidak ada data</td>
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