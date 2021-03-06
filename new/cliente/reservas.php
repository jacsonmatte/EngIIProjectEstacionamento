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
		<style type='text/css'>
			th {
				text-align: center;
			}
		</style>
		<script type='text/javascript'>
			$(document).ready(function() {
				$(".cmd").click(function(event) {
					var id = event.target.id.replace("img", "");
					$("#hddIdReservaCancelar").val(id);
					$("#btnCancelarReserva").click();
				});
				
				// para usar os recursos do DataTable basta chamar a função para a tabela desejada
				// IMPORTANTE: a tabela deve conter os elementos thead e tbody
				// tr, th e td não podem conter colspan or rowspan
				/*
				$('#tbReservas').DataTable({
					language: {
						processing:     "Processando...",
						search:         "Buscar:",
						lengthMenu:     "Exibir _MENU_ itens por página",
						info:           "Mostrando _START_ a _END_ de _TOTAL_ itens",
						infoEmpty:      "Nenhum registro",
						infoFiltered:   "",
						infoPostFix:    "",
						loadingRecords: "Carregando...",
						zeroRecords:    "Nenhum registro",
						emptyTable:     "Nenhum registro",
						paginate: {
							first:      "<<",
							previous:   "<",
							next:       ">",
							last:       ">>"
						},
						aria: {
							sortAscending:  ": ordem crescente",
							sortDescending: ": ordem decrescente"
						}
					}
				});
				*/
			});
			function setarCamposPesquisaData(dataInicial, dataFinal) {
				$("#txtPesquisaDataInicial").val(dataInicial);
				$("#txtPesquisaDataFinal").val(dataFinal);
			}
			function setarCampoPesquisaSituacao(situacao) { $("sltPesquisaSituacao").val(situacao); }
			function setarConteudoTabela(html) { $("divResultadoPesquisaReservas").html(html); }
			function setarCampoPesquisaTipo(tipo) { $("sltPesquisaTipo").val(tipo); }
			function exibirReservas(html) { $("#divListaReservas").html(html); $("#divReservas").modal(); }
			
		</script>
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Controle de Reservas</h3>
	<form role='form' class='text-center' id="form-pesquisa" action='reservas.php?search=custom' method='POST'>
		<?php
			if (isset($_POST['cancelar']))
				if ($_POST['cancelar'] > 0)
					alterarSituacaoReserva($_POST['cancelar'], $STATUS_RESERVA_CANCELADA);
		?>
		<input type='hidden' id='hddIdReservaCancelar' name='cancelar'/>
		<input type='submit' class='hide' id='btnCancelarReserva' />
		<div class="modal fade" id="divReservas" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" onclick='habilitarOpcoesReserva(false);'>&times;</button>
						<h4 class="modal-title" id='h4TituloRelatorio' >Reservas</h4>
					</div>
					<div class="modal-body" id='divListaReservas'>
						
					</div>
			  </div>
			</div>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaDataInicial'>Data inicial:</label>
			<input type='date' class='form-control' id='txtPesquisaDataInicial' name='pesquisaDataInicial'>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaDataFinal'>Data final:</label>
			<input type='date' class='form-control' id='txtPesquisaDataFinal' name='pesquisaDataFinal'>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaSituacao'>Situação:</label>
			<select class='form-control' id='sltPesquisaSituacao' name='pesquisaSituacao'>
				<option value='0'>Tudo</option>
				<option value=' <?php $STATUS_RESERVA_RESERVADA ?>'>Em aberto</option>
				<option value=' <?php $STATUS_RESERVA_CANCELADA ?>'>Canceladas</option>
				<option value=' <?php $STATUS_RESERVA_UTILIZACAO ?>'>Em utilização</option>
				<option value=' <?php $STATUS_RESERVA_UTILIZADA ?>'>Concluídas</option>
				<option value=' <?php $STATUS_RESERVA_NAO_UTILIZADA ?>'>Não utilizadas</option>
			</select>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaTipo'>Tipo:</label>
			<select class='form-control' id='sltPesquisaTipo' name='pesquisaTipo'>
				<option value='0'>Tudo</option>
				<option value='<?php $TIPO_VAGA_CARRO ?>'>Carro</option>
				<option value='<?php $TIPO_VAGA_MOTO ?>'>Moto</option>
				<option value='<?php $TIPO_VAGA_UTILITARIO ?>'>Utilitário</option>
			</select>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarReservas'></span>
			<input type='submit' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' />
		</div>
		<div id='divResultadoPesquisaReservas' class='form-group col-sm-12 text-center'>	
			<?php
				$reservas = false;
				if (isset($_GET['search'])) {
					$pesquisaDataInicial = ''; $pesquisaDataFinal = ''; $pesquisaTipo = ''; $pesquisaSituacao = '';
					if (isset($_POST["pesquisaDataInicial"]) && isset($_POST['pesquisaDataFinal']) && isset($_POST["pesquisaSituacao"]) && isset($_POST['pesquisaTipo'])) {
						$pesquisaDataInicial = $_POST["pesquisaDataInicial"];
						$pesquisaDataFinal = $_POST['pesquisaDataFinal'];
						$pesquisaTipo = $_POST["pesquisaSituacao"];
						$pesquisaSituacao = $_POST['pesquisaTipo'];
					}
					if ($pesquisaDataInicial > $pesquisaDataFinal)
						echo "<strong>A data final deve ser maior que a data inicial</strong>";
					else {
						$reservas = buscarReservas($_SESSION['id_cliente'], $pesquisaDataInicial, $pesquisaDataFinal, $pesquisaTipo, $pesquisaSituacao);
						
						if (!$reservas)
							echo "<strong style='color: #FFF'>Oops! Parece que tivemos um problema...</strong>";
						else if (mysql_num_rows($reservas) == 0)
							echo "<strong>Nenhuma reserva encontrada</strong>";
						else {
							$i = 0;
							$html = "<table style='max-width: 95%' id='tblResultadoPesquisa'><thead><tr class='bg-all' style='color: #FFF'><th style='text-align: center;'>Código</th><th style='text-align: center; border-left: solid 1px #FFF;'>Entrada</th><th style='text-align: center; border-left: solid 1px #FFF;'>Saída</th><th style='text-align: center; border-left: solid 1px #FFF;'>Vaga</th><th style='text-align: center; border-left: solid 1px #FFF;'>Token</th><th style='text-align: center; border-left: solid 1px #FFF;'>Status</th></tr></thead><tbody>";
							while ($row = mysql_fetch_assoc($reservas)) {
								$status = '';
								if ($row['status'] == $STATUS_RESERVA_CANCELADA) $status = 'Cancelada';
								else if ($row['status'] == $STATUS_RESERVA_UTILIZADA) $status = 'Concluída';
								else if ($row['status'] == $STATUS_RESERVA_RESERVADA) $status = 'Em aberto <img id=\"img' . $row['codigo'] . '\" class=\"cmd\" title=\"Cancelar\" src=\"../img/cancel.png\" width=\"20px\" style=\"cursor: pointer\" />';
								else if ($row['status'] == $STATUS_RESERVA_NAO_UTILIZADA) $status = 'Não utilizada';
								else $status = 'Em utilização';
								
								$html = $html . "<tr style='background: " . ($i % 2 == 0 ? "#CCC'" : "#FFF'") . "><td>" . $row['codigo'] . "</td><td>" . date("Y/m/d H:s", strtotime($row['entrada'])) . "</td><td>" . date("Y/m/d H:s", strtotime($row['saida'])) . "</td><td>" . $row['vaga'] . "</td><td>" . $row['token'] . "</td><td>" . $status . "</td></tr>"; 	
								$i++;
							}
							echo "<script type='text/javascript'> exibirReservas(\"" . $html . "</tbody></table>\")</script>";
						}
					}
				}
				else
					echo "<strong>Para pesquisar reservas, informe os critérios desejados e clique em 'Pesquisar'</strong>";
			?>
		</div>
		<?php
			if (isset($_POST["pesquisaDataInicial"]) && isset($_POST['pesquisaDataFinal']))
				echo "<script type='text/javascript'> setarCamposPesquisaData('" . $_POST['pesquisaDataInicial'] . "','" . $_POST['pesquisaDataFinal'] . "');</script>";
			if (isset($_POST["pesquisaTipo"]))
				echo "<script type='text/javascript'> setarCampoPesquisaTipo('" . $_POST['pesquisaTipo'] . "');</script>";
			if (isset($_POST['pesquisaSituacao']))
				echo "<script type='text/javascript'> setarCampoPesquisaSituacao('" . $_POST['pesquisaSituacao'] . "');</script>";
		?>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>
