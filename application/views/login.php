<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?=$judul;?></title>
  <link href="<?=base_url('icon.ico');?>" rel="shortcut icon"/>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="<?=base_url('assets/bootstrap/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
  <!-- iCheck -->
  <link href="<?=base_url('assets/plugins/iCheck/square/blue.css');?>" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">
          .wallpaper {
            background-image: url('<?=base_url('assets/dist/img/posku.jpg')?>');
            background-repeat: no-repeat;
            background-size: 100% 100%;
          }

          label {
            color: #999999;
            font-weight: normal;
            margin-top: 5px;
          }      
        </style>

      </head>

      <body>
        <body class="wallpaper">
          <div>
            <div class="login-box">
              <div class="login-logo">
                <h3><b>POSKU</b> </h3>
                <h4><small><?=strtoupper("Point of Sale");?></small></h4>
                <h4><small>RSJ Dr. Radjiman Wediodiningrat Lawang</small></h4>
              </div>



              <!-- /.login-logo -->

              <div class="login-box-body">
                <!--<p class="login-box-msg"><b>LOG</b> IN</p>-->
                <form action="<?php echo base_url('login/proses'); ?>" method="post">
                  <?php
                  if (validation_errors() || $this->session->flashdata('result_login')) {
                    ?>
                    <div class="alert alert-error">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Warning!</strong>
                      <?php echo validation_errors(); ?>
                      <?php echo $this->session->flashdata('result_login'); ?>
                    </div>    
                    <?php } ?>
                    <label><small>User Name</small></label>
                    <div class="form-group has-feedback">

                      <input type="text" name="username" 
                      class="form-control" placeholder="User Name" autofocus="" />
                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <label><small>Password</small></label>
                    <div class="form-group has-feedback">
                      <input type="password" name="password" 
                      class="form-control" placeholder="Password" />
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                      <div class="col-xs-6">    
                                                
                      </div><!-- /.col -->
                      <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                      </div><!-- /.col -->            
                    </div>

                    <?php echo form_close();?>

                    <!--<a href="#">I forgot my password</a><br>-->
                    <div class="social-auth-links text-center">
                      <small>Instalasi SIRS Programmer &copy; <?=date('Y')?></small>
                    </div><!-- /.social-auth-links -->
                  </div><!-- /.login-box-body -->

                </div><!-- /.login-box -->

                <!-- jQuery 2.1.3 -->
                <script src="<?=base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
                <!-- Bootstrap 3.3.2 JS -->
                <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
                <!-- iCheck -->
                <script src="<?=base_url('assets/plugins/iCheck/icheck.min.js');?>" type="text/javascript"></script>
                <script>
                  $(function () {
                    $('input').iCheck({
                      checkboxClass: 'icheckbox_square-blue',
                      radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
                  });
                </script>
              </body>

              </html>
              <?php
