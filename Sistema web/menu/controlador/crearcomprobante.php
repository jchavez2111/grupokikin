<?php
include('../../pages/conexion.php');
include('negocio.php');

$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$ordendepago= $_POST['id'];

$obj->actualizarOrdenPago($ordendepago);

$queryrec = mysqli_query($conex, "SELECT IFNULL(MAX(idcomprobanteProdR),399)+1 FROM comprobantedepagodeproductosrequeridos");
$idc= $queryrec->fetch_array(MYSQLI_NUM);

$query = mysqli_query($conex, "SELECT idrecepcion,monto FROM ordendepagoproductosrequeridos where idordendepago=$ordendepago");
$datos= $query->fetch_array(MYSQLI_NUM);

$obj->insertarComprobante($idc[0],$ordendepago,$datos[0],$datos[1]);

echo ($idc[0]);
