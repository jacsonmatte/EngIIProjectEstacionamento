<?php
$masterpage = file_get_contents('./home1.php');
$divisor = strpos($masterpage, "__CONTENT__");
echo substr($masterpage, 0, $divisor);
?>
<div class="div_cadastro text-center">
			<br/><h5>ADMIN - Vagas</h5><br/><br/>	
			<form actions="" method="POST" class="text-center">
				<select  style="width:100px" name="vagas"> 
					<option>Vagas</option>
				</select><br/>	
				<input id="codigo" style="width:100px" type="text" style="height: 20px;" value = "Código" name="codigo"onfocus="this.value='';"/> </br>
				<select style="width:100px" name="tipo">
					<option>Tipo</option>
				</select> </br>
				<textarea rows="3" id="descricao" name="descricao" onfocus="this.value='';"></textarea><br/>					
				<button type="submit" id="botao_cadastrar" name="submit" class="btn-medium btn-success" >Cadastrar</button>
			</form>	
				<button type="button" id="botao_sair" name="sair" class="btn-danger botao_sair" >&#10008; Sair</button>
			
				
		</div>
<?php

echo substr($masterpage, $divisor + 11);
?>