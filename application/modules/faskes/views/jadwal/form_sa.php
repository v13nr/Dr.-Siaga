<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Template			: 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//print_r($faskes); exit;

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
	
	$( "#tipe_faskes" ).change(function() {
		var tipe_faskes = $("#tipe_faskes").val();
		$("#nama_faskes").val();
		
		// get faskes
		$.ajax({
			 url: '<?=base_url('faskes/get_faskes');?>', 
			 type: "GET",
			 data: ( { tipe_faskes: tipe_faskes} ),
			 dataType: "json", 
			 async:true,
			 success: function(msg){
								
				$("#nama_faskes").removeAttr('disabled');
				$('#nama_faskes').attr('required',true);
				
				$("#poli_id").removeAttr('disabled');
				$('#poli_id').attr('required',true);
				
				$("#nama_dr").removeAttr('disabled');
				$('#nama_dr').attr('required',true);
				
				$( "#nama_faskes" ).autocomplete({
					source: msg,
					delay:0,
					autoFocus:true,
					response: function(event, ui) {
						if (!ui.content.length) {
							var noResult = { 
								 value: "", 
								 label: "Data tidak di temukan" 
							 };
							 ui.content.push(noResult);                    
						 } else {
						 
						 }
					},
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
	
	$( "#nama_faskes" ).change(function() {
		var faskes_id = $('#faskes_id').val();
		//alert(faskes_id);
		
		// get poli
		$.ajax({
			 url: '<?=base_url('faskes/poli/get_poli');?>', 
			 type: "GET",
			 data: ( { faskes_id: faskes_id} ),
			 dataType: "json", 
			 async:true,
			 success: function(msg){
				$( "#poli_id" ).remove();
				
				//alert(msg);
				var poli = '<select name="poli_id" id="poli_id" class="form-control" required>';				
					poli += '<option value="">Pilih Poli</option>';
				for(var i=0; i < msg.length; i++){
					poli += '<option value="'+msg[i].poli_id+'">'+msg[i].nama_poli+'</option>';
				}
				
				poli +='</select>';
				$("#add_poli").append('<b>'+poli+'</b>');
				
				$( "#poli_id" ).change(function() {
					
					var poli_id = $('#poli_id').val();
					$( "#nama_dr" ).val('');
							alert(poli_id);
					$( "#nama_dr" ).autocomplete({
						source: 'https://doktersiaga.id/faskes/dokterpoli/list_dokter_poli/'+faskes_id+'/'+poli_id,
						delay:0,
						autoFocus:true,
						response: function(event, ui) {
							if (!ui.content.length) {
								var noResult = { 
									 value: "", 
									 label: "Data tidak di temukan" 
								 };
								 ui.content.push(noResult);                    
							 } 
						},
						select:function(event, ui){
							$('#dokter_id').val(ui.item.dokter_id);
							$('#spesialis_id').val(ui.item.spesialis_id);
							//alert(ui.item.spesialis_id);
						}
					})
					.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
						return $( "<li>" )
						.append("<a>" + item.label + "</a><div class='form-group'><a class='dropdown-item' data-toggle='modal' data-target='#addDokter'>Add dokter</a>")
						.appendTo( ul );			
					};
				});
				
			 }
		});
	});	
	
});
</script>
    <!-- Form Modal-->
    <div class="modal fade" id="addDokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Dokter</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
				<form name="formcrud" method="POST" action="<?=base_url('doctor/update');?>" class="form-horizontal" role="form">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Gelar <span style="color:red">*</span></label>
								<select name="gelar" class="form-control">
									<option value="">Pilih Gelar</option>
									<option value="dr">Dr</option>
									<option value="drg">Drg</option>
								</select>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">						 
								<label>Nama Dokter <span style="color:red">*</span></label>
								<input class="form-control" name="nama_dokter" id="nama_dokter" type="text" value="" required>	
							</div>						
						</div>	
						<div class="col-md-8">
							<div class="form-group">						 
								<label>Gelar Depan</label>
								<input class="form-control" name="gelar_depan" id="gelar_depan" type="text" value="" placeholder="Contoh : Prof, DR">	
							</div>						
						</div>
						<div class="col-md-8">
							<div class="form-group">						 
								<label>Gelar Belakang</label>
								<input class="form-control" name="gelar_belakang" id="gelar_belakang" type="text" value="" placeholder="Contoh : MARS,MKK">	
							</div>						
						</div>
						<div class="col-md-8">
							<div class="form-group">						 
								<label>Gender <span style="color:red">*</span></label>
								<select name="gender" class="form-control">
									<option value="">Pilih Gender</option>
									<option value="M" >Pria</option>
									<option value="F" >Wanita</option>
								</select>
							</div>						
						</div>
						<div class="col-md-8">
							<div class="form-group">						 
								<label>Nomor STR <span style="color:red">*</span></label>
								<input class="form-control" name="nmr_str" id="nmr_str" type="text" value="" placeholder="" required>	
							</div>						
						</div>
						<div class="col-md-8">
							<div class="form-group">						 
								<label>Tgl expired STR <span style="color:red">*</span></label>
								<input class="form-control" name="tgl_expired_str" id="tgl_expired_str" type="text" value="" placeholder="" required>	
							</div>						
						</div>
						<div class="col-md-8">
							<div class="form-group">						 
								<label>Spesialisasi <span style="color:red">*</span></label>
								<input class="form-control" name="spesialisasi" id="spesialisasi" type="text" value="" placeholder="" required>	
								
							</div>						
						</div>
					</div>
					<input type="hidden" name="button" value="Save">
				</form>
		  
		  </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?=base_url('doctor/update');?>">Save</a>
          </div>
        </div>
      </div>
    </div>
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
							<label>Faskes <span style="color:red">*</span></label>
							<input class="form-control" name="nama_faskes" id="nama_faskes" type="text" value=""  disabled>
							<input type="hidden" name="faskes_id" id="faskes_id" value="<?php if(empty($results)){ echo $faskes[0]['faskes_id']; } else { echo $results[0]['faskes_id']; }?>">
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Poliklinik <span style="color:red">*</span></label>
							<div id="add_poli">
							<select name="poli_id" id="poli_id" class="form-control"  disabled>
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
					</div>					
					<div class="col-md-8">
						<div class="form-group">
							<label>Nama Dokter <span style="color:red">*</span></label>
							<input class="form-control" name="nama_dr" id="nama_dr" type="text" value="<?php echo $results[0]['gelar_depan']." ".$results[0]['gelar']." ".$results[0]['nama_dokter']." ".$results[0]['gelar_belakang']." ".$results[0]['title'];?>" disabled>
						</div>
					</div>
				<div class="col-md-12">
					<h6>Jadwal Praktek</h6>
					<table id="pricing-list-container" style="width:100%;">
						<tr class="pricing-list-item">
							<td>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<select name="hari[]" class="form-control" required>
												<option value="">Hari Praktek</option>
												<option value="1">Senen</option>
												<option value="2">Selasa</option>
												<option value="3">Rabu</option>
												<option value="4">Kamis</option>
												<option value="5">Jumat</option>
												<option value="6">Sabtu</option>
												<option value="7">Minggu</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<select name="jam_mulai[]" class="form-control" required>
												<option value="">Jam Mulai</option>
												<option value="07:00">07:00</option>
												<option value="07:30">07:30</option>
												<option value="08:00">08:00</option>
												<option value="08:30">08:30</option>
												<option value="09:00">09:00</option>
												<option value="09:30">09:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<select name="jam_selesai[]" class="form-control" required>
												<option value="">Jam Selesai</option>
												<option value="07:30">07:30</option>
												<option value="08:00">08:00</option>
												<option value="08:30">08:30</option>
												<option value="09:00">09:00</option>
												<option value="09:30">09:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" name="ket[]" class="form-control"  placeholder="Ketrangan">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<a class="delete" href="#"><i class="fa fa-fw fa-remove"></i></a>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<a href="#0" class="btn_1 gray add-pricing-list-item"><i class="fa fa-fw fa-plus-circle"></i>Tambah Jadwal</a>
				</div>
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-md-8">
					<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
					<a href="<?=base_url('faskes/jadwal');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
					</div>
				</div>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="dokter_id" id="dokter_id" value="">
				<input type="hidden" name="spesialis_id" id="spesialis_id" value="">
				<input type="hidden" name="mode" id="mode" value="<?php if(count($results) > 0){ echo "edit"; } else { echo "new"; } ?>">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->