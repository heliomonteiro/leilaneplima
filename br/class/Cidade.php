<?php

class Cidade{
	
	private $conexao;
	private $table = "cidades";

	private $cod_cidade;
	private $nome;
	private $uf;

	public function __construct(PDO $conexao) {
		$this->conexao = $conexao;
	}

	//GETTER AND SETTERS
	public function getCodCidade() {
		return $this->cod_cidade;
	}

	public function setCodCidade($cod_cidade) {
		$this->cod_cidade = $cod_cidade;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getUf(){
		return $this->uf;
	}

	public function setUf($uf){
		$this->uf = $uf;
	}

	public function buscaCidade()
	{
		$query = "select * from cidades where cod_cidade = :cod_cidade";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':cod_cidade',$this->cod_cidade);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function buscaCidadesPorEstado(){
		$query = "select * from cidades where uf = :uf";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':uf',$this->uf);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}