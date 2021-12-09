<?php
$hostname='localhost';
$database='id17567254_restaurante';
$username='id17567254_kikin';
$password='Mt7/R{dv]-G=t]FM';

$conexion=new mysqli($hostname,$username,$password,$database);
if($conexion->connect_errno){
    echo "El sitio web está experimentado problemas";
}
?>