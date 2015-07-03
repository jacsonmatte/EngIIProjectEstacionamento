<?php
	require '../require/cliente-aut.php';

?>
<?php	
	$nomecliente = $_SESSION['username'];
	$planoSalvo = 0;
?>

<?php

	if(isset($_POST["btnSalvar"])){

		$id_plano = addslashes($_POST["sltPlano"]);
		$observacao = addslashes($_POST["txtDescricao"]);
		
		if($id_plano == "")
			echo "<script>alert('Por favor $nomecliente, selecione um plano!!');</script>";
		else {

			require_once("../bd/conectBd.php");
			$con = dbConnect("localhost", "root", "");
			
			$verificacaoPlano = dbConsulta("SELECT 1 FROM plano_contratado WHERE plano_id_plano = $id_plano AND cliente_id_cliente = " . $_SESSION['id_cliente'], "estacionamento", $con);
			
			if (mysql_num_rows($verificacaoPlano) > 0) {
				echo "<script type='text/javascript'>alert('Você já tem este plano contratado!');</script>";
				echo("<script type='text/javascript'>location.href='contratar_plano.php';</script>");
			}
			else {
				if (dbConsulta("INSERT INTO plano_contratado (id_plano_contratado, cliente_id_cliente, plano_id_plano, data_contrato, observacao) VALUES (NULL," . $_SESSION['id_cliente'] . ", $id_plano, '" . date('Y-m-d') . "', '$observacao')", 'estacionamento', $con)) {
					mysql_close($con);
					echo "<script type='text/javascript'>alert('Plano contratado com sucesso!');</script>";
					echo("<script type='text/javascript'>location.href='contratar_plano.php';</script>");
				}
				else
					echo "<script type='text/javascript'>alert('Falha ao contratar o plano!');</script>";
			}
			
			mysql_close($con);
			
		}
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Contratar plano</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';

		?>
		<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("select[name='sltPlano']").change(function(){
					var txtValor = $("input[name='txtValor']");
					var txtValorHoraExcedente = $("input[name='txtValorHoraExcedente']");
					var txtQuantidadeHoras = $("input[name='txtQuantidadeHoras']");
					var txtDescricao = $("textarea[name='txtDescricao']");

					$( txtValor ).val('Carregando...');
					$( txtValorHoraExcedente ).val('Carregando...');
					$( txtQuantidadeHoras ).val('Carregando...');
					$( txtDescricao ).val('Carregando...');

					$.getJSON(
						'function.php',
						{ id: $(this).val() },
						function( json )
						{
							$( txtValor ).val( json.txtValor );
							$( txtValorHoraExcedente ).val( json.txtValorExcedente );
							$( txtQuantidadeHoras ).val( json.txtHoras );
							$( txtDescricao ).val(json.txtDescr); 
						}
					);
				});
			});
			
			function erroSalvarPlano(resultado) {
				if (resultado == 1) $('#spnErroSalvarPlano').html('Plano contratado com sucesso!');
				else $('#spnErroSalvarPlano').html('Falha ao contratar o plano!');
			}
			
		</script>
	</head>
	
	<?php
		require '../require/menu-1.html';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 

	<h3>Contratar Plano</h3>
	<form role='form' class='text-left' method="POST" action="">
		<div class='form-group col-sm-3'> 
			<label for='sltPlano'>Plano: </label> 
			<select name="sltPlano" class='form-control' id='sltPlano'>
				<option value="">--</option>
				<?php
				include 'function.php';
				echo montaSelect();
				?>
			</select>
		</div>	
		
		<div class='form-group col-sm-3'> 
			<label for='txtValor'>Valor: </label>
			<input name='txtValor' type='text' class='form-control' id='txtValor' readonly='true' >
		</div>
		
		<div class='form-group col-sm-3'>
			<label for='txtQuantidadeHoras'>Quantidade de horas:</label>
			<input name='txtQuantidadeHoras' type='text' class='form-control' id='txtQuantidadeHoras' readonly='true'>
		</div>
		
		<div class='form-group col-sm-3'>
			<label for='txtValorHoraExcedente'>Hora excedente:</label>
			<input name='txtValorHoraExcedente'type='text' class='form-control' id='txtValorHoraExcedente' readonly='true'>
		</div>
		
		<div class='form-group col-sm-6'>
			<label for='txtDescricao'>Descrição:</label>
			<textarea name='txtDescricao' class='form-control' id='txtDescricao' readonly='true'></textarea>
		</div>
		
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroSalvarPlano'></span>
			<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
			<input type='submit' name="btnSalvar" id='btnSalvar' class='btn cmd-item' value='Contratar' />
		</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
	
</html>