<?php
$conex=mysqli_connect("localhost","root","","restaurantebd");
class Conexion{
  private $cn=null;
  function abre(){
     if($this->cn==null)
      $this->cn= mysqli_connect ("localhost","root","","restaurantebd");
         return $this->cn;   
  }
  function cierra(){
      mysqli_close($this->cn);     
  }
}
?>