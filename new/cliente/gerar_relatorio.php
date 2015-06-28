<?php		
	require '../fpdf/fpdf.php';
	require '../bd/conectBd.php';
	require '../bd/reserva.php';
	
	if(!isset($_POST['relatorio'])) {
		header("Location: relatorios.php");
		die("");
	}
	
	if ($_POST['relatorio'])
	
	$pdf = new FPDF('P','mm','A4');
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,'Hello World!');
	$pdf->Output();
?>