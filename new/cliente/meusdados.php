<!DOCTYPE html>

<html lang="pt-br">
	<head>

<?php
	require '../require/cliente-aut.php';
	require "../bd/conectBd.php";
	
	if(isset($_POST["nome"])){
		$nome = addslashes($_POST["nome"]);
		$email = addslashes($_POST["email"]);
		$logradouro = addslashes($_POST["logradouro"]);
		$nro = addslashes($_POST["nro"]);
		$cep = addslashes($_POST["cep"]);
		$cep = ereg_replace('[^0-9]', '', $cep); // remove a máscara
		$bairro = addslashes($_POST["bairro"]);
		$cidade = addslashes($_POST["cidade"]);
		$estado = addslashes($_POST["estado"]);
		$telefone = addslashes($_POST["telefone"]);
		$telefone = ereg_replace('[^0-9]', '', $telefone);
		$senha = addslashes($_POST["senha"]);
		if (gravaCliente($nome, $email, $logradouro, $nro, $cep, $bairro, $cidade, $estado, $telefone, $senha, $_SESSION['username']) == 1)
			echo "<input type='hidden' id='hddAtualizado' value='1' />";
		else
			echo "<input type='hidden' id='hddAtualizado' value='0' />";
	}
	$dados = loadCliente($_SESSION['username']);
?>
		<title>Control Parking - Contratar plano</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
		<script type='text/javascript'>
			function setarCampoCpfCnpj(v) {
				$("#txtCpfCnpj").val(v);
				if (v.length == 11) {
        			$("#txtCpfCnpj").mask('999.999.999-99');
					$("#rdbPessoaFisica").prop("checked", "checked");
				}
				else {
					$("#rdbPessoaJuridica").prop("checked", "checked");
					$("#txtCpfCnpj").mask('99.999.999/9999-99');
				}
			}  

			function setarValorTelefone(v) {
				$("#txtTelefone").val(v);
				habilitaTelefoneOitoNoveDigitos(v.length == 10 ? false : true);
			}
			
			function habilitaTelefoneOitoNoveDigitos(v){
				if (!v) {
        			$("#txtTelefone").mask("(99) 9999-9999");
					$("#ckbTelefoneNoveDigitos").attr("checked", false);
				}
    			else {
					$("#ckbTelefoneNoveDigitos").prop("checked", "checked");
        			$("#txtTelefone").mask("(99) 99999-9999");		  
				}
			}
			
			$(document).ready(function() {
				$("#txtDataNascimento").mask("99/99/9999");
				$("#txtCep").mask("99.999-999");
			});

			function validaCampos(){
				var er = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
				var nome = $("#txtNomeCompleto").val();

				$("#spnErroSalvarMeusDados").text('');
				if (nome.length < 5 || nome.trim().indexOf(" ") <= 0) {
					$("#spnErroSalvarMeusDados").text("Informe o nome completo!");
					$('#txtNomeCompleto').focus();
					return;
				}
				if($("#txtLogradouro").val() == ''){
					$("#spnErroSalvarMeusDados").text("Informe o logradouro corretamente!");
					$('#txtLogradouro').focus();
					return;
				}
				if($("#txtNumero").val() == '' || isNaN($("#txtNumero").val())){
					$("#spnErroSalvarMeusDados").text("Informe o número corretamente!");
					$('#txtLogradouro').focus();
					return;
				}
				if($("#txtCep").val() == ''){
					$("#spnErroSalvarMeusDados").text("Informe o CEP corretamente!");
					$('#txtCep').focus();
					return;
				}
				if($("#txtCidade").val() == ''){
					$("#spnErroSalvarMeusDados").text("Informe a cidade corretamente!");
					$('#txtCidade').focus();
					return;	
				}
				if(!er.test($("#txtEmail").val())){
					$("#spnErroSalvarMeusDados").text("Informe um email válido!");
					document.getElementById('txtEmail').focus();
					return;				
				}
				if($("#txtTelefone").val() == ''){
					$("#spnErroSalvarMeusDados").text("Informe o telefone corretamente!");
					$('#txtTelefone').focus();
					return;					
				}
				if($("#txtSenha").val() == ''){
					$("#spnErroSalvarMeusDados").text("Informe a senha!");
					$('#txtSenha').focus();
					return;
				}
				if($("#txtSenhaRep").val() != $("#txtSenha").val()){
					$("#spnErroSalvarMeusDados").text("A confirmação de senha deve ser igual a senha!");
					$('#txtSenhaRep').focus();
					return;
				}
				$("#spnErroSalvarMeusDados").removeClass("label-danger").addClass("label-success");
				$("#spnErroSalvarMeusDados").text("Tudo certo! Atualizando seu cadastro...");
				setTimeout(function () { document.forms["frmCadastro"].submit(); }, 2000);
			}
			
			function resultadoAtualizacao() {
				if ($("#hddAtualizado").val() == true) {
					$("#spnErroSalvarMeusDados").removeClass("label-danger").addClass("label-success");
					$("#spnErroSalvarMeusDados").text("Cadastro atualizado com sucesso...");
				}
				else if ($("#hddAtualizado").val() == false) {
					$("#spnErroSalvarMeusDados").removeClass("label-success").addClass("label-danger");
					$("#spnErroSalvarMeusDados").text("Cadastro não atualizado...");
				}
			}
			
		</script>
	</head>
	<?php
		require '../require/menu-1.html';
		//$_SESSION['username'] = 'teste';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 
	<body class='bg-content'>
		<div class="container-fluid bg-info bg-content">
			<div class="row offset-top-and-bottom-1 bg-content"> 
				<div class="col-sm-1">
				</div>
				<div class="col-sm-10 text-center">
					<h3>Meus dados</h3>
					<form role='form' class='text-center' method="post" actions="meusdados.php" name="cadastro" id='frmCadastro'>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtNomeCompleto'>Nome completo:</label>
							<input type='text' class='form-control' id='txtNomeCompleto' name="nome"  value="<?php echo $dados['nome']; ?>">
						</div>					
						<div class='form-group  text-left col-sm-6'>
							<label title='Escolha CPF para cadastrar uma pessoa física ou CNPJ para cadastrar uma pessoa jurídica'>
							<input type='radio' disabled='disabled' name='rdbTipoPessoa' id='rdbPessoaFisica' /> CPF
							<input type='radio'  disabled='disabled' name='rdbTipoPessoa' id='rdbPessoaJuridica' /> CNPJ</label>
							<input type='text' class='form-control' disabled='disabled' id='txtCpfCnpj' name="cpf_cnpj" class="cpf_cnpj"/>
							<?php
								echo "<script type='text/javascript'> setarCampoCpfCnpj('" . $dados['cpf_cnpj'] . "'); </script>";
							?>
						</div>
						
						<div class='form-group  text-left col-sm-6'>
							<label for='txtLogradouro'>Logradouro:</label>
							<input type='text' class='form-control' id='txtLogradouro' name="logradouro" value="<?php echo $dados['logradouro']; ?>">
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='sltEstado'>Estado:</label>
							<select class='form-control' id="txtEstado" name="estado">
								<?php if ($dados['estado'] == "AC") { ?>
										<option value="AC"  selected="selected">AC</option>
								<?php }else{ ?>
										<option value="AC">AC</option>
								<?php } ?>
								<?php if ($dados['estado'] == "AL"){ ?>
										<option value="AL"  selected="selected">AL</option>
								<?php }else{ ?>
										<option value="AL">AL</option>
								<?php } ?>
								<?php if ($dados['estado'] == "AP"){ ?>
										<option value="AP"  selected="selected">AP</option>
								<?php }else{ ?>
										<option value="AP">AP</option>
								<?php } ?>
								<?php if ($dados['estado'] == "AM"){ ?>
										<option value="AM"  selected="selected">AM</option>
								<?php }else{ ?>
										<option value="AM">AM</option>
								<?php } ?>
								<?php if ($dados['estado'] == "AM"){ ?>
										<option value="BA"  selected="selected">BA</option>
								<?php }else{ ?>
										<option value="BA">BA</option>
								<?php } ?>
								<?php if ($dados['estado'] == "CE"){ ?>
										<option value="CE"  selected="selected">CE</option>
								<?php }else{ ?>
										<option value="CE">CE</option>
								<?php } ?>
								<?php if ($dados['estado'] == "DF"){ ?>
										<option value="DF"  selected="selected">DF</option>
								<?php }else{ ?>
										<option value="DF">DF</option>
								<?php } ?>
								<?php if ($dados['estado'] == "ES"){ ?>
										<option value="ES"  selected="selected">ES</option>
								<?php }else{ ?>
										<option value="ES">ES</option>
								<?php } ?>
								<?php if ($dados['estado'] == "GO"){ ?>
										<option value="GO"  selected="selected">GO</option>
								<?php }else{ ?>
										<option value="GO">GO</option>
								<?php } ?>
								<?php if ($dados['estado'] == "MA"){ ?>
										<option value="MA"  selected="selected">MA</option>
								<?php }else{ ?>
										<option value="MA">MA</option>
								<?php } ?>
								<?php if ($dados['estado'] == "MT"){ ?>
										<option value="MT"  selected="selected">MT</option>
								<?php }else{ ?>
										<option value="MT">MT</option>
								<?php } ?>
								<?php if ($dados['estado'] == "MS"){ ?>
										<option value="MS"  selected="selected">MS</option>
								<?php }else{ ?>
										<option value="MS">MS</option>
								<?php } ?>
								<?php if ($dados['estado'] == "MG"){ ?>
										<option value="MG"  selected="selected">MG</option>
								<?php }else{ ?>
										<option value="MG">MG</option>
								<?php } ?>
								<?php if ($dados['estado'] == "PA"){ ?>
										<option value="PA"  selected="selected">PA</option>
								<?php }else{ ?>
										<option value="PA">PA</option>
								<?php } ?>
								<?php if ($dados['estado'] == "PB"){ ?>
										<option value="PB"  selected="selected">PB</option>
								<?php }else{ ?>
										<option value="PB">PB</option>
								<?php } ?>
								<?php if ($dados['estado'] == "PR"){ ?>
										<option value="PR"  selected="selected">PR</option>
								<?php }else{ ?>
										<option value="PR">PR</option>
								<?php } ?>
								<?php if ($dados['estado'] == "PE"){ ?>
										<option value="PE"  selected="selected">PE</option>
								<?php }else{ ?>
										<option value="PE">PE</option>
								<?php } ?>
								<?php if ($dados['estado'] == "PI"){ ?>
										<option value="PI"  selected="selected">PI</option>
								<?php }else{ ?>
										<option value="PI">PI</option>
								<?php } ?>
								<?php if ($dados['estado'] == "RJ"){ ?>
										<option value="RJ"  selected="selected">RJ</option>
								<?php }else{ ?>
										<option value="RJ">RJ</option>
								<?php } ?>
								<?php if ($dados['estado'] == "RN"){ ?>
										<option value="RN"  selected="selected">RN</option>
								<?php }else{ ?>
										<option value="RN">RN</option>
								<?php } ?>
								<?php if ($dados['estado'] == "RS"){ ?>
										<option value="RS"  selected="selected">RS</option>
								<?php }else{ ?>
										<option value="RS">RS</option>
								<?php } ?>
								<?php if ($dados['estado'] == "RO"){ ?>
										<option value="RO"  selected="selected">RO</option>
								<?php }else{ ?>
										<option value="RO">RO</option>
								<?php } ?>
								<?php if ($dados['estado'] == "RR"){ ?>
										<option value="RR"  selected="selected">RR</option>
								<?php }else{ ?>
										<option value="RR">RR</option>
								<?php } ?>
								<?php if ($dados['estado'] == "SC"){ ?>
										<option value="SC"  selected="selected">SC</option>
								<?php }else{ ?>
										<option value="SC">SC</option>
								<?php } ?>
								<?php if ($dados['estado'] == "SP"){ ?>
										<option value="SP"  selected="selected">SP</option>
								<?php }else{ ?>
										<option value="SP">SP</option>
								<?php } ?>
								<?php if ($dados['estado'] == "SE"){ ?>
										<option value="SE"  selected="selected">SE</option>
								<?php }else{ ?>
										<option value="SE">SE</option>
								<?php } ?>
								<?php if ($dados['estado'] == "TO"){ ?>
										<option value="TO"  selected="selected">TO</option>
								<?php }else{ ?>
										<option value="TO">TO</option>
								<?php } ?>
                            	
							</select>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtNumero'>Número:</label>
							<input type='text' class='form-control' id='txtNumero' name="nro" value="<?php echo $dados['nro']; ?>">
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtCep'>CEP:</label>
							<input type='text' class='form-control' name="cep" id='txtCep' value="<?php echo $dados['cep']; ?>">
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtBairro'>Bairro:</label>
							<input type='text' class='form-control' id='txtBairro' name="bairro" value="<?php echo $dados['bairro']; ?>">
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtCidade'>Cidade:</label>
							<input type='text' class='form-control' id='txtCidade' name="cidade" value="<?php echo $dados['cidade']; ?>">
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtEmail'>e-Mail:</label>
							<input type='email' class='form-control' id='txtEmail' name="email" value="<?php echo $dados['email']; ?>"/>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtTelefone'>Telefone: </label>
							<input type='checkbox' name='telefoneNoveDigitos' id='ckbTelefoneNoveDigitos' onchange="habilitaTelefoneOitoNoveDigitos(this.checked)" /> <label for='ckbTelefoneNoveDigitos' title='Marque esta opção para informar um telefone com 9 dígitos'>9 dígitos</label>
							<input type='text' class='form-control' name="telefone" id='txtTelefone'/>
							<?php
								echo "<script type='text/javascript'> setarValorTelefone('" . $dados['telefone'] . "');</script>";
							?>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtEmail'>Senha:</label>
							<input type='password' class='form-control' id='txtSenha' name="senha"  value="<?php echo $dados['senha']; ?>"/>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtEmail'>Repetir Senha:</label>
							<input type='password' class='form-control' id='txtSenhaRep' name="senhaRep" value="<?php echo $dados['senha']; ?>"/>
						</div>				
						<div class='form-group col-sm-12 text-right'>
							<span class="label label-danger" id='spnErroSalvarMeusDados'></span> &nbsp;
							<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
							<input type='button' name="btnSalvar" id='btnSalvar' onclick="validaCampos();" class='btn cmd-item' value='Salvar' />
						</div>
						<?php echo "<script type='text/javascript'> resultadoAtualizacao(); </script>"; ?>
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
	</body>
</html>