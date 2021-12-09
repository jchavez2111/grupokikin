<?php
include('conexion.php');

session_start();
$usuario = $_SESSION["rusuario"];
$tokenorin= $_SESSION["rtoken"];

$contraseña=$_POST['password2'];
$token=$_POST['token'];

if($tokenorin==$token){
    $pass_fuerte=password_hash($contraseña,PASSWORD_DEFAULT);
    $queryupdate="UPDATE colaborador SET contraseñaColaborador='$pass_fuerte' WHERE idColaborador='$usuario'";
    if (mysqli_query($conex, $queryupdate)) {
        header("Location: ../index.html");
    }
}else {
    include("recuperacion.html");
    echo '<div id="modalbig" class="modal__big">
            <div class="modal__error">
                <div class="btn_div">
                    <a onclick="ocultar()" class="btn__cerrar">X</a>
                </div>
                <h1 class="h1__error">Datos incorrectos</h1>
                <h3 class="h3__error">Por favor, inténtelo otra vez.</h3>
            </div>
            </div>';
}
?>