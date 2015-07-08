<?php require '../require/adm-aut.php'; 
	  require '../dominio/constantes.php';	
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastrar vaga</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>

	<script type="text/javascript">
		
		function validarCampos(){

			var codigo = $("#txtCodigo").val().trim();
			if(codigo == '' || isNaN(codigo) || parseInt(codigo) < 1 || parseInt(codigo) > 99999) {
				$("#spnErroSalvarVaga").text("Informe um número entre 0 e 99999 para a vaga!");
				$('#$txtCodigo').focus();
				return;			
			}
			$("#spnErroSalvarVaga").text("Aguarde! Verificando disponibilidade do número...");
			$("#spnErroSalvarVaga").removeClass('label-danger').addClass('label-default');
			setTimeout(function () { $('#frmCadastrarVaga').submit(); }, 2000);
		}
		
		function resultadoCadastrarVaga(texto, sucesso) {
			$("#spnErroSalvarVaga").text(texto);
			if (sucesso)
				$("#spnErroSalvarVaga").removeClass('label-danger').addClass('label-success');
			else
				$("#spnErroSalvarVaga").removeClass('label-success').addClass('label-danger');
		}
		
	</script>	
	</head>
	<?php
		require '../require/menu-1.html';
		$_SESSION['username'] = 'teste';
		require '../require/menu-adm.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Cadastro de Vagas</h3>
	<form role='form' class='text-center' name="form_vaga" id='frmCadastrarVaga' action="cadastrar_vaga.php" method="POST">
		<div class='form-group col-sm-6'>
			<label for='txtValor'>C&oacute;digo:</label>
			<input type='number' class='form-control' id='txtCodigo' name="cod_vaga" placeholder='Digite o número da vaga'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='sltTipo'>Tipo de vaga:</label>
			<select class='form-control' id='sltTipo' name="tipo_vaga">
				<option value='<?php echo $TIPO_VAGA_CARRO; ?>'>Carro</option>
				<option value='<?php echo $TIPO_VAGA_MOTO ?>'>Moto</option>
				<option value='<?php echo $TIPO_VAGA_UTILITARIO ?>'>Utilitário</option>
			</select>
		</div>
		<div class='form-group col-sm-12'>
			<label for='txtDescricao'>Descri&ccedil;&atilde;o:</label>
			<textarea class='form-control' id='txtDescricao' name="descricao_vaga" placeholder='Digite alguma descrição para o plano (opcional)'></textarea>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroSalvarVaga' class='label label-danger'></span>
			<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
			<input type='button' id='btnSalvar' class='btn cmd-item' value='Salvar' name="btnSalvar" onclick='validarCampos()'/>
		</div>
	</form>

	<script type="text/javascript">
		
		$( "#btnCancelar").click(function() {
			$(location).attr('href', 'home.php');
		});
	</script>	
	
	
	<?php
		require '../require/content-2-footer.html';

		if(isset($_POST["cod_vaga"])){
				
				$cod_vaga=addslashes($_POST["cod_vaga"]);
				
				if ( $cod_vaga < 0 || $cod_vaga > 99999 || $cod_vaga == '' || !is_numeric($cod_vaga)) {
					echo "<script language='javascript'>resultadoCadastrarVaga('Informe um número maior que 0 para a vaga!', false);</script>";
					die();
				}
				
				
				require_once("../bd/conectBd.php");
				$conexao=dbConnect("localhost","root","");
				
				
	 			$tipo_vaga=addslashes($_POST["tipo_vaga"]);
	 			$descricao_vaga=addslashes($_POST["descricao_vaga"]);
	 			
				
				
				$verificarNumeroVaga = dbConsulta("SELECT 1 FROM vaga WHERE nro_vaga = $cod_vaga", 'estacionamento', $conexao);

				if ($verificarNumeroVaga) {

					if (mysql_num_rows($verificarNumeroVaga) > 0) {
						echo "<script language='javascript'>resultadoCadastrarVaga('Já existe uma vaga com este número!', false);</script>";
					}
					else {

						$sql = "INSERT INTO vaga (nro_vaga, descricao, tipo) VALUES ('$cod_vaga','$descricao_vaga','$tipo_vaga')";
						$pega = dbConsulta($sql,'estacionamento', $conexao);

						if(!$pega)
							echo "<script language='javascript'>resultadoCadastrarVaga('Vaga não cadastrada', false);</script>";
						else
							echo "<script language='javascript'>resultadoCadastrarVaga('Vaga cadastrada com sucesso', true);</script>";
					}
				}
				mysql_close($conexao);
		}				

	?>
</html>