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
			<?php
			if(count($fb) > 0){
				// jika sdh trhubung dengan fb
			?>
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
								<th>Platform</th>
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
								<th>Platform</th>
								<th>Status</th>
								<th>Action</th>
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
								<td><a href="<?=base_url('messenger/bot/edit/'.$results[$i]['bot_id']);?>"><?=$results[$i]['nama_bot'];?></a></td>
								<td><?=$results[$i]['nama_customer'];?></td>
								<td>Facebook Messenger</td>
								<td><?php if($results[$i]['status']=='L'){ echo "Live"; } else { echo "Offline"; } ?></td>
								<td>
								<button data-toggle="modal" data-target="#myModal"  class="btn btn-danger" value="delete" type="button" name="action" id="delete">Delete</button>
								</td>
							</tr>
						  <?php
							}
						  } else {
						  ?>
						  <tr>
							<td colspan="7" align="center">Tidak ada data atau anda belum terhubung dengan facebook</td>
						  </tr>						  
						  <?php
						  }
						  ?>
						  </tbody>
						</table>
					</div>
				</form>
			<?php
			} else {
			?>
								<p> Anda belum terhubung dengan Facebook</p>
								<div id="fb-root"></div>
								<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2&appId=103469200269498&autoLogAppEvents=1"></script>	
								<div class="fb-login-button" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="false"></div>
			<?php
			}
			?>
			</div>
			<div class="card-footer small text-muted">Page rendered in <strong>{elapsed_time}</strong> seconds</div>
	    </div>
	    <!-- /tables-->
	</div>
</div>