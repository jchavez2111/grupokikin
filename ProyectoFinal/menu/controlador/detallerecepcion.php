<?php 
include('../../pages/conexion.php');
include('negocio.php');


function getListasRep(){
  $con=new Conexion();
  $obj = new Negocio();
  $mysqli = $con->abre();

  $orden = $_REQUEST['idOrden'];
  
  $productos = $obj->detalleRecepcion($orden);
  $listas = "";
  foreach ($productos as $x) {
    $listas .= "<tr>
    
     <td>$x[0]</td><td>$x[1]</td>
     <td>$x[2]</td><td>$x[3]</td>";
  }
  return $listas;
}

echo getListasRep();
?>