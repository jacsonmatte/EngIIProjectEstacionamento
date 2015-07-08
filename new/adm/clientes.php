<?php require '../require/adm-aut.php';
		require "../bd/mensalidadeDB.php";
 ?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>

	
		<title>Control Parking - Clientes</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
		
	</head>

	<script type="text/javascript">
	
			$(document).ready(function() {
				$('#clientes').DataTable({
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
		$_SESSION['username'] = 'teste';
		require '../require/menu-adm.html';
		require '../require/menu-2-content-1.html';
	?> 
	<h3>Clientes</h3>
		<form role='form' class='text-center'id="form-pesquisa" action='clientes.php?search=custom' method='POST'>
		<div class='form-group col-sm-12 text-left'>
			<label for='txtPesquisaNomeCliente'>Cliente:</label>
			<input type='text' class='form-control' id='txtPesquisaNomeCliente' placeholder='Digite o nome (ou parte) do cliente' name='txtCliente' />
		</div>
		<div class='form-group col-sm-12 text-left'>
			<input type='checkbox' id='chkPesquisaApenasClientesComPlano' name="chkPesquisaApenasClientesComPlano" /><label for='chkPesquisaApenasClientesComPlano'>&nbsp;Apenas clientes com plano</label>
		</div>
		<div class='form-group col-sm-12 text-right'>
			<span id='spnErroPesquisarClientes'></span>
			<input type='submit' id='btnPesquisar' class='btn cmd-item' value='Pesquisar' name="btnPesquisar"/>
		</div>
		<div id='divResultadoPesquisaClientes' class='form-group col-sm-12 text-center' >	
		<?php
				if(isset($_POST['btnPesquisar'])){	
							$nomecliente = addslashes($_POST['txtCliente']);
							
							if(isset($_POST['chkPesquisaApenasClientesComPlano'])){
								$checkbox = 1;
								$dados = buscaClientes($nomecliente, $checkbox);
							}else{
								$checkbox = 2;
								$dados = buscaClientes($nomecliente, $checkbox);
							}
							
							if (mysql_num_rows($dados) > 0){

								echo "<table style = 'max-width: 150%' id='clientes' cellpadding='1.5' border='1' class='bg-all'>" ;
								echo "<thead><tr>";
								echo "<th>Nome</th>";
								echo "<th>Cpf/CNPJ</th>";
								echo "<th>E-mail</th>";
								echo "<th>Logradouro</th>";
								echo "<th>Nº</th>";
								echo "<th>Bairro</th>";
								echo "<th>Cidade/UF</th>";
								echo "<th>Telefone</th>";
								echo "</tr></thead>";
								
								echo "<tbody>";
								while ($dados1 = mysql_fetch_array($dados)){
									echo "<tr>";
									echo "<td>".$dados1['nome']."</td>";
									echo "<td>".$dados1['cpf_cnpj']."</td>";
									echo "<td>".$dados1['email']."</td>";
									echo "<td>".$dados1['logradouro']."</td>";
									echo "<td>".$dados1['nro']."</td>";
									echo "<td>".$dados1['bairro']."</td>";
									echo "<td>".$dados1['cidade'] . ", " . $dados1['estado'] . "</td>";
									echo "<td>".$dados1['telefone']."</td>";

									echo "</tr>";
								}
								echo "</tbody></table>";
							}
							else
								echo "<strong>Nenhum resultado encontrado</strong>";						
					}	
				
				?>
				</div>
	<?php
		require '../require/content-2-footer.html';
	?>
	<script type='text/javascript'>
		
	</script>
</html>
</html>