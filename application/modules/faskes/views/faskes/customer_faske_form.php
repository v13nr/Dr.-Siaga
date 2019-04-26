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
	$('#tgl_expired_izin').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
	});
	
	$( "#tipe_faskes" ).change(function() {
		var tipe_faskes = $("#tipe_faskes").val();

		$.ajax({
			 url: '<?=base_url('faskes/get_faskes');?>', 
			 type: "GET",
			 data: ( { tipe_faskes: tipe_faskes} ),
			 dataType: "json", 
			 async:true,
			 success: function(msg){
				
				var list_faskes = 	'<div id="hapus">'+
										'<div class="form-group">'+
											'<label>Faskes</label>'+
											'<input type="text" name="nama_faskes" class="form-control" id="nama_faskes" value="" required>'+
											'<input type="hidden" name="faskes_id" id="faskes_id" value="">'+
										'</div>'+
									'</div>';
									
				$("#hapus").remove();
				
				$("#add_faskes").append(list_faskes);
				
				$( "#nama_faskes" ).autocomplete({
					source: msg,
					delay:0,
					autoFocus:true,
					select:function(event, ui){
						$( "#nama_faskes" ).val( ui.item.nama_faskes );
						$('#faskes_id').val(ui.item.faskes_id);
						
					}
				})
				.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li>" )
					.append( "<a>" + item.label + ", "+item.kota+ "</a>" )
					.appendTo( ul );			
				};
				

				
			 },
			error: function(e)
			{
				alert(e);
			}
		});

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
						<div id="add_faskes"></div>
					</div>	
					<div class="col-md-8">
						<div class="form-group">
							<label>Nomor Surat Izin <span style="color:red">*</span></label>
							<input class="form-control" name="nmr_izin" id="nmr_izin" type="text" value="<?php echo $results[0]['nmr_izin'];?>" required>
						</div>						
					</div>	
					<div class="col-md-8">
						<div class="form-group">						 
							<label>Tgl expired <span style="color:red">*</span></label>
							<input class="form-control datepicker" name="tgl_expired_izin" id="tgl_expired_izin" type="text" value="<?php echo $results[0]['tgl_expired_izin'];?>" required>	
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