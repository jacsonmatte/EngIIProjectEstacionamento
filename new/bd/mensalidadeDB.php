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

function buscaMensalidade($mes, $ano, $nome){
	//$sql = "SELECT c.id_cliente, c.nome, m.id_mensalidade, m.mes, m.ano, m.val_plano, m.val_execed, FROM mensalidade m JOIN	cliente c ON m.cliente_id_cliente = c.id_cliente WHERE m.mes = '$mes' AND m.ano = '$ano' AND c.nome like '$nome'";
	$sql = "SELECT nome, mes, ano, (m.val_plano+m.val_execed) soma FROM mensalidade m JOIN cliente c ON c.id_cliente = m.cliente_id_cliente";
	if ($nome <> '') $sql = $sql . " WHERE c.nome LIKE '%$nome%'";
	//if ($mes <> '') $sql = $sql . " AND m.mes = '$mes'";
	//if ($ano <> '') $sql = $sql . " AND m.ano = '$ano'";

	$con = dbConnect("localhost","root","");
	$result = dbConsulta($sql,"mensalidade", $con);
	return $result;
}

function buscaPlanos($qtdMinhrs, $qtdMaxhrs, $VloMin, $VloMax){
	
	$sql = "SELECT c.nome nome_cliente, p.nome nome_plano, p.valor, p.horas, p.valor_excedente, o.data_contrato FROM plano p JOIN plano_contratado o ON p.id = o.plano_id_plano JOIN cliente c ON c.id_cliente = o.cliente_id_cliente WHERE p.horas BETWEEN $qtdMinhrs AND $qtdMaxhrs AND p.valor BETWEEN $VloMin AND $VloMax";

	$con = dbConnect("localhost","root","");
	$result = dbConsulta($sql,"mensalidade", $con);
	return $result;
}

function buscaClientes($nome, $checkbox){	

		if($checkbox == '1'){
	
		$sql = "SELECT * FROM cliente c JOIN plano_contratado p ON c.id_cliente = p.cliente_id_cliente";
		if($nome <> '') $sql = $sql . " WHERE nome LIKE '%$nome%'";
		
		$con = dbConnect("localhost","root","");
		$result =dbConsulta($sql,"estacionamento",$con);
		return $result;
	}else{
		$sql= "SELECT * FROM cliente";
		if($nome <> '') $sql = $sql . " WHERE nome LIKE '%$nome%'";
		
		$con = dbConnect("localhost","root","");
		$result =dbConsulta($sql,"estacionamento",$con);
		return $result;
	
	}
}

function buscaVagas($numero, $situacao, $tipo){//o campo numero nem sempre virá preenchido, então é necessário tratá-lo 
	
	$sql = "SELECT id_vaga, descricao, nro_vaga, tipo FROM vaga WHERE tipo = $tipo AND";

	$data1 = date("Y-m-d") . "T:00:00";
	$data2 = date("Y-m-d") . "T:23:59";

	if ($situacao == 2 or $situacao == 4)//quando a situação é em utilização ou reservado
		$sql .= " id_vaga IN (SELECT vaga_id_vaga FROM estacionamento WHERE status = $situacao)";
	else//livre
		$sql .= " (id_vaga NOT IN (SELECT vaga_id_vaga FROM estacionamento WHERE (status = 4 OR status = 2) AND ('$data1' NOT BETWEEN 'dh_entrada' AND 'dh_saida' AND '$data2' NOT BETWEEN 'dh_entrada' AND 'dh_saida')) OR id_vaga NOT IN (SELECT vaga_id_vaga FROM estacionamento WHERE status = 2 OR status = 4))";

	if ($numero <> '') $sql .= " AND nro_vaga = '$numero'";//quando numero não for vazio

	$con = dbConnect("localhost","root","");
	$result = dbConsulta($sql,"mensalidade", $con);
	return $result;
}

?>

