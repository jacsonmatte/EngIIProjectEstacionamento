<?php
	session_start();
	//comment
?>
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
			function habilita(v) {
				if (v == 1) {
        			$("#txtCpfCnpj").mask('999.999.999-99'); 
    			} else {
        			$("#txtCpfCnpj").mask('99.999.999/9999-99');
    			}
			}  

			function habilita_tel(v){
				if (v == 1) {  
        			$("#txtTelefone").mask('(99) 9999-9999');
    			} else {  
        			$("#txtTelefone").mask('(99) 99999-9999');		  
    			}
			}
			
			$(document).ready(function() {
				$("#txtDataNascimento").mask("99/99/9999");
				$("#txtCep").mask("99.999-999");
			});

			function validaCampo(){
				var er = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
				var nome = $("#txtNomeCompleto").val();
				if (nome.lenght < 5 || nome.trim().indexOf(" ") <= 0) {
					alert("Informe o nome completo!");
					document.getElementById('txtNomeCompleto').focus();
					return;
				}
				else if(!validarCPF($("#txtCpfCnpj").val()) && !validarCNPJ($("#txtCpfCnpj").val())){
					alert("O CPF/CNPJ digitado é inválido!");
					document.getElementById('txtCpfCnpj').focus();
					return;	
				}
				else if($("#txtTelefone").val().replace(/^d/).length < 10){
					alert("O telefone está incompleto!");
					document.getElementById('txtTelefone').focus();
					return;					
				}
				else if($("#txtLogradouro").val() == ''){
					alert("O campo logradouro é obrigatório!");
					document.getElementById('txtLogradouro').focus();
					return;
				}else if($("#txtCep").val() == ''){
					alert("O Campo CEP é obrigatório!");
					document.getElementById('txtCep').focus();
					return;
				}
				else if($("#txtCidade").val() == ''){
					alert("O Campo cidade é obrigatório!");
					document.getElementById('txtCidade').focus();
					return;	
				}
				else if(!er.test($("#txtEmail").val())){
					alert("O email informado é inválido!");
					document.getElementById('txtEmail').focus();
					return;				
				}
				else if($("#txtSenha").val() == ''){
					alert("O Campo senha é obrigatório!");
					document.getElementById('txtSenha').focus();
					return;
				}
				else if($("#txtSenhaRep").val() != $("#txtSenha").val()){
					alert("A confirmação de senha deve ser igual a senha!");
					document.getElementById('txtSenhaRep').focus();
					return;
				}
				document.forms["frmCadastro"].submit();
			}
			
		</script>
    	
	</head>

<?php
	require "../bd/conectBd.php";
	
	function validaCPF($cpf = null) {
	 
		// Verifica se um número foi informado
		if(empty($cpf)) {
			return false;
		}
	 
		// Elimina possivel mascara
		$cpf = ereg_replace('[^0-9]', '', $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		 
		// Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se nenhuma das sequências invalidas abaixo 
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' || 
			$cpf == '11111111111' || 
			$cpf == '22222222222' || 
			$cpf == '33333333333' || 
			$cpf == '44444444444' || 
			$cpf == '55555555555' || 
			$cpf == '66666666666' || 
			$cpf == '77777777777' || 
			$cpf == '88888888888' || 
			$cpf == '99999999999') {
			return false;
		 // Calcula os digitos verificadores para verificar se o
		 // CPF é válido
		 } else {   
			 
			for ($t = 9; $t < 11; $t++) {
				 
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}
	 
			return true;
		}
	}
	
	if(isset($_POST["nome"])){
		$nome = addslashes($_POST["nome"]);
		$cpf_cnpj = addslashes($_POST["cpf_cnpj"]);
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
		
		gravaCliente($nome, $cpf_cnpj, $email, $logradouro, $nro, $cep, $bairro, $cidade, $estado, $telefone, $senha, $_SESSION['username']);
		
	}
	$dados = loadCliente($_SESSION['username']);
?>
	
<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<title>Control Parking - Contratar plano</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
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
					<h3>Cadastro de usuário</h3>
					<form role='form' class='text-center' method="post" actions="meusdados.php" name="cadastro" id='frmCadastro'>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtNomeCompleto'>Nome completo:</label>
							<input type='text' class='form-control' id='txtNomeCompleto' name="nome"  value="<?php echo $dados['nome']; ?>">
						</div>
						
						<div class='form-group  text-left col-sm-6'>
							<label> Tipo de pessoa:</label>

							<?php
								if (strlen($dados['cpf_cnpj']) == 11) {
									echo "<input type='radio' disabled='disabled' name='rdbTipoPessoa' id='rdbPessoaFisica' checked='checked' onclick='habilita(1)' /> Física <input type='radio'  disabled='disabled' name='rdbTipoPessoa' id='rdbPessoaJuridica' onclick='habilita(2)'/> Jurídica (CNPJ)<script type='text/javascript'> habilita(1); </script>";
								}
								else {
									echo "<input type='radio' disabled='disabled' name='rdbTipoPessoa' id='rdbPessoaFisica' onclick='habilita(1)' /> Física<input type='radio' disabled='disabled' name='rdbTipoPessoa' id='rdbPessoaJuridica' checked='checked' onclick='habilita(2)'/> Jurídica (CNPJ)<script type='text/javascript'> habilita(2); </script>";
								}
							?>
							<input type='text' class='form-control'  disabled='disabled' id='txtCpfCnpj' name="cpf_cnpj" class="cpf_cnpj" value="<?php echo $dados['cpf_cnpj']; ?>"/>
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
							<?php
							if (strlen($dados['telefone']) == 10)
								echo "<input type='radio' name='rdbTelefone' id='rdbTelefone1' checked='checked' onclick='habilita_tel(1)' /> 8 dígitos<input type='radio' name='rdbTelefone' id='rdbTelefone1' onclick='habilita_tel(2)' /> 9 dígitos <script type='text/javascript'>habilita_tel(1);</script>";
							else
								echo "<input type='radio' name='rdbTelefone' id='rdbTelefone1' onclick='habilita_tel(1)' /> 8 dígitos<input type='radio' name='rdbTelefone' id='rdbTelefone1' checked='checked' onclick='habilita_tel(2)' /> 9 dígitos <script type='text/javascript'>habilita_tel(2);</script>";
							?>
							
							<input type='text' class='form-control' name="telefone" id='txtTelefone' value="<?php echo $dados['telefone']; ?>"/>
						</div>
						<div class='form-group  text-left col-sm-6'>

							<label for='txtEmail'>senha:</label>
							<input type='password' class='form-control' id='txtSenha' name="senha"  value="<?php echo $dados['senha']; ?>"/>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtEmail'>Repetir Senha:</label>
							<input type='password' class='form-control' id='txtSenhaRep' name="senhaRep" onBlur="valida_senha(cadastro.senha, cadastro.senhaRep);" value="<?php echo $dados['senha']; ?>"/>
						</div>				
						<div class='form-group col-sm-12 text-right'>
							<span id='spnErroSalvarPlano'></span> &nbsp;
							<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
							<input type='button' name="btnSalvar" id='btnSalvar' onclick="validaCampo();" class='btn cmd-item' value='Salvar' />
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
	</body>
</html>