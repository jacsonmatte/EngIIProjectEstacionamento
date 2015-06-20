<?php
session_start();
if(isset($_POST["login"]) and isset($_POST["senha"])){

   $mysql['username'] = addslashes($_POST['login']);
   $mysql['password'] = addslashes($_POST['senha']);
   require "bd/conectBd.php";
   $res = validaLogin($mysql['username'], $mysql['password']);
   if($res > 0 && $mysql['username'] == "admin"){
		$_SESSION['user_type'] = 1;
		$_SESSION['username'] = $mysql['username'];
		header("Location: adm/home.php");
   }
   else if($res > 0){
		   $_SESSION['id_cliente'] = $res;
		   $_SESSION['user_type'] = 2;
		   $_SESSION['username'] = $mysql['username'];
		   header("Location:cliente/home.php");
	   }
   }
   else {
	   header("Location:index.html?id=0");
   }
	
?>