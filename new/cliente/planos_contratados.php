<?php 
	require '../require/cliente-aut.php'; 
	require '../bd/conectBd.php"';
	
	$nomecliente = $_SESSION['username'];
	$sql="SELECT id_cliente FROM cliente INNER JOIN usuario ON cliente.id_cliente = usuario.cliente_id_cliente WHERE usuario.login='{$nomecliente}'";
	$conexao = dbConnect("localhost","root","");
	$query = dbConsulta($sql,"estacionamento", $conexao);
	$id_cliente = mysql_fetch_array($query)
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Planos contratados</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Planos contratados</h3>
		<form role='form' class='text-center'>
		<div class='form-group col-sm-3 text-left' title='Informe a quantidade mínima de horas dos planos que deseja pesquisar'>
			<label for='txtPesquisaQuantidadeHorasMin'>Horas (mínimo):</label>
			<input type='text' class='form-control' id='txtPesquisaQuantidadeHorasMin' />
		</div>
		<div class='form-group col-sm-3 text-left' title='Informe a quantidade máxima de horas dos planos que deseja pesquisar' >
			<label for='txtPesquisaQuantidadeHorasMax'>Horas (máximo):</label>
			<input type='text' class='form-control' id='txtPesquisaQuantidadeHorasMax'/>
		</div>
		<div class='form-group col-sm-3 text-left' title='Informe o valor mínimo dos planos que deseja pesquisar'>
			<label for='txtPesquisaValorMin'>Valor (mínimo):</label>
			<input type='text' class='form-control' id='txtPesquisaValorMin' />
		</div>
		<div class='form-group col-sm-3 text-left' title='Informe o valor máximo dos planos que deseja pesquisar' >
			<label for='txtPesquisaValorMax'>Valor (máximo):</label>
			<input type='text' class='form-control' id='txtPesquisaValorMax'/>
		</div>
		<div class='form-group col-sm-12 text-left'>
			<input type='radio' id='rdbPesquisaSomentePlanosAtivos' name='pesquisaPlanoSituacao'/><label for='rdbPesquisaSomentePlanosAtivos'>&nbsp;Apenas planos ativos</label>&nbsp;
			<input type='radio' id='rdbPesquisaSomentePlanosInativos' name='pesquisaPlanoSituacao'/><label for='rdbPesquisaSomentePlanosInativos'>&nbsp;Apenas planos inativos</label>&nbsp;
			<input type='radio' id='rdbPesquisaTodosPlanos' name='pesquisaPlanoSituacao'/ checked><label for='rdbPesquisaTodosPlanos'>&nbsp;Todos</label>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarMensalidades'></span>
			<input type='button' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' />
		</div>


	</form>
	<!-- Modal do relatório -->
	<div class="modal fade" id="divRelatorio" role="dialog">
		<div class="modal-dialog">		
		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id='h4TituloRelatorio' >Planos Contratados:</h4>
				</div>
				<div class="modal-body" id='divConteudoRelatorio'>
					<p id="conteudoRelatorio" ></p>
				</div>
		  </div>
		</div>
	</div>
	<?php
		require '../require/content-2-footer.html';
	?>
	
	<script type='text/javascript'>
	
		$("#btnPesquisar").click(function() {
			
			$("#spnErroGerarRelatorio").text('');
			
			// obter os radio checados para ver se foi escolhido algum tipo de relatório
			var opt = $('input[name=pesquisaPlanoSituacao]:checked');
			
			if (opt.length == 1) {
				var txtRelatorio = $('p[id=conteudoRelatorio]');
				
				$( txtRelatorio ).html('Carregando...');
				
				// verificar o tipo de relatório selecionado e os filtros necessários
				
				// se tiver tudo ok, chama o relatório por ajax
				// recebe o retorno json
				// chama a função que monta a tabela com o objeto json (ainda será criada)
				// coloca a tabela na divConteudoRelatorio 			
				
				$.getJSON(
					'function.php',
					{ id_cliente: "<?php echo $id_cliente['id_cliente'];?>", 
					horas_min: $('input[id=txtPesquisaQuantidadeHorasMin]').val(),
					horas_max: $('input[id=txtPesquisaQuantidadeHorasMax]').val(),
					valor_min: $('input[id=txtPesquisaValorMin]').val(),
					valor_max: $('input[id=txtPesquisaValorMax]').val()},
					function(json)
					{
						$( txtRelatorio ).html( json.txtValor );
					}
				);

				// exibe o modal
				$("#divRelatorio").modal();
				
			} 
		});
		
	
	</script>
	
	
	
</html>