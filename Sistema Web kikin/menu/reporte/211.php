<?php
require('fpdf.php');
require('../../pages/conexion.php');


$id=$_GET["valor"];

//$queryrec = mysqli_query($conex, "SELECT * FROM producto'");
//$tabla = $queryrec->fetch_array(MYSQLI_NUM);

$consulta = "SELECT D.idProductos as Producto,P.nombre as Nombre,D.cantidad as Cantidad,d.fechaVen as FechaVenc FROM recepcionproductosrequeridos L, detallerecepcionproductosrequeridos D, inventario P WHERE L.idrecepcion=D.idrecepcion AND D.idproductos= P.idproductos AND L.idrecepcion='$id'";
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
    $var="Lista de Productos Recepcionados N° $id";
    $this->Cell(110,10,utf8_decode($var),0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(25,10,'Producto',1,0,'C',0);
    $this->Cell(110,10,'Nombre',1,0,'C',0);
    $this->Cell(30,10,'Cantidad',1,0,'C',0);
    $this->Cell(30,10,'FechaVenc',1,1,'C',0);
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
    $pdf->Cell(25,10,$row['Producto'],1,0,'C',0);
    $pdf->Cell(110,10,$row['Nombre'],1,0,'C',0);
    $pdf->Cell(30,10,$row['Cantidad'],1,0,'C',0);
    $pdf->Cell(30,10,$row['FechaVenc'],1,1,'C',0);
}

$pdf->Output();
