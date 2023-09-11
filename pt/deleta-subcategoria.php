<?php include("cabecalho.php");
	require_once 'class/Conecta.php';
	require_once 'class/SubCategoria.php';

	$subcategoria = new SubCategoria($conexao);
	$subcategoria->setCodigo($_GET['codigo']);
	$sc = $subcategoria->buscar();

	$retornoDelecaoSubCategoria = $subcategoria->deletar(); // array [0]->true ou false, [1]->id inserido
	if($retornoDelecaoSubCategoria) {
?>

	<p class="alert alert-success" >SubCategoria <?php echo $sc['descricao']; ?> deletado com sucesso!</p>

<?php 
	} else {
?>

	<p class="alert alert-danger" >SubCategoria <?php echo $sc['descricao']; ?> não foi deletado!</p>

<?php
}
include("rodape.php");
?>