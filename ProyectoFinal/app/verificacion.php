<?php
include('conexion.php');

session_start();
$usuario = $_SESSION["rusuario"];
$tokenorin= $_SESSION["rtoken"];

$contraseña=$_POST['contraseña'];
$token=$_POST['token'];

if($tokenorin==$token){
    $pass_fuerte=password_hash($contraseña,PASSWORD_DEFAULT);
    $queryupdate="UPDATE usuario SET contraseña='$pass_fuerte' WHERE dni='$usuario'";
    if (mysqli_query($conexion, $queryupdate)) {
        include("recuperacion.html");
        echo '<div id="modalbig" class="modal__big">
        <div class="modal__error">
            <div class="btn_div">
                <a onclick="ocultar()" class="btn__cerrar">X</a>
            </div>
            <h1 class="h1__error">CONTRASEÑA ACTUALIZADA</h1>
            <h3 class="h3__error">Ya puede iniciar sesion en la app.</h3>
        </div>
        </div>';
    }
}else {
    include("recuperacion.html");
    echo '<div id="modalbig" class="modal__big">
    <div class="modal__error">
        <div class="btn_div">
            <a onclick="ocultar()" class="btn__cerrar">X</a>
        </div>
        <h1 class="h1__error">Usuario Incorrecto</h1>
        <h3 class="h3__error">Por favor, verifica tu correo ingresado.</h3>
    </div>
    </div>';
}
?>