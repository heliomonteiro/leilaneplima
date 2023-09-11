<?php

class UnidadeContexto {

	private $conexao;
	private $table = "unidades_contextos";

	private $codigo;
	private $num_cardinal;
	private $unidade_analise;
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

	public function setUnidadeAnalise($unidade_analise)
	{
		$this->unidade_analise = $unidade_analise;
		return $this;
	}

	public function getUnidadeAnalise()
	{
		return $this->unidade_analise;
	}

	public function setTema($tema)
	{
		$this->tema = $tema;
	}

	public function getTema()
	{
		return $this->tema;
	}

	public function listar(){
		$query = "select * from unidades_contextos";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscar(){
		$query = "select * from unidades_contextos where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function listarPorUnidadeAnalise(){
		$query = "select * from unidades_contextos where unidade_analise = :unidade_analise ORDER BY num_cardinal ASC";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":unidade_analise",$this->unidade_analise);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}