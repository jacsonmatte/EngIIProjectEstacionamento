<?php 
	require '../require/adm-aut.php';
	//require '../bd/conectBd.php';
	require "../bd/mensalidadeDB.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Planos</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		require '../require/menu-adm.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Planos</h3>
		<form role='form' class='text-center'id="form-pesquisa" action='planos.php?search=custom' method='POST'>
			<div class='form-group col-sm-3 text-left' title='Informe a quantidade mínima de horas dos planos que deseja pesquisar'>
				<label for='txtPesquisaQuantidadeHorasMin'>Horas (mínimo):</label>
				<input type='text' class='form-control' id='txtPesquisaQuantidadeHorasMin' name="qtdMinhrs" />
			</div>
			<div class='form-group col-sm-3 text-left' title='Informe a quantidade máxima de horas dos planos que deseja pesquisar' >
				<label for='txtPesquisaQuantidadeHorasMax'>Horas (máximo):</label>
				<input type='text' class='form-control' id='txtPesquisaQuantidadeHorasMax' name="qtdMaxhrs"/>
			</div>
			<div class='form-group col-sm-3 text-left' title='Informe o valor mínimo dos planos que deseja pesquisar'>
				<label for='txtPesquisaValorMin'>Valor (mínimo):</label>
				<input type='text' class='form-control' id='txtPesquisaValorMin' name="VloMin"/>
			</div>
			<div class='form-group col-sm-3 text-left' title='Informe o valor máximo dos planos que deseja pesquisar' >
				<label for='txtPesquisaValorMax'>Valor (máximo):</label>
				<input type='text' class='form-control' id='txtPesquisaValorMax' name="VloMax"/>
			</div>
			<div class='form-group col-sm-12 text-left'>
				<input type='radio' id='rdbPesquisaSomentePlanosAtivos' name='pesquisaPlanoSituacao'/><label for='rdbPesquisaSomentePlanosAtivos'>&nbsp;Apenas planos ativos</label>&nbsp;
				<input type='radio' id='rdbPesquisaSomentePlanosInativos' name='pesquisaPlanoSituacao'/><label for='rdbPesquisaSomentePlanosInativos'>&nbsp;Apenas planos inativos</label>&nbsp;
				<input type='radio' id='rdbPesquisaTodosPlanos' name='pesquisaPlanoSituacao'/><label for='rdbPesquisaTodosPlanos'>&nbsp;Todos</label>
			</div>
			<div class='form-group col-sm-12 text-right'>
				<span id='spnErroPesquisarPlanos'></span>
				<input type='submit' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' name="btnPesquisar"/>
			</div>
			<?php
				if(isset($_POST['btnPesquisar'])){
					if(isset($_POST['qtdMinhrs']) && isset($_POST['qtdMaxhrs']) && isset($_POST['VloMin']) && isset($_POST['VloMax'])){ //Valores preenchidos
						if((($_POST['qtdMinhrs']) < ($_POST['qtdMaxhrs'])) && (($_POST['VloMin']) < ($_POST['VloMax']))){ // Min < Max E Min < Max
							
							$dados = buscaPlanos($_POST['qtdMinhrs'], $_POST['qtdMaxhrs'], $_POST['VloMin'], $_POST['VloMax']);

							if (mysql_num_rows($dados) > 0) {	
					                          
								echo '<table width="100%">';
								echo '<thead><tr>';
								echo '<th>Cliente</th>';
								echo '<th>Nome</th>';
								echo '<th>valor</th>';
								echo '<th>Horas</th>';
								echo '<th>Excedente</th>';
								echo '<th>Data</th>';
								echo '</thead></tr>';
								
								echo '<tbody>';
								while ($dados1 = mysql_fetch_array($dados)){
									echo '<tr>';
									echo '<td>'.$dados1[0].'</td>';		//Tabela Cliente tem como nome da coluna Nome "nome" então tem q acessar por indice
									echo '<td>'.$dados1['nome'].'</td>';
									echo '<td>'.$dados1['valor'].'</td>';
									echo '<td>'.$dados1['horas'].'</td>';
									echo '<td>'.$dados1['valor_excedente'].'</td>';
									echo '<td>'.$dados1['data_contrato'].'</td>';
									echo '</tr>';
								}
								echo '</tbody></table>';
							}
							else
								echo "<strong>Nenhum resultado encontrado</strong>";
						}
						else if (($_POST['qtdMinhrs']) >= ($_POST['qtdMaxhrs'])){ // MinHrs >= MaxHrs
							echo "<strong>Limite mínimo de horas deve ser menor que o limite máximo de horas</strong>";
						}
						else // ValorMin >= ValorMax
							echo "<strong>Valor mínimo do plano deve ser menor que o valor máximo do plano</strong>";
					}
				}
				else
					echo "<strong>Nenhuma pesquisa realizada por enquanto</strong>";
				?>
			
		</form>
	<?php
		require '../require/content-2-footer.html';
	?>
	<script type='text/javascript'>
		
	</script>
</html>