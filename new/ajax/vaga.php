<?php

	require '../bd/conectBd.php';
	require '../bd/reserva.php';
	
	$action;
	
	if (isset($_POST['action']))
		$action = $_POST['action'];
	else
		die("");
	
	
	if ($action == 'pesquisarVagasDisponiveis') {
		try {
			$vagasLivres = buscarVagasLivres($_POST['dataInicial'], $_POST['dataFinal'], $_POST['tipo']);
			$htmlTempVagas = '';
			if (mysql_num_rows($vagasLivres) > 0) {
				while ($row = mysql_fetch_assoc($vagasLivres))
					$htmlTempVagas = $htmlTempVagas . "<option value='" . $row['id_vaga'] . "'>" . $row['nro_vaga'] . "</option>";
				echo $htmlTempVagas;
			}
			else {
				echo "0";
			}
		}
		catch (Exception $ex) {
			echo "Falha";
		}
	}
	
?>