<?php
include('../../pages/conexion.php');
include('negocio.php');


$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$pedido= $_POST['pedido'];
$repartidor= $_POST['repartidor'];

//actualizarestadopedido
$obj->actualizarpedporentregar($pedido);
//agregarpedidorepartidor
$obj->asignarpedidorepartidor($pedido,$repartidor);