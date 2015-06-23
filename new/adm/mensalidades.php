<?php 
	require '../require/adm-aut.php'; 
	require "../bd/conectBd.php";
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
				<option value="Janeiro">Janeiro</option>
				<option value="Fevereiro">Fevereiro</option>
				<option value="Março">Março</option>
				<option value="Abril">Abril</option>
				<option value="Maio">Maio</option>
				<option value="Junho">Junho</option>
				<option value="Julho">Julho</option>
				<option value="Agosto">Agosto</option>
				<option value="Setembro">Setembro</option>
				<option value="Outubro">Outubro</option>
				<option value="Novembro">Novembro</option>
				<option value="Dezembro">Dezembro</option>
			</select>
		</div>
		
		<div class='form-group col-sm-3 text-left'>
			<label for='sltPesquisaAno'>Ano:</label>
			<select class='form-control' id='sltPesquisaAno' name='ano'>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
			</select>
		</div>
		<div class='form-group col-sm-6 text-left'>
			<label for='txtPesquisaNomeCliente'>Cliente:</label>
			<input type='text' class='form-control' id='txtPesquisaNomeCliente' name="nome" value="Nome"/>
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
					
						echo '<table width="100%">';
						echo '<thead><tr>';
						echo '<th>Nome</th>';
						echo '<th>Mês</th>';
						echo '<th>Ano</th>';
						echo '<th>Gasto</th>';
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

