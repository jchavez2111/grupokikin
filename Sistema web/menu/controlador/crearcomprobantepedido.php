<?php
include('../../pages/conexion.php');
include('negocio.php');

$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$pedido = $_POST['pedido'];

$obj->actualizarPedidoPagadoMozo($pedido);
$subtotal="";
$igv="";
$total="";

$preciototal = $obj->imprimirprecio($pedido);
foreach ($preciototal as $x) {
    $subtotal=$x[0];
    $igv=$x[0]*0.18;
    $total=$x[0]+$igv;
    $comensal=$x[1];
}

$queryrec = mysqli_query($conex, "SELECT IFNULL(MAX(idComprobantedePago),0)+1 FROM comprobantedepago");
$idc= $queryrec->fetch_array(MYSQLI_NUM);

$obj->insertarComprobantePedido($idc[0],$pedido,$comensal,$subtotal,$igv,$total);

$queryrecc = mysqli_query($conex, "SELECT idmesa FROM PEDIDO WHERE idPedido=$pedido");
$idcc= $queryrecc->fetch_array(MYSQLI_NUM);
$obj->actualizarvueltamesa($idcc[0]);

