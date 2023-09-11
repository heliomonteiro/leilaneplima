<?php include("cabecalho.php");
	require_once 'class/Conecta.php';
	require_once 'class/Categoria.php';
	require_once 'class/SubCategoria.php';

	$sub_categoria = new SubCategoria($conexao);
	$sub_categoria->setCategoria($_GET['categoria']);
	$sub_categoria->setDescricao($_GET['descricao']);

	$retornoInsercaoSubCategoria = $sub_categoria->inserir(); // array [0]->true ou false, [1]->id inserido
	if($retornoInsercaoSubCategoria) {
?>

	<p class="alert alert-success" >SubCategoria <?= $sub_categoria->getDescricao() ?> adicionado com sucesso!</p>

<?php 
	} else {
?>

	<p class="alert alert-danger" >SubCategoria <?= $sub_categoria->getDescricao() ?> não foi adicionado!</p>

<?php
}
include("rodape.php");
?>