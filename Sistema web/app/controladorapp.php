<?php
include_once '../pages/conexion.php';
include_once '../menu/controlador/negocioapp.php';

$con=new Conexion();
$obj = new Negocio();

$op = $_GET['op'];

switch ($op) {
    case "1": {
    //Lista de Platos
        echo json_encode($obj->appLisPlatos(), JSON_UNESCAPED_UNICODE);
        break;
    }
}