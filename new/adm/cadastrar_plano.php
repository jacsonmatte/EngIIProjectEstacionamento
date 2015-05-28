<?php
	$_SESSION['user_type'] = 1;
	require '../require/adm-aut.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastrar plano</title>
		<?php
			include '../include/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		$_SESSION['username'] = 'teste';
		require '../require/menu-adm.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Cadastro de Planos</h3>
	<form role='form' class='text-center'>
		<div class='form-group col-sm-6'>
			<label for='txtNome'>Nome:</label>
			<input type='text' class='form-control' id='txtNome' placeholder='Ex: Plano executivo 1, Plano passeio...'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='txtValor'>Valor:</label>
			<input type='text' class='form-control' id='txtValor' placeholder='Digite o valor do plano'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='txtQuantidadeHoras'>Quantidade de horas:</label>
			<input type='text' class='form-control' id='txtQuantidadeHoras' placeholder='Digite a quantidade de horas'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='txtValorHoraExcedente'>Hora excedente:</label>
			<input type='text' class='form-control' id='txtValorHoraExcedente' placeholder='Digite o valor da hora excedente'>
		</div>
		<div class='form-group col-sm-12'>
			<label for='txtDescricao'>Descri&ccedil;&atilde;o:</label>
			<textarea class='form-control' id='txtDescricao' placeholder='Digite alguma descri&ccedil;&atilde;o para o plano (opcional)'></textarea>
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