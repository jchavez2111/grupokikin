<?php

include('../../pages/conexion.php');
include('negocio.php');

function getListasRep() {
    $con = new Conexion();
    $obj = new Negocio();
    $mysqli = $con->abre();

    $idPedido = $_REQUEST['idPedido'];

    $preciototal = $obj->imprimirprecio($idPedido);
    $listas = "";

    foreach ($preciototal as $x) {
        $igv=$x[0]*0.18;
        $total=$x[0]+$igv;
        $listas .= "<center>SubTotal S/ $x[0]<br>IGV S/ $igv<br>Total  S/ $total<br></center> <br>";
    }
    return $listas;
}

echo getListasRep();
?>