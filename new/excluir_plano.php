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

		.botao_remover{
			height: 45px;
          	width: 85px;
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
			<br/><h5>ADMIN - Excluir Plano</h5><br/><br/>	
			<form actions="" method="POST" class="text-center">
				<select name="plano">
					<option>Plano</option>

				</select><br/>	
				<button type="submit" id="botao_excluir" name="excluir" class="btn-primary botao_remover">&#10006; Remover</button>
			</form>	
				<button type="button" id="botao_sair" name="sair" class="btn-danger botao_sair" >&#10008; Sair</button>

			
				
		</div>	
	</body>
	


</html>		

