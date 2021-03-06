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
	
	<script type="text/javascript">
	
			$(document).ready(function() {
				$('#table_planos').DataTable({
					language: {
						processing:     "Processando...",
						search:         "Buscar:",
						lengthMenu:     "Exibir _MENU_ itens por página",
						info:           "Mostrando _START_ a _END_ de _TOTAL_ itens",
						infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
						infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
						infoPostFix:    "",
						loadingRecords: "Carregando...",
						zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
						emptyTable:     "Aucune donnée disponible dans le tableau",
						paginate: {
							first:      "<<",
							previous:   "<",
							next:       ">",
							last:       ">>"
						},
						aria: {
							sortAscending:  ": activer pour trier la colonne par ordre croissant",
							sortDescending: ": activer pour trier la colonne par ordre décroissant"
						}
					}
				});
			});
</script>
	
	
	
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
				<input type='radio' id='rdbPesquisaSomentePlanosAtivos' name='pesquisaPlanoSituacao' value='ativos'/><label for='rdbPesquisaSomentePlanosAtivos'>&nbsp;Apenas planos ativos</label>&nbsp;
				<input type='radio' id='rdbPesquisaSomentePlanosInativos' name='pesquisaPlanoSituacao' value='inativos'/><label for='rdbPesquisaSomentePlanosInativos'>&nbsp;Apenas planos inativos</label>&nbsp;
				<input type='radio' id='rdbPesquisaTodosPlanos' name='pesquisaPlanoSituacao' value='todos'/><label for='rdbPesquisaTodosPlanos'>&nbsp;Todos</label>
			</div>
			<div class='form-group col-sm-12 text-right'>
				<span id='spnErroPesquisarPlanos'></span>
				<input type='submit' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' name="btnPesquisar"/>
			</div>
			<?php
				if(isset($_POST['btnPesquisar'])) {
							
					$dados = buscaPlanos($_POST['qtdMinhrs'], $_POST['qtdMaxhrs'], $_POST['VloMin'], $_POST['VloMax'], $_POST['pesquisaPlanoSituacao']);
					$stauts = "";
					if (mysql_num_rows($dados) > 0) {

						echo "<table width='100%' id='table_planos' cellpadding='1.5' border='1' class='bg-all'>";
						echo '<thead><tr>';
						echo '<th><p style="text-align: center;"> Código</th>';
						echo '<th><p style="text-align: center;"> Nome</th>';
						echo '<th><p style="text-align: center;"> Horas</th>';
						echo '<th><p style="text-align: center;"> Valor</th>';
						echo '<th><p style="text-align: center;"> Valor excedente</th>';
						echo '<th><p style="text-align: center;"> Status</th>';
						echo '</tr></thead>';		
						echo '<tbody>';
						while ($dados1 = mysql_fetch_array($dados)){
							echo '<tr>';
							echo '<td>'.$dados1['id'].'</td>';
							echo '<td>'.$dados1['nome'].'</td>';
							echo '<td>'.$dados1['horas'].'</td>';
							echo '<td>'.$dados1['valor'].'</td>';
							echo '<td>'.$dados1['valor_excedente'].'</td>';
							$status = $dados1['status'] == 0 ? "ativo" : "inativo";
							echo '<td>' . $status . '</td>';
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
	<script type='text/javascript'>
		
	</script>
</html>