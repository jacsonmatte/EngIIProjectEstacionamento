<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastro de usuário</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
		<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
		<script type='text/javascript'>

			function recuperarCamposFormulario() {
				
				$("#txtNomeCompleto").val('<?php if (isset($_POST['nome'])) echo $_POST['nome']; ?>');
				$("#txtDataNascimento").val('<?php if (isset($_POST['dt_nasc'])) echo $_POST['dt_nasc']; ?>');
				<?php
					if (isset($_POST['cpf_cnpj'])) {
						if (strlen($_POST['cpf_cnpj']) == 14)
							echo '$("#rdbPessoaFisica").prop("checked", "checked");';
						else
							echo '$("#rdbPessoaJuridica").prop("checked", "checked"); ';
						echo "$('#txtCpfCnpj').val('" . $_POST['cpf_cnpj'] . "'); ";
					}
					if (isset($_POST['telefone'])) {
						if (strlen($_POST['telefone']) == 14)
							echo "$('#ckbTelefoneNoveDigitos').prop('checked', '');";
						else
							echo "$('#ckbTelefoneNoveDigitos').prop('checked', 'checked');";
						echo "$('#txtTelefone').val('" . $_POST['telefone'] . "'); ";
					}
				?>
				$("#txtLogradouro").val('<?php if (isset($_POST['logradouro'])) echo $_POST['logradouro']; ?>');
				$("#txtNumero").val('<?php if (isset($_POST['numero'])) echo $_POST['numero']; ?>');
				$("#txtCep").val('<?php if (isset($_POST['cep'])) echo $_POST['cep']; ?>');
				$("#txtComplemento").val('<?php if (isset($_POST['complemento'])) echo $_POST['complemento']; ?>');
				$("#txtBairro").val('<?php if (isset($_POST['bairro'])) echo $_POST['bairro']; ?>');
				$("#txtCidade").val('<?php if (isset($_POST['cidade'])) echo $_POST['cidade']; ?>');
				$("#sltEstado").val('<?php if (isset($_POST['estado'])) echo $_POST['estado']; ?>');
				$("#txtEmail").val('<?php if (isset($_POST['email'])) echo $_POST['email']; ?>');
				$("#txtUsername").val('<?php if (isset($_POST['login'])) echo $_POST['login']; ?>');

			}
		
			function habilitaCpfCnpj(v) { 
    			if (v == 1) {  
        			$("#txtCpfCnpj").mask("999.999.999-99"); 
    			} else {  
        			$("#txtCpfCnpj").mask("99.999.999/9999-99");	  
    			}     
			}  

			function habilitaTelefoneOitoNoveDigitos(v){
				if (!v)
        			$("#txtTelefone").mask("(99) 9999-9999");
    			else  
        			$("#txtTelefone").mask("(99) 99999-9999");		  
			}
			
			$(document).ready(function() {
				$("#txtCep").mask("99.999-999");
				$("#txtCpfCnpj").mask("999.999.999-99");
				$("#txtTelefone").mask("(99) 9999-9999");
			});

			function resultadoCadastro(sucesso, mensagem) {
				$("#spnErroSalvarCadastro").text(mensagem);
				if (sucesso) {
					$("#spnErroSalvarCadastro").removeClass("label-danger").addClass("label-success");
					setTimeout(function () { location.href = '../index.html'; }, 2000);  
				}
				else {
					$("#spnErroSalvarCadastro").removeClass("label-success").addClass("label-danger");
				}
				
			}
			
			function validaCampos() {
			
				// valor do campo nome colocado em outra variável para facilitar a leitura do código
				var nome = $("#txtNomeCompleto").val();
				$("#spnErroSalvarCadastro").text('');
				if (nome.lenght < 5 || nome.trim().indexOf(" ") <= 0) {
					$("#spnErroSalvarCadastro").text("Informe o nome completo!");
					$('#txtNomeCompleto').focus();
					return;
				}
				if ($("#txtDataNascimento").val() == '') { // se o campo não está preenchido totalmente, a propriedade value é ''
					$("#spnErroSalvarCadastro").text("Informe a data de nascimento!");
					$('#txtDataNascimento').focus();
					return;
				}
				if ($("#rdbPessoaFisica").prop("checked")) {
					if (!validarCPF($("#txtCpfCnpj").val())) {
						$("#spnErroSalvarCadastro").text("Informe um CPF válido!");
						$('#txtCpfCnpj').focus();
						return;
					}
				}
				else {
					if (!validarCNPJ($("#txtCpfCnpj").val())) {
						$("#spnErroSalvarCadastro").text("Informe um CNPJ válido!");
						$('#txtCpfCnpj').focus();
						return;	
					}
				}					
				if ($("#txtTelefone").val() == ""){
					$("#spnErroSalvarCadastro").text("Informe o telefone!");
					$('#txtTelefone').focus();
					return;					
				}
				if ($("#txtLogradouro").val().trim().indexOf(" ") <= 0) {
					$("#spnErroSalvarCadastro").text("Informe o logradouro corretamente!");
					$('#txtLogradouro').focus();
					return;
				}
				if ($("#txtNumero").val() == '' || isNaN($("#txtNumero").val())) {
					$("#spnErroSalvarCadastro").text("Informe o número corretamente!");
					$('#txtNumero').focus();
					return;
				}
				if ($("#txtCep").val() == ''){
					$("#spnErroSalvarCadastro").text("Informe o CEP!");
					$('#txtCep').focus();
					return;
				}
				if ($("#txtCidade").val() == '' || $("#txtCidade").val().lenght < 3){
					$("#spnErroSalvarCadastro").text("Informe a cidade corretamente!");
					$('#txtCidade').focus();
					return;	
				}
				if ($("#sltEstado").val() == '') {
					$("#spnErroSalvarCadastro").text("Informe o estado!");
					$('#sltEstado').focus();
					return;
				}
				if (!erEmail.test($("#txtEmail").val())){
					$("#spnErroSalvarCadastro").text("Informe um email válido!");
					$('#txtEmail').focus();
					return;				
				}
				if ($("#txtUsername").val() == '') {
					$("#spnErroSalvarCadastro").text("Informe o username!");
					$('#txtUsername').focus();
					return;
				}
				if ($("#txtSenha").val() == ''){
					$("#spnErroSalvarCadastro").text("Informe a senha!");
					$('#txtSenha').focus();
					return;
				}
				if($("#txtConfirmacaoSenha").val() != $("#txtSenha").val()){
					$("#spnErroSalvarCadastro").text("A confirmação de senha deve ser igual a senha!");
					$('#txtConfirmacaoSenha').focus();
					return;
				}
				$("#spnErroSalvarCadastro").removeClass("label-danger").addClass("label-success");
				$("#spnErroSalvarCadastro").text("Tudo certo! Salvando seu cadastro...");
				setTimeout(function () { document.forms["frmCadastro"].submit(); }, 2000);
				
			}
			
		</script>
    	
	</head>
	<body class='bg-content'>
		<div class="container-fluid bg-info bg-content">
			<div class="row offset-top-and-bottom-1 bg-content"> 
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6 text-center">
					<h3>Cadastro de usuário</h3>
					<form role='form' class='text-center' id='frmCadastro' method="post" actions="criar_cadastro.php" name="cadastro">
						<div class='form-group  text-left col-sm-6'>
							<label for='txtNomeCompleto'>Nome completo:</label>
							<input type='text' class='form-control' id='txtNomeCompleto' name="nome" placeholder='Ex: Pedro Pedreira'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtDataNascimento'>Data de nascimento:</label>
							<input type='date' class='form-control' name="dt_nasc" id='txtDataNascimento'>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label title='Escolha CPF para cadastrar uma pessoa física ou CNPJ para cadastrar uma pessoa jurídica'>
							<input type='radio' name='rdbTipoPessoa' id='rdbPessoaFisica' checked onclick="habilitaCpfCnpj(1)" /> CPF
							<input type='radio' name='rdbTipoPessoa' id='rdbPessoaJuridica' onclick="habilitaCpfCnpj(2)"/> CNPJ</label>
							<input type='text' class='form-control' id='txtCpfCnpj' name="cpf_cnpj" class="cpf_cnpj"/>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtTelefone'>Telefone: </label>
							<input type='checkbox' name='telefoneNoveDigitos' id='ckbTelefoneNoveDigitos' onchange="habilitaTelefoneOitoNoveDigitos(this.checked)" /> <label for='ckbTelefoneNoveDigitos' title='Marque esta opção para informar um telefone com 9 dígitos'>9 dígitos ?</label>
							<input type='text' class='form-control' name="telefone" id='txtTelefone'/>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtLogradouro'>Logradouro:</label>
							<input type='text' class='form-control' id='txtLogradouro' name="logradouro" placeholder='Ex: Avenida São Pedro, Rua das Lagoas...'>
						</div>
						<div class='form-group  text-left col-sm-2'>
							<label for='txtNumero'>Número:</label>
							<input type='text' class='form-control' id='txtNumero' name="numero" placeholder='Nº'>
						</div>
						<div class='form-group  text-left col-sm-4'>
							<label for='txtCep'>CEP:</label>
							<input type='text' class='form-control' name="cep" id='txtCep'>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtBairro'>Bairro:</label>
							<input type='text' class='form-control' id='txtBairro' name="bairro" placeholder='Ex: Bairro XXX...'>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtComplemento'>Complemento:</label>
							<input type='text' class='form-control' id='txtComplemento' name="complemento" placeholder='Complemento...'>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtCidade'>Cidade:</label>
							<input type='text' class='form-control' id='txtCidade' name="cidade" placeholder='Ex: Chapecó...'>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='sltEstado'>Estado:</label>
							<select class='form-control' id="sltEstado" name="estado">
								<option selected="selected" value="">Selecione</option>
                            	<option value="AC">AC</option>
                            	<option value="AL">AL</option>
                            	<option value="AP">AP</option>
                            	<option value="AM">AM</option>
                            	<option value="BA">BA</option>
                            	<option value="CE">CE</option>
                            	<option value="DF">DF</option>
                            	<option value="ES">ES</option>
                            	<option value="GO">GO</option>
                            	<option value="MA">MA</option>
                            	<option value="MT">MT</option>
                            	<option value="MS">MS</option>
                            	<option value="MG">MG</option>
                            	<option value="PA">PA</option>
                            	<option value="PB">PB</option>
                            	<option value="PR">PR</option>
                            	<option value="PE">PE</option>
                            	<option value="PI">PI</option>
                            	<option value="RJ">RJ</option>
                            	<option value="RN">RN</option>
                            	<option value="RS">RS</option>
                            	<option value="RO">RO</option>
                            	<option value="RR">RR</option>
                            	<option value="SC">SC</option>
                            	<option value="SP">SP</option>
                            	<option value="SE">SE</option>
                            	<option value="TO">TO</option>
							</select>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtEmail'>e-Mail:</label>
							<input type='email' class='form-control' id='txtEmail' name="email" placeholder='Ex: email@email.com'/>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtUsername'>Username:</label>
							<input type='text' class='form-control' id='txtUsername' name="login" placeholder='Usuário'/>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtSenha'>Senha:</label>
							<input type='password' class='form-control' id='txtSenha' name="senha" placeholder='*******'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtConfirmacaoSenha'>Confirmação de senha:</label>
							<input type='password' class='form-control' id='txtConfirmacaoSenha' name="conf_senha" placeholder='*******'>
						</div>
						
						<div class='form-group col-sm-12 text-right'>
							<span class="label label-danger" id='spnErroSalvarCadastro'></span> &nbsp;
							<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
							<input type='button' name="btnSalvar" id='btnSalvar' class='btn cmd-item' onclick="validaCampos();" value='Salvar' />
						</div>
					</form>
				</div>
				<div class="col-sm-3">
				</div>
			</div>				
		</div>
		<footer class='panel-footer'>
			<div class="text-center">
				Control Parking - Sistema de gerenciamento de estacionamentos | &copy 2015 | Desenvolvido por Non Static Void
			</div>
		</footer>
		<script type="text/javascript">
			$( "#btnCancelar").click(function() {
				$(location).attr('href', '../index.html');
			});
		</script>
		<?php

			if(isset($_POST["nome"])){
				echo $_POST["dt_nasc"];
				require_once("../bd/conectBd.php");
				$conexao=dbConnect("localhost","root","");
				$cadastroSalvo = false;
				$nome=addslashes($_POST["nome"]);
	 			$cpf_cnpj=addslashes($_POST["cpf_cnpj"]);
				$cpf_cnpj = ereg_replace('[^0-9]', '', $cpf_cnpj);
	 			$data_nasc=date($_POST["dt_nasc"]);
	 			$email=addslashes($_POST["email"]);
	 			$estado=addslashes($_POST["estado"]);
	 			$cidade=addslashes($_POST["cidade"]);
	 			$logradouro=addslashes($_POST["logradouro"]);
	 			$numero=addslashes($_POST["numero"]);
	 			$cep=addslashes($_POST["cep"]);
				$cep = ereg_replace('[^0-9]', '', $cep);
	 			$bairro=addslashes($_POST["bairro"]);
	 			$telefone=addslashes($_POST["telefone"]);
				$telefone = ereg_replace('[^0-9]', '', $telefone);
	 			$login=addslashes($_POST["login"]);
	 			$senha=addslashes($_POST["senha"]);
	 			$conf_senha=addslashes($_POST["conf_senha"]);

	 			$testa="SELECT * FROM usuario WHERE usuario.login='$login'";
	 			$pega=dbConsulta($testa,'estacionamento', $conexao);
	 			$numrow = @mysql_num_rows($pega);
				if($numrow > 0) {
	 				echo "<script type='text/javascript'> resultadoCadastro(false, 'O username escolhido não está disponível!');</script>";
	 			}
				else {
	 				if (strlen($estado) > 2) $estado = "XX";
					$sql="INSERT INTO cliente values('NULL','$nome','$cpf_cnpj','$email', '$logradouro','$numero', '$cep', '$bairro', '$cidade', '$estado', '$telefone')";
					$limite=dbConsulta($sql,'estacionamento', $conexao);
				
					if(!$limite){
						"<script type='text/javascript'> resultadoCadastro(false, 'Falha ao cadastrar!');</script>";
					}
					else {
						$conexao=dbConnect("localhost","root","");
						$sql="SELECT id_cliente FROM cliente where cpf_cnpj='$cpf_cnpj'";
						$busca_id=dbConsulta($sql,'estacionamento', $conexao);

						while($pega=mysql_fetch_array($busca_id)){
							$id=$pega["id_cliente"];
						}
						$sql="INSERT INTO usuario values('NULL','$senha','$login', '$id')";
						$limite=dbConsulta($sql,'estacionamento', $conexao);
						if(!$limite)
							echo "<script type='text/javascript'> resultadoCadastro(false, 'Falha ao cadastrar!');</script>";
						else {
							echo "<script type='text/javascript'> resultadoCadastro(true, 'Cadastro efetuado com sucesso!');</script>";
							$cadastroSalvo = true;
						}
					}
				}
				mysql_close($conexao);
				if (!$cadastroSalvo) {
					echo "<script type='text/javascript'> recuperarCamposFormulario();</script>";
				}
			}
		?>
	</body>
</html>