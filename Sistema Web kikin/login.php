<?php

include('pages/conexion.php');

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

$queryusuario = mysqli_query($conex, "Select * from colaborador where idColaborador='$usuario'");
$nr = mysqli_num_rows($queryusuario);
$buscarpass = mysqli_fetch_array($queryusuario);


if (($nr == 1) && password_verify($contraseña, $buscarpass['contraseñaColaborador'])) {
    if ($usuario <> $contraseña) {
        header("Location: menu/index.php");
    }
}
if ($usuario == $contraseña) {
    $consulta = "Select * from colaborador where idColaborador='$usuario' and contraseñaColaborador='$contraseña'";
    $resultado = mysqli_query($conex, $consulta);
    $fila = mysqli_num_rows($resultado);
    if ($fila) {
        header("Location: pages/newpassword.html");
    } else {
        include("index.html");
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
} else {
    include("index.html");
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
$_SESSION["lusuario"] = $usuario;
$_SESSION["lpassword"] = $contraseña;
?>
