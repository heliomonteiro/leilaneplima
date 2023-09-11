<?php

class UnidadeAnalise {

	private $conexao;
	private $table = "unidades_analises";

	private $codigo;
	private $tema;
	private $num_romano;
	private $descricao;

	public function __construct(\PDO $conexao)
	{
		$this->conexao = $conexao;
	}

	public function setCodigo($codigo)
	{
		$this->codigo = $codigo;
		return $this;
	}

	public function getCodigo()
	{
		return $this->codigo;
	}

	public function setTema($tema)
	{
		$this->tema = $tema;
	}

	public function getTema()
	{
		return $this->tema;
	}

	public function buscar(){
		$query = "select * from unidades_analises where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function listarPorTema(){
		$query = "select * from unidades_analises where tema = :tema";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":tema",$this->tema);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}