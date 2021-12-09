<?php
include('../../pages/conexion.php');
include('negocio.php');


$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$pedido= $_POST['pedido'];
$ayudante= $_POST['ayudante'];

//actualizarestadopedido
$obj->actualizarpedpreparacion($pedido);
//agregarpedidoaayudante
$obj->asignarpedidoayudante($pedido,$ayudante);