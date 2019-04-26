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
	$("#plus").click(function() {
		var html = 
			'<div class="form-group" id="hapus">'+
				'<div class="row" style="padding-left:15px">'+
					'<div class="col-md-5 col-lg-6">'+						
						'<div class="form-group">'+
							'<label>Methode</label>'+
							'<select name="rule_method[]" id="rule_method" class="form-control" required>'+
								'<option value="index">Read</option>'+
								'<option value="add">Add</option>'+
								'<option value="edit">Edit</option>'+
								'<option value="hapus">Delete</option>'+
							'</select>'+
						'</div>'+						
					'</div>'+
					'<div class="col-md-5 col-lg-6">'+
						'<div class="form-group">'+
							'<label>Menu</label>'+
							'<input id="menu" type="text" name="menu[]" value="" class="form-control" required />'+
						'</div>'+							
					'</div>'+
				'<div>'+
			 '</div>';	
		$("#add_metode").append(html);	
	});
	
	$("#minus").click(function() {
		$( "#hapus" ).remove();	
	});

	$(".ui-dialog-buttonpane button:contains('Cancel')").addClass('cancelButton');
	$(".ui-dialog-buttonpane button:contains('Save')").addClass('saveButton');
});
</script>
<style>
.ui-button.cancelButton {
    border: 1px solid #aaaaaa;
	background: #006600;
}

.ui-button.saveButton {
    border: 1px solid #aaaaaa;
	background: #CC0000;
}

label.rule_method {
	padding-left: 6px;
}

label.menu {
	padding-left: 8px;
}
</style>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i><?=$subtitle;?></h2>
			</div>
			<form name="formcrud" method="POST" action="<?=base_url('rule/update');?>" class="form-horizontal" role="form">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<label>Rule Class *</label>
							<input id="rule_class" class="form-control" name="rule_class" type="text" value="<?php echo $results[0]['rule_class'];?>" required>
						</div>
						<div class="row" id="add_metode">
						<div class="row" style="padding-left:15px">
							<div class="col-md-5 col-lg-5">						
								<div class="form-group">
									<label>Methode</label>
									<select name="rule_method[]" id="rule_method" class="form-control" required>
										<option value="index" <?php if($results[0]['rule_method']=='index'){ echo "selected"; };?>>Read</option>
										<option value="add" <?php if($results[0]['rule_method']=='add'){ echo "selected"; };?>>Add</option>
										<option value="edit" <?php if($results[0]['rule_method']=='edit'){ echo "selected"; };?>>Edit</option>
										<option value="hapus"<?php if($results[0]['rule_method']=='hapus'){ echo "selected"; };?>>Delete</option>
									</select>
								</div>						
							</div>
							<div class="col-md-5 col-lg-5">
								<div class="form-group">
									<label>Menu</label>
									<input id="menu" type="text" name="menu[]" value="<?=$results[0]['menu'];?>" class="form-control" required />
								</div>							
							</div>
						<?php 
						if(empty($results[0]['rule_id'])){
						?>
							<div class="col-md-2" style="padding-top:30px">
								<div class="btn-group">		
									<button type="button" class="btn btn-default" id="plus"><i class="fa fa-fw fa-plus"></i></button>
									<button type="button" class="btn btn-default" id="minus"><i class="fa fa-fw fa-minus"></i></button>
								</div>
							</div>
						<?php
						}
						?>
						</div>
						</div>
					</div>
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-md-8">
					<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
					<a href="<?=base_url('rule');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
					</div>
				</div>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="id" id="id" value="<?=$results[0]['rule_id'];?>">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->