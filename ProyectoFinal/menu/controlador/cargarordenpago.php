<?php 
include('../../pages/conexion.php');
include('negocio.php');

function getListasRep(){
  $con=new Conexion();
  $obj = new Negocio();
  $mysqli = $con->abre();

  $min = $_POST['id1'];
  $max = $_POST['id2'];
  $ordenpedido = $obj->lisOrdenFiltro($min, $max);
  $listas = "";
  foreach ($ordenpedido as $x) {
    $listas .= "<tr><td>$x[0]</td><td>$x[2]</td><td id='fila' class='text-danger'>Pendiente <i class='mdi mdi-alert-circle'></i></td><td><input id='txtindices' type='checkbox' id='$x[0]' onClick='imprimiendo($x[0])' class='btn btn-outline-secondary btn-sm'></input></td></tr>";
  }
  return $listas;
}
echo getListasRep();
?>