

<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="assets/images/ico.png">
    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                    <a class="sidebar-brand brand-logo" href="index.php"><img src="assets/images/logokikin.png" alt="logo" /></a>
                    <a class="sidebar-brand brand-logo-mini" href="index.php"><img src="assets/images/ico.png" alt="logo" /></a>
                </div>
                <ul class="nav">

                    <!-- CÓDIGO PHP -->
                    <?php
                    include('../pages/conexion.php');
                    session_start();
                    if (!isset($_SESSION['lusuario'])) {
                        header("Location:../index.html");
                    }
                    $usuario = $_SESSION["lusuario"];
                    
                    $queryrec = mysqli_query($conex, "SELECT r.descripcionRol
        FROM rol=r, colaborador=c
        WHERE c.idrol=r.idrol
        AND c.idcolaborador='$usuario'");
                    $idrol = $queryrec->fetch_array(MYSQLI_NUM);
                    ?>

                    <!-- PAGINAS SEGUN ROL -->
                    <?php
                    $consulta = "SELECT o.descripcionOpcion as columna, o.codigoopcion as columna2,codigoopcion, r.estadorol as columna3
                    FROM opciones o, colaborador c, rol r
                    WHERE c.idrol=o.idrol   
                    AND o.idrol=r.idrol
                    AND o.estado=1
                    AND c.idcolaborador='$usuario'";

                    $resultado = mysqli_query($conex, $consulta);
                    while ($mostrar = mysqli_fetch_array($resultado)) {
                        ?>
                        <li class="nav-item menu-items">
                            <a href="paginas/<?php echo $mostrar['columna2'] ?>.php" class="nav-link">
                                <span class="menu-icon">
                                    <i class="mdi mdi-speedometer"></i>
                                </span>
                                <span class="menu-title">
                                    <?php
                                        echo $mostrar['columna'];
                                    ?>
                                </span>

                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <!-- Inicio
                    <!-- <li class="nav-item menu-items">
                      <a class="nav-link" href="index.html">
                        <span class="menu-icon">
                          <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                      </a>
                    </li> -->
                    <!-- Registros -->
                    <!-- <li class="nav-item menu-items">
                        <a class="nav-link" href="pages/forms/basic_elements.html">
                          <span class="menu-icon">
                            <i class="mdi mdi-playlist-play"></i>
                          </span>
                          <span class="menu-title">Registros</span>
                        </a>
                      </li> -->
                    <!-- Tablas -->
                    <!-- <li class="nav-item menu-items">
                        <a class="nav-link" href="pages/tables/basic-table.html">
                          <span class="menu-icon">
                            <i class="mdi mdi-table-large"></i>
                          </span>
                          <span class="menu-title">Tablas</span>
                        </a>
                      </li> -->
                </ul>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar p-0 fixed-top d-flex flex-row">
                    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="mdi mdi-menu"></span>
                        </button>

                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                    <div class="navbar-profile">
                                        <img class="img-xs rounded-circle" src="../img/usuarios/<?php echo $usuario ?>.png" alt="">
                                        <p class="mb-0 d-none d-sm-block navbar-profile-name">
                                            <?php echo $usuario ?><br><?php echo $idrol[0] ?>
                                        </p>

                                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                    <h6 class="p-3 mb-0">Perfil</h6>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle">
                                                <i class="mdi mdi-settings text-success"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject mb-1">Ajustes</p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="../pages/cierra_sesion.php" class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle">
                                                <i class="mdi mdi-logout text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <p id="salirra" class="preview-subject mb-1">Salir</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                            <span class="mdi mdi-format-line-spacing"></span>
                        </button>
                    </div>
                </nav>


                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-6 col-xl-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <img style="width: 78vw;
                                                 height: auto;" class="itemimagencenter" src="../img/2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Ki Kin 2021</span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="assets/vendors/chart.js/Chart.min.js"></script>
        <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
        <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
        <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/misc.js"></script>
        <script src="assets/js/settings.js"></script>
        <script src="assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="assets/js/dashboard.js"></script>
    </body>

</html>