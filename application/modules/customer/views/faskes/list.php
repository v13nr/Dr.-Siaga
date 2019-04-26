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
<script>
$(document).ready(function(){	
	$(".btn-danger").click(function(){
		var x = $(this).closest("tr").find('input').val();
		
		$('#faskes_id').val(x);
		
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
		<form name="formcrud" method="POST" action="<?=base_url('customer/customerfaskes/update');?>" role="form">
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
				<form name="formcrud" method="POST" action="<?=$action;?>" class="form-horizontal" role="form">
					<div class="row" style="padding-bottom:20px">
					<?php 
					if( ($paket[0]->max_jmlh_faskes != count($results)) AND ($this->acl->cek_acl($c,'add',$this->session->userdata('user_id'))) ){
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
								<th>Nama Faskes</th>
								<th>Nomor Izin</th>
								<th>Tgl Expired Izin</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Nama Faskes</th>
								<th>Nomor Izin</th>
								<th>Tgl Expired Izin</th>
								<th>Status</th>
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
								<td>
								<?php
								if($this->acl->cek_acl($c,'edit',$this->session->userdata('user_id'))){
								?>
								<a href="<?=base_url('customer/customerfaskes/edit/'.$res->faskes_id);?>"><?=$res->nama_faskes;?></a>
								<?php
								} else {
									echo $res->nama_faskes;
								}
								?>								
								</td>
								<td><?=$res->nmr_izin;?></td>
								<td><?=waktu($res->tgl_expired_izin,'eng','indo','-','-','N');?></td>
							<td><?php if($res->status=='D'){ echo "Not Available"; } else { echo "Approved"; } ?></td>
								<td>
								<?php 
								if($this->acl->cek_acl($c,'hapus',$this->session->userdata('user_id'))){
								?>
								<button class="btn btn-danger" id="delete">Delete</button>
								
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
								<td colspan="7" align="center"><strong>Tidak ada data</strong></td>
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