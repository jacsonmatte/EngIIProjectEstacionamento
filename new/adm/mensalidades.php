<?php 
	require '../require/adm-aut.php'; 
	//require "../bd/conectBd.php";
	require "../bd/mensalidadeDB.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Mensalidades</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<script type="text/javascript">
	
			$(document).ready(function() {
				$('#table_mens').DataTable({
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
	<h3>Mensalidades</h3>
		<form role='form' class='text-center' method='POST' action='mensalidades.php'>
			<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaMes'>Mês:</label>
			<select class='form-control' id='sltPesquisaMes' name='mes'>
				<option value="00">Selecione..</option>
				<option value="01">Janeiro</option>
				<option value="02">Fevereiro</option>
				<option value="03">Março</option>
				<option value="04">Abril</option>
				<option value="05">Maio</option>
				<option value="06">Junho</option>
				<option value="07">Julho</option>
				<option value="08">Agosto</option>
				<option value="09">Setembro</option>
				<option value="10">Outubro</option>
				<option value="11">Novembro</option>
				<option value="12">Dezembro</option>
			</select>
		</div>
		
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaAno'>Ano:</label>
			<select class='form-control' id='sltPesquisaAno' name='ano'>
				<option value="0000">Selecione..</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
			</select>
		</div>
		<div class='form-group col-sm-6 text-left'>
			<label for='txtPesquisaNomeCliente'>Cliente:</label>
			<input type='text' class='form-control' id='txtPesquisaNomeCliente' name="nome" placeholder="Nome"/>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarMensalidades'></span>
			<input type='submit' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' />
		</div>
		<div id='divResultadoPesquisaMensalidades' class='form-group col-sm-12 text-center'>
		
				
			<?php
				if(isset($_POST['mes']) && isset($_POST['ano']) && isset($_POST['nome'])){


					$dados = buscaMensalidade($_POST['mes'], $_POST['ano'], $_POST['nome']);
					
					if (mysql_num_rows($dados) > 0) {	
					
						echo "<table width='100%' id='table_mens' cellpadding='1.5' border='1' class='bg-all'>";
						echo '<thead><tr>';
						echo '<th><p style="text-align: center;"> Nome</th>';
						echo '<th><p style="text-align: center;"> Mês</th>';
						echo '<th><p style="text-align: center;"> Ano</th>';
						echo '<th><p style="text-align: center;"> Gasto</th>';
						echo '</thead></tr>';
						
						echo '<tbody>';
						while ($dados1 = mysql_fetch_array($dados)){
					    	echo '<tr>';
					    	echo '<td>'.$dados1['nome'].'</td>';
					    	echo '<td>'.$dados1['mes'].'</td>';
					    	echo '<td>'.$dados1['ano'].'</td>';
					    	echo '<td>'. number_format($dados1['soma'], 2) .'</td>';
					    	echo '</tr>';
						}
						echo '</tbody></table>';
					}
					else {
						echo '<strong>Nenhuma mensalidade encontrada</strong>';
					}
				}
			?>
		</div>
	</form>

</html>
<?php require '../require/content-2-footer.html'; ?>

