<?php
include('../../pages/conexion.php');
include('negocio.php');


$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();


$queryrec = mysqli_query($conex, "SELECT IFNULL(MAX(idOrdendePedidoProdR),99)+1 FROM ordenpedidoproductorequeridos");
$id= $queryrec->fetch_array(MYSQLI_NUM);
$obj->crearordenprodreq($id[0]);

$productos = json_decode($_POST["json"]);
var_dump($productos->{"producto"});
foreach($productos->{"producto"} as $prod){
    $obj->grabardetalleordenprodreq($id[0], $prod->{"id"},$prod->{"cantidad"});
}
