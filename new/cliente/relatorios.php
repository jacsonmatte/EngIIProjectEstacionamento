<?php
	//$_SESSION['user_type'] = 1;
	require '../require/cliente-aut.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Relatórios</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		$_SESSION['username'] = 'teste';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Relatórios</h3>
	<form role='form' class='text-center'>
		<div class='form-group col-sm-3 text-left'>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioMeusPlanos' /> Meus Planos
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioUsoPlanos' /> Uso de Planos
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioMinhasReservas' /> Minhas Reservas
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
				<div class='col-sm-3'>
					<input class='form-control' type='text' id='txtSituacao' placeholder='Situação Reserva'/>
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
