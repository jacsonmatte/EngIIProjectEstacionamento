<?php

function buscarVagasLivres($dataHoraInicial, $dataHoraFinal, $tipoVaga) {
	$sql = "SELECT * FROM vaga WHERE id_vaga NOT IN (SELECT vaga_id_vaga FROM estacionamento WHERE dh_entrada BETWEEN '$dataHoraInicial' AND '$dataHoraFinal' AND dh_saida IS NULL)";
	
	if ($tipoVaga > 0)
		$sql = $sql . " AND tipo = '$tipoVaga'";
	
	$con = dbConnect("localhost","root","");
	$result = dbConsulta($sql,"estacionamento",$con);
	
	return $result;
}

function efetuarReserva($vaga, $dataHoraInicial, $dataHoraFinal, $cliente) {
	
	$con = dbConnect("localhost","root","");
	$res = dbConsulta("SELECT 1 FROM estacionamento WHERE vaga = '$vaga' AND dh_entrada >= '$dataHoraInicial'");
	
	if (mysql_num_rows($res) > 0)
		return -2;
	
	$token = '';
	while (1) {
		for ($i = 0; $i < 9; $i++)
			$token = $token . rand(0, 9);
		
		$res = dbConsulta("SELECT 1 FROM estacionamento WHERE token = '$token' AND dh_saida IS NULL","estacionamento",$con);
		if(mysql_num_rows($result) == 0) break;
	}
	
	$sql = "INSERT INTO estacionamento (id_estacionamento, dh_entrada, dh_saida, nro_vaga, vaga_id_vaga, cliente_id_cliente, status, token)
	 VALUES (NULL, '$dataHoraInicial', '$dataHoraFinal', '', '$vaga', '$cliente', '4', '$token')";
	
	$res = dbConsulta($sql,"estacionamento",$con);
	if ($res)
		$idReserva = mysql_insert_id();
	else return -1;
	
	$res = dbConsulta("SELECT token FROM estacionamento WHERE id_estacionamento = '$idReserva'", "estacionamento", $con);
	//$con->close;
	return mysql_fetch_array($res)[0];
	
}

function buscarReservas($cliente, $dataInicial, $dataFinal, $tipoVaga, $situacao) {

	$sql = "SELECT e.id_estacionamento codigo, e.dh_entrada entrada, e.dh_saida saida, v.nro_vaga vaga, e.token token, e.status status FROM estacionamento e JOIN vaga v ON e.vaga_id_vaga = v.id_vaga WHERE cliente_id_cliente = '$cliente'";
	
/*	if ($dataInicial != '' && $dataFinal != '')
		$sql = $sql . " AND (dh_entrada BETWEEN '$dataInicial' AND '$dataFinal' OR dh_saida BETWEEN '$dataInicial' AND '$dataFinal')";
	if ($tipoVaga > 0)
		$sql = $sql . " AND (SELECT tipo FROM vaga WHERE id_vaga = e.vaga_id_vaga) = '$tipoVaga'";
	if ($situacao > 0)
		$sql = $sql . " AND status = '$situacao'";
*/

	$con = dbConnect("localhost", "root", "");
	$res = dbConsulta($sql, "estacionamento", $con);
	
	return $res;
	//$con->close;
}
?>