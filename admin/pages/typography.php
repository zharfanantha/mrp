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
                        <li class="nav-item active">
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
                    <h3 class="text-primary mb-4">Typography</h3>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-block">
                                    <h5 class="card-title mb-5">Headings</h5>
                                    <h1>h1. Bootstrap heading</h1>
                                    <h2>h2. Bootstrap heading</h2>
                                    <h3>h3. Bootstrap heading</h3>
                                    <h4>h4. Bootstrap heading</h4>
                                    <h5>h5. Bootstrap heading</h5>
                                    <h6>h6. Bootstrap heading</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-block">
                                    <h5 class="card-title mb-5">Display headings</h5>
                                    <h1 class="display-1">Display 1</h1>
                                    <h1 class="display-2">Display 2</h1>
                                    <h1 class="display-3">Display 3</h1>
                                    <h1 class="display-4">Display 4</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-block">
                                    <h5 class="card-title mb-5">Lead</h5>
                                    <p class="lead">
                                        Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-block">
                                    <h5 class="card-title mb-5">Inline text elements</h5>
                                    <p>You can use the mark tag to
                                        <mark>highlight</mark> text.</p>
                                    <p>
                                        <del>This line of text is meant to be treated as deleted text.</del>
                                    </p>
                                    <p>
                                        <s>This line of text is meant to be treated as no longer accurate.</s>
                                    </p>
                                    <p>
                                        <ins>This line of text is meant to be treated as an addition to the document.</ins>
                                    </p>
                                    <p>
                                        <u>This line of text will render as underlined</u>
                                    </p>
                                    <p><small>This line of text is meant to be treated as fine print.</small></p>
                                    <p><strong>This line rendered as bold text.</strong></p>
                                    <p><em>This line rendered as italicized text.</em></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title mb-5">Text alignment</h5>
                                    <p class="text-left">Left aligned text on all viewport sizes.</p>
                                    <p class="text-center">Center aligned text on all viewport sizes.</p>
                                    <p class="text-right">Right aligned text on all viewport sizes.</p>

                                    <p class="text-sm-left">Left aligned text on viewports sized SM (small) or wider.</p>
                                    <p class="text-md-left">Left aligned text on viewports sized MD (medium) or wider.</p>
                                    <p class="text-lg-left">Left aligned text on viewports sized LG (large) or wider.</p>
                                    <p class="text-xl-left">Left aligned text on viewports sized XL (extra-large) or wider.</p>
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
    <script src="../js/off-canvas.js"></script>
    <script src="../js/hoverable-collapse.js"></script>
    <script src="../js/misc.js"></script>
</body>

</html>