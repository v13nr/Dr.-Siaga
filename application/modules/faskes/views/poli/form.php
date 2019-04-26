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
	$('#jam_buka_pendaftaran').timepicker({
		timeFormat: 'H:i ',
		interval: 30,
		minTime: '07',
		maxTime: '10:00pm',
		defaultTime: '11',
		startTime: '06:00',
		dynamic: false,
		dropdown: true,
		scrollbar: true
	});
	
	$('#jam_tutup_pendaftaran').timepicker({
		timeFormat: 'H:i ',
		interval: 30,
		minTime: '07',
		maxTime: '10:00pm',
		defaultTime: '11',
		startTime: '06:00',
		dynamic: false,
		dropdown: true,
		scrollbar: true
	});
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
							<label>Faskes <span style="color:red">*</span></label>
							<input class="form-control" name="nama_faskes" id="nama_faskes" type="text" value="<?php if(empty($results)){ echo $faskes[0]['nama_faskes']; } else { echo $results[0]['nama_faskes']; } ?>" disabled>
							<input type="hidden" name="faskes_id" value="<?php if(empty($results)){ echo $faskes[0]['faskes_id']; } else { echo $results[0]['faskes_id']; }?>">
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Nama Poli <span style="color:red">*</span></label>
							<input class="form-control" name="nama_poli" id="nama_poli" type="text" value="<?php echo $results[0]['nama_poli'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Jam buka pendaftaran <span style="color:red">*</span></label>
							<input class="form-control" name="jam_buka_pendaftaran" id="jam_buka_pendaftaran" type="text" value="<?php echo $results[0]['jam_buka_pendaftaran'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Jam tutup pendaftaran <span style="color:red">*</span></label>
							<input class="form-control" name="jam_tutup_pendaftaran" id="jam_tutup_pendaftaran" type="text" value="<?php echo $results[0]['jam_tutup_pendaftaran'];?>">
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Status <span style="color:red">*</span></label>
							<select name="status" class="form-control" required>
								<option value="">Pilih Status</option>
								<option value="O" <?php if($results[0]['status']=='O'){ echo "selected"; } ?> >Open</option>
								<option value="C" <?php if($results[0]['status']=='C'){ echo "selected"; } ?> >Close</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-md-8">
					<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
					<a href="<?=base_url('faskes/poli');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
					</div>
				</div>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="poli_id" id="poli_id" value="<?=$results[0]['poli_id'];?>">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->