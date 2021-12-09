<?php

class Negocio
{
    function  appLisPlatos()
    {
        $sql = "SELECT idplato,nombre,descripcion,precioU,imagen,cantidadPlatos from platos";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }
    
}
