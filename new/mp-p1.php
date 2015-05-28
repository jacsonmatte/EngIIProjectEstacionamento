<!DOCTYPE html>
<html lang="pt-br">
	<head>
	  <title>Master page</title>
	  <meta charset="utf-8"/>
	  <meta name="viewport" content="width=device-width, initial-scale=1"/>
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	  <link rel='stylesheet' href='css/cp.css'/>
	  <script type='text/javascript'>
	  
		var errorMessage = "Oops! Parece que tivemos um problema...<br/>Tente recarregar a página!";
	  
		function onlyDigitAllow(e) { };
		
		function formatDecimal(e, n) { };
		
		function getPageContent(x) {
			
			$.ajax({
				url: 'ajax/get_page.php?user_type=1',
				method: 'POST',
				data: { pageId: x },
				dataType: 'html',
				success: setContent,
				error: function(erro) {
					setContent(errorMessage);
				}
			});
			
		}
		
		
		function setContent(htmlStr) {

			$("#divConteudo").empty();
			if (htmlStr.indexOf("<b>Parse error</b>:") != -1)
				$("#divConteudo").append(errorMessage);
			else
				$("#divConteudo").append(htmlStr);
			
		}
		
	  </script>
	</head>
	<body class='bg-all'>
		<div class="container-fluid bg-info bg-all">
			<div class="row offset-top-and-bottom-1 bg-all"> 
				<div class="col-sm-3 text-right menu">
					<div class='text-center bg-menu radius-10 simple-border-black'>
						<?php
						$_SESSION['user_type'] = $_GET['user_type'];
						$_SESSION['username'] = 'teste';
						if ($_SESSION['user_type'] == 1) { 
							echo("<script>
								// scripts do cliente
							</script>
							ADMIN - Painel de controle
							<ul class='nav nav-pills nav-stacked'>
								<li class='cmd-item margin-top-and-bottom-10' onclick='getPageContent(-1)'><a href='#'>MEUS DADOS&nbsp;<span class='glyphicon glyphicon-home'></a></li>
								<li class='cmd-item margin-top-and-bottom-10' onclick='getPageContent(-2)'><a href='#'>VAGAS&nbsp;<span class='glyphicon glyphicon-book'></a></li>
								<li class='cmd-item margin-top-and-bottom-10' onclick='getPageContent(-3)'><a href='#'>NOVA VAGA&nbsp;<span class='glyphicon glyphicon-book'></a></li>
								<li class='cmd-item margin-top-and-bottom-10' onclick='getPageContent(-4)'><a href='#'>CLIENTES&nbsp;<span class='glyphicon glyphicon-book'></a></li>
								<li class='cmd-item margin-top-and-bottom-10' onclick='getPageContent(-5)'><a href='#'>PLANOS&nbsp;<span class='glyphicon glyphicon-book'></a></li>
								<li class='cmd-item margin-top-and-bottom-10' onclick='getPageContent(-6)'><a href='#'>NOVO PLANO&nbsp;<span class='glyphicon glyphicon-book'></a></li>
								<li class='cmd-item margin-top-and-bottom-10' onclick='getPageContent(-7)'><a href='#'>RESERVAS&nbsp;<span class='glyphicon glyphicon-lock'></a></li>
								<li class='cmd-item margin-top-and-bottom-10' onclick='getPageContent(-8)'><a href='#'>RELATÓRIOS&nbsp;<span class='glyphicon glyphicon-list-alt'></a></li>
								<li class='cmd-item margin-top-and-bottom-10' onclick='getPageContent(-9)'><a href='#'>MENSALIDADES&nbsp;<span class='glyphicon glyphicon-tags'></a></li>
							</ul>");
						}
						else {
							echo("
							CLIENTE - Painel de controle
							<ul class='nav nav-pills nav-stacked'> <!-- colocar class='active' na li atual-->
								<li class='cmd-item margin-top-and-bottom-10'><a href='#'>MEUS DADOS&nbsp;<span class='glyphicon glyphicon-home'></a></li>
								<li class='cmd-item margin-top-and-bottom-10'><a href='#'>ALTERAR SENHA&nbsp;<span class='glyphicon glyphicon-tags'></a></li>
								<li class='cmd-item margin-top-and-bottom-10'><a href='#'>PLANOS&nbsp;<span class='glyphicon glyphicon-book'></a></li>
								<li class='cmd-item margin-top-and-bottom-10'><a href='#'>RESERVAS&nbsp;<span class='glyphicon glyphicon-lock'></a></li>
								<li class='cmd-item margin-top-and-bottom-10'><a href='#'>RELATÓRIOS&nbsp;<span class='glyphicon glyphicon-list-alt'></a></li>

							</ul>");
						} ?>
						<div class='simple-border-red radius-10'>
							<a href="logout.php"><img src='img/exit.png' width='50px' alt='' /></a><br/>Sair do sistema
						</div>
					</div>
				</div>
				<div class='col-sm-9 content'>
					<div id='divConteudo' class='panel-body simple-border-black bg-content text-center'><!-- conteudo principal -->
						<!--Bem vindo,-->
						<?php
							// echo("<b>" . $_SESSION['username'] . "</b>!<br/>"); ?>
							
						