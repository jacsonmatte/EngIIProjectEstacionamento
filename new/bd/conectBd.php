<?php
function dbConnect($host, $user, $pass){
    $connect = @mysql_connect($host, $user, $pass);
    return $connect;
}
 
 
//Conecta na BD e executa uma consulta
function dbConsulta($sql, $app, $connect){
    mysql_select_db($app, $connect);
    mysql_set_charset('UTF8',$connect);
    ($a = mysql_query($sql)) or (die ("error: ".mysql_error()));
    return $a;
}

function validaLogin($user, $senha){
	 $sql = "SELECT `senha`, `login` FROM `usuario` WHERE login='$user' and senha='$senha'";
	 $con = dbConnect("localhost","root","");
	 $result =dbConsulta($sql,"estacionamento",$con);
	 return mysql_num_rows($result);
}
?>