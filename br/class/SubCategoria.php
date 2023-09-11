<?php

class SubCategoria {

	private $conexao;
	private $table = "sub_categorias";

	private $codigo;
	private $descricao;
	private $categoria;

	public function __construct(\PDO $conexao)
	{
		$this->conexao = $conexao;
	}

	public function setCodigo($codigo)
	{
		$this->codigo = $codigo;
	}

	public function getCodigo()
	{
		return $this->codigo;
	}

	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}

	public function getDescricao()
	{
		return $this->descricao;
	}

	public function setCategoria($categoria)
	{
		$this->categoria = $categoria;
	}

	public function getCategoria()
	{
		return $this->categoria;
	}


	public function listarPorCategoria(){
		$query = "select * from sub_categorias where categoria = :categoria";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":categoria",$this->categoria);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscar(){
		$query = "select * from sub_categorias where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function inserir()
	{
		$query = "insert into sub_categorias (descricao, categoria) 
			values (:descricao, :categoria)";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":descricao",$this->getDescricao());
		$stmt->bindValue(":categoria",$this->getCategoria());
		if($stmt->execute()){
			return true;
		}
	}

	public function alterar()
	{
		$query = "update sub_categorias 
					set descricao = :descricao,
						categoria = :categoria
				  where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":descricao",$this->getDescricao());
		$stmt->bindValue(":categoria",$this->getCategoria());
		$stmt->bindValue(":codigo",$this->getCodigo());
		if($stmt->execute()){
			return true;
		}
	}

	public function deletar()
	{
		$query = "delete from sub_categorias where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo", $this->codigo);
		if($stmt->execute()){
			return true;
		}
	}

}