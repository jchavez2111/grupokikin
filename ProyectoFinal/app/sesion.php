<?php
include('../pages/conexion.php');
//$usu_correo=$_POST['correo'];
//$usu_password=$_POST['password'];
$usuario = $_POST['correo'];
$contraseña = $_POST['password'];

//$usuario=60606060;
//$contraseña="12345";


$queryusuario = mysqli_query($conex, "Select * from comensal where DNI='$usuario'");
$nr = mysqli_num_rows($queryusuario);
$buscarpass = mysqli_fetch_array($queryusuario);

if (($nr == 1) && password_verify($contraseña, $buscarpass['contraseña'])) {
    echo "CORRECTO";
}

$conex->close();
?>