<?php
Class Museu {

	private $conexao;
	private $table = "museus";

	private $codigo;
	private $indice;
	private $nome;
	private $ano_fundacao;
	private $sem_fundacao;
	//private $horario_funcionamento_administrativo;
	//private $horario_atendimento_publico;
	//private $telefone;
	private $cod_cidade;
	//private $endereco;
	//private $situacao;
	//private $observacoes;

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

	public function getIndice() {
		return $this->indice;
	}

	public function setIndice($indice){
		$this->indice = $indice;
		return $this;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}

	public function getAnoFundacao() {
		return $this->ano_fundacao;
	}

	public function setAnoFundacao($ano_fundacao){

		$this->ano_fundacao = $ano_fundacao; //	echo date('Y-m-d', strtotime(str_replace('-','/', $museu->getDataFundacao())))."<br>";
		return $this;
	}

	public function getSemFundacao() {
		return $this->sem_fundacao;
	}

	public function setSemFundacao($sem_fundacao){

		$this->sem_fundacao = $sem_fundacao; //	echo date('Y-m-d', strtotime(str_replace('-','/', $museu->getDataFundacao())))."<br>";
		return $this;
	}
/*
	public function getHorarioFuncionamentoAdministrativo() {
		return $this->horario_funcionamento_administrativo;
	}

	public function setHorarioFuncionamentoAdministrativo($horario_funcionamento_administrativo){
		$this->horario_funcionamento_administrativo = $horario_funcionamento_administrativo;
		return $this;
	}

	public function getHorarioAtendimentoPublico() {
		return $this->horario_atendimento_publico;
	}

	public function setHorarioAtendimentoPublico($horario_atendimento_publico){
		$this->horario_atendimento_publico = $horario_atendimento_publico;
		return $this;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
		return $this;
	}
*/
	public function getCodCidade() {
		return $this->cod_cidade;
	}

	public function setCodCidade($cod_cidade){
		$this->cod_cidade = $cod_cidade;
		return $this;
	}
/*
	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
		return $this;
	}

	public function getSituacao() {
		return $this->situacao;
	}

	public function setSituacao($situacao){
		$this->situacao = $situacao;
		return $this;
	}

	public function getObservacoes(){
		return $this->observacoes;
	}

	public function setObservacoes($observacoes){
		$this->observacoes = $observacoes;
		return $this;
	}
*/

	//OPERACOES BANCO DE DADOS
	public function insere()
	{
		//$query = "INSERT INTO museus(indice, nome, ano_fundacao, sem_fundacao, horario_funcionamento_administrativo, horario_atendimento_publico, telefone, cod_cidade, endereco, situacao, observacoes) 
		//	VALUES (:indice, :nome, :ano_fundacao, :sem_fundacao,  :horario_funcionamento_administrativo, :horario_atendimento_publico, :telefone, :cod_cidade, :endereco, :situacao, :observacoes)";
		$query = "INSERT INTO museus(indice, nome, ano_fundacao, sem_fundacao, cod_cidade) 
			VALUES (:indice, :nome, :ano_fundacao, :sem_fundacao,  :cod_cidade)";		
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':indice',$this->indice);
		$stmt->bindValue(':nome',$this->nome);
		$stmt->bindValue(':ano_fundacao',$this->ano_fundacao);
		$stmt->bindValue(':sem_fundacao',$this->sem_fundacao);
		//$stmt->bindValue(':horario_funcionamento_administrativo',$this->horario_funcionamento_administrativo);
		//$stmt->bindValue(':horario_atendimento_publico',$this->horario_atendimento_publico);
		//$stmt->bindValue(':telefone',$this->telefone);
		$stmt->bindValue(':cod_cidade',$this->cod_cidade);
		//$stmt->bindValue(':endereco',$this->endereco);
		//$stmt->bindValue(':situacao',$this->situacao);
		//$stmt->bindValue(':observacoes',$this->observacoes);

		if($stmt->execute()){
			$last_id = $this->conexao->lastInsertId();
   			$last_id;
			return array(true,$last_id);
		}
			
	}

	public function listar()
	{
		$query = "select * from museus order by indice";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public function buscar()
	{
		$query = "select * from museus where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function deletar()
	{
		$query = "delete from museus where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo", $this->codigo);
		if($stmt->execute()){
			return true;
		}
	}

	public function alterar()
	{
		/*
		$query = "update museus 
					set indice = :indice,
					nome = :nome, 
					ano_fundacao = :ano_fundacao, 
					sem_fundacao = :sem_fundacao, 
					horario_funcionamento_administrativo = :horario_funcionamento_administrativo, 
					horario_atendimento_publico = :horario_atendimento_publico, 
					telefone = :telefone, 
					cod_cidade = :cod_cidade, 
					endereco = :endereco, 
					situacao = :situacao, 
					observacoes = :observacoes
				where codigo = :codigo";
		*/
		$query = "update museus 
					set indice = :indice,
					nome = :nome, 
					ano_fundacao = :ano_fundacao, 
					sem_fundacao = :sem_fundacao,
					cod_cidade = :cod_cidade
				where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':indice',$this->indice);
		$stmt->bindValue(':nome',$this->nome);
		$stmt->bindValue(':ano_fundacao',$this->ano_fundacao);
		$stmt->bindValue(':sem_fundacao',$this->sem_fundacao);
		//$stmt->bindValue(':horario_funcionamento_administrativo',$this->horario_funcionamento_administrativo);
		//$stmt->bindValue(':horario_atendimento_publico',$this->horario_atendimento_publico);
		//$stmt->bindValue(':telefone',$this->telefone);
		$stmt->bindValue(':cod_cidade',$this->cod_cidade);
		//$stmt->bindValue(':endereco',$this->endereco);
		//$stmt->bindValue(':situacao',$this->situacao);
		//$stmt->bindValue(':observacoes',$this->observacoes);
		$stmt->bindValue(':codigo',$this->codigo);

		if($stmt->execute()){
			$last_id = $this->conexao->lastInsertId();
   			$last_id;
			return array(true,$last_id);
		}
			
	}

	public function buscarQtdFichas()
	{
		$query = "select count(*) as qtd_fichas from fichas where museu = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}	
}