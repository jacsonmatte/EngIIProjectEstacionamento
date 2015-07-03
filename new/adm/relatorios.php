<?php
	require '../require/adm-aut.php';
	require('../bd/relatoriosAdm.php');
?>




<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Relatórios</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
		<script>
		//oculta os campos desnecessários para cada uma das opções
		function desabilitaPlanos(opcao){
				if (opcao.value == "planos") {
					document.getElementById('dteDataInicial').disabled = true;
					document.getElementById('dteDataFinal').disabled = true;
					document.getElementById('txtIdentificacaoCliente').disabled = true;
					document.getElementById('txtVaga').disabled = true;
				}
				document.getElementById('sltPlanos').disabled = false;

			}
			
			function desabilitaClientes(opcao){
				if (opcao.value == "clientes") {
					document.getElementById('dteDataInicial').disabled = true;
					document.getElementById('dteDataFinal').disabled = true;
					document.getElementById('sltPlanos').disabled = true;
					document.getElementById('txtVaga').disabled = true;
				}
				document.getElementById('txtIdentificacaoCliente').disabled = false;

			}
			
			function habilitaTudo(opcao){
				if (opcao.value == "planosClientes") {
					document.getElementById('dteDataInicial').disabled = false;
					document.getElementById('dteDataFinal').disabled = false;
					document.getElementById('sltPlanos').disabled = false;
					document.getElementById('txtVaga').disabled = false;
					document.getElementById('txtIdentificacaoCliente').disabled = false;
				}

			}
			
			function desabilitaUtilizadasUsoVagasCadastradas(opcao){
				if (opcao.value == "reservasUtilizadas" || opcao.value == "relatorioUsoVaga" || opcao.value == "reservasCadastradas") {
					document.getElementById('dteDataInicial').disabled = true;
					document.getElementById('dteDataFinal').disabled = true;
					document.getElementById('sltPlanos').disabled = true;
				}
				
				
				document.getElementById('txtVaga').disabled = false;
				document.getElementById('txtIdentificacaoCliente').disabled = false;

			}
			
		
		</script>
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-adm.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Relatórios</h3>
	<form role='form' class='text-center' method="POST" action="relatorios.php" name="relatorios">
		<div class='form-group col-sm-3 text-left'>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioPlanos' value='planos' onclick="desabilitaPlanos(relatorios.relatorio);" /><label for='rdbRelatorioPlanos'>&nbsp;Planos</label>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioClientes' value='clientes' onclick="desabilitaClientes(relatorios.relatorio);"/><label for='rdbRelatorioClientes'>&nbsp;Clientes</label>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioPlanosClientes' value='planosClientes' onclick="habilitaTudo(relatorios.relatorio);"/><label for='rdbRelatorioPlanosClientes'>&nbsp;Planos x Clientes</label>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioReservasUtilizadas' value='reservasUtilizadas' onclick="desabilitaUtilizadasUsoVagasCadastradas(relatorios.relatorio);"/><label for='rdbRelatorioReservasUtilizadas'>&nbsp;Reservas utilizadas</label>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioReservasCadastradas' value='reservasCadastradas' onclick="desabilitaUtilizadasUsoVagasCadastradas(relatorios.relatorio);"/><label for='rdbRelatorioReservasCadastradas'>&nbsp;Reservas cadastradas</label>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioUsoVagas' value='relatorioUsoVaga' onclick="desabilitaUtilizadasUsoVagasCadastradas(relatorios.relatorio);"/><label for='rdbRelatorioUsoVagas'>&nbsp;Uso de vagas</label>
			</div>
		</div>
		<div class='form-group col-sm-9 text-left'>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-4'>
					<input class='form-control' type='date' name='dataInicial' id='dteDataInicial' placeholder='Data Inicial'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-4'>
					<input class='form-control' type='date' name='dataFinal' id='dteDataFinal' placeholder='Data Final'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-6'>
					<input class='form-control' type='text' name='idCliente' id='txtIdentificacaoCliente' placeholder='Identificação do cliente'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-3'>
					<input class='form-control' type='text' name='vaga' id='txtVaga' placeholder='Vaga'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-6'>
					<select class='form-control' name='planos' id='sltPlanos'>
						<option value="">Selecione um Plano:</option>
						<?php 
							$dados = recPlano();
							if(count($dados) > 0){
								for($i = 0; $i < count($dados)-1; $i++){
									$id = $dados["value"][$i];
									echo '<option value='.$id.'>'.$dados[$i].'</option>';
								}
							}
					
						?>	
					</select>
				</div>
			</div>
		</div>

		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroGerarRelatorio' class='help-inline'></span>&nbsp;
			<input type='submit' id='btnGerar' class='btn cmd-item' value='Gerar' />
		</div>
	</form>
	<?php 
		if (isset($_POST["relatorio"])) { 
			?>
			<link href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
			<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
			<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
			<table id="example" class="display" cellspacing="0" width="100%">
			<?php
			//imprime em formato de tabela todos os relatórios conforme selecionado pelo usuário
			if ($_POST["relatorio"] == "planos") {
				?>
				<thead>
					<tr>
						<th>Plano</th>
						<th>Valor</th>
						<th>Horas</th>
						<th>Valor Hora Excedente</th>
						<th>Descrição</th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th>Plano</th>
						<th>Valor</th>
						<th>Horas</th>
						<th>Valor Hora Excedente</th>
						<th>Descrição</th>
					</tr>
				</tfoot>
				
				<tbody>

					<?php 
					
					echo buscaPlanos($_POST["planos"]); ?>
				</tbody>
			<?php
			} else if ($_POST["relatorio"] == "clientes") {
				?>
				<thead>
					<tr>
						<th>Id</th>
						<th>Nome</th>
						<th>CPF/CNPJ</th>
						<th>E-mail</th>
						<th>Endereço</th>
						<th>CEP</th>
						<th>Telefone</th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th>Nome</th>
						<th>CPF/CNPJ</th>
						<th>E-mail</th>
						<th>Endereço</th>
						<th>CEP</th>
						<th>Telefone</th>
					</tr>
				</tfoot>
				
				<tbody>
					<?php 
					$busca = buscaClientes($_POST["idCliente"]);

					if($busca) echo $busca; ?>
				</tbody>
			<?php		
			} else if ($_POST["relatorio"] == "planosClientes") {
				?>
				<thead>
					<tr>
						<th>Cliente</th>
						<th>Plano</th>
						<th>Horas</th>
						<th>Observação</th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th>Cliente</th>
						<th>Plano</th>
						<th>Horas</th>
						<th>Observação</th>
					</tr>
				</tfoot>
				
				<tbody>
					<?php 
					$busca = buscaPlanosClientes($_POST["dataInicial"],$_POST["dataFinal"], $_POST["idCliente"], $_POST["vaga"], $_POST["planos"]); 

					if ($busca) echo $busca; ?>
				</tbody>
			<?php		
			} else if ($_POST["relatorio"] == "reservasUtilizadas") {
				?>
				<thead>
					<tr>
						<th>Código</th>
						<th>Data e hora de Entrada</th>
						<th>Data e hora de Saída</th>
						<th>Número da vaga</th>
						<th>Token</th>
						<th>Status</th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th>Código</th>
						<th>Data e hora de Entrada</th>
						<th>Data e hora de Saída</th>
						<th>Número da vaga</th>
						<th>Token</th>
						<th>Status</th>
					</tr>
				</tfoot>
				
				<tbody>
					<?php 
					$busca = buscaReservasUtilizadas($_POST["idCliente"], $_POST["vaga"], $_POST["relatorio"] ); 
					if ($busca) echo $busca;?>				
				</tbody>
			<?php
			} else if ($_POST["relatorio"] == "reservasCadastradas") {
				?>
				<thead>
					<tr>
						<th>Cliente</th>
						<th>Nº da Vaga</th>
						<th>Data Entrada</th>
						<th>Data Saída</th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th>Cliente</th>
						<th>Nº da Vaga</th>
						<th>Data Entrada</th>
						<th>Data Saída</th>
					</tr>
				</tfoot>
				
				<tbody>
				<?php 
					$busca = buscaReservasUtilizadas($_POST["idCliente"], $_POST["vaga"], $_POST["relatorio"]); 
					if ($busca) echo $busca;?>
				</tbody>
			<?php
			} else if ($_POST["relatorio"] == "relatorioUsoVaga") {
				?>
				<thead>
					<tr>
						<th>Nº da Vaga</th>
						<th>Tipo da Vaga</th>
						<th>Data Entrada</th>
						<th>Data Saída</th>
						<th>Cliente</th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th>Nº da Vaga</th>
						<th>Tipo da Vaga</th>
						<th>Data Entrada</th>
						<th>Data Saída</th>
						<th>Cliente</th>
					</tr>
				</tfoot>
				
				<tbody>
					<?php 
					$busca = buscaUsoDeVagas($_POST["idCliente"], $_POST["vaga"]);
					if ($busca) echo $busca;  ?>
				</tbody>
			<?php
			}
		?>
		</table>
	<?php
		}
		require '../require/content-2-footer.html';
	?>
	
	<script type='text/javascript'>
	//exibe a tabela no formato data Table e traduz para pt-br
		$(document).ready(function() {
			$('#example').DataTable({
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
		} );
	</script>
</html>
