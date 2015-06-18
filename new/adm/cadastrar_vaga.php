<?php require '../require/adm-aut.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastrar vaga</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>

	<script type="text/javascript">
		

		function validaCampo(){
			if(document.form_vaga.cod_vaga.value==""){
				alert("O Campo Numero da Vaga é obrigatório!");
				document.getElementById('txtCodigo').focus();
				return false;
				
			}else if(document.form_vaga.tipo_vaga.value==""){
				alert("O Campo tipo da vaga é obrigatório!");
				document.getElementById('sltTipo').focus();
				return false;	

			}
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
	<form role='form' class='text-center' name="form_vaga" action="cadastrar_vaga.php" method="POST" onsubmit="return validaCampo(); return false;">
		<div class='form-group col-sm-6'>
			<label for='txtValor'>C&oacute;digo:</label>
			<input type='number' class='form-control' id='txtCodigo' name="cod_vaga" placeholder='Digite o c&oacute;digo da vaga'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='sltTipo'>Tipo de vaga:</label>
			<select class='form-control' id='sltTipo' name="tipo_vaga">
				<option value="Carro">Carro</option>
				<option value="Moto">Moto</option>
				<option value="Utilitário">Utilit&aacute;rio</option>
			</select>
		</div>
		<div class='form-group col-sm-12'>
			<label for='txtDescricao'>Descri&ccedil;&atilde;o:</label>
			<textarea class='form-control' id='txtDescricao' name="descricao_vaga" placeholder='Digite alguma descri&ccedil;&atilde;o para o plano (opcional)'></textarea>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroSalvarVaga'></span>
			<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
			<input type='submit' id='btnSalvar' class='btn cmd-item' value='Salvar' name="btnSalvar"/>
		</div>
	</form>

	<script type="text/javascript">
		
		$( "#btnCancelar").click(function() {
			$(location).attr('href', 'home.php');
		});
	</script>	
	
	
	<?php
		require '../require/content-2-footer.html';
	


		if(isset($_POST["btnSalvar"])){
				
				require_once("../bd/conectBd.php");
				$conexao=dbConnect("localhost","root","");

				$cod_vaga=addslashes($_POST["cod_vaga"]);
	 			$tipo_vaga=addslashes($_POST["tipo_vaga"]);
	 			$descricao_vaga=addslashes($_POST["descricao_vaga"]);
	 			
				$sql="INSERT INTO vaga values('NULL','$cod_vaga','$descricao_vaga','$tipo_vaga')";
				$pega=dbConsulta($sql,'estacionamento', $conexao);
				
				if(!$pega){
					echo "<script language=javascript>alert( 'Falha ao cadastrar Vaga !!!' );</script>";
				}else{
					echo "<script language=javascript>alert( 'Nova Vaga Cadastrada com Sucesso !!!' );</script>";
				}
				mysql_close($conexao);
		}				





	?>
</html>