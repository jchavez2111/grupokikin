<?php

include('../../pages/conexion.php');
include('negocio.php');

function getListasRep() {
    $con = new Conexion();
    $obj = new Negocio();
    $mysqli = $con->abre();

    $id = $_REQUEST['id'];

    $preciototal = $obj->detallereclamonota($id);
    $listas = "";

    foreach ($preciototal as $x) {
        $listas .="<div class='col'><h4>Precio del Pedido:  S/ $x[0] </div><div class='col'> <h4>Fecha del Reclamo: $x[1]</div> <div class='col'> <h5 style='margin: auto;'>Detalle de Evaluación: </h5><br><textarea readonly id='comentario' name='comentarios' rows='2' cols='40' placeholder='Escribe sobre el reclamo'>$x[2]</textarea></div>";
    }
    return $listas;
}

echo getListasRep();
?>