<?php
Class ImagensMuseus {

	private $conexao;
	private $table = "imagens_museus";

	private $codigo;
	private $codigo_museu;
	private $nome;
	private $descricao;


	//CONEXAO
	public function __construct(\PDO $conexao)
	{
		$this->conexao = $conexao;
	}

	//GETTERS AND SETTERS
	public function getCodigo() {
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
		return $this;
	}

	public function getMuseu() {
		return $this->codigo_museu;
	}

	public function setMuseu($codigo_museu){
		$this->codigo_museu = $codigo_museu;
		return $this;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
		return $this;
	}

	//OPERACOES BANCO DE DADOS
	public function insere()
	{
		$query = "INSERT INTO imagens_museus(codigo_museu, nome, descricao) 
			VALUES (:codigo_museu, :nome, :descricao)";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':codigo_museu',$this->codigo_museu);
		$stmt->bindValue(':nome',$this->nome);
		$stmt->bindValue(':descricao',$this->descricao);

		if($stmt->execute()){
			$last_id = $this->conexao->lastInsertId();
   			$last_id;
			return array(true,$last_id);
		}
			
	}

	public function listar()
	{
		$query = "select * from imagens_museus";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public function buscar()
	{
		$query = "select * from imagens_museus where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function buscarPorMuseu()
	{
		$query = "select * from imagens_museus where codigo_museu = :codigo_museu";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo_museu",$this->codigo_museu);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function deletar()
	{
		$query = "delete from imagens_museus where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo", $this->codigo);
		if($stmt->execute()){
			return true;
		}
	}

}