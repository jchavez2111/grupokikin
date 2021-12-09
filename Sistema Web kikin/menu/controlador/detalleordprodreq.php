<?php 
include('../../pages/conexion.php');
include('negocio.php');


function getListasRep(){
  $con=new Conexion();
  $obj = new Negocio();
  $mysqli = $con->abre();

  $date=date("Y-m-d");
  $max=strtotime($date."+ 1 years");
  $max2=date("Y-m-d",$max);


  $orden = $_REQUEST['idOrden'];
  
  $productos = $obj->lisdetordprodreq($orden);
  $listas = "";
  foreach ($productos as $x) {
    $listas .= "<tr>
    
     <td>$x[0]</td><td>$x[1]</td>
     <td>$x[2]</td>
     <td>
     <div class='form-check form-check-muted m-0'>
     <input id='fechav' type='date' class='form-check-input' id='fechavenc' min='$date' max='$max2'>
    </div>
      </td>
     <td>$x[3]</td>    
     <td>
     <div class='form-check form-check-muted m-0'>
     <input id='txtindices' type='checkbox' class='form-check-input' id='checkRecibox'>
   </div>
      </td>
    </tr>";
  }
  return $listas;
}

echo getListasRep();
?>