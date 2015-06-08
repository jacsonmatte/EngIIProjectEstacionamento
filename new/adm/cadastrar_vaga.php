<?php require '../require/adm-aut.php'; ?>

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
	<h3>Cadastro de Vagas</h3>
		<form role='form' class='text-center'>
		<div class='form-group col-sm-6'>
			<label for='txtValor'>C&oacute;digo:</label>
			<input type='text' class='form-control' id='txtCodigo' placeholder='Digite o c&oacute;digo da vaga'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='sltTipo'>Tipo de vaga:</label>
			<select class='form-control' id='sltTipo'>
				<option>Carro</option>
				<option>Moto</option>
				<option>Utilit&aacute;rio</option>
			</select>
		</div>
		<div class='form-group col-sm-12'>
			<label for='txtDescricao'>Descri&ccedil;&atilde;o:</label>
			<textarea class='form-control' id='txtDescricao' placeholder='Digite alguma descri&ccedil;&atilde;o para o plano (opcional)'></textarea>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroSalvarVaga'></span>
			<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
			<input type='button' id='btnSalvar' class='btn cmd-item' value='Salvar' />
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>