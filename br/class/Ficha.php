<?php
Class Ficha {

	private $conexao;
	private $table = "fichas";

	private $codigo;
	private $indice;
	//private $nome;
	//private $ano_fundacao;
	//private $sem_fundacao;
	private $horario_funcionamento_administrativo;
	private $horario_atendimento_publico;
	private $telefone;
	//private $cod_cidade;
	private $endereco;
	private $situacao;
	private $observacoes;
	private $revisitacao;
	private $visita_tecnica;
	private $museu;

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
/*
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
*/
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
/*
	public function getCodCidade() {
		return $this->cod_cidade;
	}

	public function setCodCidade($cod_cidade){
		$this->cod_cidade = $cod_cidade;
		return $this;
	}
*/
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

	public function getRevisitacao(){
		return $this->revisitacao;
	}

	public function setRevisitacao($revisitacao){
		$this->revisitacao = $revisitacao;
		return $this;
	}

	public function getVisitaTecnica(){
		return $this->visita_tecnica;
	}

	public function setVisitaTecnica($visita_tecnica){
		$this->visita_tecnica = $visita_tecnica;
		return $this;
	}

	public function getMuseu(){
		return $this->museu;
	}

	public function setMuseu($museu){
		$this->museu = $museu;
		return $this;
	}

	//OPERACOES BANCO DE DADOS
	public function insere()
	{
//		$query = "INSERT INTO museus(indice, nome, ano_fundacao, sem_fundacao, horario_funcionamento_administrativo, horario_atendimento_publico, telefone, cod_cidade, endereco, situacao, observacoes) 
//			VALUES (:indice, :nome, :ano_fundacao, :sem_fundacao,  :horario_funcionamento_administrativo, :horario_atendimento_publico, :telefone, :cod_cidade, :endereco, :situacao, :observacoes)";
		$query = "INSERT INTO fichas(indice, horario_funcionamento_administrativo, horario_atendimento_publico, telefone, endereco, situacao, observacoes, revisitacao, visita_tecnica, museu) 
			VALUES (:indice, :horario_funcionamento_administrativo, :horario_atendimento_publico, :telefone, :endereco, :situacao, :observacoes, :revisitacao, :visita_tecnica, :museu)";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':indice',$this->indice);
		//$stmt->bindValue(':nome',$this->nome);
		//$stmt->bindValue(':ano_fundacao',$this->ano_fundacao);
		//$stmt->bindValue(':sem_fundacao',$this->sem_fundacao);
		$stmt->bindValue(':horario_funcionamento_administrativo',$this->horario_funcionamento_administrativo);
		$stmt->bindValue(':horario_atendimento_publico',$this->horario_atendimento_publico);
		$stmt->bindValue(':telefone',$this->telefone);
		//$stmt->bindValue(':cod_cidade',$this->cod_cidade);
		$stmt->bindValue(':endereco',$this->endereco);
		$stmt->bindValue(':situacao',$this->situacao);
		$stmt->bindValue(':observacoes',$this->observacoes);
		$stmt->bindValue(':revisitacao',$this->revisitacao);
		$stmt->bindValue(':visita_tecnica',$this->visita_tecnica);
		$stmt->bindValue(':museu',$this->museu);

		if($stmt->execute()){
			$last_id = $this->conexao->lastInsertId();
   			$last_id;
			return array(true,$last_id);
		}
			
	}

	//OPERACOES BANCO DE DADOS
	public function insereVazio()
	{
		$query = "INSERT INTO fichas(indice, telefone, endereco, situacao, observacoes,museu) 
			VALUES (:indice, '', '', 2, '', :museu)";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':indice',$this->indice);
		$stmt->bindValue(':museu',$this->museu);


		var_dump($this->indice); echo '<br><br>';
		var_dump($this->museu); echo '<br><br>';
		var_dump($stmt);

		if($stmt->execute()){
			$last_id = $this->conexao->lastInsertId();
   			$last_id;
			return array(true,$last_id);
		}
			
	}

	public function listar()
	{
		$query = "select * from fichas order by indice";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public function listarPorMuseu()
	{
		$query = "select codigo, indice from fichas where museu = :museu order by indice";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":museu",$this->museu);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscar()
	{
		$query = "select * from fichas where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function buscarAnterior()
	{
		$query = "select * from fichas where museu = :museu and indice < (select indice from fichas where codigo = :codigo) order by indice desc limit 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":museu",$this->museu['codigo']);
		$stmt->bindValue(":codigo",$this->codigo);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function deletar()
	{
		$query = "delete from fichas where codigo = :codigo";
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
		$query = "update fichas 
			set indice = :indice,
				horario_funcionamento_administrativo = :horario_funcionamento_administrativo, 
				horario_atendimento_publico = :horario_atendimento_publico, 
				telefone = :telefone, 
				endereco = :endereco, 
				situacao = :situacao, 
				observacoes = :observacoes,
				revisitacao = :revisitacao,
				visita_tecnica = :visita_tecnica
			where codigo = :codigo";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':indice',$this->indice);
		//$stmt->bindValue(':nome',$this->nome);
		//$stmt->bindValue(':ano_fundacao',$this->ano_fundacao);
		//$stmt->bindValue(':sem_fundacao',$this->sem_fundacao);
		$stmt->bindValue(':horario_funcionamento_administrativo',$this->horario_funcionamento_administrativo);
		$stmt->bindValue(':horario_atendimento_publico',$this->horario_atendimento_publico);
		$stmt->bindValue(':telefone',$this->telefone);
		//$stmt->bindValue(':cod_cidade',$this->cod_cidade);
		$stmt->bindValue(':endereco',$this->endereco);
		$stmt->bindValue(':situacao',$this->situacao);
		$stmt->bindValue(':observacoes',$this->observacoes);
		$stmt->bindValue(':revisitacao',$this->revisitacao);
		$stmt->bindValue(':visita_tecnica',$this->visita_tecnica);
		$stmt->bindValue(':codigo',$this->codigo);

		if($stmt->execute()){
			$last_id = $this->conexao->lastInsertId();
   			$last_id;
			return array(true,$last_id);
		}
			
	}

	public function buscarUltimoIndice()
	{
		$query = "select max(indice) as ultima_ficha from fichas where museu = :museu";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(":museu",$this->museu);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

}