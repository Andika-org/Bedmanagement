<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>RSHM Cibarusah</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
	
	<link rel="shortcut icon" href="<?php echo base_url();?>./assets/images/rumahsakit2.png">
		
    <link href="<?php echo base_url()?>assets/adminltenew/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url()?>assets/adminltenew/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url()?>assets/adminltenew/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url()?>assets/adminltenew/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url()?>assets/adminltenew/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url()?>assets/adminltenew/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url("Controllogin/hakadmin"); ?>" class="logo" style="background:white;">
			<img src="<?php echo base_url()?>./assets/images/rshmd.png" width="200px" height="40px">
		</a>
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
              
              <!-- Notifications: style can be found in dropdown.less -->
             
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="kliklogout">
                  <img src="<?php echo base_url()?>assets/images/user.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $this->session->userdata["USER_ID"]; ?></span>
                </a>
                <ul class="dropdown-menu" id="logout">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url()?>assets/images/user.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $this->session->userdata["USER_ID"]; ?> - <?php echo $this->session->userdata["BAGIAN"]; ?>
                     
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat" id="cancellogout">Cancel</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url("Controllogin") ?>" class="btn btn-default btn-flat">Sign out</a>
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
              <img src="<?php echo base_url()?>assets/images/user.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata["USER_ID"]; ?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
			
			<center>
			
          </div>
         <ul class="sidebar-menu">
				<li>
					<b style="color:white;padding-left:12px;"><?php echo date('d F Y '); ?>
					
					<b id="tempatjam" style="color:white;padding-left:5px;"></b>
					</b>
				</li> 
			</ul>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"><b>DATA RUANGAN RSHM</b></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-home"></i> <span>DATA RUANGAN</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("Controlruang"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Ruangan</a></li>
              </ul>
            </li>
			
			<li class="header"><b>DATA BED RSHM</b></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bed"></i> <span>DATA BED</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<!--<li><a href="<?php echo base_url("Controlbed"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed</a></li>-->
				<li><a href="<?php echo base_url("Controlbed/indextester"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Akumulasi Bed Manajemen</a></li>
				<li><a href="<?php echo base_url("Controlbed/bedkosong"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed Kosong <span class="label label-success pull-right"><?php echo $datakosong['Kosong']?></span></a></li>
				<li><a href="<?php echo base_url("Controlbed/beddibersihkan"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed Dibersihkan <span class="label label-warning pull-right"><?php echo $datadibersihkan['Dibersihkan']?></span></a></li>
				<li><a href="<?php echo base_url("Controlbed/bedterisi"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed Terisi <span class="label label-danger pull-right"><?php echo $dataterisi['Isi']?></span></a></li>
				<li><a href="<?php echo base_url("Controlbed/bedtidakaktif"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed Tidak Aktif <span class="label label-primary pull-right"><?php echo $datatidakaktif['Tidakaktif']?></span></a></li>
				<li><a href="<?php echo base_url("Controlbed/bedboking"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed Diboking <span class="label label-info pull-right"><?php echo $databooking['Booking']?></span></a></li>
                <!--<li><a href="<?php echo base_url("Controlruang"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed Kosong <span class="label label-success pull-right"> <?php echo $datakosong['Kosong']?></span></a></li>
                <li><a href="<?php echo base_url("Controlruang"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed Dibersihkan <span class="label label-warning pull-right"> <?php echo $datadibersihkan['Dibersihkan']?></span></a></li>
                <li><a href="<?php echo base_url("Controlruang"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed Terisi <span class="label label-primary pull-right"> <?php echo $dataterisi['Isi']?></span></a></li>
                <li><a href="<?php echo base_url("Controlruang"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Bed Tidak Aktif <span class="label label-danger pull-right"> <?php echo $datatidakaktif['Tidakaktif']?></span></a></li>
				-->
			  
			  </ul>
            </li>
			
			<li class="header"><b>DATA PASIEN RANAP RSHM</b></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>DATA PASIEN</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo base_url("Controlbed/pasien"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Pasien Rawat Inap</a></li>
				<li><a href="<?php echo base_url("Controlbed/jumlahpasienpertanggal"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Jumlah Pasien Rawat Inap</a></li>
			  </ul>
            </li>
			
			<li class="header"><b>DATA BOR RANAP RSHM</b></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>DATA BOR</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo base_url("Controlbor/overall"); ?>"><i class="glyphicon glyphicon-hand-right"></i> BOR Over ALL</a></li>
				<li><a href="<?php echo base_url("Controlbor"); ?>"><i class="glyphicon glyphicon-hand-right"></i> BOR Per Kelas</a></li>
				<li><a href="<?php echo base_url("Controlbor/kumulatif"); ?>"><i class="glyphicon glyphicon-hand-right"></i> BOR Kumulatif</a></li>
				<li><a href="<?php echo base_url("Controlbor/borgrafik"); ?>"><i class="glyphicon glyphicon-hand-right"></i> BOR Grafik</a></li>
			</ul>
            </li>
			
			<li class="header"><b>DATA KEBERSIHAN BED RSHM</b></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tags"></i> <span>BED DIBERSIHKAN</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li><a href="<?php echo base_url("Controlbed/laporanbed"); ?>"><i class="glyphicon glyphicon-hand-right"></i> Laporan Bed</a></li>
			</ul>
            </li>
			
			
		<li class="header"><b></b></li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" style="background:white;">
     

        <!-- Main content -->
        <section class="content">
      <!-- Right side column. Contains the navbar and content of the page -->

	
    <!-- jQuery 2.1.3 -->
	
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-3.3.7-dist-1/bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url()?>assets/adminltenew/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url()?>assets/adminltenew/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>assets/adminltenew/dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url()?>assets/adminltenew/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url()?>assets/adminltenew/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/adminltenew/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url()?>assets/adminltenew/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url()?>assets/adminltenew/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url()?>assets/adminltenew/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url()?>assets/adminltenew/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url()?>assets/adminltenew/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url()?>assets/adminltenew/dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url()?>assets/adminltenew/dist/js/demo.js" type="text/javascript"></script>
	
	<script language="JavaScript">
function tampilkanjam()
{
var waktu = new Date();
var jam = waktu.getHours();
var menit = waktu.getMinutes();
var detik = waktu.getSeconds();
var teksjam = new String();

if ( menit <= 9 )
menit = "0" + menit;
if ( detik <= 9 )
detik = "0" + detik;

teksjam = jam + " : " + menit + " : " + detik;
tempatjam.innerHTML = teksjam;
setTimeout ("tampilkanjam()",1000);
}
window.onload = tampilkanjam
</script>
<script>
$(document).ready(function(){

    $("#datatable").click(function(){
        $("#filedatatable").slideToggle();

    });
//////////////////////////////////
 $("#hutang").click(function(){
        $("#filehutang").slideToggle();

    });
//////////////////////////////////
 $("#laporanpenjualan").click(function(){
        $("#filelaporanpenjualan").slideToggle();

    });
//////////////////////////////////
 $("#transaksi").click(function(){
        $("#filetransaksi").slideToggle();

    });
//////////////////////////////////
 $("#retur").click(function(){
        $("#fileretur").slideToggle();

    });
//////////////////////////////////
 $("#stokopname").click(function(){
        $("#filestokopname").slideToggle();

    });
//////////////////////////////////
 $("#datauser").click(function(){
        $("#fileuser").slideToggle();

    })

/////////////////////////////////////   
 $("#kliklogout").click(function(){
        $("#logout").slideDown();

    });
   $("#cancellogout").click(function(){
        $("#logout").slideUp();
   });
////////////////////////////////////
});
</script>
  </body>
</html>