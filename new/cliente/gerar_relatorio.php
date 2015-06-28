<?php
	require '../require/cliente-aut.php';
	require '../dominio/constantes.php';
	require '../fpdf/fpdf.php';
	require '../bd/conectBd.php';
	
	if(!isset($_POST['relatorio'])) {
		header("Location: relatorios.php?error=1");
		die("");
	}
	
	$dataInicial = '';
	$dataFinal = '';
	
	$pdf = new FPDF('P','mm','A4');
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	
	if (isset($_POST['datainicial']))
		$dataInicial = $_POST['datainicial'];
	if (isset($_POST['datafinal']))
		$dataFinal = $_POST['datafinal'];
	
	if ($dataInicial > $dataFinal) {
		header("Location: relatorios.php?error=4");
		die('');
	}
		
	if ($_POST['relatorio'] == 'planos') {
		
		require '../bd/plano_contratado.php';
		
		$planos = buscarPlanosCliente($_SESSION['id_cliente'], $dataInicial, $dataFinal, true);
		// a página tem 210mm de largura, com margem esquerda de 10
		// usamos 190mm para deixar a mesma margem na direita
		$pdf->Cell(190, 10, utf8_decode("Relatório de planos"), 1, 0, 'C'); // insere uma nova célula (largura, altura, texto, borda, posição e alinhamento)
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Ln(); // adiciona uma quebra de linha
		if ($dataInicial <> '' && $dataFinal <> '')
			$pdf->Cell(190, 10, utf8_decode("Período: " . $dataInicial . " a " . $dataFinal), 1, 0, 'C');
		else
			$pdf->Cell(190, 10, utf8_decode("Período: tudo"), 1, 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		if (mysql_num_rows($planos) > 0) {
			$i = 0;
			$pdf->SetFillColor(0, 45, 91);
			$pdf->SetTextColor(255, 255, 255);
			$pdf->Cell(50, 10, "Nome", 1, 0, 'C', true); // usar o utf_decode ao inserir texto com acento
			$pdf->Cell(20, 10, "Valor", 1, 0, 'C', true); // o último parâmetro habilita a mudança de cor de fundo da célula
			$pdf->Cell(20, 10, "Horas", 1, 0, 'C', true);
			$pdf->Cell(40, 10, "Hora exced.", 1, 0, 'C', true);
			$pdf->Cell(60, 10, utf8_decode("Contratação"), 1, 0, 'C', true);
			$pdf->Ln();
			$pdf->SetTextColor(0, 0, 0);
			while ($row = mysql_fetch_assoc($planos)) {
				if ($i % 2 == 0)
					$pdf->SetFillColor(255, 255, 255);
				else
					$pdf->SetFillColor(200, 200, 200);
				$i += 1;
				
				$pdf->Cell(50, 8, $row['nome'], 1, 0, 'C', true);
				$pdf->Cell(20, 8, $row['valor'], 1, 0, 'C', true);
				$pdf->Cell(20, 8, $row['horas'], 1, 0, 'C', true);
				$pdf->Cell(40, 8, $row['excedente'], 1, 0, 'C', true);
				$pdf->Cell(60, 8, $row['data'], 1, 0, 'C', true);
				$pdf->Ln();
			}
		}
		else {
			$pdf->Cell(190, 10, "Nenhum plano encontrado");
			$pdf->Ln();
		}
		
		$pdf->Cell(190, 10, utf8_decode("Relatório gerado por Control Parking"));
	
	}
	else if ($_POST['relatorio'] == 'reservas') {
	
		require '../bd/reserva.php';
		
		$reservas = buscarReservas($_SESSION['id_cliente'], $dataInicial, $dataFinal, 0, 0);
		$pdf->Cell(190, 10, utf8_decode("Relatório de reservas"), 1, 0, 'C');
		$pdf->SetFont('Arial','B',14);
		$pdf->Ln();
		if ($dataInicial <> '' && $dataFinal <> '')
			$pdf->Cell(190, 10, utf8_decode("Período: " . $dataInicial . " a " . $dataFinal), 1, 0, 'C');
		else
			$pdf->Cell(190, 10, utf8_decode("Período: tudo"), 1, 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		if (mysql_num_rows($reservas) > 0) {
			$i = 0;
			$pdf->SetFillColor(0, 45, 91);
			$pdf->SetTextColor(255, 255, 255);
			$pdf->Cell(20, 10, utf8_decode("Código"), 1, 0, 'C', true);
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
				
				$pdf->Cell(20, 8, $row['codigo'], 1, 0, 'C', true);
				$pdf->Cell(50, 8, str_replace('T', ' ', $row['entrada']), 1, 0, 'C', true);
				$pdf->Cell(50, 8, str_replace('T', ' ', $row['saida']), 1, 0, 'C', true);
				$pdf->Cell(20, 8, $row['vaga'], 1, 0, 'C', true);
				$pdf->Cell(20, 8, $row['token'], 1, 0, 'C', true);
				$pdf->Cell(30, 8, utf8_decode($status), 1, 0, 'C', true);
				$pdf->Ln();
			}
		}
		else {
			$pdf->Cell(190, 10, "Nenhuma reserva encontrada");
			$pdf->Ln();
		}
		$pdf->Cell(190, 10, utf8_decode("Relatório gerado por Control Parking"));
	}
	
	$pdf->Output();
?>