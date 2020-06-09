<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>SIAKU</title>
  <link href="<?=base_url('icon.ico');?>" rel="shortcut icon"/>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  <link href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" /> -->
  <!-- Font Awesome Icons -->
  <link href="<?=base_url();?>assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="<?=base_url();?>assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link href="<?=base_url();?>assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?=base_url();?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url();?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- jquery-ui -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-datepicker.css');?>">
    <!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/chosen.min.css');?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/jQueryUI/css/jquery-ui.css');?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/style.css')?>"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css')?>">


    <!-- CSS Modifikasi -->
    <!-- <style type="text/css">
      label {
      color: #999999;
      font-weight: normal;
      margin-top: 5px;
      }
    
    </style> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery 2.1.3 -->
        <script src="<?=base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?=base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="<?=base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>    
        <!-- FastClick -->
        <script src="<?=base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url();?>assets/dist/js/app.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?=base_url();?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>        

        <!-- jQuery UI -->    
        <script src="<?=base_url();?>assets/jQueryUI/jquery-ui-1.10.3.js"></script>
        <script src="<?=base_url();?>assets/bootstrap/js/chosen.jquery.min.js"></script>
        <script src="<?=base_url();?>assets/bootstrap/js/jquery.validate.js"></script>
        <script src="<?=base_url();?>assets/bootstrap/js/jquery-validate.bootstrap-tooltip.js"></script>
        <script src="<?=base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
        <script src="<?=base_url();?>assets/bootstrap/js/jquery.maskMoney.js"></script>
        <script src="<?=base_url();?>assets/bootstrap/js/st.js"></script>

        <script src="<?php echo base_url();?>assets/js/highcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/highcharts-3d.js" type="text/javascript"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>-->

        <script>
          $(document).on('mouseenter', ".wrap", function () {
            var $this = $(this);
            if (this.offsetWidth < this.scrollWidth && !$this.attr('title')) {
              $this.tooltip({
                title: $this.text(),
                placement: "bottom"
              });
              $this.tooltip('show');
            }
          });
        </script>



    <!-- <script type="text/javascript">
      $(function () {
        $("#table1").dataTable();
        $("#table2").dataTable();
        $("#table3").dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });

      });
    </script> -->    
  </head>


  <body class="skin-green fixed">
    <?php
    $nama = $this->session->userdata('nama');
    $u_id = $this->session->userdata('u_id');
    
    $u_name = $this->session->userdata('u_name');
    $id_role = $this->session->userdata('id_role');

    echo $u_id.$nama.$u_name.$id_role;
    ?>
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->

        <a href="<?php echo base_url();?>" class="logo"><img src="<?php echo base_url('assets/dist/img/icon.png');?>" style="max-height:35px;max-width:50px;"/>&nbsp;&nbsp;POSKU</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url('assets/dist/img/user.png');?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $nama;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url('assets/dist/img/user.png');?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $nama;?>
                      <small>Member since <?php echo date('m-Y')?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('dashboard/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url('assets/dist/img/user.png');?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $nama;?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php 
            $sql_host =     "localhost";      
            $sql_username = "root";    
            $sql_password = "";       
            $sql_database = "posku";


            $mysqli = new mysqli($sql_host , $sql_username , $sql_password , $sql_database );
            if ($mysqli->connect_errno) {
              printf("Connect failed: %s\n", $mysqli->connect_error);
              exit();
            }

           $menu = mysqli_query($mysqli,"SELECT * FROM menu where id_roles like '%".$id_role."%' and aktif=1 ORDER BY menu_id ASC");
           while($dataMenu = mysqli_fetch_assoc($menu)){
            $menu_id = $dataMenu['menu_id'];
            $s_m = "SELECT * FROM submenu WHERE menu_id='$menu_id' and id_roles like '%".$id_role."%' and aktif=1 ORDER BY submenu_id ASC";
            $submenu = mysqli_query($mysqli,$s_m);
            //echo mysqli_num_rows($submenu)."<br>";
            if(mysqli_num_rows($submenu) == 0){
              echo '<li>
              <a href="'.base_url($dataMenu['menu_link']).'">
                <i class="'.$dataMenu['menu_icon'].'"></i> <span>'.$dataMenu['menu'].'</span>
                <small class="label pull-right bg-yellow"></small>
              </a>
            </li>';
          }else{
            echo '<li class="treeview">
            <a href="'.base_url($dataMenu['menu_link']).'">
              <i class="'.$dataMenu['menu_icon'].'"></i> <span>'.$dataMenu['menu'].'</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">';
            while($dataSubmenu = mysqli_fetch_assoc($submenu)){
                $level2 = "select * from submenu sm where sm.level2_menu=".$dataSubmenu['submenu_id']." and id_roles like '%".$id_role."%' and sm.aktif=1 order by sm.submenu_id asc";
                        //echo $level2;
                $s_level2 = mysqli_query($mysqli,$level2);
                if(mysqli_num_rows($s_level2)==0){
                  echo '<li><a href="'.base_url($dataSubmenu['submenu_link']).'""><i class="fa fa-circle-o"></i>'.$dataSubmenu['submenu'].'</a></li>';
                }else{
                  echo '<li class="treeview">
                  <a href="'.$dataSubmenu['submenu_link'].'">
                    <i class="fa fa-share"></i> <span>'.$dataSubmenu['submenu'].'</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">';
                    while($dt_level2 = mysqli_fetch_assoc($s_level2)){
                      $s_level3 = mysqli_query($mysqli,"select * from submenu sm where sm.level3_menu=".$dt_level2['submenu_id']." and id_roles like '%".$id_role."%' and sm.aktif=1  order by sm.submenu_id asc ");
                      if(mysqli_num_rows($s_level3)==0){
                        echo '<li><a href="'.base_url($dt_level2['submenu_link']).'""><i class="fa fa-circle-o"></i>'.$dt_level2['submenu'].'</a></li>';
                      }
                      else{
                        echo '<li class="treeview">
                        <a href="'.$dt_level2['submenu_link'].'">
                          <i class="fa fa-share"></i> <span>'.$dt_level2['submenu'].'</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">';
                          while($dt_level3 = mysqli_fetch_assoc($s_level3)){
                            echo '<li><a href="'.base_url($dt_level3['submenu_link']).'""><i class="fa fa-circle-o"></i>'.$dt_level3['submenu'].'</a></li>';

                          }
                          echo '</ul>
                        </li>';

                      }
                    }
                    echo '</ul>
                  </li>';
                }

              }
              echo '</ul>
            </li>';

          }
        }

        ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

  <!-- <section class="content-header">
   
  <!-- Main content -->

  <section class="content">

    <!-- Info boxes -->
  <!-- <div class="callout callout-info">
  <h4>Tip!</h4><p></p>
</div> -->

