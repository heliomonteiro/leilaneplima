<?php

class TipoCategoria {

	private $conexao;
	private $table = "tipos_categorias";

	private $codigo;
	private $descricao;

	public function __construct(\PDO $conexao)
	{
		$this->conexao = $conexao;
	}

	public function setCodigo($codigo)
	{
		$this->codigo = $codigo;
	}

	public function getcodigo()
	{
		return $this->codigo;
	}

	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
		return $this;
	}

	public function getDescricao()
	{
		return $this->descricao;
	}

	public function listar(){
		$query = "select * from tipos_categorias";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscar(){
		$query = "select * from tipos_categorias where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

}