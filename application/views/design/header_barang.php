<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Inventory</title>
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
    <link href="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=base_url();?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url();?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- jquery-ui -->

    <link rel="stylesheet" href="<?php echo base_url('assets/jQueryUI/css/jquery-ui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/css/style.css')?>">

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
    <script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    
    <!-- jQuery UI -->    
    <script src="<?=base_url();?>assets/jQueryUI/jquery-ui-1.10.3.js"></script>
    <script src="<?=base_url();?>assets/bootstrap/js/chosen.jquery.min.js"></script>
    <script src="<?=base_url();?>assets/bootstrap/js/jquery.validate.js"></script>
    <script src="<?=base_url();?>assets/bootstrap/js/jquery-validate.bootstrap-tooltip.js"></script>
    <script src="<?=base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>



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
  <body class="skin-blue fixed">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->

        <a href="<?=base_url();?>" class="logo"><img src="<?=base_url('assets/dist/img/icon.png');?>" style="max-height:35px;max-width:50px;"/>&nbsp;&nbsp;Inventory</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <!-- <span class="label label-success">4</span> -->
                </a>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <!-- <span class="label label-warning">10</span> -->
                </a>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <!-- <span class="label label-danger">9</span> -->
                </a>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=base_url('assets/dist/img/user.png');?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">SIRS Developer</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?=base_url('assets/dist/img/user.png');?>" class="img-circle" alt="User Image" />
                    <p>
                      SIRS - Web Developer
                      <small>Member since June 2015</small>
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
              <img src="<?=base_url('assets/dist/img/user.png');?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>SIRS Developer</p>

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
            <li>
              <a href="<?=base_url();?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i><span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="<?=base_url('barang');?>"><i class="fa fa-circle-o"></i> Barang</a></li>
                <li class=""><a href="<?=base_url('subbarang');?>"><i class="fa fa-circle-o"></i> Sub Barang</a></li>
                <li class=""><a href="<?=base_url('jenisbarang');?>"><i class="fa fa-circle-o"></i> Jenis Barang</a></li>
                <li class=""><a href="<?=base_url('penyedia');?>"><i class="fa fa-circle-o"></i> Penyedia</a></li>
                <li class=""><a href="<?=base_url('divisi');?>"><i class="fa fa-circle-o"></i> Divisi</a></li>
                <li class=""><a href="<?=base_url('users');?>"><i class="fa fa-circle-o"></i> User</a></li>
                <li class=""><a href="<?=base_url('');?>"><i class="fa fa-circle-o"></i> -</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-film"></i><span>Transaksi</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li class=""><a href="<?=base_url();?>#"><i class="fa fa-circle-o"></i>Masuk <i class="fa fa-angle-left pull-right"></i> </a>
                  <ul  class="treeview-menu">
                     <li class=""><a href="<?=base_url('transaksi/masuk');?>"><i class="fa fa-circle-o"></i>Transaksi</a></li>
                  
                  </ul>
                </li>
                <li class=""><a href="<?=base_url();?>#"><i class="fa fa-circle-o"></i>Keluar <i class="fa fa-angle-left pull-right"></i> </a>
                  <ul  class="treeview-menu">
                     <li class=""><a href="<?=base_url('transaksi/keluar');?>"><i class="fa fa-circle-o"></i>Data Keluar</a></li>
                     <li class=""><a href="<?=base_url('transaksi/amprah');?>"><i class="fa fa-circle-o"></i>Distibusi</a></li>
                  </ul>
                </li>
                
              </ul>
            </li>
             <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-th-list"></i><span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li class=""><a href="<?=base_url('laporan/laporan/laporan_pengadaan_detail');?>"><i class="fa fa-circle-o"></i> Laporan Pengadaan</a></li>
                <li class=""><a href="<?=base_url('laporan/laporan/laporan_pengadaan_detail2');?>"><i class="fa fa-circle-o"></i> Laporan Pengadaan Detail</a></li>
                <li class=""><a href="<?=base_url('laporan/laporan/laporan_distribusi_detail');?>"><i class="fa fa-circle-o"></i> Laporan Distribusi</a></li>
                <li class=""><a href="<?=base_url('laporan/laporan/laporan_distribusi_detail2');?>"><i class="fa fa-circle-o"></i> Laporan Distribusi Detail</a></li>
                <li class=""><a href="<?=base_url('laporan/laporan');?>"><i class="fa fa-circle-o"></i> Laporan Data Barang</a></li>
                <li class=""><a href="<?=base_url('laporan/laporan/laporan_distribusi');?>"><i class="fa fa-circle-o"></i> Laporan Distribusi</a></li>
                <li class=""><a href="<?=base_url('laporan/laporan/laporan_stok');?>"><i class="fa fa-circle-o"></i> Laporan Stok Persediaan</a></li>
                
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-random"></i><span>Lain - lain</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="<?=base_url();?>#"><i class="fa fa-circle-o"></i> Tambah Disini</a></li>
                <li class=""><a href="<?=base_url();?>#"><i class="fa fa-circle-o"></i> Laporan Mingguan</a></li>
              </ul>
            </li>
            <li>
              <a href="<?=base_url();?>users/blank_page">
                <i class="fa fa-pagelines"></i> <span>Blank Page</span>
              </a>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
       <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
          <h1><?=$title;?>  &nbsp; <small><?=$subtitle;?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>"> Home</a></li>
            <li><a href=""> Master</a></li>
            <li class="active"><?=$title;?></li>
          </ol> 
        </section> 
        <!-- Main content -->

        <section class="content">

          <!-- Info boxes -->
            <!-- <div class="callout callout-info">
              <h4>Tip!</h4><p></p>
            </div> -->

