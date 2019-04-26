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
	$(".btn-danger").click(function(){		
		// get faskes id val
		var x = $(this).closest("tr").find('td').eq(2).text();
		
		// get poli id val
		var y = $(this).closest("tr").find('td').eq(3).text();

		// get dokter id val
		var z = $(this).closest("tr").find('input').val();
		
		$('#faskes_id').val(x);
		$('#poli_id').val(y);
		$('#dokter_id').val(z);		
		
		$("#deleteModal").modal();
		return false;
	});
	
	$('.check-all').on('click', function () {
        $(this).closest('table').find(':checkbox').prop('checked', this.checked);
    });
});
</script>
<!-- Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<form name="formcrud" method="POST" action="<?=base_url('faskes/dokterpoli/update');?>" role="form">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
			</div>
			<div class="modal-body">Apakah anda yakin untuk menghapus data ?</div>
			<div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			<button class="btn btn-primary" type="submit" >Ya</button>
			<input type="hidden" name="faskes_id" id="faskes_id" value="">
			<input type="hidden" name="poli_id" id="poli_id" value="">
			<input type="hidden" name="dokter_id" id="dokter_id" value="">
			</div>
		</form>
	</div>
  </div>
</div>
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
				<form name="formcrud" method="POST" action="<?=base_url('faskes/dokterpoli/add');?>" class="form-horizontal" role="form">
					<div class="row" style="padding-bottom:20px">
					<?php 
					if( (($paket[0]->max_jmlh_poli != count($results) AND $faskes_approved==true) and $this->acl->cek_acl($c,'add',$this->session->userdata('user_id'))) OR $this->session->userdata('group_id')=='11890083' ){
						{
					?>
						<div class="col-md-3">					
							<button class="btn btn-success" value="login" type="submit" name="action" id="add">Add</button>
						</div>		
						
					<?php
						}
					}
					?>			
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th style="display:none">Faskes ID</th>
								<th style="display:none">Poli ID</th>
								<th>Nama Dokter</th>
								<th>Poliklinik</th>
								<th>Faskes</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th style="display:none">Faskes ID</th>
								<th style="display:none">Poli ID</th>
								<th>Nama Dokter</th>
								<th>Poliklinik</th>
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
								<td style="display:none"><?=$res->faskes_id;?></td>
								<td style="display:none"><?=$res->poli_id;?></td>
								<td>
								<?php
								if($this->acl->cek_acl($c,'edit',$this->session->userdata('user_id'))){
								?>
								<a href="<?=base_url('faskes/dokterpoli/edit/'.$res->faskes_id.'/'.$res->poli_id.'/'.$res->dokter_id);?>"><?=$res->gelar_depan." ".$res->gelar." ".ucwords(strtolower($res->nama_dokter))." ".$res->gelar_belakang." ".$res->title;?></a>
								<?php
								} else {
									echo $res->nama_dokter;
								}
								?>			
								</td>
								<td><?=$res->nama_poli;?></td>
								<td><?=$res->nama_faskes;?></td>
								<td>
								<?php 
								if($this->acl->cek_acl($c,'hapus',$this->session->userdata('user_id'))){
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