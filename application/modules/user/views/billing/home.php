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
				<div class="col-md-8 add_top_30">
					<div class="col-md-8">
						<div class="form-group">
							<h3>Jumlah Invoice : 4</h3>
						</div>
					</div>
					<div class="col-md-6">
						<button class="btn btn-success" value="login" type="submit" name="action">Lihat Invoice</button>
					</div>
				</div>
			</div>
			</form>
		</div>
		<!-- /box_general-->
		
		<div class="box_general padding_bottom">
			<form name="formcrud" method="POST" action="<?=base_url('user/profile/form_password');?>" class="form-horizontal" role="form">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i>Pembayaran</h2>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<p>Pembayaran dapat di transfer ke bank</br></br>
						<b>BCA</b></br>
						Nomor rekening : 751 0190 496</br>
						Atas nama : PT Doktersiaga Teknologi Indonesia</br>
						</p>
						<button class="btn btn-success" value="login" type="submit" name="action">Konfirmasi Pembayaran</button>
				    </div>
				</div>
			</div>
			</form>
		</div>
		<!-- /box_general-->
		
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-user"></i>History Pembayaran</h2>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<button class="btn btn-success" value="login" type="submit" name="action">Lihat History Pembayaran</button>			
					</div>
					
				</div>
			</div>
		</div>
		<!-- /box_general-->
		
	</div>
	<!-- /.container-fluid-->
</div>
<!-- /.container-wrapper-->