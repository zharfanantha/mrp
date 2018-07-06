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
                        <li class="nav-item active">
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
                        <li class="nav-item">
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
                    <h3 class="text-primary mb-4">Widgets</h3>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <div class="clearfix">
                                        <i class="fa fa-user-o float-right icon-grey-big"></i>
                                    </div>
                                    <h4 class="card-title font-weight-normal text-success">45465</h4>
                                    <h6 class="card-subtitle mb-4">Visitors</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-success-gadient progress-slim" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <div class="clearfix">
                                        <i class="fa fa-shopping-cart float-right icon-grey-big"></i>
                                    </div>
                                    <h4 class="card-title font-weight-normal text-info">7895</h4>
                                    <h6 class="card-subtitle mb-4">Sales</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-info-gadient progress-slim" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <div class="clearfix">
                                        <i class="fa fa-arrow-circle-o-right float-right icon-grey-big"></i>
                                    </div>
                                    <h4 class="card-title font-weight-normal text-warning">1569</h4>
                                    <h6 class="card-subtitle mb-4">Orders</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning-gadient progress-slim" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <div class="clearfix">
                                        <i class="fa fa-bar-chart float-right icon-grey-big"></i>
                                    </div>
                                    <h4 class="card-title font-weight-normal text-danger">$ 63259</h4>
                                    <h6 class="card-subtitle mb-4">Revenue</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger-gadient progress-slim" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title font-weight-normal text-success">7896</h4>
                                    <p class="card-text">Visitors</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                            aria-valuemax="100">75%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title font-weight-normal text-info">5623</h4>
                                    <p class="card-text">Sales</p>
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
                                    <h4 class="card-title font-weight-normal text-warning">1236</h4>
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
                                    <h4 class="card-title font-weight-normal text-danger">$ 7832</h4>
                                    <p class="card-text">Revenue</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                            aria-valuemax="100">65%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h6 class="card-title font-weight-normal text-info">7896</h6>
                                    <h6 class="card-subtitle mb-4 text-muted">Visitors</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-info progress-slim" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h6 class="card-title font-weight-normal text-info">7523</h6>
                                    <h6 class="card-subtitle mb-4 text-muted">Sales</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-info progress-slim" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h6 class="card-title font-weight-normal text-info">6932</h6>
                                    <h6 class="card-subtitle mb-4 text-muted">Orders</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-info progress-slim" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h6 class="card-title font-weight-normal text-info">$ 54123</h6>
                                    <h6 class="card-subtitle mb-4 text-muted">Revenue</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-info progress-slim" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h6 class="card-title font-weight-normal text-info">23658</h6>
                                    <h6 class="card-subtitle mb-4 text-muted">New clients</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-info progress-slim" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-block">
                                    <h6 class="card-title font-weight-normal text-info">8965</h6>
                                    <h6 class="card-subtitle mb-4 text-muted">Comments</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-info progress-slim" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Global Sales by Top Locations</h5>
                                    <div class="row">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../images/flags/US.png">
                                                            </div>
                                                        </td>
                                                        <td>USA</td>
                                                        <td class="text-right">
                                                            2.920
                                                        </td>
                                                        <td class="text-right">
                                                            53.23%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../images/flags/DE.png">
                                                            </div>
                                                        </td>
                                                        <td>Germany</td>
                                                        <td class="text-right">
                                                            1.300
                                                        </td>
                                                        <td class="text-right">
                                                            20.43%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../images/flags/AU.png">
                                                            </div>
                                                        </td>
                                                        <td>Australia</td>
                                                        <td class="text-right">
                                                            760
                                                        </td>
                                                        <td class="text-right">
                                                            10.35%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../images/flags/GB.png">
                                                            </div>
                                                        </td>
                                                        <td>United Kingdom</td>
                                                        <td class="text-right">
                                                            690
                                                        </td>
                                                        <td class="text-right">
                                                            7.87%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../images/flags/RO.png">
                                                            </div>
                                                        </td>
                                                        <td>Romania</td>
                                                        <td class="text-right">
                                                            600
                                                        </td>
                                                        <td class="text-right">
                                                            5.94%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../images/flags/BR.png">
                                                            </div>
                                                        </td>
                                                        <td>Brasil</td>
                                                        <td class="text-right">
                                                            550
                                                        </td>
                                                        <td class="text-right">
                                                            4.34%
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                            <div id="map" style="min-height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-4">
                            <div class="card" style="min-height:395px;">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Testimonial</h5>
                                    <div class="text-center">
                                        <img src="../images/profile.jpg" class="rounded-circle" width="100" height="100" />
                                    </div>
                                    <div class="text-center mt-3">
                                        <i class="fa fa-quote-right icon-grey-big"></i>
                                    </div>
                                    <p class="font-italic text-muted mt-3">
                                        Your products, all the kits that I have downloaded from your site and worked with are sooo cool! I love the color mixtures,
                                        cards... everything. Keep up the great work!
                                    </p>
                                    <h5 class="text-center font-weight-bold txt-brand-color">Tom Swayer</h5>
                                    <h6 class="text-center text-muted">CEO/CO-FOUNDER</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-4">
                            <div class="card" style="min-height:395px;">
                                <div class="card-block">
                                    <h5 class="card-title mb-4">Employees</h5>
                                    <table class="table table-hover table-striped">
                                        <thead class="text-primary">
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Salary</th>
                                                <th>Country</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Bob Williams</td>
                                                <td>$23,566</td>
                                                <td>USA</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Mike Tyson</td>
                                                <td>$10,200</td>
                                                <td>Canada</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Tim Sebastian</td>
                                                <td>$32,190</td>
                                                <td>Netherlands</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Philip Morris</td>
                                                <td>$31,123</td>
                                                <td>Korea, South</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Minerva Hooper</td>
                                                <td>$23,789</td>
                                                <td>South Africa</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Cooper</td>
                                                <td>$27,789</td>
                                                <td>Canada</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Philip</td>
                                                <td>$13,789</td>
                                                <td>South Africa</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    <script src="../node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5NXz9eVnyJOA81wimI8WYE08kW_JMe8g&callback=initMap" async defer></script>
    <script src="../js/off-canvas.js"></script>
    <script src="../js/hoverable-collapse.js"></script>
    <script src="../js/misc.js"></script>
    <script src="../js/chart.js"></script>
    <script src="../js/maps.js"></script>
</body>

</html>