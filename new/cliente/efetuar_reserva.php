<?php
	require '../require/cliente-aut.php';
	require '../dominio/constantes.php';
	require '../bd/conectBd.php';
	require '../bd/reserva.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Cadastrar plano</title>
		<?php
			include '../require/meta.html';
			require '../require/js-base.html';
		?>
		<script type='text/javascript' >
	
			function erroPeriodoEfetuarReserva() {
				$('#spnErroEfetuarReserva').text('O período selecionado deve estar entre as datas pesquisadas');
			}
			
			function resultadoReserva(resultado) {
				if (resultado == undefined || resultado == -1)
					$('#spnErroEfetuarReserva').text('Reserva não efetuada');
				else if (resultado == -2)
					$('#spnErroEfetuarReserva').text('Já existe uma reserva nesta vaga e horário');
				else {
					$("#spnToken").text(resultado);
					$("#divReservaEfetuada").modal();
				}
			}
			
			function setarCamposPesquisa(dataInicial, dataFinal, tipoVaga) {
				$('#txtPesquisaDataInicial').val(dataInicial);
				$('#hddPesquisaDataInicial').val(dataInicial);
				$('#txtPesquisaDataFinal').val(dataFinal);
				$('#hddPesquisaDataFinal').val(dataFinal);
				$('#sltPesquisaTipo').val(tipoVaga);
				$('#hddPesquisaTipo').val(tipoVaga);
			}
			
			function setarOpcoesVagasDisponiveis() {
				//alert($("#hddHtmlSelectVagasDisponiveis").val());
				$("#sltVaga").html($("#hddHtmlSelectVagasDisponiveis").val());
				habilitarOpcoesReserva(true);
			}
			function setarHiddenOpcoesVagas(html) {
				//alert(html);
				$("#hddHtmlSelectVagasDisponiveis").val(html);
			}
			
			function setarCamposReserva(dataHoraEntrada, dataHoraSaida, vaga) {
				//alert("setando campos reserva: " + dataHoraEntrada + " " + dataHoraSaida + " " + vaga);
				if (dataHoraEntrada && dataHoraEntrada != '')
					$('#txtDataHoraEntrada').val(dataHoraEntrada);
				if (dataHoraSaida && dataHoraSaida != '')
					$('#txtDataHoraSaida').val(dataHoraSaida);
				if (vaga && vaga != '')
					$("sltVaga").val(vaga);
			}
			
			function habilitarOpcoesReserva(h) {
				if (h) {
					// desabilitar opções de pesquisa
					$("#txtPesquisaDataInicial").prop("disabled", "disabled");
					$("#txtPesquisaDataFinal").prop("disabled", "disabled");
					$("#sltPesquisaTipo").prop("disabled", "disabled");
					$("#btnPesquisaVagasDisponiveis").prop("disabled", "disabled");
					// habilitar opções de reserva
					$("#sltVaga").attr("disabled", false);
					$("#txtDataHoraEntrada").attr("disabled", false);
					$("#txtDataHoraSaida").attr("disabled", false);
					$("#btnCancelar").attr("disabled", false);
					$("#btnConfirmar").attr("disabled", false);
					$("#hddTipoRequisicao").val("reserva");
				}
				else {
					$("#spnErroEfetuarReserva").text('');
					// desabilitar opções de reserva
					$("#sltVaga").prop("disabled", "disabled");
					$("#txtDataHoraEntrada").prop("disabled", "disabled");
					$("#txtDataHoraSaida").prop("disabled", "disabled");
					$("#btnCancelar").prop("disabled", "disabled");
					$("#btnConfirmar").prop("disabled", "disabled");
					// habilitar opções de pesquisa
					$("#txtPesquisaDataInicial").attr("disabled", false);
					$("#txtPesquisaDataFinal").attr("disabled", false);
					$("#sltPesquisaTipo").attr("disabled", false);
					$("#btnPesquisaVagasDisponiveis").attr("disabled", false);
					$("#hddTipoRequisicao").val("pesquisa");
				}
				
			}
			
		</script>
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?>
	<h3>Controle de Reservas</h3>
	<form role='form' class='text-center' id="frmEfetuarReserva" action="efetuar_reserva.php" method='POST'>
		<!-- hiddens para restaurar os valores do form após o post -->
		<input type='hidden' id='hddPesquisaDataInicial' name='pesquisaDataInicialSelecionada' />
		<input type='hidden' id='hddPesquisaDataFinal' name='pesquisaDataFinalSelecionada' />
		<input type='hidden' id='hddPesquisaTipo' name='pesquisaTipoSelecionado' />
		<input type='hidden' id='hddReservaEfetuada' name='reservaEfetuada' value='-1'/>
		<input type='hidden' id='hddTipoRequisicao' name='tipoRequisicao' value='pesquisa' />
		<input type='hidden' id='hddHtmlSelectVagasDisponiveis' name='htmlOpcoesVagas' />
		<div class="modal fade" id="divReservaEfetuada" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" onclick='habilitarOpcoesReserva(false);'>&times;</button>
						<h4 class="modal-title" id='h4TituloRelatorio' >Reserva efetuada</h4>
					</div>
					<div class="modal-body">
						Token: <span id="spnToken"></span><br/>
						<hr/>
						Veja todas as <a href='reservas.php?search=all'>reservas</a>
					</div>
			  </div>
			</div>
		</div>
		<div class='form-group col-sm-4 text-left' style="border:solid 3px #000" id='divPesquisarVagasDisponiveis'>
			<h4>Consulta de Vagas:</h4><br/>	
			<label for='txtPesquisaDataInicial'>Data de Início:</label>
			<input type='datetime-local' class='form-control' id='txtPesquisaDataInicial' name="pesquisaDataInicial"><br/>
			<label for='txtPesquisaDataFinal'>Data Final:</label>
			<input type='datetime-local' class='form-control' id='txtPesquisaDataFinal' name="pesquisaDataFinal"><br/>
			<label for='sltPesquisaTipo'>Tipo:</label>
			<select class='form-control' id='sltPesquisaTipo' name='pesquisaTipo'>
				<option value='0'>Tudo</option>
				<option value='<?php $TIPO_VAGA_CARRO ?>'>Carro</option>
				<option value='<?php $TIPO_VAGA_MOTO ?>'>Moto</option>
				<option value='<?php $TIPO_VAGA_UTILITARIO ?>'>Utilitário</option>
			</select>
			<br/>
			<input type='submit' id='btnPesquisaVagasDisponiveis' class='btn btn-success btn-medium min-border-white' value='Pesquisar'/>
			<hr/>
		</div>
		<div class='form-group col-md-offset-6 text-left' id='divOpcoesReserva'>
			<h4 class='text-center'>Efetuar Reserva:</h4><br/>
			<label for='sltVaga'>Vagas Disponíveis:</label>
			<select class='form-control' id='sltVaga' name='vaga' disabled='disabled'>
				<option>-</option>
			</select><br/>
			<label for='txtDataHoraEntrada'>Data e horário de entrada:</label>
			<input type='datetime-local' class='form-control' id='txtDataHoraEntrada' name='dataHoraEntrada' disabled='disabled' /><br/>
			<label for='txtDataHoraSaida'>Data e horário de saída:</label>
			<input type='datetime-local' class='form-control' id='txtDataHoraSaida' name='dataHoraSaida' disabled='disabled' />
		</div>
		<div class='form-group col-sm-12 text-right' disabled='disabled' id='divConfirmarReserva'>
			<span id='spnErroEfetuarReserva'></span>&nbsp;
			<input type='button' id='btnCancelar' class='btn btn-danger min-border-white' value='Cancelar'  disabled='disabled' onclick='habilitarOpcoesReserva(false);'/> &nbsp;
			<input type='submit' id='btnConfirmar' class='btn cmd-item' value='Confirmar'  disabled='disabled'/>
		</div>
		<?php
			if (isset($_POST['tipoRequisicao'])) {
				if ($_POST['tipoRequisicao'] == 'pesquisa') {
					// buscar vagas
					$vagasLivres = buscarVagasLivres($_POST['pesquisaDataInicial'], $_POST['pesquisaDataFinal'], $_POST['pesquisaTipo']);
					$htmlTempVagas = '';
					if (mysql_num_rows($vagasLivres) > 0) {
						while ($row = mysql_fetch_assoc($vagasLivres))
							$htmlTempVagas = $htmlTempVagas . "<option value='" . $row['id_vaga'] . "'>" . $row['nro_vaga'] . "</option>";
					}
					echo "<script type='text/javascript'>setarHiddenOpcoesVagas(\"" . $htmlTempVagas . "\");</script>";
				}
				else {
					// efetuar reserva
					if (isset($_POST['htmlOpcoesVagas']))
						echo "<script type='text/javascript'>setarHiddenOpcoesVagas(\"" . $_POST['htmlOpcoesVagas'] . "\");</script>";
					if ($_POST['dataHoraEntrada'] == '' || (strtotime($_POST['dataHoraEntrada']) > strtotime($_POST['pesquisaDataFinalSelecionada']) || strtotime($_POST['dataHoraEntrada']) < strtotime($_POST['pesquisaDataInicialSelecionada'])) || (strtotime($_POST['dataHoraSaida']) > strtotime($_POST['pesquisaDataFinalSelecionada']) || strtotime($_POST['dataHoraSaida']) < strtotime($_POST['pesquisaDataInicialSelecionada'])))
						echo "<script type='text/javascript'> erroPeriodoEfetuarReserva(); </script>";
					else {
						$reserva = efetuarReserva($_POST['vaga'], $_POST['dataHoraEntrada'], $_POST['dataHoraSaida'], $_SESSION['id_cliente']);
						echo "<script type='text/javascript'> resultadoReserva('" . $reserva . "'); </script>";
					}
				}
			}
			
			if (isset($_POST['pesquisaDataInicial']) && isset($_POST['pesquisaDataFinal']) && isset($_POST['pesquisaTipo'])) {
				echo "<script type='text/javascript'>setarCamposPesquisa('" . $_POST['pesquisaDataInicial'] . "', '" . $_POST['pesquisaDataFinal'] . "', '". $_POST['pesquisaTipo'] . "');</script>";
			}
			else if (isset($_POST['pesquisaDataInicialSelecionada']) && isset($_POST['pesquisaDataFinalSelecionada']) && isset($_POST['pesquisaTipoSelecionado'])) {
				echo "<script type='text/javascript'>setarCamposPesquisa('" . $_POST['pesquisaDataInicialSelecionada'] . "', '" . $_POST['pesquisaDataFinalSelecionada'] . "', '". $_POST['pesquisaTipoSelecionado'] . "');</script>";
			}
			echo "<script type='text/javascript'>setarOpcoesVagasDisponiveis();</script>";
			if (isset($_POST['dataHoraEntrada']) && isset($_POST['dataHoraSaida']) && isset($_POST['vaga'])) {
				echo "<script type='text/javascript'>setarCamposReserva('" . $_POST['dataHoraEntrada']. "', '" . $_POST['dataHoraSaida'] . "', '" . $_POST['vaga'] . "');</script>";
			}
			require '../require/content-2-footer.html';
		?>
	</form>
</html>