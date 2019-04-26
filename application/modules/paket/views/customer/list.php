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
	$("#delete").click(function(){
		var n = $( "input:checked" ).length;

		if(n == 0){
			alert('Pilih data yang ingin di hapus !');

			return false;
		} else { 
			$("#myModal").modal();
			return false;
		}
	});
	
	$("#del").click(function(){
		var x = $('input:checked').val();  
		
		$('#add_id').append('<input type="hidden" name="id[]" value="'+x+'">');
		
		$("#formhapus").submit();
	});
	
	$('.check-all').on('click', function () {
        $(this).closest('table').find(':checkbox').prop('checked', this.checked);
    });
});
</script>
<!-- ------------------------ MODAL DELETE --------------------------->


<div id="myModal" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
    <div class="modal-content">
	<form name="formhapus" method="POST" action="<?=base_url('customer/update');?>" class="form-horizontal" role="form">
      <div class="modal-header">
        <h5 class="modal-title"><strong>Hapus data</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="box">
		Apakah anda yakin ingin menghapus ?
		<div id="add_id"></div>
		</div>
      </div>
	  <div class="modal-footer">
		 <button id="del" type="submit" class="btn btn-primary btn-inversed btn-small" >Ya</button>
		<button type="button" class="btn btn-default btn-inversed btn-small" data-dismiss="modal">Cancel</button>
	  </div>
	</form>
    </div>
	</div>
</div>
<!-- ------------------------ end MODAL DELETE -------------------------->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Example DataTables Card-->
		  <div class="card mb-3">
			<div class="card-header">
			  <i class="fa fa-table"></i> <?=$subtitle;?></div>
			<div class="card-body">
				<form name="formcrud" method="POST" action="<?=$action;?>" class="form-horizontal" role="form">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Nama Customer</th>
								<th>Nama Paket</th>
								<th>Tgl Daftar</th>
								<th>Tgl Expired</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>
								<th>Nama Customer</th>
								<th>Nama Paket</th>
								<th>Tgl Daftar</th>
								<th>Tgl Expired</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						  </tfoot>
						  <tbody>
						  <?php
						  if(count($results) > 0){
							$i=0;
							foreach($results as $row){
						  ?>
							<tr>
								<td><?=$page+$i+1;?></td>
								<td><input type="checkbox" id="box" name="customer_id[]" value="<?=$row->customer_id;?>"></td>
								<td><?=$row->nama_customer;?></td>
								<td><?=$row->nama_paket;?></td>
								<td><?=waktu($row->tgl_daftar,'eng','indo','-','-','Y');?></td>
								<td><?=waktu($row->tgl_expired,'eng','indo','-','-','Y');?></td>
								<td><?php if($row->status=='E'){ echo "Active"; } else { echo "Suspend"; }?></td>
								<td>
								<button data-toggle="modal" data-target="#myModal"  class="btn btn-danger" value="block" type="button" name="action" id="block">Suspend</button>
								<button data-toggle="modal" data-target="#myModal"  class="btn btn-warning" value="block" type="button" name="action" id="block">Buat Invoice</button>
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