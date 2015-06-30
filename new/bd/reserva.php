<?php

function buscarVagasLivres($dataHoraInicial, $dataHoraFinal, $tipoVaga) {
	
	$sql = "SELECT * FROM vaga WHERE id_vaga NOT IN (SELECT vaga_id_vaga FROM estacionamento WHERE status = 2";
	
	if ($dataHoraInicial <> '' && $dataHoraFinal <> '')
		$sql .= " OR (status = 4 AND (dh_entrada BETWEEN '$dataHoraInicial' AND '$dataHoraFinal' OR dh_saida BETWEEN '$dataHoraInicial' AND '$dataHoraFinal'))";
	$sql .= ")";
	
	if ($tipoVaga > 0)
		$sql = $sql . " AND tipo = '$tipoVaga'";
	
	$con = dbConnect("localhost", "root", "");
	$result = dbConsulta($sql, "estacionamento", $con);
	
	return $result;
}

function alterarSituacaoReserva($idEstacionamento, $status) {
	
	$con = dbConnect("localhost","root","");
	$result = dbConsulta("UPDATE estacionamento SET status = $status WHERE id_estacionamento = $idEstacionamento", "estacionamento", $con);
	
}

function efetuarReserva($vaga, $dataHoraInicial, $dataHoraFinal, $cliente) {
	
	$con = dbConnect("localhost", "root","");
	// verifca se existe alguma reserva para a vaga onde
	// a data/hora de entrada/saída está no intervalo de uma reserva existente
	// ou se a reserva pretendida inicia antes e termina depois de alguma reserva existente
	$res = dbConsulta("SELECT 1 FROM estacionamento WHERE vaga_id_vaga = '$vaga' AND (('$dataHoraInicial' BETWEEN dh_entrada AND dh_saida) OR ('$dataHoraFinal' BETWEEN dh_entrada AND dh_saida) OR ('$dataHoraInicial' <= dh_entrada AND '$dataHoraFinal' >= dh_saida))", "estacionamento", $con);
	
	if (mysql_num_rows($res) > 0)
		return -2;
	
	$token = '';
	while (1) {
		for ($i = 0; $i < 9; $i++)
			$token = $token . rand(0, 9);
		
		$res = dbConsulta("SELECT 1 FROM estacionamento WHERE token = '$token' AND dh_saida IS NULL","estacionamento",$con);
		if(mysql_num_rows($res) == 0) break;
	}
	
	$sql = "INSERT INTO estacionamento (id_estacionamento, dh_entrada, dh_saida, nro_vaga, vaga_id_vaga, cliente_id_cliente, status, token)
	 VALUES (NULL, '$dataHoraInicial', '$dataHoraFinal', '', '$vaga', '$cliente', '$STATUS_RESERVA_RESERVADA', '$token')";
	
	$res = dbConsulta($sql,"estacionamento",$con);
	if ($res)
		$idReserva = mysql_insert_id();
	else return -1;
	
	$res = dbConsulta("SELECT token FROM estacionamento WHERE id_estacionamento = '$idReserva'", "estacionamento", $con);
	
	return mysql_fetch_array($res)[0];
	
}

function buscarReservas($cliente, $dataInicial, $dataFinal, $tipoVaga, $situacao) {
	
	$sql = "SELECT e.id_estacionamento codigo, e.dh_entrada entrada, e.dh_saida saida, v.nro_vaga vaga, e.token token, e.status status FROM estacionamento e JOIN vaga v ON e.vaga_id_vaga = v.id_vaga";

	if ($cliente > 0)
		$sql .= " WHERE cliente_id_cliente = $cliente";
	
	if ($dataInicial != '' && $dataFinal != '') {
		$dataInicial = $dataInicial . "T00:00";
		$dataFinal = $dataFinal . "T23:59";
		$sql = $sql . " AND ((dh_entrada >= '$dataInicial' AND dh_entrada <= '$dataFinal') OR (dh_saida >= '$dataInicial' AND dh_saida <= '$dataFinal'))";
	}
	if ($tipoVaga > 0)
		$sql = $sql . " AND (SELECT tipo FROM vaga WHERE id_vaga = e.vaga_id_vaga) = '$tipoVaga'";
	if ($situacao > 0)
		$sql = $sql . " AND status = '$situacao'";

	$con = dbConnect("localhost", "root", "");
	$res = dbConsulta($sql, "estacionamento", $con);
	
	return $res;

}

?>