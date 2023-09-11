<?php
Class Tema {
	
	private $conexao;
	private $table = 'temas';
	
	private $codigo;
	private $letra;
	private $descricao;

	public function __construct(\PDO $conexao) {
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

	public function setLetra($letra)
	{
		$this->letra = $letra;
		return $this;
	}

	public function getLetra()
	{
		return $this->letra;
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
	
	public function listar() {
		$query = "select * from temas";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listarTemasQualitativo() {
		$query = "select * from temas where codigo in (3,4)";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscar(){
		$query = "select * from Temas where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insereCategoriasMuseu($museu, $tema, $unidade_analise, $unidade_contexto,$categoria)
	{
		$query = "INSERT INTO categorias_museus (museu, tema, unidade_analise, unidade_contexto, categoria) 
			VALUES (:museu, :tema, :unidade_analise, :unidade_contexto, :categoria)";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':museu',$museu);
		$stmt->bindValue(':tema',$tema);
		$stmt->bindValue(':unidade_analise',$unidade_analise);
		$stmt->bindValue(':unidade_contexto',$unidade_contexto);
		$stmt->bindValue(':categoria',$categoria);
		if($stmt->execute()) {
			return true;
		}
	}
}