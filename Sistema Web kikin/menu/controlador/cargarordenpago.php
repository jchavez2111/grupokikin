<?php 
include('../../pages/conexion.php');
include('negocio.php');

function getListasRep(){
  $con=new Conexion();
  $obj = new Negocio();
  $mysqli = $con->abre();

  $min = $_POST['id1'];
  $max = $_POST['id2'];
  $ordenpedido = $obj->lisOrdenPagosFiltro($min, $max);
  $listas = "";
  foreach ($ordenpedido as $x) {
    $listas .= "<tr><td>OPR$x[0]</td><td>$x[1]</td><td>$x[2]</td><td>$x[3]</td><td><input id='txtindices' type='radio' name='ordenes' id='$x[0]' onClick='imprimiendo($x[0])' class='btn btn-outline-secondary btn-sm'></input></td></tr>";
  }
  return $listas;
}
echo getListasRep();
?>