<?php
	require '../require/adm-aut.php';
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
		$_SESSION['username'] = 'teste';
		require '../require/menu-adm.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Controle de Reservas</h3>
	<form role='form' class='text-center' id="form-pesquisa">
		
		<div class='form-group col-sm-4 text-left'  style="border:solid 3px #000">
			<h4>Consulta de Vagas:</h4><br/>
			<label for='dt_inicio'>Data de Início:</label>
			<input type='date' class='form-control' id='dt_inicio' name="data_inicio"><br/>
			<label for='dt_fim'>Data Final:</label>
			<input type='date'  class='form-control' id='dt_fim' name="data_fim"><br/>
			<center><button type='submit' id='btn_pesquisa' class='btn btn-success btn-medium min-border-white' value='Pesquisar'>Pesquisar <span class='glyphicon glyphicon-search'/></button>
			<hr/>
		</div>

	</form>	
	<form role='form' class='text-center' id="form-reserva">
		<div class='form-group col-md-offset-6 text-left' >
			<h4 class='text-center'>Efetuar Reserva:</h4><br/>
			<label for='vaga'>Vagas Disponíveis:</label>
			<select class='form-control' id='vaga'>
				<option> Vagas</option>
			</select><br/>
			
			<label for='dt_entrada'>Data e Horário de Entrada:</label>
			<input type='datetime-local' class='form-control' id='dt_entrada' name='data_hora_entrada'><br/>
			<label for='dt_saida'>Data e Horário de Saída:</label>
			<input type='datetime-local' class='form-control' id='dt_saida' name='data_hora_saida'>
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