<?php require '../require/adm-aut.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Clientes</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		$_SESSION['username'] = 'teste';
		require '../require/menu-adm.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Clientes</h3>
		<form role='form' class='text-center'>
		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaDataInicial'>Data inicial (cadastro):</label>
			<input type='date' class='form-control' id='txtPesquisaDataInicial'>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaDataFinal'>Data final (cadastro):</label>
			<input type='date' class='form-control' id='txtPesquisaDataFinal'>
		</div>
		<div class='form-group col-sm-6 text-left'>
			<label for='txtPesquisaNomeCliente'>Cliente:</label>
			<input type='text' class='form-control' id='txtPesquisaNomeCliente' placeholder='Digite o nome (ou parte) do cliente' />
		</div>
		<div class='form-group col-sm-12 text-left'>
			<input type='checkbox' id='chkPesquisaApenasClientesComPlano' /><label for='chkPesquisaApenasClientesComPlano'>&nbsp;Apenas clientes com plano</label>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarClientes'></span>
			<input type='button' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' />
		</div>
		<div id='divResultadoPesquisaClientes' class='form-group col-sm-12 text-center'>
			<strong>Nenhum cliente encontrado ou pesquisado por enquanto</strong>
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>