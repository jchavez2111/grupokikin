<?php 
include('../../pages/conexion.php');

function getListasRep(){
  $con=new Conexion();
  $mysqli = $con->abre();

  $orden = $_REQUEST['id'];
  $query = "SELECT * from inventario where idproductos='$orden'";
  $result = $mysqli->query($query);
  $listas = "";
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $listas .= "<tr id='tr$row[idProductos]'><td>$row[idProductos]</td><td>$row[Nombre]</td>
     <td>$row[Descripcion]</td><td>";
     if($row['Stock']==0){
      $listas .= "<label class='badge badge-danger'>Agotado</label>";
      }else{
        $listas .= +$row['Stock'];
      }
    $listas.="</td><td><input id='txttab' type='number' placeholder='Cantidad' min='1'></input></td>
     <td><button id='quitarprod' class='badge badge-danger' onClick='quitar($row[idProductos])'>Quitar</button></td>
    </tr>";
  }
  return $listas;
}
echo getListasRep();