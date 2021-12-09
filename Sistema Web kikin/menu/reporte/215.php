<?php

require('fpdf.php');
require('../../pages/conexion.php');

$id = $_GET["valor"];

$consulta1 = "SELECT nombre,cantidad,monto, cantidad*monto as totall
FROM Pedido P, detallepedido D, platos C 
WHERE P.idPedido=D.idPedido 
AND D.idPlato=C.idPlato 
AND D.idPedido='$id'";

$resultado1 = $conex->query($consulta1);

$consulta2 = "SELECT sum(cantidad*monto) as total
FROM Pedido P, detallepedido D, platos C 
WHERE P.idPedido=D.idPedido 
AND D.idPlato=C.idPlato 
AND D.idPedido='$id'";

$resultado2 = $conex->query($consulta2);

$consulta3 = "SELECT nombre,apellido,direccion,fechaPedido
FROM pedido p,comensal co,mesa m
WHERE p.idComensal   =co.idComensal  
AND p.idMesa =m.idMesa 
AND p.idPedido='$id'";

$resultado3 = $conex->query($consulta3);

class PDF extends FPDF {

    // Cabecera de página
    function Header() {
        $id = $_GET["valor"];
        // Logo
        //$this->Image('logo.png',10,8,33);
        // Arial bold 15
        $this->Image('images/kikin.png', 5, 5, 25);
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(85);
        // Título
        $var = "Comprobante de Pago N°$id";
        $this->Cell(110, 10, utf8_decode($var), 0, 0, 'C');
        $this->Cell(88, 10, 'Pollos y Parrillas Kin Kin', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);        
        $this->Cell(50, 10, 'Nombre', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Cantidad', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Monto', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Total', 1, 1, 'C', 0);
    }

// Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage("L");
$pdf->SetFont('Arial', '', 10);


while ($row = $resultado1->fetch_assoc()) {
    $pdf->Cell(50, 10, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($row['cantidad']), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($row['monto']), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($row['totall']), 1, 1, 'C', 0);
}
while ($row = $resultado2->fetch_assoc()) {
    $pdf->Cell(150, 10, "Subtotal", 1, 0, "C");
    $pdf->Cell(50, 10, utf8_decode($row['total']), 1, 1, 'C', 0);
}

while ($row = $resultado3->fetch_assoc()) {
    $var1 = "Cliente: " . utf8_decode($row['nombre']) . " " . utf8_decode($row['apellido']);
    $var2 = "Direccion: " . utf8_decode($row['direccion']) . " - Fecha: " . date("d/m/Y", strtotime($row['fechaPedido']));
    $variables = $var1 . "\n" . $var2;
    $pdf->MultiCell(80, 10, utf8_decode($variables), 0, 'C');
}

$pdf->Output();
