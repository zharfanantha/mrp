<?php
include '../connect.php';
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <?php
        $data_training = array();
        $data_admin = array();
        $data = mysql_query("select * from data_objek") or die (mysql_error());
        $admin = mysql_query("select * from admin") or die (mysql_error());
        while($dataobj = mysql_fetch_array($data)) {
            $data_training[] = $dataobj;
        }
        while($dataadmin = mysql_fetch_array($admin)) {
            $data_admin[] = $dataadmin;
        }
        //print_r($data_admin);
        
        $jumdat = sizeof($data_training);
    ?>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Star Admin</title>
      <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css" />
      <link rel="stylesheet" href="node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
      <link rel="stylesheet" href="css/style.css"/>
      <link rel="shortcut icon" href="images/favicon.png"/>
  </head>
  <body>
      <div class=" container-scroller">
        <!--Navbar-->
        <nav class="navbar bg-primary-gradient col-lg-12 col-12 p-0 fixed-top navbar-inverse d-flex flex-row">
            <div class="bg-white text-center navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="#"><img src="images/logo_star_black.png" /></a>
                <a class="navbar-brand brand-logo-mini" href="#"><img src="images/logo_star_mini.jpg" alt=""></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <button class="navbar-toggler navbar-toggler hidden-md-down align-self-center mr-3" type="button" data-toggle="minimize">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <form class="form-inline mt-2 mt-md-0 hidden-md-down">
                    <input class="form-control mr-sm-2 search" type="text" placeholder="Search">
                </form>
                <ul class="navbar-nav ml-lg-auto d-flex align-items-center flex-row">
                    <li class="nav-item">
                        <a class="nav-link profile-pic" href="#"><img class="rounded-circle" src="images/face.jpg" alt=""></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-th"></i></a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right hidden-lg-up align-self-center" type="button" data-toggle="offcanvas">
                  <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <!--End navbar-->
        <div class="container-fluid">
            <div class="row row-offcanvas row-offcanvas-right">
                <nav class="bg-white sidebar sidebar-fixed sidebar-offcanvas" id="sidebar">
                <div class="user-info">
                    <img src="images/face.jpg" alt="">
                    <p class="name">Richard V.Welsh</p>
                    <p class="designation">Manager</p>
                    <span class="online"></span>
                </div>
                    <ul class="nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <!-- <i class="fa fa-dashboard"></i> -->
                                <img src="images/icons/1.png" alt="">
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#collapseData" aria-expanded="false" aria-controls="collapseExample">
                                <!-- <i class="fa fa-address-book"></i> -->
                                <img src="images/icons/5.png" alt="">
                                <span class="menu-title">Data<i class="fa fa-sort-down"></i></span>
                            </a>
                            <div class="collapse" id="collapseData">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/dataobj.php">
                                            Data Objek Wisata
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/dataAdm.php">
                                            Data Admin
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#collapseFuzzy" aria-expanded="false" aria-controls="collapseExample">
                                <!-- <i class="fa fa-address-book"></i> -->
                                <img src="images/icons/5.png" alt="">
                                <span class="menu-title">Fuzzy<i class="fa fa-sort-down"></i></span>
                            </a>
                            <div class="collapse" id="collapseFuzzy">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/dataobj.php">
                                            Data Objek Wisata
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/register.php">
                                            Register
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/login.php">
                                      Login
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/not-found.php">
                                      404
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/error.php">
                                      500
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#collapseRekomendasi" aria-expanded="false" aria-controls="collapseExample">
                                <!-- <i class="fa fa-address-book"></i> -->
                                <img src="images/icons/5.png" alt="">
                                <span class="menu-title">Rekomendasi<i class="fa fa-sort-down"></i></span>
                            </a>
                            <div class="collapse" id="collapseRekomendasi">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/dataobj.php">
                                            Data Objek Wisata
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/register.php">
                                            Register
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/login.php">
                                      Login
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/not-found.php">
                                      404
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="tables/error.php">
                                      500
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- SIDEBAR ENDS -->
                
                <div class="content-wrapper">
                    <h3 class="text-primary mb-4">Dashboard</h3>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title font-weight-normal text-success"><?php echo $jumdat ?></h4>
                                    <p class="card-text">Data Objek Wisata Malang Raya</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                            aria-valuemax="100">100%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title font-weight-normal text-info">75632</h4>
                                    <p class="card-text ">Sales</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0"
                                            aria-valuemax="100">40%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title font-weight-normal text-warning">2156</h4>
                                    <p class="card-text">Orders</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100">25%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title font-weight-normal text-danger">$ 89623</h4>
                                    <p class="card-text">Revenue</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                            aria-valuemax="100">65%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-lg-6  mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Sales</h5>
                                    <canvas id="lineChart" style="height:250px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6  mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Customer Satisfaction</h5>
                                    <canvas id="doughnutChart" style="height:250px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Daftar Admin</h5>
                                    <table class="table">
                                        <thead class="text-primary">
                                            <tr>
                                                <th><i class="fa fa-user ml-2"></i></th>
                                                <th>Username</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i=0; $i < sizeof($data_admin); $i++) { ?>
                                            <tr>
                                                <th><img src="images/face.jpg" alt="profile" class="rounded-circle" width="40"
                                                        height="40" /></th>
                                                <td><?php echo $data_admin[$i]['username']; ?></td>
                                                <td><?php echo $data_admin[$i]['email']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title"></h5>
                                    <div id="map" style="min-height:415px;"></div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid clearfix">
                      <span class="float-right">
                        Star Admin &copy; 2017 | Edited By Zharfan Abshar Anantha
                      </span>
                    </div>
                </footer>
            </div>
        </div>

      </div>

      <script src="node_modules/jquery/dist/jquery.min.js"></script>
      <script src="node_modules/tether/dist/js/tether.min.js"></script>
      <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="node_modules/chart.js/dist/Chart.min.js"></script>
      <script src="node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5NXz9eVnyJOA81wimI8WYE08kW_JMe8g&callback=initMap" async defer></script>
      <script src="js/off-canvas.js"></script>
      <script src="js/hoverable-collapse.js"></script>
      <script src="js/misc.js"></script>
      <script src="js/chart.js"></script>
      <script src="js/maps.js"></script>
  </body>
</html>