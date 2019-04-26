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
	
	/**** dokter *****/
	var dokterTags = '<?=site_url('doctor/list_doctor'); ?>';
	
    $( "#nama_dokter" ).autocomplete({
		source: dokterTags,
		delay:0,
		autoFocus:true,
		select:function(event, ui){
			$( "#nama_dokter" ).val( ui.item.nama_dokter );
			$('#dokter_id').val(ui.item.id_dokter);
			$('#spesialis_id').val(ui.item.spesialis_id);
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
					<a href="<?=base_url('faskes/dokterpoli');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
					</div>
				</div>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="dokter_id" id="dokter_id" value="<?=$results[0]['dokter_id'];?>">
				<input type="hidden" name="spesialis_id" id="spesialis_id" value="<?=$results[0]['spesialis_id'];?>">
				<input type="hidden" name="mode" id="mode" value="<?php if(count($results) > 0){ echo "edit"; } else { echo "new"; } ?>">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->