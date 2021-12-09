<?php

include('../../pages/conexion.php');
include('negocio.php');

function getListasRep() {
    $con = new Conexion();
    $obj = new Negocio();
    $mysqli = $con->abre();

    $idPedido = $_REQUEST['idPedido'];

    $detpedido = $obj->detped($idPedido);
    $listas = "";
    foreach ($detpedido as $x) {
        $listas .= "<tr>
    
     <td>$x[0]<td>$x[1]</td>
     <td>$x[2]
    </tr>";
    }
    return $listas;
}

echo getListasRep();
?>