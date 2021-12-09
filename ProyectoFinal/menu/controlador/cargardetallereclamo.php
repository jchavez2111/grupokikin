<?php 
include('../../pages/conexion.php');
include('negocio.php');

function getListasRep(){
  $con=new Conexion();
  $obj = new Negocio();
  $mysqli = $con->abre();

  $id = $_POST['id'];
  
  $detallepedido = $obj->detallereclamo($id);
  $listas = "";
  foreach ($detallepedido as $x) {
    $listas .= "$x[0]";
  }
  return $listas;
}
echo getListasRep();
?>