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
		<?php 
		if($this->session->flashdata('msg')){
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <?=$this->session->flashdata('msg');?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>	
		<?php 
		}
		?>

		<!-- Example DataTables Card-->
		<div class="card mb-3">
			<div class="card-header">
				<i class="fa fa-table"></i> <?=$subtitle;?>
			</div>
			<div class="card-body">
				<form name="formcrud" method="POST" action="<?=base_url('rule/add');?>" class="form-horizontal" role="form">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>No</th>
								<th>Group Name</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th>Group Name</th>
							</tr>
						  </tfoot>
						  <tbody>
						  <?php
						  $i=0;
						  foreach($results as $res){
						  ?>
							<tr>
								<td><?=$page+$i+1;?></td>	
								<td><a href="<?=base_url('grouprule/edit/'.$res->group_id);?>"><?=$res->desc;?></a></td>
							</tr>
						  <?php
							$i++;
						  }
						  ?>
						  </tbody>
						</table>
						<p><span class="txt-smaller txt-light">Showing <?=$jmlh_data;?> results of <?=$jmlh_item;?></span></p>
						<nav aria-label="" class="add_top_20">
							<ul class="pagination pagination-sm">
								<?php echo $this->pagination->create_links(); ?>
							</ul>
						</nav>
						<!-- /pagination -->
	
					</div>
				</form>
			</div>
			<div class="card-footer small text-muted">Page rendered in <strong>{elapsed_time}</strong> seconds</div>
	    </div>
	    <!-- /tables-->
	</div>
</div>