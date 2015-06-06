<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastro de usuário</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
		
		<script>
			
			$(document).ready(function() {
				$("#txtDataNascimento").mask("99/99/9999");
				$("#txtTelefone1").mask("(99) 9999-9999");
				$("#txtTelefone2").mask("(99) 9999-9999");
				$("#txtCpfCnpj").mask("999.999.999-99");
				$("#txtCep").mask("99.999-999");
			});
			
			
		</script>
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
	</head>
	<body class='bg-content'>
		<div class="container-fluid bg-info bg-content">
			<div class="row offset-top-and-bottom-1 bg-content"> 
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6 text-center">
					<h3>Novo cadastro de usuário</h3>
					<form role='form' class='text-center'>
						<div class='form-group text-left col-sm-6'>
							<label for='txtNomeCompleto'>Nome completo:</label>
							<input type='text' class='form-control' id='txtNomeCompleto' placeholder='Ex: Pedro Pedreira, João Joaninha...'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtDataNascimento'>Data de nascimento:</label>
							<input type='text' class='form-control' id='txtDataNascimento'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label> Tipo de pessoa:</label>
							<input type='radio' name='rdbTipoPessoa' id='rdbPessoaFisica' checked='checked' /> Física
							<input type='radio' name='rdbTipoPessoa' id='rdbPessoaJuridica' /> Jurídica
							<input type='text' class='form-control' id='txtCpfCnpj' />
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtTelefone'>Telefone: </label>
							<input type='radio' name='rdbDigitosTelefone' id='rdbTelefone8Digitos' checked='checked' /> 8
							<input type='radio' name='rdbDigitosTelefone' id='rdbTelefone9Digitos' /> 9 dígitos
							<input type='text' class='form-control' id='txtTelefone1'/>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtLogradouro'>Logradouro:</label>
							<input type='text' class='form-control' id='txtLogradouro' placeholder='Ex: Avenida São Pedro, Rua das Lagoas...'>
						</div>
						<div class='form-group text-left col-sm-3'>
							<label for='txtNumero'>Número:</label>
							<input type='text' class='form-control' id='txtNumero' placeholder='Digite o valor da hora excedente'>
						</div>
						<div class='form-group text-left col-sm-3'>
							<label for='txtCep'>CEP:</label>
							<input type='text' class='form-control' id='txtCep'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtBairro'>Bairro:</label>
							<input type='text' class='form-control' id='txtBairro' placeholder='Ex: Avenida São Pedro, Rua das Lagoas...'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label class='' for='txtComplemento'>Complemento:</label>
							<input type='text' class='form-control' id='txtComplemento' placeholder='Ex: Avenida São Pedro, Rua das Lagoas...'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtCidade'>Cidade:</label>
							<input type='text' class='form-control' id='txtTelefone' placeholder='Ex: Avenida São Pedro, Rua das Lagoas...'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='sltEstado'>Estado:</label>
							<select class='form-control'>
								
							</select>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtEmail'>E-Mail:</label>
							<input type='text' class='form-control' id='txtTelefone' placeholder='Ex: email@email.com'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtUsername'>Username:</label>
							<input type='text' class='form-control' id='txtUsername' placeholder='Ex: Avenida São Pedro, Rua das Lagoas...'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtSenha'>Senha:</label>
							<input type='password' class='form-control' id='txtSenha' placeholder='*******'>
						</div>
						<div class='form-group text-left col-sm-6'>
							<label for='txtConfirmacaoSenha'>Confirmação de senha:</label>
							<input type='password' class='form-control' id='txtConfirmacaoSenha' placeholder='*******'>
						</div>
						<div class='form-group col-sm-12 text-right'>
							<span id='spnErroSalvarPlano'></span> &nbsp;
							<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
							<input type='button' id='btnSalvar' class='btn cmd-item' value='Salvar' />
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
<!--	
    <div class="container">

      <form class="form-cad">
        <h2 class="form-cad-heading">CADASTRO CLIENTE</h2>
        <label for="inputNome" class="sr-only">Nome Completo</label>
        <div style="  width: 350px; position: relative; float: left;"><input type="text" id="inputNome" class="form-control" style= "width: 300px;"placeholder="Nome completo" required autofocus></div>
         <label for="inputCPF" class="sr-only">CPF</label>
        <div width: 180px; position: relative; float: left;"><input type="text" id="inputCPF" class="form-control" placeholder="CPF" style= "width: 180px;" required autofocus></div>
        <label for="inputLogradouro" class="sr-only">Logradouro</label>
        <div style="  width: 350px; position: relative; float: left;"><input type="text" id="inputLogradouro" class="form-control" style= "width: 350px;" placeholder="Logradouro" required autofocus></div>
         <label for="inputNumero" class="sr-only">Numero</label>
        <div width: 180px; position: relative; float: left;"><input type="text" id="inputNumero" class="form-control" placeholder="Numero" style= "width: 180px;" required autofocus></div>
        <label for="inputBairro" class="sr-only">Bairro</label>
        <div style="  width: 350px; position: relative; float: left;"><input type="text" id="inputBairro" class="form-control" style= "width: 350px;" placeholder="Bairro" required autofocus></div>
         <label for="inputCEP" class="sr-only">CEP</label>
        <div width: 180px; position: relative; float: left;"><input type="text" id="inputCEP" class="form-control" placeholder="CEP" style= "width: 180px;" required autofocus></div>
        <label for="inputTelefone" class="sr-only">Telefone</label>
        <div style= "width: 380px; position: relative; float: left;"><input type="text" id="inputCidade" class="form-control" placeholder="Cidade" style= "width: 300px;" required autofocus></div>
        <label for="inputCidade" class="sr-only">Cidade</label>
                      <label for="inputEstado" class="sr-only">Estado:</label>       
                      <div style= "width: 150px; position: relative; float: left;">
                        <select id="selectEstado" class="form-control" name="estado" placeholder="Estado" style= "width: 150px;">
                            <option value="Estado"> Estado </option>
                            <option value="AC" <?php if (!(strcmp('AC', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AC</option>
                            <option value="AL" <?php if (!(strcmp('AL', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AL</option>
                            <option value="AP" <?php if (!(strcmp('AP', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AP</option>
                            <option value="AM" <?php if (!(strcmp('AM', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AM</option>
                            <option value="BA" <?php if (!(strcmp('BA', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BA</option>
                            <option value="CE" <?php if (!(strcmp('CE', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>CE</option>
                            <option value="DF" <?php if (!(strcmp('DF', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>DF</option>
                            <option value="ES" <?php if (!(strcmp('ES', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>ES</option>
                            <option value="GO" <?php if (!(strcmp('GO', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>GO</option>
                            <option value="MA" <?php if (!(strcmp('MA', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>MA</option>
                            <option value="MT" <?php if (!(strcmp('MT', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>MT</option>
                            <option value="MS" <?php if (!(strcmp('MS', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>MS</option>
                            <option value="MG" <?php if (!(strcmp('MG', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>MG</option>
                            <option value="PA" <?php if (!(strcmp('PA', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PA</option>
                            <option value="PB" <?php if (!(strcmp('PB', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PB</option>
                            <option value="PR" <?php if (!(strcmp('PR', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PR</option>
                            <option value="PE" <?php if (!(strcmp('PE', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PE</option>
                            <option value="PI" <?php if (!(strcmp('PI', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PI</option>
                            <option value="RJ" <?php if (!(strcmp('RJ', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>RJ</option>
                            <option value="RN" <?php if (!(strcmp('RN', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>RN</option>
                            <option value="RS" <?php if (!(strcmp('RS', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>RS</option>
                            <option value="RO" <?php if (!(strcmp('RO', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>RO</option>
                            <option value="RR" <?php if (!(strcmp('RR', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>RR</option>
                            <option value="SC" <?php if (!(strcmp('SC', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>SC</option>
                            <option value="SP" <?php if (!(strcmp('SP', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>SP</option>
                            <option value="SE" <?php if (!(strcmp('SE', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>SE</option>
                            <option value="TO" <?php if (!(strcmp('TO', htmlentities($estado, ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>TO</option>

                        </select>
                      </div>

        <div style= "width: 200px; position: relative; float: left;"><input type="text" id="inputTelefone" class="form-control" style= "width: 200px;" placeholder="Telefone" required autofocus></div>
        <label for="inputEmail" class="sr-only">Email</label>
        <div style= "width: 300px; position: relative; float: left;"><input type="email" id="inputEmail" class="form-control" style= "width: 330px;" placeholder="Email address" required autofocus></div>
        <label for="inputPassword" class="sr-only">Password</label>
        <div style= "width: 300px; position: relative; float: left;"><input type="password" id="inputPassword" class="form-control" style= "width: 230px;" placeholder="Password" required></div>
        <label for="inputPasswordRep" class="sr-only">Confirma Password</label>
        <div style= "width: 230px; position: relative; float: left;"><input type="password" id="inputPasswordRep" class="form-control" style= "width: 230px;" placeholder="Confirma Password" required></div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" style="width: 200px;">Sign in</button>
      </form>

     <button type="submit" id="botao_sair" name="sair" class="btn-danger botao_sair" >&#10008; Sair</button>


  </body>