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
<div class="content-wrapper">
	<div class="container-fluid">
	
		<?php 
		if($this->session->flashdata('msg')){
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <?=$this->session->flashdata('msg');?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>	
		<?php 
		}
		?>
		
		<div class="box_general padding_bottom">
			<form name="formcrud" method="POST" action="<?=base_url('user/profile/edit');?>" class="form-horizontal" role="form">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i><?=$subtitle;?></h2>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<figure><img src="<?=base_url('images/user/dokter.png');?>" width="300" alt=""></figure>
				    </div>
				</div>
				<div class="col-md-8 add_top_30">
					<div class="row00">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama : </label>
								<?=$results[0]['name'];?>
							</div>
						</div>
						<div class="col-md-6">
							<button class="btn btn-success" value="login" type="submit" name="action">Edit Profile</button>
						</div>
					</div>
					<!-- /row-->
				</div>
			</div>
			</form>
		</div>
		<!-- /box_general-->
		
		<div class="box_general padding_bottom">
			<form name="formcrud" method="POST" action="<?=base_url('user/profile/form_password');?>" class="form-horizontal" role="form">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i>Facebook</h2>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<p>Halaman anda dapat terbuhung dengan Facebook Page dengan mengklik button di bawah ini</p>
						<button class="btn btn-success" value="login" type="submit" name="action">Connect to Facebook Page</button>
				    </div>
				</div>
			</div>
			</form>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->