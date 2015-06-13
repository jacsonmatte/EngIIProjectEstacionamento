<?php require '../require/adm-aut.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Vagas</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-adm.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Vagas</h3>
		<form role='form' class='text-center'>
		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaNumeroVaga'>Número:</label>
			<input type='text' class='form-control' id='txtPesquisaNumeroVaga'>
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
			<span id='spnErroPesquisarVagas'></span>
			<input type='button' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' />
		</div>
		<div id='divResultadoPesquisaVagas' class='form-group col-sm-12 text-center'>
			<strong>Nenhuma vaga encontrada ou pesquisada por enquanto</strong>
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>