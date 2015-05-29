<?php
	$_SESSION['user_type'] = 2;
	require '../require/cliente-aut.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Contratar plano</title>
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
	<h3>Contratar Plano</h3>
	<form role='form' class='text-center'>
		<div class='form-group col-sm-6'>
			<label for='sltPlano'>Plano:</label>
			<select class='form-control' id='sltPlano'>
				<option>Plano 1</option>
				<option>Plano 2</option>
				<option>Plano 3</option>
			</select>
		</div>
		<!-- estes inputs devem ser desabilitados, pois são só pra exibição-->
		<div class='form-group col-sm-6'> 
			<label for='txtValor'>Valor:</label>
			<input type='text' class='form-control' id='txtValor'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='txtQuantidadeHoras'>Quantidade de horas:</label>
			<input type='text' class='form-control' id='txtQuantidadeHoras'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='txtValorHoraExcedente'>Hora excedente:</label>
			<input type='text' class='form-control' id='txtValorHoraExcedente'>
		</div>
		<div class='form-group col-sm-12'>
			<label for='txtDescricao'>Descri&ccedil;&atilde;o:</label>
			<textarea class='form-control' id='txtDescricao'></textarea>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroSalvarPlano'></span>
			<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
			<input type='button' id='btnSalvar' class='btn cmd-item' value='Salvar' />
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>