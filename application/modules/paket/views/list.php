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
	<form name="formhapus" method="POST" action="<?=base_url('paket/update');?>" class="form-horizontal" role="form">
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
			  <i class="fa fa-table"></i> Daftar Paket</div>
			<div class="card-body">
				<form name="formcrud" method="POST" action="<?=base_url('paket/add');?>" class="form-horizontal" role="form">
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
								<th>Nama Paket</th>
								<th>Harga< per bulan</th>
								<th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
								<th>No</th>
								<th style="width: 3%;"><input class="check-all" type="checkbox"></th>							
								<th>Nama Paket</th>
								<th>Harga< per bulan</th>
								<th>Action</th>
							</tr>
						  </tfoot>
						  <tbody>
						  <?php
						   $i=0;
						  foreach($results as $row){
						  ?>
							<tr>
								<td><?=$page+$i+1;?></td>
								<td><input type="checkbox" id="box" name="id[]" value="<?=$row->paket_id;?>"></td>
							  <td><a href="<?=base_url('paket/edit/'.$row->paket_id);?>"><?=$row->nama_paket;?></a></td>
							  <td><?=number_format($row->harga,0,',','.');?></td>
							  <td><button data-toggle="modal" data-target="#myModal"  class="btn btn-danger" value="delete" type="button" name="action" id="delete">Delete</button></td>
							</tr>
						  <?php
							$i++;
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