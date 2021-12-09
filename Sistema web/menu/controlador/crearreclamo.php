<?php
include('../../pages/conexion.php');
include('negocio.php');

$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$ped= $_POST['pedido'];
$com= $_POST['comentario'];
$tipo= $_POST['tipo'];


$query = mysqli_query($conex, "SELECT IFNULL(MAX(idReclamo),99)+1 FROM reclamo");
$rec= $query->fetch_array(MYSQLI_NUM);

$obj->insertarreclamo($rec[0],$ped,$com,$tipo);
