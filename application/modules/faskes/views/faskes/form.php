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
<style>
.ui-autocomplete { position: absolute; cursor: default; background:#fff }   

/* workarounds */
html .ui-autocomplete { width:1px; } /* without this, the menu expands to 100% in IE6 */
.ui-menu {
    list-style:none;
    padding: 2px;
    margin: 0;
    display:block;
    float: left;
}
.ui-menu .ui-menu {
    margin-top: -3px;
}
.ui-menu .ui-menu-item {
    margin:0;
    padding: 0;
    zoom: 1;
    float: left;
    clear: left;
    width: 100%;
}
.ui-menu .ui-menu-item a {
    text-decoration:none;
    display:block;
    padding:.2em .4em;
    line-height:1.5;
    zoom:1;
}
.ui-menu .ui-menu-item a.ui-state-hover,
.ui-menu .ui-menu-item a.ui-state-active {
    background: #730600;
	font-weight: normal;
    margin: -1px;
}
</style>
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
							<label>Tipe Faskes <span style="color:red">*</span></label>
							<select name="tipe_faskes" id="tipe_faskes" class="form-control">
								<option value="0">Pilih Tipe Faskes</option>
								<option value="DR">Dokter Praktek Pribadi</option>
								<option value="KL">Klinik</option>
								<option value="PS">Puskesmas</option>
								<option value="RSUD">Rumah Sakit Daerah</option>
								<option value="RSIA">Rumah Sakit Ibu Anak</option>
								<option value="RS">Rumah Sakit Umum</option>
							</select>
						</div>
					</div>	
					<div class="col-md-8">
						<div class="form-group">
							<label>Nama Faskes<span style="color:red">*</span></label>
							<input class="form-control" name="nama_faskes" id="nama_faskes" type="text" value="<?php echo $results[0]['nama_faskes'];?>" required>
						</div>						
					</div>	
					<div class="col-md-8">
						<div class="form-group">
							<label>Alamat<span style="color:red">*</span></label>
							<textarea name="alamat" class="form-control"></textarea>
						</div>						
					</div>	
					<div class="col-md-8">
						<div class="form-group">
							<label>Kota<span style="color:red">*</span></label>
							<input class="form-control" name="twitter" id="twitter" type="text" value="<?php echo $results[0]['twitter'];?>" required>
						</div>						
					</div>	
					<div class="col-md-8">
						<div class="form-group">
							<label>Nomor Telephone UGD<span style="color:red">*</span></label>
							<input class="form-control" name="tlp_ugd" id="tlp_ugd" type="text" value="<?php echo $results[0]['tlp_ugd'];?>" required>
						</div>						
					</div>	
					<div class="col-md-8">
						<div class="form-group">
							<label>Nomor Telephone Operator<span style="color:red">*</span></label>
							<input class="form-control" name="tlp" id="tlp" type="text" value="<?php echo $results[0]['tlp'];?>" required>
						</div>						
					</div>		
					<div class="col-md-8">
						<div class="form-group">
							<label>Email<span style="color:red">*</span></label>
							<input class="form-control" name="email" id="email" type="text" value="<?php echo $results[0]['email'];?>" required>
						</div>						
					</div>	
					<div class="col-md-8">
						<div class="form-group">
							<label>Website<span style="color:red">*</span></label>
							<input class="form-control" name="web" id="web" type="text" value="<?php echo $results[0]['website'];?>" required>
						</div>						
					</div>	
					<div class="col-md-8">
						<div class="form-group">
							<label>Facebook<span style="color:red">*</span></label>
							<input class="form-control" name="fb" id="fb" type="text" value="<?php echo $results[0]['fb'];?>" required>
						</div>						
					</div>		
					<div class="col-md-8">
						<div class="form-group">
							<label>Twitter<span style="color:red">*</span></label>
							<input class="form-control" name="twitter" id="twitter" type="text" value="<?php echo $results[0]['twitter'];?>" required>
						</div>						
					</div>		
					<div class="col-md-8">
						<div class="form-group">
							<label>BPJS<span style="color:red">*</span></label>
							<select name="bpjs" class="form-control" required>
								<option value="0">Pilih BPJS </option>
								<option value="Y">Ya </option>
								<option value="T">Tidak </option>
							</select>
						</div>						
					</div>		
					<div class="col-md-8">
						<div class="form-group">
							<label>Peta<span style="color:red">*</span></label>
							<input class="form-control" name="twitter" id="twitter" type="text" value="<?php echo $results[0]['twitter'];?>" required>
						</div>						
					</div>															
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-md-8">
					<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
					<a href="<?=base_url('faskes');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
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