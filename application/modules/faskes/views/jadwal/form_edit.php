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
	$( "#poli_id" ).change(function() {
		
		var poli_id = $('#poli_id').val();
		$( "#nama_dr" ).val('');
				
		$( "#nama_dr" ).autocomplete({
			source: 'https://doktersiaga.id/faskes/dokterpoli/list_dokter_poli/<?=$faskes[0]['faskes_id'];?>/'+poli_id,
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
							<label>Faskes <span style="color:red">*</span></label>
							<input class="form-control" name="nama_faskes" id="nama_faskes" type="text" value="<?php if(empty($results)){ echo $faskes[0]['nama_faskes']; } else { echo $results[0]['nama_faskes']; } ?>" disabled>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Poliklinik <span style="color:red">*</span></label>
							<select name="poli_id" id="poli_id" class="form-control" disabled>
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
							<input class="form-control" name="nama_dr" id="nama_dr" type="text" value="<?php echo $results[0]['gelar_depan']." ".$results[0]['gelar']." ".$results[0]['nama_dokter']." ".$results[0]['gelar_belakang']." ".$results[0]['title'];?>" disabled>
						</div>
					</div>
				<div class="col-md-12">
					<h6>Jadwal Praktek admiin</h6>
					<table id="pricing-list-container" style="width:100%;">
						<tr class="pricing-list-item">
							<td>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<select name="hari[]" class="form-control">
												<option value="">Hari Praktek</option>
												<option value="1" <?php if($results[0]['hari']=="1"){ echo "selected"; } ?> >Senen</option>
												<option value="2" <?php if($results[0]['hari']=="2"){ echo "selected"; } ?> >Selasa</option>
												<option value="3" <?php if($results[0]['hari']=="3"){ echo "selected"; } ?> >Rabu</option>
												<option value="4" <?php if($results[0]['hari']=="4"){ echo "selected"; } ?> >Kamis</option>
												<option value="5" <?php if($results[0]['hari']=="5"){ echo "selected"; } ?> >Jumat</option>
												<option value="6" <?php if($results[0]['hari']=="6"){ echo "selected"; } ?> >Sabtu</option>
												<option value="7" <?php if($results[0]['hari']=="7"){ echo "selected"; } ?> >Minggu</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<select name="jam_mulai[]" class="form-control">
												<option value="">Jam Mulai</option>
												<option value="07:00" <?php if($results[0]['jam_mulai']=="07:00"){ echo "selected"; } ?> >07:00</option>
												<option value="07:30" <?php if($results[0]['jam_mulai']=="07:30"){ echo "selected"; } ?> >07:30</option>
												<option value="08:00" <?php if($results[0]['jam_mulai']=="08:00"){ echo "selected"; } ?> >08:00</option>
												<option value="08:30" <?php if($results[0]['jam_mulai']=="08:30"){ echo "selected"; } ?> >08:30</option>
												<option value="09:00" <?php if($results[0]['jam_mulai']=="09:00"){ echo "selected"; } ?> >09:00</option>
												<option value="09:30" <?php if($results[0]['jam_mulai']=="09:30"){ echo "selected"; } ?> >09:30</option>
												<option value="10:00" <?php if($results[0]['jam_mulai']=="10:00"){ echo "selected"; } ?> >10:00</option>
												<option value="10:30" <?php if($results[0]['jam_mulai']=="10:30"){ echo "selected"; } ?> >10:30</option>
												<option value="11:00" <?php if($results[0]['jam_mulai']=="11:00"){ echo "selected"; } ?> >11:00</option>
												<option value="11:30" <?php if($results[0]['jam_mulai']=="11:30"){ echo "selected"; } ?> >11:30</option>
												<option value="12:00" <?php if($results[0]['jam_mulai']=="12:00"){ echo "selected"; } ?> >12:00</option>
												<option value="12:30" <?php if($results[0]['jam_mulai']=="12:30"){ echo "selected"; } ?> >12:30</option>
												<option value="13:00" <?php if($results[0]['jam_mulai']=="13:00"){ echo "selected"; } ?> >13:00</option>
												<option value="13:30" <?php if($results[0]['jam_mulai']=="13:30"){ echo "selected"; } ?> >13:30</option>
												<option value="14:00" <?php if($results[0]['jam_mulai']=="14:00"){ echo "selected"; } ?> >14:00</option>
												<option value="14:30" <?php if($results[0]['jam_mulai']=="14:30"){ echo "selected"; } ?> >14:30</option>
												<option value="15:00" <?php if($results[0]['jam_mulai']=="15:00"){ echo "selected"; } ?> >15:00</option>
												<option value="15:30" <?php if($results[0]['jam_mulai']=="15:30"){ echo "selected"; } ?> >15:30</option>
												<option value="16:00" <?php if($results[0]['jam_mulai']=="16:00"){ echo "selected"; } ?> >16:00</option>
												<option value="16:30" <?php if($results[0]['jam_mulai']=="16:30"){ echo "selected"; } ?> >16:30</option>
												<option value="17:00" <?php if($results[0]['jam_mulai']=="17:00"){ echo "selected"; } ?> >17:00</option>
												<option value="17:30" <?php if($results[0]['jam_mulai']=="17:30"){ echo "selected"; } ?> >17:30</option>
												<option value="18:00" <?php if($results[0]['jam_mulai']=="18:00"){ echo "selected"; } ?> >18:00</option>
												<option value="18:30" <?php if($results[0]['jam_mulai']=="18:30"){ echo "selected"; } ?> >18:30</option>
												<option value="19:00" <?php if($results[0]['jam_mulai']=="19:00"){ echo "selected"; } ?> >19:00</option>
												<option value="19:30" <?php if($results[0]['jam_mulai']=="19:30"){ echo "selected"; } ?> >19:30</option>
												<option value="20:00" <?php if($results[0]['jam_mulai']=="20:00"){ echo "selected"; } ?> >20:00</option>
												<option value="20:30" <?php if($results[0]['jam_mulai']=="20:30"){ echo "selected"; } ?> >20:30</option>
												<option value="21:00" <?php if($results[0]['jam_mulai']=="21:00"){ echo "selected"; } ?> >21:00</option>
												<option value="21:30" <?php if($results[0]['jam_mulai']=="21:30"){ echo "selected"; } ?> >21:30</option>
												<option value="22:00" <?php if($results[0]['jam_mulai']=="22:00"){ echo "selected"; } ?> >22:00</option>
												<option value="22:30" <?php if($results[0]['jam_mulai']=="22:30"){ echo "selected"; } ?> >22:30</option>
												<option value="23:00" <?php if($results[0]['jam_mulai']=="23:00"){ echo "selected"; } ?> >23:00</option>
												<option value="23:30" <?php if($results[0]['jam_mulai']=="23:30"){ echo "selected"; } ?> >23:30</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<select name="jam_selesai[]" class="form-control">
												<option value="">Jam Selesai</option>
												<option value="07:00" <?php if($results[0]['jam_selesai']=="07:00"){ echo "selected"; } ?> >07:00</option>
												<option value="07:30" <?php if($results[0]['jam_selesai']=="07:30"){ echo "selected"; } ?> >07:30</option>
												<option value="08:00" <?php if($results[0]['jam_selesai']=="08:00"){ echo "selected"; } ?> >08:00</option>
												<option value="08:30" <?php if($results[0]['jam_selesai']=="08:30"){ echo "selected"; } ?> >08:30</option>
												<option value="09:00" <?php if($results[0]['jam_selesai']=="09:00"){ echo "selected"; } ?> >09:00</option>
												<option value="09:30" <?php if($results[0]['jam_selesai']=="09:30"){ echo "selected"; } ?> >09:30</option>
												<option value="10:00" <?php if($results[0]['jam_selesai']=="10:00"){ echo "selected"; } ?> >10:00</option>
												<option value="10:30" <?php if($results[0]['jam_selesai']=="10:30"){ echo "selected"; } ?> >10:30</option>
												<option value="11:00" <?php if($results[0]['jam_selesai']=="11:00"){ echo "selected"; } ?> >11:00</option>
												<option value="11:30" <?php if($results[0]['jam_selesai']=="11:30"){ echo "selected"; } ?> >11:30</option>
												<option value="12:00" <?php if($results[0]['jam_selesai']=="12:00"){ echo "selected"; } ?> >12:00</option>
												<option value="12:30" <?php if($results[0]['jam_selesai']=="12:30"){ echo "selected"; } ?> >12:30</option>
												<option value="13:00" <?php if($results[0]['jam_selesai']=="13:00"){ echo "selected"; } ?> >13:00</option>
												<option value="13:30" <?php if($results[0]['jam_selesai']=="13:30"){ echo "selected"; } ?> >13:30</option>
												<option value="14:00" <?php if($results[0]['jam_selesai']=="14:00"){ echo "selected"; } ?> >14:00</option>
												<option value="14:30" <?php if($results[0]['jam_selesai']=="14:30"){ echo "selected"; } ?> >14:30</option>
												<option value="15:00" <?php if($results[0]['jam_selesai']=="15:00"){ echo "selected"; } ?> >15:00</option>
												<option value="15:30" <?php if($results[0]['jam_selesai']=="15:30"){ echo "selected"; } ?> >15:30</option>
												<option value="16:00" <?php if($results[0]['jam_selesai']=="16:00"){ echo "selected"; } ?> >16:00</option>
												<option value="16:30" <?php if($results[0]['jam_selesai']=="16:30"){ echo "selected"; } ?> >16:30</option>
												<option value="17:00" <?php if($results[0]['jam_selesai']=="17:00"){ echo "selected"; } ?> >17:00</option>
												<option value="17:30" <?php if($results[0]['jam_selesai']=="17:30"){ echo "selected"; } ?> >17:30</option>
												<option value="18:00" <?php if($results[0]['jam_selesai']=="18:00"){ echo "selected"; } ?> >18:00</option>
												<option value="18:30" <?php if($results[0]['jam_selesai']=="18:30"){ echo "selected"; } ?> >18:30</option>
												<option value="19:00" <?php if($results[0]['jam_selesai']=="19:00"){ echo "selected"; } ?> >19:00</option>
												<option value="19:30" <?php if($results[0]['jam_selesai']=="19:30"){ echo "selected"; } ?> >19:30</option>
												<option value="20:00" <?php if($results[0]['jam_selesai']=="20:00"){ echo "selected"; } ?> >20:00</option>
												<option value="20:30" <?php if($results[0]['jam_selesai']=="20:30"){ echo "selected"; } ?> >20:30</option>
												<option value="21:00" <?php if($results[0]['jam_selesai']=="21:00"){ echo "selected"; } ?> >21:00</option>
												<option value="21:30" <?php if($results[0]['jam_selesai']=="21:30"){ echo "selected"; } ?> >21:30</option>
												<option value="22:00" <?php if($results[0]['jam_selesai']=="22:00"){ echo "selected"; } ?> >22:00</option>
												<option value="22:30" <?php if($results[0]['jam_selesai']=="22:30"){ echo "selected"; } ?> >22:30</option>
												<option value="23:00" <?php if($results[0]['jam_selesai']=="23:00"){ echo "selected"; } ?> >23:00</option>
												<option value="23:30" <?php if($results[0]['jam_selesai']=="23:30"){ echo "selected"; } ?> >23:30</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" name="ket[]" value="<?=$results[0]['ket'];?>"  class="form-control"  placeholder="Ketrangan">
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-md-8">
					<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
					<a href="<?=base_url('faskes/jadwal');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
					</div>
				</div>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="faskes_id" id="faskes_id" value="<?=$results[0]['faskes_id'];?>">
				<input type="hidden" name="poli_id" id="poli_id" value="<?=$results[0]['poli_id'];?>">
				<input type="hidden" name="spesialis_id" id="spesialis_id" value="<?=$results[0]['spesialis_id'];?>">
				<input type="hidden" name="dokter_id" id="dokter_id" value="<?=$results[0]['dokter_id'];?>">
				<input type="hidden" name="jadwal_id" id="jadwal_id" value="<?=$results[0]['jadwal_id'];?>">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->