<?php
include('../pages/conexion.php');

$nombre=$_POST['nombre'];
$correo=$_POST['correo'];
$contraseña=$_POST['contraseña'];
$celular=$_POST['celular'];
$dni=$_POST['dni'];

$queryrec = mysqli_query($conex, "SELECT IFNULL(MAX(idComensal),99)+1 FROM comensal");
$idc= $queryrec->fetch_array(MYSQLI_NUM);

$pass_fuerte=password_hash($contraseña,PASSWORD_DEFAULT);
$consulta="INSERT INTO COMENSAL values ('$idc[0]','$nombre',NULL,'$correo','$celular','$dni','$pass_fuerte','Aplicacion')";
if (mysqli_query($conex, $consulta)) {
    echo "OK";
}else{
    echo "ERROR";
}
?>