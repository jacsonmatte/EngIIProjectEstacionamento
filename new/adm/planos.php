<?php require '../require/adm-aut.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Planos</title>
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
	<h3>Planos</h3>
		<form role='form' class='text-center'>
		<div class='form-group col-sm-3 text-left' title='Informe a quantidade mínima de horas dos planos que deseja pesquisar'>
			<label for='txtPesquisaQuantidadeHorasMin'>Horas (mínimo):</label>
			<input type='text' class='form-control' id='txtPesquisaQuantidadeHorasMin' />
		</div>
		<div class='form-group col-sm-3 text-left' title='Informe a quantidade máxima de horas dos planos que deseja pesquisar' >
			<label for='txtPesquisaQuantidadeHorasMax'>Horas (máximo):</label>
			<input type='text' class='form-control' id='txtPesquisaQuantidadeHorasMax'/>
		</div>
		<div class='form-group col-sm-3 text-left' title='Informe o valor mínimo dos planos que deseja pesquisar'>
			<label for='txtPesquisaValorMin'>Valor (mínimo):</label>
			<input type='text' class='form-control' id='txtPesquisaValorMin' />
		</div>
		<div class='form-group col-sm-3 text-left' title='Informe o valor máximo dos planos que deseja pesquisar' >
			<label for='txtPesquisaValorMax'>Valor (máximo):</label>
			<input type='text' class='form-control' id='txtPesquisaValorMax'/>
		</div>
		<div class='form-group col-sm-12 text-left'>
			<input type='radio' id='rdbPesquisaSomentePlanosAtivos' name='pesquisaPlanoSituacao'/><label for='rdbPesquisaSomentePlanosAtivos'>&nbsp;Apenas planos ativos</label>&nbsp;
			<input type='radio' id='rdbPesquisaSomentePlanosInativos' name='pesquisaPlanoSituacao'/><label for='rdbPesquisaSomentePlanosInativos'>&nbsp;Apenas planos inativos</label>&nbsp;
			<input type='radio' id='rdbPesquisaTodosPlanos' name='pesquisaPlanoSituacao'/><label for='rdbPesquisaTodosPlanos'>&nbsp;Todos</label>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarMensalidades'></span>
			<input type='button' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' />
		</div>
		<div id='divResultadoPesquisaPlanos' class='form-group col-sm-12 text-center'>
			<strong>Nenhum plano encontrado ou pesquisado por enquanto</strong>
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>