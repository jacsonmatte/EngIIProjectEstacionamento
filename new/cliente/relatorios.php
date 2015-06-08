<?php
	require '../require/cliente-aut.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Relatórios</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		$_SESSION['username'] = 'teste';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Relatórios</h3>
	<form role='form' class='text-center'>
		<div class='form-group col-sm-3 text-left'>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioPlanos' /><label for='rdbRelatorioPlanos'>&nbsp;Planos</label>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioUso' /><label for='rdbRelatorioUso'>&nbsp;Uso</label>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' name='relatorio' id='rdbRelatorioReservas' /><label for='rdbRelatorioReservas'>&nbsp;Reservas</label>
			</div>
		</div>
		<div class='form-group col-sm-9 text-left'>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-4'>
					<input class='form-control' type='date' id='dteDataInicial' placeholder='Data Inicial'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-4'>
					<input class='form-control' type='date' id='dteDataFinal' placeholder='Data Final'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-6'>
					<select class='form-control' id='sltPlanos'>
						<option>Plano 1</option>
						<option>Plano 2</option>
						<option>Plano 3</option>
					</select>
				</div>
			</div>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroGerarRelatorio' class='help-inline'></span>&nbsp;
			<input type='button' id='btnGerar' class='btn cmd-item' value='Gerar' />
		</div>
	</form>
	<!-- Modal do relatório -->
	<div class="modal fade" id="divRelatorio" role="dialog">
		<div class="modal-dialog">		
		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id='h4TituloRelatorio' >Relatório exemplo</h4>
				</div>
				<div class="modal-body" id='divConteudoRelatorio'>
					Aqui colocamos a table gerada dinamicamente
				</div>
		  </div>
		</div>
	</div>
	<?php
		require '../require/content-2-footer.html';
	?>
	
	<script type='text/javascript'>
	
		$("#btnGerar").click(function() {
			
			$("#spnErroGerarRelatorio").text('');
			
			// obter os radio checados para ver se foi escolhido algum tipo de relatório
			var opt = $('input[name=relatorio]:checked');
			
			if (opt.length == 1) {
				
				// verificar o tipo de relatório selecionado e os filtros necessários
				
				// se tiver tudo ok, chama o relatório por ajax
				// recebe o retorno json
				// chama a função que monta a tabela com o objeto json (ainda será criada)
				// coloca a tabela na divConteudoRelatorio 
				//$("#divConteudoRelatorio").empty();
				//$("#divConteudoRelatorio").append(conteudo);
				// exibe o modal
				$("#divRelatorio").modal();
			}
			else
				$("#spnErroGerarRelatorio").text('É necessário escolher um tipo de relatório');
			
		});
		
	
	</script>
	
	
	
</html>
