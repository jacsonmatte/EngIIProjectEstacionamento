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
		<script>
			function habilita(v) {  
    			if (v == 1) {  
        			$("#txtCpfCnpj").mask("999.999.999-99"); 
    			} else {  
        			$("#txtCpfCnpj").mask("99.999.999/9999-99");	  
    			}     
			}  

			function habilita_tel(v){
				if (v == 1) {  
        			$("#txtTelefone").mask("(99) 9999-9999");
    			} else {  
        			$("#txtTelefone").mask("(99) 99999-9999");		  
    			}   

			}
			
			$(document).ready(function() {
				$("#txtDataNascimento").mask("99/99/9999");
				$("#txtCep").mask("99.999-999");
			});

			function validaCampo(){
				if(document.cadastro.nome.value==""){
					alert("O Campo nome é obrigatório!");
					document.getElementById('txtNomeCompleto').focus();
					return false;
				
				}else if(document.cadastro.dt_nasc.value==""){
					alert("O Campo data de nascimento é obrigatório!");
					document.getElementById('txtDataNascimento').focus();
					return false;	

				}else if(document.cadastro.cpf_cnpj.value==""){
					alert("O Campo CPF ou CNPJ é obrigatório!");
					document.getElementById('txtCpfCnpj').focus();
					return false;

				}else if(valida_cpf_cnpj(document.cadastro.cpf_cnpj)){
					alert("O Campo CPF ou CNPJ digitado é inválido!");
					document.getElementById('txtCpfCnpj').focus();
					return false;	
					
				}else if(document.cadastro.telefone.value==""){
					alert("O Campo telefone é obrigatório!");
					document.getElementById('txtTelefone').focus();
					return false;					

				}else if(document.cadastro.logradouro.value==""){
					alert("O Campo logradouro é obrigatório!");
					document.getElementById('txtLogradouro').focus();
					return false;
				}else if(document.cadastro.cep.value==""){
					alert("O Campo CEP é obrigatório!");
					document.getElementById('txtCep').focus();
					return false;

				}else if(document.cadastro.bairro.value==""){
					alert("O Campo Bairro é obrigatório!");
					document.getElementById('txtBairro').focus();
					return false;
				}else if(document.cadastro.cidade.value==""){
					alert("O Campo cidade é obrigatório!");
					document.getElementById('txtCidade').focus();
					return false;	
				}else if(document.cadastro.estado.value==""){
					alert("O Campo Estado é obrigatório!");
					document.getElementById('txtEstado').focus();
					return false;	
					
				}else if(document.cadastro.email.value==""){
					alert("O Campo email é obrigatório!");
					document.getElementById('txtEmail').focus();
					return false;				
				}else if(document.cadastro.login.value==""){
					alert("O Campo login é obrigatório!");
					document.getElementById('txtUsername').focus();
					return false;
				}else if(document.cadastro.senha.value==""){
					alert("O Campo senha é obrigatório!");
					document.getElementById('txtsenha').focus();
					return false;
				}else if(document.cadastro.conf_senha.value==""){
					alert("O Campo de confirmação de senha é obrigatório!");
					document.getElementById('txtconfirmacaosenha').focus();
					return false;
				}else if(document.cadastro.conf_senha.value!=document.cadastro.senha.value){
					alert("As senhas digitadas nao são iguais!");
					document.getElementById('txtsenha').focus();
					return false;
				}							
			}

			
			function valida_cpf_cnpj ( valor ) {
 
    			// Verifica se é CPF ou CNPJ
    			var valida = verifica_cpf_cnpj( valor );
 
			    // Garante que o valor é uma string
    			valor = valor.toString();
    
   			 	// Remove caracteres inválidos do valor
    			valor = valor.replace(/[^\d]+/g,'');
 
 
    			// Valida CPF
    			if ( valida === 'CPF' ) {
        			// Retorna true para cpf válido
        			return valida_cpf( valor );
    			} 
    
    			// Valida CNPJ
   	 			else if ( valida === 'CNPJ' ) {
        			// Retorna true para CNPJ válido
        			return valida_cnpj( valor );
    			} 
    
   				// Não retorna nada
    			else {
        			return false;
    			}
    		}

			function verifica_cpf_cnpj ( valor ) {
 
    			// Garante que o valor é uma string
    			valor = valor.toString();
    
    			// Remove caracteres inválidos do valor
    			valor = valor.replace(/[^\d]+/g,'');
 
    			// Verifica CPF
    			if ( valor.length === 11 ) {
        			return 'CPF';
    			} 
    
    			// Verifica CNPJ
    			else if ( valor.length === 14 ) {
        			return 'CNPJ';
    			} 
    
    			// Não retorna nada
    			else {
        			return false;
    			}
    
			}

			$(function(){
 
    			// Aciona a validação ao sair do input
    			$('.cpf_cnpj').blur(function(){
    
        			// O CPF ou CNPJ
        			var cpf_cnpj = $(this).val();
        
        			// Testa a validação
        			if ( valida_cpf_cnpj( cpf_cnpj ) ) {
            			alert('OK');
        			} else {
            			alert('CPF ou CNPJ inválido!');
        			}
        
    			});
    
			});

			function valida_cnpj ( valor ) {
 
    			// Garante que o valor é uma string
   	 			valor = valor.toString();
    
    			// Remove caracteres inválidos do valor
    			valor = valor.replace(/[^\d]+/g,'');
 
    
    			// O valor original
    			var cnpj_original = valor;
 
    			// Captura os primeiros 12 números do CNPJ
    			var primeiros_numeros_cnpj = valor.substr( 0, 12 );
 
    			// Faz o primeiro cálculo
    			var primeiro_calculo = calc_digitos_posicoes( primeiros_numeros_cnpj, 5 );
 
    			// O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
    			var segundo_calculo = calc_digitos_posicoes( primeiro_calculo, 6 );
 
    			// Concatena o segundo dígito ao CNPJ
    			var cnpj = segundo_calculo;
 
    			// Verifica se o CNPJ gerado é idêntico ao enviado
    			if ( cnpj === cnpj_original ) {
	        		return true;
    			}
    
    			// Retorna falso por padrão
    			return false;
    
			}

			function valida_senha(senha, senhaRep){
				if (senha.value != senhaRep.value) {
					alert("Senha não confere");
					document.getElementById('btnSalvar').disabled = true;
				}else{

					if (senha.value == senhaRep.value) {
						document.getElementById('btnSalvar').disabled = false;
					};
				}

			}

			function salva(){
				alert("Dados Gravados com Sucesso!");
			}

			function valida_cpf( valor ) {
 
    			// Garante que o valor é uma string
    			valor = valor.toString();
    
    			// Remove caracteres inválidos do valor
    			valor = valor.replace(/[^\d]+/g,'');
  
    			// Captura os 9 primeiros dígitos do CPF
    			// Ex.: 02546288423 = 025462884
    			var digitos = valor.substr(0, 9);
 
    			// Faz o cálculo dos 9 primeiros dígitos do CPF para obter o primeiro dígito
    			var novo_cpf = calc_digitos_posicoes( digitos );
 
    			// Faz o cálculo dos 10 dígitos do CPF para obter o último dígito
    			var novo_cpf = calc_digitos_posicoes( novo_cpf, 11 );
 
    			// Verifica se o novo CPF gerado é idêntico ao CPF enviado
    			if ( novo_cpf === valor ) {
        			// CPF válido
        			return true;
    			} else {
        			// CPF inválido
        			return false;
    			}
    
			}
			
		</script>
    	
	</head>

<?php
	require "../bd/conectBd.php";
	if(isset($_POST["nome"])){
		$nome = addslashes($_POST["nome"]);
		$cpf_cnpj = addslashes($_POST["cpf_cnpj"]);
		$email = addslashes($_POST["email"]);
		$logradouro = addslashes($_POST["logradouro"]);
		$nro = addslashes($_POST["nro"]);
		$cep = addslashes($_POST["cep"]);
		$bairro = addslashes($_POST["bairro"]);
		$cidade = addslashes($_POST["cidade"]);
		$estado = addslashes($_POST["estado"]);
		$telefone = addslashes($_POST["telefone"]);
		$senha = addslashes($_POST["senha"]);
		//print_r($senha);
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
					<form role='form' class='text-center' method="post" actions="meusdados.php" name="cadastro" >
						<div class='form-group  text-left col-sm-6'>
							<label for='txtNomeCompleto'>Nome completo:</label>
							<input type='text' class='form-control' id='txtNomeCompleto' name="nome"  value="<?php echo $dados['nome']; ?>">
						</div>
						
						<div class='form-group  text-left col-sm-6'>
							<label> Tipo de pessoa:</label>

							<?php if (strlen($dados['cpf_cnpj']) == 14) { ?>
								<input type='radio' name='rdbTipoPessoa' id='rdbPessoaFisica' checked onclick="habilita(1)" /> Física
							<?php  }else {?>
								<input type='radio' name='rdbTipoPessoa' id='rdbPessoaFisica'  onclick="habilita(1)" /> Física
							<?php }?>
							<?php if (strlen($dados['cpf_cnpj']) == 18) { ?>
								<input type='radio' name='rdbTipoPessoa' id='rdbPessoaJuridica' checked onclick="habilita(2)"/> Jurídica (CNPJ)
							<?php  }else {?>
								<input type='radio' name='rdbTipoPessoa' id='rdbPessoaJuridica' onclick="habilita(2)"/> Jurídica (CNPJ)
							<?php }?>
							
							<input type='text' class='form-control' id='txtCpfCnpj' name="cpf_cnpj" class="cpf_cnpj" onBlur="validaCPF_CNPJ(cadastro.cpf_cnpj);" value="<?php echo $dados['cpf_cnpj']; ?>"/>
						</div>
						
						<div class='form-group  text-left col-sm-6'>
							<label for='txtLogradouro'>Logradouro:</label>
							<input type='text' class='form-control' id='txtLogradouro' name="logradouro" value="<?php echo $dados['logradouro']; ?>">
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='sltEstado'>Estado:</label>
							<select class='form-control' id="txtEstado" name="estado">
								<option selected>Selecione um Estado...</option>
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
							<input type='text' class='form-control' name="cep" id='txtCep' onBlur="ValidaCep(cadastro.cep);" value="<?php echo $dados['cep']; ?>">
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
							<?php if (strlen($dados['telefone']) == 14) { ?>
								<input type='radio' name='rdbTelefone' id='rdbTelefone1' checked onclick="habilita_tel(1)" /> 8 dígitos
							<?php  }else {?>
								<input type='radio' name='rdbTelefone' id='rdbTelefone1' onclick="habilita_tel(1)" /> 8 dígitos
							<?php }?>

							<?php if (strlen($dados['telefone']) == 15) { ?>
								<input type='radio' name='rdbTelefone' id='rdbTelefone2' checked onclick="habilita_tel(2)"/> 9 dígitos
							<?php  }else {?>
								<input type='radio' name='rdbTelefone' id='rdbTelefone2' onclick="habilita_tel(2)"/> 9 dígitos
							<?php }?>
							
							<input type='text' class='form-control' name="telefone" id='txtTelefone' value="<?php echo $dados['telefone']; ?>"/>
						</div>
						<div class='form-group  text-left col-sm-6'>

							<label for='txtEmail'>senha:</label>
							<input type='password' class='form-control' id='txtsenha' name="senha"  value="<?php echo $dados['senha']; ?>"/>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtEmail'>Repetir Senha:</label>
							<input type='password' class='form-control' id='txtSenhaRep' name="senhaRep" onBlur="valida_senha(cadastro.senha, cadastro.senhaRep);" value="<?php echo $dados['senha']; ?>"/>
						</div>				
						<div class='form-group col-sm-12 text-right'>
							<span id='spnErroSalvarPlano'></span> &nbsp;
							<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
							<input type='submit' name="btnSalvar" id='btnSalvar' onclick="salva();" class='btn cmd-item' value='Salvar' />
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
	
   
                            

