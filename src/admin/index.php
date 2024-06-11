<?php
session_start();
include '../php/db_connection.php';

if (!isset($_SESSION['admin'])) 
{
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../assets/icons/logo-tanija.png">
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style type="text/css">
       #wrapper{
        background-color: #00880d;
       }
   </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0; background : #00880d">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse" >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="background:#00880d "><img src="../assets/icons/logo-tanija.png" alt="" style="width:50px;"> TANIJA</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">&nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation" >
            <div class="sidebar-collapse" >
                <ul class="nav" id="main-menu">
				<li class="text-center" style="background : #F63724; margin-top: 25px" >
					</li>
                    <li><a href="index.php"><i class="fas fa-home"></i></i>Home</a></li>
                    <li><a href="index.php?halaman=produk"><i class="fas fa-shopping-bag"></i></i>Produk</a></li>
                    <li><a href="index.php?halaman=artikel"><i class="fas fa-shopping-bag"></i></i>artikel</a></li>
                    <li><a href="index.php?halaman=logout"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                   </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php
if (isset($_GET['halaman'])) {
    if ($_GET['halaman'] == "produk") {
        include 'produk.php';
    }
    elseif ($_GET['halaman'] == "pelanggan") {
        include 'pelanggan.php';
    }
    elseif ($_GET['halaman'] == "detail") {
        include 'detail.php';
    }
    elseif ($_GET['halaman'] == "tambahproduk") {
        include 'tambahproduk.php';
    }
    elseif ($_GET['halaman'] == "hapusproduk") {
        include 'hapusproduk.php';
    }
    elseif ($_GET['halaman'] == "ubahproduk") {
        include 'ubahproduk.php';
    }
    elseif ($_GET['halaman'] == "logout") {
        include 'logout.php';
    }
    elseif ($_GET['halaman'] == "tambahpelanggan") {
        include 'tambahpelanggan.php';
    }
    elseif ($_GET['halaman'] == "artikel") {
        include 'artikel.php';
    }
    elseif ($_GET['halaman'] == "tambahartikel") {
        include 'tambah_artikel.php';
    }
    elseif ($_GET['halaman'] == "hapusartikel") {
        include 'hapus_artikel.php';
    }
    elseif ($_GET['halaman'] == "ubahartikel") {
        include 'ubah-artikel.php';
    }
    elseif ($_GET['halaman'] == "hapuspelanggan") {
        include 'hapuspelanggan.php';
    }
}
else {
    include 'home.php';
}
?>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
