<?php
include('../../pages/conexion.php');
include('negocio.php');


$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();
$idplato= $_POST['idplato'];
$cant= $_POST['cantidadplato'];
$productos = json_decode($_POST["json"]);

$obj->actualizarStockPlato($idplato, $cant);
$obj->actualizarPlato($idplato);

$productos = json_decode($_POST["json"]);
var_dump($productos->{"producto"});

foreach($productos->{"producto"} as $prod){
    $obj->disminuirInventario($prod->{"id"},$prod->{"cantidad"});
    $obj->grabardetalleIngredientes($idplato, $prod->{"id"},$prod->{"cantidad"});
}

