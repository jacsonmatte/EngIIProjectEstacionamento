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
			
			$(document).ready(function() {
				$("#txtDataNascimento").mask("99/99/9999");
				$("#txtTelefone").mask("(99) 9999-9999");
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
	<body class='bg-content'>
		<div class="container-fluid bg-info bg-content">
			<div class="row offset-top-and-bottom-1 bg-content"> 
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6 text-center">
					<h3>Cadastro de usuário</h3>
					<form role='form' class='text-center' method="post" actions="" name="cadastro" onsubmit="return validaCampo(); return false;">
						<div class='form-group  text-left col-sm-6'>
							<label for='txtNomeCompleto'>Nome completo:</label>
							<input type='text' class='form-control' id='txtNomeCompleto' name="nome" placeholder='Ex: Pedro Pedreira, João Joaninha...'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtDataNascimento'>Data de nascimento:</label>
							<input type='text' class='form-control' name="dt_nasc" id='txtDataNascimento'>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label> Tipo de pessoa:</label>
							<input type='radio' name='rdbTipoPessoa' id='rdbPessoaFisica' onclick="habilita(1)" /> Física
							<input type='radio' name='rdbTipoPessoa' id='rdbPessoaJuridica' onclick="habilita(2)"/> Jurídica
							<input type='text' class='form-control' id='txtCpfCnpj' name="cpf_cnpj" class="cpf_cnpj" onBlur="validaCPF_CNPJ(cadastro.cpf_cnpj);"/>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtTelefone'>Telefone: </label>
							<input type='text' class='form-control' name="telefone" id='txtTelefone'/>
						</div>
						<div class='form-group  text-left col-sm-9'>
							<label for='txtLogradouro'>Logradouro:</label>
							<input type='text' class='form-control' id='txtLogradouro' name="logradouro" placeholder='Ex: Avenida São Pedro, Rua das Lagoas...'>
						</div>
						<div class='form-group  text-left col-sm-3'>
							<label for='txtNumero'>Número:</label>
							<input type='text' class='form-control' id='txtNumero' name="numero" placeholder='nº'>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='txtCep'>CEP:</label>
							<input type='text' class='form-control' name="cep" id='txtCep' onBlur="ValidaCep(cadastro.cep);">
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
							<input type='text' class='form-control' id='txtcidade' name="cidade" placeholder='Ex: Chapecó...'>
						</div>
						<div class='form-group  text-left col-sm-6'>
							<label for='sltEstado'>Estado:</label>
							<select class='form-control' id="txtEstado" name="estado">
								<option selected>Selecione um Estado...</option>
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
							<input type='email' class='form-control' id='txtEmail' name="email" placeholder='Ex: email@email.com'>
						</div>
						
						<div class='form-group col-sm-12 text-right'>
							<span id='spnErroSalvarPlano'></span> &nbsp;
							<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
							<input type='submit' name="btnSalvar" id='btnSalvar' class='btn cmd-item' value='Salvar' />
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

		<?php

			if(isset($_POST["btnSalvar"])){
				
				require_once("../bd/conectBd.php");
				$conexao=dbConnect("localhost","root","");

				$nome=$_POST["nome"];
	 			$cpf_cnpj=$_POST["cpf_cnpj"];
	 			$data_nasc=$_POST["dt_nasc"];
	 			$email=$_POST["email"];
	 			$estado=$_POST["estado"];
	 			$cidade=$_POST["cidade"];
	 			$logradouro=$_POST["logradouro"];
	 			$numero=$_POST["numero"];
	 			$cep=$_POST["cep"];
	 			$bairro=$_POST["bairro"];
	 			$telefone=$_POST["telefone"];
	 			
	 			
				$sql="INSERT INTO cliente values('NULL', '$nome','$cpf_cnpj','$email', '$logradouro','$numero', '$cep', '$bairro', '$cidade', '$estado', '$telefone', '0')";
					
				$limite=dbConsulta($sql,'estacionamento', $conexao);
				
				if(!$limite){
					echo "<script>alert('Não foi possível cadastrar o cliente !!');</script>";
				}else{
						
					mysql_close($conexao);
					echo "<script>alert('Usuário Cadastrado com Sucesso !!');</script>";
					
		
					}	
			}		






		?>



	</body>
</html>
	
   
                            

