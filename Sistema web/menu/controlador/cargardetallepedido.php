<?php 
include('../../pages/conexion.php');
include('negocio.php');

function getListasRep(){
  $con=new Conexion();
  $obj = new Negocio();
  $mysqli = $con->abre();

  $id = $_POST['id'];
  $detallepedido = $obj->listadetallepedidospendientes($id);
  $listas = "";
  foreach ($detallepedido as $x) {
    $listas .= "<tr><td>$x[0]</td><td>$x[1]</td><td>$x[2]</td></tr>";
  }
  return $listas;
}
echo getListasRep();
?>