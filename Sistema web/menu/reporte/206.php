<?php

require('fpdf.php');
require('../../pages/conexion.php');

$idreclamo = $_GET["valor"];

$consulta1 = "SELECT CONCAT('NOTA N° ',idnotacredito) as codigo, CONCAT('S/ ',SUM(D.Monto)) as monto, fechaCreacion as fecha1,fechavencimiento as fecha2
FROM notacredito N,reclamo R,pedido P, detallepedido D
WHERE P.idpedido=D.idPedido
AND P.idpedido=R.idpedido
AND N.idreclamo=R.idreclamo
AND R.idreclamo='$idreclamo'
group by D.idPedido;";

$resultado1 = $conex->query($consulta1);

class PDF extends FPDF {

    // Cabecera de página
    function Header() {
        // Logo
        //$this->Image('logo.png',10,8,33);
        // Arial bold 15
        $this->Image('images/kikin.png', 5, 5, 25);
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(85);
        // Título
        $var = "NOTA DE CRÉDITO";
        $this->Cell(110, 10, utf8_decode($var), 0, 0, 'C');
        $this->Cell(88, 10, 'Pollos y Parrillas Kin Kin', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);        
        $this->Cell(50, 9, 'Codigo', 1, 0, 'C', 0);
        $this->Cell(50, 9, 'Monto', 1, 0, 'C', 0);
        $this->Cell(80, 9, 'Fecha de Creacion', 1, 0, 'C', 0);
        $this->Cell(80, 9, 'Fecha de Vencimiento', 1, 1, 'C', 0);
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
    $pdf->Cell(50, 10, utf8_decode($row['codigo']), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($row['monto']), 1, 0, 'C', 0);
    $pdf->Cell(80, 10, utf8_decode($row['fecha1']), 1, 0, 'C', 0);
    $pdf->Cell(80, 10, utf8_decode($row['fecha2']), 1, 1, 'C', 0);
}

$pdf->Output();
