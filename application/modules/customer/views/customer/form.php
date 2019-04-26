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
$(function() {
	
});
</script>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i><?=$subtitle;?></h2>
			</div>
			<form name="formcrud" method="POST" action="<?=$action;?>" class="form-horizontal" role="form">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<label>Nama  <span style="color:red">*</span></label>
							<input class="form-control" name="nama_customer" id="nama_customer" type="text" value="<?php echo $results[0]['nama_customer'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Email <span style="color:red">*</span></label>
							<input class="form-control" name="email" id="email" type="email" value="<?=$results[0]['email'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Telephone <span style="color:red">*</span></label>
							<input class="form-control" name="tlp" id="tlp" type="text" value="<?=$results[0]['tlp'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Alamat <span style="color:red">*</span></label>
							<input class="form-control" name="alamat" id="alamat" type="text" value="<?=$results[0]['alamat'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Kota <span style="color:red">*</span></label>
							<input class="form-control" name="kota" id="kota" type="text" value="<?=$results[0]['kota'];?>" required>
						</div>
					</div>
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-md-8">
					<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
					<a href="<?=base_url('customer/customerprofile');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
					</div>
				</div>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="id" id="id" value="<?=$results[0]['id'];?>">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->