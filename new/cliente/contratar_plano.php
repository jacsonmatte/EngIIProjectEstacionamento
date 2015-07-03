<?php
	require '../require/cliente-aut.php';

?>
<?php	
	$nomecliente = $_SESSION['username'];
?>

<?php

	if(isset($_POST["btnSalvar"])){

		$id_plano = addslashes($_POST["sltPlano"]);
		$descricao = addslashes($_POST["txtDescricao"]);

			if($id_plano == ""){
				echo "<script>alert('Por favor $nomecliente, selecione um plano!!');</script>";

			}else{

				require_once("../bd/conectBd.php");				
					$sql="SELECT id_cliente FROM cliente INNER JOIN usuario ON cliente.id_cliente = usuario.cliente_id_cliente WHERE usuario.login='{$nomecliente}'";
					$conexao = dbConnect("localhost","root","");
					$query = dbConsulta($sql,"estacionamento", $conexao);

			if (mysql_num_rows($query)) {
				while($pegaid=mysql_fetch_array($query)){
					$id=$pegaid["id_cliente"];
				}

			$sql="INSERT INTO plano_contratado values('NULL','$id','$id_plano', '" . date('Y-m-d') . "', '$descricao')";
			$limite=dbConsulta($sql,'estacionamento', $conexao);
			echo "<script>alert('Plano contratado com sucesso!!');</script>";
			mysql_close($conexao);
			echo("<script type='text/javascript'>location.href='contratar_plano.php';</script>");
			}
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