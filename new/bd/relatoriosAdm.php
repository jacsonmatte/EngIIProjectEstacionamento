<?php	
	require('conectBd.php');
	//busca todos os planos
	function recPlano ()
	{
		$sql = "SELECT descr, id FROM `plano` WHERE 1";
		$con = dbConnect("localhost","root","");
		$result = dbConsulta($sql,"estacionamento",$con);
		if(mysql_num_rows($result) == 0) return 0;
 		$dados = array();
		while($row=mysql_fetch_array($result)){
			$dados[] = $row["descr"];
			$dados["value"][] = $row["id"];
		}

		return $dados;
	}
	//filtra os planos
	function buscaPlanos ($planos) 
	{
		$sql = "SELECT  nome, valor, horas, valor_excedente, descr FROM plano";
		
		if ($planos != "") {
			$sql .= " WHERE id = '{$planos}' ";
		}

		$con = dbConnect("localhost","root","");
		$result = dbConsulta($sql,"estacionamento",$con);
		
		$dados = array();
		
		if (mysql_num_rows($result)) {
			$dados = "";
			while ($row=mysql_fetch_array($result)) {
				$dados .= "<tr><td>".$row['nome']."</td><td>".$row['valor']."</td><td>".$row['horas']."</td><td>".$row['valor_excedente']."</td><td>".$row['descr']."</td></tr>";
			}
		}
		
		return $dados;
	}
	//filtra os clientes
	function buscaClientes ($idCliente)
	{
		$sql = "SELECT id_cliente, nome, cpf_cnpj, email, logradouro, nro, cep, bairro, cidade, estado, telefone FROM cliente";

		if ($idCliente != "")
			$sql .= " WHERE id_cliente = $idCliente";


		$con = dbConnect("localhost","root","");
		$result = dbConsulta($sql,"estacionamento",$con);
		
		$dados = array();
		
		if (mysql_num_rows($result)) {
			$dados = "";
			while ($row=mysql_fetch_array($result)) {
				$dados .= "<tr><td>".$row['id_cliente']."</td><td>".$row['nome']."</td><td>".$row['cpf_cnpj']."</td><td>".$row['email']."</td><td>".$row['logradouro']."&nbsp-&nbsp".$row['bairro']."&nbsp-&nbsp".$row['cidade']."&nbsp-&nbsp".$row['estado']."</td><td>".$row['cep']."</td><td>".$row['telefone']."</td></tr>";
			}
		} else return 0;
		
		return $dados;
	}
	//filtra os planos dos clientes
	function buscaPlanosClientes ($dataInicial, $dataFinal, $idCliente, $planos) 
	{
		$sql = "SELECT cliente.nome as nome, plano.nome as planoNome, plano.horas as horas, plano_contratado.observacao as obs FROM plano_contratado, plano, cliente WHERE cliente.id_cliente = plano_contratado.cliente_id_cliente AND plano_contratado.plano_id_plano = plano.id";

		if ($idCliente > 0)
			$sql .= " AND cliente_id_cliente = '$idCliente'";
		
		if ($dataInicial != '' && $dataFinal != '') {
			$sql .= " AND data_contrato >= '$dataInicial' AND data_contrato <= '$dataFinal'";
		} else if ($dataInicial != '' && $dataFinal == '') {
			$sql .= " AND data_contrato >= '$dataInicial'";
		} else if ($dataInicial == '' && $dataFinal != '') {
			$sql .= " AND data_contrato <= '$dataFinal'";
		}

		if ($planos != "") {
			$sql .= " AND plano_id_plano = '$planos'";
		}

		$con = dbConnect("localhost","root","");
		$result = dbConsulta($sql,"estacionamento",$con);
		
		$dados = array();
		
		if (mysql_num_rows($result)) {
			$dados = "";
			while ($row=mysql_fetch_array($result)) {
				$dados .= "<tr><td>".$row['nome']."</td><td>".$row['planoNome']."</td><td>".$row['horas']."</td><td>".$row['obs']."</td></tr>";
			}
		} else return 0;
		
		return $dados;
	}
//filtra as reservas utilizadas
	function buscaReservasUtilizadas ($idCliente, $vaga, $relatorio)
	{

		$sql = "SELECT e.id_estacionamento codigo, e.dh_entrada entrada, e.dh_saida saida, v.nro_vaga vaga, e.token token, e.status status FROM estacionamento e, vaga v WHERE e.vaga_id_vaga = v.id_vaga ";
		
		if($relatorio == "reservasUtilizadas"){
			$sql .= "AND e.status = '1'";
		}
		
		if($idCliente != ''){
			$sql .= " AND e.cliente_id_cliente = '$idCliente' ";
		}
		
		if($vaga != ''){
			$sql .= " AND e.vaga_id_vaga = '$vaga' ";
		}
		
		$con = dbConnect("localhost","root","");
		$result = dbConsulta($sql,"estacionamento",$con);

		$dados = '';
		if (mysql_num_rows($result)) {
			$dados = "";
			while ($row = mysql_fetch_array($result)) {
					
					$dados .= "<tr><td>".$row['codigo']."</td><td>".$row['entrada']."</td><td>".$row['saida']."</td><td>".$row['vaga']."</td><td>".$row['token']."</td><td>".$row['status']."</td></tr>";
			}
		} else return 0;
		return $dados;
	}
	//filtra as vagas
	function buscaUsoDeVagas ($idCliente, $vaga)
	{
		$sql = "SELECT vaga.nro_vaga as vaga, vaga.tipo as tipo, dh_entrada, dh_saida, cliente.nome as nome FROM estacionamento, cliente, vaga WHERE estacionamento.vaga_id_vaga = vaga.id_vaga AND estacionamento.cliente_id_cliente = cliente.id_cliente";
		if ($idCliente != "")
			$sql .= " AND estacionamento.cliente_id_cliente = $idCliente";
		if ($vaga)
			$sql .= " AND estacionamento.vaga_id_vaga = $vaga";
			
		$con = dbConnect("localhost","root","");
		$result = dbConsulta($sql,"estacionamento",$con);

		$dados = array();
		if (mysql_num_rows($result)) {
			$dados = "";
			while ($row = mysql_fetch_array($result)) {
				$dados .= "<tr><td>".$row['vaga']."</td><td>".$row['tipo']."</td><td>".$row['dh_entrada']."</td><td>".$row['dh_saida']."</td><td>".$row['nome']."</td></tr>";
			}
		} else return 0;	
				
		return $dados;
	}
?>