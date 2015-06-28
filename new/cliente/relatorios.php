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
		<script type='text/javascript' >
		
			function erroGerarRelatorio(erro) {
				if (erro == '1')
					$("#spnErroGerarRelatorio").text("Erro ao gerar o relatório");
				else if (erro == '2')
					$("#spnErroGerarRelatorio").text("Data inicial inválida");
				else if (erro == '3')
					$("#spnErroGerarRelatorio").text("Data final inválida");
				else if (erro == '4')
					$("#spnErroGerarRelatorio").text("Data inicial não pode ser maior que a data final");
			}
		
		</script>
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Relatórios</h3>
	<form role='form' class='text-center' action='gerar_relatorio.php' method='POST'>
		<div class='form-group col-sm-3 text-left'>
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' value='planos' name='relatorio' id='rdbRelatorioPlanos' /><label for='rdbRelatorioPlanos'>&nbsp;Planos</label>
			</div>
			<!--<div class='col-sm-12 text-left form-group'>
				<input type='radio' value='uso' name='relatorio' id='rdbRelatorioUso' /><label for='rdbRelatorioUso'>&nbsp;Uso</label>
			</div>-->
			<div class='col-sm-12 text-left form-group'>
				<input type='radio' value='reservas' name='relatorio' id='rdbRelatorioReservas' /><label for='rdbRelatorioReservas'>&nbsp;Reservas</label>
			</div>
		</div>
		<div class='form-group col-sm-9 text-left'>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-4'>
					<input class='form-control' type='date' id='dteDataInicial' placeholder='Data Inicial' name='datainicial'/>
				</div>
			</div>
			<div class='col-sm-12 text-left form-group'>
				<div class='col-sm-4'>
					<input class='form-control' type='date' id='dteDataFinal' placeholder='Data Final' name='datafinal'/>
				</div>
			</div>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroGerarRelatorio' class='help-inline'></span>&nbsp;
			<input type='submit' id='btnGerar' class='btn cmd-item' value='Gerar' />
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
		if (isset($_GET['error']))
			echo "<script type='text/javascript'> erroGerarRelatorio('" . $_GET['error'] . "'); </script>";
	?>
	
	<script type='text/javascript'>
		
		// $("#btnGerar").click(function() {
			
			// $("#spnErroGerarRelatorio").text('');
			
			// // obter os radio checados para ver se foi escolhido algum tipo de relatório
			// var opt = $('input[name=relatorio]:checked');
			
			// if (opt.length == 1) {
				
				// // verificar o tipo de relatório selecionado e os filtros necessários
				
				// // se tiver tudo ok, chama o relatório por ajax
				// // recebe o retorno json
				// // chama a função que monta a tabela com o objeto json (ainda será criada)
				// // coloca a tabela na divConteudoRelatorio 
				// //$("#divConteudoRelatorio").empty();
				// //$("#divConteudoRelatorio").append(conteudo);
				// // exibe o modal
				// $("#divRelatorio").modal();
			// }
			// else
				// $("#spnErroGerarRelatorio").text('É necessário escolher um tipo de relatório');
			
		// });
		
	
	</script>
	
</html>
