<?php
require('fpdf.php');
require('../../pages/conexion.php');

$id= $_GET["plato"];
$nombre= $_GET["nombre"];

$consulta = "SELECT I.idProductos as ID,I.Nombre as Nombre, I.Descripcion as Descripcion,D.cantidadProducto AS Cantidad
FROM inventario I, platos P, detalleplato D
WHERE D.idPlato=P.idPlato
AND I.idProductos=D.idProductos
AND D.fechaIngrediente=curdate()
and D.idPlato=$id";

$resultado = $conex->query($consulta);

class PDF extends FPDF
{
    
    // Cabecera de página
    function Header()
{
    $id= $_GET["plato"];
    $nombre= $_GET["nombre"];
    $fecha= date("d/m/Y");
    $var=utf8_decode("Ingredientes del plato: $nombre ($fecha)");
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    $this->Cell(110,10,$var,0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(25,10,'ID',1,0,'C',0);
    $this->Cell(75,10,'Nombre',1,0,'C',0);
    $this->Cell(150,10,'Descripcion',1,0,'C',0);
    $this->Cell(25,10,'Cantidad',1,1,'C',0);
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
$pdf->AddPage('L');
$pdf->SetFont('Arial','',10);

while($row=$resultado->fetch_assoc()){
    $pdf->Cell(25,9,$row['ID'],1,0,'C',0);
    $pdf->Cell(75,9,utf8_decode($row['Nombre']),1,0,'C',0);
    $pdf->Cell(150,9,utf8_decode($row['Descripcion']),1,0,'C',0);
    $pdf->Cell(25,9,utf8_decode($row['Cantidad']),1,1,'C',0);
}

$pdf->Output();
