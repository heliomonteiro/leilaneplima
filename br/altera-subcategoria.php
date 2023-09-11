<?php include("cabecalho.php");
	require_once 'class/Conecta.php';
	require_once 'class/Categoria.php';
	require_once 'class/SubCategoria.php';

	$sub_categoria = new SubCategoria($conexao);
	$sub_categoria->setCodigo($_POST['codigo']);
	$sub_categoria->setCategoria($_POST['categoria']);
	$sub_categoria->setDescricao($_POST['descricao']);

	$retornoAlteracaoSubCategoria = $sub_categoria->alterar(); // array [0]->true ou false, [1]->id inserido
	if($retornoAlteracaoSubCategoria) {
?>

	<p class="alert alert-success" >SubCategoria <?= $sub_categoria->getDescricao() ?> alterado com sucesso!</p>

<?php 
	} else {
?>

	<p class="alert alert-danger" >SubCategoria <?= $sub_categoria->getDescricao() ?> não foi alterado!</p>

<?php
}
include("rodape.php");
?>