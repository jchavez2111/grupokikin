<?php 
include('../../pages/conexion.php');
include('negocio.php');


function getListasRep(){
  $con=new Conexion();
  $obj = new Negocio();
  $mysqli = $con->abre();

  $id = $_POST['id'];
  $plato = $obj->detallecadaPlato($id);
  $listas = "";


  foreach ($plato as $x) {
    $listas .= "<tr id='tr$x[0]'><td>$x[0]</td><td>$x[1]</td><td>$x[2]</td><td>";
     if($x[3]==0){
      $listas .= "<label class='badge badge-danger'>Agotado</label>";
      }else{
        $listas .= +$x[3];
      }
    $listas.="</td><td><input id='txttab' type='number' placeholder='Cantidad' min='1'></input></td>
     <td><button id='quitarprod' class='badge badge-danger' onClick='quitar($x[0])'>Quitar</button></td>
    </tr>";
  }
  return $listas;
}
echo getListasRep();