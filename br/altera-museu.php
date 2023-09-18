<?php include("cabecalho.php");
	require_once 'class/Museu.php';
	require_once 'class/Conecta.php';

	$museu = new Museu($conexao);
	$museu->setIndice($_POST['indice']);
	$museu->setCodigo($_POST['codigo']);
	$museu->setNome($_POST['nome']);
	$museu->setCodCidade($_POST['cod_cidade']);
	$museu->setAnoFundacao($_POST['ano_fundacao']);

	if(isset($_POST['sem_fundacao']))
	{
	    $sem_fundacao = true;
	}
	else
	{
	    $sem_fundacao = false;
	}
	$museu->setSemFundacao($sem_fundacao);

	//$museu->setHorarioFuncionamentoAdministrativo($_POST['horario_funcionamento_administrativo']);
	//$museu->setHorarioAtendimentoPublico($_POST['horario_atendimento_publico']);

	//$museu->setTelefone($_POST['telefone']);
	//$museu->setEndereco($_POST['endereco']);

	//$museu->setSituacao($_POST['situacao']);

	//$museu->setObservacoes($_POST['observacoes']);

var_dump($museu);

	$retornoAlteracaoMuseu = $museu->alterar(); // array [0]->true ou false, [1]->id inserido


	if($retornoAlteracaoMuseu[0]) {
?>

	<p class="alert alert-success" >Museu <?php echo $museu->getNome(); ?> alterado com sucesso!</p>

<?php 
	} else {
?>

	<p class="alert alert-danger" >Museu <?php echo $museu->getNome(); ?> não foi alterado!</p>

<?php
}
include("rodape.php");
?>