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
	
	Dropzone.options.DropzoneForm = {
		autoProcessQueue: false,
		acceptedFiles:".png, .jpg, .gif, .bmp, .jpeg",
		init: function(){
			var submitButton = document.querySelector('#submit-all');
			myDropzone = this;
			submitButton.addEventListener("click",function(){
				myDropzone.processQueue();
			});
			this.on("complete",function(){
				if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0){
					var _this = this;
					_this.removeAllFiles();
				}
			});
		}
	|
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
							<label>Nama  <span style="color:red">*</span></label>
							<input class="form-control" name="name" id="name" type="text" value="<?php echo $results[0]['name'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Email <span style="color:red">*</span></label>
							<input class="form-control" name="email" id="email" type="email" value="<?=$results[0]['email'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Hp <span style="color:red">*</span></label>
							<input class="form-control" name="hp" id="hp" type="text" value="<?=$results[0]['hp'];?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Your photo<span style="color:red">*</span></label>

						<figure><img src="<?php if(empty($results[0]['image_user'])){  echo base_url('images/user/image-default-user.png'); } else { echo base_url('images/user/'.$results[0]['image_user']); } ?>" width="300" alt=""></figure>
							<form action="file-upload" class="dropzone" id="DropzoneForm">
								<div class="fallback">
								<input name="file" type="file" multiple />
								</div>
							</form>
						</div>
						<div id="preview"></div>
					</div>
				</div>
				<div class="row" style="padding-top:20px">
					<div class="col-md-8">
					<input type="submit" id="" value="Save" class="btn btn-inversed btn-primary">
					<a href="<?=base_url('user/profile');?>" class="btn btn-default btn-inversed btn-small" style="width:100px;height:38px;padding:8px">Cancel</a>
					</div>
				</div>
				<input type="hidden" name="button" value="Save">
				<input type="hidden" name="user_id" id="user_id" value="<?=$results[0]['user_id'];?>">
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->