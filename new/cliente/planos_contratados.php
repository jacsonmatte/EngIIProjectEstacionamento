<?php 
	require '../require/cliente-aut.php'; 
	require '../dominio/constantes.php';
	require '../bd/conectBd.php';
	require '../bd/plano_contratado.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Planos contratados</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
		<script type='text/javascript'>
			function exibirPlanos(html) {
				$("#divListaPlanosContratados").html(html);
				$("#divRelatorio").modal();
			}
		</script>
		
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Planos contratados</h3>
		
		<form role='form' class='text-center' action='planos_contratados.php' method='POST'>
			<!-- Modal do relatório -->
			<div class="modal fade" id="divRelatorio" role="dialog">
				<div class="modal-dialog">	
				<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" id='h4TituloRelatorio' >Planos Contratados:</h4>
						</div>
						<div class="modal-body" id='divListaPlanosContratados'>
							
						</div>
				  </div>
				</div>
			</div>
			<div class='form-group col-sm-3 text-left' title='Informe a quantidade mínima de horas dos planos que deseja pesquisar'>
				<label for='txtPesquisaQuantidadeHorasMin'>Horas (mínimo):</label>
				<input type='text' class='form-control' id='txtPesquisaQuantidadeHorasMin' name='horas_min' />
			</div>
			<div class='form-group col-sm-3 text-left' title='Informe a quantidade máxima de horas dos planos que deseja pesquisar' >
				<label for='txtPesquisaQuantidadeHorasMax'>Horas (máximo):</label>
				<input type='text' class='form-control' id='txtPesquisaQuantidadeHorasMax' name='horas_max' />
			</div>
			<div class='form-group col-sm-3 text-left' title='Informe o valor mínimo dos planos que deseja pesquisar'>
				<label for='txtPesquisaValorMin'>Valor (mínimo):</label>
				<input type='text' class='form-control' id='txtPesquisaValorMin' name='valor_min' />
			</div>
			<div class='form-group col-sm-3 text-left' title='Informe o valor máximo dos planos que deseja pesquisar' >
				<label for='txtPesquisaValorMax'>Valor (máximo):</label>
				<input type='text' class='form-control' id='txtPesquisaValorMax' name='valor_max' />
			</div>
			<div class='form-group col-sm-12 text-left'>
				<input type='radio' id='rdbPesquisaSomentePlanosAtivos' name='pesquisaPlanoSituacao' value='ativos' /><label for='rdbPesquisaSomentePlanosAtivos'>&nbsp;Apenas planos ativos</label>&nbsp;
				<input type='radio' id='rdbPesquisaSomentePlanosInativos' name='pesquisaPlanoSituacao' value='inativos' /><label for='rdbPesquisaSomentePlanosInativos'>&nbsp;Apenas planos inativos</label>&nbsp;
				<input type='radio' id='rdbPesquisaTodosPlanos' name='pesquisaPlanoSituacao' value='todos' checked='checked'><label for='rdbPesquisaTodosPlanos'>&nbsp;Todos</label>
			</div>
			<div class='form-group col-sm-12 text-right'>
				<span id='spnErroPesquisarMensalidades'></span>
				<input type='submit' id='btnPesquisar' name='pesquisar' class='btn cmd-item' value='Pesquisar' />
			</div>
			<?php
			
				if (isset($_POST['pesquisar'])) {
					$planosContratados = buscarPlanosPorValorTempoSituacao($_SESSION['id_cliente'], $_POST['horas_min'], $_POST['horas_max'], $_POST['valor_min'], $_POST['valor_max'], $_POST['pesquisaPlanoSituacao']);
					$html = '';
					if (!$planosContratados)
						echo "<strong style='color: #FFF'>Oops! Parece que tivemos um problema...</strong>";
					else if (mysql_num_rows($planosContratados) == 0)
						echo "<strong>Nenhum plano encontrado</strong>";
					else {
								
						$i = 0;
						$html = "<table style='max-width: 95%' id='tblResultadoPesquisa'><thead><tr class='bg-all' style='color: #FFF'><th style='text-align: center; border-left: solid 1px #FFF;'>Código</th><th style='text-align: center;'>Nome</th><th style='text-align: center; border-left: solid 1px #FFF;'>Valor</th><th style='text-align: center; border-left: solid 1px #FFF;'>Horas</th><th style='text-align: center; border-left: solid 1px #FFF;'>Valor excedente</th><th style='text-align: center; border-left: solid 1px #FFF;'>Data</th><th style='text-align: center; border-left: solid 1px #FFF;'>Status</th></tr></thead><tbody>";
							$status = '';	
						while ($row = mysql_fetch_assoc($planosContratados)) {
							$status = $row['status'] == 0 ? "ativo" : "inativo";
							$html .= "<tr style='background: " . ($i % 2 == 0 ? "#CCC'" : "#FFF'") . "><td>" . $row['id_plano_contratado'] . "</td><td>" . $row['nome'] . "</td><td>" . $row['valor'] . "</td><td>" . $row['horas'] . "</td><td>" . $row['excedente'] . "</td><td>" . $row['data'] . "</td><td>" . $status . "</td></tr>"; $i++;
						}
						
						$html .= "</tbody></table>";
						echo "<script> exibirPlanos(\"" . $html . "\")</script>";
						
					}
					
				}
			
			?>
		</form>
	<?php
		require '../require/content-2-footer.html';
	?>
	
</html>