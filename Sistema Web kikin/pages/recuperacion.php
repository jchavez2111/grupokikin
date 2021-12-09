
<?php

include('../pages/conexion.php');

$usuarior = $_POST['usuarior'];

$queryrec = mysqli_query($conex, "Select correoColaborador from colaborador where idColaborador='$usuarior'");
$nr = mysqli_num_rows($queryrec);

if ($nr == 1) {
    $token = mt_rand(100000, 999999);
    $correo = $queryrec->fetch_array(MYSQLI_NUM);

    $mensaje = "
    <html>
    <head>
    <title></title>
    <link rel='stylesheet' href='../css/style.css'>
    </head>
    <body> 
    <h1 class='h1__form'>Código de Recuperación!</h1>
    <h3>Introduce el siguiente código para recuperar tu contraseña: '$token'</h3>
    <h3><br>Equipo de asistencia de Ki-Kin</h3>
    </body>
    </html>
    ";

    $cabeceras = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    mail($correo[0], 'CÓDIGO DE RECUPERACIÓN DE CONTRASEÑA', $mensaje, $cabeceras);
    header("Location: verifica.php");

    $correoenviar = substr($correo[0], 0, -13) . '****@****';
} else {
    $token = 0;
    include("recuperacion.html");
    echo '<div id="modalbig" class="modal__big">
            <div class="modal__error">
                <div class="btn_div">
                    <a onclick="ocultar()" class="btn__cerrar">X</a>
                </div>
                <h1 class="h1__error">Usuario Incorrecto</h1>
                <h3 class="h3__error">Por favor, inténtelo otra vez.</h3>
            </div>
            </div>';
}

session_start();
$_SESSION["rusuario"] = $usuarior;
$_SESSION["rtoken"] = $token;
$_SESSION["rcorreo"] = $correoenviar;
?>