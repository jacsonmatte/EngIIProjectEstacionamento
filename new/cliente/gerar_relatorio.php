<?php
	require '../require/cliente-aut.php';
	require '../dominio/constantes.php';
	require '../fpdf/fpdf.php';
	require '../bd/conectBd.php';
	require '../bd/reserva.php';
	
	if(!isset($_POST['relatorio'])) {
		var_dump($_POST['relatorio']);
		header("Location: relatorios.php");
		die("");
	}
	
	$dataInicial = '';
	$dataFinal = '';
	$plano = 0;
	
	if (isset($_POST['datainicial']))
		$dataInicial = $_POST['datainicial'];
	else
		die('');
	if (isset($_POST['datafinal']))
		$dataFinal = $_POST['datafinal'];
	else
		die('');
	if (isset($_POST['plano']))
		$plano = $_POST['plano'];
	else
		die('');

	$pdf = new FPDF('P','mm','A4');
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	
	if ($_POST['relatorio'] == 'planos') {
		
	
	}
	else if ($_POST['relatorio'] == 'uso') {
		
	}
	else if ($_POST['relatorio'] == 'reservas') {
		$reservas = buscarReservas($_SESSION['id_cliente'], $dataInicial, $dataFinal, 0, 0);
		$pdf->Cell(150, 10, utf8_decode("Relatório de reservas")); // insere uma nova célula (largura, altura, texto)
		$pdf->SetFont('Arial','B',14);
		$pdf->Ln(); // adiciona uma quebra de linha
		$pdf->Cell(150, 10, utf8_decode("Período: " . $dataInicial . " a " . $dataFinal));
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		if (mysql_num_rows($reservas) > 0) {
			$i = 0;
			$pdf->SetFillColor(0, 45, 91);
			$pdf->SetTextColor(255, 255, 255);
			$pdf->Cell(20, 10, utf8_decode("Código"), 1, 0, 'C', true); // usar o utf_decode ao inserir texto com acento
			$pdf->Cell(50, 10, "Entrada", 1, 0, 'C', true);
			$pdf->Cell(50, 10, utf8_decode("Saída"), 1, 0, 'C', true);
			$pdf->Cell(20, 10, "Vaga", 1, 0, 'C', true);
			$pdf->Cell(20, 10, "Token", 1, 0, 'C', true);
			$pdf->Cell(30, 10, utf8_decode("Situação"), 1, 0, 'C', true);
			$pdf->Ln();
			$pdf->SetTextColor(0, 0, 0);
			while ($row = mysql_fetch_assoc($reservas)) {
				$status = '';
				if ($row['status'] == $STATUS_RESERVA_CANCELADA) $status = 'Cancelada';
				else if ($row['status'] == $STATUS_RESERVA_UTILIZADA) $status = 'Concluída';
				else if ($row['status'] == $STATUS_RESERVA_RESERVADA) $status = 'Em aberto';
				else $status = 'Em utilização';
				
				if ($i % 2 == 0)
					$pdf->SetFillColor(255, 255, 255);
				else
					$pdf->SetFillColor(200, 200, 200);
				$i += 1;
				
				$pdf->Cell(20, 10, $row['codigo'], 1, 0, 'C', true);
				$pdf->Cell(50, 10, $row['entrada'], 1, 0, 'C', true);
				$pdf->Cell(50, 10, $row['saida'], 1, 0, 'C', true);
				$pdf->Cell(20, 10, $row['vaga'], 1, 0, 'C', true);
				$pdf->Cell(20, 10, $row['token'], 1, 0, 'C', true);
				$pdf->Cell(30, 10, utf8_decode($status), 1, 0, 'C', true);
				$pdf->Ln();
				
			}
		}
		else
			$pdf->Cell(15, 10, "Nenhuma reserva encontrada");
		
		$pdf->Cell(15, 10, utf8_decode("Relatório gerado por Control Parking"));
	}
	$pdf->Output();
?>