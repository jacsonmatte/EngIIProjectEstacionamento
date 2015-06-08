<?php
session_start();
$action = $_POST['action'];

if ($action == 'login') {
	$username = $_POST['username'];
	$senha = $_POST['senha'];
	// buscar o usuário pela credencial
	if ($username == 'cliente' && $senha == 'ok') {
		$_SESSION['user_type'] = 2;
		$_SESSION['username'] = 'cliente';
		$retorno = 2;
	}
	else if ($username == 'admin' && $senha == 'ok') {
		$_SESSION['user_type'] = 1;
		$_SESSION['username'] = 'admin';
		$retorno = 1;
	}
	else if ($username != 'admin' && $username != 'cliente')
		$retorno = 3;
	else
		$retorno = 4;

	echo $retorno;
}

?>