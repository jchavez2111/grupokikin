<?php
include('../../pages/conexion.php');
include('negocio.php');


$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();
$orden= $_POST['orden'];

//actualizar estado ordenpedido
$obj->actualizarorden($orden);

//crear doc de recepcion

$queryrec = mysqli_query($conex, "SELECT IFNULL(MAX(idRecepcion),199)+1 FROM recepcionproductosrequeridos;");
$idrec= $queryrec->fetch_array(MYSQLI_NUM);
$obj->crearordenrecepcion($idrec[0]);

$productos = json_decode($_POST["json"]);
var_dump($productos->{"producto"});
foreach($productos->{"producto"} as $prod){
    //actualizar stock de productos
    $obj->actualizarProducto($prod->{"id"},$prod->{"cantidad"});
    //crear detalle de recepcion
    $obj->grabarRecepcion($idrec[0],$prod->{"id"},$prod->{"cantidad"});
    //actualizar estado de detalle de orden
    $obj->actualizarestadoorden($orden,$prod->{"id"});
}
