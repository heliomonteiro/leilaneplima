<?php

class ItensFichas {

	private $conexao;

	private $ficha;
	private $tema;
	private $unidade_analise;
	private $unidade_contexto;
	private $categoria;
	private $sub_categoria;
	private $texto;

	public function __construct(\PDO $conexao) {
		$this->conexao = $conexao;
	}

	public function setFicha($ficha)
	{
		$this->ficha = $ficha;
	}

	public function getFicha()
	{
		return $this->ficha;
	}

	public function setTema($tema)
	{
		$this->tema = $tema;
	}

	public function getTema()
	{
		return $this->tema;
	}

	public function setUnidadeAnalise($unidade_analise)
	{
		$this->unidade_analise = $unidade_analise;
	}

	public function getUnidadeAnalise()
	{
		return $this->unidade_analise;
	}

	public function setUnidadeContexto($unidade_contexto)
	{
		$this->unidade_contexto = $unidade_contexto;
	}

	public function getUnidadeContexto()
	{
		return $this->unidade_contexto;
	}

	public function setCategoria($categoria)
	{
		$this->categoria = $categoria;
	}

	public function getCategoria()
	{
		return $this->categoria;
	}

	public function setSubCategoria($sub_categoria)
	{
		$this->sub_categoria = $sub_categoria;
	}

	public function getSubCategoria()
	{
		return $this->sub_categoria;
	}

	public function setTexto($texto)
	{
		$this->texto = $texto;
	}

	public function getTexto()
	{
		return $this->texto;
	}


	public function inserirCategoria()
	{
		$query = "insert into itens_fichas (ficha, tema, unidade_analise, unidade_contexto, categoria) 
			values (:ficha, :tema, :unidade_analise, :unidade_contexto, :categoria)";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":ficha",$this->getFicha());
		$stmt->bindValue(":tema",$this->getTema());
		$stmt->bindValue(":unidade_analise",$this->getUnidadeAnalise());
		$stmt->bindValue(":unidade_contexto",$this->getUnidadeContexto());
		$stmt->bindValue(":categoria",$this->getCategoria());
		//echo $this->conexao->queryString;
		if($stmt->execute()){
			return true;
		}
	}

	public function inserirSubCategoria()
	{
		$query = "insert into itens_fichas (ficha, tema, unidade_analise, unidade_contexto, categoria, sub_categoria) 
			values (:ficha, :tema, :unidade_analise, :unidade_contexto, :categoria, :sub_categoria)";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":ficha",$this->getFicha());
		$stmt->bindValue(":tema",$this->getTema());
		$stmt->bindValue(":unidade_analise",$this->getUnidadeAnalise());
		$stmt->bindValue(":unidade_contexto",$this->getUnidadeContexto());
		$stmt->bindValue(":categoria",$this->getCategoria());
		$stmt->bindValue(":sub_categoria",$this->getSubCategoria());
		if($stmt->execute()){
			return true;
		}
	}

	public function buscaCategoriaPorMuseu(){
		$query = "select * from itens_fichas where categoria = :categoria and ficha = :ficha";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":categoria",$this->categoria);
		$stmt->bindValue(":ficha",$this->ficha);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function buscaCategoriasSubCategoriasDoMuseu(){
		$query = "select * from itens_fichas where ficha = :ficha";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":ficha",$this->ficha);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscaSubCategoriaPorMuseu(){
		$query = "select * from itens_fichas where sub_categoria = :sub_categoria and ficha = :ficha";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":sub_categoria",$this->sub_categoria);
		$stmt->bindValue(":ficha",$this->ficha);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function listarCategoriasPorUcMuseu(){
		$query = "select distinct(categoria) from itens_fichas where unidade_contexto = :unidade_contexto and ficha = :ficha";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":unidade_contexto",$this->unidade_contexto);
		$stmt->bindValue(":ficha",$this->ficha);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listarSubCategoriasPorMuseu(){
		$query = "select * from itens_fichas where categoria = :categoria and ficha = :ficha";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":categoria",$this->categoria);
		$stmt->bindValue(":ficha",$this->ficha);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function alterarCategoriaTexto()
	{
		$query = "update itens_fichas set 
					texto = :texto 
				  where ficha = :ficha
				  	and categoria = :categoria";

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":texto",$this->getTexto());
		$stmt->bindValue(":ficha",$this->getFicha());
		$stmt->bindValue(":categoria",$this->getCategoria());
		if($stmt->execute()){
			return true;
		}
	}

	public function deletaCategoria()
	{
		$query = "delete from itens_fichas where ficha = :ficha and categoria = :categoria";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":ficha", $this->ficha);
		$stmt->bindValue(":categoria", $this->categoria);
		if($stmt->execute()){
			return true;
		}
	}

	public function deletaSubCategoria()
	{
		$query = "delete from itens_fichas where ficha = :ficha and sub_categoria = :sub_categoria";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":ficha", $this->ficha);
		$stmt->bindValue(":sub_categoria", $this->sub_categoria);
		if($stmt->execute()){
			return true;
		}
	}

	public function quantidadeMuseusCategoria()
	{
		$query = "select count(museu) as \"quantidade\" from itens_fichas where categoria = :categoria";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":categoria",$this->categoria);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function QuaisMuseusUtilizaramEstaCategoria()
	{
		$query = "select distinct(museu) as \"museu\" from itens_fichas where categoria = :categoria";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":categoria",$this->categoria);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function quantidadeMuseusSubCategoria()
	{
		$query = "select count(museu) as \"quantidade\" from itens_fichas where sub_categoria = :sub_categoria";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":sub_categoria",$this->categoria);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function QuaisMuseusUtilizaramEstaSubCategoria()
	{
		$query = "select distinct(museu) as \"museu\" from itens_fichas where sub_categoria = :sub_categoria";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":sub_categoria",$this->sub_categoria);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscaCategoriasPorUnidadeDeAnalise()
	{
		//$query = "select * from itens_fichas WHERE ficha = :ficha and unidade_analise = :unidade_analise";
		$query = "SELECT categoria, 
					(select tipo_categoria from categorias where categorias.codigo = categoria) as \"tipo_categoria\" 
				    FROM `itens_fichas` WHERE ficha = :ficha and unidade_analise = :unidade_analise";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":ficha",$this->ficha);
		$stmt->bindValue(":unidade_analise",$this->unidade_analise);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listarSubCategoriasPorUnidadeDeAnalise(){
		$query = "SELECT * FROM itens_fichas WHERE ficha = :ficha and unidade_analise = :unidade_analise and sub_categoria is not null;";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":unidade_analise",$this->unidade_analise);
		$stmt->bindValue(":ficha",$this->ficha);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}