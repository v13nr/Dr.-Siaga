<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$app_name;?> | Admin Dashboad Template</title>
    <!-- Core CSS - Include with every page -->
    <link href="<?= base_url(); ?>application/views/templates/default/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>application/views/templates/default/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>application/views/templates/default/assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="<?= base_url(); ?>application/views/templates/default/assets/css/style.css" rel="stylesheet" />
      <link href="<?= base_url(); ?>application/views/templates/default/assets/css/main-style.css" rel="stylesheet" />

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
              <img src="<?= base_url(); ?>application/views/templates/default/assets/img/logo.png" alt=""/>
                </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
					<?php 
						// set message jika tdk bisa login
						if($this->session->flashdata('msg')){
							echo $this->session->flashdata('msg');
						}
						
						echo form_open('auth/login','name="formLogin" role="form"');
					?>
                            <fieldset>
                                <div class="form-group">
									<?php echo form_input('data[username]','','tabindex="1" id="username" class="form-control" placeholder="Username" autofocus'); ?>

                                </div>
                                <div class="form-group">
                                    <?php echo form_password('data[password]','','tabindex="2" id="password" class="form-control" placeholder="Password"'); ?>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                
                            </fieldset>
                     <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="<?= base_url(); ?>application/views/templates/default/assets/plugins/jquery-1.10.2.js"></script>
    <script src="<?= base_url(); ?>application/views/templates/default/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>application/views/templates/default/assets/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>

</html>
