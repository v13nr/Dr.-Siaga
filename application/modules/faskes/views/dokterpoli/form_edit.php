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
	$('#tgl_expired_sip').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
	});
	
	$('#tgl_expired_str').datepicker({
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
	
	$( "#spesialisasi" ).autocomplete({
		source: '<?=site_url('kota/get_kota'); ?>',
		delay:0,
		autoFocus:true,
		select:function(event, ui){
			$( "#spesialisasi" ).val( ui.item.id_kabkot );
			$('#spesialis_id').val(ui.item.id_prov);			
		}
	})
	.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li>" )
		.append( "<a>" + item.label + "</a>" )
		.appendTo( ul );			
	}
	

	
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
								<a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-expanded="true">Profile Dokter</a>
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
												<input class="form-control" name="nama_faskes" id="nama_faskes" type="text" value="<?php if(empty($results)){ echo $faskes[0]['nama_faskes']; } else { echo $results[0]['nama_faskes']; } ?>" disabled>
												<input type="hidden" name="faskes_id" value="<?php if(empty($results)){ echo $faskes[0]['faskes_id']; } else { echo $results[0]['faskes_id']; }?>">
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label>Poliklinik <span style="color:red">*</span></label>
												<select name="poli_id" class="form-control" required>
													<option value="">Pilih Poli</option>
												<?php
													for($i=0; $i < count($poli); $i++){
												?>
													<option value="<?=$poli[$i]['poli_id'];?>" <?php if($results[0]['poli_id']==$poli[$i]['poli_id']){ echo "selected"; }?> ><?=$poli[$i]['nama_poli'];?></option>
												<?php
													}
												?>
												</select>
											</div>
										</div>	
										<div class="col-md-8">
											<div class="form-group">
												<label>Nama Dokter <span style="color:red">*</span></label>
												<input class="form-control" name="nama_dokter" id="nama_dokter" type="text" value="<?php echo $results[0]['gelar_depan']." ".$results[0]['gelar']." ".$results[0]['nama_dokter']." ".$results[0]['gelar_belakang']." ".$results[0]['title'];?>" required>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label>Nomor SIP <span style="color:red">*</span></label>
												<input class="form-control" name="nmr_sip" id="nmr_sip" type="text" value="<?php echo $results[0]['nmr_sip'];?>" required>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label>Tgl expired SIP <span style="color:red">*</span></label>
												<input class="form-control" name="tgl_expired_sip" id="tgl_expired_sip" type="text" value="<?php echo waktu($results[0]['tgl_expired_sip'],'eng','indo','-','-','N');?>" required>
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
								<form name="formcrud" method="POST" action="<?=base_url('doctor/update');?>" class="form-horizontal" role="form">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Gelar <span style="color:red">*</span></label>
												<select name="gelar" class="form-control">
													<option value="">Pilih Gelar</option>
													<option value="dr" <?php if($dokter[0]['gelar']=='dr'){ echo "selected"; } ?> >Dr</option>
													<option value="drg" <?php if($dokter[0]['gelar']=='drg'){ echo "selected"; } ?>>Drg</option>
												</select>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Nama Dokter <span style="color:red">*</span></label>
												<input class="form-control" name="nama_dokter" id="nama_dokter" type="text" value="<?=$dokter[0]['nama_dokter'];?>" required>	
											</div>						
										</div>	
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Gelar Depan</label>
												<input class="form-control" name="gelar_depan" id="gelar_depan" type="text" value="<?=$dokter[0]['gelar_depan'];?>" placeholder="Contoh : Prof, DR">	
											</div>						
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Gelar Belakang</label>
												<input class="form-control" name="gelar_belakang" id="gelar_belakang" type="text" value="<?=$dokter[0]['gelar_belakang'];?>" placeholder="Contoh : MARS,MKK">	
											</div>						
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Gender <span style="color:red">*</span></label>
												<select name="gender" class="form-control">
													<option value="">Pilih Gender</option>
													<option value="M" <?php if($dokter[0]['gender']=='M'){ echo "selected"; } ?> >Pria</option>
													<option value="F" <?php if($dokter[0]['gender']=='F'){ echo "selected"; } ?> >Wanita</option>
												</select>
											</div>						
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Nomor Pokok Anggota IDI <span style="color:red">*</span></label>
												<input class="form-control" name="npa" id="npa" type="text" value="<?=$dokter[0]['npa'];?>" placeholder="" >	
											</div>						
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Nomor STR <span style="color:red">*</span></label>
												<input class="form-control" name="nmr_str" id="nmr_str" type="text" value="<?=$dokter[0]['nmr_str'];?>" placeholder="" required>	
											</div>						
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Tgl expired STR <span style="color:red">*</span></label>
												<input class="form-control" name="tgl_expired_str" id="tgl_expired_str" type="text" value="<?php waktu($dokter[0]['tgl_expired_str'],'eng','indo','-','-','N');?>" placeholder="" required>	
											</div>						
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Spesialisasi <span style="color:red">*</span></label>
												<input class="form-control" name="spesialisasi" id="spesialisasi" type="text" value="<?=$dokter[0]['description'];?>" placeholder="" required>	
												<input type="hidden" name="spesialis_id" id="spesialis_id" value="<?=$dokter[0]['spesialis_id'];?>">
											</div>						
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Pendidikan S1 (Fakultas Kedokteran) <span style="color:red">*</span></label>
												<input class="form-control" name="universitas" id="universitas" type="text" value="<?=$dokter[0]['universitas'];?>" placeholder="">	
											</div>						
										</div>
										<div class="col-md-8">
											<div class="form-group">						 
												<label>Tahun Kelulusan <span style="color:red">*</span></label>
												<select name="thn_lulus" class="form-control">
													<option value="">Pilih Tahun</option>
												<?php
												for($i=1960; $i < 2015; $i++){
												?>
													<option value="<?=$i;?>" <?php if($dokter[0]['thn_lulus']==$i){ echo "selected"; } ?> ><?=$i;?></option>
												<?php
												}
												?>
												</select>
											</div>						
										</div>
									</div>
									<div class="row" style="padding-top:20px">
										<div class="col-md-8">
										<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
										<a href="<?=base_url('faskes/dokterpoli');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
										</div>
									</div>
									<input type="hidden" name="button" value="Save">
									<input type="hidden" name="dokter_id" id="dokter_id" value="<?=$dokter[0]['id'];?>">
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