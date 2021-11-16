<?php
  session_start();
  if( !isset($_SESSION['login'])  ){
    header('Location: index.php');
    exit;
  }
?>

<?php

  //include koneksi
  include "koneksi.php";

  $sql = mysqli_query($konek, "SELECT * FROM tb_kontrol");
  $data = mysqli_fetch_array($sql);
  // ambil status fan
  $fan = $data['fan'];
  // ambil status pompa
  $pompa = $data['pompa'];
   
?>

<?php

  //include koneksi
  include "koneksi.php";

  $sql = mysqli_query($konek, "SELECT api FROM tb_api");
  $data = mysqli_fetch_array($sql);
  // ambil status api
  $api = $data['api'];
   
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="img/logo.png">
    <title>Fire Detection - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


        <!-- Panggil Data Grafik -->
    <script type="text/javascript">
      var refreshid = setInterval(function(){
        $('#myGrafik').load('chart.php');
      }, 3000);
    </script>

    <!-- Nilai Realtime -->
            <script type="text/javascript">
          $(document).ready( function() {

              setInterval( function() {
                $("#cekgas").load('cekgas.php');
                $("#cekapi").load('cekapi.php');
              }, 1000 );

          } ); //Akhir Nilai Realtime
          </script>

        <script type="text/javascript">
            function ubahfan(value) 
          {
            if (value==true) value="ON";
            else value="OFF";
            document.getElementById('status').innerHTML = value;

            //ajax untuk merubah status relay
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function()
            {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200 )
              {
                //ambil respon dari web
                document.getElementById('status').innerHTML = xmlhttp.responseText;
              }
            }
            //eksekusi file PHP untuk merubah nilai database
            xmlhttp.open("GET", "fan.php?stat=" + value, true);
            //kirim data
            xmlhttp.send();
          }

            //Relay Water Pump
            function ubahpompa(value) 
          {
            if (value==true) value="ON";
            else value="OFF";
            document.getElementById('kondisi').innerHTML = value;

            //ajax untuk merubah status relay
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function()
            {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200 )
              {
                //ambil respon dari web
                document.getElementById('kondisi').innerHTML = xmlhttp.responseText;
              }
            }
            //eksekusi file PHP untuk merubah nilai database
            xmlhttp.open("GET", "pompa.php?kondis=" + value, true);
            //kirim data
            xmlhttp.send();
          }
        </script>

           <!-- Panggil Data Grafik -->
    <script type="text/javascript">
      var refreshid = setInterval(function(){
        $('#myGrafik').load('chart.php');
      }, 1000);
    </script>


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <style>
.form-check {
    display: flex;
    align-items: center;
}
.form-check label {
    margin-left: 30px;
    font-size: 25px;
    font-weight: 500;
}
.form-check .form-check-input[type=checkbox] {
    border-radius: .25em;
    height: 35px;
    width: 35px;
} 
</style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fire-extinguisher"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Fire Detection<sup> IoT</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                    </a>
            </li>

            

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Gas Card-->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-warning text-uppercase mb-1">
                                                Gas</div>
                                            <div id="cekgas" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bacon fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                        <!-- Fire Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-danger text-uppercase mb-1">
                                                Fire</div>
                                            <div id="cekapi" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fab fa-hotjar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fan Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-success text-uppercase mb-1">Fan
                                            </div>
                                            <div class="form-check" style="font-size: medium;">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" onchange="ubahfan(this.checked)" <?php if($fan==0) echo "checked";?>>
                                            <label class="form-check-label text-success" for="exampleCheck1" style="font-weight: bold;" id="status"><?php if($fan==0) echo "ON"; else echo "OFF"; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fan fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Water Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-info text-uppercase mb-1"> Water</div>
                                            <div class="form-check" style="font-size: medium;">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" onchange="ubahpompa(this.checked)" <?php if($pompa==0) echo "checked";?>>
                                            <label class="form-check-label text-success" for="exampleCheck1" style="font-weight: bold;" id="kondisi"><?php if($pompa==0) echo "ON"; else echo "OFF"; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-water fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Gas Overview</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="myGrafik" style="width: 95%;">
                                    <figure class="highcharts-figure">
                                        <div id="myGrafik"></div>
                                    </figure>
                                </div>
                            </div>
                            </div>
                    
                        

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>