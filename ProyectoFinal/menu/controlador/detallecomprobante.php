<?php 
include('../../pages/conexion.php');
include('negocio.php');


function getListasRep(){
  $con=new Conexion();
  $obj = new Negocio();
  $mysqli = $con->abre();

  $orden = $_REQUEST['idOrden'];
  
  $productos = $obj->detalleComprobante($orden);
  $listas = "";
  foreach ($productos as $x) {
    $listas .= "<tr>
    
     <td>$x[0]</td><td>$x[1]</td>
     <td>$x[2]</td><td>$x[3]</td>
     <td>$x[4]</td> 
     <td>
     <a href='$x[5]' target='_blank' type='button' class='btn btn-lg btn-outline-primary  btn-icon-text'  download>Descargar</a>
      </td>
    </tr>";
  }
  return $listas;
}

echo getListasRep();
?>