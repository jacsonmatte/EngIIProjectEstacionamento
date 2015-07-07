<?php
	require_once '../dominio/constantes.php';
	require_once '../bd/conectBd.php';

	function montaSelect()
	{
		$sql = "SELECT * FROM plano";
		$conexao = dbConnect("localhost","root","");
		$query = dbConsulta($sql,"estacionamento", $conexao);

		$opt = "";
		
		if (mysql_num_rows($query)) {
			while ($dados = mysql_fetch_array($query)){
				$dados_id = $dados['id'];
				$dados_nome = $dados['nome'];
				$opt .= '<option value="'.$dados_id.'">'.$dados_nome.'</option>';
			}
		} else {
			$opt = '<option value="0">Nenhum cliente cadastrado</option>';
		}
		
		return $opt;
	}
	
	/**
	 * função que devolve em formato JSON os dados do cliente
	 */
	function retorna ($id)
	{
		$id = (int)$id;
		
		$sql = "SELECT valor, horas, valor_excedente, descr FROM plano WHERE id = '{$id}' ";
		$conexao = dbConnect("localhost","root","");
		$query = dbConsulta($sql,"estacionamento", $conexao);

		$arr = Array();

		if (mysql_num_rows($query)) {
			while ($dados = mysql_fetch_array($query)){
				$arr['txtValor'] = $dados['valor'];
				$arr['txtHoras'] = $dados['horas'];
				$arr['txtValorExcedente'] = $dados['valor_excedente'];
				$arr['txtDescr'] = $dados['descr'];
			}
		}		
		return json_encode ($arr);
	}
	
	function pesquisa ($id_cliente, $horas_min, $horas_max, $valor_min, $valor_max)
	{
		$id_cliente = (int)$id_cliente;


		$sql = "SELECT valor, horas, valor_excedente, descr FROM plano_contratado INNER JOIN plano ON plano_id_plano = id WHERE cliente_id_cliente = '{$id_cliente}'";
		
		if($horas_max!= "" || $horas_min != ""){	
			if ($horas_max > $horas_min) {
				$sql .= "AND horas >= '{$horas_min}' AND horas <= '{$horas_max}'";
			} else if ($horas_max == "" && $horas_min != "") {
				$sql .= "AND horas >= '{$horas_min}'";
			} else if ($horas_min == "" && $horas_max != "") {
				$sql .= "AND horas <= '{$horas_max}'";
			}
		}

		if($valor_max!= "" || $valor_min != ""){	
			if ($valor_max > $valor_min) {
				$sql .= "AND valor >= '{$valor_min}' AND valor <= '{$valor_max}'";
			} else if ($valor_max == "" && $valor_min != "") {
				$sql .= "AND valor >= '{$valor_min}'";
			} else if ($valor_min == "" && $valor_max != "") {
				$sql .= "AND valor <= '{$valor_max}'";
			}
		}	

		$conexao = dbConnect("localhost","root","");
		$query = dbConsulta($sql,"estacionamento", $conexao);

		$opt = Array();
		$opt['txtValor'] = "<table id='tblResultadoPesquisa'><thead><tr><td>Valor</td><td>Horas</td><td>Hora Excedente</td><td>Descrição</td></tr></thead><tbody>";
		
		if (mysql_num_rows($query)) {
			while ($dados = mysql_fetch_array($query)) {
				$opt['txtValor'] .= "<tr><td>".$dados['valor']."</td><td>".$dados['horas']."</td><td>".$dados['valor_excedente']."</td><td>".$dados['descr']."</td></tr>" ;
			}
			$opt['txtValor'] .= "</tbody></table>";
		} else {
			$opt['txtValor'] = "Nenhum plano contratado";
		}

		//$opt['txtValor'] .= $valor_min." | ".$valor_max." | ".$sql;
		
		return json_encode ($opt);
	}

/* só se for enviado o parâmetro, que devolve o combo */
	if (isset($_GET['id'])) {
		echo retorna($_GET['id']);
	}
	
	if (isset($_GET['id_cliente'])) {
		echo pesquisa (addslashes($_GET['id_cliente']), addslashes($_GET['horas_min']), addslashes($_GET['horas_max']), addslashes($_GET['valor_min']), addslashes($_GET['valor_max']));
	}
	