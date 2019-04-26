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
					<?php 
					if($paket[0]->max_jmlh_dokter != count($results)){
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
								<th>Dokter</th>
								<th>Poli</th>
								<th>Faskes</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Dokter</th>
								<th>Poli</th>
								<th>Faskes</th>
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
								<td><input type="checkbox" id="box" name="dokter_id[]" value="<?=$res->dokter_id;?>"></td>
								<td><a href="<?=base_url('faskes/edit/'.$res->dokter_id);?>"><?=$res->nama_dokter;?></a></td>
								<td><?=$res->nama_poli;?></td>
								<td><?=$res->nama_faskes;?></td>
								<td>
								<?php 
								if($paket[0]->max_jmlh_poli != count($results)){
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
						} else {
						  ?>
						  <tr>
							<td colspan="6" align="center">Tidak ada data</td>
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