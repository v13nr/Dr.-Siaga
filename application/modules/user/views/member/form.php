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
<!-- Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin untuk menghapus data?</h5>
		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">×</span>
		</button>
	  </div>
	  <div class="modal-body">Jika ya, pilih hapus pada button di bawah ini</div>
	  <div class="modal-footer">
		<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		<a class="btn btn-primary" href="<?=base_url('customer/update');?>">Hapus</a>
	  </div>
	</div>
  </div>
</div>
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="<?=base_url('dashboard');?>">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">User details</li>
		</ol>
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i>User details</h2>
			</div>
			<form name="formcrud" method="POST" action="<?=base_url('customer/update');?>" class="form-horizontal" role="form">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<label>Nama</label>
							<input class="form-control" name="nama_customer" id="nama_customer" type="text" value="<?=$results[0]['nama_customer'];?>" required>
						</div>
						<div class="form-group">
							<label>Telephone</label>
							<input class="form-control" name="tlp" id="tlp" type="text" value="<?=$results[0]['tlp'];?>" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" name="email" id="email" type="email"  value="<?=$results[0]['email'];?>" >
						</div>
						<div class="form-group">
							<label>Contact Person</label>
							<input class="form-control" name="contact_person" id="contact_person" type="text" value="<?=$results[0]['contact_person'];?>"  required>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" name="alamat" id="alamat" required><?=$results[0]['alamat'];?></textarea>
						</div>
						<div class="form-group">
							<label>Kota</label>
							<input class="form-control" name="kota" id="kota" type="text" value="<?=$results[0]['kota'];?>"  required>
						</div>
					</div>
				</div>
				<a href="<?=base_url('user');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="id" id="id" value="<?=$results[0]['id'];?>">
				<input type="submit" id="" value="Save ..." class="btn btn-inversed btn-primary">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->