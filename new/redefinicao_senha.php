<?php
	session_start();
	global $email;
	global $Cpf_Cnpj;
	global $id;
	global $nome;
	global $login;
	
	$email=$_POST['email'];
	$Cpf_Cnpj=$_POST['Cpf_Cnpj'];

	require_once("bd/conectBd.php");
	
	
	if(empty($_POST['email']) and empty($_POST['Cpf_Cnpj'])){	
		echo "<script language=javascript>alert( 'Email e CPF/CNPJ Invalidos !' );</script>";
		echo("<script type='text/javascript'>location.href='index.html';</script>");
	}else{
		$cont=verificaAtributos($email,$Cpf_Cnpj);
	}	


	if($cont > 0){
		
		require_once("geraSenha.php");
		$nova_senha=gerarSenha(6, true, true, false);
		if(empty($Cpf_Cnpj)){
			$sql="SELECT * from cliente inner join usuario on cliente.id_cliente=usuario.cliente_id_cliente where cliente.email='$email'";
		}else{
			$sql="SELECT * from cliente inner join usuario on cliente.id_cliente=usuario.cliente_id_cliente where cliente.cpf_cnpj='$Cpf_Cnpj'";
		}
		
		$conexao=dbConnect("localhost","root","");
		$busca_id=dbConsulta($sql,'estacionamento', $conexao);
		while($pega=mysql_fetch_array($busca_id)){
			$id=$pega["id_cliente"];
			$nome=$pega["nome"];
			$login=$pega["login"];
			$email=$pega["email"];
		}

		include("enviaEmail.php");
		
	}else{
		echo "<script language=javascript>alert( 'Email ou CPF/CNPJ nao Cadastrados !' );</script>";
		echo("<script type='text/javascript'>location.href='index.html';</script>");
	}
   
   
?>