<?php

/**
 *	Copyright (C)	: Doktersiaga
 *	Developer		: Fatah Iskandar Akbar
 *  Email 			: fatah@doktersiaga.com
 *	Date			: Februaru 2019
**/

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?=$desc;?>">
	<meta name="keywords" content="<?=$keyword;?>">
	<meta name="author" content="Doktersiaga">
	<title>Doktersiaga Master - <?=$title;?></title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="<?=base_url('application/views/templates/default/img/favicon.ico');?>" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="<?=base_url('application/views/templates/default/img/apple-touch-icon-57x57-precomposed.png');?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?=base_url('application/views/templates/default/img/apple-touch-icon-72x72-precomposed.png');?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?=base_url('application/views/templates/default/img/apple-touch-icon-114x114-precomposed.png');?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?=base_url('application/views/templates/default/img/apple-touch-icon-144x144-precomposed.png');?>">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

	<!-- Bootstrap core CSS-->
	<link href="<?=base_url('application/views/templates/default/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	<!-- Icon fonts-->
	<link href="<?=base_url('application/views/templates/default/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
	<!-- Plugin styles -->
	<link href="<?=base_url('application/views/templates/default/vendor/datatables/dataTables.bootstrap4.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/views/templates/default/vendor/bootstrap/css/bootstrap-datepicker.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/views/templates/default/vendor/jquery-ui/jquery-ui.css');?>" rel="stylesheet">
	<link href="<?=base_url('application/views/templates/default/vendor/dropzone.css');?>" rel="stylesheet">
	
	<!-- Updated stylesheet url -->
	<link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">

	<!-- Main styles -->
	<link href="<?=base_url('application/views/templates/default/css/admin.css');?>" rel="stylesheet">
	<!-- Your custom styles -->
	<link href="<?=base_url('application/views/templates/default/css/drsiaga.css');?>" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56817061-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-56817061-13');
	</script>

	
</head>
<body class="fixed-nav sticky-footer" id="page-top" data-spy="scroll" data-target="#myScrollspy" data-offset="20">

	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->

	<?php echo $header;?>
	<?php echo $main;?>
	<?php //echo $sidebar;?>
	<?php echo $footer;?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?=base_url('auth/logout');?>">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url('application/views/templates/default/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?=base_url('application/views/templates/default/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?=base_url('application/views/templates/default/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
    <!-- Page level plugin JavaScript-->
	<script src="<?=base_url('application/views/templates/default/vendor/jquery-ui/jquery-ui.js');?>"></script>
	<script src="<?=base_url('application/views/templates/default/vendor/bootstrap/js/bootstrap-datepicker.js');?>"></script>
    <script src="<?=base_url('application/views/templates/default/vendor/datatables/jquery.dataTables.js');?>"></script>
    <script src="<?=base_url('application/views/templates/default/vendor/datatables/dataTables.bootstrap4.js');?>"></script>
	<script src="<?=base_url('application/views/templates/default/vendor/jquery.selectbox-0.2.js');?>"></script>
	<script src="<?=base_url('application/views/templates/default/vendor/retina-replace.min.js');?>"></script>
	<script src="<?=base_url('application/views/templates/default/vendor/jquery.magnific-popup.min.js');?>"></script>
	<script src="<?=base_url('application/views/templates/default/vendor/dropzone.min.js');?>"></script>
	<!-- Updated JavaScript url -->
	<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
	
    <!-- Custom scripts for all pages-->
    <script src="<?=base_url('application/views/templates/default/js/admin.js');?>"></script>
	
</body>
</html>
