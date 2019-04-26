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
<script>
$(document).ready(function(){
	$("#btn_search").click(function(){ 		
		var form_url = $("#formcrud").attr("action");
		$("#formcrud").attr("action",form_url.replace("update", "index")); 
		$("#formcrud").submit();
	});
});
</script>
<style>
.select-style {
    border: 1px solid #ccc;
    border-radius: 3px;
    overflow: hidden;
    background: #fafafa url("https://doktersiaga.com/images/search-icon-16.png") no-repeat 90% 50%;
}

.select-style select {
    padding: 5px 8px;
    width: 110%;
    border: none;
    box-shadow: none;
    background: transparent;
    background-image: none;
    -webkit-appearance: none;
}

.select-style select:focus {
    outline: none;
}

</style>
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
				<form name="formcrud" id="formcrud" method="POST" action="<?=$action;?>" class="form-horizontal" role="form">
					<div class="row">
						<div class="col-md-5 col-lg-4">	
							<div class="form-group">
								<input type="text" name="search" id="search" value="" class="form-control" >
							</div>
						</div>
						<div class="col-md-5 col-lg-4">	
							<div class="form-group">
								<button class="btn btn-success" value="" type="submit" id="btn_search">Search</button>  
							</div>
						</div>						
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Username</th>
								<th>Group</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Username</th>
								<th>Group</th>
							</tr>
						  </tfoot>
						  <tbody>
						  <?php
						  $i=0;
						  foreach($results as $res){
						  ?>
							<tr>
							<tr>
								<td width="5%"><?=$page+$i+1;?></td>
								<td><a href="<?=base_url('hakakses/edit/'.$res->user_id);?>"><?=$res->name;?></a></td>
								<td><?=$res->username;?></td>
								<td><?=$res->group_name;?></td>
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