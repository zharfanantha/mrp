<?php
    include '../../connect.php';
?>

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
    <?php
    $idAdm = $_GET['id_admin'];
    $query = "SELECT * FROM admin WHERE id_admin='".$idAdm."'";
    $sql = mysql_query($query);
    $data = mysql_fetch_assoc($sql);


    if(isset($_POST['username'])){
        $uname = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['pass'];
        $input = "UPDATE admin SET username='".$uname."', email='".$email."', password='".$pwd."' WHERE id_admin='".$idAdm."'";
        mysql_query($input) or die (mysql_error());
        // echo $input;
        header("refresh:0; url=/rekomendasi/admin/tables/dataAdm.php");
        echo "<script type='text/javascript'>alert('Update Data Berhasil !')</script>";
    }
    ?>
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
                            <a class="nav-link" href="#">
                                <!-- <i class="fa fa-dashboard"></i> -->
                                <img src="../images/icons/1.png" alt="">
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" data-toggle="collapse" href="#collapseData" aria-expanded="false" aria-controls="collapseData">
                                <!-- <i class="fa fa-address-book"></i> -->
                                <img src="../images/icons/5.png" alt="">
                                <span class="menu-title">Data<i class="fa fa-sort-down"></i></span>
                            </a>
                            <div class="collapse" id="collapseData">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="../tables/dataobj.php">
                                            Data Objek Wisata
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../tables/dataAdm.php">
                                            Data Admin
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#collapseFuzzy" aria-expanded="false" aria-controls="collapseFuzzy">
                                <!-- <i class="fa fa-address-book"></i> -->
                                <img src="../images/icons/5.png" alt="">
                                <span class="menu-title">Fuzzy<i class="fa fa-sort-down"></i></span>
                            </a>
                            <div class="collapse" id="collapseFuzzy">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="dataobj.php">
                                            Data Objek Wisata
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="register.php">
                                            Register
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.php">
                                      Login
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="not-found.php">
                                      404
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="error.php">
                                      500
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#collapseRekomendasi" aria-expanded="false" aria-controls="collapseRekomendasi">
                                <!-- <i class="fa fa-address-book"></i> -->
                                <img src="../images/icons/5.png" alt="">
                                <span class="menu-title">Rekomendasi<i class="fa fa-sort-down"></i></span>
                            </a>
                            <div class="collapse" id="collapseRekomendasi">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="dataobj.php">
                                            Data Objek Wisata
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="register.php">
                                            Register
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.php">
                                      Login
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="not-found.php">
                                      404
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="error.php">
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
                    <h3 class="text-primary mb-4">Update Data Objek Wisata Malang Raya</h3>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-block">
                                    <form class="form-horizontal" action=" " method="post">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="username">Username :</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" value="<?php echo $data['username'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="email">E-mail :</label>
                                          <div class="col-sm-10">          
                                            <input type="email" class="form-control" id="email" placeholder="Masukkan Email" name="email" value="<?php echo $data['email'] ?>" required>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="pass">Password :</label>
                                          <div class="col-sm-10">          
                                            <input type="text" class="form-control" id="pass" placeholder="Masukkan Password Baru" name="pass" value="<?php echo $data['password'] ?>" required>
                                          </div>
                                        </div>
                                        <div class="form-group">        
                                          <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="update" value="update" class="btn btn-default">Update</button>
                                          </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="float-right">
                          <a href="#">Star Admin</a> &copy; 2017 | Edited By Zharfan Abshar Anantha
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
    <script src="../js/jquery.js"></script>
</body>

</html>