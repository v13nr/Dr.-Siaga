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
				<form name="formcrud" method="POST" action="<?=base_url('faskes/add');?>" class="form-horizontal" role="form">
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
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Nama Faskes</th>
								<th>Tipe</th>
								<th>Provinsi</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Nama Faskes</th>
								<th>Tipe</th>
								<th>Provinsi</th>
								<th>Action</th>
							</tr>
						  </tfoot>
						  <tbody>
						<?php
						if(count($results) > 0){
							$i=0;
							foreach($results as $res){
						  ?>
							<tr>
								<td><?=$page+$i+1;?></td>
								<td><input type="checkbox" id="box" name="faskes_id[]" value="<?=$res->faskes_id;?>"></td>
								<td><a href="<?=base_url('faskes/edit/'.$res->faskes_id);?>"><?=$res->nama_faskes;?></a></td>
								<td><?=$res->tipe;?></td>
								<td><?=ucwords(strtolower($res->nama_prov));?></td>
								<td>
								<button data-toggle="modal" data-target="#myModal"  class="btn btn-danger" value="delete" type="button" name="action" id="delete">Delete</button>
								</td>
							</tr>
						  <?php
								$i++;
							}
						} else {
						?>
							<tr>
								<td colspan="7" align="center"><strong>Tidak ada data</strong></td>
							</tr>
						<?php
						}
						?>
						  </tbody>
						</table>
						<p><span class="txt-smaller txt-light">Showing <?=$per_page;?> results of <?=$jmlh_data;?></span></p>
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