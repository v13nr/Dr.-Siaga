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
						<div class="col-md-3">					
							<button class="btn btn-success" value="login" type="submit" name="action" id="add">Add</button>
						</div>				
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>Tgl</th>
								<th>Message</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>Tgl</th>
								<th>Message</th>
								<th>Action</th>
							</tr>
						  </tfoot>
						  <tbody>
						  <?php
						  $content = null;
						  for($i=0; $i < count($results['data']); $i++){
						  ?>
							<tr>
								<td><?=$results['data'][$i]['created_time'];?></td>
								<td>
								<?php 
								if($results['data'][$i]['type']=='photo' ){ 
									if(!empty($results['data'][$i]['message'])){
										echo $results['data'][$i]['message'];
									}
									if(!empty($results['data'][$i]['name'])){
										echo $results['data'][$i]['name'];
									}
									echo '<img src="'.$results['data'][$i]['picture'].'">';
								} else if($results['data'][$i]['type']=='link'){ 
									$content = '<a href="'.$results['data'][$i]['link'].'">';
									if(!empty($results['data'][$i]['picture'])){
										$content .= '<img src="'.$results['data'][$i]['picture'].'">'; 
									}
									if(!empty($results['data'][$i]['message'])){
										$content .= $results['data'][$i]['message']; 
									}
									
									$content .= '</a><br>';
									
									if(!empty($results['data'][$i]['name'])){
										$content .= $results['data'][$i]['name']; 
									}
									if(!empty($results['data'][$i]['description'])){
										$content .= $results['data'][$i]['description']; 
									}
									echo $content;
									
								} else if($results['data'][$i]['type']=='video'){ 
									if(!empty($results['data'][$i]['type']=='name')){ 
										echo $results['data'][$i]['name'];
									} else if(!empty($results['data'][$i]['type']=='message')){ 
										echo $results['data'][$i]['message'];
									}
								} else if($results['data'][$i]['type']=='status'){ 
									echo $results['data'][$i]['id'];
								}
								?>
								</td>
								<td>
								<button data-toggle="modal" data-target="#myModal"  class="btn btn-danger" value="delete" type="button" name="action" id="delete">Delete</button>
								</td>
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