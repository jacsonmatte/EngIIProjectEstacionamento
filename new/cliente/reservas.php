<?php
	require '../require/cliente-aut.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastrar plano</title>
		<?php
			include '../require/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Controle de Reservas</h3>
	<form role='form' class='text-center' id="form-pesquisa">
		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaDataInicial'>Data inicial:</label>
			<input type='date' class='form-control' id='txtPesquisaDataInicial'>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaDataFinal'>Data final:</label>
			<input type='date' class='form-control' id='txtPesquisaDataFinal'>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaSituacao'>Situação:</label>
			<select class='form-control' id='sltPesquisaSituacao'>
				<option>Livre</option>
				<option>Em utilização</option>
				<option>Reservada</option>
			</select>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaTipo'>Tipo:</label>
			<select class='form-control' id='sltPesquisaTipo'>
				<option>Carro</option>
				<option>Moto</option>
				<option>Utilitário</option>
			</select>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarReservas'></span>
			<input type='button' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' />
		</div>
		<div id='divResultadoPesquisaReservas' class='form-group col-sm-12 text-center'>
			<strong>Nenhuma reserva encontrada ou pesquisada por enquanto</strong>
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>