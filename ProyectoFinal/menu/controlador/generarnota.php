<?php
include('../../pages/conexion.php');
include('negocio.php');

$con = new Conexion();
$obj = new Negocio();
$mysqli = $con->abre();

$reclamo= $_POST['reclamo'];


$queryrec = mysqli_query($conex, "SELECT IFNULL(MAX(idNotaCredito),299)+1 FROM notacredito");
$nc= $queryrec->fetch_array(MYSQLI_NUM);

$query = mysqli_query($conex, "SELECT SUM(D.Monto)
FROM reclamo R,pedido P, detallepedido D
WHERE P.idpedido=D.idPedido
AND P.idpedido=R.idpedido
AND R.idreclamo=$reclamo
group by D.idPedido;");
$monto= $query->fetch_array(MYSQLI_NUM);

$obj->insertarNota($nc[0],$reclamo,$monto[0]);
$obj->actualizarreclamo2($reclamo);