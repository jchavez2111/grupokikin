<?php
include('../../pages/conexion.php');
include('negocio.php');

$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$reclamo= $_POST['reclamo'];
$comentario= $_POST['comentario'];
$estado= $_POST['estado'];


$query = mysqli_query($conex, "SELECT IFNULL(MAX(idevaluacionreclamo),199)+1 FROM evaluacionreclamo");
$rec= $query->fetch_array(MYSQLI_NUM);

$obj->actualizarreclamo($reclamo);
$obj->evaluarreclamo($rec[0],$reclamo,$comentario,$estado);