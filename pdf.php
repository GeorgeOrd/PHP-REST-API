<?php
require('reports/fpdf.php');
require('src/database/db.php');

class pdf extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('assets/kid.png', 10, 8, 20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 18);
        // Movernos a la derecha
        $this->Cell(65);
        // Título
        $this->Cell(60, 10, utf8_decode('Reporte de Empleados "Pequeños Traviesos"'), 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$query = "SELECT tbl_empleado.emp_nombre,tbl_empleado.emp_apellido,tbl_empleado.emp_cedula, 
tbl_cargo.crg_descripcion, tbl_departamento.dpt_nombre
FROM tbl_empleado JOIN tbl_cargo ON tbl_cargo.crg_id= tbl_empleado.id_crg
JOIN tbl_departamento ON tbl_departamento.dpt_id= tbl_empleado.id_dpt ORDER BY emp_apellido ASC";
$db = new db;
$showEmp = $db->getInfo($query);

$pdf = new pdf();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTextColor(231, 73, 39);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(37, 12, 'Nombre', 1);
$pdf->Cell(37, 12, 'Apellido', 1);
$pdf->Cell(37, 12, 'Cedula', 1);
$pdf->Cell(37, 12, 'Cargo Ocupado', 1);
$pdf->Cell(37, 12, 'Departamento', 1);
foreach ($showEmp as $row) {
    $counter = 1;
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(43, 102, 168);
    $pdf->Ln();
    foreach ($row as $column) {
        if ($counter > 3) {
            $pdf->Cell(37, 10, $column, 1);
        } else {
            $pdf->Cell(37, 10, $column, 1);
        }
        ++$counter;
    }
}
$pdf->Output();
