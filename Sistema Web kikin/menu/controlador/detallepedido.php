<?php
include('../../pages/conexion.php');
include('negocio.php');


$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$idmesa= $_POST['mesa'];
$productos = json_decode($_POST["json"]);
var_dump($productos->{"producto"});



$queryrec = mysqli_query($conex, "SELECT IFNULL(MAX(idPedido),0)+1 FROM pedido;");
$idped= $queryrec->fetch_array(MYSQLI_NUM);

$obj->actualizarMesa($idmesa);
$obj->crearnuevopedido($idped[0],$idmesa);


foreach($productos->{"producto"} as $prod){
    $obj->disminuirCantPlatos($prod->{"id"},$prod->{"cantidad"});
    $obj->grabardetallepedido($idped[0], $prod->{"id"},$prod->{"cantidad"},$prod->{"precio"});
}
