<?php

$pageId = $_POST['pageId'];
$notAuthorized = "Você não está autorizado a ver esta página!";
$_SESSION['user_type'] = $_GET['user_type'];

/* as páginas do administrador têm id < 0

	-1 Meus dados
	-2 Vagas
	-3 Nova vaga
	-4 Clientes
	-5 Planos
	-6 Novo plano
	-7 Reservas
	-8 Relatórios
	-9 Mensalidades

*/

/* as páginas do cliente têm id > 0

*/

if ($_SESSION['user_type'] == 1) {
	switch ($pageId) {
		case -1:
			echo("");
			break;
		case -2:
			echo("");
			break;
		case -3:
			echo("<h3>Cadastro de Vagas</h3>
					<form role='form' class='text-center'>
						<div class='form-group col-sm-6'>
							<label for='txtValor'>C&oacute;digo:</label>
							<input type='text' class='form-control' id='txtCodigo' placeholder='Digite o c&oacute;digo da vaga'>
						</div>
						<div class='form-group col-sm-6'>
							<label for='sltTipo'>Tipo de vaga:</label>
							<select class='form-control' id='sltTipo'>
								<option>Carro</option>
								<option>Moto</option>
								<option>Utilit&aacute;rio</option>
							</select>
						</div>
						<div class='form-group col-sm-12'>
							<label for='txtDescricao'>Descri&ccedil;&atilde;o:</label>
							<textarea class='form-control' id='txtDescricao' placeholder='Digite alguma descri&ccedil;&atilde;o para o plano (opcional)'></textarea>
						</div>
						<div class='form-group col-sm-12 text-right'>
							<span id='spnErroSalvarVaga'></span>
							<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
							<input type='button' id='btnSalvar' class='btn cmd-item' value='Salvar' />
						</div>
					</form>");
			break;
		case -4:
			echo("");
			break;
		case -5:
			echo("");
			break;
		case -6:
			echo("<h3>Cadastro de Planos</h3>
					<form role='form' class='text-center'>
						<div class='form-group col-sm-6'>
							<label for='txtNome'>Nome:</label>
							<input type='text' class='form-control' id='txtNome' placeholder='Ex: Plano executivo 1, Plano passeio...'>
						</div>
						<div class='form-group col-sm-6'>
							<label for='txtValor'>Valor:</label>
							<input type='text' class='form-control' id='txtValor' placeholder='Digite o valor do plano'>
						</div>
						<div class='form-group col-sm-6'>
							<label for='txtQuantidadeHoras'>Quantidade de horas:</label>
							<input type='text' class='form-control' id='txtQuantidadeHoras' placeholder='Digite a quantidade de horas'>
						</div>
						<div class='form-group col-sm-6'>
							<label for='txtValorHoraExcedente'>Hora excedente:</label>
							<input type='text' class='form-control' id='txtValorHoraExcedente' placeholder='Digite o valor da hora excedente'>
						</div>
						<div class='form-group col-sm-12'>
							<label for='txtDescricao'>Descri&ccedil;&atilde;o:</label>
							<textarea class='form-control' id='txtDescricao' placeholder='Digite alguma descri&ccedil;&atilde;o para o plano (opcional)'></textarea>
						</div>
						<div class='form-group col-sm-12 text-right'>
							<span id='spnErroSalvarPlano'></span>
							<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar' /> &nbsp;
							<input type='button' id='btnSalvar' class='btn cmd-item' value='Salvar' />
						</div>
					</form>");
			break;
		case -7:
			echo("");
			break;
		case -8:
			echo("");
			break;
		case -9:
			echo("");
			break;
		default: 
			echo($notAuthorized);
			break;
	}
}
else if ($_SESSION['user_type'] == 2) {
	switch ($pageId) {
		case 1:
			echo("");
			break;
		default: 
			echo($notAuthorized);
			break;
	}
}
else {
	echo("");
}

?>