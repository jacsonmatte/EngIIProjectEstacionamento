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
	<h3>Vagas</h3><!--formulário com os campos a serem preenchidos--> 
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
		<div id='divResultadoPesquisaVagas' class='form-group col-sm-12 text-center'>
			<?php
				if(isset($_POST["btnPesquisar"])){//quando o botão de pesquisar for pressionado

					$dados = buscaVagas($_POST['numero'],$_POST['situacao'], $_POST['tipo']);//faz a consulta ao banco, arquivo mensalidadeBD

					if (mysql_num_rows($dados) > 0){//se a consulta retornar com algum dado
						echo '<table id="tblResultadoPesquisa" width="100%">';
						echo '<thead><tr>';
						echo '<th>Código</th>';
						echo '<th>Descrição</th>';
						echo '<th>Número</th>';
						echo '<th>Tipo</th></tr></thead>';
						echo '<tbody>';

						while ($dados1 = mysql_fetch_assoc($dados)){//mostra os dados na estrutura montada acima, resultado mostrado dentro do datatable
							echo '<tr>';
							echo '<td>'.$dados1['id_vaga'].'</td>';	
							echo '<td>'.$dados1['descricao'].'</td>';
							echo '<td>'.$dados1['nro_vaga'].'</td>';
							if($dados1['tipo'] == 1){
								echo '<td>Carro</td>';
							}else if($dados1['tipo'] == 2){
								echo '<td>Moto</td>';
							}else
								echo '<td>Utilitário</td>';
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
	</div>
	</form>
	<?php
		require '../require/content-2-footer.html';
	?>
</html>
