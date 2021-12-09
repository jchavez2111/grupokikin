<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Asignar Mozo</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/paginasec.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/ico.png">
    <link rel="stylesheet" href="../css/accordionmodal.css">
    <link rel="stylesheet" href="../js/alerts/snap.css">
    <link rel="stylesheet" href="../css/estilosmodaltodos.css">
</head>


<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="../index.php"><img src="../assets/images/logokikin.png" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="../index.php"><img src="../assets/images/ico.png" alt="logo" /></a>
            </div>
            <ul class="nav">

                <!-- CÓDIGO PHP -->
                <?php
                include('../../pages/conexion.php');
                session_start();
                if (!isset($_SESSION['lusuario'])) {
                    header("Location:../../index.html");
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
                            <a href="<?php echo $mostrar['columna2'] ?>.php" class="nav-link">
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
                                    <img class="img-xs rounded-circle" src="../../img/usuarios/<?php echo $usuario ?>.png" alt="">
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
                                <a href="../../pages/cierra_sesion.php" class="dropdown-item preview-item">
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
                <!--cuerpo Ordenado-->
                <div class="content-wrapper">
                    <div class="row">
                        <!-- primera cabecera -->
                        <!-- Codigo Fechas y filtros -->
                        <?php
                        date_default_timezone_set('UTC');
                        date_default_timezone_set("America/Bogota");

                        // VALORES INICIALES DE LA PÁGINA
                        include_once '../controlador/negocio.php';
                        $obj = new Negocio();

                        // VALORES PARA EL FILTRO
                        $lisPedidos = $obj->listapedidospreparacion();
                        $lisAyudantes = $obj->listamozos();   
                        ?>
                        <!-- Tabla de Productos y Envases ( Acordion) -->

                        <!-- Lista de productos requeridos -->
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Tabla de Envases  -->
                                    <div class="card">
                                        <div class="card-body">
                                            <center>
                                                <h4 class="card-title">Asignar Pedidos a Mozo</h4>
                                                <center>

                                                

                                                    <button class="accordion btn-block btn-lg btn-primary">Pedidos en Preparacion</button>
                                                    <div class="card panel">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nº</th>
                                                                            <th>Tipo de Entrega</th>
                                                                            <th>Nº Mesa</th>
                                                                            <th>Ayudante de Cocina</th>
                                                                            <th>Hora Ingreso</th>
                                                                            <th>Seleccionar</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tabla_pedidos">
                                                                        <?php
                                                                        foreach ($lisPedidos as $x) {
                                                                            echo "<tr><td>100$x[0]</td>";
                                                                            if($x[1]==1){
                                                                                echo "<td>Local</td>";
                                                                            }else{
                                                                                echo "<td>Delivery</td>";
                                                                            }
                                                                            echo "<td>$x[2]</td><td>$x[3]</td><td>$x[4]</td><td><div class='form-check form-check-muted m-0'><input id='pedido$x[0]' type='radio' name='optpedidos' Onclick='pedido($x[0])' class='form-check-input'>Seleccionar</div></td></tr>";
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div><br><br>

                                                    

                                                    <center>
                                                        <h4 class="card-title">Mozos</h4>
                                                    </center><br>
                                                    <div class="table-responsive">
                                                        <table class="table table">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Platos Encargados</th>
                                                                    <th>Nombre</th>
                                                                    <th>Seleccionar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tabla_ayudantes">
                                                                        <?php
                                                                        foreach ($lisAyudantes as $x) {

                                                                            echo "<tr><td>$x[0]</td><td>$x[1] platos</td><td>$x[2]</td><td><div class='form-check form-check-muted m-0'><input id='mozo$x[0]' type='radio' name='optdayuntes' Onclick='ayudante($x[0])' class='form-check-input'>Seleccionar</div></td></tr>";
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                        </table>
                                                        <br>
                                                        <center><button id="guardartodo" Onclick="presionbuttontres()" class="btn btn-lg btn-primary btn-icon-text centrar">Asignar Pedido
                                                            </button></center>
                                                        <br>
                                                    </div>
                                        </div>
                                    </div>

                                    <!-- botones -->
                                    <div class="template-demo d-flex justify-content-between flex-nowrap">
                                        <a href="../index.php" type="button" class="btn btn-lg btn-danger btn-icon-text">
                                            <i class="mdi mdi-exit-to-app btn-icon-prepend"></i> Salir </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal-containerconfi" id="modal_containerconfi">
        <div class="modalconfi">
            <img src="../../img/imagen.gif" class="img-modalconfi">
            <h1 class="whitemodal">¿Desea Asignar el Pedido al Mozo?</h1>
            <p class="whitemodal">
                Su pedido se asignará luego de dar click en el botón aceptar
            </p>
            <button class="btn btn-lg btn-primary btn-icon-text centrar" onclick="cerraryguardar()">
                Aceptar
            </button>
            <button class="btn btn-lg btn-danger btn-icon-text" onclick="cerrar()">
                Cancelar
            </button>
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
    <script src="../js/jquery-3.4.0.min.js"></script>
    <script src="../js/214.js"></script>
    <script src="../js/accordionmodal.js"></script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tabla_orden tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            
        });
    </script>
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>