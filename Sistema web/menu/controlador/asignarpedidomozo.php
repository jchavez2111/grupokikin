<?php
include('../../pages/conexion.php');
include('negocio.php');


$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$pedido= $_POST['pedido'];
$ayudante= $_POST['mozo'];

//actualizarestadopedido
$obj->actualizarpedterminado($pedido);
//agregarpedidoaayudante
$obj->asignarpedidomozo($pedido,$ayudante);