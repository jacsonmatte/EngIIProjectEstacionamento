<?php

function buscarVagasLivres($dataHoraInicial, $dataHoraFinal, $tipoVaga) {
	$sql = "SELECT * FROM vaga WHERE id_vaga NOT IN (SELECT vaga_id_vaga FROM estacionamento WHERE dh_entrada BETWEEN '$dataHoraInicial' AND '$dataHoraFinal' AND dh_saida IS NULL)";
	
	if ($tipoVaga > 0)
		$sql = $sql . " AND tipo = '$tipoVaga'";
	
	$con = dbConnect("localhost","root","");
	$result = dbConsulta($sql,"estacionamento",$con);
	
	return $result;
}

function efetuarReserva($vaga, $dataHoraInicial, $dataHoraFinal, $user) {
	
	$con = dbConnect("localhost","root","");
	
	$token = '';
	while (1) {
		for ($i = 0; $i < 9; $i++)
			$token = $token . rand(0, 9);
		
		$result = dbConsulta("SELECT 1 FROM estacionamento WHERE token = '$token' AND dh_saida IS NULL","estacionamento",$con);
		if(mysql_num_rows($result) == 0) break;
	}
	
	$sql = "INSERT INTO estacionamento (id_estacionamento, dh_entrada, dh_saida, nro_vaga, vaga_id_vaga, cliente_id_cliente, status, token)
	 VALUES (NULL, '$dataHoraInicial', '$dataHoraFinal', '', '$vaga', '$user', '1', '$token')";
	
	$result = dbConsulta($sql,"estacionamento",$con);
	if ($result)
		$idReserva = mysql_insert_id();
	else return 1;
	
	$result = dbConsulta("SELECT token FROM estacionamento WHERE id_estacionamento = '$idReserva'", "estacionamento", $con);
	return mysql_fetch_array($result)[0];
	
}

?>