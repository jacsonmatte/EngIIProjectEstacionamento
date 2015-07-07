<?php

function buscarPlanosCliente($idCliente, $dataInicial, $dataFinal, $ordenar) {

	$sql = "SELECT p.nome nome, p.valor valor, p.horas horas, p.valor_excedente excedente, pc.data_contrato data, pc.id_plano_contratado id_plano_contratado FROM plano_contratado pc JOIN plano p ON p.id = pc.plano_id_plano WHERE cliente_id_cliente = $idCliente";
	
	if ($dataInicial <> '' && $dataFinal <> '')
		$sql .= " AND pc.data_contrato BETWEEN '$dataInicial' AND '$dataFinal'";
	
	if ($ordenar)
		$sql .= " ORDER BY pc.data_contrato";
	
	$con = dbConnect("localhost","root","");
	$result = dbConsulta($sql,"estacionamento",$con);
	
	return $result;
	
}

function buscarPlanosPorValorTempoSituacao($idCliente, $horasMin, $horasMax, $valorMin, $valorMax, $situacao) {

	$sql = "SELECT p.nome nome, p.valor valor, p.horas horas, p.valor_excedente excedente, pc.data_contrato data, pc.id_plano_contratado id_plano_contratado, pc.status status FROM plano_contratado pc JOIN plano p ON p.id = pc.plano_id_plano WHERE cliente_id_cliente = $idCliente";
	
	if ($horasMin <> '')
		$sql .= " AND p.horas >= '$horasMin'";
	
	if ($horasMax <> '')
		$sql .= " AND p.horas <= '$horasMax'";
	
	if ($valorMin <> '')
		$sql .= " AND p.valor >= '$valorMin'";
	
	if ($valorMax <> '')
		$sql .= " AND p.valor <= '$valorMax'";
	
	if ($situacao == 'ativos')
		$sql .= " AND pc.status = 0";
	
	if ($situacao == 'inativos')
		$sql .= " AND pc.status = 1";
	
	$con = dbConnect("localhost","root","");
	$result = dbConsulta($sql,"estacionamento",$con);
	
	return $result;
	
}

?>
