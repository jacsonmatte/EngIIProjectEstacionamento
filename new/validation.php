<?php
if(isset($_POST["login"]) and isset($_POST["senha"])){

   $mysql['username'] = addslashes($_POST['login']);
   $mysql['password'] = addslashes($_POST['senha']);
   require "bd/conectBd.php";
   $res = validaLogin($mysql['username'], $mysql['password']);
   if($res > 0 && $mysql['username'] == "admin"){
	   header("Location:adm/home.php");
   }else{
	   if($res > 0){
		    header("Location:cliente/home.php");
	   }
   }
	
}
	
?>