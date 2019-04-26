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
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i><?=$subtitle;?></h2>
			</div>
			<form name="formcrud" method="POST" action="<?=$action;?>" class="form-horizontal" role="form">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<label>Nama Paket <span style="color:red">*</span></label>
							<input class="form-control" name="nama_paket" id="nama_paket" type="text" value="<?php echo $results[0]['nama_paket'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Harga per bulan<span style="color:red">*</span></label>
							<input class="form-control" name="harga" id="harga" type="text" value="<?=number_format($results[0]['harga'],0,',','.');?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Jumlah Faskes <span style="color:red">*</span></label>
							<input class="form-control" name="max_jmlh_faskes" id="max_jmlh_faskes" type="text" value="<?php echo $results[0]['max_jmlh_faskes'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Jumlah Poli <span style="color:red">*</span></label>
							<input class="form-control" name="max_jmlh_poli" id="max_jmlh_poli" type="text" value="<?php echo $results[0]['max_jmlh_poli'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Jumlah Dokter <span style="color:red">*</span></label>
							<input class="form-control" name="max_jmlh_dokter" id="max_jmlh_dokter" type="text" value="<?php echo $results[0]['max_jmlh_dokter'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Jumlah Bot <span style="color:red">*</span></label>
							<input class="form-control" name="max_jmlh_bot" id="max_jmlh_bot" type="text" value="<?php echo $results[0]['max_jmlh_bot'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Jumlah User <span style="color:red">*</span></label>
							<input class="form-control" name="max_jmlh_user" id="max_jmlh_user" type="text" value="<?php echo $results[0]['max_jmlh_user'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Masa Trial (hari)<span style="color:red">*</span></label>
							<input class="form-control" name="durasi_trial" id="durasi_trial" type="text" value="<?php echo $results[0]['durasi_trial'];?>" required>
						</div>
					</div>
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-md-8">
					<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
					<a href="<?=base_url('paket');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
					</div>
				</div>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="paket_id" id="paket_id" value="<?=$results[0]['paket_id'];?>">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->