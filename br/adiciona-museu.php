<?php include("cabecalho.php");
	require_once 'class/Museu.php';
	require_once 'class/Conecta.php';

	$museu = new Museu($conexao);
	$museu->setIndice($_GET['indice']);
	$museu->setNome($_GET['nome']);
	$museu->setCodCidade($_GET['cod_cidade']);
	$museu->setAnoFundacao($_GET['ano_fundacao']);

	if(isset($_GET['sem_fundacao']))
	{
	    $sem_fundacao = true;
	}
	else
	{
	    $sem_fundacao = false;
	}
	$museu->setSemFundacao($sem_fundacao);
	
	$museu->setHorarioFuncionamentoAdministrativo($_GET['horario_funcionamento_administrativo']);
	$museu->setHorarioAtendimentoPublico($_GET['horario_atendimento_publico']);

	$museu->setTelefone($_GET['telefone']);
	$museu->setEndereco($_GET['endereco']);

	$museu->setSituacao($_GET['situacao']);

	$museu->setObservacoes($_GET['observacoes']);

	$retornoInsercaoMuseu = $museu->insere(); // array [0]->true ou false, [1]->id inserido


	if($retornoInsercaoMuseu[0]) {
?>

	<p class="alert alert-success" >Museu <?php echo $museu->getNome(); ?> adicionado com sucesso!</p>

<?php 
	} else {
?>

	<p class="alert alert-danger" >Museu <?php echo $museu->getNome(); ?> não foi adicionado!</p>

<?php
}
include("rodape.php");
?>