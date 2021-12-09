<?php
include('../../pages/conexion.php');
include('negocio.php');


$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$pedido= $_POST['pedido'];
$comentario= $_POST['comentario'];
$estado= $_POST['estado'];

//actualizarestadopedido
$obj->finalizarpedido($pedido,$comentario,$estado);