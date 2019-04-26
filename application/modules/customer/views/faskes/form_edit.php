<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Template			: 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//print_r($customerfaskes); exit;
$this->load->helper('waktu');
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
	$('#tgl_expired_izin').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
	});
	
	var kotaTags = '<?=site_url('kota/get_kota'); ?>';
	
	$( "#nama_kabkot" ).autocomplete({
		source: kotaTags,
		delay:0,
		autoFocus:true,
		select:function(event, ui){
			$( "#id_kabkot" ).val( ui.item.id_kabkot );
			$('#id_prov').val(ui.item.id_prov);			
		}
	})
	.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li>" )
		.append( "<a>" + item.label + "</a>" )
		.appendTo( ul );			
	};
	

	
});
</script>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i><?=$subtitle;?></h2>
			</div>
			<div class="col-xl-9 col-lg-8">
				<div class="tabs_styled_2">			
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="book-tab" data-toggle="tab" href="#book" role="tab" aria-controls="book">General info</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-expanded="true">Perizinan</a>
							</li>
						</ul>
						<!--/nav-tabs -->
						<div class="tab-content">

							<div class="tab-pane fade show active" id="book" role="tabpanel" aria-labelledby="book-tab">
								<p class="lead add_bottom_30"></p>
								<form name="formcrud" method="POST" action="<?=$action;?>" class="form-horizontal" role="form">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Faskes <span style="color:red">*</span></label>
												<input class="form-control" name="nama_faskes" id="nama_faskes" type="text" value="<?=$results[0]['nama_faskes'];?>" required>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label>Description <span style="color:red">*</span></label>
												<textarea class="form-control" name="desc" id="desc"><?=$results[0]['desc'];?></textarea>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label>Alamat <span style="color:red">*</span></label>
												<textarea class="form-control" name="alamat" id="alamat"><?=$results[0]['alamat'];?></textarea>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label>Kota <span style="color:red">*</span></label>
												  <input type="text" value="<?=ucwords(strtolower($results[0]['nama_kabkot']))." - ".ucwords(strtolower($results[0]['nama_prov']));?>" name="kota" class="form-control" id="nama_kabkot" placeholder="" required >
												  <input type="hidden" id="id_kabkot" name="id_kabkot" value="<?=$results[0]['id_kabkot'];?>">
												  <input type="hidden" id="id_prov" name="id_prov" value="<?=$results[0]['id_prov'];?>">
											</div>		
										</div>	
										<div class="col-md-8">
											<div class="form-group">
												<label>Telephone  <span style="color:red">*</span></label>
												<input class="form-control" name="tlp" id="tlp" type="text" value="<?=$results[0]['tlp'];?>" required>
											</div>
										</div>				
										<div class="col-md-8">
											<div class="form-group">
												<label>Telephone UGD <span style="color:red">*</span></label>
												<input class="form-control" name="tlp_ugd" id="tlp_ugd" type="text" value="<?=$results[0]['tlp_ugd'];?>" required>
											</div>
										</div>	
										<div class="col-md-8">
											<div class="form-group">
												<label>Email <span style="color:red">*</span></label>
												<input class="form-control" name="email" id="email" type="text" value="<?=$results[0]['email'];?>" required>
											</div>
										</div>	
										<div class="col-md-8">
											<div class="form-group">
												<label>Website <span style="color:red">*</span></label>
												<input class="form-control" name="website" id="website" type="text" value="<?=$results[0]['website'];?>" required>
											</div>
										</div>	
										<div class="col-md-8">
											<div class="form-group">
												<label>Facebook <span style="color:red">*</span></label>
												<input class="form-control" name="fb" id="fb" type="text" value="<?=$results[0]['fb'];?>" required>
											</div>
										</div>	
										<div class="col-md-8">
											<div class="form-group">
												<label>Twitter <span style="color:red">*</span></label>
												<input class="form-control" name="twitter" id="twitter" type="text" value="<?=$results[0]['twitter'];?>" required>
											</div>
										</div>	
										<div class="col-md-8">
											<div class="form-group">
												<label class="col-sm-3 control-label">BPJS <span style="color:red">*</span></label>
												<select name="bpjs" class="form-control" required>
													<option value="">Pilih</option>
													<option value="Y" <?php if($results[0]['bpjs']=='Y'){ echo "selected"; } ?> >Ya</option>
													<option value="T" <?php if($results[0]['bpjs']=='T'){ echo "selected"; } ?> >Tidak</option>
												</select>
											</div>
										</div>	
										<div class="col-md-8">
											<div class="form-group">
												<label>Latitude <span style="color:red">*</span></label>
												<input class="form-control" name="latitude" id="latitude" type="text" value="<?=$results[0]['latitude'];?>" required>
											</div>
										</div>		
										<div class="col-md-8">
											<div class="form-group">
												<label>Longitude <span style="color:red">*</span></label>
												<input class="form-control" name="longitude" id="longitude" type="text" value="<?=$results[0]['longitude'];?>" required>
											</div>
										</div>		
										<div class="col-md-8">
											<div class="form-group">
												<label class="col-sm-3 control-label">Tipe <span style="color:red">*</span></label>					
												<select name="tipe" class="form-control" required>
													<option value="">Pilih</option>
													<option value="RS" <?php if($results[0]['tipe']=='RS'){ echo "selected"; } ?> >Rumah Sakit Umum</option>
													<option value="RSI" <?php if($results[0]['tipe']=='RSI'){ echo "selected"; } ?> >Rumah Sakit Islam</option>
													<option value="RSIA" <?php if($results[0]['tipe']=='RSIA'){ echo "selected"; } ?> >Rumah Sakit Ibu & Anak</option>
													<option value="RSUD" <?php if($results[0]['tipe']=='RSUD'){ echo "selected"; } ?> >Rumah Sakit Umum Daerah</option>
													<option value="PS" <?php if($results[0]['tipe']=='PS'){ echo "selected"; } ?>>Puskesmas</option>
													<option value="PY" <?php if($results[0]['tipe']=='PY'){ echo "selected"; } ?>>Pos Yandu</option>
													<option value="DR" <?php if($results[0]['tipe']=='DR'){ echo "selected"; } ?>>Dokter Pribadi</option>
													<option value="BP" <?php if($results[0]['tipe']=='BP'){ echo "selected"; } ?>>Balai Pengobatan</option>
													<option value="KL" <?php if($results[0]['tipe']=='KL'){ echo "selected"; } ?>>Klinik</option>
													<option value="APT" <?php if($results[0]['tipe']=='APT'){ echo "selected"; } ?> >Apotek</option>
													<option value="DLL" <?php if($results[0]['tipe']=='DLL'){ echo "selected"; } ?> >Others</option>
												</select>
											</div>
										</div>						
									</div>
									<div class="row" style="padding-top:20px">
										<div class="col-md-8">
										<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
										<a href="<?=base_url('customer/customerfaskes');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
										</div>
									</div>
									<input type="hidden" name="button" value="Save">
									<input type="hidden" name="faskes_id" id="faskes_id" value="<?=$results[0]['faskes_id'];?>">
								</form>

							</div>	
							<!-- /tab_1 -->
							
							<div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
								<p class="lead add_bottom_30"></p>
								<form name="formcrud" method="POST" action="<?=base_url('customer/customerfaskes/update');?>" class="form-horizontal" role="form">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Nomor Surat Izin <span style="color:red">*</span></label>
												<input class="form-control" name="nmr_izin" id="nmr_izin" type="text" value="<?=$customerfaskes[0]['nmr_izin'];?>" required>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Tgl expired <span style="color:red">*</span></label>
												<input class="form-control datepicker" name="tgl_expired_izin" id="tgl_expired_izin" type="text" value="<?=waktu($customerfaskes[0]['tgl_expired_izin'],'eng','indo','-','-','N');?>" required>	
											</div>						
										</div>	
									</div>
									<div class="row" style="padding-top:20px">
										<div class="col-md-8">
										<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
										<a href="<?=base_url('customer/customerfaskes');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
										</div>
									</div>
									<input type="hidden" name="button" value="Save">
									<input type="hidden" name="faskes_id" id="faskes_id" value="<?=$results[0]['faskes_id'];?>">
									<input type="hidden" name="mode" id="mode" value="edit">
								</form>
							</div>
							<!-- /tab_2 -->	
						
						</div>
						
						
					
				</div>
			</div>
			
			
			
			
			
			
			

		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->