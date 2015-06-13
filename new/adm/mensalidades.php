<?php require '../require/adm-aut.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Mensalidades</title>
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
	<h3>Mensalidades</h3>
		<form role='form' class='text-center'>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaMes'>Mês:</label>
			<select class='form-control' id='sltPesquisaMes'>
				<?php // função ?>
			</select>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaAno'>Ano:</label>
			<select class='form-control' id='sltPesquisaAno'>
				<option>2014</option>
				<option>2015</option>
				<option>2016</option>
			</select>
		</div>
		<div class='form-group col-sm-6 text-left'>
			<label for='txtPesquisaNomeCliente'>Cliente:</label>
			<input type='text' class='form-control' id='txtPesquisaNomeCliente' placeholder='Digite o nome (ou parte) do cliente' />
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarMensalidades'></span>
			<input type='button' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' />
		</div>
		<div id='divResultadoPesquisaMensalidades' class='form-group col-sm-12 text-center'>
			<strong>Nenhuma mensalidade encontrada ou pesquisada por enquanto</strong>
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>