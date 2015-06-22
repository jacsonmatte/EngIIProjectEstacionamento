<?php
	require '../require/cliente-aut.php';
	require '../dominio/constantes.php';
	require '../bd/conectBd.php';
	require '../bd/reserva.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastrar plano</title>
		<?php
			include '../require/meta.html';
			require '../require/js-base.html';
		?>
		<script type='text/javascript'>
		
			function setarCamposPesquisaData(dataInicial, dataFinal) {
				$("#txtPesquisaDataInicial").val(dataInicial);
				$("#txtPesquisaDataFinal").val(dataFinal);
			}
			
			function setarCampoPesquisaSituacao(situacao) { $("sltPesquisaSituacao").val(situacao); }
			
			function setarCampoPesquisaTipo(tipo) { $("sltPesquisaTipo").val(tipo); }
			
		</script>
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Controle de Reservas</h3>
	<form role='form' class='text-center' id="form-pesquisa" action='reservas.php?search=custom' method='POST'>
		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaDataInicial'>Data inicial:</label>
			<input type='date' class='form-control' id='txtPesquisaDataInicial' name='pesquisaDataInicial'>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaDataFinal'>Data final:</label>
			<input type='date' class='form-control' id='txtPesquisaDataFinal' name='pesquisaDataFinal'>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaSituacao'>Situação:</label>
			<select class='form-control' id='sltPesquisaSituacao' name='pesquisaSituacao'>
				<option value=' <?php $STATUS_RESERVA_RESERVADA ?>'>Em aberto</option>
				<option value=' <?php $STATUS_RESERVA_CANCELADA ?>'>Canceladas</option>
				<option value=' <?php $STATUS_RESERVA_UTILIZACAO ?>'>Em utilização</option>
				<option value=' <?php $STATUS_RESERVA_UTILIZADA ?>'>Concluídas</option>
			</select>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaTipo'>Tipo:</label>
			<select class='form-control' id='sltPesquisaTipo' name='pesquisaTipo'>
				<option value='0'>Tudo</option>
				<option value='<?php $TIPO_VAGA_CARRO ?>'>Carro</option>
				<option value='<?php $TIPO_VAGA_MOTO ?>'>Moto</option>
				<option value='<?php $TIPO_VAGA_UTILITARIO ?>'>Utilitário</option>
			</select>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarReservas'></span>
			<input type='button' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' />
		</div>
		<div id='divResultadoPesquisaReservas' class='form-group col-sm-12 text-center'>	
			<?php
				if (isset($_GET['search'])) {
					if ($_GET['search'] == 'custom' && isset($_POST["pesquisaDataInicial"]) && isset($_POST['pesquisaDataFinal']) && isset($_POST["pesquisaSituacao"]) && isset($_POST['pesquisaTipo'])
					$reservas = buscarReservas($_SESSION['id_cliente'], $_POST["pesquisaDataInicial"], $_POST["pesquisaDataInicial"], $_POST["pesquisaDataInicial"], $_POST["pesquisaDataInicial"]);
					if (!$reservas)
						echo "<strong style='color: #FFF'>Oops! Parece que tivemos um problema...</strong>";
					else if (mysql_num_rows($reservas))
						echo "<strong>Nenhuma reserva encontrada</strong>";
					else
						$i = 0;
						$html = "<table id='tbReservas'><tr><th>Código</th><th>Entrada</th><th>Saída</th><th>Vaga</th><th>Token</th><th>Status</th></tr>";
						while ($row = mysql_fetch_assoc($reservas)) {
							$html = $html . "<tr style='background: " . ($i % 2 == 0 ? "#CCC'" : "#FFF'") . "><td>" . $row['id_estacionamento'] . "</td><td>" . $row['dh_entrata'] . "</td><td>" . $row['dh_saida'] . "</td><td>" . $row['token'] . "</td><td>" . $row['status'] . "</td></tr>"; 
							
							
							
						}
					
					
				}
				else {
					echo "<strong>Para pesquisar reservas, informe os critérios desejados e clique em 'Pesquisar'</strong>";
			<?php
				if (isset($_POST["pesquisaDataInicial"]) && isset($_POST['pesquisaDataFinal']))
					echo "<script type='text/javascript'> setarCamposPesquisaData('" . $_POST['pesquisaDataInicial'] . "','" . $_POST['pesquisaDataFinal'] . "');</script>";
				if (isset($_POST["pesquisaTipo"]))
					echo "<script type='text/javascript'> setarCampoPesquisaTipo('" . $_POST['pesquisaTipo'] . "');</script>";
				if (isset($_POST['pesquisaSituacao']))
					echo "<script type='text/javascript'> setarCampoPesquisaSituacao('" . $_POST['pesquisaSituacao'] . "');</script>";
			?>
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>