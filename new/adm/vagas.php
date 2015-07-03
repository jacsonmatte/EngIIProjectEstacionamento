<?php 
	require '../require/adm-aut.php'; 
	require "../bd/mensalidadeDB.php";	
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Vagas</title>
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
	<h3>Vagas</h3>
		<form role='form' class='text-center'id="form-pesquisa-vaga" action='vagas.php?search=custom' method='POST'>

		<div class='form-group col-sm-3 text-left'>
			<label for='txtPesquisaNumeroVaga'>Número:</label>
			<input type='text' class='form-control' id='txtPesquisaNumeroVaga' name="numero">
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaSituacao'>Situação:</label>
			<select class='form-control' id='sltPesquisaSituacao' name="situacao">
				<option value="1">Livre</option>
				<option value="2">Em utilização</option>
				<option value="4">Reservada</option>
			</select>
		</div>
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaTipo'>Tipo:</label>
			<select class='form-control' id='sltPesquisaTipo' name="tipo">
				<option value="1">Carro</option>
				<option value="2">Moto</option>
				<option value="3">Utilitário</option>
			</select>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarVagas'></span>
			<input type='submit' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' name="btnPesquisar"/>
		</div>
			<?php
				if(isset($_POST["btnPesquisar"])){//quando o botão de pesquisar for pressionado
					/*if($_POST['qtdMinhrs'] == NULL || $_POST['qtdMaxhrs'] == NULL || $_POST['VloMin'] == NULL || $_POST['VloMax'] == NULL)
						echo "<strong>Preencha todos os campos!</strong>";
					else{
						if((($_POST['qtdMinhrs']) < ($_POST['qtdMaxhrs'])) && (($_POST['VloMin']) < ($_POST['VloMax']))){ // Min < Max E Min < Max
							
							$dados = buscaPlanos($_POST['qtdMinhrs'], $_POST['qtdMaxhrs'], $_POST['VloMin'], $_POST['VloMax']);

							if (mysql_num_rows($dados) > 0){

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
					}*/

					$dados = buscaVagas($_POST['numero'],$_POST['situacao'], $_POST['tipo']);//faz a consulta ao banco, arquivo mensalidadeBD

					if (mysql_num_rows($dados) > 0){//se a consulta retornar com algum dado
						echo '<table width="100%">';
						echo '<thead><tr>';
						echo '<th>Vaga</th>';
						echo '<th>Situacao</th>';
						echo '<th>tipo</th>';
						echo '<tbody>';

						while ($dados1 = mysql_fetch_array($dados)){//mostra os dados na estrutura montada acima
							echo '<tr>';
							if(!empty($dados1['nro_vaga']))
								echo '<td>'.$dados1['nro_vaga'].'</td>';	
							echo '<td>'.$dados1['tipo'].'</td>';
							echo '</tr>';
						}
						echo '</tbody></table>';
					}
					else
								echo "<strong>Nenhum resultado encontrado</strong>";
				}
				else
					echo "<strong>Nenhuma pesquisa realizada por enquanto</strong>";
			?>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>
