<?php
	$_SESSION['user_type'] = 1;
	require '../require/adm-aut.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastrar vaga</title>
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
	<h3>Relatórios</h3>
	<form role='form' class='text-center'>
		<div class='form-group col-sm-3 text-left'>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioPlanos' /> Planos
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioClientes' /> Clientes
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioPlanos' /> Planos x Clientes
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioPlanos' /> Reservas utilizadas
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioPlanos' /> Reservas cadastradas
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioPlanos' /> Uso de vagas
			</div>
		</div>
		<div class='form-group col-sm-9 text-left'>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-4'>
					<input class='form-control' type='date' id='dteDataInicial'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-4'>
					<input class='form-control' type='date' id='dteDataFinal'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-6'>
					<input class='form-control' type='text' id='txtIdentificacaoCliente' placeholder='Identificação do cliente'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-3'>
					<input class='form-control' type='text' id='txtVaga' placeholder='Vaga'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-6'>
					<select class='form-control' id='sltPlanos'>
						<option>Plano 1</option>
						<option>Plano 2</option>
						<option>Plano 3</option>
					</select>
				</div>
			</div>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroGerarRelatorio'></span>
			<input type='button' id='btnGerar' class='btn cmd-item' value='Gerar' />
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>