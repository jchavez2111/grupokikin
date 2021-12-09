<?php
require('fpdf.php');
require('../../pages/conexion.php');

$consulta = "SELECT MAX(idordendepedidoProdR) as columna FROM `ordenpedidoproductorequeridos`;";
$resultado = mysqli_query($conex, $consulta);
while ($mostrar = mysqli_fetch_array($resultado)) {
    $id = $mostrar['columna'];
}

$id=$_GET["valor"];

$consulta = "SELECT D.idProductos as Producto,P.nombre as Nombre,P.descripcion as Descripcion,D.cantidad as Cantidad,L.fechacreacion as Fecha 
FROM ordenpedidoproductorequeridos L, detalleordenprodrequeridos D, inventario P
WHERE L.idOrdendePedidoProdR=D.idOrdenPedidoProdR AND D.idproductos= P.idproductos AND L.idOrdendePedidoProdR='$id'";

$resultado = $conex->query($consulta);

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
{
    $id=$_GET["valor"];
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(85);
    // Título
    $var1="Orden Productos Requeridos N° $id";

    $this->Cell(110,10,utf8_decode($var1),0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(33,10,'Producto',1,0,'C',0);
    $this->Cell(80,10,'Nombre',1,0,'C',0);
    $this->Cell(110,10,'Descripcion',1,0,'C',0);
    $this->Cell(25,10,'Cantidad',1,0,'C',0);
    $this->Cell(35,10,'Fecha',1,1,'C',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage("L");
$pdf->SetFont('Arial','',10);

while($row=$resultado->fetch_assoc()){
    $pdf->Cell(33,10,$row['Producto'],1,0,'C',0);
    $pdf->Cell(80,10,$row['Nombre'],1,0,'C',0);
    $pdf->Cell(110,10,$row['Descripcion'],1,0,'C',0);
    $pdf->Cell(25,10,$row['Cantidad'],1,0,'C',0);
    $pdf->Cell(35,10,$row['Fecha'],1,1,'C',0);
}

$pdf->Output();
