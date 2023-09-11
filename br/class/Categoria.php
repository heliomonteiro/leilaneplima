<?php

class Categoria {

	private $conexao;
	private $table = "categorias";

	private $codigo;
	private $descricao;
	private $unidade_contexto;
	private $tipo_categoria;

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

	public function setUnidadeContexto($unidade_contexto)
	{
		$this->unidade_contexto = $unidade_contexto;
		return $this;
	}

	public function getUnidadeContexto()
	{
		return $this->unidade_contexto;
	}

	public function setTipoCategoria($tipo_categoria)
	{
		$this->tipo_categoria = $tipo_categoria;
	}

	public function getTipoCategoria()
	{
		return $this->tipo_categoria;
	}

	public function listarPorUnidadeContexto(){
		$query = "select * from categorias where unidade_contexto = :unidade_contexto order by tipo_categoria, codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":unidade_contexto",$this->unidade_contexto);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listarCategoriasTipoSubCategoria(){
		$query = "select * from categorias where tipo_categoria = 4";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":tipo_categoria",$this->unidade_contexto);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscar(){
		$query = "select * from categorias where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function inserir()
	{
		$query = "insert into categorias (descricao, unidade_contexto, tipo_categoria) 
			values (:descricao, :unidade_contexto, :tipo_categoria)";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":descricao",$this->getDescricao());
		$stmt->bindValue(":unidade_contexto",$this->getUnidadeContexto());
		$stmt->bindValue(":tipo_categoria",$this->getTipoCategoria());
		if($stmt->execute()){
			return true;
		}
	}

	public function alterar()
	{
		$query = "update categorias 
					set descricao 	 = :descricao,
					unidade_contexto = :unidade_contexto,
					tipo_categoria 	 =  :tipo_categoria
				 where
				 	codigo 			 = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":descricao",$this->getDescricao());
		$stmt->bindValue(":unidade_contexto",$this->getUnidadeContexto());
		$stmt->bindValue(":tipo_categoria",$this->getTipoCategoria());
		$stmt->bindValue(":codigo",$this->getCodigo());
		if($stmt->execute()){
			return true;
		}
	}

	public function deletar()
	{
		$query = "delete from categorias where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo", $this->codigo);
		if($stmt->execute()){
			return true;
		}
	}

}