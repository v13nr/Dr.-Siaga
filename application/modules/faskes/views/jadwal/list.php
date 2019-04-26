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
		var n = $( "input:checked" ).length;

		if(n == 0){
			alert('Pilih data yang ingin di hapus !');

			return false;
		} else { 
			// get jadwal id val
			var id = [];
			$("input[name='jadwal_id[]']:checked").each(function(i){
			  id[i] = $(this).val();
			});
			//alert(id);
			$('#jadwal').val(id);		
			
			$("#deleteModal").modal();
				return false;
			}
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
		<form name="formcrud" method="POST" action="<?=base_url('faskes/jadwal/update');?>" role="form">
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
			<input type="hidden" name="jadwal" id="jadwal" value="">
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
				<form name="formcrud" method="POST" action="<?=base_url('faskes/jadwal/add');?>" class="form-horizontal" role="form">
					<div class="row" style="padding-bottom:20px">
					<?php 
					if( ($faskes_approved==true and $this->acl->cek_acl($c,'add',$this->session->userdata('user_id'))) OR $this->session->userdata('group_id')=='11890083' ){
						{
					?>
						<div class="col-md-2" style="padding-bottom:20px">					
							<button class="btn btn-success" value="login" type="submit" name="action" id="add">Add</button>
						</div>		
						
					<?php
						}
					}

					// can delete
					if($this->acl->cek_acl($c,'hapus',$this->session->userdata('user_id'))){
					?>
						<div class="col-md-2">	
							<button data-toggle="modal" data-target="#myModal"  class="btn btn-danger" value="delete" type="button" name="action" id="delete">Delete</button>
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
								<th style="display:none">Faskes ID</th>
								<th style="display:none">Poli ID</th>
								<th>Nama Dokter</th>
								<th>Poliklinik</th>
								<th>Faskes</th>
								<th>Hari</th>
								<th>Jam Mulai</th>
								<th>Jam Selesai</th>
								<th>Keterangan</th>
								<th>Last Update</th>
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
								<th>Hari</th>
								<th>Jam Mulai</th>
								<th>Jam Selesai</th>
								<th>Keterangan</th>
								<th>Last Update</th>
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
								<td><input type="checkbox" id="jadwal_id" name="jadwal_id[]" value="<?=$res->jadwal_id;?>"></td>
								<td style="display:none"><?=$res->faskes_id;?></td>
								<td style="display:none"><?=$res->poli_id;?></td>
								<td>
								<?php
								if($this->acl->cek_acl($c,'edit',$this->session->userdata('user_id'))){
								?>
								<a href="<?=base_url('faskes/jadwal/edit/'.$res->jadwal_id);?>"><?=$res->gelar_depan." ".$res->gelar." ".ucwords(strtolower($res->nama_dokter))." ".$res->gelar_belakang." ".$res->title;?></a>
								<?php
								} else {
									echo $res->nama_dokter;
								}
								?>			
								</td>
								<td><?=$res->nama_poli;?></td>
								<td><?=$res->nama_faskes;?></td>
								<td><?=hari($res->hari);?></td>
								<td><?=$res->jam_mulai;?></td>
								<td><?=$res->jam_selesai;?></td>
								<td><?=$res->ket;?></td>
								<td><?=waktu($res->last_updated,'eng','indo','-','-','Y');?></td>
							</tr>
						  <?php
							$i++;
						  }
						} else {
						  ?>
						  <tr>
							<td colspan="10" align="center">Tidak ada data</td>
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