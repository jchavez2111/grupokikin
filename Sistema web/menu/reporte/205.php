<?php
require('fpdf.php');
require('../../pages/conexion.php');


$id=$_GET["valor"];


$consulta = "SELECT C.idrecepcion,o.monto,o.igv,c.montototal,c.fechaComprobante as Fecha
FROM comprobantedepagodeproductosrequeridos c,ordendepagoproductosrequeridos o
WHERE c.idOrdendePago=o.idOrdendePago
AND C.idcomprobanteProdR='$id'";
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
    $var="Comprobante de Pago N°$id";
    $this->Cell(110,10,utf8_decode($var),0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(30,10,'IdRecepcion',1,0,'C',0);
    $this->Cell(30,10,'Monto',1,0,'C',0);
    $this->Cell(30,10,'IGV',1,0,'C',0);
    $this->Cell(30,10,'MontoTotal',1,0,'C',0);
    $this->Cell(30,10,'Fecha',1,1,'C',0);
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
    $pdf->Cell(30,10,$row['idrecepcion'],1,0,'C',0);
    $pdf->Cell(30,10,$row['monto'],1,0,'C',0);
    $pdf->Cell(30,10,$row['igv'],1,0,'C',0);
    $pdf->Cell(30,10,$row['montototal'],1,0,'C',0);
    $pdf->Cell(30,10,$row['Fecha'],1,1,'C',0);
}

$pdf->Output();
