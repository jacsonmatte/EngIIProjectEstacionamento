<!DOCTYPE>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<style type="text/css">

		.div_cadastro{
			position: relative;
         	top:100px;
          	left:400px;
          	height: 326px;
          	width: 570px;		
          	background-color: #888;
          	border: solid 3px black;
          	border: solid 3px black;
         	border-top-right-radius: 15px;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px; 
		}

		.botao_sair{
			position: absolute;
         	top:270px;
          	left:500px;
          	height: 42px;
          	width: 42px;
         	border: solid 3px black;
         	border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px; 
            color: black;	

		}
		input{
			text-align: center;
		}


		</style>
	</head>
	
	<body>
		<div class="div_cadastro text-center">
			<br/><h5>ADMIN - Cadastro de Planos</h5><br/>	
			<form actions="" method="POST" class="text-center"  name="form_cadastro_planos">
				<input id="nome_plano" type="text" value="Nome do Plano" name="nome_plano" onfocus="this.value='';"/><br/>
				<input id="valor_plano" type="text" value="Valor" name="valor_plano"onfocus="this.value='';"/>
				<input type="text" id="qt_horas_plano" value="Quantidade de Horas" name="qt_horas_plano" onfocus="this.value='';"/><br/>
				<input type="text" id="vl_horas_excedentes" value="Valor hora excedente" name="vl_horas_excedentes" onfocus="this.value='';"/><br/>
				<textarea rows="2" id="descricao_plano "value="Descrição" name="descricao" onfocus="this.value='';"></textarea><br/>
				<button type="submit" id="botao_cadastrar" name="submit" class="btn-medium btn-success" >Cadastrar</button>
			</form>
				<button type="submit" id="botao_sair" name="sair" class="btn-danger botao_sair" >&#10008; Sair</button>
				
		</div>	
	</body>
	


</html>		
