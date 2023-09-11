<?php

class Situacao {

	private $conexao;
	private $table = "situacoes";

	public function __construct($conexao)
	{
		$this->conexao = $conexao;
	}

	public function listar(){
		$query = "select * from situacoes";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}