<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin</title>
    <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
    <div class=" container-scroller">
        <!--Navbar-->
        <nav class="navbar bg-primary-gradient col-lg-12 col-12 p-0 fixed-top navbar-inverse d-flex flex-row">
            <div class="bg-white text-center navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="#"><img src="../images/logo_star_black.png" /></a>
                <a class="navbar-brand brand-logo-mini" href="#"><img src="../images/logo_star_mini.jpg" alt=""></a>
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
                        <a class="nav-link profile-pic" href="#"><img class="rounded-circle" src="../images/face.jpg" alt=""></a>
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
                    <img src="../images/face.jpg" alt="">
                    <p class="name">Richard V.Welsh</p>
                    <p class="designation">Manager</p>
                    <span class="online"></span>
                </div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">
                                <!-- <i class="fa fa-dashboard"></i> -->
                                <img src="../images/icons/1.png" alt="">
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/widgets.php">
                                <img src="../images/icons/2.png" alt="">
                                <span class="menu-title">Widgets</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/forms.php">
                                <!-- <i class="fa fa-wpforms"></i> -->
                                <img src="../images/icons/3.png" alt="">
                                <span class="menu-title">Forms</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/buttons.php">
                                <!-- <i class="fa fa-calculator"></i> -->
                                <img src="../images/icons/4.png" alt="">
                                <span class="menu-title">Buttons</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/tables.php">
                                <!-- <i class="fa fa-table"></i> -->
                                <img src="../images/icons/5.png" alt="">
                                <span class="menu-title">Tables</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="../pages/charts.php">
                                <!-- <i class="fa fa-bar-chart"></i> -->
                                <img src="../images/icons/6.png" alt="">
                                <span class="menu-title">Charts</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/icons.php">
                                <!-- <i class="fa fa-font"></i> -->
                                <img src="../images/icons/7.png" alt="">
                                <span class="menu-title">Icons</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/typography.php">
                                <!-- <i class="fa fa-bold"></i> -->
                                <img src="../images/icons/8.png" alt="">
                                <span class="menu-title">Typography</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <!-- <i class="fa fa-address-book"></i> -->
                                <img src="../images/icons/9.png" alt="">
                                <span class="menu-title">Sample Pages<i class="fa fa-sort-down"></i></span>
                            </a>
                            <div class="collapse" id="collapseExample">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="../samples/blank_page.php">
                                      Blank Page
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../samples/register.php">
                                      Register
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../samples/login.php">
                                      Login
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../samples/not-found.php">
                                      404
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../samples/error.php">
                                      500
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <!-- <i class="fa fa-bold"></i> -->
                                <img src="../images/icons/10.png" alt="">
                                <span class="menu-title">Settings</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- SIDEBAR ENDS -->

                
                <div class="content-wrapper">
                    <h3 class="text-primary mb-4">Charts</h3>
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Line chart</h5>
                                    <canvas id="lineChart" style="height:250px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Bar chart</h5>
                                    <canvas id="barChart" style="height:230px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Area chart</h5>
                                    <canvas id="areaChart" style="height:250px"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Doughnut chart</h5>
                                    <canvas id="doughnutChart" style="height:250px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="float-right">
                          <a href="#">Star Admin</a> &copy; 2017
                      </span>
                    </div>
                </footer>
            </div>
        </div>

    </div>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/tether/dist/js/tether.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="../js/chart.js"></script>
    <script src="../node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="../js/off-canvas.js"></script>
    <script src="../js/hoverable-collapse.js"></script>
    <script src="../js/misc.js"></script>
</body>

</html>