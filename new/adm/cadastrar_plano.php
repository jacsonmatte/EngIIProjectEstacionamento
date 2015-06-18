<?php
	require '../require/adm-aut.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastrar plano</title>
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
	<script type="text/javascript">
		

		function validaCampo(){
			if(document.form_plano.nome.value==""){
				alert("O Campo nome do plano é obrigatório!");
				document.getElementById('txtNome').focus();
				return false;
				
			}else if(document.form_plano.valor.value==""){
				alert("O Campo valor do plano é obrigatório!");
				document.getElementById('txtValor').focus();
				return false;	

			}else if(document.form_plano.qt_horas.value==""){
				alert("O Campo quantidade de horas é obrigatório!");
				document.getElementById('txtQuantidadeHoras').focus();
				return false;
						
			}else if(document.form_plano.valor_hr_excedente.value==""){
				alert("O Campo valor da hora excedente é obrigatório!");
				document.getElementById('txtValorHoraExcedente').focus();
				return false;
			}
		}		
	</script>
	<h3>Cadastro de Planos</h3>
	<form role='form' class='text-center' method="post" action=" " name="form_plano" onsubmit="return validaCampo(); return false;"> 
		<div class='form-group col-sm-6'>
			<label for='txtNome'>Nome:</label>
			<input type='text' class='form-control' id='txtNome' name="nome" placeholder='Ex: Plano executivo 1, Plano passeio...'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='txtValor'>Valor:</label>
			<input type='text' class='form-control' id='txtValor' name="valor" placeholder='Digite o valor do plano'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='txtQuantidadeHoras'>Quantidade de horas:</label>
			<input type='text' class='form-control' id='txtQuantidadeHoras' name="qt_horas" placeholder='Digite a quantidade de horas'>
		</div>
		<div class='form-group col-sm-6'>
			<label for='txtValorHoraExcedente'>Hora excedente:</label>
			<input type='text' class='form-control' id='txtValorHoraExcedente' name="valor_hr_excedente" placeholder='Digite o valor da hora excedente'>
		</div>
		<div class='form-group col-sm-12'>
			<label for='txtDescricao'>Descri&ccedil;&atilde;o:</label>
			<textarea class='form-control' id='txtDescricao' name="descricao" placeholder='Digite alguma descri&ccedil;&atilde;o para o plano (opcional)'></textarea>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroSalvarPlano'></span>
			<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
			<input type='submit' id='btnSalvar' class='btn cmd-item' name="btnSalvar" value='Salvar' />
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

				$nome=addslashes($_POST["nome"]);
	 			$valor=addslashes($_POST["valor"]);
	 			$qt_horas=addslashes($_POST["qt_horas"]);
	 			$valor_hr_excedente=addslashes($_POST["valor_hr_excedente"]);
	 			$descricao=addslashes($_POST["descricao"]);
	 			
				$sql="INSERT INTO plano values('NULL','$nome','$valor','$qt_horas', '$valor_hr_excedente', '$descricao')";
				$pega=dbConsulta($sql,'estacionamento', $conexao);
				
				if(!$pega){
					echo "<script language=javascript>alert( 'Falha ao cadastrar o Plano !!!' );</script>";
				}else{
					echo "<script language=javascript>alert( 'Novo Plano Cadastrado com Sucesso !!!' );</script>";
				}
				mysql_close($conexao);
		}				

















	?>
</html>