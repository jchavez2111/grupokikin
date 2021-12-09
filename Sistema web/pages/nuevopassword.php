<?php
include('conexion.php');

session_start();
$usuario=$_SESSION["lusuario"];
$contraseña=$_POST['password2'];

$pass_fuerte=password_hash($contraseña,PASSWORD_DEFAULT);
$queryupdate="UPDATE colaborador SET contraseñaColaborador='$pass_fuerte' WHERE idColaborador='$usuario'";
if (mysqli_query($conex, $queryupdate)) {
    header("Location: ../index.html");
} else {
    echo"Error: " . $queryupdate . "<br>" . mysqli_error($conex);
}

?>
