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
function loadCliente($login){
	$sql = "SELECT nome, cpf_cnpj, email, logradouro, nro, cep, bairro, cidade, estado,telefone FROM cliente, usuario WHERE cliente.id_cliente=usuario.cliente_id_cliente and usuario.login='$login'";
	$con = dbConnect("localhost","root","");
	$result =dbConsulta($sql,"estacionamento",$con);
	$dados = array();
	while($row=mysql_fetch_array($result)){
			$dados["nome"]=$row["nome"];
			$dados["cpf_cnpj"]=$row["cpf_cnpj"];
			$dados["email"]=$row["email"];
			$dados["logradouro"]=$row["logradouro"];
			$dados["nro"]=$row["nro"];
			$dados["cep"]=$row["cep"];
			$dados["bairro"]=$row["bairro"];
			$dados["cidade"]=$row["cidade"];
			$dados["estado"]=$row["estado"];
			$dados["telefone"]=$row["telefone"];
	}
	return $dados;
}

?>