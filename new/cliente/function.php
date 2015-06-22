<?php
	require '../bd/conectBd.php"';

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
		
		return json_encode( $arr );
	}

/* só se for enviado o parâmetro, que devolve o combo */
	if (isset($_GET['id'])) {
		echo retorna($_GET['id']);
	}
	