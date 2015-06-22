<?php

// conexão padrão local (1), servidor 000 (2) ou outro (3)

function dbConnect2(){
    $connect = @mysql_connect("localhost", "root", "");
    return $connect;
}

function dbConnect($host, $user, $pass){
	$CONNECT = 1;
	if ($CONNECT == 1)
		return @mysql_connect("localhost", "root", "");
	else if ($CONNECT == 2)
		return @mysql_connect("http://mysql14.000webhost.com/", "a3618106_root", "ProjetoES2");
	else
		return @mysql_connect($host, $user, $pass);
}
 
//Conecta na BD e executa uma consulta
function dbConsulta($sql, $app, $connect){
	$CONNECT = 1;
	if ($CONNECT == 1)
		mysql_select_db("estacionamento", $connect);
	else if ($CONNECT == 2)
		mysql_select_db("a3618106_etc", $connect);
	else
		mysql_select_db($app, $connect);
	
    mysql_set_charset('UTF8', $connect);
    ($a = mysql_query($sql)) or (die ("error: ".mysql_error()));
    return $a;
}

function validaLogin($user, $senha){
	$sql = "SELECT `cliente_id_cliente` FROM `usuario` WHERE login='$user' and senha='$senha'";
	$con = dbConnect("localhost","root","");
	$result = dbConsulta($sql,"estacionamento",$con);
	return mysql_fetch_array($result)[0];
}

function verificaAtributos($email, $Cpf_Cnpj){
    if(!empty($_POST['email']) and !empty($_POST['Cpf_Cnpj'])){
        $sql = "SELECT * FROM `cliente` WHERE cliente.email='$email' and cliente.cpf_cnpj='$Cpf_Cnpj'";
    }
	else if(empty ( $Cpf_Cnpj )){
        $sql = "SELECT * FROM `cliente` WHERE cliente.email='$email'";
    }
	else if(empty ( $email )){
        $sql = "SELECT * FROM `cliente` WHERE cliente.cpf_cnpj='$Cpf_Cnpj'";
    }

     $con = dbConnect("localhost","root","");
     $result =dbConsulta($sql,"estacionamento",$con);
     return mysql_num_rows($result);
}

?>